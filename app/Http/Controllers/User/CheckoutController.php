<?php

namespace App\Http\Controllers\User;

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
    public function __construct(Request $request)
    {

        $cart = session()->get('cart', []);
        if (isset($cart) && count($cart) > 0) {
            if (!Auth::check()) {
                session()->put('url.intended', $request->url()); // Store the intended URL
                redirect()->route('login')->send(); // Redirect to login
            }
        } else {
            redirect()->back()->with('warning', 'Please Add To Cart First!')->send();
        }

    }



    public function checkoutPage()
    {

        $id = Auth::id();
        $customer = CustomerAddress::where('user_id', $id)->first();

        return view('pages.frontend.checkout', [
            'customer' => $customer
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
        $shipping_charge = $request->input('shipping_charge');
        $cart = session()->get('cart', []);
        $shipping_charge_with_total = (int) $shipping_charge;
        if (isset($cart) && count($cart) > 0) {
            foreach ($cart as $item) {
                $shipping_charge_with_total += $item['price'] * $item['quantity'];
            }
        }
        return response()->json([
            'total_amount' => round($shipping_charge_with_total)
        ]);
    }
    



    public function checkoutSubmit(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip' => 'required|string|max:20',
            'shipping_type' => 'required|in:inside_dhaka,outside_dhaka,cash_on_delivery',
            'peyment_method_type' => 'required|in:cash_on_delivery,nagad,bkash',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $peyment_method_type = $request->input('peyment_method_type');
        if (empty($peyment_method_type)) {
            return response()->json(['error_message' => 'Please select payment method']);
        }

        $user = Auth::user();
        $order = new Order();

        $cart = session()->get('cart', []);
        $grand_total = 0;
        $sub_total = 0;

        foreach ($cart as $item) {
            $sub_total += $item['price'] * $item['quantity'];
        }

        if ($request->input('shipping_type') === 'inside_dhaka') {
            $grand_total += 70;
            $order->shipping_amount = 70;
        } elseif ($request->input('shipping_type') === 'outside_dhaka') {
            $grand_total += 150;
            $order->shipping_amount = 150;
        } elseif ($request->input('shipping_type') === 'cash_on_delivery') {
            $order->shipping_amount = 0.00;
        }

        $grand_total += $sub_total; // Add sub_total to grand_total
        $order->grand_total = $grand_total;
        $order->sub_total = $sub_total;
        $order->coupon_code = $request->input('coupon_code');
        $order->notes = $request->input('notes');
        $order->user_id = $user->id;

        // Shipping Address
        $order->first_name = $request->input('first_name');
        $order->last_name = $request->input('last_name');
        $order->email = $request->input('email');
        $order->mobile = $request->input('mobile');
        $order->address = $request->input('address');
        $order->city = $request->input('city');
        $order->state = $request->input('state');
        $order->zip = $request->input('zip');
        $order->shipping_type = $request->input('shipping_type');
        $order->peyment_method_type = $request->input('peyment_method_type');

        $order_id = IdGenerator::generate(['table' => 'orders', 'field' => 'order_id', 'length' => 10, 'prefix' => 'ODID-']);
        $order->order_id = $order_id;

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
                'shipping_type' => $request->input('shipping_type'),
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

        // remove the all cart item 
        session()->forget('cart');

        return response()->json([
            'message' => 'Your order has been successfully placed!',
            'order_id' => $order->id,
        ], 201);
    }









}
