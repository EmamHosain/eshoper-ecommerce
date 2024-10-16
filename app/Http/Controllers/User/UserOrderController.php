<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
    public function getAllOrder()
    {
        $user_id = Auth::user()->id;
        $orders = Order::with('shippingManage')->where('user_id', $user_id)->latest()->paginate(10);
        return view('layouts.user.backend.pages.all-order', [
            'orders' => $orders
        ]);
    }

    public function orderDetails($id)
    {

        $order = Order::with('orderItems', 'shippingManage')->findOrFail($id);
        return view('layouts.user.backend.pages.order-details', [
            'order' => $order
        ]);
    }

    public function invoiceDownload($id){
        $order = Order::with('orderItems')->where('user_id',Auth::id())->find($id);
        $pdf = Pdf::loadView('layouts.user.backend.pages.order-download', ['order' => $order])
            ->setPaper('a4')
            ->setOption([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);
        return $pdf->download('invoice.pdf');
    }
}
