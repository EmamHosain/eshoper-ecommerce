@extends('layouts.admin.admin-master')

@section('title')
All Color
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
                    <h3 class="mb-0">All Color</h3>
                </div>
                <div class="">
                    <a class="btn btn-primary" href="{{ route('admin.add_color') }}">Add Color</a>
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
                <div class="container">
                    <table id="datatable" class="table table-bordered dt-responsive w-100" style="width:100%">
                        <thead>
                            <tr>
                                <th>Si</th>
                                <th>Color Name</th>
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
            ajax: "{{ route('admin.all_color') }}", // Change this route to fetch all colors
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false }, // Serial number (Si) column
                { data: 'color_name', name: 'color_name' }, // Column for color name
                { data: 'action', name: 'action', orderable: false, searchable: false } // Column for actions (edit, delete)
            ]
        });
    });
</script>

@endsection