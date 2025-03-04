<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $fillable = [
        'color_name', // The name of the color (must be unique)
    ];

    /**
     * The products that belong to the color.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'color_product'); // Define the pivot table
    }
}
