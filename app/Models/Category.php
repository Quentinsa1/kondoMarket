<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'image',
        'product_count',
        'order',
        'is_active',
    ];

    /**
     * Relation avec les sous-catégories
     */
    public function subcategories(): HasMany
    {
        return $this->hasMany(Subcategory::class);
    }

    /**
     * Relation avec les vendeurs
     */
    public function vendors(): BelongsToMany
    {
        return $this->belongsToMany(Vendor::class, 'vendor_categories');
    }

    /**
     * Relation avec les produits
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Scope pour les catégories actives
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
     * Obtenir l'URL de l'image
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image && str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        return $this->image ? asset('storage/categories/' . $this->image) : asset('images/default-category.jpg');
    }

    /**
     * Mettre à jour le compteur de produits
     */
    public function updateProductCount(): void
    {
        $this->update([
            'product_count' => $this->products()->count() + 
                $this->subcategories()->withCount('products')->get()->sum('products_count')
        ]);
    }

    /**
     * Vérifier si la catégorie a des sous-catégories
     */
    public function hasSubcategories(): bool
    {
        return $this->subcategories()->exists();
    }
}