@extends('layouts.user.master')

@section('title')
Wishlist
@endsection

@section('header')
@include('pages.frontend.component.header2')
@endsection

@section('content')
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping wishlist</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{ route('index') }}">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Shopping Cart</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Cart Start -->
<div class="container pt-5">
    <div class="row px-xl-5">
        <div class="col-12 table-responsive mb-5">
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="align-middle">

                    @if (count($products) > 0)
                    @foreach ($products as $product)
                    <tr>
                        <td class="align-left">
                            {{ $product->id }}
                            <img src="{{ $product->productImages->first() ? asset($product->productImages->first()->product_image) : asset('assets/eshoper/img/product-1.jpg') }}"
                                alt="" style="width: 50px;">
                            <span class=" text-capitalize">{{ $product->product_name }}</span>
                        </td>



                        <td class="align-middle">
                            ${{ $product->is_discount ? $product->discount_price : $product->price }}</td>

                        <td class="align-middle">
                            <button class="btn btn-sm btn-primary remove_item_from_wishlist"
                                data-id="{{ $product->id }}">
                                <i class="fa fa-times"></i>
                            </button>


                            <button class="btn btn-sm btn-primary add_to_cart" data-id="{{ $product->id }}">
                                <i class="fas fa-shopping-cart"></i>
                            </button>

                        </td>

                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td class="" colspan="3">
                            <h5>No Product Available</h5>
                            <a href="{{ route('index') }}">Back To Shopping</a>
                        </td>
                    </tr>
                    @endif


                </tbody>
            </table>
        </div>


    </div>
</div>
<script>
    $(document).ready(function() {


            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            })


            function removeItemToWishlist(product_id, isToastr = false) {
                $.ajax({
                    url: "{{ route('delete_product_to_wihslist') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        product_id: product_id
                    },
                    success: function(response) {
                        localStorage.removeItem('product_id');
                        // $('#wishlist_count').text(response.wishlist_count);
                        if (isToastr) {
                            if ($.isEmptyObject(response.error)) {
                                Toast.fire({
                                    icon: 'success',
                                    title: response.success,
                                }).then((value) => {
                                    window.location.reload();
                                })

                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: response.error,
                                })
                            }
                        }



                    },
                    error: function(xhr) {
                        console.error(xhr);
                        alert(
                            'An error occurred while fetching the products. Please try again.'
                        );
                    }
                });
            }



            // product remove to wishlist
            $('.remove_item_from_wishlist').on('click', function() {
                var productId = $(this).data('id');
                removeItemToWishlist(productId, true);

            })




            // add to cart
            $('.add_to_cart').on('click', function() {
                var productId = $(this).data('id');
                localStorage.setItem('product_id', productId);
                // console.log('product is', productId);
                $.ajax({
                    url: "{{ route('add_to_cart_product') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        product_id: productId
                    },
                    success: function(response) {
                        // console.log(response)
                        var product_id = localStorage.getItem('product_id');
                        removeItemToWishlist(product_id, false)
                        console.log('product is ', product_id)




                        // $('#cart_count').text(response.cart_count)
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










                    },
                    error: function(xhr) {
                        console.error(xhr);
                        alert(
                            'An error occurred while fetching the products. Please try again.'
                        );
                    }
                });
            })










        })
</script>
@endsection