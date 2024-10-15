<?php

namespace App\Http\Controllers\Admin;

use App\Helper\FlashMessage;
use Illuminate\Http\Request;
use App\Models\ShippingManage;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class ShippingManageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $status = $request->input('status'); // Get the status parameter from the request

            $data = ShippingManage::query();

            if ($status !== null) {
                $data->where('status', $status);
            }

            $data = $data->orderByDesc('id')->get();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<span class="badge text-bg-success">Active</span>';
                    } else {
                        return '<span class="badge text-bg-danger">Inactive</span>';
                    }
                })
                ->addColumn('action', function ($row) {

                    $editUrl = route('admin.edit_shipping', $row->id);
                    $deleteUrl = route('admin.delete_shipping', $row->id);
                    return '<a href="' . $editUrl . '" class="btn btn-success">Edit</a>
                        <a href="' . $deleteUrl . '" class="btn btn-danger" id="delete">Delete</a>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('layouts.admin.shipping-manage.all-shipping');
    }

    public function add()
    {
        return view('layouts.admin.shipping-manage.add-shipping');
    }
    public function edit($id)
    {
        $shipping_manage = ShippingManage::findOrFail($id);
        return view('layouts.admin.shipping-manage.edit-shipping', [
            'shipping' => $shipping_manage
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'shipping_name' => 'required|string|unique:shipping_manages,shipping_name',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|between:0,1',
        ]);

        ShippingManage::create([
            'shipping_name' => $request->shipping_name,
            'amount' => $request->amount,
            'status' => $request->status,
        ]);
        FlashMessage::flash('success', 'Shipping created successfully');
        return redirect()->route('admin.all_shipping');
    }


    public function update(Request $request, $id)
    {
        $shippingMethod = ShippingManage::findOrFail($id);

        $request->validate([
            'shipping_name' => ['required', 'string', 'max:255', Rule::unique(ShippingManage::class)->ignore($id)],
            'amount' => 'required|numeric|min:0',
            'status' => 'required|boolean',
        ]);

        $shippingMethod->update([
            'shipping_name' => $request->shipping_name,
            'amount' => $request->amount,
            'status' => $request->status,
        ]);

        FlashMessage::flash('success', 'Shipping updated successfully');
        return redirect()->route('admin.all_shipping');
    }


    public function delete($id)
    {
        $shippingMethod = ShippingManage::findOrFail($id);
        $shippingMethod->delete();

        FlashMessage::flash('success', 'Shipping deleted successfully');
        return redirect()->back();
    }


}
