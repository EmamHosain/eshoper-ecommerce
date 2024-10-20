@extends('layouts.admin.admin-master')

@section('title')
Role and Permission Management
@endsection

@section('content')
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header mb-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Role and Permission Management</h3>
                <div>
                    <a class="btn btn-primary" href="{{ route('admin.get_all_role') }}">All Role</a>
                    {{-- <a class="btn btn-primary" href="{{ route('admin.add_permission') }}">Add Permission</a> --}}
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container">
            <!-- Form for Adding or Editing Roles and Permissions -->
            <div class="row g-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add & Permission</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.assign_permission_to_role') }}" method="POST" class="mt-4">
                                @csrf
                                <div class="mb-3">
                                    <label for="permission_name" class="form-label">Role</label>
                                    <select name="role" id="" class=" form-control @error('role')
                                        is-invalid
                                    @enderror">
                                        <option value="" selected disabled>select role</option>
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row px-3 g-3">
                                    @foreach ($permission_groups as $group)
                                    <div class="col-3 card">

                                        <div class="form-check">
                                            <input class="form-check-input group" type="checkbox"
                                                data-group="{{ $group->group_name }}" id="{{ $group->group_name }}">
                                            <label class="form-check-label" for="{{ $group->group_name }}">
                                                {{ $group->group_name }}
                                            </label>
                                        </div>

                                        <hr>

                                        <ul class="list-unstyled">
                                            @foreach ($permissions as $permission)
                                            @if ($group->group_name === $permission->group_name)
                                            <li>

                                                <div class="form-check">
                                                    <input class="form-check-input permission-name" type="checkbox"
                                                        data-group="{{ $permission->group_name }}" name="permission[]"
                                                        id=" {{ $permission->name }}" value="{{ $permission->id }}">
                                                    <label class="form-check-label" for=" {{ $permission->name }}">
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>

                                            </li>
                                            @endif
                                            @endforeach

                                        </ul>

                                    </div>
                                    @endforeach
                                </div>
                                <div class="mt-4 px-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content-->
</main>

<script>
    $(document).ready(function() {
        // Event listener for checkboxes with the class 'group'
        $('.group').change(function() {
            // Check if the checkbox is checked
            if ($(this).is(':checked')) {
                var group = $(this).data('group'); // Get the group from the checked checkbox
                // Check all permission checkboxes that belong to this group
                $('.permission-name[data-group="' + group + '"]').prop('checked', true);
            } else {
                var group = $(this).data('group'); // Get the group from the unchecked checkbox
                // Uncheck all permission checkboxes that belong to this group
                $('.permission-name[data-group="' + group + '"]').prop('checked', false);
            }
        });
    });
</script>

@endsection