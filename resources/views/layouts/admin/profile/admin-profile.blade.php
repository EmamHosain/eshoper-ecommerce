@extends('layouts.admin.profile.profile-master')


@section('profile-content')
{{-- main content --}}
<div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <form action="{{ route('admin.profile_update_submit') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="card-body media align-items-center">
            @if (empty($admin->photo))
            <img src="{{ asset('assets/empty-image-300x240.jpg') }}" id="imagePreview" alt="Avatar"
                class="d-block me-4 img-thumbnail rounded-circle mb-2" style="width: 100px; height: 100px;">
            @else
            <img src="{{ asset($admin->photo) }}" id="imagePreview" alt="Avatar"
                class="d-block me-4 img-thumbnail rounded-circle mb-2" style="width: 100px; height: 100px;">
            @endif

            <div class="media-body ml-4">
                <input name="photo" type="file" id="photoInput" class="account-settings-fileinput @error('photo')
                                        is-invalid
                                    @enderror">
                @error('photo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

        </div>
        <hr class="border-light m-0">
        <div class="card-body">

            <div class="form-group mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control @error('name')
                                    is-invalid
                                @enderror" name="name" value="{{ old('name',$admin->name) }}">

                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">E-mail</label>
                <input type="email" class="form-control mb-1 @error('email')
                                is-invalid
                            @enderror" name="email" value="{{ old('email',$admin->email) }}">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>



            <div class="text-right mt-3">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>

    </form>
</div>





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
        $("#photoInput").change(function() {
            readURL(this);
        });
    });
</script>
@endsection