@extends('layouts.admin.admin-master')

@section('title')
All Category Sliders
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
                    <h3 class="mb-0">All Category Sliders</h3>
                </div>
                <div class="">
                    <a class="btn btn-primary" href="{{ route('admin.add_category_slider') }}">Add Category Slider</a>
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
                                <th>Category Name</th>
                                <th>Slider Image</th>
                                <th>Heading One</th>
                                <th>Heading Two</th>
                                <th>Button Text</th>
                                <th>Button Link</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be loaded here via DataTables -->
                        </tbody>
                    </table>
                </div>
                <!--end::Col-->
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
    </div>
</main>

<!-- DataTable and Ajax Script -->
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.all_category_slider') }}", // Fetch data via AJAX from the controller
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false }, // Serial number (Si) column
                { data: 'category', name: 'category' },
                { data: 'slider', name: 'slider', orderable: false, searchable: false }, 
                { data: 'heading_one', name: 'heading_one' },
                { data: 'heading_two', name: 'heading_two' },
                { data: 'button_text', name: 'button_text' },
                { data: 'button_link', name: 'button_link' },
                { data: 'status', name: 'status' }, 
                { data: 'action', name: 'action', orderable: false, searchable: false } 
            ]
        });
    });
</script>

@endsection