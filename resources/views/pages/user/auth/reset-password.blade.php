@extends('pages.user.auth.auth-master')
@section('authTitle')
Reset Password
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
                    <h1 class="mb-0"> <b>Admin</b>LTE
                    </h1>
                </a> </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">Forgot Your Password? Enter Your Email</p>

                {{-- login form start --}}
                <form action="{{ route('password.update') }}" method="post">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="mb-3">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" required autofocus>
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password">New Password</label>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </form>

                {{-- login form end --}}

            </div> <!-- /.login-card-body -->
        </div>
    </div> <!-- /.login-box -->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->

    @endsection