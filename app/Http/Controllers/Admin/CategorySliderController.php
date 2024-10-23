<?php
namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Helper\FlashMessage;
use Illuminate\Http\Request;
use App\Models\CategorySlider;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Drivers\Gd\Driver;

class CategorySliderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Ensure you are selecting the correct fields
            $status = $request->input('status');

            $data = CategorySlider::query();
            if ($status !== null) {
                $data->where('status', $status);
            }
            $data = $data->with('category')->orderByDesc('id')->get();
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('heading_one', function ($row) {
                    if (empty($row->heading_one)) {
                        return '<span class="badge bg-danger">Empty</span>';
                    } else {
                        return Str::limit($row->heading_one, 20);
                    }
                })
                ->addColumn('heading_two', function ($row) {
                    if (empty($row->heading_two)) {
                        return '<span class="badge bg-danger">Empty</span>';
                    } else {
                        return Str::limit($row->heading_two, 20);
                    }
                })
                ->addColumn('button_text', function ($row) {
                    if (empty($row->button_text)) {
                        return '<span class="badge bg-danger">Empty</span>';
                    } else {
                        return Str::limit($row->button_text, 10);
                    }
                })

                ->addColumn('button_link', function ($row) {
                    if (empty($row->button_link)) {
                        return '<span class="badge bg-danger">Empty</span>';
                    } else {
                        return Str::limit($row->button_link, 20);
                    }
                })

                ->addColumn('category', function ($row) {
                    return $row->category->category_name;
                })


                ->addColumn('slider', function ($row) {
                    // Check if the row has a photo, otherwise use a default image
                    $imageUrl = empty($row->slider_image) ? asset('assets/empty-image-300x240.jpg') : asset($row->slider_image);
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
                    $editUrl = route('admin.edit_category_slider', $row->id);
                    $deleteUrl = route('admin.delete_category_slider', $row->id);
                    return '<a href="' . $editUrl . '" class="btn btn-success">Edit</a>
                            <a href="' . $deleteUrl . '" class="btn btn-danger" id="delete">Delete</a>';
                })
                ->rawColumns(['slider', 'category', 'heading_one', 'heading_two', 'button_text', 'button_link', 'status', 'action'])
                ->make(true);
        }

        return view('layouts.admin.category-slider.all-category-slider');
    }

    public function add()
    {
        $categories = Category::where('status', 1)->latest()->get();
        return view('layouts.admin.category-slider.add-category-slider', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'category' => 'required|exists:categories,id',
            'status' => 'nullable|numeric|between:0,1',
            'slider' => 'required|image|mimes:jpg,jpeg,png|dimensions:min_width=1200,min_height=600',
            'heading_one' => 'nullable',
            'heading_two' => 'nullable',
            'button_text' => 'nullable|string',
            'button_link' => 'nullable|url',
        ]);

        $slider = new CategorySlider();
        // Handle category logo upload and image processing using Intervention Image
        if ($request->hasFile('slider')) {

            $image = $request->file('slider');
            $image_name = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Resize and store image
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->resize(1200, 600)->save(public_path('upload/category_slider/' . $image_name));

            // Store image path in the database
            $validated['slider_image'] = 'upload/category_slider/' . $image_name;
            $slider->slider_image = $validated['slider_image'];
        }

        $slider->category_id = $validated['category'];
        $slider->heading_one = $validated['heading_one'];
        $slider->heading_two = $validated['heading_two'];
        $slider->button_text = $validated['button_text'];
        $slider->button_link = $validated['button_link'];
        $slider->status = $validated['status'] ?? 1;
        $slider->save();


        FlashMessage::flash('success', 'Category slider created successfully.');
        return redirect()->route('admin.all_category_slider');

    }

    public function edit($id)
    {
        $categorySlider = CategorySlider::with('category')->find($id);
        return view('layouts.admin.category-slider.edit-category-slider', [
            'categorySlider' => $categorySlider,
            'categories' => Category::where('status', 1)->latest()->get(),
        ]);
    }

    public function update(Request $request, CategorySlider $categorySlider)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'category' => 'required|exists:categories,id',
            'status' => 'nullable|numeric|between:0,1',
            'slider' => 'nullable|image|mimes:jpg,jpeg,png|dimensions:min_width=1200,min_height=600',
            'heading_one'=> 'nullable',
            'heading_two' => 'nullable',
            'button_text' => 'nullable|string',
            'button_link' => 'nullable|url',
        ]);



        $oldData = $categorySlider->replicate();
        // Handle category slider image upload and image processing using Intervention Image
        if ($request->hasFile('slider')) {

            if (file_exists(public_path($categorySlider->slider_image))) {
                unlink(public_path($categorySlider->slider_image));
            }


            // Use image intervention for resizing and saving
            $image = $request->file('slider');
            $image_name = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Resize and store image
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->resize(1200, 600)->save(public_path('upload/category_slider/' . $image_name));

            // Store new image path in the database
            $validated['slider_image'] = 'upload/category_slider/' . $image_name;
        }

        // Update the category slider
        if (isset($validated['slider_image'])) {
            $categorySlider->slider_image = $validated['slider_image'];
        }

        // $categorySlider->slider_image = $validated['slider_image'] ?? $categorySlider->slider_image;
        $categorySlider->status = $validated['status'] ?? 1;

        if(isset($validated['category'])){
            $categorySlider->category_id = $validated['category'];
        }
        $categorySlider->heading_one = $validated['heading_one'];
        $categorySlider->heading_two = $validated['heading_two'];
        $categorySlider->button_text = $validated['button_text'];
        $categorySlider->button_link = $validated['button_link'];


        $categorySlider->save();

        if($$oldData->isDirty()){
            FlashMessage::flash('success', 'Category slider updated successfully.');
        }
        return redirect()->route('admin.all_category_slider');
    }


    public function delete(CategorySlider $categorySlider)
    {
        // Delete the slider image from the file system if it exists
        if (file_exists(public_path($categorySlider->slider_image))) {
            unlink(public_path($categorySlider->slider_image));
        }

        // Delete the category slider record from the database
        $categorySlider->delete();

        FlashMessage::flash('success', 'Category slider deleted successfully.');
        return redirect()->route('admin.all_category_slider');
    }

}
