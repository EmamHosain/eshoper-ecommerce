@extends('layouts.admin.admin-master')

@section('title')
Edit Contact Page
@endsection

@section('content')

<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header mb-3">
        <div class="container-fluid">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Contact Page</h3>
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
                            <div class="card-title">Edit Contact Page</div>
                        </div>
                        <form action="{{ route('admin.update_contact_page_info') }}" method="POST">
                            @method('patch')
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    {{-- Contact Heading --}}
                                    <div class="mb-3 col-12">
                                        <label for="contact_heading" class="form-label">Contact Heading <span
                                                class="text-danger h4">*</span></label>
                                        <input type="text"
                                            class="form-control @error('contact_heading') is-invalid @enderror"
                                            id="contact_heading" name="contact_heading"
                                            value="{{ old('contact_heading',!empty($contact) ? $contact->contact_heading : '') }}"
                                            placeholder="Enter contact heading">
                                        @error('contact_heading')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Description --}}
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                        name="description" id="description" aria-label="With textarea"
                                        placeholder="Enter description">{{ old('description',!empty($contact) ?
                                        $contact->description : '' ) }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    {{-- Address --}}
                                    <div class="mb-3 col-12">
                                        <label for="address" class="form-label">Address <span
                                                class="text-danger h4">*</span></label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                                            id="address" name="address"
                                            value="{{ old('address',!empty($contact) ? $contact->address : '') }}"
                                            placeholder="Enter address">
                                        @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- Phone --}}
                                    <div class="mb-3 col-12 col-md-6">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" name="phone"
                                            value="{{ old('phone',!empty($contact) ? $contact->phone : '') }}"
                                            placeholder="Enter phone number">
                                        @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Email --}}
                                    <div class="mb-3 col-12 col-md-6">
                                        <label for="email" class="form-label">Email <span
                                                class="text-danger h4">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email"
                                            value="{{ old('email',!empty($contact) ? $contact->email : '') }}"
                                            placeholder="Enter email">
                                        @error('email')
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
    <!--end::App Content-->
</main>
@endsection