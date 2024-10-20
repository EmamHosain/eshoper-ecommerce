@extends('layouts.admin.admin-master')

@section('title')
All Permissions
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
                    <h3 class="mb-0">All Permissions</h3>
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
                <div class="container overflow-auto">
                    <table id="datatable" class="table table-bordered dt-responsive w-100" style="width:100%">
                        <thead>
                            <tr>
                                <th>Si</th>
                                <th>Permission Name</th>
                                <th>Group Name</th>
                                <th>Guard Name</th>
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
                url: "{{ route('admin.get_all_permission') }}",
               
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false }, // Serial number (Si) column
                { data: 'name', name: 'name' },
                { data: 'group_name', name: 'group_name' },
                { data: 'guard_name', name: 'guard_name' },
            ]
        });

        
    });
</script>

@endsection