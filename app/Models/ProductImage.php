<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',    // Foreign key for the product
        'product_image', // Path to the product image
    ];

    /**
     * Get the product associated with the image.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
