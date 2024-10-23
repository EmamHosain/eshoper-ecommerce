<!-- Footer Start -->
<div class="container-fluid bg-secondary text-dark mt-5 pt-5">
    <div class="row px-xl-5 pt-5">


        <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
            <a href="{{ route('index') }}" class="text-decoration-none">
                <h1 class="mb-4 display-5 font-weight-semi-bold"><span
                        class="text-primary font-weight-bold border border-white px-3 mr-1">E</span>Shopper</h1>
            </a>
            <p>Dolore erat dolor sit lorem vero amet. Sed sit lorem magna, ipsum no sit erat lorem et magna ipsum
                dolore amet erat.</p>
            <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
            <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
            <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
        </div>




        <div class="col-lg-8 col-md-12">
            <div class="row">
                <div class="col-md-4 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-dark mb-2" href="{{ route('index') }}"><i
                                class="fa fa-angle-right mr-2"></i>Home</a>
                        <a class="text-dark mb-2" href="{{ route('search_by_product') }}"><i
                                class="fa fa-angle-right mr-2"></i>Products</a>
                        <a class="text-dark mb-2" href="{{ route('get_all_offer') }}"><i
                                class="fa fa-angle-right mr-2"></i>Offer</a>
                        <a class="text-dark mb-2" href="{{ route('about_us') }}"><i
                                class="fa fa-angle-right mr-2"></i>About Us</a>
                        <a class="text-dark mb-2" href="{{ route('contact_us') }}"><i
                                class="fa fa-angle-right mr-2"></i>Contact Us</a>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4">Top Category</h5>
                    <div class="d-flex flex-column justify-content-start">

                        @php
                        $categories = App\Models\Category::where('status', 1)->latest()->take(10)->get();
                        @endphp

                        @foreach ($categories as $category)
                        <a class="text-dark mb-2"
                            href=" {{ route('search_by_product', ['category' => $category->slug]) }}"><i
                                class="fa fa-angle-right mr-2"></i>{{ $category->category_name }}</a>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4">Newsletter</h5>
                    <form id="subscriber_submit">
                        <div class="form-group">
                            <input type="text" class="form-control border-0 py-4" name="name" placeholder="Your Name" />
                            <p id="subscriber_user_name_error" class=" text-danger" style="font-size: 13px"></p>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control border-0 py-4"
                                placeholder="Your Email" />
                            <p id="subscriber_user_email_error" class="text-danger" style="font-size: 13px"></p>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary btn-block border-0 py-3"
                                type="submit">Subscribe
                                Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row border-top border-light mx-xl-5 py-4">
        <div class="col-md-6 px-xl-0">
            <p class="mb-md-0 text-center text-md-left text-dark">
                &copy; <a class="text-dark font-weight-semi-bold" href="#">Your Site Name</a>. All Rights Reserved.
                Designed
                by
                <a class="text-dark font-weight-semi-bold" href="https://htmlcodex.com">HTML Codex</a><br>
                Distributed By <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
            </p>
        </div>
        <div class="col-md-6 px-xl-0 text-center text-md-right">
            <img class="img-fluid" src="{{ asset('assets/eshoper/img/payments.png') }}" alt="">
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
            // toastr message
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            })

            $('#subscriber_submit').on('submit', function(event) {
                event.preventDefault();

                $.ajax({
                    url: "{{ route('subscriber_user_submit') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log(response);

                        if (response.errors && response.errors.email) {
                            $('#subscriber_user_email_error').text(response.errors.email);
                           
                        }
                        if (response.errors && response.errors.name) {
                            $('#subscriber_user_name_error').text(response.errors.name);
                           
                        }
                        // Checking for errors properly
                        if (response.success) {
                            Toast.fire({
                                icon: 'success',
                                title: response.success,
                            }).then(() => {
                                window.location.reload();
                            });
                        } 
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText); // Logs more detailed error info
                        alert('An error occurred while submitting the data. Please try again.');
                    }
                });
            });

        })
</script>
<!-- Footer End -->