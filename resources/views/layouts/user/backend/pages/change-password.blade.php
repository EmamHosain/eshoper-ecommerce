@extends('layouts.user.backend.user-master')
@section('title')
Change Password
@endsection
@section('content')
<!-- Main Content -->
<main class="col-md-9 col-lg-10">
    <div class="dashboard-header">
        <h3>Profile</h3>
    </div>

    <div class="container mt-5">
        <div class="row">

            <div class="col-md-12">
                <!-- User Profile Form -->
                <div class="card">

                    <!-- Change Password Form -->
                    <div class="card">
                        <div class="card-body">
                            <form>
                                <!-- Old Password -->
                                <div class="mb-3">
                                    <label for="oldPassword" class="form-label">Old Password</label>
                                    <input type="password" class="form-control" id="oldPassword"
                                        placeholder="Enter your old password" required>
                                </div>

                                <!-- New Password -->
                                <div class="mb-3">
                                    <label for="newPassword" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="newPassword"
                                        placeholder="Enter your new password" required>
                                </div>

                                <!-- Confirm New Password -->
                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">Confirm New
                                        Password</label>
                                    <input type="password" class="form-control" id="confirmPassword"
                                        placeholder="Confirm your new password" required>
                                </div>

                                <!-- Submit Button -->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Change
                                        Password</button>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>

</main>
@endsection