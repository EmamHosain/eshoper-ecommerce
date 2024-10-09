@extends('layouts.admin.admin-master')

@section('title')
Add Category Slider
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
                    <h3 class="mb-0">Category Slider</h3>
                </div>
                <div class="">
                    <a class="btn btn-primary" href="{{ route('admin.all_category_slider') }}">All Category Slider</a>
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
                            <div class="card-title">Add Category Slider</div>
                        </div>
                        <form action="{{ route('admin.store_category_slider') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="mb-3">
                                    <label for="heading_one" class="form-label">Heading One</label>

                                    <textarea id="text_editor" name="heading_one">
                                        {{ old('heading_one') }}
                                    </textarea>


                                    @error('heading_one')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="heading_two" class="form-label">Heading Two</label>

                                    <textarea id="another_text_editor" name="heading_two">
                                        {{ old('heading_two') }}
                                    </textarea>


                                    @error('heading_two')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="button_text" class="form-label">Button Text</label>
                                    <input type="text" class="form-control @error('button_text') is-invalid @enderror"
                                        id="button_text" name="button_text" value="{{ old('button_text') }}"
                                        placeholder="Enter button text">
                                    @error('button_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label for="button_link" class="form-label">Button Link</label>
                                    <input type="text" class="form-control @error('button_link') is-invalid @enderror"
                                        id="button_link" name="button_link" value="{{ old('button_link') }}"
                                        placeholder="Enter button link">
                                    @error('button_link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>



                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category<span
                                            class="text-danger h4">*</span></label>
                                    <select name="category" class="form-select @error('category') is-invalid @enderror"
                                        id="category_id">
                                        <option selected disabled value="">Select category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category')==$category->id ?
                                            'selected' : '' }}>
                                            {{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <img src="{{ asset('assets/empty-image-300x240.jpg') }}" id="categorySliderPreview"
                                    alt="Avatar" class="d-block me-4 img-thumbnail mb-2"
                                    style="width: 100px; height: 100px;">

                                <label for="category_slider" class="form-label">Category Slider<span
                                        class="text-danger h4">*</span></label>
                                <div style="font-size: 12px">Image must be or grater than (1200 x 600)</div>

                                <div class="input-group mb-3">
                                    <input type="file" class="form-control @error('slider') is-invalid @enderror"
                                        id="category_slider" name="slider">
                                    <label class="input-group-text" for="category_slider">Upload</label>



                                    @error('slider')
                                    <div style="font-size: 13px" class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="mb-3">
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
                    $('#categorySliderPreview').attr('src', e.target.result); // Set the image source to the uploaded file's URL
                }

                reader.readAsDataURL(input.files[0]); // Read the file and trigger the load event
            }
        }

        // Trigger the readURL function when the file input changes
        $("#category_slider").change(function() {
            readURL(this);
        });
    });
</script>
@endsection