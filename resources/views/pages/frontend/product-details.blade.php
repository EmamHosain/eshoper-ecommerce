@extends('layouts.user.master')

@section('title')
Product Details
@endsection



@section('header')
@include('pages.frontend.component.header2')
@endsection







@section('content')
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Shop Detail</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{ route('index') }}">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Shop Detail</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Shop Detail Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 pb-5">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner border">


                    @foreach ($product->productImages as $index => $item)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img class="w-100 h-100"
                            src="{{ $item->product_image ? asset($item->product_image) : asset('assets/empty-image-300x240.jpg') }}"
                            alt="{{ $product->product_name }}">
                    </div>
                    @endforeach


                </div>


                @if (count($product->productImages) > 1)
                <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-dark"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                    <i class="fa fa-2x fa-angle-right text-dark"></i>
                </a>
                @endif
            </div>
        </div>

        <div class="col-lg-7 pb-5">
            <h3 class="font-weight-semi-bold">Colorful Stylish Shirt</h3>
            <div class="d-flex mb-3">
                <div class="text-primary mr-2">
                    @if ($product->reviews->count() > 0)
                    @php
                    $sum = $product->reviews->sum('rating');
                    $avg = round($sum / $product->reviews->count());
                    @endphp
                    @for ($i = 0; $i < $avg; $i++) <small class="fas fa-star"></small>
                        @endfor
                        @else
                        <span>No review</span>
                        @endif

                </div>
                <small class="pt-1">({{ $product->reviews->count() }} Reviews)</small>
            </div>


            <div class=" d-flex mb-4">
                <h3 class="font-weight-semi-bold">
                    ${{ $product->is_discount == 1 ? $product->discount_price : $product->price }}
                </h3>

                @if ($product->is_discount == 1)
                <h3 class="font-weight-semi-bold ml-2 text-muted"><del>${{ $product->price }}</del></h3>
                @endif
            </div>



            <input type="hidden" id="product_id" value="{{ $product->id }}">

            <p class="mb-4">{!! $product->short_description !!}</p>

            @if (!empty($product->sizes))
            <div class="d-flex mb-3">
                <p class="text-dark font-weight-medium mb-0 mr-3">Sizes:</p>
                <form>
                    @foreach ($product->sizes as $size)
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input size_input"
                            id="{{ $size->size_name . '-' . $size->id }}" name="size" value="{{ $size->id }}">
                        <label class="custom-control-label text-uppercase"
                            for="{{ $size->size_name . '-' . $size->id }}">{{ $size->size_name }}</label>
                    </div>
                    @endforeach
                </form>
            </div>
            @endif


            @if (!empty($product->colors))
            <div class="d-flex mb-4">
                <p class="text-dark font-weight-medium mb-0 mr-3">Colors:</p>
                <form>
                    @foreach ($product->colors as $color)
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input color_input"
                            id="{{ $color->color_name . '-' . $color->id }}" name="color" value="{{ $color->id }}">
                        <label class="custom-control-label text-capitalize"
                            for="{{ $color->color_name . '-' . $color->id }}">{{ $color->color_name }}</label>
                    </div>
                    @endforeach

                </form>
            </div>
            @endif


            <div class="d-flex align-items-center mb-4 pt-2">
                <div class="input-group quantity mr-3" style="width: 130px;">
                    <div class="input-group-btn">
                        <button class="btn btn-primary btn-minus">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control bg-secondary text-center quantity_input" min="1" value="1">
                    <div class="input-group-btn">
                        <button class="btn btn-primary btn-plus">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <button class="btn btn-primary px-3 add_to_cart_btn"><i class="fa fa-shopping-cart mr-1"></i> Add To
                    Cart</button>
            </div>

            {{-- share icon --}}
            <div class="d-flex pt-2">
                <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                <div class="d-inline-flex">
                    <a class="text-dark px-2" href="{{ $share_links['facebook'] }}" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="{{ $share_links['twitter'] }}" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="{{ $share_links['linkedin'] }}" target="_blank">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="{{ $share_links['whatsapp'] }}" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                    </a>

                  


                </div>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">


            <ul class="nav nav-tabs justify-content-center border-secondary mb-4" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description"
                        role="tab" aria-controls="pills-description" aria-selected="true">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-information-tab" data-toggle="pill" href="#pills-information"
                        role="tab" aria-controls="pills-information" aria-selected="false">Information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-reviews-tab" data-toggle="pill" href="#pills-review" role="tab"
                        aria-controls="pills-review" aria-selected="false">Reviews({{ $product->reviews->count() }})</a>
                </li>
            </ul>

            <div class="tab-content">

                <!-- Description Tab -->
                <div class="tab-pane fade show active" id="pills-description" role="tabpanel"
                    aria-labelledby="pills-order-online-tab">
                    <h4 class="mb-3">Product Description</h4>
                    {!! $product->description ?? 'No Description' !!}
                </div>

                <!-- Information Tab -->
                <div class="tab-pane fade" id="pills-information" role="tabpanel"
                    aria-labelledby="pills-information-tab">
                    <h4 class="mb-3">Additional Information</h4>
                    {!! $product->information ?? 'No Information' !!}
                </div>

                <!-- Reviews Tab -->
                <div class="tab-pane fade" id="pills-review" role="tabpanel" aria-labelledby="pills-reviews-tab">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($product->reviews->isNotEmpty())
                            <h4 class="mb-4">{{ $product->reviews->count() }} reviews for
                                "{{ $product->product_name }}"
                            </h4>
                            @foreach ($product->reviews as $review)
                            <div class="media mb-4">
                                <img src="{{ asset('assets/empty-image-300x240.jpg') }}" alt="Image"
                                    class="img-fluid mr-3 mt-1" style="width: 45px;">
                                <div class="media-body">
                                    <h6>{{ $review->user->first_name . ' ' . $review->user->last_name }}<small>
                                            -
                                            <i>{{
                                                \Carbon\Carbon::parse($review->created_at)->setTimezone('Asia/Dhaka')->format('d
                                                F Y h:i a') }}</i></small>
                                    </h6>
                                    <div class="text-primary mb-2">
                                        @for ($i = 0; $i < $review->rating; $i++)
                                            <i class="fas fa-star"></i>
                                            @endfor
                                    </div>
                                    <p>{{ $review->review }}</p>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <p>No Review Yet!</p>
                            @endif
                        </div>

                        <div class="col-md-6">
                            @guest('web')
                            <div>
                                <form id="login-form" action="{{ route('login') }}" method="GET" style="display: none;">
                                    <input type="hidden" name="previousURL" value="{{ url()->current() }}">
                                </form>
                                <p>You must be <a class="text-primary" href="{{ route('login') }}"
                                        onclick="event.preventDefault(); document.getElementById('login-form').submit();">logged</a>
                                    in to post a comment.</p>
                            </div>
                            @endguest

                            @auth('web')
                            <h4 class="mb-4">Leave a review</h4>
                            <small>Your email address will not be published. Required fields are marked *</small>
                            <div class="my-3">
                                <div class="d-flex">
                                    <p class="mb-0 mr-2">Your Rating * :</p>
                                    <div class="text-primary">
                                        <i data-value="1" class="far fa-star review"></i>
                                        <i data-value="2" class="far fa-star review"></i>
                                        <i data-value="3" class="far fa-star review"></i>
                                        <i data-value="4" class="far fa-star review"></i>
                                        <i data-value="5" class="far fa-star review"></i>
                                    </div>
                                </div>
                                <p id="rating_error" class="hidden text-danger" style="font-size: 13px"></p>
                            </div>

                            <form id="review_submit_form">
                                <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id() }}">
                                <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
                                <div class="form-group">
                                    <label for="review">Your Review *</label>
                                    <textarea id="review" name="review" cols="30" rows="5" class="form-control"
                                        placeholder="Enter review"></textarea>
                                    <p id="review_error" class="text-danger hidden" style="font-size: 13px"></p>
                                </div>
                                <div class="form-group mb-0">
                                    <input type="submit" id="review_submit" value="Leave Your Review"
                                        class="btn btn-primary px-3">
                                </div>
                            </form>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
<!-- Shop Detail End -->


<!-- Products Start -->
<div class="container-fluid py-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">You May Also Like</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">


                @foreach ($relatedProducts as $item)
                <div class="card product-item border-0">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <a href="{{ route('product_details', ['id' => $item->id, 'slug' => $item->slug]) }}">
                            <img class="img-fluid w-100" src="{{ $item->productImages->first()
                                            ? asset($item->productImages->first()->product_image)
                                            : asset('assets/empty-image-300x240.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <a href="{{ route('product_details', ['id' => $item->id, 'slug' => $item->slug]) }}">
                            <h6 class="text-truncate mb-3 text-capitalize">
                                {{ Str::limit($item->product_name, 30) }}
                            </h6>
                        </a>

                        <div class="d-flex justify-content-center">
                            <h6>${{ $item->is_discount ? $item->discount_price : $item->price }}</h6>

                            @if ($item->is_discount)
                            <h6 class="text-muted ml-2"><del>${{ $item->price }}</del></h6>
                            @endif
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="javascript:void(0)" data-id="{{ $item->id }}"
                            class="btn btn-sm text-dark p-0 product_add_to_wishlist">
                            <i class="fas fa-heart text-primary mr-1"></i>Add To
                            Wishlist
                        </a>


                        <a href="javascript:void(0)" data-id="{{ $item->id }}"
                            class="btn btn-sm text-dark p-0 product_add_to_cart"><i
                                class="fas fa-shopping-cart text-primary mr-1"></i>Add To
                            Cart</a>
                    </div>
                </div>
                @endforeach





            </div>
        </div>
    </div>
</div>
<!-- Products End -->

<script>
    $(document).ready(function() {

            // toastr message
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            })

            $('.add_to_cart_btn').on('click', function() {
                var items = {};

                // Check color inputs (single value)
                var color = $('.color_input:checked').val();
                if (color) {
                    items['color'] = color;
                }

                // Get product_id value
                var product_id = $('#product_id').val();
                if (product_id) {
                    items['product_id'] = product_id;
                }

                // Check size inputs (single value)
                var size = $('.size_input:checked').val();
                if (size) {
                    items['size'] = size;
                }

                // Check quantity input (single value)
                var quantity = $('.quantity_input').val();
                if (quantity > 0 && quantity !== '') {
                    items['quantity'] = quantity;
                }

                // Check what is being passed before the AJAX call
                console.log(items);

                // Send data via AJAX
                $.ajax({
                    url: "{{ route('add_to_cart_product') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    data: items,
                    success: function(response) {
                        console.log(response);
                        $('#cart_count').text(response.cart_count);

                        if ($.isEmptyObject(response.error)) {
                            Toast.fire({
                                icon: 'success',
                                title: response.success,
                            });
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: response.error,
                            });
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        alert(
                            'An error occurred while fetching the products. Please try again.'
                        );
                    }
                });
            });



            // review 
            var ratingCount = [];
            $('.review').on('click', function() {
                var value = $(this).data('value');

                if ($(this).hasClass('fas')) {
                    $(this).removeClass('fas');

                    var index = ratingCount.indexOf(value);
                    if (index !== -1) {
                        ratingCount.splice(index, 1);
                    }
                } else {
                    $(this).addClass('fas');
                    ratingCount.push(value);
                }
            })



            // Get the active tab from localStorage
            var activeTab = localStorage.getItem('activeTab');

            // If the "reviews" tab was stored, activate it
            if (activeTab === 'reviews') {
                $('#pills-description-tab').removeClass('active');
                $('#pills-reviews-tab').addClass('active');

                $('#pills-description').removeClass('show active');
                $('#pills-review').addClass('show active');

                // Clear the value from localStorage to reset the state
                localStorage.removeItem('activeTab');
            }

            $('#review_submit_form').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('review_submit') }}", // Provide the correct URL here
                    dataType: "json",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content') // Retrieves the CSRF token from a meta tag
                    },
                    data: {
                        product_id: $('#product_id').val(),
                        user_id: $('#user_id').val(),
                        review: $('#review').val(),
                        rating: ratingCount.length
                    },
                    success: function(response) {

                        console.log(response);
                        if (response.errors) {
                            var errors = response.errors;
                            if (errors.review) {
                                $('#review_error').removeClass('hidden')
                                $('#review_error').addClass('show')
                                $('#review').addClass('is-invalid')
                                $('#review_error').text(errors.review)
                            }
                            if (errors.rating) {
                                $('#rating_error').removeClass('hidden')
                                $('#rating_error').addClass('show')
                                $('#rating_error').text(errors.rating)
                            }
                        } else {
                            $('#review_error').addClass('hidden')
                            $('#rating_error').addClass('hidden')
                            $('#review').removeClass('is-invalid')

                            if ($.isEmptyObject(response.error)) {
                                Toast.fire({
                                    icon: 'success',
                                    title: response.success,
                                }).then(() => {
                                    // Store the active tab in localStorage
                                    localStorage.setItem('activeTab', 'reviews');

                                    // Reload the page
                                    window.location.reload();

                                })
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: response.error,
                                });
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle any errors here
                        console.error(xhr.responseText);
                    }
                });





            })


            // add to wishlist
            $('.product_add_to_wishlist').on('click', function() {
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
                        console.log(response)
                        $('#wishlist_count').text(response.wishlist_count)
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








            // add to cart
            $('.product_add_to_cart').on('click', function() {
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