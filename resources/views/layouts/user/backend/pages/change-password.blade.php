@extends('layouts.user.backend.user-master')
@section('title')
Change Password
@endsection
@section('content')
<!-- Main Content -->
<main class="">
    <div class="dashboard-header">
        <h3>Profile</h3>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- User Profile Form -->
                <div class="card">

                    <!-- Change Password Form -->
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('change_password_submit') }}" method="post">
                                @csrf
                                @method('patch')
                                <div class="card-body pb-2">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="current_password">Current password</label>
                                        <input id="current_password" type="password" name="current_password"
                                            placeholder="Enter current password"
                                            class="form-control @error('current_password') is-invalid @enderror">
                                        @error('current_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="new_password">New password</label>
                                        <input type="password" id="new_password" name="new_password"
                                            placeholder="Enter new password"
                                            class="form-control @error('new_password') is-invalid @enderror">
                                        @error('new_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label" for="confirm_password">Confirm password</label>
                                        <input type="password" id="confirm_password" name="confirm_password"
                                            placeholder="Enter confirm password"
                                            class="form-control @error('confirm_password') is-invalid @enderror">
                                        @error('confirm_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <input type="checkbox" value="1" id="show_password">
                                    <label for="show_password">Show Password</label>

                                    <div class="text-right mt-3">
                                        <button type="submit" class="btn btn-primary">Save changes</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>

</main>

<script>
    $(document).ready(function() {
            // Detect checkbox change
            $('#show_password').change(function() {
                if ($(this).is(':checked')) {

                   
                        $('#current_password').attr('type', 'text');
                        $('#confirm_password').attr('type', 'text');
                        $('#new_password').attr('type', 'text');
                    


                } else {
                    $('#current_password').attr('type', 'password');
                    $('#confirm_password').attr('type', 'password');
                    $('#new_password').attr('type', 'password');
                }
            });
        });
</script>
@endsection