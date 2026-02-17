<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'vendor_id',
        'category_id',
        'subcategory_id',
        'name',
        'slug',
        'short_description',
        'description',
        'price',
        'compare_price',
        'cost_price',
        'wholesale_price',
        'min_quantity',
        'stock_quantity',
        'alert_quantity',
        'sku',
        'barcode',
        'status',
        'is_featured',
        'is_trending',
        'is_bestseller',
        'is_new',
        'is_digital',
        'has_variants',
        'requires_shipping',
        'main_image',
        'images',
        'weight',
        'length',
        'width',
        'height',
        'shipping_class',
        'shipping_cost',
        'estimated_delivery',
        'tax_rate',
        'tax_included',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'brand',
        'model',
        'condition',
        'material',
        'color',
        'size',
        'warranty_period',
        'warranty_terms',
        'specifications',
        'view_count',
        'order_count',
        'review_count',
        'rating',
        'manage_stock',
        'allow_backorder',
        'low_stock_notification',
        'published_at',
        'featured_until',
        'sale_start',
        'sale_end',
    ];

    protected $casts = [
        'images' => 'array',
        'specifications' => 'array',
        'price' => 'decimal:2',
        'compare_price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'wholesale_price' => 'decimal:2',
        'weight' => 'decimal:2',
        'length' => 'decimal:2',
        'width' => 'decimal:2',
        'height' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'tax_rate' => 'decimal:2',
        'rating' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_trending' => 'boolean',
        'is_bestseller' => 'boolean',
        'is_new' => 'boolean',
        'is_digital' => 'boolean',
        'has_variants' => 'boolean',
        'requires_shipping' => 'boolean',
        'tax_included' => 'boolean',
        'manage_stock' => 'boolean',
        'allow_backorder' => 'boolean',
        'low_stock_notification' => 'boolean',
        'published_at' => 'datetime',
        'featured_until' => 'datetime',
        'sale_start' => 'datetime',
        'sale_end' => 'datetime',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
                
                // Assurer l'unicité du slug
                $count = static::where('slug', $product->slug)->count();
                if ($count > 0) {
                    $product->slug = $product->slug . '-' . Str::random(5);
                }
            }
            
            // Générer un SKU automatique si non fourni
            if (empty($product->sku)) {
                $product->sku = 'PROD-' . strtoupper(Str::random(8));
            }
        });

        static::updating(function ($product) {
            if ($product->isDirty('name') && empty($product->slug)) {
                $product->slug = Str::slug($product->name);
                
                // Vérifier l'unicité en excluant l'ID actuel
                $count = static::where('slug', $product->slug)
                    ->where('id', '!=', $product->id)
                    ->count();
                    
                if ($count > 0) {
                    $product->slug = $product->slug . '-' . Str::random(5);
                }
            }
        });
    }

    /**
     * Relation avec le vendeur
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Relation avec la catégorie
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relation avec la sous-catégorie
     */
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    /**
     * Relation avec les variantes
     */
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    /**
     * Relation avec les attributs
     */
    public function attributes()
    {
        return $this->belongsToMany(ProductAttribute::class, 'product_product_attribute');
    }

    /**
     * Relation avec les tags
     */
    public function tags()
    {
        return $this->belongsToMany(ProductTag::class, 'product_product_tag');
    }

    /**
     * Relation avec les avis
     */
   /*  public function reviews()
    {
        return $this->hasMany(Review::class);
    } */

    /**
     * Scope pour les produits actifs
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope pour les produits en vedette
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)
            ->active();
    }

    /**
     * Scope pour les produits tendance
     */
    public function scopeTrending($query)
    {
        return $query->where('is_trending', true)
            ->active();
    }

    /**
     * Scope pour les nouveaux produits
     */
    public function scopeNew($query)
    {
        return $query->where('is_new', true)
            ->active();
    }

    /**
     * Scope pour les meilleures ventes
     */
    public function scopeBestsellers($query)
    {
        return $query->where('is_bestseller', true)
            ->active();
    }

    /**
     * Scope pour les produits d'un vendeur spécifique
     */
    public function scopeByVendor($query, $vendorId)
    {
        return $query->where('vendor_id', $vendorId);
    }

    /**
     * Scope pour les produits en promotion
     */
    public function scopeOnSale($query)
    {
        $now = now();
        return $query->whereNotNull('sale_start')
            ->whereNotNull('sale_end')
            ->where('sale_start', '<=', $now)
            ->where('sale_end', '>=', $now)
            ->active();
    }

    /**
     * Vérifier si le produit est en stock
     */
    public function isInStock(): bool
    {
        if (!$this->manage_stock) {
            return true;
        }
        
        if ($this->allow_backorder) {
            return true;
        }
        
        return $this->stock_quantity > 0;
    }

    /**
     * Vérifier si le produit est en rupture de stock
     */
    public function isOutOfStock(): bool
    {
        return $this->manage_stock && $this->stock_quantity <= 0 && !$this->allow_backorder;
    }

    /**
     * Vérifier si le produit est en promotion
     */
    public function isOnSale(): bool
    {
        if (!$this->sale_start || !$this->sale_end) {
            return false;
        }
        
        $now = now();
        return $now->between($this->sale_start, $this->sale_end);
    }

    /**
     * Calculer le pourcentage de réduction
     */
    public function getDiscountPercentageAttribute(): ?float
    {
        if (!$this->compare_price || $this->compare_price <= $this->price) {
            return null;
        }
        
        $discount = (($this->compare_price - $this->price) / $this->compare_price) * 100;
        return round($discount, 0);
    }

    /**
     * Obtenir le prix de vente (avec promotion si applicable)
     */
    public function getSalePriceAttribute(): float
    {
        if ($this->isOnSale() && $this->compare_price) {
            return $this->compare_price;
        }
        
        return $this->price;
    }

    /**
     * Obtenir l'URL de l'image principale
     */
    public function getMainImageUrlAttribute(): string
    {
        if ($this->main_image && Str::startsWith($this->main_image, 'http')) {
            return $this->main_image;
        }

        if ($this->main_image) {
            return asset('storage/products/' . $this->main_image);
        }

        return asset('images/default-product.jpg');
    }

    /**
     * Obtenir les URLs de toutes les images
     */
    public function getImagesUrlsAttribute(): array
    {
        $images = [];
        
        // Ajouter l'image principale
        if ($this->main_image) {
            $images[] = $this->getMainImageUrlAttribute();
        }
        
        // Ajouter les autres images
        if ($this->images && is_array($this->images)) {
            foreach ($this->images as $image) {
                if (Str::startsWith($image, 'http')) {
                    $images[] = $image;
                } else {
                    $images[] = asset('storage/products/' . $image);
                }
            }
        }
        
        // Si aucune image, utiliser une image par défaut
        if (empty($images)) {
            $images[] = asset('images/default-product.jpg');
        }
        
        return $images;
    }

    /**
     * Obtenir l'URL du produit
     */
    public function getUrlAttribute(): string
    {
        return route('products.show', $this->slug);
    }

    /**
     * Vérifier si le stock est bas
     */
    public function isLowStock(): bool
    {
        return $this->manage_stock && 
               $this->stock_quantity <= $this->alert_quantity && 
               $this->stock_quantity > 0;
    }

    /**
     * Obtenir le statut de stock
     */
    public function getStockStatusAttribute(): string
    {
        if (!$this->manage_stock) {
            return 'available';
        }
        
        if ($this->stock_quantity > 0) {
            return $this->isLowStock() ? 'low' : 'available';
        }
        
        return $this->allow_backorder ? 'backorder' : 'out_of_stock';
    }

    /**
     * Augmenter le compteur de vues
     */
    public function incrementViewCount(): void
    {
        $this->increment('view_count');
    }

    /**
     * Mettre à jour le rating
     */
    public function updateRating(): void
    {
        $avgRating = $this->reviews()->avg('rating') ?? 0;
        $this->update(['rating' => round($avgRating, 2)]);
    }

    /**
     * Formater le prix
     */
    public function formattedPrice(): string
    {
        return number_format($this->price, 2, ',', ' ') . ' €';
    }

    /**
     * Formater le prix de comparaison
     */
    public function formattedComparePrice(): ?string
    {
        if (!$this->compare_price) {
            return null;
        }
        
        return number_format($this->compare_price, 2, ',', ' ') . ' €';
    }

    /**
     * Route key personnalisée
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}