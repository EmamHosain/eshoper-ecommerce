@extends('layouts.admin.admin-master')

@section('title')
Edit Brand
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
                    <h3 class="mb-0">Edit Brand</h3>
                </div>
                <div class="">
                    <a class="btn btn-primary" href="{{ route('admin.all_brand') }}">All Brand</a>
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
                            <div class="card-title">Edit Brand</div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form action="{{ route('admin.update_brand', $brand->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <!-- Include the PUT method for updating -->
                            <!--begin::Body-->
                            <div class="card-body">

                                <div class="mb-3">
                                    <label for="brand_name" class="form-label">Brand Name</label>
                                    <input type="text" class="form-control @error('brand_name') is-invalid @enderror"
                                        id="brand_name" name="brand_name"
                                        value="{{ old('brand_name', $brand->brand_name) }}"
                                        aria-describedby="brandNameHelp" placeholder="Enter Brand Name">
                                    @error('brand_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <img src="{{ $brand->brand_logo ? asset($brand->brand_logo) : asset('assets/empty-image-300x240.jpg') }}"
                                    id="brandLogoPreview" alt="Brand Logo" class="d-block me-4 img-thumbnail mb-2"
                                    style="width: 100px; height: 100px;">

                                <label for="brand_logo" class="form-label">Brand Logo</label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control @error('brand_logo') is-invalid @enderror"
                                        id="brand_logo" name="brand_logo">
                                    <label class="input-group-text" for="brand_logo">Upload</label>
                                    @error('brand_logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" class="form-select @error('status') is-invalid @enderror"
                                        id="status">
                                        <option selected disabled value="">Select status</option>
                                        <option value="1" {{ old('status', $brand->status) == 1 ? 'selected' : ''
                                            }}>Active</option>
                                        <option value="0" {{ old('status', $brand->status) == 0 ? 'selected' : ''
                                            }}>Inactive</option>
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <!--end::Body-->

                            <!--begin::Footer-->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            <!--end::Footer-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Quick Example-->
                </div>
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
                    $('#brandLogoPreview').attr('src', e.target.result); // Set the image source to the uploaded file's URL
                }

                reader.readAsDataURL(input.files[0]); // Read the file and trigger the load event
            }
        }

        // Trigger the readURL function when the file input changes
        $("#brand_logo").change(function() {
            readURL(this);
        });
    });
</script>

@endsection