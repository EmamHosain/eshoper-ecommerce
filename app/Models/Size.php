<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $fillable = [
        'size', // The size name (must be unique)
    ];

    /**
     * The products that belong to the size.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_size'); // Define the pivot table
    }
}
