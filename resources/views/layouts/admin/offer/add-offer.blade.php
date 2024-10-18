@extends('layouts.admin.admin-master')

@section('title')
Add Offer
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
                    <h3 class="mb-0">Offer</h3>
                </div>
                <div class="">
                    <a class="btn btn-primary" href="{{ route('admin.all_offer') }}">All Offers</a>
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
                <!--begin::Col-->
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-12">
                    <!--begin::Quick Example-->
                    <div class="card card-primary card-outline mb-4">
                        <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">Add Offer</div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form action="{{ route('admin.store_offer') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!--begin::Body-->
                            <div class="card-body">

                                <div class="mb-4">
                                    <label for="product" class="form-label">Product</label>
                                    <select name="product" class="form-select @error('product') is-invalid @enderror"
                                        id="product">
                                        <option selected disabled value="">Select product</option>
                                        @foreach ($products as $product)
                                        <option value="{{ $product->id }}" {{ old('product')==$product->id? 'selected' :
                                            '' }}>{{ $product->product_name }}</option>
                                        @endforeach
                                        </option>
                                    </select>
                                    @error('product')
                                    <div class=" text-danger" style="font-size: 13px">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="offer_description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                        id="offer_description" name="description"
                                        placeholder="Enter Offer Description">{{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <img src="{{ asset('assets/empty-image-300x240.jpg') }}" id="offerImagePreview"
                                    alt="Offer Image" class="d-block me-4 img-thumbnail mb-2"
                                    style="width: 100px; height: 100px;">

                                <label for="offer_image" class="form-label">Offer Image</label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control @error('offer_image') is-invalid @enderror"
                                        id="offer_image" name="offer_image">
                                    <label class="input-group-text" for="offer_image">Upload</label>
                                    @error('offer_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="mb-4 col-12 col-md-6">
                                        <label for="show" class="form-label">Show in</label>
                                        <select name="show" class="form-select @error('status') is-invalid @enderror"
                                            id="show">
                                            <option selected disabled value="">Select one</option>
                                            <option value="home_page" {{ old('show')=='home_page' ? 'selected' : '' }}>
                                                Home
                                                Page
                                            </option>
                                            <option value="offer_page" {{ old('show')=='offer_page' ? 'selected' : ''
                                                }}>
                                                Offer page</option>
                                        </select>
                                        @error('show')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-4 col-12 col-md-6">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" class="form-select @error('status') is-invalid @enderror"
                                            id="status">
                                            <option selected disabled value="">Select status</option>
                                            <option value="1" {{ old('status')=='1' ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status')=='0' ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                        @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!--end::Body-->

                            <!--begin::Footer-->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <!--end::Footer-->
                        </form>

                        <!--end::Form-->
                    </div>
                    <!--end::Quick Example-->

                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
</main>

<script>
    $(document).ready(function() {
        // Function to handle the image preview
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#offerImagePreview').attr('src', e.target.result); // Set the image source to the uploaded file's URL
                }

                reader.readAsDataURL(input.files[0]); // Read the file and trigger the load event
            }
        }

        // Trigger the readURL function when the file input changes
        $("#offer_image").change(function() {
            readURL(this);
        });
    });
</script>
@endsection