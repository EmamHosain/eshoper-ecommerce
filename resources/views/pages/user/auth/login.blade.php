@extends('pages.user.auth.auth-master')
@section('authTitle')
User | Login
@endsection
@section('content')
<body class="login-page bg-body-secondary">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header"> <a href="#"
                    class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                    <h1 class="mb-0"> <b>Admin</b>LTE
                    </h1>
                </a> </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                {{-- login form start --}}
                <form action="{{ route('login_submit') }}" method="post">
                    @csrf

                    <!-- Email Field -->
                    <div class="mb-3">
                        <div class="input-group">
                            <div class="form-floating">
                                <input id="loginEmail" type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    placeholder="Enter your email">
                                <label for="loginEmail">Email</label>
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

                    <!-- Email Validation Error -->


                    <!-- Password Field -->
                    <div class=" mb-3">
                        <div class="input-group">
                            <div class="form-floating">
                                <input id="loginPassword" type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter your password">
                                <label for="loginPassword">Password</label>
                            </div>
                            <div class="input-group-text">
                                <span class="bi bi-lock-fill"></span>
                            </div>
                        </div>
                        <!-- Password Validation Error -->
                        @error('password')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>



                    <!-- Remember Me Checkbox -->
                    <div class="row">
                        <div class="col-8 d-inline-flex align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="flexCheckDefault" {{
                                    old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Remember Me
                                </label>
                            </div>
                        </div>

                        <!-- Sign In Button -->
                        <div class="col-4">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Sign In</button>
                            </div>
                        </div>
                    </div>
                </form>
                {{-- login form end --}}





                <div class="social-auth-links text-center mb-3 d-grid gap-2">
                    <p>- OR -</p> <a href="{{ route('facebook_auth_redirect') }}" class="btn btn-primary"> <i class="bi bi-facebook me-2"></i> Sign in using
                        Facebook
                    </a> 
                    
                    
                    {{-- login with google --}}
                    <a href="{{ route('google_auth_redirect') }}" class="btn btn-danger"> <i class="bi bi-google me-2"></i> Sign in using Google+
                    </a>


                </div> <!-- /.social-auth-links -->
                <p class="mb-1"> <a href="{{ route('password.request') }}">I forgot my password</a> </p>
                <p class="mb-0"> <a href="register.html" class="text-center">
                        Register a new membership
                    </a> </p>
            </div> <!-- /.login-card-body -->
        </div>
    </div> <!-- /.login-box -->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->

@endsection