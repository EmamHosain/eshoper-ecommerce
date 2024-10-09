<?php

namespace App\Http\Controllers\User;

use App\Models\Brand;
use App\Models\CategorySlider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {
        
        // return response()->json($sliders);


        $categories = Category::withCount('products')->where('status', 1)->latest()->get();
        $trandy_products = Product::with([
            'productImages'
        ])
            ->where('status', 1)
            ->where('popularity', 'trandy')
            ->latest()
            ->limit(12)
            ->get();


        $new_arrived_products = Product::with([
            'productImages'
        ])
            ->where('status', 1)
            ->where('popularity', 'arrived')
            ->latest()
            ->limit(12)
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
