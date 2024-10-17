@extends('layouts.admin.admin-master')

@section('title')
About Us
@endsection

@section('content')
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header mb-3">
        <div class="container-fluid">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">About Us</h3>
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
                            <div class="card-title">About Us</div>
                        </div>
                        <form action="{{ route('admin.about_us_update_or_create') }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="card-body">

                                <div class="mb-3">
                                    <label for="about_us" class="form-label">About</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                        name="about_us" id="text_editor" aria-label="With textarea"
                                        placeholder="Enter about us content">{{
                                        old('about_us',$setting ? $setting->about_us : '') }}
                                    </textarea>
                                    @error('about_us')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
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