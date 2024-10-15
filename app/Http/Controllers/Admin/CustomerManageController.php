<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Helper\FlashMessage;
use Illuminate\Http\Request;
use App\Models\ShippingManage;
use App\Models\CustomerAddress;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class CustomerManageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CustomerAddress::with('shippingManage');


            $data = $data->orderByDesc('id')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('shipping_area', function ($row) {
                    if (!empty($row->shippingManage)) {
                        return $row->shippingManage->shipping_name;
                    } else {
                        return '<span class=" badge bg-danger">Empty</span>';
                    }
                })


                ->addColumn('action', function ($row) {
                    // Dynamically create the Edit and Delete buttons with $row->id
                    $editUrl = route('admin.edit_customer', $row->id);
                    $deleteUrl = route('admin.delete_customer', $row->id);
                    return '<a href="' . $editUrl . '" class="btn btn-success">Edit</a>
                        <a href="' . $deleteUrl . '" class="btn btn-danger" id="delete">Delete</a>';
                })
                ->rawColumns(['action', 'shipping_area'])
                ->make(true);
        }
        return view('layouts.admin.customer-manage.all-customer');
    }





    public function add()
    {
        $shipping_areas = ShippingManage::latest()->where('status', 1)->get();
        return view('layouts.admin.customer-manage.add-customer', [
            'shipping_areas' => $shipping_areas
        ]);

    }



    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8',
            'mobile' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
            'shipping_area' => 'nullable|exists:shipping_manages,id'
        ]);


        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Create new customer address
        $customerAddress = new CustomerAddress();
        $customerAddress->first_name = $request->input('first_name');
        $customerAddress->last_name = $request->input('last_name');
        $customerAddress->email = $request->input('email');
        $customerAddress->mobile = $request->input('mobile');
        $customerAddress->address = $request->input('address');
        $customerAddress->city = $request->input('city');
        $customerAddress->state = $request->input('state');
        $customerAddress->zip = $request->input('zip');
        $customerAddress->user_id = $user->id;
        $customerAddress->shipping_manage_id = $request->input('shipping_area');

        // Save to the database
        $customerAddress->save();

        FlashMessage::flash('success', 'Customer created successfully.');
        // Redirect or return response
        return redirect()->back();
    }


    public function edit($id)
    {
        $customer = CustomerAddress::find($id);
        $shipping_areas = ShippingManage::latest()->where('status', 1)->get();
        return view('layouts.admin.customer-manage.edit-customer', [
            'shipping_areas' => $shipping_areas,
            'customer' => $customer
        ]);

    }
    public function update(Request $request, $id)
    {
        $customerAddress = CustomerAddress::with('user')->find($id);
        // Validate incoming request
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique(User::class)->ignore($customerAddress->user->id)],
            'password' => 'nullable|min:8',
            'mobile' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
            'shipping_area' => 'nullable|exists:shipping_manages,id'
        ]);



        if ($customerAddress && $customerAddress->user) {
            $customerAddress->user->update([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
            ]);

            if ($request->filled('password')) {
                $customerAddress->user->update([
                    'password' => Hash::make($request->input('password')),
                ]);
            }
        }



        // Create new customer address
        $customerAddress->first_name = $request->input('first_name');
        $customerAddress->last_name = $request->input('last_name');
        $customerAddress->email = $request->input('email');
        $customerAddress->mobile = $request->input('mobile');
        $customerAddress->address = $request->input('address');
        $customerAddress->city = $request->input('city');
        $customerAddress->state = $request->input('state');
        $customerAddress->zip = $request->input('zip');
        $customerAddress->shipping_manage_id = $request->input('shipping_area');
        // Save to the database
        $customerAddress->save();

        FlashMessage::flash('success', 'Customer updated successfully.');
        // Redirect or return response
        return redirect()->route('admin.all_customer');
    }

    public function delete($id)
    {

        $customer = CustomerAddress::findOrFail($id);
        $customer->delete();
        FlashMessage::flash('success', 'Customer Address deleted successfully.');
        return redirect()->back();
    }
}
