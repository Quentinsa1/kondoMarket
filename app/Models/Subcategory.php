<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'icon',
        'image',
        'product_count',
        'order',
        'is_active',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subcategory) {
            if (empty($subcategory->slug)) {
                $subcategory->slug = Str::slug($subcategory->name);
            }
        });

        static::updating(function ($subcategory) {
            if ($subcategory->isDirty('name') && empty($subcategory->slug)) {
                $subcategory->slug = Str::slug($subcategory->name);
            }
        });
    }

    /**
     * Relation avec la catégorie parente
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relation avec les produits
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Relation avec les vendeurs (via leurs produits)
     */
    public function vendors()
    {
        return $this->hasManyThrough(Vendor::class, Product::class);
    }

    /**
     * Scope pour les sous-catégories actives
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope pour trier par ordre
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('name');
    }

    /**
     * Scope pour rechercher par terme
     */
    public function scopeSearch($query, $term)
    {
        return $query->where('name', 'like', "%{$term}%")
            ->orWhere('description', 'like', "%{$term}%");
    }

    /**
     * Vérifier si la sous-catégorie a des produits
     */
    public function hasProducts(): bool
    {
        return $this->products()->exists();
    }

    /**
     * Obtenir l'URL complète de la sous-catégorie
     */
    public function getUrlAttribute(): string
    {
        return route('categories.subcategory', [
            'category' => $this->category->slug,
            'subcategory' => $this->slug
        ]);
    }

    /**
     * Obtenir l'URL de l'image
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image && Str::startsWith($this->image, 'http')) {
            return $this->image;
        }

        if ($this->image) {
            return asset('storage/subcategories/' . $this->image);
        }

        // Si la sous-catégorie n'a pas d'image, utiliser celle de la catégorie parente
        return $this->category->image_url;
    }

    /**
     * Mettre à jour le compteur de produits
     */
    public function updateProductCount(): void
    {
        $this->update([
            'product_count' => $this->products()->count()
        ]);
    }

    /**
     * Obtenir les statistiques
     */
    public function getStatsAttribute(): array
    {
        return [
            'products' => $this->product_count,
            'vendors' => $this->vendors()->count(),
            'active_products' => $this->products()->active()->count(),
        ];
    }

    /**
     * Route key personnalisée
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}