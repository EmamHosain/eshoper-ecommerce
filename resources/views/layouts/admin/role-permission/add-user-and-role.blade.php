@extends('layouts.admin.admin-master')

@section('title')
Assign Role and Create User
@endsection

@section('content')

<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header mb-3">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="container d-flex justify-content-between align-items-center">
                <div class="">
                    <h3 class="mb-0">Assign Role and Create User</h3>
                </div>
                <div class="">
                    <a class="btn btn-primary" href="{{ route('admin.get_all_role') }}">All Roles</a>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Row-->
            <div class="row g-4">
                <!--begin::Col-->


                <!-- Form for Creating User -->
                <div class="card card-primary card-outline mb-4 col-12 col-md-6">
                    <!--begin::Header-->
                    <div class="card-header">
                        <div class="card-title">Create New User</div>
                    </div>
                    <!--end::Header-->

                    <!--begin::Form-->
                    <form action="{{ route('admin.create_user_for_role') }}" method="POST">
                        @csrf
                        <!--begin::Body-->
                        <div class="card-body">
                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ old('name') }}" placeholder="Enter Name">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" value="{{ old('email') }}" placeholder="Enter Email">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Enter Password">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!--end::Body-->

                        <!--begin::Footer-->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Create User</button>
                        </div>
                        <!--end::Footer-->
                    </form>
                    <!--end::Form-->
                </div>

                <!-- Form for Assigning Role to User -->
                <div class="card card-primary card-outline mb-4 col-12 col-md-6">
                    <!--begin::Header-->
                    <div class="card-header">
                        <div class="card-title">Assign Role To User</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Form-->
                    <form action="{{ route('admin.assing_role_to_user') }}" method="POST">
                        @csrf
                        <!--begin::Body-->
                        <div class="card-body">
                            <!-- Select User -->
                            <div class="mb-3">
                                <label for="user_id" class="form-label">Select User</label>
                                <select class="form-control @error('user') is-invalid @enderror" id="user_id"
                                    name="user">
                                    <option value="">-- Select User --</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user')==$user->id ? 'selected' : ''
                                        }}>
                                        {{ $user->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('user')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Select Role -->
                            <!-- Select Role -->
                            <div class="mb-3">
                                <label for="roles" class="form-label">Select Roles</label>
                                <div class="d-flex flex-wrap">
                                    @foreach($roles as $role)
                                    <div class="form-check me-3">
                                        <input class="form-check-input @error('role') is-invalid @enderror"
                                            type="checkbox" name="role[]" id="role_{{ $role->id }}"
                                            value="{{ $role->id }}" {{ in_array($role->id, old('role', [])) ? 'checked'
                                        : '' }}>
                                        <label class="form-check-label" for="role_{{ $role->id }}">
                                            {{ $role->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                        </div>
                        <!--end::Body-->

                        <!--begin::Footer-->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Assign Role</button>
                        </div>
                        <!--end::Footer-->
                    </form>
                    <!--end::Form-->
                </div>

                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>

@endsection