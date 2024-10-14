<?php

namespace App\Http\Controllers\Admin;

use App\Helper\FlashMessage;
use App\Http\Resources\CouponResource;
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
            $data = CouponResource::collection($data);
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('description', function ($row) {
                    return Str::limit($row->coupon_desc, 20);
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
                ->rawColumns(['action', 'status', 'description'])
                ->make(true);
        }

        return view('layouts.admin.coupon.all-coupon');
    }

    public function add()
    {
        return view('layouts.admin.coupon.add-coupon');
    }

    public function edit($coupon)
    {
        $coupon = Coupon::find($coupon);
        $coupon = CouponResource::make($coupon);
        // dd($coupon);
        return view('layouts.admin.coupon.edit-coupon', [
            'coupon' => $coupon
        ]);
    }



    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'coupon_name' => 'required|string|max:255',
            'coupon_code' => 'required|string|max:255|unique:coupons,code',
            'coupon_desc' => 'nullable|string',
            'max_uses' => 'nullable|integer|min:1',
            'max_uses_user' => 'nullable|integer|min:1',
            'type' => 'required|in:percent,fixed',
            'discount_amount' => 'required|numeric|min:0',
            'min_amount' => 'nullable|numeric|min:0',
            'starts_at' => 'required|date_format:d-m-Y h:i A|after:' . now()->format('d-m-Y h:i A'),
            'ends_at' => 'required|date_format:Y-m-d h:i A|after:starts_at',
            'status' => 'required|boolean',
        ]);

        // Store the coupon
        $coupon = new Coupon();
        $coupon->name = $request->coupon_name;
        $coupon->code = $request->coupon_code;
        $coupon->description = $request->coupon_desc;
        $coupon->max_uses = $request->max_uses;
        $coupon->max_uses_user = $request->max_uses_user;
        $coupon->type = $request->type;
        $coupon->discount_amount = $request->discount_amount;
        $coupon->min_amount = $request->min_amount;

        // Convert the dates to the correct format
        $coupon->starts_at = Carbon::createFromFormat('Y-m-d h:i A', $request->input('starts_at'))->format('Y-m-d H:i:s');
        $coupon->expires_at = Carbon::createFromFormat('Y-m-d h:i A', $request->input('ends_at'))->format('Y-m-d H:i:s');

        $coupon->status = $request->status;

        // Save to the database
        $coupon->save();
        FlashMessage::flash('success', 'Coupon created successfully.');
        return redirect()->back();
    }




    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'coupon_name' => 'required|string|max:255',
            'coupon_code' => 'required|string|max:255',
            'coupon_desc' => 'nullable|string',
            'max_uses' => 'nullable|integer',
            'max_uses_user' => 'nullable|integer',
            'type' => 'required|string|in:fixed,percent',
            'discount_amount' => 'required|numeric|min:0',
            'min_amount' => 'nullable|numeric|min:0',
            'starts_at' => 'nullable|date_format:d-m-Y h:i A',
            'ends_at' => 'nullable|date_format:d-m-Y h:i A',
            'status' => 'required|boolean',
        ]);

        // Find the coupon by its ID
        $coupon = Coupon::findOrFail($id);

        // Update coupon with validated data
        $coupon->update([
            'name' => $request->coupon_name,
            'code' => $request->coupon_code,
            'description' => $request->coupon_desc,
            'max_uses' => $request->max_uses,
            'max_uses_user' => $request->max_uses_user,
            'type' => $request->type,
            'discount_amount' => $request->discount_amount,
            'min_amount' => $request->min_amount,
            'starts_at' => $request->starts_at ? Carbon::createFromFormat('d-m-Y h:i A', $request->starts_at)->setTimezone('Asia/Dhaka') : null,
            'expires_at' => $request->ends_at ? Carbon::createFromFormat('d-m-Y h:i A', $request->ends_at)->setTimezone('Asia/Dhaka') : null,
            'status' => $request->status,
        ]);

        // Redirect back with success message
        FlashMessage::flash('success', 'Coupon updated successfully.');
        return redirect()->route('admin.all_coupon');
    }

    public function delete($coupon)
    {
        Coupon::find($coupon)->delete();
        FlashMessage::flash('success', 'Coupon deleted successfully.');
        return redirect()->back();

    }



}
