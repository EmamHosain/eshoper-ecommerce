@extends('pages.user.auth.auth-master')
@section('authTitle')
User | Register
@endsection
@section('content')
<body class="login-page bg-body-secondary">
    <div class="register-box">
        <!-- /.register-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header"> <a href="#"
                    class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                    <h1 class="mb-0"> <b>Admin</b>LTE
                    </h1>
                </a> </div>
            <div class="card-body register-card-body">
                <p class="register-box-msg">Register a new membership</p>


                {{-- registration form start --}}
                <form action="{{ route('register_submit') }}" method="post">
                    @csrf

                    <!-- Full Name Field -->
                    <div class="mb-3">
                        <div class="input-group">
                            <div class="form-floating">
                                <input id="registerFullName" type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    placeholder="Enter your full name">
                                <label for="registerFullName">Full Name</label>
                            </div>
                            <div class="input-group-text">
                                <span class="bi bi-person"></span>
                            </div>
                        </div>
                        @error('name')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="mb-3">
                        <div class="input-group">
                            <div class="form-floating">
                                <input id="registerEmail" type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    placeholder="Enter your email">
                                <label for="registerEmail">Email</label>
                            </div>
                            <div class="input-group-text">
                                <span class="bi bi-envelope"></span>
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
                            <div class="form-floating">
                                <input id="registerPassword" type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter your password">
                                <label for="registerPassword">Password</label>
                            </div>
                            <div class="input-group-text">
                                <span class="bi bi-lock-fill"></span>
                            </div>
                        </div>
                        @error('password')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Terms Checkbox -->
                    <div class="row">
                        <div class="col-8 d-inline-flex align-items-center">
                            <div class="form-check">
                                <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox"
                                    name="terms" id="flexCheckDefault" {{ old('terms') ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckDefault">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div>
                        @error('terms')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror

                        <!-- Sign Up Button -->
                        <div class="col-4">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Sign Up</button>
                            </div>
                        </div>
                    </div>
                </form>
                {{-- registration form end --}}




                <div class="social-auth-links text-center mb-3 d-grid gap-2">
                    <p>- OR -</p> <a href="#" class="btn btn-primary"> <i class="bi bi-facebook me-2"></i> Sign in
                        using
                        Facebook
                    </a> <a href="#" class="btn btn-danger"> <i class="bi bi-google me-2"></i> Sign in using
                        Google+
                    </a>
                </div> <!-- /.social-auth-links -->
                <p class="mb-0"> <a href="login.html" class="link-primary text-center">
                        I already have a membership
                    </a> </p>
            </div> <!-- /.register-card-body -->
        </div>
    </div> <!-- /.register-box -->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    @endsection