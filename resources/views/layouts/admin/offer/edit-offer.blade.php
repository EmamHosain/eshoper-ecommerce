@extends('layouts.admin.admin-master')

@section('title')
Edit Offer
@endsection

@section('content')

<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header mb-3">
        <div class="container-fluid">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="">
                    <h3 class="mb-0">Edit Offer</h3>
                </div>
                <div class="">
                    <a class="btn btn-primary" href="{{ route('admin.all_offer') }}">All Offers</a>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->
    <div class="app-content">
        <div class="container">
            <div class="row g-4">
                <div class="col-12">
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Edit Offer</div>
                        </div>
                        <form action="{{ route('admin.update_offer', $offer->id) }}" method="POST"
                            enctype="multipart/form-data">

                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="mb-4">
                                    <label for="product" class="form-label">Product</label>
                                    <select name="product" class="form-select @error('product') is-invalid @enderror"
                                        id="product">
                                        <option disabled value="">Select product</option>
                                        @foreach ($products as $product)
                                        <option value="{{ $product->id }}" {{ old('product', $offer->product_id) ==
                                            $product->id ? 'selected' : '' }}>{{ $product->product_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('product')
                                    <div class=" text-danger" style="font-size: 13px">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="offer_description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                        id="offer_description" name="description">{{ old('description',
                                        $offer->description) }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <img src="{{ asset($offer->banner_image ?? 'assets/empty-image-300x240.jpg') }}"
                                    id="offerImagePreview" alt="Offer Image" class="d-block me-4 img-thumbnail mb-2"
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
                                        <select name="show" class="form-select @error('show') is-invalid @enderror"
                                            id="show">
                                            <option disabled value="">Select one</option>
                                            <option value="home_page" {{ old('show', $offer->show) == 'home_page' ?
                                                'selected' : '' }}>Home Page</option>
                                            <option value="offer_page" {{ old('show', $offer->show) == 'offer_page' ?
                                                'selected' : '' }}>Offer page</option>
                                        </select>
                                        @error('show')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-4 col-12 col-md-6">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" class="form-select @error('status') is-invalid @enderror"
                                            id="status">
                                            <option disabled value="">Select status</option>
                                            <option value="1" {{ old('status', $offer->status) == '1' ? 'selected' : ''
                                                }}>Active</option>
                                            <option value="0" {{ old('status', $offer->status) == '0' ? 'selected' : ''
                                                }}>Inactive</option>
                                        </select>
                                        @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
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
</main>

<script>
    $(document).ready(function() {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#offerImagePreview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#offer_image").change(function() {
            readURL(this);
        });
    });
</script>

@endsection