<?php

namespace App\Http\Controllers\Admin;

use App\Helper\FlashMessage;
use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Coupon::orderByDesc('id')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('coupon_desc', function ($row) {
                    return Str::limit($row->coupon_desc, 20);
                })

                ->addColumn('validity_date_time', function ($row) {
                    return Carbon::parse($row->validity_date)
                        // ->setTimezone('Asia/Dhaka')
                        ->format('F j, Y h:i A');
                })

                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.edit_coupon', $row->id);
                    $deleteUrl = route('admin.delete_coupon', $row->id);
                    return '<a href="' . $editUrl . '" class="btn btn-success">Edit</a>
                            <a href="' . $deleteUrl . '" class="btn btn-danger" id="delete">Delete</a>';
                })

                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<span class="badge text-bg-success">Active</span>';
                    } else {
                        return '<span class="badge text-bg-danger">Inactive</span>';
                    }
                })
                ->rawColumns(['action', 'status', 'coupon_desc', 'validity_date_time'])
                ->make(true);
        }

        return view('layouts.admin.coupon.all-coupon');
    }

    public function add()
    {
        return view('layouts.admin.coupon.add-coupon');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'coupon_name' => 'required|string|max:255',
            'coupon_desc' => 'nullable|string',
            'validity_date_time' => 'required|date',
            'discount' => 'required|numeric|min:0',
            'status' => 'required|in:0,1',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create a new coupon
        Coupon::create([
            'coupon_name' => $request->coupon_name,
            'coupon_desc' => $request->coupon_desc,
            'validity_date_time' => $request->validity_date_time,
            'discount' => $request->discount,
            'status' => $request->status,
        ]);

        FlashMessage::flash('success', 'Coupon added successfully');
        return redirect()->route('admin.all_coupon');
    }



}
