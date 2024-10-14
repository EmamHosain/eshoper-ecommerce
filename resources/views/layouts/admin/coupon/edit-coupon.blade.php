@extends('layouts.admin.admin-master')

@section('title')
Edit Coupon
@endsection

@section('content')
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header mb-3">
        <div class="container-fluid">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="">
                    <h3 class="mb-0">Edit Coupon</h3>
                </div>
                <div class="">
                    <a class="btn btn-primary" href="{{ route('admin.all_coupon') }}">All Coupons</a>
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
                            <div class="card-title">Edit Coupon</div>
                        </div>
                        <form action="{{ route('admin.update_coupon', number_format($coupon->id)) }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="card-body">
                                <!-- Coupon Name -->
                                <div class="row">
                                    <div class="mb-3 col-12 col-md-6">
                                        <label for="coupon_name" class="form-label">Coupon Name</label>
                                        <input type="text"
                                            class="form-control @error('coupon_name') is-invalid @enderror"
                                            id="coupon_name" name="coupon_name"
                                            value="{{ old('coupon_name', $coupon->name) }}"
                                            placeholder="Enter Coupon Name">
                                        @error('coupon_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Coupon Code -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label for="coupon_code" class="form-label">Coupon Code</label>
                                        <input type="text"
                                            class="form-control @error('coupon_code') is-invalid @enderror"
                                            id="coupon_code" name="coupon_code"
                                            value="{{ old('coupon_code', $coupon->code) }}"
                                            placeholder="Enter Coupon Code">
                                        @error('coupon_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Coupon Description -->
                                <div class="mb-3">
                                    <label for="coupon_desc" class="form-label">Coupon Description</label>
                                    <textarea class="form-control @error('coupon_desc') is-invalid @enderror"
                                        id="coupon_desc" name="coupon_desc" placeholder="Enter Coupon Description">{{
                                        old('coupon_desc', $coupon->description) }}</textarea>
                                    @error('coupon_desc')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <!-- Max Uses -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label for="max_uses" class="form-label">Maximum Uses</label>
                                        <input type="number"
                                            class="form-control @error('max_uses') is-invalid @enderror" id="max_uses"
                                            name="max_uses" value="{{ old('max_uses', $coupon->max_uses) }}"
                                            placeholder="Enter Maximum Uses">
                                        @error('max_uses')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Max Uses per User -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label for="max_uses_user" class="form-label">Maximum Uses Per User</label>
                                        <input type="number"
                                            class="form-control @error('max_uses_user') is-invalid @enderror"
                                            id="max_uses_user" name="max_uses_user"
                                            value="{{ old('max_uses_user', $coupon->max_uses_user) }}"
                                            placeholder="Enter Maximum Uses Per User">
                                        @error('max_uses_user')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Coupon Type -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label for="type" class="form-label">Coupon Type</label>
                                        <select class="form-select @error('type') is-invalid @enderror" id="type"
                                            name="type">
                                            <option value="" disabled>Select Coupon Type</option>
                                            <option value="fixed" {{ old('type', $coupon->type) == 'fixed' ? 'selected'
                                                : '' }}>Fixed
                                            </option>
                                            <option value="percent" {{ old('type', $coupon->type) == 'percent' ?
                                                'selected' : '' }}>Percent</option>
                                        </select>
                                        @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Discount Amount -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label for="discount_amount" class="form-label">Discount Amount</label>
                                        <input type="number" step="0.01"
                                            class="form-control @error('discount_amount') is-invalid @enderror"
                                            id="discount_amount" name="discount_amount"
                                            value="{{ old('discount_amount', $coupon->discount_amount) }}"
                                            placeholder="Enter Discount Amount">
                                        @error('discount_amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Minimum Amount -->
                                <div class="mb-3">
                                    <label for="min_amount" class="form-label">Minimum Amount</label>
                                    <input type="number" step="0.01"
                                        class="form-control @error('min_amount') is-invalid @enderror" id="min_amount"
                                        name="min_amount" value="{{ old('min_amount', $coupon->min_amount) }}"
                                        placeholder="Enter Minimum Amount">
                                    @error('min_amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <!-- Starts At -->
                                    <div class="mb-3 col-6 col-md-12">
                                        <label for="starts_at" class="form-label">Coupon Valid Starts At
                                            (day-month-year, time)</label>
                                        <input type="text" class="form-control @error('starts_at') is-invalid @enderror"
                                            id="starts_at" name="starts_at"
                                            value="{{ old('starts_at', $coupon->starts_at) }}"
                                            placeholder="Select Coupon Valid Starts At">
                                        @error('starts_at')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Ends At -->
                                    <div class="mb-3 col-6 col-md-12">
                                        <label for="ends_at" class="form-label">Coupon Valid Ends At (day-month-year,
                                            time)</label>
                                        <input type="text" class="form-control @error('ends_at') is-invalid @enderror"
                                            id="ends_at" name="ends_at"
                                            value="{{ old('ends_at', $coupon->expires_at) }}"
                                            placeholder="Select Coupon Valid Ends At">
                                        @error('ends_at')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status"
                                        name="status">
                                        <option value="" disabled>Select Status</option>
                                        <option value="1" {{ old('status', $coupon->status) == 1 ? 'selected' : ''
                                            }}>Active</option>
                                        <option value="0" {{ old('status', $coupon->status) == 0 ? 'selected' : ''
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $(document).ready(function() {
        $('#starts_at').datetimepicker({
                format: 'd-m-Y h:i A',
                formatTime: 'h:i A', // 12-hour format with AM/PM
                step: 15,
                ampm: true
            });

            $('#ends_at').datetimepicker({
                format: 'd-m-Y h:i A',
                formatTime: 'h:i A', // 12-hour format with AM/PM
                step: 15,
                ampm: true
            });
    });
</script>
@endsection