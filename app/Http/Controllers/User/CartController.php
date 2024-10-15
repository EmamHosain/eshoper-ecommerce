<?php

namespace App\Http\Controllers\User;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class CartController extends Controller
{
    public function addToCartPage()
    {
        $carts = session()->get('cart', []);
        // return response()->json($carts);
        return view('pages.frontend.add-to-cart');
    }



    public function productAddToCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'color' => 'nullable|exists:colors,id',
            'size' => 'nullable|exists:sizes,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Something went wrong'
            ]);
        }

        $product_id = $request->input('product_id');
        $color = $request->input('color');
        $size = $request->input('size');
        $quantity = $request->input('quantity');

    
        if (!empty($color)) {
            $color = Color::where('id', $color)->first()->color_name;
        }
        if (!empty($size)) {
            $size = Size::where('id', $size)->first()->size_name;
        }

        $product = Product::with('productImages')
            ->find($product_id);

        $cart_items = session()->get('cart', []);

        if (isset($cart_items[$product_id])) {
            $cart_items[$product_id]['quantity']++;
        } else {
            $price = $product->is_discount ? $product->discount_price : $product->price;
            $cart_items[$product_id] = [
                'id' => $product->id,
                'name' => $product->product_name,
                'image' => $product->productImages->first()->product_image,
                'color' => $color ?? 'Empty',
                'size' => $size ?? 'Empty',
                'price' => $price,
                'quantity' => $quantity ?? 1,
            ];
        }



        session()->put('cart', $cart_items);


        return response()->json([
            'success' => 'Product added to cart successfully.',
            'cart_count' => count($cart_items)
        ]);

    }


    public function updateCartQuantity(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Something went wrong'
            ]);
        }

        $product_id = $request->input('product_id');
        $quanaity = $request->input('quantity');

        $cart = session()->get('cart', []);
        if (isset($cart[$product_id])) {
            $cart[$product_id]['quantity'] = $quanaity;
            session()->put('cart', $cart);

        }

        $notification = [
            'success' => 'Quantity updated successfully.'
        ];
        return response()->json($notification);
    }


    public function deleteCartItem(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Something went wrong'
            ]);
        }
        $cart = session()->get('cart', []);
        if (isset($cart[$request->input('product_id')])) {
            unset($cart[$request->input('product_id')]);
            session()->put('cart', $cart);
        }
        return response()->json([
            'success' => 'Product removed to cart successfully.',
        ]);

    }



}
