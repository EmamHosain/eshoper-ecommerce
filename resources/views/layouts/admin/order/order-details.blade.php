@extends('layouts.admin.admin-master')

@section('title')
Order Details
@endsection

@section('content')
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header mb-3">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Row-->
            <div class="container d-flex justify-content-between align-items-center">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Order Details</h3>
                    <div>
                        <a href="{{ route('admin.order_status_change_pending_to_completed',['id'=>$order->id]) }}"
                            class="btn btn-success">Completed</a>
                        <a href="{{ route('admin.order_status_change_pending_to_cancelled',['id'=>$order->id]) }}"
                            class="btn btn-danger">Cancelled</a>
                        <a href="{{ route('admin.download_invoice',['id'=>$order->id]) }}"
                            class="btn btn-success">Download</a>
                        <a href="{{ route('admin.delete_order',['id'=>$order->id]) }}" id="delete"
                            class="btn btn-danger">Delete</a>

                    </div>
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


            {{-- start --}}


            <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2 mb-3">

                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h4>Shipping Details</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered border-primary mb-0">

                                    <tbody>
                                        <tr>
                                            <th width="50%">Shipping Area: </th>
                                            <td>{{ $order->shippingManage->shipping_name }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">Shipping Cost: </th>
                                            <td>{{ $order->shippingManage->amount }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">Shipping Phone: </th>
                                            <td>{{ $order->mobile }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">Shipping Email: </th>
                                            <td>{{ $order->email }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">Shipping Address: </th>
                                            <td>{{ $order->address }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">Order Date: </th>
                                            <td>{{
                                                Carbon\Carbon::parse($order->created_at)->setTimezone('Asia/Dhaka')->format('D-d-m-Y
                                                h:i a') }}
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->


                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h4>Order Details
                                <span class="text-danger">Invoice: {{ $order->order_code }}</span>
                            </h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered border-primary mb-0">

                                    <tbody>
                                        <tr>
                                            <th width="50%"> Name: </th>
                                            <td>{{ $order->first_name . ' ' . $order->last_name }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%"> Phone: </th>
                                            <td>{{ $order->mobile }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%"> Email: </th>
                                            <td>{{ $order->email }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">Payment Type: </th>
                                            <td>{{ $order->peyment_method_type }}</td>
                                        </tr>
                                        {{-- <tr>
                                            <th width="50%">Transx Id: </th>
                                            <td>{{ $order->order_code }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">Invoice: </th>
                                            <td class="text-danger">{{ $order->order_code }}</td>
                                        </tr> --}}
                                        <tr>
                                            <th width="50%">Order Amount: </th>
                                            <td>${{ $order->grand_total }}</td>
                                        </tr>
                                        <tr>
                                            <th width="50%">Order Status: </th>
                                            <td><span class="badge bg-success">{{ $order->order_status }}</span></td>
                                        </tr>

                                        <tr>
                                            <th width="50%"> </th>
                                            <td>
                                                {{-- @if($order->status == 'Pending' &&
                                                Auth::guard('admin')->user()->can('pending_to_confirm_order'))
                                                <a href="{{ route('admin.pendint_to_confirm_order',$order->id) }}"
                                                    class="btn btn-block btn-success" id="confirmOrder">Confirm
                                                    Order</a>

                                                @elseif ($order->status == 'Confirmed' &&
                                                Auth::guard('admin')->user()->can('confirm_to_processing_order'))
                                                <a href="{{ route('admin.confirm_to_processing_order',$order->id) }}"
                                                    class="btn btn-block btn-success" id="processingOrder">Processing
                                                    Order</a>


                                                @elseif ($order->status == 'Processing' &&
                                                Auth::guard('admin')->user()->can('processing_to_deliverd_order'))
                                                <a href="{{ route('admin.processing_to_deliverd_order',$order->id) }}"
                                                    class="btn btn-block btn-success" id="deliverdOrder">Deliverd
                                                    Order</a> --}}

                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->


            </div> <!-- end row -->



            <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-1">
                <div class="col">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="col-md-1">
                                            <label>Image</label>
                                        </td>
                                        <td class="col-md-1">
                                            <label>Product Name</label>
                                        </td>
                                        <td class="col-md-1">
                                            <label>Category</label>
                                        </td>
                                        <td class="col-md-1">
                                            <label>Product Code</label>
                                        </td>
                                        <td class="col-md-1">
                                            <label>Quantity</label>
                                        </td>
                                        <td class="col-md-1">
                                            <label>Price</label>
                                        </td>
                                    </tr>
                                    @foreach ($order->orderItems as $item)
                                    <tr>
                                        <td class="col-md-1">
                                            <label>
                                                <img src="{{ asset($item->product->productImages->isNotEmpty() ? $item->product->productImages->first()->product_image : 'assets/empty-image-300x240.jpg' ) }}"
                                                    style="width:50px; height:50px">
                                            </label>
                                        </td>
                                        <td class="col-md-2">
                                            <label>
                                                {{ $item->product->product_name }}
                                            </label>
                                        </td>

                                        <td class="col-md-2">
                                            <label>
                                                {{ $item->product->category->category_name }}
                                            </label>
                                        </td>

                                        <td class="col-md-2">
                                            <label>
                                                {{ $item->product->code }}
                                            </label>
                                        </td>

                                        <td class="col-md-2">
                                            <label>
                                                {{ $item->qty }}
                                            </label>
                                        </td>
                                        <td class="col-md-2">
                                            <label>
                                                {{ $item->price }} <br> Total = $ {{ $item->total }}
                                            </label>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class=" d-flex justify-content-end mx-5">
                                <h4 class="">Total Price: $ {{ $order->grand_total }}</h4>
                            </div>

                        </div>

                    </div>
                </div>
            </div>



            {{-- end --}}



        </div>
        <!--end::App Content-->
    </div>
</main>
@endsection