@extends('layouts.admin.admin-master')

@section('title')
All Product
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
                    <h3 class="mb-0">All Product</h3>
                </div>
                <div class="">
                    <a class="btn btn-primary" href="{{ route('admin.add_product') }}">Add Product</a>
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
        <div class=" container-fluid overflow-auto">
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
                                <th>Code</th>
                                <th>Name</th>
                                <th>Short Desc</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Price</th>
                                <th>Discount Price</th>
                                <th>Quantity</th>
                                <th>Img Count</th>
                                <th>Popularity</th>
                                <th>Colors</th>
                                <th>Sizes</th>
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
                url : "{{ route('admin.all_product') }}",
                data : function(d){
                    d.status = $('#status-filter').val();
                }
            } ,
            columns: [
                { data: 'code', name: 'code'}, 
                { data: 'product_name', name: 'product_name' },
                { data: 'short_desc', name: 'short_desc' }, 
                { data: 'category_name', name: 'category_name'}, 
                { data: 'brand_name', name: 'brand_name'}, 
                { data: 'price', name: 'price' }, 
                { data: 'dis_price', name: 'dis_price'}, 
                { data: 'quantity', name: 'quantity'}, 
                { data: 'product_images_count', name: 'product_images_count'}, 
                { data: 'popularity', name: 'popularity'}, 
                { data: 'colors', name: 'colors'}, 
                { data: 'sizes', name: 'sizes'}, 
                { data: 'status', name: 'status' }, 
                { data: 'action', name: 'action', orderable: false, searchable: false } // Column for actions (edit, delete)
            ]
        });

        $('#status-filter').change(function(){
            table.draw();
        })
    });
</script>
@endsection