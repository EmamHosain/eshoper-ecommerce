@extends('layouts.user.master')

@section('title')
Forgot Password
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
            <p class="m-0">Forgot Password</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<div class="login-box">
    <div class="card card-outline card-primary " style="width: 400px; margin:0px auto;">
        <div class="card-header text-center">
            <h3 class="card-title">Forgor Password</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('password.email') }}" method="post">
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
                <!-- Remember Me & Sign In Button -->
                <div class="row mb-3">
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection