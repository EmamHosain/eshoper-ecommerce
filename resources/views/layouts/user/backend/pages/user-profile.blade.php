@extends('layouts.user.master')
@section('title')
Profile
@endsection
@section('content')
<!-- Main Content -->
<main class="col-md-9 col-lg-10">
    <div class="dashboard-header">
        <h3>Profile</h3>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <!-- Profile Picture Section -->
                <form class="card">
                    <div class="card-body text-center">
                        <img src="https://via.placeholder.com/150" alt="Profile Picture"
                            class="img-fluid rounded-circle mb-3">

                        <div class=" mb-3">
                            <input type="file" class="form-control">
                        </div>
                        <div class="d-flex">
                            <button type="button" class="btn btn-primary  w-full">Update Photo</button>
                        </div>

                    </div>
                </form>
            </div>

            <div class="col-md-8">
                <!-- User Profile Form -->
                <div class="card">
                    <div class="card-body">

                        <form>
                            <div class="mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName"
                                    placeholder="Enter your first name">
                            </div>

                            <div class=" mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName"
                                    placeholder="Enter your last name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter your email">
                            </div>




                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Save Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection