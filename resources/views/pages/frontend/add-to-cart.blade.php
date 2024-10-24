@extends('layouts.user.master')

@section('title')
Add To Cart
@endsection

@section('header')
@include('pages.frontend.component.header2')
@endsection

@section('content')
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{ route('index') }}">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Shopping Cart</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Cart Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">

        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Color</th>
                        <th>Size</th>

                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">

                    @php
                    $carts = session()->get('cart', []);
                    $sub_total = 0;
                    foreach ($carts as $item) {
                    $sub_total += $item['price'] * $item['quantity'];
                    }

                    @endphp
                    @if (count($carts) > 0)
                    @foreach ($carts as $item)

                    @php
                    $total_price = $item['price'] * $item['quantity'];
                    $product = App\Models\Product::find($item['id']);
                    @endphp


                    <tr>
                        <td class="align-middle d-flex">
                            <a href="{{ route('product_details',['id'=>$product->id,'slug'=>$product->slug]) }}">
                                <img src="{{ !empty($item['image']) ? asset($item['image']) : asset('assets/empty-image-300x240.jpg') }}"
                                    alt="" style="width: 50px;">
                                <span class="text-capitalize ml-2"> {{ $item['name'] }}</span>
                            </a>

                        </td>


                        <td class="align-middle">${{ $item['price'] }}</td>
                        <td class="align-middle">{{ $item['color'] }}</td>
                        <td class="align-middle">{{ $item['size'] }}</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                {{-- minus button --}}
                                <div class="input-group-btn">
                                    <button data-id="{{ $item['id'] }}"
                                        class="btn btn-sm btn-primary btn-minus update_cart_quantity">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" id="cart_quantity-{{ $item['id'] }}" readonly
                                    class="form-control form-control-sm bg-secondary text-center"
                                    value="{{ $item['quantity'] }}">

                                {{-- plus button --}}
                                <div class="input-group-btn">
                                    <button data-id="{{ $item['id'] }}"
                                        class="btn btn-sm btn-primary btn-plus update_cart_quantity">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">${{ $total_price }}</td>
                        <td class="align-middle">
                            <button class="btn btn-sm btn-primary remove_cart_item" data-id="{{ $item['id'] }}"><i
                                    class="fa fa-times"></i></button>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td class="" colspan="7">
                            <h5>No Product Available</h5>
                            <a href="{{ route('index') }}">Back To Shopping</a>
                        </td>
                    </tr>


                    @endif
                </tbody>
            </table>
        </div>


        <div class="col-lg-4">
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Subtotal</h6>
                        <h6 class="font-weight-medium">${{ $sub_total }}</h6>
                    </div>
                    {{-- <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">$10</h6>
                    </div> --}}
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    {{-- <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h5 class="font-weight-bold">$160</h5>
                    </div> --}}
                    <a href="{{ route('checkout_page') }}" class="btn btn-block btn-primary my-3 py-3">Proceed To
                        Checkout</a>
                </div>
            </div>
        </div>


    </div>
</div>
<!-- Cart End -->

<script>
    $(document).ready(function() {

            // toastr message
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            })


           














            // update quantity
            $('.update_cart_quantity').on('click', function(event) {
                event.preventDefault();
                var productId = $(this).data('id');
                var quantity = $('#cart_quantity' + '-' + productId).val();
                if (quantity <= 0) {
                    window.location.reload();
                    return;
                }


                $.ajax({
                    url: "{{ route('update_cart_quantity') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        product_id: productId,
                        quantity: quantity
                    },
                    success: function(response) {
                        console.log(response)

                        // Start Message 
                        if ($.isEmptyObject(response.error)) {
                            Toast.fire({
                                icon: 'success',
                                title: response.success,
                            }).then(() => {
                                window.location.reload();
                            })

                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: response.error,
                            })
                        }
                        // End Message
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        alert(
                            'An error occurred while fetching the products. Please try again.'
                        );
                    }
                });
            })




            // remove cart
            $('.remove_cart_item').on('click', function(event) {
                event.preventDefault();
                var productId = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete This Data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            url: "{{ route('delete_cart_item') }}",
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                product_id: productId,
                            },
                            success: function(response) {
                                console.log(response)

                                // Start Message 
                                Swal.fire(
                                    'Deleted!',
                                    'Data has been deleted successfully.',
                                    'success'
                                ).then(() => {
                                    window.location.reload();
                                })
                                
                            },
                            error: function(xhr) {
                                console.error(xhr);
                                alert(
                                    'An error occurred while fetching the products. Please try again.'
                                );
                            }
                        });

                    }
                })






            })




















        })
</script>
@endsection