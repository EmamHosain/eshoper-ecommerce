<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WishlistController extends Controller
{
    public function wishlistPage()
    {
        $product_ids = session()->get('wishlist', []);
        // return response()->json($product_ids);

        $products = Product::with('productImages')
            ->where('status', 1)->whereIn('id', $product_ids)->get();


        return view('pages.frontend.add-to-wishlist', [
            'products' => $products
        ]);
    }

    public function productAddToWishlist(Request $request)
    {
        // Get the product ID from the request
        $productId = $request->input('product_id');

        // Retrieve the wishlist array from the session, or initialize an empty array if it doesn't exist
        $wishlist = session()->get('wishlist', []);

        // Add the new product ID to the wishlist array if it's not already present
        if (!in_array($productId, $wishlist)) {
            $wishlist[] = $productId;
        }

        // Store the updated wishlist array in the session
        session()->put('wishlist', $wishlist);

        return response()->json([
            'success' => 'Product added to wishlist successfully.',
            'wishlist_count' => count($wishlist)
        ]);
    }



    public function productDeleteToWishlist(Request $request)
    {
        // Get the product ID from the request
        $productId = $request->input('product_id');

        // Retrieve the wishlist array from the session
        $wishlist = session()->get('wishlist', []);


        // Check if the product exists in the wishlist
        if (($key = array_search($productId, $wishlist)) !== false) {
            // Remove the product from the wishlist
            unset($wishlist[$key]);

            // Re-index the array after removal
            $wishlist = array_values($wishlist);

            // Store the updated wishlist back into the session
            session()->put('wishlist', $wishlist);

            return response()->json([
                'success' => 'Product removed from wishlist successfully.',
            ]);
        }

        return response()->json([
            'error' => 'Product not found in wishlist.'
        ]);
    }


}
