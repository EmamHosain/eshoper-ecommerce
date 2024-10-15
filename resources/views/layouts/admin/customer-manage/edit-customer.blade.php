@extends('layouts.admin.admin-master')

@section('title')
Edit Customer
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
                    <h3 class="mb-0">Edit Customer</h3>
                </div>
                <div class="">
                    <a class="btn btn-primary" href="{{ route('admin.all_customer') }}">All Customers</a>
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
                            <div class="card-title">Edit Customer</div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form action="{{ route('admin.update_customer', $customer->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <!-- Adding the method directive for PUT request -->
                            <!--begin::Body-->
                            <div class="card-body">
                                <div class="row">
                                    <!-- First Name -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label for="first_name" class="form-label">First Name</label>
                                        <input type="text"
                                            class="form-control @error('first_name') is-invalid @enderror"
                                            id="first_name" name="first_name"
                                            value="{{ old('first_name', $customer->first_name) }}"
                                            aria-describedby="firstNameHelp" placeholder="Enter First Name">
                                        @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Last Name -->
                                    <div class="mb-3 col-12 col-md-6">
                                        <label for="last_name" class="form-label">Last Name</label>
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                            id="last_name" name="last_name"
                                            value="{{ old('last_name', $customer->last_name) }}"
                                            aria-describedby="lastNameHelp" placeholder="Enter Last Name">
                                        @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Email -->
                                    <div class="mb-3 col-12 col-md-4">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email', $customer->email) }}"
                                            aria-describedby="emailHelp" placeholder="Enter Email">
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Password (Optional) -->
                                    <div class="mb-3 col-12 col-md-4">
                                        <label for="password" class="form-label">Password <small>(Leave blank if not
                                                changing)</small></label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            name="password" placeholder="Enter New Password (Optional)">
                                        @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Mobile -->
                                    <div class="mb-3 col-12 col-md-4">
                                        <label for="mobile" class="form-label">Mobile</label>
                                        <input type="text" class="form-control @error('mobile') is-invalid @enderror"
                                            id="mobile" name="mobile" value="{{ old('mobile', $customer->mobile) }}"
                                            aria-describedby="mobileHelp" placeholder="Enter Mobile Number">
                                        @error('mobile')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address"
                                        name="address" rows="3" placeholder="Enter Address">{{ old('address',
                                        $customer->address) }}</textarea>
                                    @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <!-- City -->
                                    <div class="mb-3 col-12 col-md-4">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror"
                                            id="city" name="city" value="{{ old('city', $customer->city) }}"
                                            aria-describedby="cityHelp" placeholder="Enter City">
                                        @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- State -->
                                    <div class="mb-3 col-12 col-md-4">
                                        <label for="state" class="form-label">State</label>
                                        <input type="text" class="form-control @error('state') is-invalid @enderror"
                                            id="state" name="state" value="{{ old('state', $customer->state) }}"
                                            aria-describedby="stateHelp" placeholder="Enter State">
                                        @error('state')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Zip -->
                                    <div class="mb-3 col-12 col-md-4">
                                        <label for="zip" class="form-label">Zip Code</label>
                                        <input type="text" class="form-control @error('zip') is-invalid @enderror"
                                            id="zip" name="zip" value="{{ old('zip', $customer->zip) }}"
                                            aria-describedby="zipHelp" placeholder="Enter Zip Code">
                                        @error('zip')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Status (Optional if relevant) -->
                                @if (isset($shipping_areas) && count($shipping_areas) > 0)
                                <div class="mb-4">
                                    <label for="status" class="form-label">Shipping Area</label>
                                    <select name="shipping_area"
                                        class="form-select @error('shipping_area') is-invalid @enderror" id="status">
                                        <option disabled value="">Select status</option>
                                        @foreach ($shipping_areas as $item)
                                        <option class="text-capitalize" value="{{ $item->id }}" {{ old('shipping_area',
                                            isset($customer->shipping_manage_id) ? $customer->shipping_manage_id : '' )
                                            == $item->id ? 'selected' : '' }}>
                                            {{ $item->shipping_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('shipping_area')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                @endif
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
@endsection