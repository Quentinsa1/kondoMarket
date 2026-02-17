<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Afficher la liste des catégories principales
     */
    public function index()
    {
        $categories = Category::active()
            ->withCount('subcategories')
            ->ordered()
            ->get();
        
        $data = [
            'categories' => $categories,
            'featuredCategories' => Category::active()
                ->orderBy('product_count', 'desc')
                ->take(5)
                ->get(),
            'pageTitle' => 'Toutes les catégories - Kondo Market',
            'metaDescription' => 'Parcourez toutes les catégories de produits sur Kondo Market. Électronique, mode, maison, santé, sports et plus.',
        ];
        
        return view('categories.index', $data);
    }

    /**
     * Afficher une catégorie spécifique avec ses sous-catégories
     */
    public function show($id)
    {
        // Rechercher par slug ou ID
        $category = Category::where('id', $id)
            ->orWhere('slug', $id)
            ->firstOrFail();
        
        $data = [
            'category' => $category,
            'subcategories' => $category->subcategories()->active()->ordered()->get(),
            'products' => Product::where('category_id', $category->id)
                ->active()
                ->latest()
                ->paginate(12),
            'trendingProducts' => Product::trending()->take(6)->get(),
            'relatedCategories' => Category::active()
                ->where('id', '!=', $category->id)
                ->inRandomOrder()
                ->take(4)
                ->get(),
            'pageTitle' => $category->name . ' - Kondo Market',
            'metaDescription' => $category->description ?: 'Achetez ' . $category->name . ' en gros sur Kondo Market. Produits de qualité, prix compétitifs, fournisseurs vérifiés.',
        ];
        
        return view('categories.show', $data);
    }

    /**
     * Afficher une sous-catégorie spécifique
     */
    public function showSubcategory($categorySlug, $subcategorySlug)
    {
        $category = Category::where('slug', $categorySlug)
            ->orWhere('id', $categorySlug)
            ->firstOrFail();
            
        $subcategory = Subcategory::where('category_id', $category->id)
            ->where('slug', $subcategorySlug)
            ->orWhere('id', $subcategorySlug)
            ->firstOrFail();
        
        $data = [
            'category' => $category,
            'subcategory' => $subcategory,
            'products' => Product::where('subcategory_id', $subcategory->id)
                ->active()
                ->latest()
                ->paginate(12),
            'breadcrumb' => [
                ['name' => $category->name, 'url' => route('categories.show', $category->slug)],
                ['name' => $subcategory->name, 'url' => route('categories.subcategory', [$category->slug, $subcategory->slug])],
            ],
            'pageTitle' => $subcategory->name . ' - ' . $category->name . ' - Kondo Market',
            'metaDescription' => 'Produits ' . $subcategory->name . ' en gros. ' . $category->name . ' de qualité sur Kondo Market.',
        ];
        
        return view('categories.subcategory', $data);
    }

    /**
     * API pour récupérer les sous-catégories d'une catégorie (AJAX)
     */
    public function getSubcategories(Request $request)
    {
        $categoryId = $request->input('category_id');
        
        $subcategories = Subcategory::where('category_id', $categoryId)
            ->active()
            ->ordered()
            ->get(['id', 'name']);
            
        return response()->json($subcategories);
    }

    /**
     * Rechercher des catégories (pour l'autocomplete)
     */
    public function search(Request $request)
    {
        $query = $request->input('q');
        
        $categories = Category::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->active()
            ->take(10)
            ->get(['id', 'name', 'slug']);
            
        return response()->json($categories);
    }
}