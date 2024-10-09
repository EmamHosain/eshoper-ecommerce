<?php

namespace App\Http\Controllers\User;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {
        $categories = Category::withCount('products')->where('status', 1)->latest()->get();
        $trandy_products = Product::with([
            'productImages' => function ($query) {
                $query->first();
            }
        ])
            ->where('status', 1)
            ->where('popularity', 'trandy')
            ->latest()
            ->get();
        // return response()->json($trandy_products);


        $new_arrived_products = Product::with([
            'productImages' => function ($query) {
                $query->first();
            }
        ])
            ->where('status', 1)
            ->where('popularity', 'arrived')
            ->latest()
            ->get();

        $brands = Brand::where('status', 1)->latest()->get();

        return view('pages.frontend.index', [
            'categories' => $categories,
            'trandy_products' => $trandy_products,
            'new_arrived_products' => $new_arrived_products,
            'brands' => $brands
        ]);
    }
}
