<?php

namespace App\Http\Controllers\Admin;

use App\Models\Offer;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Helper\FlashMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Drivers\Gd\Driver;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $status = $request->input('status');

            $data = Offer::query();

            if ($status !== null) {
                $data->where('status', $status);
            }

            $data = $data->orderByDesc('id')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('banner_image', function ($row) {
                    // Check if the row has a photo, otherwise use a default image
                    $imageUrl = empty($row->banner_image) ? asset('assets/empty-image-300x240.jpg') : asset($row->banner_image);
                    return '<img src="' . $imageUrl . '" width="50" height="50"/>';
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<span class="badge text-bg-success">Active</span>';
                    } else {
                        return '<span class="badge text-bg-danger">Inactive</span>';
                    }
                })
                ->addColumn('product_name', function ($row) {
                    return Str::limit($row->product->product_name, 20);
                })
                ->addColumn('description', function ($row) {
                    return Str::limit($row->description, 20);
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('admin.edit_offer', $row->id);
                    $deleteUrl = route('admin.delete_offer', $row->id);
                    return '<a href="' . $editUrl . '" class="btn btn-success">Edit</a>
                        <a href="' . $deleteUrl . '" class="btn btn-danger" id="delete">Delete</a>';
                })
                ->rawColumns(['banner_image', 'description', 'product_name', 'status', 'action'])
                ->make(true);
        }

        return view('layouts.admin.offer.all-offer');
    }


    public function add()
    {
        $products = Product::latest()->where('status', 1)->select('id', 'product_name')->get();
        // dd($products);
        return view('layouts.admin.offer.add-offer', [
            'products' => $products
        ]);
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'product' => 'required|exists:products,id',
            'description' => 'nullable|string',
            'offer_image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            'status' => 'required|numeric|between:0,1',
            'show' => 'required|in:home_page,offer_page'
        ]);

        // Handle offer image upload and image processing using Intervention Image
        if ($request->hasFile('offer_image')) {
            // Use image intervention for resizing and saving
            $image = $request->file('offer_image');
            $image_name = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Resize and store image
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->resize(600, 400)->save(public_path('upload/offer_images/' . $image_name));

            // Store image path in the database
            $validated['banner_image'] = 'upload/offer_images/' . $image_name;
        }

        // Store the new offer
        $offer = new Offer();
        $offer->product_id = $validated['product'];
        $offer->status = $validated['status'];
        $offer->description = $validated['description'];
        $offer->show = $validated['show'];
        $offer->banner_image = $validated['banner_image'];
        $offer->save();

        FlashMessage::flash('success', 'Offer created successfully.');
        return redirect()->route('admin.all_offer');
    }

    public function edit($id)
    {
        $products = Product::latest()->where('status', 1)->select('id', 'product_name')->get();
        $offer = Offer::findOrFail($id);
        return view('layouts.admin.offer.edit-offer', [
            'products' => $products,
            'offer' => $offer
        ]);

    }

    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'product' => 'required|exists:products,id',
            'description' => 'nullable|string',
            'offer_image' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'status' => 'required|numeric|between:0,1',
            'show' => 'required|in:home_page,offer_page'
        ]);

        $offer = Offer::findOrFail($id);
        // Handle image upload
        if ($request->hasFile('offer_image')) {
            // Delete the old image if it exists
            if ($offer->banner_image && file_exists(public_path($offer->banner_image))) {
                unlink(public_path($offer->banner_image));
            }

            // Upload new image
            $image = $request->file('offer_image');
            $image_name = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->resize(600, 400)->save(public_path('upload/offer_images/' . $image_name));

            // Update the image path in the offer
            $offer->banner_image = 'upload/offer_images/' . $image_name;
        }

        // Update the offer details
        $offer->product_id = $validated['product'];
        $offer->status = $validated['status'];
        $offer->description = $validated['description'];
        $offer->show = $validated['show'];
        $offer->save();

        FlashMessage::flash('success', 'Offer updated successfully.');
        return redirect()->route('admin.all_offer');
    }



    public function delete($id)
    {
        // Find the offer by ID
        $offer = Offer::findOrFail($id);

        // Delete the image file from the server, if it exists
        if (file_exists(public_path($offer->banner_image))) {
            unlink(public_path($offer->banner_image));
        }

        // Delete the offer from the database
        $offer->delete();

        // Flash a success message
        FlashMessage::flash('success', 'Offer deleted successfully.');

        // Redirect to the list of offers
        return redirect()->route('admin.all_offer');
    }

}
