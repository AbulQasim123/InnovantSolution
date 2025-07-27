<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProductImage extends Model
{
    protected $fillable = [
        'product_id',
        'images',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected function images(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? asset("storage/uploads/products_images/$value") : null,
            set: fn($value) => pathinfo($value, PATHINFO_BASENAME)
        );
    }
}
