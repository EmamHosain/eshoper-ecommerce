@extends('layouts.user.master')

@section('title')
Login
@endsection



@section('header')
@include('pages.frontend.component.header2')
@endsection



@section('content')
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Login</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{ route('index') }}">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Login</p>
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
            <form action="{{ route('login_submit') }}" method="post">
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

            <div class="social-auth-links text-center mb-3">
                <p>- OR -</p>
                <a href="{{ route('facebook_auth_redirect') }}" class="btn btn-primary btn-block">
                    <i class="bi bi-facebook me-2"></i> Sign in using Facebook
                </a>
                <a href="{{ route('google_auth_redirect') }}" class="btn btn-danger btn-block">
                    <i class="bi bi-google me-2"></i> Sign in using Google+
                </a>
            </div>

            <p class="mb-1">
                <a href="{{ route('password.request') }}">I forgot my password</a>
            </p>
            <p class="mb-0">
                <a href="{{ route('register_page') }}" class="text-center">Register</a>
            </p>
        </div>
    </div>
</div>

@endsection