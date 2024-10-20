@extends('layouts.admin.admin-master')

@section('title')
All Role & Permission
@endsection

@section('content')
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header mb-3">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="container d-flex justify-content-between align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">All Roles</h3>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->


    <div class="container mb-5">
        <form action="{{ route('admin.store_role') }}" method="POST">
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <label for="role_name" class="form-label">Role Name</label>
                <div class="row">
                    <div class="col-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="role_name"
                            name="name" value="{{ old('name') }}" aria-describedby="roleNameHelp"
                            placeholder="Enter Role Name">
                    </div>
                    <div class="card-footer col-2">
                        <button type="submit" class="btn btn-primary d-block w-100">Submit</button>
                    </div>

                </div>
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

        </form>
    </div>





    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Row-->
            <div class="row g-4">
                <!--begin::Col-->
                <div class="container overflow-auto">
                    <table id="datatable" class="table table-bordered dt-responsive w-100" style="width:100%">
                        <thead>
                            <tr>
                                <th>Si</th>
                                <th>Guard Name</th>
                                <th>Role Name</th>
                                <th>Permissions</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be loaded here via DataTables -->
                        </tbody>
                    </table>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>

<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.get_all_role') }}",
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false }, // Serial number (Si) column
                { data: 'guard_name', name: 'guard_name' },
                { data: 'name', name: 'name' },
                { data: 'permissions', name: 'permissions' },
                { data: 'action', name: 'action', orderable: false, searchable: false } // Action column for edit/delete buttons
            ]
        });
    });
</script>

@endsection