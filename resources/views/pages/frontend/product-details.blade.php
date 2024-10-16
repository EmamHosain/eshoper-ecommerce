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
                            src="{{ $item->product_image ? asset($item->product_image) : asset('assets/eshoper/img/product-1.jpg') }}"
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
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star-half-alt"></small>
                    <small class="far fa-star"></small>
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

            <p class="mb-4">{{ $product->short_description }}</p>

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
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-pinterest"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">

            <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                <a class="nav-item nav-link active tab-bar" data-toggle="tab" href="#tab-pane-1">Description</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Information</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Reviews ({{ $product->reviews->count()
                    }})</a>
            </div>



            <div class="tab-content">
                {{-- description --}}
                <div class="tab-pane fade show active" id="tab-pane-1">
                    <h4 class="mb-3">Product Description</h4>
                    {{ $product->description ?? 'No Description' }}
                </div>

                {{-- information --}}
                <div class="tab-pane fade" id="tab-pane-2">
                    <h4 class="mb-3">Additional Information</h4>
                    {{ $product->information ?? 'No Information' }}
                </div>



                {{-- reviews --}}
                <div class="tab-pane fade" id="tab-pane-3">
                    <div class="row">
                        <div class="col-md-6">
                            @if ( $product->reviews->isNotEmpty())
                            <h4 class="mb-4">{{ $product->reviews->count() }} review for "{{ $product->product_name }}"
                            </h4>
                            @foreach ($product->reviews as $review)
                            <div class="media mb-4">
                                <img src="{{ asset('assets/empty-image-300x240.jpg') }}" alt="Image"
                                    class="img-fluid mr-3 mt-1" style="width: 45px;">
                                <div class="media-body">
                                    <h6>{{ $review->user->first_name . " " . $review->user->last_name }}<small> - <i>{{
                                                \Carbon\Carbon::parse($review->created_at)->setTimezone('Asia/Dhaka')->format('d
                                                F Y h:i a') }}
                                            </i></small></h6>
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
                                <p id="rating_error" class=" hidden text-danger" style="font-size: 13px"></p>

                            </div>
                            {{-- form here --}}
                            <form id="review_submit_form">
                                <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id() }}">
                                <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
                                <div class="form-group">
                                    <label for="review">Your Review *</label>
                                    <textarea id="review" name="review" cols="30" rows="5" class="form-control"
                                        placeholder="Enter review">
                                    </textarea>
                                    <p id="review_error" class=" text-danger hidden" style="font-size: 13px"></p>
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
                        <img class="img-fluid w-100"
                            src="{{ $item->productImages->first() ? asset($item->productImages->first()->product_image) : asset('assets/eshoper/img/product-1.jpg') }}"
                            alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">{{ $item->product_name }}</h6>
                        <div class="d-flex justify-content-center">
                            <h6>${{ $item->is_discount ? $item->discount_price : $item->price }}</h6>

                            @if ($item->is_discount)
                            <h6 class="text-muted ml-2"><del>${{ $item->price }}</del></h6>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="{{ route('product_details', ['id' => $item->id, 'slug' => $item->slug]) }}"
                            class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View
                            Detail</a>
                        <a href="" class="btn btn-sm text-dark p-0"><i
                                class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
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
                                    window.location.reload();
                                });
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

            






        })
</script>
@endsection