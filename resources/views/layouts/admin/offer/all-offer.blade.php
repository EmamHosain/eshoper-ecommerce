@extends('layouts.admin.admin-master')

@section('title')
All Offers
@endsection

@section('content')
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header mb-3">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class=" d-flex justify-content-between align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">All Offers</h3>
                </div>
                <div class="">
                    <a class="btn btn-primary" href="{{ route('admin.add_offer') }}">Add Offer</a>
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
        <div class="container-fluid overflow-auto">
            <!--begin::Row-->
            <div class="row g-4">
                <!--begin::Col-->
                <div class="container-fluid mt-4 overflow-auto">
                    <div class="form-group col-12 col-md-2">
                        <label for="status-filter">Filter by Status:</label>
                        <select class="form-control" id="status-filter">
                            <option value="">All status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <table id="datatable" class="table table-bordered dt-responsive w-100" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Description</th>
                                <th>Banner Image</th>
                                <th>Product</th>
                                <th>Status</th>
                                <th>Show On</th>
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
            ajax:{
                url : "{{ route('admin.all_offer') }}",
                data : function(d){
                    d.status = $('#status-filter').val();
                }
            } ,
            columns: [
                { data: 'id', name: 'id' }, 
                { data: 'description', name: 'description' },
                { data: 'banner_image', name: 'banner_image' }, 
                { data: 'product_name', name: 'product_name'}, 
                { data: 'status', name: 'status' }, 
                { data: 'show', name: 'show' }, 
                { data: 'action', name: 'action', orderable: false, searchable: false } // Actions (edit, delete)
            ]
        });

        $('#status-filter').change(function(){
            table.draw();
        });
    });
</script>
@endsection