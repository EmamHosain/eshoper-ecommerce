@extends('layouts.user.master')

@section('title')
Register
@endsection

@section('header')
@include('pages.frontend.component.header2')
@endsection

@section('content')
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Register</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{ route('index') }}">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Register</p>
        </div>
    </div>
</div>

<div class="login-box">
    <div class="card card-outline card-primary" style="width: 400px; margin:0px auto;">
        <div class="card-header text-center">
            <h3 class="card-title">Register</h3>
        </div>
        <div class="card-body">
            {{-- registration form start --}}
            <form action="{{ route('register_submit') }}" method="post">
                @csrf
                <!-- Full Name Field -->
                <div class="mb-3">
                    <div class="input-group">
                        <div class="form-floating flex-grow-1">
                            <label for="registerFullName">Full Name</label>
                            <input id="registerFullName" type="text" name="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                placeholder="Enter your full name">
                        </div>
                    </div>
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="mb-3">
                    <div class="input-group">
                        <div class="form-floating flex-grow-1">
                            <label for="registerEmail">Email</label>
                            <input id="registerEmail" type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                placeholder="Enter your email">
                        </div>
                    </div>
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-3">
                    <div class="input-group">
                        <div class="form-floating flex-grow-1">
                            <label for="registerPassword">Password</label>
                            <input id="registerPassword" type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Enter your password">
                        </div>
                    </div>
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Terms Checkbox and Sign Up Button -->
                <div class="row mb-3">
                    <div class="col-8 d-inline-flex align-items-center">
                        <div class="form-check">
                            <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox"
                                name="terms" id="flexCheckDefault" {{ old('terms') ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexCheckDefault">
                                I agree to the <a href="#">terms</a>
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                    </div>
                </div>
                @error('terms')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </form>
            {{-- registration form end --}}

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
                <a href="{{ route('login') }}" class="text-center">Sign In</a>
            </p>
        </div>
    </div>
</div>
@endsection