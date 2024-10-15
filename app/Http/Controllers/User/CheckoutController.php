<?php

namespace App\Http\Controllers\User;

use App\Models\ShippingManage;
use Carbon\Carbon;
use App\Models\City;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Country;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\CustomerAddress;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;


class CheckoutController extends Controller
{

    public function checkoutPage()
    {

        $id = Auth::id();
        $customer = CustomerAddress::where('user_id', $id)->first();

        $shipping = ShippingManage::where('status', 1)->latest()->get();

        return view('pages.frontend.checkout', [
            'customer' => $customer,
            'shipping_area' => $shipping
        ]);
    }


    // apply coupon 
    public function applyCoupon(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'coupon_code' => 'required|string|exists:coupons,code'
        ]);
        $coupon_code = $request->input('coupon_code');
        $coupon = Coupon::where('code', $coupon_code)->first();

        if ($validator->fails() || empty($coupon)) {
            return response()->json([
                'error' => 'Invalid Coupon'
            ]);
        }

        $current_date_time = Carbon::now();
        if (!empty($coupon->starts_at)) {
            $startDate = Carbon::createFromDate('Y-m-d h:i:s', $coupon->starts_at);

            // if current date time is less than start date time
            if ($current_date_time->lt($startDate)) {
                return response()->json([
                    'error' => 'Invalid Coupon'
                ]);
            }
        }


        if (!empty($coupon->expires_at)) {
            $endDate = Carbon::createFromDate('Y-m-d h:i:s', $coupon->expires_at);

            // if current date time is greater than end date time
            if ($current_date_time->gt($endDate)) {
                return response()->json([
                    'error' => 'Invalid Coupon'
                ]);
            }
        }


        session()->put('coupon', $coupon);

        return response()->json([
            'success' => 'Coupon applied'
        ]);




    }

    public function additionWishShippingChargeToTototal(Request $request)
    {
        $shipping_area_id = $request->input('shipping_area');

        $shipping = ShippingManage::find($shipping_area_id);

        $cart = session()->get('cart', []);
        $shipping_charge_with_total = (int) $shipping->amount;


        if (isset($cart) && count($cart) > 0) {
            foreach ($cart as $item) {
                $shipping_charge_with_total += $item['price'] * $item['quantity'];
            }
        }
        return response()->json([
            'total_amount' => round($shipping_charge_with_total),
            'shipping_cost' => $shipping->amount
        ]);
    }




    public function checkoutSubmit(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip' => 'required|string|max:20',
            'shipping_area' => 'required|exists:shipping_manages,id',
            'payment_method' => 'required|in:cash_on_delivery,nagad,bkash',
        ]);

        try {
            // Check if validation fails
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $payment_method_type = $request->input('payment_method');
            if (empty($payment_method_type)) {
                return response()->json(['error_message' => 'Please select payment method'], 400);
            }

            $user = Auth::user();
            $order = new Order();

            $cart = session()->get('cart', []);
            if (empty($cart)) {
                return response()->json(['error_message' => 'Your cart is empty!'], 400);
            }

            $grand_total = 0;
            $sub_total = 0;

            foreach ($cart as $item) {
                $sub_total += $item['price'] * $item['quantity'];
            }

            $shipping = ShippingManage::find($request->input('shipping_area'));
            $grand_total = (float) $sub_total + (float) $shipping->amount; // Add sub_total to grand_total

            $order->grand_total = $grand_total;
            $order->sub_total = $sub_total;
            $order->coupon_code = $request->input('coupon_code');
            $order->notes = $request->input('notes');
            $order->user_id = $user->id;
            $order->shipping_manage_id = $shipping->id;

            // Shipping Address
            $order->first_name = $request->input('first_name');
            $order->last_name = $request->input('last_name');
            $order->email = $request->input('email');
            $order->mobile = $request->input('mobile');
            $order->address = $request->input('address');
            $order->city = $request->input('city');
            $order->state = $request->input('state');
            $order->zip = $request->input('zip');
            $order->peyment_method_type = $request->input('payment_method');

            $order_code = IdGenerator::generate(['table' => 'orders', 'field' => 'order_code', 'length' => 10, 'prefix' => 'INV-']);
            $order->order_code = $order_code;

            // Save the order to the database
            $order->save();

            // Save/update customer address
            CustomerAddress::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip,
                    'shipping_manage_id' => $shipping->id,
                ]
            );

            // Store product to order item
            foreach ($cart as $item) {
                OrderItem::create([
                    'product_id' => $item['id'],
                    'order_id' => $order->id,
                    'name' => Product::find($item['id'])->product_name,
                    'qty' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['price'] * $item['quantity'],
                ]);
            }

            // Remove all cart items
            session()->forget('cart');
            session()->forget('url.intended');
            return response()->json(['success' => true, 'redirect_url' => route('thanks_page', $order->order_code)]);

        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], is_int($th->getCode()) && $th->getCode() > 0 && $th->getCode() < 600 ? $th->getCode() : 500);
        }
    }


    public function thenkasPage($order_code)
    {
        // $order = Order::where('order_code', $order_code)->first();
        return view('pages.frontend.thanks', [
            'order_code' => $order_code
        ]);
    }







}
