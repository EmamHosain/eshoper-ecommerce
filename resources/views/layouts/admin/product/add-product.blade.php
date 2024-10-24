@extends('layouts.admin.admin-master')

@section('title')
Add Product
@endsection

@section('content')
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header mb-3">
        <div class="container-fluid">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Add Product</h3>
                </div>
                <div class="">
                    <a class="btn btn-primary" href="{{ route('admin.all_product') }}">All Product</a>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container">
            <div class="row g-4">
                <div class="col-12">
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Add Product</div>
                        
                        </div>
                        <form action="{{ route('admin.store_product') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    {{-- Product Name --}}
                                    <div class="mb-3 col-12 col-md-4">
                                        <label for="product_name" class="form-label">Product Name <span
                                                class="text-danger h4">*</span>
                                        </label>
                                        <input type="text"
                                            class="form-control @error('product_name') is-invalid @enderror"
                                            id="product_name" name="product_name" value="{{ old('product_name') }}"
                                            placeholder="Enter product name">
                                        @error('product_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    {{-- Category --}}
                                    <div class="mb-3 col-12 col-md-4">
                                        <label for="category_id" class="form-label">Category<span
                                                class="text-danger h4">*</span></label>
                                        <select name="category"
                                            class="form-select @error('category') is-invalid @enderror"
                                            id="category_id">
                                            <option selected disabled value="">Select category</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category')==$category->id ?
                                                'selected' : '' }}>
                                                {{ $category->category_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Brand --}}
                                    <div class="mb-3 col-12 col-md-4">
                                        <label for="brand_id" class="form-label">Brand</label>
                                        <select name="brand" class="form-select @error('brand') is-invalid @enderror"
                                            id="brand_id">
                                            <option selected disabled value="">Select brand</option>
                                            @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ old('brand')==$brand->id ? 'selected' :
                                                '' }}>
                                                {{ $brand->brand_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>



                                <div class="row">
                                    {{-- Price --}}
                                    <div class="mb-3 col-12 col-md-4">
                                        <label for="price" class="form-label">Price<span
                                                class="text-danger h4">*</span></label>
                                        <input type="number" min="1"
                                            class="form-control @error('price') is-invalid @enderror" id="price"
                                            name="price" value="{{ old('price') }}" placeholder="Enter price">
                                        @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Discount Price --}}
                                    <div class="mb-3 col-12 col-md-4">
                                        <label for="discount_price" class="form-label">Discount Price</label>
                                        <input type="number" min="1"
                                            class="form-control @error('discount_price') is-invalid @enderror"
                                            id="discount_price" name="discount_price"
                                            value="{{ old('discount_price') }}"
                                            placeholder="Enter discount price (optional)">
                                        @error('discount_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Quantity --}}
                                    <div class="mb-3 col-12 col-md-4">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" min="1"
                                            class="form-control @error('quantity') is-invalid @enderror" id="quantity"
                                            name="quantity" value="{{ old('quantity') }}"
                                            placeholder="Enter quantity (optional)">
                                        @error('quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>



                                {{-- product short_description --}}
                                <div class="mb-3">
                                    <label for="short_description" class="form-label">Product Short Description<span
                                            class="text-danger h4">*</span></label>
                                    <textarea class="form-control @error('short_description') is-invalid @enderror"
                                        name="short_description" id="short_description" aria-label="With textarea">{{
                                        old('short_description') }}</textarea>
                                </div>


                                {{-- product description --}}
                                <div class="mb-3">
                                    <label for="description" class="form-label">Product Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                        name="description" id="product_description" aria-label="With textarea">{{
                                        old('description') }}</textarea>
                                </div>




                                {{-- product information --}}
                                <div class="mb-3">
                                    <label for="description" class="form-label">Product Information</label>
                                    <textarea class="form-control @error('information') is-invalid @enderror"
                                        name="information" id="product_information" aria-label="With textarea">{{
                                        old('information') }}</textarea>
                                </div>





                                <div class="row">

                                    {{-- Status --}}
                                    <div class="mb-3 col-12 col-md-6">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" class="form-select @error('status') is-invalid @enderror"
                                            id="status">
                                            <option value="" {{ old('status')===null ? 'selected' : '' }} disabled>
                                                Select status
                                            </option>
                                            <option value="1" {{ old('status')==1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ old('status')==0 && old('status') !=null ? 'selected'
                                                : '' }}>
                                                Inactive</option>
                                        </select>
                                        @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="mb-3 col-12 col-md-6">
                                        <label for="popularity" class="form-label">Popularity<span
                                                class="text-danger h4">*</span></label>

                                        <select name="popularity"
                                            class="form-select @error('popularity') is-invalid @enderror"
                                            id="popularity">
                                            <option selected disabled value="">Select popularity</option>

                                            <option value="arrived" {{ old('popularity')=='arrived' ? 'selected' : ''
                                                }}> New Arrived
                                            </option>
                                            <option value="trandy" {{ old('popularity')=='trandy' ? 'selected' : '' }}>
                                                Trandy</option>
                                        </select>
                                        @error('popularity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row">
                                    <!-- Checkbox for Color -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label">Color</label>
                                        <div>
                                            @foreach ($colors as $color)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input @error('color') is-invalid @enderror"
                                                    type="checkbox" name="color[]" value="{{ $color->id }}"
                                                    id="{{ $color->color_name . '-' . $color->id }}" {{
                                                    is_array(old('color')) && in_array($color->id, old('color')) ?
                                                'checked' : '' }}>

                                                <label class="form-check-label text-capitalize"
                                                    for="{{ $color->color_name . '-' . $color->id }}">
                                                    {{ $color->color_name }}
                                                </label>
                                            </div>
                                            @endforeach

                                            @error('color')
                                            <div class="text-danger" style="font-size: 14px">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>

                                    <!-- Checkbox for Size -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label class="form-label">Size</label>
                                        <div>
                                            @foreach ($sizes as $size)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input @error('size_name') is-invalid @enderror"
                                                    type="checkbox" name="size_name[]" value="{{ $size->id }}"
                                                    id="{{ $size->size_name . '-' . $size->id }}" {{
                                                    is_array(old('size_name')) && in_array($size->id, old('size_name'))
                                                ? 'checked' : '' }}

                                                >
                                                <label class="form-check-label text-uppercase"
                                                    for="{{ $size->size_name . '-' . $size->id }}">
                                                    {{ $size->size_name }}
                                                </label>
                                            </div>
                                            @endforeach

                                            @error('size_name')
                                            <div class="text-danger" style="font-size: 14px">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>




                                <div id="preview" class="row"></div>
                                {{-- Image --}}
                                <div class="mb-3">
                                    <label for="image" class="form-label">Product Image</label><br>
                                    <span style="font-size: 12px">Image must be or grater than (500 x 500)</span>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        id="photos" name="image[]" multiple>

                                    @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    @error('image.*')
                                    <div style="font-size: 13px" class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content-->
</main>

<script>
    let selectedFiles = []; // Array to keep track of selected files
        document.getElementById('photos').addEventListener('change', function(event) {
            let previewContainer = document.getElementById('preview');
            const files = event.target.files;

            // Clear previous preview and file array
            previewContainer.innerHTML = '';
            selectedFiles = [];

            // Handle each selected file
            Array.from(files).forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    selectedFiles.push(file); // Add the file to the array

                    const reader = new FileReader();

                    reader.onload = function(e) {
                        // Create an image container with a delete button
                        const imageContainer = document.createElement('div');
                        imageContainer.classList.add('col-md-3', 'position-relative', 'd-inline-block');

                        // Create an image element
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('img-thumbnail');
                        img.style.maxWidth = '150px';
                        img.style.margin = '5px';

                        // Create a delete button
                        const deleteBtn = document.createElement('button');
                        deleteBtn.innerHTML = '×';
                        deleteBtn.classList.add('btn', 'btn-danger', 'position-absolute', 'top-0',
                            'right-0');
                        deleteBtn.style.fontSize = '20px';
                        deleteBtn.style.padding = '0 10px';
                        deleteBtn.style.cursor = 'pointer';

                        // Attach event listener to delete the image
                        deleteBtn.addEventListener('click', function() {
                            imageContainer.remove(); // Remove the image preview
                            selectedFiles.splice(index,
                            1); // Remove the file from the selectedFiles array
                        });

                        // Append the image and delete button to the container
                        imageContainer.appendChild(img);
                        imageContainer.appendChild(deleteBtn);
                        previewContainer.appendChild(imageContainer);
                    };

                    reader.readAsDataURL(file); // Read the file
                }
            });
        });
</script>

@endsection