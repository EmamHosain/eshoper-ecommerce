@extends('layouts.admin.admin-master')

@section('title')
Add Category
@endsection

@section('content')

<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header mb-3">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="container d-flex justify-content-between align-items-center">
                <div class="">
                    <h3 class="mb-0">Category</h3>
                </div>
                <div class="">
                    <a class="btn btn-primary" href="{{ route('admin.all_category') }}">All Categories</a>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Row-->
            <div class="row g-4">
                <div class="col-12">
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Add Category</div>
                        </div>
                        <form action="{{ route('admin.store_category') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="mb-3">
                                    <label for="category_name" class="form-label">Category Name</label>
                                    <input type="text" class="form-control @error('category_name') is-invalid @enderror"
                                        id="category_name" name="category_name" value="{{ old('category_name') }}"
                                        placeholder="Enter Category Name">
                                    @error('category_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                               

                                <img src="{{ asset('assets/empty-image-300x240.jpg') }}" id="categoryLogoPreview"
                                    alt="Avatar" class="d-block me-4 img-thumbnail mb-2"
                                    style="width: 100px; height: 100px;">

                                <label for="category_logo" class="form-label">Category Logo</label>
                                <div class="input-group mb-3">
                                    <input type="file"
                                        class="form-control @error('category_logo') is-invalid @enderror"
                                        id="category_logo" name="category_logo">
                                    <label class="input-group-text" for="category_image">Upload</label>
                                    @error('category_logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" class="form-select @error('status') is-invalid @enderror"
                                        id="status">
                                        <option selected disabled value="">Select status</option>
                                        <option value="1" {{ old('status')=='1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status')=='0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</main>

<script>
    $(document).ready(function() {
        // Function to handle the image preview
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#categoryLogoPreview').attr('src', e.target.result); // Set the image source to the uploaded file's URL
                }

                reader.readAsDataURL(input.files[0]); // Read the file and trigger the load event
            }
        }

        // Trigger the readURL function when the file input changes
        $("#category_image").change(function() {
            readURL(this);
        });
    });
</script>
@endsection