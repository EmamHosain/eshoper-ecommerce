@extends('layouts.user.master')

@section('title')
    Checkout
@endsection



@section('header')
    @include('pages.frontend.component.header2')
@endsection



@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('index') }}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Checkout</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <form id="checkout_form" style="width: 100%">
            <div class="row px-xl-5">
                <div class="col-lg-8">



                    {{-- shipping address start --}}
                    <div class="mb-4">
                        <h4 class="font-weight-semi-bold mb-4">Shipping Address</h4>
                        <div class="row">
                            <div class="col-12 col-md-6 form-group">
                                <label>First Name <span class=" text-danger">*</span></label>
                                <input class="form-control" type="text" id="shipping_first_name" name="first_name"
                                    value="{{ !empty($customer) ? $customer->first_name : '' }}" placeholder="John">
                                <p id="shipping_first_name_error"></p>
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label>Last Name <span class=" text-danger">*</span></label>
                                <input class="form-control" type="text" id="shipping_last_name" name="last_name"
                                    value="{{ !empty($customer) ? $customer->last_name : '' }}" placeholder="Doe">
                                <p></p>
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label>E-mail <span class=" text-danger">*</span></label>
                                <input class="form-control" type="text" id="shipping_email" name="email"
                                    value="{{ !empty($customer) ? $customer->email : '' }}" placeholder="example@email.com">
                                <p></p>
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label>Mobile No <span class=" text-danger">*</span></label>
                                <input class="form-control" type="text" id="shipping_mobile" name="mobile"
                                    value="{{ !empty($customer) ? $customer->mobile : '' }}" placeholder="+123 456 789">
                                <p></p>
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label>Address <span class=" text-danger">*</span></label>
                                <textarea class="form-control" name="address" id="address" placeholder="Enter shipping address" rows="3">
                                {{ !empty($customer) ? $customer->address : '' }}
                            </textarea>
                                <p></p>
                            </div>

                            <div class="col-12 col-md-6 form-group">
                                <label>City <span class=" text-danger">*</span></label>
                                <input class="form-control" type="text" id="shipping_city" name="city"
                                    value="{{ !empty($customer) ? $customer->city : '' }}" placeholder="New York">
                                <p></p>
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label>State <span class=" text-danger">*</span></label>
                                <input class="form-control" type="text" id="shipping_state" name="state"
                                    value="{{ !empty($customer) ? $customer->state : '' }}" placeholder="New York">
                                <p></p>
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label>ZIP Code <span class=" text-danger">*</span></label>
                                <input class="form-control" type="text" id="shipping_zip" name="zip"
                                    placeholder="123" value="{{ !empty($customer) ? $customer->zip : '' }}">
                                <p></p>
                            </div>

                            <div class="col-12 col-md-6 form-group">
                                <label>Notes</label>
                                <textarea class="form-control" name="notes" id="notes" placeholder="Enter notes" rows="3"></textarea>
                                <p></p>
                            </div>


                            {{-- shipping area with amount --}}
                            <div class="col-12 col-md-6 form-group">
                                <label>Shipping Area <span class="text-danger">*</span></label>

                                <select class="form-control" id="shipping_area" name="shipping_area">
                                    <option selected disabled value="">Select shipping area</option>
                                    @foreach ($shipping_area as $item)
                                        <option class="text-capitalize" value="{{ $item->id }}"
                                            @selected(!empty($customer->shipping_manage_id) && $item->id === $customer->shipping_manage_id)>
                                            {{ $item->shipping_name }} - ${{ $item->amount }}
                                        </option>
                                    @endforeach
                                </select>

                                <p class="shipping_area_error"></p> <!-- Changed id here -->
                            </div>






                        </div>
                    </div>
                    {{-- shipping address end --}}



                </div>

                <div class="col-lg-4">
                    <div class="card border-secondary mb-3">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                        </div>
                        <div class="card-body">
                            <h5 class="font-weight-medium mb-3">Products</h5>

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
                                        $product_price_with_quantity = $item['price'] * $item['quantity'];
                                    @endphp
                                    <div class="d-flex justify-content-between">
                                        <p>{{ Str::limit($item['name'], 40) }} - ({{ $item['price'] }} x
                                            {{ $item['quantity'] }})
                                        </p>
                                        <p>${{ $product_price_with_quantity }}</p>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <div class="d-flex justify-content-between mt-2">
                                <h5 class="font-weight-bold">Sub total</h5>
                                <h5 class="font-weight-bold">${{ $sub_total }}</h5>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <h5 class="font-weight-bold">Shipping cost</h5>
                                <h5 class="font-weight-bold" id="shipping_cost">$0.00</h5>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <h5 class="font-weight-bold">Total</h5>
                                <h5 id="total_amount" class="font-weight-bold total_amount">${{ $sub_total }}</h5>
                            </div>
                        </div>



                    </div>
                    <div class="card border-secondary mb-3">
                        <form id="apply_coupon_form" class="mb-2" action="">
                            <div class="input-group">
                                <input type="text" name="coupon_code" class="form-control p-4"
                                    placeholder="Coupon Code">
                                <div class="input-group-append">
                                    <button id="apply_coupon_button" class="btn btn-primary">Apply Coupon</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card border-secondary mb-3">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Payment</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment_method"
                                        id="cash_on_delivery" value="cash_on_delivery" checked>
                                    <label class="custom-control-label" for="cash_on_delivery">Cash On Delivery</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment_method"
                                        id="bkash" value="bkash">
                                    <label class="custom-control-label" for="bkash">Bkash</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment_method"
                                        id="nagad" value="nagad">
                                    <label class="custom-control-label" for="nagad">Nagad</label>
                                </div>
                            </div>


                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <button id="place_order"
                                class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Place
                                Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Checkout End -->

    <script>
        $(document).ready(function() {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            })



            $('#shipping_area').on('change', function() {
                var shipping_area_id = $(this).val();
                $.ajax({
                    url: "{{ route('addition_shipping_charge_to_total') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        shipping_area: shipping_area_id
                    },
                    success: function(response) {
                        $('#total_amount').text("$" + response.total_amount)
                        $('#shipping_cost').text("$" + response.shipping_cost);
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX Error:', status, error);
                    }
                })

            });

            // Check if an option is already selected when the page loads
            var preselectedValue = $('#shipping_area').val();
            if (preselectedValue) {
                $('#shipping_area').trigger('change'); // Trigger the change event if a value is pre-selected
            }




            // Handle the form submission via AJAX
            $('#checkout_form').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission behavior
                $('#place_order').prop('disabled', true);

                $.ajax({
                    url: "{{ route('checkout_submit') }}",
                    type: "POST",
                    data: $(this).serializeArray(),
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content') // Add CSRF token for security
                    },
                    success: function(response) {
                        $('#place_order').prop('disabled', false);

                        console.log(response.errors);
                        if (response.errors) {
                            $('#place_order').prop('disabled', false);
                            var errors = response.errors;
                            // console.log(errors)

                            // Handle shipping address errors if applicable
                            // Shipping First Name
                            if (errors.first_name) {
                                $('#shipping_first_name').addClass('is-invalid')
                                    .siblings("p")
                                    .addClass('text-danger')
                                    .html(errors.first_name);

                            }

                            // Shipping Last Name
                            if (errors.last_name) {
                                $('#shipping_last_name').addClass('is-invalid')
                                    .siblings("p")
                                    .addClass('invalid-feedback')
                                    .html(errors.last_name);
                            }

                            // Shipping Email
                            if (errors.email) {
                                $('#shipping_email').addClass('is-invalid')
                                    .siblings("p")
                                    .addClass('invalid-feedback')
                                    .html(errors.email);
                            }

                            // Shipping Mobile No
                            if (errors.mobile) {
                                $('#shipping_mobile').addClass('is-invalid')
                                    .siblings("p")
                                    .addClass('invalid-feedback')
                                    .html(errors.mobile);
                            }

                            // Shipping Address Line 1
                            if (errors.address) {
                                $('#address').addClass('is-invalid')
                                    .siblings("p")
                                    .addClass('invalid-feedback')
                                    .html(errors.address);
                            }


                            // Shipping City
                            if (errors.city) {
                                $('#shipping_city').addClass('is-invalid')
                                    .siblings("p")
                                    .addClass('invalid-feedback')
                                    .html(errors.city);
                            }

                            // Shipping State
                            if (errors.state) {
                                $('#shipping_state').addClass('is-invalid')
                                    .siblings("p")
                                    .addClass('invalid-feedback')
                                    .html(errors.state);
                            }

                            // Shipping ZIP Code
                            if (errors.zip) {
                                $('#shipping_zip')
                                    .addClass('is-invalid')
                                    .siblings("p")
                                    .addClass('invalid-feedback')
                                    .html(errors.zip);
                            }
                            if (errors.shipping_area) {
                                // console.log('shipping_area', errors.shipping_area)
                                $('#shipping_area')
                                    .addClass('is-invalid')
                                    .siblings("p")
                                    .addClass('invalid-feedback')
                                    .html(errors.shipping_area);
                            }

                        } else {
                            $('#place_order').prop('disabled', false);
                            console.log('Order placed successfully!');
                            window.location.href = response.redirect_url
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle server errors
                        $('#place_order').prop('disabled', false);
                        console.log('AJAX Error:', status, error);
                    }
                });
            });

            // When the place_order button is clicked, trigger the form submission
            $('#place_order').on('click', function() {
                $('#checkout_form').submit();
            });



            // apply coupon
            $('#apply_coupon_form').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('apply_coupon') }}",
                    type: "POST",
                    data: $(this).serializeArray(),
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    success: function(response) {

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
                    error: function(xhr, status, error) {
                        // Handle server errors
                        console.log('AJAX Error:', status, error);
                    }
                });
            })

            $('#apply_coupon_button').on('click', function() {
                $('#apply_coupon_form').submit();
            })





        })
    </script>
@endsection
