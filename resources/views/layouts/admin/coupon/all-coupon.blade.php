@extends('layouts.admin.admin-master')

@section('title')
All Coupon
@endsection

@section('content')
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header mb-3">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="d-flex justify-content-between align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">All Coupon</h3>
                </div>
                <div class="">
                    <a class="btn btn-primary" href="{{ route('admin.add_coupon') }}">Add Coupon</a>
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
                <div class="container">
                    <table id="datatable" class="table table-bordered dt-responsive w-100" style="width:100%">
                        <thead>
                            <tr>
                                <th>Si</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Max Uses</th>
                                <th>Max Uses User</th>
                                <th>Dis Type</th>
                                <th>Dis Amount</th>
                                <th>Subtotal Min Amount</th>

                                <th>Start At</th>
                                <th>End At</th>

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
                ajax: "{{ route('admin.all_coupon') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },

                    {
                        data: 'max_uses',
                        name: 'max_uses'
                    },
                    {
                        data: 'max_uses_user',
                        name: 'max_uses_user'
                    },

                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'discount_amount',
                        name: 'discount_amount'
                    },
                    {
                        data: 'min_amount',
                        name: 'min_amount'
                    },
                    {
                        data: 'starts_at',
                        name: 'starts_at'
                    },
                    {
                        data: 'expires_at',
                        name: 'expires_at'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
</script>
@endsection