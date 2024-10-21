@extends('layouts.user.master')

@section('title')
Reset Password
@endsection



@section('header')
@include('pages.frontend.component.header2')
@endsection



@section('content')
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Our Shop</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{ route('index') }}">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Reset Password</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<div class="login-box">
    <div class="card card-outline card-primary " style="width: 400px; margin:0px auto;">
        <div class="card-header text-center">
            <h3 class="card-title">Reset Password</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('password.update') }}" method="post">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="mb-3">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" autofocus>
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password">New Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Update Password</button>
            </form>

        </div>
    </div>
</div>

@endsection