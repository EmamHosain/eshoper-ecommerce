<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name',
        'slug',
        'status',
        'category_logo', // Nullable, can hold the image path or URL
    ];

    /**
     * Get the products associated with the category.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function sliders()
    {
        return $this->hasMany(CategorySlider::class);
    }
}
