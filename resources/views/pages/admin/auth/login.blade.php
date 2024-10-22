@extends('layouts.user.master')

@section('title')
Admin Login
@endsection



@section('header')
@include('pages.frontend.component.header2')
@endsection



@section('content')
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Admin Sign In</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{ route('index') }}">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Sign In</p>
        </div>
    </div>
</div>
<!-- Page Header End -->





<div class="login-box">
    <div class="card card-outline card-primary " style="width: 400px; margin:0px auto;">
        <div class="card-header text-center">
            <h3 class="card-title">Sign In</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.login_submit') }}" method="post">
                @csrf
                <!-- Email Field -->
                <div class="mb-3">
                    <div class="input-group">
                        <div class="form-floating flex-grow-1">
                            <label for="loginEmail">Email</label>
                            <input id="loginEmail" type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                placeholder="Enter your email">

                        </div>
                    </div>
                    @error('email')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-3">
                    <div class="input-group">
                        <div class="form-floating flex-grow-1">
                            <label for="loginPassword">Password</label>
                            <input id="loginPassword" type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Enter your password">

                        </div>
                    </div>
                    @error('password')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Remember Me & Sign In Button -->
                <div class="row mb-3">
                    <div class="col-8 d-flex align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="flexCheckDefault" {{
                                old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexCheckDefault">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </div>
            </form>

            <p class="mb-1"> <a href="{{ route('admin.forgot_password_page') }}">I forgot my password</a> </p>

        </div>
    </div>
</div>

@endsection