<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Support\Str;
use App\Helper\FlashMessage;
use Illuminate\Http\Request;



// image intervention package 
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Drivers\Gd\Driver;



class BrandController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Ensure you are selecting the correct fields
            $data = Brand::select(['id', 'brand_name', 'slug', 'brand_logo', 'status'])->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('brand_logo', function ($row) {
                    // Check if the row has a photo, otherwise use a default image
                    $imageUrl = empty($row->brand_logo) ? asset('assets/empty-image-300x240.jpg') : asset($row->brand_logo);
                    return '<img src="' . $imageUrl . '" width="50" height="50"/>';
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<span class="badge text-bg-success">Active</span>';
                    } else {
                        return '<span class="badge text-bg-danger">Inactive</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    // Dynamically create the Edit and Delete buttons with $row->id
                    $editUrl = route('admin.edit_brand', $row->id);
                    $deleteUrl = route('admin.delete_brand', $row->id);
                    return '<a href="' . $editUrl . '" class="btn btn-success">Edit</a>
                            <a href="' . $deleteUrl . '" class="btn btn-danger" id="delete">Delete</a>';
                })
                ->rawColumns(['brand_logo', 'status', 'action'])
                ->make(true);
        }

        return view('layouts.admin.brand.all-brand');
    }


    public function add()
    {
        return view('layouts.admin.brand.add-brand');

    }
    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'brand_name' => 'required|string|max:255|unique:brands,brand_name',
            'brand_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'status' => 'required|between:0,1',
        ]);

        // Handle brand logo upload and image processing using Intervention Image
        // Handle image upload
        if ($request->hasFile('brand_logo')) {
            // Use image intervention for resizing and saving
            $image = $request->file('brand_logo');
            $image_name = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Resize and store image
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->resize(300, 300)->save(public_path('upload/brand_logo/' . $image_name));

            // Store image path in the database
            $validated['brand_logo'] = 'upload/brand_logo/' . $image_name;
        }

        // Store the new brand
        $brand = new Brand();
        $brand->brand_name = $validated['brand_name'];
        $brand->slug = Str::slug($validated['brand_name']);
        $brand->brand_logo = $validated['brand_logo'] ?? null;
        $brand->status = $validated['status'];
        $brand->save();

        FlashMessage::flash('success', 'Brand created successfully.');
        // Redirect or return a response
        return redirect()->route('admin.all_brand');
    }

    public function edit(Brand $brand)
    {
        return view('layouts.admin.brand.edit-brand', [
            'brand' => $brand
        ]);
    }

    public function update(Request $request, Brand $brand)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'brand_name' => ['required', 'string', 'max:255', Rule::unique(Brand::class)->ignore($brand->id)],
            'brand_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'status' => 'required|between:0,1',
        ]);

        // Handle brand logo update
        if ($request->hasFile('brand_logo')) {
            // Delete old brand logo if exists
            if ($brand->brand_logo && file_exists(public_path($brand->brand_logo))) {
                unlink(public_path($brand->brand_logo));
            }

            // Use image intervention for resizing and saving
            $image = $request->file('brand_logo');
            $image_name = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Resize and store image
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->resize(300, 300)->save(public_path('upload/brand_logo/' . $image_name));

            // Store new image path in the database
            $validated['brand_logo'] = 'upload/brand_logo/' . $image_name;
        }

        // Update the brand information
        $brand->update([
            'brand_name' => $validated['brand_name'],
            'slug' => Str::slug($validated['brand_name']),
            'brand_logo' => $validated['brand_logo'] ?? $brand->brand_logo, // Keep the old logo if not updated
            'status' => $validated['status'],
        ]);

        FlashMessage::flash('success', 'Brand updated successfully.');
        return redirect()->route('admin.all_brand');
    }


    public function delete(Brand $brand)
    {
        // Delete the brand logo from the server if exists
        if ($brand->brand_logo && file_exists(public_path($brand->brand_logo))) {
            unlink(public_path($brand->brand_logo));
        }

        // Delete the brand from the database
        $brand->delete();

        FlashMessage::flash('success', 'Brand deleted successfully.');

        return redirect()->back();
    }


}
