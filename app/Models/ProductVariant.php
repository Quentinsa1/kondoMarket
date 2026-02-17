<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'sku',
        'barcode',
        'name',
        'attributes',
        'price',
        'compare_price',
        'cost_price',
        'stock_quantity',
        'image',
        'weight',
        'is_default',
        'is_active',
    ];

    protected $casts = [
        'attributes' => 'array',
        'price' => 'decimal:2',
        'compare_price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'weight' => 'decimal:2',
        'is_default' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Relation avec le produit
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Obtenir l'URL de l'image
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            if (str_starts_with($this->image, 'http')) {
                return $this->image;
            }
            return asset('storage/products/variants/' . $this->image);
        }

        // Utiliser l'image principale du produit si aucune image spécifique
        return $this->product->main_image_url;
    }

    /**
     * Vérifier si la variante est en stock
     */
    public function isInStock(): bool
    {
        if (!$this->product->manage_stock) {
            return true;
        }

        if ($this->product->allow_backorder) {
            return true;
        }

        return $this->stock_quantity > 0;
    }
}