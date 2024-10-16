@extends('layouts.user.backend.user-master')
@section('title')
All Order
@endsection
@section('content')
<!-- Main Content -->
<main class="">
    <div class="dashboard-header">
        <h3>Order</h3>
    </div>

    <div class="container-fluid">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Order Id</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col">Shipping cost</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Status</th>
                        <th scope="col">Payment method</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($orders as $order)
                    <tr>
                        <th scope="row">{{ $order->order_code }}</th>
                        <td>{{ $order->sub_total }}</td>
                        <td>{{ $order->shippingManage->amount }}</td>
                        <td>{{ $order->orderItems->count() }}</td>

                        <td>{{ $order->grand_total }}</td>

                        <td>
                            @if ($order->order_status === 'pending')
                            <span class="badge text-bg-primary">{{ $order->order_status }}</span>
                            @elseif ($order->order_status === 'cancelled')
                            <span class="badge text-bg-danger">{{ $order->order_status }}</span>
                            @elseif ($order->order_status === 'completed')
                            <span class="badge text-bg-success">{{ $order->order_status }}</span>
                            @endif
                        </td>

                        <td>{{ $order->peyment_method_type }}</td>
                        <td>
                            <a class=" btn btn-primary"
                                href="{{ route('user_order_details',['id'=>$order->id]) }}">View</a>
                            <a class=" btn btn-success"
                                href="{{ route('invoice_download',['id'=>$order->id]) }}">Download</a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            <div>
                {{ $orders->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>

</main>
@endsection