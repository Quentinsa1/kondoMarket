<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;

class VendorController extends Controller
{
    /**
     * Afficher le formulaire d'inscription vendeur
     */
    public function showRegistrationForm()
    {
        return view('vendor.register');
    }

    /**
     * Traiter l'inscription d'un nouveau vendeur
     */
  public function register(Request $request)
{
    // --- Détection précoce des erreurs d'upload pour id_document (particulier) ---
    if ($request->vendor_type === 'individual') {
        // Cas 1 : le fichier est présent mais invalide (erreur PHP)
        if ($request->hasFile('id_document')) {
            $file = $request->file('id_document');
            if (!$file->isValid()) {
                $error = $file->getError();
                if ($error === UPLOAD_ERR_INI_SIZE || $error === UPLOAD_ERR_FORM_SIZE) {
                    return redirect()->back()
                        ->withErrors(['id_document' => 'Le fichier est trop volumineux. Taille maximale autorisée : 5 Mo.'])
                        ->withInput();
                } else {
                    return redirect()->back()
                        ->withErrors(['id_document' => 'Erreur lors de l\'upload du fichier. Code: ' . $error])
                        ->withInput();
                }
            }
        } else {
            // Cas 2 : le fichier n'est pas présent mais $_FILES contient une entrée avec erreur
            if (isset($_FILES['id_document']) && $_FILES['id_document']['error'] !== UPLOAD_ERR_NO_FILE) {
                $error = $_FILES['id_document']['error'];
                if ($error === UPLOAD_ERR_INI_SIZE || $error === UPLOAD_ERR_FORM_SIZE) {
                    return redirect()->back()
                        ->withErrors(['id_document' => 'Le fichier est trop volumineux. Taille maximale autorisée : 5 Mo.'])
                        ->withInput();
                } else {
                    return redirect()->back()
                        ->withErrors(['id_document' => 'Erreur lors de l\'upload du fichier. Code: ' . $error])
                        ->withInput();
                }
            }
        }
    }

    // Validation des données communes
    $validator = Validator::make($request->all(), [
        'vendor_type' => 'required|in:individual,company',
        'full_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email',
        'phone' => 'required|string|max:20|unique:vendors,phone',
        'password' => 'required|string|min:8|confirmed',
        'country' => 'required|string|size:2',
        'city' => 'required|string|max:100',
        'terms' => 'required|accepted',
    ]);

    // Validation conditionnelle selon le type
    if ($request->vendor_type === 'individual') {
        $validator->addRules([
            'display_name' => 'required|string|max:255',
            'activity_type' => 'required|in:selling,service,both',
            'description' => 'nullable|string|max:500',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_document' => [
                'required',
                'file',
                'mimes:jpeg,png,jpg,pdf',
                'max:5120', // 5 Mo
            ],
        ]);
    } else {
        $validator->addRules([
            'company_name' => 'required|string|max:255',
            'company_category' => 'required|in:restaurant,boutique,service,artisan,ecommerce,other',
            'company_description' => 'nullable|string|max:1000',
            'address' => 'nullable|string|max:500',
            // SIRET supprimé
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);
    }

    // Messages personnalisés en français
    $validator->setCustomMessages([
        'id_document.required' => 'La pièce d\'identité est obligatoire.',
        'id_document.mimes' => 'Le fichier doit être de type : jpeg, png, jpg ou pdf.',
        'id_document.max' => 'Le fichier ne doit pas dépasser 5 Mo.',
        'display_name.required' => 'Le nom d\'affichage est requis.',
        'activity_type.required' => 'Le type d\'activité est requis.',
        // Ajoutez d'autres messages si nécessaire
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Vérification finale que le fichier est bien valide (ne devrait pas arriver)
    if ($request->vendor_type === 'individual' && $request->hasFile('id_document')) {
        if (!$request->file('id_document')->isValid()) {
            return redirect()->back()
                ->withErrors(['id_document' => 'Le fichier est invalide.'])
                ->withInput();
        }
    }

    // Création de l'utilisateur
    $user = User::create([
        'name' => $request->full_name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'vendor',
    ]);

    // Préparation des données du vendeur
    $vendorData = [
        'user_id' => $user->id,
        'vendor_type' => $request->vendor_type,
        'phone' => $request->phone,
        'city' => $request->city,
        'country' => $request->country,
        'status' => 'pending_review', // Document fourni => en attente de vérification
    ];

    if ($request->vendor_type === 'individual') {
        $vendorData['display_name'] = $request->display_name;
        $vendorData['activity_type'] = $request->activity_type;
        $vendorData['description'] = $request->description;

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('vendors/avatars', 'public');
            $vendorData['avatar_path'] = $path;
        }

        // Stockage de la pièce d'identité (toujours présente ici)
        $path = $request->file('id_document')->store('vendors/documents/identity', 'public');
        $vendorData['id_document_path'] = $path;
    } else {
        $vendorData['company_name'] = $request->company_name;
        $vendorData['company_category'] = $request->company_category;
        $vendorData['description'] = $request->company_description;
        $vendorData['address'] = $request->address;

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('vendors/logos', 'public');
            $vendorData['logo_path'] = $path;
        }

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('vendors/covers', 'public');
            $vendorData['cover_path'] = $path;
        }
    }

