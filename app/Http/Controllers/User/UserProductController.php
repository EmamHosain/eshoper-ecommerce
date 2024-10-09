<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserProductController extends Controller
{
    public function productDetails($id, $slug)
    {
        $product = Product::with(['productImages', 'sizes', 'colors'])->where('id', $id)->where('slug', $slug)->first();

        // return response()->json($product);

        $related_products_with_category = Product::with([
            'productImages' 
        ])->where('category_id', $product->category_id)
            ->whereNot('id', $product->id)
            ->latest()->get();

        return view('pages.frontend.product-details', [
            'product' => $product,
            'relatedProducts' => $related_products_with_category
        ]);

    }
}
