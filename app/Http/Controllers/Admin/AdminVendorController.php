<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Models\Vendor;
use Illuminate\Http\Request;

class AdminVendorController extends Controller
{
    /**
     * Affiche la liste des vendeurs avec filtres et statistiques.
     */
    public function index(Request $request)
    {
        // Statistiques globales pour les KPIs
        $stats = [
            'total'      => Vendor::count(),
            'individual' => Vendor::where('vendor_type', 'individual')->count(),
            'company'    => Vendor::where('vendor_type', 'company')->count(),
            'pending'    => Vendor::where('status', 'pending_review')->count(),
            'approved'   => Vendor::where('status', 'approved')->count(),
            'suspended'  => Vendor::where('status', 'suspended')->count(),
            'rejected'   => Vendor::where('status', 'rejected')->count(),
        ];

        // Requête de base avec chargement de la relation user
        $query = Vendor::with('user');

        // Filtres
        if ($request->filled('type')) {
            $query->where('vendor_type', $request->type);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
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

        // Tri et pagination
        $vendors = $query->orderBy('created_at', 'desc')->paginate(15);

        // Vue partagée avec le superadmin
        return view('admin.vendors.index', compact('vendors', 'stats'));
    }

    /**
     * Affiche les détails d'un vendeur spécifique.
     */
    public function show($id)
    {
        $vendor = Vendor::with('user')->findOrFail($id);
        return view('admin.vendors.show', compact('vendor'));
    }

    /**
     * Supprime un vendeur (soft delete si le modèle utilise SoftDeletes).
     */
    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);

        // Optionnel : empêcher la suppression si le vendeur a des commandes en cours
        // if ($vendor->orders()->where('status', '!=', 'completed')->exists()) {
        //     return redirect()->back()->with('error', 'Impossible de supprimer un vendeur avec des commandes en cours.');
        // }

        $vendor->delete();

        return redirect()->route('admin.vendors.index')
            ->with('success', 'Vendeur supprimé avec succès.');
    }

    /**
     * Met à jour le statut d'un vendeur (approuvé, suspendu, rejeté, etc.).
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending_review,approved,suspended,rejected',
        ]);

        $vendor = Vendor::findOrFail($id);
        $vendor->status = $request->status;
        $vendor->save();

        // Option : envoyer un email de notification au vendeur
        // $vendor->user->notify(new VendorStatusUpdated($vendor));

        return redirect()->back()->with('success', 'Statut mis à jour avec succès.');
    }
}