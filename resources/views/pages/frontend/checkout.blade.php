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
                            <label>First Name</label>
                            <input class="form-control" type="text" id="shipping_first_name" name="first_name"
                                value="{{ !empty($customer) ? $customer->first_name : '' }}" placeholder="John">
                            <p></p>
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" id="shipping_last_name" name="last_name"
                                value="{{ !empty($customer) ? $customer->last_name : '' }}" placeholder="Doe">
                            <p></p>
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="text" id="shipping_email" name="email"
                                value="{{ !empty($customer) ? $customer->email : '' }}" placeholder="example@email.com">
                            <p></p>
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" type="text" id="shipping_mobile" name="mobile"
                                value="{{ !empty($customer) ? $customer->mobile : '' }}" placeholder="+123 456 789">
                            <p></p>
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label>Address</label>
                            <textarea class="form-control" name="address" id="address"
                                placeholder="Enter shipping address" rows="3">
                                {{ !empty($customer) ? $customer->address : '' }} 
                            </textarea>
                            <p></p>
                        </div>

                        <div class="col-12 col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" type="text" id="shipping_city" name="city" value="{{ !empty($customer) ? $customer->city : '' }}"
                                placeholder="New York">
                            <p></p>
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label>State</label>
                            <input class="form-control" type="text" id="shipping_state" name="state" value="{{ !empty($customer) ? $customer->state : '' }}"
                                placeholder="New York">
                            <p></p>
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input class="form-control" type="text" id="shipping_zip" name="zip" placeholder="123"
                                value="{{ !empty($customer) ? $customer->zip : '' }}">
                            <p></p>
                        </div>

                        <div class="col-12 col-md-6 form-group">
                            <label>Notes</label>
                            <textarea class="form-control" name="notes" id="notes" placeholder="Enter notes"
                                rows="3"></textarea>
                            <p></p>
                        </div>
                        
                        <div class="col-12 col-md-6 form-group">
                            <label>Shipping Type</label>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input shipping_type" name="shipping_type"
                                        checked id="cash_on_delivery" value="cash_on_delivery">
                                    <label class="custom-control-label" for="cash_on_delivery">Cash On Delivery</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input shipping_type" name="shipping_type"
                                        id="inside_dhaka" value="inside_dhaka">
                                    <label class="custom-control-label" for="inside_dhaka">Inside Dhaka</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input shipping_type" name="shipping_type"
                                        id="outside_dhaka" value="outside_dhaka">
                                    <label class="custom-control-label" for="outside_dhaka">Outside Dhaka</label>
                                </div>
                            </div>


                            <p id="shipping_type" style="font-size: 13px"></p>
                        </div>
                    </div>
                </div>
                {{-- shipping address end --}}



            </div>

            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Products</h5>

                        @php
                        $carts = session()->get('cart', []);
                        $total_amount = 0;
                        foreach ($carts as $item) {
                        $total_amount += $item['price'];
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
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">${{ $total_amount }}</h5>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Shipping cost</h5>


                            <div>
                                <span class="">$</span>
                                <input type="text" readonly disabled
                                    class="font-weight-bold border-0  text-right bg-transparent" id="shipping_cost"
                                    name="shipping_cost" value="0.00"
                                    style="width:5rem; height: auto; font-size: 1.25rem;">
                            </div>




                        </div>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Payment</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="peyment_method_type"
                                    id="cash_on_delivery" value="cash_on_delivery" checked>
                                <label class="custom-control-label" for="cash_on_delivery">Cash On Delivery</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="peyment_method_type" id="bkash"
                                    value="bkash">
                                <label class="custom-control-label" for="bkash">Bkash</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="peyment_method_type" id="nagad"
                                    value="nagad">
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


            $('.shipping_type').on('change', function() {
                if ($(this).is(':checked') == true) {
                    // console.log($(this).val());
                    var value = $(this).val();
                    if (value === 'inside_dhaka') {
                        $('#shipping_cost').val("70")
                    } else if (value === 'outside_dhaka') {
                        $('#shipping_cost').val("150")
                    } else {
                        $('#shipping_cost').val("0.00")
                    }

                }

            })










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

                        console.log(response);
                        if (response.errors) {
                            var errors = response.errors;
                            // console.log(errors)

                            // Handle shipping address errors if applicable
                            // Shipping First Name
                            if (errors.first_name) {
                                $('#shipping_first_name').addClass('is-invalid')
                                    .siblings("p")
                                    .addClass('invalid-feedback')
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
                                $('#shipping_zip').addClass('is-invalid')
                                    .siblings("p")
                                    .addClass('invalid-feedback')
                                    .html(errors.zip);
                            }
                            if (errors.shipping_type) {
                                console.log('shipping_type', errors.shipping_type)
                                $('#shipping_type')
                                    .addClass('text-danger')
                                    .html(errors.shipping_type);
                            }

                        } else {
                            console.log('Order placed successfully!');
                            window.location.href = "{{ route('thanks_page') }}"
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle server errors
                        console.log('AJAX Error:', status, error);
                    }
                });
            });

            // When the place_order button is clicked, trigger the form submission
            $('#place_order').on('click', function() {
                $('#checkout_form').submit();
            });

        })
</script>
@endsection