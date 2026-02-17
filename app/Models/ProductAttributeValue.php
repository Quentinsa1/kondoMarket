<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'attribute_id',
        'value',
        'color_code',
        'image',
        'order',
    ];

    /**
     * Relation avec l'attribut
     */
    public function attribute()
    {
        return $this->belongsTo(ProductAttribute::class);
    }

    /**
     * Obtenir l'URL de l'image
     */
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        return asset('storage/attributes/' . $this->image);
    }
}