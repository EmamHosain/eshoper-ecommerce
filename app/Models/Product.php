<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id', // Foreign key for category
        'brand_id',    // Foreign key for brand
        'product_name', // Product name (unique)
        'slug',        // Slug for SEO-friendly URL
        'available',   // Availability status
        'price',       // Product price
        'discount_price', // Discounted price (nullable)
        'is_discount', // Indicates if there's a discount
        'description', // Product description
        'status',      // Status (active/inactive)
        'popularity',
        'quantity',
        'code',
        'information',
        'short_description',
    ];

    /**
     * Get the category associated with the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Get the brand associated with the product.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * The sizes that belong to the product.
     */
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_size'); // Define the pivot table
    }

    /**
     * The colors that belong to the product.
     */
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_product'); // Define the pivot table
    }
    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }
}
