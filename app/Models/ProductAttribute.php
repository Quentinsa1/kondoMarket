<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'display_name',
        'type',
        'is_filterable',
        'is_visible',
        'order',
    ];

    protected $casts = [
        'is_filterable' => 'boolean',
        'is_visible' => 'boolean',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($attribute) {
            if (empty($attribute->slug)) {
                $attribute->slug = Str::slug($attribute->name);
            }
        });
    }

    /**
     * Relation avec les valeurs
     */
    public function values()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }

    /**
     * Relation avec les produits
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_product_attribute');
    }
}