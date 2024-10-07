@extends('layouts.admin.admin-master')

@section('title')
Add Color
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
                    <h3 class="mb-0">Color</h3>
                </div>
                <div class="">
                    <a class="btn btn-primary" href="{{ route('admin.all_color') }}">All Colors</a>
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
                <div class="col-12">
                    <!--begin::Quick Example-->
                    <div class="card card-primary card-outline mb-4">
                        <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">Add Color</div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form action="{{ route('admin.store_color') }}" method="POST">
                            @csrf
                            <!--begin::Body-->
                            <div class="card-body">

                                <div class="mb-3">
                                    <label for="color_name" class="form-label">Color Name</label>
                                    <input type="text" class="form-control @error('color_name') is-invalid @enderror"
                                        id="color_name" name="color_name" value="{{ old('color_name') }}"
                                        placeholder="Enter Color Name">
                                    @error('color_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>

@endsection