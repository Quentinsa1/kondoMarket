<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    /**
     * Affiche la liste des vendeurs
     */
    public function index(Request $request)
    {
        // Statistiques globales
        $stats = [
            'total' => Vendor::count(),
            'individual' => Vendor::where('vendor_type', 'individual')->count(),
            'company' => Vendor::where('vendor_type', 'company')->count(),
            'pending' => Vendor::where('status', 'pending_review')->count(),
            'approved' => Vendor::where('status', 'approved')->count(),
            'suspended' => Vendor::where('status', 'suspended')->count(),
            'rejected' => Vendor::where('status', 'rejected')->count(),
        ];

        // Requête de base avec chargement de la relation user
        $query = Vendor::with('user');

        // Filtre par type (individuel/entreprise)
        if ($request->filled('type')) {
            $query->where('vendor_type', $request->type);
        }

        // Filtre par statut
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Recherche par nom, email, téléphone
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('display_name', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('email', 'like', "%{$search}%")
                                ->orWhere('name', 'like', "%{$search}%");
                  });
            });
        }

        // Tri
        $query->orderBy('created_at', 'desc');

        // Pagination
        $vendors = $query->paginate(15);

        return view('admin.vendors.index', compact('vendors', 'stats'));
    }

    /**
     * Affiche les détails d'un vendeur
     */
    public function show($id)
    {
        $vendor = Vendor::with('user')->findOrFail($id);
        return view('admin.vendors.show', compact('vendor'));
    }

    /**
     * Supprime un vendeur (soft delete ou hard delete selon votre logique)
     */
    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);
        
        // Optionnel : supprimer également l'utilisateur associé
        // $vendor->user->delete();
        
        $vendor->delete();

        return redirect()->route('admin.vendors.index')
            ->with('success', 'Vendeur supprimé avec succès.');
    }

    /**
     * Met à jour le statut d'un vendeur (approuver, suspendre, rejeter)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending_review,approved,suspended,rejected',
        ]);

        $vendor = Vendor::findOrFail($id);
        $vendor->status = $request->status;
        $vendor->save();

        // Optionnel : envoyer un email au vendeur pour l'informer du changement

        return redirect()->back()->with('success', 'Statut mis à jour.');
    }
}