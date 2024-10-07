<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Helper\FlashMessage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Ensure you are selecting the correct fields
            $data = Category::orderByDesc('id')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('category_logo', function ($row) {
                    // Check if the row has a photo, otherwise use a default image
                    $imageUrl = empty($row->category_logo) ? asset('assets/empty-image-300x240.jpg') : asset($row->category_logo);
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
                    $editUrl = route('admin.edit_category', $row->id);
                    $deleteUrl = route('admin.delete_category', $row->id);
                    return '<a href="' . $editUrl . '" class="btn btn-success">Edit</a>
                            <a href="' . $deleteUrl . '" class="btn btn-danger" id="delete">Delete</a>';
                })
                ->rawColumns(['category_logo', 'status', 'action'])
                ->make(true);
        }

        return view('layouts.admin.category.all-category');
    }

    public function add()
    {
        return view('layouts.admin.category.add-category');
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name',
            'category_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'status' => 'required|numeric|between:0,1',
        ]);

        // Handle category logo upload and image processing using Intervention Image
        if ($request->hasFile('category_logo')) {
            // Use image intervention for resizing and saving
            $image = $request->file('category_logo');
            $image_name = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Resize and store image
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->resize(500, 400)->save(public_path('upload/category_logo/' . $image_name));

            // Store image path in the database
            $validated['category_logo'] = 'upload/category_logo/' . $image_name;
        }

        // Store the new category
        $category = new Category();
        $category->category_name = $validated['category_name'];
        $category->slug = Str::slug($validated['category_name']);
        $category->category_logo = $validated['category_logo'] ?? null;
        $category->status = $validated['status'];
        $category->save();

        FlashMessage::flash('success', 'Category created successfully.');
        return redirect()->route('admin.all_category');
    }

    public function edit(Category $category)
    {
        return view('layouts.admin.category.edit-category', [
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'category_name' => ['required', 'string', 'max:255', Rule::unique(Category::class)->ignore($category->id)],
            'category_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'status' => 'required|between:0,1',
        ]);

        // Store old category data for comparison
        $oldData = $category->replicate();

        // Handle category logo update
        if ($request->hasFile('category_logo')) {
            // Delete old category logo if exists
            if ($category->category_logo && file_exists(public_path($category->category_logo))) {
                unlink(public_path($category->category_logo));
            }

            // Use image intervention for resizing and saving
            $image = $request->file('category_logo');
            $image_name = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Resize and store image
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->resize(500, 400)->save(public_path('upload/category_logo/' . $image_name));

            // Store new image path in the database
            $validated['category_logo'] = 'upload/category_logo/' . $image_name;
        }

        // Update the category information
        $category->update([
            'category_name' => $validated['category_name'],
            'slug' => Str::slug($validated['category_name']),
            'category_logo' => $validated['category_logo'] ?? $category->category_logo, // Keep the old logo if not updated
            'status' => $validated['status'],
        ]);

        // Check if there are any changes compared to the old data
        if ($oldData->isDirty()) {
            FlashMessage::flash('success', 'Category updated successfully.');
        }

        return redirect()->route('admin.all_category');
    }


    public function delete(Category $category)
    {
        // Delete the category logo from the server if exists
        if ($category->category_logo && file_exists(public_path($category->category_logo))) {
            unlink(public_path($category->category_logo));
        }

        // Delete the category from the database
        $category->delete();

        FlashMessage::flash('success', 'Category deleted successfully.');

        return redirect()->back();
    }
}
