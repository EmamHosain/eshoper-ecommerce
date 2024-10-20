@extends('layouts.admin.admin-master')

@section('title')
Edit Role
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
                    <h3 class="mb-0">Edit Role</h3>
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
                <div class="col-12">
                    <!--begin::Quick Example-->
                    <div class="card card-primary card-outline mb-4">
                        <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">Edit Role</div>
                        </div>
                        <!--end::Header-->

                        <!--begin::Form-->
                        <form action="{{ route('admin.update_role', $role->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <!-- Add method spoofing for PUT request -->
                            <!--begin::Body-->
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="role_name" class="form-label">Role Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="role_name" name="name" value="{{ old('name', $role->name) }}"
                                        aria-describedby="roleNameHelp" placeholder="Enter Role Name">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!--end::Body-->

                            <!--begin::Footer-->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            <!--end::Footer-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Quick Example-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->






            <!-- Form for Adding or Editing Roles and Permissions -->
            <div class="row g-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add & Permission</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.update_role_and_permission',$role->id) }}" method="POST"
                                class="mt-4">
                                @method('patch')
                                @csrf
                                <div class="mb-3">
                                    <label for="permission_name" class="form-label">Role</label>
                                    <select name="role" id="" class=" form-control @error('role')
                                        is-invalid
                                    @enderror">
                                        <option value="" selected disabled>select role</option>
                                        @foreach ($roles as $item)
                                        <option value="{{ $item->id }}" {{ $item->id === $role->id ? 'selected' : ''
                                            }}>{{ $item->name }}</option>
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
                                                        id=" {{ $permission->name }}" value="{{$permission->id }}" {{
                                                        in_array($permission->id,$permision_ids) ? 'checked' : '' }}
                                                    >
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
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>




        </div>
        <!--end::Container-->
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