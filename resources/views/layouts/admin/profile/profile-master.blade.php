@extends('layouts.admin.admin-master')

@section('title')
Profile
@endsection


@section('content')
<div class="container light-style flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-4">
        Profile Settings
    </h4>

    <div class="card overflow-hidden">
        <div class="row no-gutters row-bordered row-border-light">
            {{-- tab link --}}
            <div class="col-md-3 pt-0" id="nav-tab" role="tablist">
                <div class="list-group list-group-flush account-settings-links">
                    <a href="{{ route('admin.profile_page') }}" class="list-group-item list-group-item-action {{ Route::currentRouteName() === 'admin.profile_page' ? 'active' : '' }}">My
                        Profile</a>
                    <a href="{{ route('admin.change_password_page') }}" class="list-group-item list-group-item-action {{ Route::currentRouteName() === 'admin.change_password_page' ? 'active' : '' }}">Change
                        password</a>
                </div>
            </div>

            {{-- tab content start here --}}
            <div class="col-md-9">
                @yield('profile-content')
            </div>
        </div>

    </div>

</div>
@endsection