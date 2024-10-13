@extends('layouts.admin.admin-master')

@section('title')
Add Coupon
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
                    <h3 class="mb-0">Add Coupon</h3>
                </div>
                <div class="">
                    <a class="btn btn-primary" href="{{ route('admin.all_coupon') }}">All Coupons</a>
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
                            <div class="card-title">Add Coupon</div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form action="{{ route('admin.store_coupon') }}" method="POST">
                            @csrf
                            <!--begin::Body-->
                            <div class="card-body">

                                <div class="mb-3">
                                    <label for="coupon_name" class="form-label">Coupon Name</label>
                                    <input type="text" class="form-control @error('coupon_name') is-invalid @enderror"
                                        id="coupon_name" name="coupon_name" value="{{ old('coupon_name') }}"
                                        placeholder="Enter Coupon Name">
                                    @error('coupon_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="coupon_desc" class="form-label">Coupon Description</label>
                                    <textarea class="form-control @error('coupon_desc') is-invalid @enderror"
                                        id="coupon_desc" name="coupon_desc" placeholder="Enter Coupon Description">{{
                                        old('coupon_desc') }}</textarea>
                                    @error('coupon_desc')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="validity_date_time" class="form-label">Validity Date and Time</label>
                                    <input type="datetime-local" min="{{ Carbon\Carbon::now()->setTimezone('Asia/Dhaka')->format('Y-m-d\TH:i') }}"
                                        class="form-control @error('validity_date_time') is-invalid @enderror"
                                        id="validity_date_time" name="validity_date_time"
                                        value="{{ old('validity_date_time') }}">
                                    @error('validity_date_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                


                                <div class="mb-3">
                                    <label for="discount" class="form-label">Discount</label>
                                    <input type="number" step="0.01" min="0.01"
                                        class="form-control @error('discount') is-invalid @enderror" id="discount"
                                        name="discount" value="{{ old('discount') }}" placeholder="Enter Discount">
                                    @error('discount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status"
                                        name="status">
                                        <option value="" selected disabled>Select status</option>
                                        <option value="1" {{ old('status')==1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status')==0 && old('status') !==null ? 'selected' : ''
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