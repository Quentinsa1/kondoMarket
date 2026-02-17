<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\ProductAttribute;
use App\Models\ProductTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Afficher la liste des produits du vendeur
     */
    public function index(Request $request)
{
    $vendor = Auth::user()->vendor;
    
    $query = $vendor->products()->with(['category', 'subcategory'])->latest();
    
    // Filtres
    if ($request->filled('search')) {
        $query->where(function($q) use ($request) {
            $q->where('name', 'like', "%{$request->search}%")
              ->orWhere('sku', 'like', "%{$request->search}%")
              ->orWhere('description', 'like', "%{$request->search}%");
        });
    }
    
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }
    
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }
    
    // Tri
    if ($request->filled('sort')) {
        $direction = $request->direction == 'desc' ? 'desc' : 'asc';
        $query->orderBy($request->sort, $direction);
    }
    
    $products = $query->paginate(20);
    $categories = Category::active()->get();
    
    // Statistiques
    $activeCount = $vendor->products()->where('status', 'active')->count();
    $pendingCount = $vendor->products()->where('status', 'pending')->count();
    $lowStockCount = $vendor->products()->whereColumn('stock_quantity', '<=', 'alert_quantity')->count();

    return view('vendor.products.index', compact('products', 'categories', 'activeCount', 'pendingCount', 'lowStockCount'));
}
    /**
     * Afficher le formulaire de création de produit
     */
    public function create()
    {
        $vendor = Auth::user()->vendor;
        $categories = Category::active()->with('subcategories')->get();
        $attributes = ProductAttribute::with('values')->get();
        $tags = ProductTag::all();

        return view('vendor.products.create', compact('categories', 'attributes', 'tags'));
    }

    /**
     * Stocker un nouveau produit
     */
    public function store(Request $request)
    {
        $vendor = Auth::user()->vendor;
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'short_description' => 'nullable|string|max:500',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'wholesale_price' => 'nullable|numeric|min:0',
            'min_quantity' => 'required|integer|min:1',
            'stock_quantity' => 'required|integer|min:0',
            'alert_quantity' => 'nullable|integer|min:0',
            'sku' => 'nullable|string|unique:products,sku',
            'barcode' => 'nullable|string',
            'status' => 'required|in:draft,pending,active,inactive',
            'is_featured' => 'boolean',
            'is_trending' => 'boolean',
            'is_bestseller' => 'boolean',
            'is_digital' => 'boolean',
            'requires_shipping' => 'boolean',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'weight' => 'nullable|numeric|min:0',
            'length' => 'nullable|numeric|min:0',
            'width' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
            'shipping_cost' => 'nullable|numeric|min:0',
            'estimated_delivery' => 'nullable|integer|min:0',
            'tax_rate' => 'nullable|numeric|min:0|max:100',
            'brand' => 'nullable|string|max:100',
            'model' => 'nullable|string|max:100',
            'condition' => 'required|in:new,used,refurbished',
            'material' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:50',
            'size' => 'nullable|string|max:50',
            'warranty_period' => 'nullable|string|max:50',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:product_tags,id',
            'attributes' => 'nullable|array',
            'has_variants' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Traitement de l'image principale
        $mainImagePath = null;
        if ($request->hasFile('main_image')) {
            $mainImagePath = $request->file('main_image')->store('products/main', 'public');
        }

        // Traitement des images supplémentaires
        $additionalImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products/gallery', 'public');
                $additionalImages[] = $path;
            }
        }

        // Création du produit
        $productData = $request->only([
            'name', 'category_id', 'subcategory_id', 'short_description', 'description',
            'price', 'compare_price', 'cost_price', 'wholesale_price', 'min_quantity',
            'stock_quantity', 'alert_quantity', 'sku', 'barcode', 'status', 'is_featured',
            'is_trending', 'is_bestseller', 'is_digital', 'requires_shipping', 'weight',
            'length', 'width', 'height', 'shipping_cost', 'estimated_delivery', 'tax_rate',
            'brand', 'model', 'condition', 'material', 'color', 'size', 'warranty_period',
            'has_variants',
        ]);

        $productData['vendor_id'] = $vendor->id;
        $productData['main_image'] = $mainImagePath;
        $productData['images'] = $additionalImages;
        $productData['manage_stock'] = $request->filled('manage_stock');
        $productData['allow_backorder'] = $request->filled('allow_backorder');
        $productData['low_stock_notification'] = $request->filled('low_stock_notification');
        $productData['tax_included'] = $request->filled('tax_included');

        // Date de publication si le produit est actif
        if ($request->status === 'active' && empty($productData['published_at'])) {
            $productData['published_at'] = now();
        }

        // Spécifications techniques
        if ($request->filled('specs_key') && $request->filled('specs_value')) {
            $specifications = [];
            foreach ($request->specs_key as $index => $key) {
                if (!empty($key) && !empty($request->specs_value[$index])) {
                    $specifications[] = [
                        'key' => $key,
                        'value' => $request->specs_value[$index]
                    ];
                }
            }
            $productData['specifications'] = $specifications;
        }

        // Warranty terms
        if ($request->filled('warranty_terms')) {
            $productData['warranty_terms'] = $request->warranty_terms;
        }

        // Créer le produit
        $product = Product::create($productData);

        // Attacher les tags
        if ($request->filled('tags')) {
            $product->tags()->attach($request->tags);
        }

        // Attacher les attributs
        if ($request->filled('attributes')) {
            $product->attributes()->attach($request->attributes);
        }

        // Créer les variantes si demandé
        if ($request->has_variants && $request->filled('variants')) {
            foreach ($request->variants as $variantData) {
                $variantImagePath = null;
                if (isset($variantData['image']) && $variantData['image']) {
                    $variantImagePath = $variantData['image']->store('products/variants', 'public');
                }

                $product->variants()->create([
                    'sku' => $variantData['sku'] ?? null,
                    'name' => $variantData['name'],
                    'attributes' => $variantData['attributes'] ?? [],
                    'price' => $variantData['price'],
                    'compare_price' => $variantData['compare_price'] ?? null,
                    'cost_price' => $variantData['cost_price'] ?? null,
                    'stock_quantity' => $variantData['stock_quantity'] ?? 0,
                    'image' => $variantImagePath,
                    'weight' => $variantData['weight'] ?? null,
                    'is_default' => $variantData['is_default'] ?? false,
                ]);
            }
        }

        return redirect()->route('seller.products.index')
            ->with('success', 'Produit créé avec succès.');
    }

    /**
     * Afficher un produit spécifique
     */
    public function show(Product $product)
    {
        // Vérifier que le produit appartient au vendeur
        if ($product->vendor_id !== Auth::user()->vendor->id) {
            abort(403, 'Accès non autorisé.');
        }

        $product->load(['category', 'subcategory', 'tags', 'attributes', 'variants']);
        
        return view('seller.products.show', compact('product'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(Product $product)
    {
        // Vérifier que le produit appartient au vendeur
        if ($product->vendor_id !== Auth::user()->vendor->id) {
            abort(403, 'Accès non autorisé.');
        }

        $categories = Category::active()->with('subcategories')->get();
        $attributes = ProductAttribute::with('values')->get();
        $tags = ProductTag::all();
        
        $product->load(['tags', 'attributes', 'variants']);
        
        return view('seller.products.edit', compact('product', 'categories', 'attributes', 'tags'));
    }

    /**
     * Mettre à jour un produit
     */
    public function update(Request $request, Product $product)
    {
        // Vérifier que le produit appartient au vendeur
        if ($product->vendor_id !== Auth::user()->vendor->id) {
            abort(403, 'Accès non autorisé.');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'short_description' => 'nullable|string|max:500',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'wholesale_price' => 'nullable|numeric|min:0',
            'min_quantity' => 'required|integer|min:1',
            'stock_quantity' => 'required|integer|min:0',
            'alert_quantity' => 'nullable|integer|min:0',
            'sku' => 'nullable|string|unique:products,sku,' . $product->id,
            'barcode' => 'nullable|string',
            'status' => 'required|in:draft,pending,active,inactive',
            'is_featured' => 'boolean',
            'is_trending' => 'boolean',
            'is_bestseller' => 'boolean',
            'is_digital' => 'boolean',
            'requires_shipping' => 'boolean',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'weight' => 'nullable|numeric|min:0',
            'length' => 'nullable|numeric|min:0',
            'width' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
            'shipping_cost' => 'nullable|numeric|min:0',
            'estimated_delivery' => 'nullable|integer|min:0',
            'tax_rate' => 'nullable|numeric|min:0|max:100',
            'brand' => 'nullable|string|max:100',
            'model' => 'nullable|string|max:100',
            'condition' => 'required|in:new,used,refurbished',
            'material' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:50',
            'size' => 'nullable|string|max:50',
            'warranty_period' => 'nullable|string|max:50',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:product_tags,id',
            'attributes' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Mise à jour de l'image principale
        if ($request->hasFile('main_image')) {
            // Supprimer l'ancienne image
            if ($product->main_image) {
                Storage::disk('public')->delete($product->main_image);
            }
            
            $mainImagePath = $request->file('main_image')->store('products/main', 'public');
            $product->main_image = $mainImagePath;
        }

        // Mise à jour des images supplémentaires
        if ($request->hasFile('images')) {
            // Supprimer les anciennes images
            if ($product->images) {
                foreach ($product->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            
            $additionalImages = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('products/gallery', 'public');
                $additionalImages[] = $path;
            }
            $product->images = $additionalImages;
        }

        // Mise à jour des données
        $productData = $request->only([
            'name', 'category_id', 'subcategory_id', 'short_description', 'description',
            'price', 'compare_price', 'cost_price', 'wholesale_price', 'min_quantity',
            'stock_quantity', 'alert_quantity', 'sku', 'barcode', 'status', 'is_featured',
            'is_trending', 'is_bestseller', 'is_digital', 'requires_shipping', 'weight',
            'length', 'width', 'height', 'shipping_cost', 'estimated_delivery', 'tax_rate',
            'brand', 'model', 'condition', 'material', 'color', 'size', 'warranty_period',
        ]);

        $productData['manage_stock'] = $request->filled('manage_stock');
        $productData['allow_backorder'] = $request->filled('allow_backorder');
        $productData['low_stock_notification'] = $request->filled('low_stock_notification');
        $productData['tax_included'] = $request->filled('tax_included');

        // Date de publication si le produit devient actif
        if ($request->status === 'active' && !$product->published_at) {
            $productData['published_at'] = now();
        }

        // Spécifications techniques
        if ($request->filled('specs_key') && $request->filled('specs_value')) {
            $specifications = [];
            foreach ($request->specs_key as $index => $key) {
                if (!empty($key) && !empty($request->specs_value[$index])) {
                    $specifications[] = [
                        'key' => $key,
                        'value' => $request->specs_value[$index]
                    ];
                }
            }
            $productData['specifications'] = $specifications;
        } elseif (!$request->filled('specs_key')) {
            $productData['specifications'] = null;
        }

        // Warranty terms
        $productData['warranty_terms'] = $request->warranty_terms;

        // Mettre à jour le produit
        $product->update($productData);

        // Synchroniser les tags
        if ($request->filled('tags')) {
            $product->tags()->sync($request->tags);
        } else {
            $product->tags()->detach();
        }

        // Synchroniser les attributs
        if ($request->filled('attributes')) {
            $product->attributes()->sync($request->attributes);
        } else {
            $product->attributes()->detach();
        }

        // Mettre à jour les variantes
        if ($request->filled('variants')) {
            // Supprimer les variantes existantes
            $product->variants()->delete();
            
            // Créer les nouvelles variantes
            foreach ($request->variants as $variantData) {
                $variantImagePath = null;
                if (isset($variantData['image']) && $variantData['image']) {
                    $variantImagePath = $variantData['image']->store('products/variants', 'public');
                }

                $product->variants()->create([
                    'sku' => $variantData['sku'] ?? null,
                    'name' => $variantData['name'],
                    'attributes' => $variantData['attributes'] ?? [],
                    'price' => $variantData['price'],
                    'compare_price' => $variantData['compare_price'] ?? null,
                    'cost_price' => $variantData['cost_price'] ?? null,
                    'stock_quantity' => $variantData['stock_quantity'] ?? 0,
                    'image' => $variantImagePath,
                    'weight' => $variantData['weight'] ?? null,
                    'is_default' => $variantData['is_default'] ?? false,
                ]);
            }
        }

        return redirect()->route('seller.products.index')
            ->with('success', 'Produit mis à jour avec succès.');
    }

    /**
     * Supprimer un produit
     */
    public function destroy(Product $product)
    {
        // Vérifier que le produit appartient au vendeur
        if ($product->vendor_id !== Auth::user()->vendor->id) {
            abort(403, 'Accès non autorisé.');
        }

        // Supprimer les images
        if ($product->main_image) {
            Storage::disk('public')->delete($product->main_image);
        }
        
        if ($product->images) {
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        // Supprimer le produit
        $product->delete();

        return redirect()->route('seller.products.index')
            ->with('success', 'Produit supprimé avec succès.');
    }

    /**
     * Changer le statut d'un produit
     */
    public function toggleStatus(Product $product)
    {
        // Vérifier que le produit appartient au vendeur
        if ($product->vendor_id !== Auth::user()->vendor->id) {
            abort(403, 'Accès non autorisé.');
        }

        $newStatus = $product->status === 'active' ? 'inactive' : 'active';
        $product->update([
            'status' => $newStatus,
            'published_at' => $newStatus === 'active' ? now() : null,
        ]);

        return redirect()->back()
            ->with('success', 'Statut du produit mis à jour.');
    }

    /**
     * Dupliquer un produit
     */
    public function duplicate(Product $product)
    {
        // Vérifier que le produit appartient au vendeur
        if ($product->vendor_id !== Auth::user()->vendor->id) {
            abort(403, 'Accès non autorisé.');
        }

        $newProduct = $product->replicate();
        $newProduct->name = $product->name . ' (Copie)';
        $newProduct->slug = Str::slug($newProduct->name . '-' . Str::random(5));
        $newProduct->sku = 'PROD-' . strtoupper(Str::random(8));
        $newProduct->status = 'draft';
        $newProduct->view_count = 0;
        $newProduct->order_count = 0;
        $newProduct->review_count = 0;
        $newProduct->rating = 0;
        $newProduct->published_at = null;
        $newProduct->save();

        // Dupliquer les tags
        $newProduct->tags()->attach($product->tags->pluck('id'));

        // Dupliquer les attributs
        $newProduct->attributes()->attach($product->attributes->pluck('id'));

        // Dupliquer les variantes
        foreach ($product->variants as $variant) {
            $newVariant = $variant->replicate();
            $newVariant->product_id = $newProduct->id;
            $newVariant->save();
        }

        return redirect()->route('seller.products.edit', $newProduct)
            ->with('success', 'Produit dupliqué avec succès.');
    }

    /**
     * Export des produits
     */
    public function export(Request $request)
    {
        $vendor = Auth::user()->vendor;
        $products = $vendor->products()->with(['category', 'subcategory'])->get();

        // Générer CSV
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="produits_' . date('Y-m-d') . '.csv"',
        ];

        $callback = function() use ($products) {
            $file = fopen('php://output', 'w');
            
            // En-têtes
            fputcsv($file, [
                'Nom', 'SKU', 'Catégorie', 'Sous-catégorie', 'Prix', 'Stock',
                'Statut', 'Date création'
            ]);
            
            // Données
            foreach ($products as $product) {
                fputcsv($file, [
                    $product->name,
                    $product->sku ?? '',
                    $product->category->name,
                    $product->subcategory->name ?? '',
                    $product->price,
                    $product->stock_quantity,
                    $product->status,
                    $product->created_at->format('Y-m-d'),
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}