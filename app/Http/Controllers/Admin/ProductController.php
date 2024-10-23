<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Helper\FlashMessage;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;


// image intervention
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Yajra\DataTables\Facades\DataTables;

// id generator 
use Intervention\Image\Drivers\Gd\Driver;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $status = $request->input('status');
            $data = Product::query();
            if ($status !== null) {
                $data->where('status', $status);
            }


            $data = $data->with([
                'category',
                'brand',
                'colors',
                'sizes'
            ])
                ->where('status', 1)
                ->withCount('productImages')
                ->latest()->get();




            return DataTables::of($data)

                ->addColumn('short_desc', function ($product) {
                    return Str::limit($product->short_description, 20);
                })
                ->addColumn('category_name', function ($product) {
                    return $product->category->category_name ?? 'empty';
                })

                ->addColumn('brand_name', function ($product) {
                    return $product->brand->brand_name ?? '<span class="badge bg-danger">Empty</span>';
                })
                ->addColumn('dis_price', function ($product) {
                    if ($product->is_discount) {
                        return $product->discount_price;
                    } else {
                        return '<span class="badge bg-danger">No Discount</span>';
                    }
                })
                ->addColumn('popularity', function ($product) {
                    if ($product->popularity == 'arrived') {
                        return '<span class="badge bg-primary text-white">New Arrived</span>';
                    } else {
                        return '<span class="badge bg-info text-white">Trandy</span>';
                    }
                })

                ->addColumn('colors', function ($product) {
                    if (count($product->colors) > 0) {
                        return $product->colors->pluck('color_name')->implode(' ,');
                    } else {
                        return '<span class="badge bg-danger">Empty</span>';
                    }
                })
                ->addColumn('sizes', function ($product) {
                    if (count($product->sizes) > 0) {
                        return $product->sizes->pluck('size_name')->implode(' ,');
                    } else {
                        return '<span class="badge bg-danger">Empty</span>';
                    }
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
                    $editUrl = route('admin.edit_product', $row->id);
                    $deleteUrl = route('admin.delete_product', $row->id);
                    return '<a href="' . $editUrl . '" class="btn btn-success">Edit</a>
                            <a href="' . $deleteUrl . '" class="btn btn-danger" id="delete">Delete</a>';
                })
                ->rawColumns(['category_name', 'short_desc', 'brand_name', 'dis_price', 'popularity', 'status', 'colors', 'sizes', 'action'])
                ->make(true);
        }
        return view('layouts.admin.product.all-product');
    }

    public function add()
    {
        $categories = Category::where('status', 1)->latest()->get();
        $brands = Brand::where('status', 1)->latest()->get();
        $colors = Color::latest()->get();
        $sizes = Size::latest()->get();

        return view('layouts.admin.product.add-product', [
            'categories' => $categories,
            'brands' => $brands,
            'colors' => $colors,
            'sizes' => $sizes
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'product_name' => 'required|string|max:255|unique:products,product_name',
            'category' => 'required|exists:categories,id',
            'brand' => 'nullable|exists:brands,id',
            'price' => 'numeric|required|min:1',
            'discount_price' => 'numeric|nullable|min:1',
            'description' => 'nullable',
            'information' => 'nullable',
            'quantity' => 'nullable|numeric',
            'status' => 'nullable|numeric|between:0,1',
            'popularity' => 'required|in:arrived,trandy',
            'image' => 'nullable|array', // updated to handle multiple images
            'image.*' => 'image|mimes:jpg,jpeg,png,svg|max:2048|dimensions:min_width=500,min_height=500', // height and width validation
            'color' => 'nullable|array',
            'size_name' => 'nullable|array',
            'short_description' => 'required',
        ]);


        $product_code = IdGenerator::generate(['table' => 'products', 'field' => 'code', 'length' => 10, 'prefix' => 'PC-' . date('ym')]);


        // Create new product
        $product = new Product();
        $product->product_name = $validated['product_name'];
        $product->category_id = $validated['category'];
        $product->brand_id = $validated['brand'] ?? null;
        $product->price = $validated['price'];
        $product->description = $validated['description'] ?? null;

        $product->short_description = $validated['short_description'];
        $product->information = $validated['information'];

        $product->quantity = $validated['quantity'] ?? 1;
        $product->status = $validated['status'] ?? 1;
        $product->slug = Str::slug($validated['product_name']);
        $product->created_at = Carbon::now();

        $product->code = $product_code;

        if (!empty($validated['discount_price'])) {
            $product->is_discount = 1;
            $product->discount_price = $validated['discount_price'];
        } else {
            $product->discount_price = null;
            $product->is_discount = 0;
        }

        // Handle popularity (trandy/arrived)
        $product->popularity = $validated['popularity'];

        // Save the product first before attaching relations and images
        $product->save();

        // Attaching color and size (assuming many-to-many relationships)
        if (isset($validated['color']) && count($validated['color']) > 0) {
            $product->colors()->attach($validated['color']);
        }

        if (isset($validated['size_name']) && count($validated['size_name']) > 0) {
            $product->sizes()->attach($validated['size_name']);
        }

        // Handle image uploads
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $image_name = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image_path = 'upload/product/' . $image_name;

                // Resize and save image
                $manager = new ImageManager(new Driver());

                $img = $manager->read($image)->resize(500, 500);
                $img->save(public_path($image_path));

                // Store image path in the database
                ProductImage::create([
                    'product_image' => $image_path,
                    'product_id' => $product->id,
                ]);
            }
        }

        // Flash message and redirect
        FlashMessage::flash('success', 'Product created successfully.');
        return redirect()->route('admin.all_product');
    }


    public function edit(Request $request, $product)
    {


        $product = Product::with([
            'category',
            'brand',
            'colors',
            'sizes',
            'productImages'
        ])->findOrFail($product);
        $categories = Category::where('status', 1)->latest()->get();
        $brands = Brand::where('status', 1)->latest()->get();
        $colors = Color::latest()->get();
        $sizes = Size::latest()->get();



        return view('layouts.admin.product.edit-product', [
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands,
            'colors' => $colors,
            'sizes' => $sizes
        ]);



    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'product_name' => ['required', 'string', 'max:255', Rule::unique(Product::class)->ignore($product->id)],
            'category' => 'required|exists:categories,id',
            'brand' => 'nullable|exists:brands,id',
            'price' => 'numeric|required|min:1',
            'discount_price' => 'numeric|nullable|min:1',
            'description' => 'nullable',
            'information' => 'nullable',
            'quantity' => 'nullable|numeric',
            'status' => 'nullable|numeric|between:0,1',
            'popularity' => 'required|in:arrived,trandy',
            'image' => 'nullable|array', // updated to handle multiple images
            'image.*' => 'image|mimes:jpg,jpeg,png,svg|max:1024|dimensions:min_width=500,min_height=500',
            'color' => 'required|array',
            'size_name' => 'required|array',
            'short_description' => 'required',
        ]);






        $product->product_name = $validated['product_name'];
        $product->category_id = $validated['category'];
        $product->brand_id = $validated['brand'] ?? null;
        $product->price = $validated['price'];
        $product->description = $validated['description'];
        $product->description = $validated['description'];

        $product->short_description = $validated['short_description'];
        $product->information = $validated['information'];

        $product->quantity = $validated['quantity'] ?? 1;
        $product->status = $validated['status'] ?? 1;
        $product->slug = Str::slug($validated['product_name']);
        $product->updated_at = Carbon::now();
        $product->created_at = Carbon::now();



        if (!empty($validated['discount_price'])) {
            $product->is_discount = 1;
            $product->discount_price = $validated['discount_price'];
        } else {
            $product->discount_price = null;
            $product->is_discount = 0;
        }

        // Handle popularity (trandy/arrived)
        $product->popularity = $validated['popularity'];

        // Save the product first before attaching relations and images
        $product->save();

        // Attaching color and size (assuming many-to-many relationships)
        if (isset($validated['color']) && count($validated['color']) > 0) {
            $product->colors()->sync($validated['color']);
        }

        if (isset($validated['size_name']) && count($validated['size_name']) > 0) {
            $product->sizes()->sync($validated['size_name']);
        }

        // Handle image uploads
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $image_name = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image_path = 'upload/product/' . $image_name;

                // Resize and save image
                $manager = new ImageManager(new Driver());

                $img = $manager->read($image)->resize(500, 500);
                $img->save(public_path($image_path));

                // Store image path in the database
                ProductImage::create([
                    'product_image' => $image_path,
                    'product_id' => $product->id,
                ]);
            }
        }

        // Flash message and redirect
        FlashMessage::flash('success', 'Product updated successfully.');
        return redirect()->route('admin.all_product');
    }



    public function deleteImage(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'image_id' => 'required|integer',
            'product_id' => 'required|integer',
        ]);
        try {
            // Fetch the project and the related image
            $product = Product::find($request->input('product_id'));
            $image = ProductImage::where('id', $request->input('image_id'))->where('product_id', $product->id)->first();

            if ($image) {
                // Delete the image file from storage (optional if you store images locally)
                if (File::exists(public_path($image->product_image))) {
                    File::delete(public_path($image->product_image));
                }

                // Delete the image record from the database
                $image->delete();

                return response()->json(['success' => 'Image deleted successfully']);
            } else {
                return response()->json(['error' => 'Image not found'], 404);
            }
        } catch (\Exception $e) {
            // Catch any errors and return an error response
            return response()->json(['error' => 'Failed to delete the image.'], 500);
        }
    }




    public function delete($id)
    {

        $product = Product::with('productImages')->find($id);

        if (isset($product->productImages) && count($product->productImages) > 0) {

            foreach ($product->productImages as $item) {
                if ($item->product_image && file_exists(public_path($item->product_image))) {
                    unlink(public_path($item->product_image));
                }
            }
        }
        $product->delete();
        FlashMessage::flash('success', 'Product deleted successfully.');
        return redirect()->back();
    }



}
