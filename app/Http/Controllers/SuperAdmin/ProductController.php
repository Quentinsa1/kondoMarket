<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Affiche la liste des produits
     */
    public function index(Request $request)
    {
        // Statistiques globales
        $stats = [
            'total' => Product::count(),
            'active' => Product::where('status', 'active')->count(),
            'inactive' => Product::where('status', 'inactive')->count(),
            'draft' => Product::where('status', 'draft')->count(),
            'out_of_stock' => Product::where('manage_stock', true)->where('stock_quantity', '<=', 0)->count(),
            'featured' => Product::where('is_featured', true)->count(),
        ];

        // Requête de base avec relations
        $query = Product::with(['vendor', 'category']);

        // Filtres
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('vendor_id')) {
            $query->where('vendor_id', $request->vendor_id);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('stock_status')) {
            if ($request->stock_status === 'out_of_stock') {
                $query->where('manage_stock', true)->where('stock_quantity', '<=', 0);
            } elseif ($request->stock_status === 'low_stock') {
                $query->whereRaw('manage_stock = 1 AND stock_quantity <= alert_quantity AND stock_quantity > 0');
            } elseif ($request->stock_status === 'in_stock') {
                $query->where(function($q) {
                    $q->where('manage_stock', false)
                      ->orWhere('stock_quantity', '>', 0);
                });
            }
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('vendor', function ($vendorQuery) use ($search) {
                      $vendorQuery->where('display_name', 'like', "%{$search}%")
                                  ->orWhere('company_name', 'like', "%{$search}%");
                  });
            });
        }

        // Tri
        $query->orderBy('created_at', 'desc');

        // Pagination
        $products = $query->paginate(15);

        // Pour les filtres
        $vendors = Vendor::orderBy('created_at', 'desc')->get(['id', 'display_name', 'company_name', 'vendor_type']);
        $categories = Category::orderBy('name')->get(['id', 'name']);

        return view('superadmin.products.index', compact('products', 'stats', 'vendors', 'categories'));
    }

    /**
     * Affiche les détails d'un produit
     */
    public function show($id)
    {
        $product = Product::with(['vendor', 'category', 'subcategory', 'variants'])->findOrFail($id);
        return view('superadmin.products.show', compact('product'));
    }

    /**
     * Supprime un produit
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        // Supprimer les images associées
        if ($product->main_image && !str_starts_with($product->main_image, 'http')) {
            Storage::disk('public')->delete('products/' . $product->main_image);
        }
        if ($product->images && is_array($product->images)) {
            foreach ($product->images as $image) {
                if (!str_starts_with($image, 'http')) {
                    Storage::disk('public')->delete('products/' . $image);
                }
            }
        }
        $product->delete();

        return redirect()->route('superadmin.products.index')
            ->with('success', 'Produit supprimé avec succès.');
    }

    /**
     * Met à jour le statut d'un produit
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:active,inactive,draft',
        ]);

        $product = Product::findOrFail($id);
        $product->status = $request->status;
        $product->save();

        return redirect()->back()->with('success', 'Statut du produit mis à jour.');
    }
}