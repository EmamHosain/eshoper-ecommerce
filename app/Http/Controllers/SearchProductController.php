<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchProductController extends Controller
{
    public function search(Request $request)
    {
        // Initialize results
        $query = $request->query('query');
        $results = [];
        // Fetch results with eager loading and only necessary fields
        $results = Product::with(
            'productImages'
        )
            ->whereHas('productImages', function ($query) {
                if (!empty($query->product_image)) {
                    $query->select('product_image');
                }
            })
            ->select('id', 'short_description', 'product_name', 'slug')
            ->where('status', 1)
            ->where('product_name', 'LIKE', "%" . $query . "%")
            ->get();


        return response()->json([
            'view' => view('pages.frontend.component.search-content', [
                'products' => $results
            ])->render(),
        ]);
    }
}
