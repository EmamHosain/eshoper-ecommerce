<?php

namespace App\Http\Controllers\User;

use App\Models\Size;
use App\Models\Color;
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


    public function searchByProduct()
    {
        // $all_product = Product::with('productImages')->where('status', 1)->latest()->paginate(12);
        $all_product_count = Product::count();

        // Count products where price or discount_price is between 0 and 100
        $product_0_to_100 = Product::where('status', 1)
            ->where(function ($query) {
                $query->where(function ($q) {
                    // Products without discount (use regular price)
                    $q->where('is_discount', 0)
                        ->where('price', '>', 0)
                        ->where('price', '<', 100);
                })
                    ->orWhere(function ($q) {
                        // Products with discount (use discount price)
                        $q->where('is_discount', 1)
                            ->where('discount_price', '>', 0)
                            ->where('discount_price', '<', 100);
                    });
            })
            ->count();


        $product_100_to_200 = Product::where('status', 1)
            ->where(function ($query) {
                $query->where(function ($q) {
                    // Products without discount (use regular price)
                    $q->where('is_discount', 0)
                        ->where('price', '>', 100)
                        ->where('price', '<', 200);
                })
                    ->orWhere(function ($q) {
                        // Products with discount (use discount price)
                        $q->where('is_discount', 1)
                            ->where('discount_price', '>', 100)
                            ->where('discount_price', '<', 200);
                    });
            })
            ->count();


        $product_200_to_300 = Product::where('status', 1)
            ->where(function ($query) {
                $query->where(function ($q) {
                    // Products without discount (use regular price)
                    $q->where('is_discount', 0)
                        ->where('price', '>', 200)
                        ->where('price', '<', 300);
                })
                    ->orWhere(function ($q) {
                        // Products with discount (use discount price)
                        $q->where('is_discount', 1)
                            ->where('discount_price', '>', 200)
                            ->where('discount_price', '<', 300);
                    });
            })
            ->count();

        $product_300_to_400 = Product::where('status', 1)
            ->where(function ($query) {
                $query->where(function ($q) {
                    // Products without discount (use regular price)
                    $q->where('is_discount', 0)
                        ->where('price', '>', 300)
                        ->where('price', '<', 400);
                })
                    ->orWhere(function ($q) {
                        // Products with discount (use discount price)
                        $q->where('is_discount', 1)
                            ->where('discount_price', '>', 300)
                            ->where('discount_price', '<', 400);
                    });
            })
            ->count();


        $product_400_to_500 = Product::where('status', 1)
            ->where(function ($query) {
                $query->where(function ($q) {
                    // Products without discount (use regular price)
                    $q->where('is_discount', 0)
                        ->where('price', '>', 400)
                        ->where('price', '<', 500);
                })
                    ->orWhere(function ($q) {
                        // Products with discount (use discount price)
                        $q->where('is_discount', 1)
                            ->where('discount_price', '>', 400)
                            ->where('discount_price', '<', 500);
                    });
            })
            ->count();


        $product_greater_than_500 = Product::where('status', 1)
            ->where(function ($query) {
                $query->where(function ($q) {
                    // Products without discount (use regular price)
                    $q->where('is_discount', 0)
                        ->where('price', '>=', 500);
                })
                    ->orWhere(function ($q) {
                        // Products with discount (use discount price)
                        $q->where('is_discount', 1)
                            ->where('discount_price', '>=', 500);
                    });
            })
            ->count();





        // Get all colors with the count of products for each color,
        $colors_with_product_count = Color::withCount([
            'products as product_count' => function ($query) {
                // Count all products with status = 1 (regardless of discount)
                $query->where('status', 1);
            }
        ])
            ->whereHas('products', function ($query) {
                // Ensure the color is only included if it has products with status = 1
                $query->where('status', 1);
            })
            ->get();
        // return response()->json($colors_with_product_count);
        $total_product_count_with_color = $colors_with_product_count->sum('product_count');




        // Get all sizes with the count of products for each size, 
        $sizes_with_product_count = Size::withCount([
            'products as product_count' => function ($query) {
                // Count all products with status = 1 (regardless of discount)
                $query->where('status', 1);
            }
        ])
            ->whereHas('products', function ($query) {
                // Ensure the color is only included if it has products with status = 1
                $query->where('status', 1);
            })
            ->get();
        $total_product_count_with_size = $sizes_with_product_count->sum('product_count');


        // return response()->json($colors_with_product_count);




















        return view('pages.frontend.product-sorting', [
            'all_product_count' => $all_product_count,
            'product_0_to_100' => $product_0_to_100,
            'product_100_to_200' => $product_100_to_200,
            'product_200_to_300' => $product_200_to_300,
            'product_300_to_400' => $product_300_to_400,
            'product_400_to_500' => $product_400_to_500,
            'product_greater_than_500' => $product_greater_than_500,

            // total product count with color
            'total_product_count_with_color' => $total_product_count_with_color,
            'total_product_count_with_size' => $total_product_count_with_size,

            // all products
            // 'all_product' => $all_product,

            // products count as color wise
            'product_count_with_color' => $colors_with_product_count,
            'sizes_with_product_count' => $sizes_with_product_count


        ]);


    }




    public function filterProducts(Request $request)
    {
        // Retrieve input values
        $sizes = $request->input('sizes', []);
        $colors = $request->query('colors', []);
        $category = $request->input('category');



        if ($request->ajax()) {

            $products = Product::with(['sizes', 'colors', 'category'])
                ->when(!empty($colors), function ($query) use ($colors) {
                    $query->whereHas('colors', function ($query) use ($colors) {
                        $query->whereIn('id', $colors);
                    });
                })
                ->when(!empty($sizes), function ($query) use ($sizes) {
                    $query->whereHas('sizes', function ($query) use ($sizes) {
                        $query->whereIn('id', $sizes);
                    });
                })
                ->when(
                    !empty($category),
                    function ($query) use ($category) {
                        $query->where('category_id', $category);
                    }



                )->paginate(12);

            return response()->json([
                'view' => view('pages.frontend.product-list', compact('products'))->render(),
            ]);
        }

    }





}
