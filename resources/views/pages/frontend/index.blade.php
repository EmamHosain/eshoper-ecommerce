@extends('layouts.user.master')

@section('title')
Home
@endsection

@section('header')
@include('pages.frontend.component.header', [
'is_open' => 1,
])
@endsection


@section('content')
<!-- Featured Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
            </div>
        </div>
    </div>
</div>
<!-- Featured End -->


<!-- Categories Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">

        @foreach ($categories as $category)
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <p class="text-right">{{ $category->products_count }} Products</p>
                <a href="{{ route('search_by_product', ['category' => $category->slug]) }}"
                    class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid"
                        src="{{ $category->category_logo ? asset($category->category_logo) : asset('assets/eshoper/img/cat-1.jpg') }}"
                        alt="">
                </a>
                <a href="{{ route('search_by_product', ['category' => $category->slug]) }}">
                    <h5 class="font-weight-semi-bold m-0">{{ $category->category_name }}</h5>
                </a>
            </div>
        </div>
        @endforeach


    </div>
</div>
<!-- Categories End -->


<!-- Offer Start -->
<div class="container-fluid offer pt-5">
    <div class="row px-xl-5">
        <div class="col-md-6 pb-4">
            <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-5 px-5">
                <img src="{{ asset('assets/eshoper/img/offer-1.png') }}" alt="">
                <div class="position-relative" style="z-index: 1;">
                    <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                    <h1 class="mb-4 font-weight-semi-bold">Spring Collection</h1>
                    <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 pb-4">
            <div class="position-relative bg-secondary text-center text-md-left text-white mb-2 py-5 px-5">
                <img src="{{ asset('assets/eshoper/img/offer-2.png') }}" alt="">
                <div class="position-relative" style="z-index: 1;">
                    <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                    <h1 class="mb-4 font-weight-semi-bold">Winter Collection</h1>
                    <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                </div>
            </div>
        </div>


    </div>
</div>
<!-- Offer End -->


<!-- trandy Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Trandy Products</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        @include('pages.frontend.single-product', [
        'products' => $trandy_products,
        ])
    </div>
</div>
<!-- trandy Products End -->


<!-- Subscribe Start -->
<div class="container-fluid bg-secondary my-5">
    <div class="row justify-content-md-center py-5 px-xl-5">
        <div class="col-md-6 col-12 py-5">
            <div class="text-center mb-2 pb-2">
                <h2 class="section-title px-5 mb-3"><span class="bg-secondary px-2">Stay Updated</span></h2>
                <p>Amet lorem at rebum amet dolores. Elitr lorem dolor sed amet diam labore at justo ipsum eirmod
                    duo labore labore.</p>
            </div>
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control border-white p-4" placeholder="Email Goes Here">
                    <div class="input-group-append">
                        <button class="btn btn-primary px-4">Subscribe</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Subscribe End -->


<!-- new arrived Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Just Arrived</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        @include('pages.frontend.single-product', [
        'products' => $new_arrived_products,
        ])
    </div>
</div>
<!-- new arrived Products End -->


<!-- Vendor Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                @foreach ($brands as $brand)
                <div class="vendor-item border p-4">
                    <img src="{{ $brand->brand_logo ? asset($brand->brand_logo) : asset('assets/eshoper/img/vendor-1.jpg') }}"
                        alt="{{ $brand->brand_name }}">
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Vendor End -->


{{-- footer here --}}

<script>
    $(document).ready(function() {

            // toastr message
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            })



            // add to wishlist
            $('.add_to_wishlist').on('click', function() {
                var productId = $(this).data('id');
                $.ajax({
                    url: "{{ route('product_add_to_wishlist') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        product_id: productId
                    },
                    success: function(response) {
                        $('#wishlist_count').text(response.wishlist_count)
                        // Start Message 
                        if ($.isEmptyObject(response.error)) {
                            Toast.fire({
                                icon: 'success',
                                title: response.success,
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



            // add to cart
            $('.add_to_cart').on('click', function() {
                var productId = $(this).data('id');
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
                        console.log(response)
                        $('#cart_count').text(response.cart_count)
                        if ($.isEmptyObject(response.error)) {
                            Toast.fire({
                                icon: 'success',
                                title: response.success,
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