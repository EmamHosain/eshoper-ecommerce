@extends('layouts.admin.admin-master')

@section('title')
All Order
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
                    <h3 class="mb-0">All Order</h3>
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
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row g-4">
                <!--begin::Col-->
                <div class="overflow-auto">
                    <div class="form-group col-12 col-md-2">
                        <label for="status-filter">Filter by Order Status:</label>
                        <select class="form-control" id="status-filter">
                            <option value="">All status</option>
                            <option value="pending">Pending order</option>
                            <option value="cancelled">Cancelled order</option>
                            <option value="completed">Completed order</option>
                        </select>
                    </div>

                    <table id="datatable" class="table table-bordered dt-responsive w-100" style="width:100%">
                        <thead>
                            <tr>
                                <th>SI</th>
                                <th>Order Id</th>
                                <th>Shipping Area</th>
                                <th>Sub Total</th>
                                <th>Shipping cost</th>
                                <th>Grand Total</th>
                                <th>Discount</th>
                                <th>Coupon Code</th>
                                <th>Payment Method</th>
                                <th>Order Status</th>
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

<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.all_order') }}",
                data: function(d) {
                    d.order_status = $('#status-filter').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'order_code', name: 'order_code' },
                { data: 'shipping_area', name: 'shipping_area' },
                { data: 'sub_total', name: 'sub_total', orderable: false, searchable: false },
                { data: 'shipping_cost', name: 'shipping_cost', orderable: false, searchable: false },
                { data: 'grand_total', name: 'grand_total', orderable: false, searchable: false },
                { data: 'discount', name: 'discount' },
                { data: 'coupon', name: 'coupon' },
                
                { data: 'payment_method', name: 'payment_method' },
                { data: 'order_status', name: 'order_status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        // Handle status filter change event
        $('#status-filter').change(function() {
            table.draw();
        });
    });
</script>


@endsection