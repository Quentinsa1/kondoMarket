<?php

namespace App\Http\Controllers\Admin;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class AdminProductController extends Controller
{
    /**
     * Affiche la liste des produits avec filtres et statistiques.
     */
    public function index(Request $request)
    {
        // Statistiques pour les KPIs
        $stats = [
            'total'    => Product::count(),
            'pending'  => Product::where('status', 'pending')->count(),
            'approved' => Product::where('status', 'approved')->count(),
            'rejected' => Product::where('status', 'rejected')->count(),
        ];

        $query = Product::with('vendor.user'); // Charge le vendeur et son utilisateur

        // Filtres
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('vendor_id')) {
            $query->where('vendor_id', $request->vendor_id);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('vendor', function ($vendorQuery) use ($search) {
                      $vendorQuery->where('company_name', 'like', "%{$search}%")
                                  ->orWhere('display_name', 'like', "%{$search}%");
                  });
            });
        }

        // Tri
        $query->orderBy('created_at', 'desc');

        $products = $query->paginate(15);

        return view('admin.products.index', compact('products', 'stats'));
    }

    /**
     * Affiche les détails d'un produit.
     */
    public function show($id)
    {
        $product = Product::with('vendor.user', 'category', 'subcategory')->findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Supprime un produit (soft delete).
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produit supprimé avec succès.');
    }

    /**
     * Met à jour le statut d'un produit (approuver, rejeter, etc.)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $product = Product::findOrFail($id);
        $product->status = $request->status;
        $product->save();

        return redirect()->back()->with('success', 'Statut mis à jour.');
    }
}