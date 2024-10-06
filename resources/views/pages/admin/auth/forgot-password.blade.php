@extends('pages.user.auth.auth-master')
@section('authTitle')
Admin | Send Email
@endsection
@section('content')
<body class="login-page bg-body-secondary">
    <div class="login-box">
        <div class="card card-outline card-primary">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="card-header"> <a href="#"
                    class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
                    <h1 class="mb-0"> <b>Admin</b>
                    </h1>
                </a> </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">Forgot Your Password? Enter Your Email</p>

                {{-- login form start --}}
                <form action="{{ route('admin.forgot_password_submit') }}" method="post">
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



                    <!-- Sign In Button -->
                    <div class="col-4">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </div>
            </div>
            </form>
            {{-- login form end --}}

        </div> <!-- /.login-card-body -->
    </div>
    </div> <!-- /.login-box -->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->

    @endsection