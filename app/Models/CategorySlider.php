<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorySlider extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'slider_image', // This holds the path or URL to the slider image
        'status',
        'heading_one',
        'heading_two',
        'button_text',
        'button_link',
    ];

    /**
     * Get the category that owns the slider.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
