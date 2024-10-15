<?php

namespace App\Http\Controllers\Admin;

use App\Helper\FlashMessage;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

use Barryvdh\DomPDF\Facade\Pdf;
class OrderManageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $status = $request->input('order_status');

            $data = Order::with(['shippingManage', 'user']);

            if (!empty($status)) {
                $data->where('order_status', $status);
            }

            $data = $data->orderByDesc('id')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('order_status', function ($row) {
                    if ($row->order_status === 'pending') {
                        return '<span class="badge text-bg-primary">Pending</span>';
                    }
                    if ($row->order_status === 'cancelled') {
                        return '<span class="badge text-bg-danger">Cancelled</span>';
                    }
                    if ($row->order_status === 'completed') {
                        return '<span class="badge text-bg-success">Completed</span>';
                    }
                })

                ->addColumn('shipping_area', function ($row) {
                    return $row->shippingManage->shipping_name;
                })
                ->addColumn('coupon', function ($row) {
                    if (empty($row->coupon_code)) {
                        return '<span class="badge text-bg-danger">Empty</span>';
                    } else {
                        return $row->coupon_code;
                    }

                })

                ->addColumn('discount', function ($row) {
                    if (empty($row->discount)) {
                        return '<span class="badge text-bg-danger">No Discount</span>';
                    } else {
                        return $row->discount;
                    }

                })

                ->addColumn('shipping_cost', function ($row) {
                    return $row->shippingManage->amount;
                })

                ->addColumn('payment_method', function ($row) {
                    if ($row->peyment_method_type === 'cash_on_delivery') {
                        return '<span class="badge text-bg-primary">Cash on delivery</span>';
                    } else {
                        return '<span class="badge text-bg-success">' . $row->peyment_method_type . '</span>';
                    }

                })


                ->addColumn('action', function ($row) {
                    // Dynamically create the Edit and Delete buttons with $row->id
                    $editUrl = route('admin.order_details', $row->id);
                    $deleteUrl = route('admin.download_invoice', $row->id);
                    return '<a href="' . $editUrl . '" class="btn btn-success">View</a>
                        <a href="' . $deleteUrl . '" class="btn btn-danger">Download</a>';
                })
                ->rawColumns(['order_status', 'payment_method', 'shipping_area', 'action', 'coupon', 'discount', 'shipping_cost'])
                ->make(true);
        }

        return view('layouts.admin.order.all-order');
    }



    public function orderDetails($id)
    {

        $order = Order::with('orderItems')->find($id);

        return view('layouts.admin.order.order-details', [
            'order' => $order
        ]);
    }

    public function downloadInvoice($id)
    {
        $order = Order::with('orderItems')->find($id);
        $pdf = Pdf::loadView('layouts.admin.order.order-download', ['order' => $order])
            ->setPaper('a4')
            ->setOption([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);
        return $pdf->download('invoice.pdf');
    }

    public function delete($id)
    {
        $order = Order::find($id);
        $order->delete();

        FlashMessage::flash('success', 'Invoice Deleted successfully.');
        return redirect()->route('admin.all_order');
    }



    public function orderStatusChangePendingToCompleted($id)
    {
        $order = Order::find($id);
        $order->update([
            'order_status' => 'completed'
        ]);
        return redirect()->route('admin.all_order');
    }

    public function orderStatusChangePendingToCancelled($id)
    {
        $order = Order::find($id);
        $order->update([
            'order_status' => 'cancelled'
        ]);
        return redirect()->route('admin.all_order');
    }


}
