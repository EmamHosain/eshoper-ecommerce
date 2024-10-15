@extends('layouts.admin.admin-master')

@section('title')
Edit Shipping
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
                    <h3 class="mb-0">Shipping</h3>
                </div>
                <div class="">
                    <a class="btn btn-primary" href="{{ route('admin.all_shipping') }}">All Shipping</a>
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
                            <div class="card-title">Edit Shipping</div>
                        </div>
                        <form action="{{ route('admin.update_shipping',$shipping->id) }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="card-body">

                                <div class="mb-3">
                                    <label for="shipping_name" class="form-label">Shipping Name</label>
                                    <input type="text" class="form-control @error('shipping_name') is-invalid @enderror"
                                        id="shipping_name" name="shipping_name"
                                        value="{{ old('shipping_name',$shipping->shipping_name) }}"
                                        placeholder="Enter Shipping Name">
                                    @error('shipping_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="amount" class="form-label">Shipping Amount</label>
                                    <input type="number" class="form-control @error('amount') is-invalid @enderror"
                                        min="0" id="amount" name="amount" value="{{ old('amount',$shipping->amount) }}"
                                        placeholder="Enter Shipping Name">
                                    @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="mb-4">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" class="form-select @error('status') is-invalid @enderror"
                                        id="status">
                                        <option selected disabled value="">Select status</option>
                                        <option value="1" {{ old('status',$shipping->status)=='1' ? 'selected' : ''
                                            }}>Active</option>
                                        <option value="0" {{ old('status',$shipping->status)=='0' && old('status')
                                            !==null ? 'selected'
                                            : '' }}>Inactive</option>
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
@endsection