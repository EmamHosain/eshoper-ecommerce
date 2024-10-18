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
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>


                                    </div>

                                    <div class="row">
                                        {{-- Status --}}
                                        <div class="mb-3 col-12 col-md-6">
                                            <label for="status" class="form-label">Status</label>
                                            <select name="status" class="form-select @error('status') is-invalid @enderror"
                                                id="status">
                                                <option value="" {{ old('status') === null ? 'selected' : '' }}
                                                    disabled>
                                                    Select status
                                                </option>
                                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="0"
                                                    {{ old('status') == 0 && old('status') !== null ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Add Offer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::App Content-->
    </main>
@endsection