    $vendor = Vendor::create($vendorData);

    Auth::login($user);

    return redirect()->route('vendor.register.success')
        ->with('success', 'Votre inscription a été soumise avec succès !')
        ->with('vendor', $vendor);
}

    /**
     * Afficher la page de succès après inscription
     */
    public function registrationSuccess()
    {
        if (!session('success')) {
            return redirect()->route('home');
        }

        $vendor = session('vendor');
        return view('vendor.registration-success', compact('vendor'));
    }

    /**
     * Afficher le formulaire de vérification des documents (après inscription)
     */
    public function showVerifyDocuments()
    {
        $vendor = Auth::user()->vendor;

        if (!$vendor) {
            return redirect()->route('home');
        }

        // Vérifier si déjà approuvé
        if ($vendor->status === 'approved') {
            return redirect()->route('seller.dashboard')
                ->with('info', 'Votre compte est déjà vérifié.');
        }

        return view('vendor.verify-documents', compact('vendor'));
    }

    /**
     * Traiter l'upload des documents de vérification
     */
    public function uploadDocuments(Request $request)
{
    $vendor = Auth::user()->vendor;

    if (!$vendor) {
        return redirect()->route('home');
    }

    $validator = Validator::make($request->all(), [
        // Rendre id_document optionnel si déjà fourni
        'id_document' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:5120',
        'proof_of_address' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:5120',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Mise à jour du document d'identité seulement s'il est fourni
    if ($request->hasFile('id_document')) {
        // Supprimer l'ancien fichier si existant
        if ($vendor->id_document_path) {
            Storage::disk('public')->delete($vendor->id_document_path);
        }
        $path = $request->file('id_document')->store('vendors/documents/identity', 'public');
        $vendor->id_document_path = $path;
    }

    // Upload de la preuve d'adresse
    if ($request->hasFile('proof_of_address')) {
        if ($vendor->address_proof_path) {
            Storage::disk('public')->delete($vendor->address_proof_path);
        }
        $path = $request->file('proof_of_address')->store('vendors/documents/address', 'public');
        $vendor->address_proof_path = $path;
    }

    // Changer le statut en "en attente de vérification"
    $vendor->status = 'pending_review';
    $vendor->save();

    return redirect()->route('seller.dashboard')
        ->with('success', 'Vos documents ont été soumis. Notre équipe les vérifiera sous 48h.');
}

   /**
 * Afficher le tableau de bord vendeur
 */
public function dashboard()
{
    $vendor = Auth::user()->vendor;

    if (!$vendor) {
        return redirect()->route('home');
    }

    // Statistiques réelles
  /*   $stats = [
        'products_count' => $vendor->products()->where('status', 'active')->count(),
        'orders_count' => $vendor->orders()->where('status', '!=', 'cancelled')->count(),
        'revenue' => $vendor->orders()->where('status', 'completed')->sum('total_amount') ?? 0,
        'rating' => $vendor->reviews()->avg('rating') ?? 0,
    ]; */

    return view('vendor.dashboard.index', compact('vendor'));
}

    /**
     * Afficher la page de création de boutique (ancienne méthode)
     * Maintenant redirigée vers l'inscription
     */
    public function createStore()
    {
        // Si l'utilisateur n'est pas authentifié, rediriger vers l'inscription
        if (!Auth::check()) {
            return redirect()->route('vendor.register.form');
        }

        // Si l'utilisateur est authentifié mais n'a pas de profil vendeur
        if (!Auth::user()->vendor) {
            return redirect()->route('vendor.register.form');
        }

        // Si le vendeur a déjà une boutique créée
        $vendor = Auth::user()->vendor;
        if ($vendor->store_created) {
            return redirect()->route('seller.dashboard');
        }

        return view('seller.create-store-legacy', compact('vendor'));
    }

    /**
     * Enregistrer la boutique (ancienne méthode)
     */
    public function storeStore(Request $request)
    {
        $vendor = Auth::user()->vendor;

        if (!$vendor) {
            return redirect()->route('vendor.register.form');
        }

        // Validation des données de la boutique
        $validator = Validator::make($request->all(), [
            'store_name' => 'required|string|max:255|unique:vendors,store_name',
            'store_slug' => 'required|string|max:255|unique:vendors,store_slug',
            'store_description' => 'required|string|max:500',
            'categories' => 'required|array|min:1',
            'store_email' => 'required|email|max:255',
            'store_phone' => 'required|string|max:20',
            'store_country' => 'required|string|size:2',
            'store_city' => 'required|string|max:100',
            'store_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'store_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'return_policy' => 'required|in:30,14,none',
            'delivery_time' => 'required|in:1-3,3-7,7-14,14-30',
            'terms' => 'required|array|min:2',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Mise à jour des informations de la boutique
        $vendor->update([
            'store_name' => $request->store_name,
            'store_slug' => $request->store_slug,
            'store_description' => $request->store_description,
            'store_email' => $request->store_email,
            'store_phone' => $request->store_phone,
            'store_country' => $request->store_country,
            'store_city' => $request->store_city,
            'store_address' => $request->store_address,
            'return_policy' => $request->return_policy,
            'delivery_time' => $request->delivery_time,
            'store_created' => true,
        ]);

        // Gestion des catégories (si vous avez une relation many-to-many)
        if ($request->has('categories')) {
            $vendor->categories()->sync($request->categories);
        }

        // Upload du logo
        if ($request->hasFile('store_logo')) {
            $path = $request->file('store_logo')->store('vendors/store/logos', 'public');
            $vendor->store_logo_path = $path;
        }

        // Upload de la bannière
        if ($request->hasFile('store_banner')) {
            $path = $request->file('store_banner')->store('vendors/store/banners', 'public');
            $vendor->store_banner_path = $path;
        }

        $vendor->save();

        return redirect()->route('seller.dashboard')
            ->with('success', 'Votre boutique a été créée avec succès !');
    }

    /**
     * Gérer les produits du vendeur
     */
    public function manageProducts()
    {
        $vendor = Auth::user()->vendor;

        if (!$vendor) {
            return redirect()->route('home');
        }

        $products = $vendor->products()->latest()->paginate(10);

        return view('seller.products', compact('vendor', 'products'));
    }

    /**
     * Gérer les commandes du vendeur
     */
    public function manageOrders()
    {
        $vendor = Auth::user()->vendor;

        if (!$vendor) {
            return redirect()->route('home');
        }

        $orders = $vendor->orders()->latest()->paginate(10);

        return view('seller.orders', compact('vendor', 'orders'));
    }

    /**
     * Modifier le profil du vendeur
     */
    public function editProfile()
    {
        $vendor = Auth::user()->vendor;

        if (!$vendor) {
            return redirect()->route('home');
        }

        return view('seller.profile', compact('vendor'));
    }

    /**
     * Mettre à jour le profil du vendeur
     */
    public function updateProfile(Request $request)
    {
        $vendor = Auth::user()->vendor;

        if (!$vendor) {
            return redirect()->route('home');
        }

        $validator = Validator::make($request->all(), [
            'display_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'phone' => 'required|string|max:20|unique:vendors,phone,' . $vendor->id,
            'city' => 'required|string|max:100',
            'country' => 'required|string|size:2',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $vendor->update([
            'display_name' => $request->display_name,
            'description' => $request->description,
            'phone' => $request->phone,
            'city' => $request->city,
            'country' => $request->country,
        ]);

        // Mettre à jour l'avatar si fourni
        if ($request->hasFile('avatar')) {
            // Supprimer l'ancien avatar s'il existe
            if ($vendor->avatar_path) {
                Storage::disk('public')->delete($vendor->avatar_path);
            }

            $path = $request->file('avatar')->store('vendors/avatars', 'public');
            $vendor->avatar_path = $path;
            $vendor->save();
        }

        return redirect()->back()
            ->with('success', 'Profil mis à jour avec succès.');
    }

    /**
     * Paramètres de la boutique
     */
    public function storeSettings()
    {
        $vendor = Auth::user()->vendor;

        if (!$vendor) {
            return redirect()->route('home');
        }

        return view('seller.store-settings', compact('vendor'));
    }

    /**
     * Mettre à jour les paramètres de la boutique
     */
    public function updateStoreSettings(Request $request)
    {
        $vendor = Auth::user()->vendor;

        if (!$vendor) {
            return redirect()->route('home');
        }

        $validator = Validator::make($request->all(), [
            'store_name' => 'required|string|max:255|unique:vendors,store_name,' . $vendor->id,
            'store_slug' => 'required|string|max:255|unique:vendors,store_slug,' . $vendor->id,
            'store_description' => 'required|string|max:500',
            'store_email' => 'required|email|max:255',
            'store_phone' => 'required|string|max:20',
            'store_address' => 'nullable|string|max:500',
            'return_policy' => 'required|in:30,14,none',
            'delivery_time' => 'required|in:1-3,3-7,7-14,14-30',
            'store_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'store_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $vendor->update([
            'store_name' => $request->store_name,
            'store_slug' => $request->store_slug,
            'store_description' => $request->store_description,
            'store_email' => $request->store_email,
            'store_phone' => $request->store_phone,
            'store_address' => $request->store_address,
            'return_policy' => $request->return_policy,
            'delivery_time' => $request->delivery_time,
        ]);

        // Mettre à jour le logo
        if ($request->hasFile('store_logo')) {
            if ($vendor->store_logo_path) {
                Storage::disk('public')->delete($vendor->store_logo_path);
            }

            $path = $request->file('store_logo')->store('vendors/store/logos', 'public');
            $vendor->store_logo_path = $path;
        }

        // Mettre à jour la bannière
        if ($request->hasFile('store_banner')) {
            if ($vendor->store_banner_path) {
                Storage::disk('public')->delete($vendor->store_banner_path);
            }

            $path = $request->file('store_banner')->store('vendors/store/banners', 'public');
            $vendor->store_banner_path = $path;
        }

        $vendor->save();

        return redirect()->back()
            ->with('success', 'Paramètres de la boutique mis à jour avec succès.');
    }

    /**
     * Afficher la page publique d'un vendeur
     */
    public function show($id)
    {
        $vendor = Vendor::with(['user', 'products' => function($query) {
            $query->where('status', 'active')->latest();
        }])->findOrFail($id);

        // Vérifier si le vendeur est approuvé
        if ($vendor->status !== 'approved') {
            abort(404);
        }

        return view('vendors.show', compact('vendor'));
    }

    /**
     * Afficher les produits d'un vendeur
     */
    public function products($id)
    {
        $vendor = Vendor::with('user')->findOrFail($id);

        if ($vendor->status !== 'approved') {
            abort(404);
        }

        $products = $vendor->products()
            ->where('status', 'active')
            ->latest()
            ->paginate(12);

        return view('vendors.products', compact('vendor', 'products'));
    }

    /**
     * Contacter un vendeur
     */
    public function contactSeller(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
            'product_id' => 'nullable|exists:products,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Envoyer l'email (à implémenter)
        // Mail::to($vendor->user->email)->send(new ContactVendorMail($request->all()));

        return redirect()->back()
            ->with('success', 'Votre message a été envoyé au vendeur.');
    }

    /**
     * Télécharger la liste de prix d'un vendeur
     */
    public function downloadPriceList($vendorId)
    {
        $vendor = Vendor::findOrFail($vendorId);

        // Vérifier si le fichier existe
        if (!$vendor->price_list_path) {
            return redirect()->back()
                ->with('error', 'Ce vendeur n\'a pas de liste de prix disponible.');
        }

        $path = storage_path('app/public/' . $vendor->price_list_path);

        if (!file_exists($path)) {
            return redirect()->back()
                ->with('error', 'Le fichier n\'existe pas.');
        }

        return response()->download($path, 'liste-prix-' . Str::slug($vendor->company_name ?? $vendor->display_name) . '.pdf');
    }



    public function showLoginForm()
{
    return view('vendor.login');
}

/**
 * Traiter la connexion vendeur
 */
public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials, $request->remember)) {
        $request->session()->regenerate();
        
        $user = Auth::user();
        
        // DEBUG: Vérifier ce que contient l'utilisateur
        \Log::info('Connexion vendeur', [
            'user_id' => $user->id,
            'email' => $user->email,
            'role' => $user->role,
            'has_vendor' => $user->vendor ? 'Oui' : 'Non',
            'vendor_status' => $user->vendor ? $user->vendor->status : null
        ]);
        
        // Vérifier si l'utilisateur a un profil vendeur
        if (!$user->vendor) {
            Auth::logout();
            return back()->with('error', 'Vous n\'avez pas de profil vendeur. Veuillez d\'abord vous inscrire.');
        }
        
        // Vérifier si le vendeur est approuvé (maintenant toujours vrai)
        $vendor = $user->vendor;
        
        // Seulement vérifier les statuts problématiques
        if ($vendor->status === 'rejected') {
            Auth::logout();
            return back()->with('error', 'Votre compte vendeur a été rejeté. Contactez le support.');
        }
        
        if ($vendor->status === 'suspended') {
            Auth::logout();
            return back()->with('error', 'Votre compte vendeur est suspendu.');
        }

        // Redirection vers le dashboard (toujours autorisé si approved)
        return redirect()->route('seller.dashboard');
    }

    return back()->with('error', 'Identifiants incorrects.');
}

/**
 * Déconnexion vendeur
 */
public function logout(Request $request)
{
    Auth::logout();
    
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    
    return redirect()->route('seller.login');
}

/**
 * Afficher le formulaire de demande de réinitialisation de mot de passe
 */
public function showLinkRequestForm()
{
    return view('vendor.passwords.email');
}

/**
 * Envoyer le lien de réinitialisation
 */
public function sendResetLinkEmail(Request $request)
{
    $request->validate(['email' => 'required|email']);
    
    // Vérifier que l'utilisateur est un vendeur
    $user = User::where('email', $request->email)->where('role', 'vendor')->first();
    
    if (!$user) {
        return back()->withErrors(['email' => 'Aucun vendeur trouvé avec cette adresse email.']);
    }
    
    // Utiliser le broker par défaut (qui peut être configuré pour 'vendors')
    $status = Password::sendResetLink(
        $request->only('email')
    );
    
    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
}

public function reset(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:8',
    ]);
    
    // Vérifier que l'utilisateur est un vendeur
    $user = User::where('email', $request->email)->where('role', 'vendor')->first();
    
    if (!$user) {
        return back()->withErrors(['email' => 'Cet email n\'appartient pas à un vendeur.']);
    }
    
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
            
            $user->save();
            
            event(new PasswordReset($user));
            
            Auth::login($user);
        }
    );
    
    return $status === Password::PASSWORD_RESET
        ? redirect()->route('seller.dashboard')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
}

}


