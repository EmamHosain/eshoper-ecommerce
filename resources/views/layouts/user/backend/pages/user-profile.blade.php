@extends('layouts.user.backend.user-master')
@section('title')
Profile
@endsection
@section('content')
<!-- Main Content -->
<main class="">
    <div class="dashboard-header">
        <h3>Profile</h3>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <!-- Profile Picture Section -->
                <form method="POST" action="{{ route('update_user_profile_image',$user->id) }}" class="card"
                    enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <div class="card-body text-center">
                        <img id="imagePreview"
                            src="{{ $user->photo ? asset($user->photo) : asset('assets/empty-image-300x240.jpg') }}"
                            width="150px" height="150px" alt="Profile Picture" class="img-fluid rounded-circle mb-3">

                        <div class="mb-3">
                            <input id="image" type="file" name="photo"
                                class="form-control @error('photo') is-invalid @enderror">
                            @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary w-full">Update Photo</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-8">
                <!-- User Profile Form -->
                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="{{ route('user_update_profile',$user->id) }}">
                            @csrf
                            @method('patch')

                            <div class="mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                    id="firstName" name="first_name" placeholder="Enter your first name"
                                    value="{{ old('first_name', $user->first_name) }}">
                                @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                    id="lastName" name="last_name" placeholder="Enter your last name"
                                    value="{{ old('last_name', $user->last_name) }}">
                                @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" placeholder="Enter your email"
                                    value="{{ old('email', $user->email) }}">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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


<script>
    $(document).ready(function() {
        // Function to handle the image preview
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imagePreview').attr('src', e.target.result); // Set the image source to the uploaded file's URL
                }

                reader.readAsDataURL(input.files[0]); // Read the file and trigger the load event
            }
        }

        // Trigger the readURL function when the file input changes
        $("#image").change(function() {
            readURL(this);
        });
    });
</script>
@endsection