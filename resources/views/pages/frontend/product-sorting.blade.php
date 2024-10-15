@extends('layouts.user.master')

@section('title')
Products
@endsection



@section('header')
@include('pages.frontend.component.header2')
@endsection



@section('content')
<style>
    .custom-btn-reset {
        /* border: none;*/
        outline: none;
        border-color: white;
    }
</style>

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">

        @if (Request::query('category'))
        @php
        $category_name = App\Models\Category::where('slug', Request::query('category'))->first()
        ->category_name;
        @endphp
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Search By Category : {{ $category_name }}</h1>
        @else
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Our Shop</h1>
        @endif
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{ route('index') }}">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Shop</p>
        </div>
    </div>
</div>
<!-- Page Header End -->
<div id="product-container"></div>



<!-- Shop Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-12">
            <!-- Price Start -->
            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Filter by price</h5>
                <form>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <label class="">All Price Product</label>
                        <span class="badge border font-weight-normal">{{ $all_product_price_count }}</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" data-type="prices" class="custom-control-input filter_checkbox"
                            id="price-1" value="0_to_100">
                        <label class="custom-control-label" for="price-1">$0 - $100</label>
                        <span class="badge border font-weight-normal">{{ $product_0_to_100 }}</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" data-type="prices" class="custom-control-input filter_checkbox"
                            id="price-2" value="100_to_200">
                        <label class="custom-control-label" for="price-2">$100 - $200</label>
                        <span class="badge border font-weight-normal">{{ $product_100_to_200 }}</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" data-type="prices" class="custom-control-input filter_checkbox"
                            id="price-3" value="200_to_300">
                        <label class="custom-control-label" for="price-3">$200 - $300</label>
                        <span class="badge border font-weight-normal">{{ $product_200_to_300 }}</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" data-type="prices" class="custom-control-input filter_checkbox"
                            id="price-4" value="300_to_400">
                        <label class="custom-control-label" for="price-4">$300 - $400</label>
                        <span class="badge border font-weight-normal">{{ $product_300_to_400 }}</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" data-type="prices" class="custom-control-input filter_checkbox"
                            id="price-5" value="400_to_500">
                        <label class="custom-control-label" for="price-5">$400 - $500</label>
                        <span class="badge border font-weight-normal">{{ $product_400_to_500 }}</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" data-type="prices" class="custom-control-input filter_checkbox"
                            id="price-6" value="500_to_500000">
                        <label class="custom-control-label" for="price-6">$500+</label>
                        <span class="badge border font-weight-normal">{{ $product_greater_than_500 }}</span>
                    </div>
                </form>
            </div>
            <!-- Price End -->

            <!-- Color Start -->
            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Filter by color</h5>
                <form id="filter-form">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <label class="">All Color Product</label>
                        <span class="badge border font-weight-normal">{{ $total_product_count_with_color }}</span>
                    </div>

                    @foreach ($product_count_with_color as $index => $item)
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input filter_checkbox" value="{{ $item->id }}"
                            data-type="colors" id="{{ $item->color_name . '-' . $item->id }}">
                        <label class="custom-control-label text-capitalize"
                            for="{{ $item->color_name . '-' . $item->id }}">{{ $item->color_name }}</label>
                        <span class="badge border font-weight-normal">{{ $item->product_count }}</span>
                    </div>
                    @endforeach
                </form>
            </div>

            <!-- Color End -->

            <!-- Size Start -->
            <div class="mb-5">
                <h5 class="font-weight-semi-bold mb-4">Filter by size</h5>
                <form>
                    <div class="d-flex align-items-center justify-content-between mb-3">

                        <label class="">All Size Product</label>
                        <span class="badge border font-weight-normal">{{ $total_product_count_with_size }}</span>
                    </div>
                    @foreach ($sizes_with_product_count as $index => $item)
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input filter_checkbox" data-type="sizes"
                            value="{{ $item->id }}" id="{{ $item->size_name . '-' . $item->id }}">
                        <label class="custom-control-label text-uppercase"
                            for="{{ $item->size_name . '-' . $item->id }}">{{ $item->size_name }}</label>
                        <span class="badge border font-weight-normal">{{ $item->product_count }}</span>
                    </div>
                    @endforeach

                </form>
            </div>
            <!-- Size End -->



            <!-- brand Start -->
            <div class="mb-5">
                <h5 class="font-weight-semi-bold mb-4">Filter by brand</h5>
                <form>
                    <div class="d-flex align-items-center justify-content-between mb-3">

                        <label class="">All Brand Product</label>
                        <span class="badge border font-weight-normal">{{ $all_brand_product_count }}</span>
                    </div>
                    @foreach ($all_brand as $index => $item)
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input filter_checkbox" data-type="brands"
                            value="{{ $item->id }}" id="{{ $item->brand_name . '-' . $item->id }}">
                        <label class="custom-control-label text-uppercase"
                            for="{{ $item->brand_name . '-' . $item->id }}">{{ $item->brand_name }}</label>
                        <span class="badge border font-weight-normal">{{ $item->product_count }}</span>
                    </div>
                    @endforeach

                </form>
            </div>
            <!-- Size End -->




        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-12">
            <div class=" pb-3">
                <div class="row">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">

                            <form id="searchForm">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search by name"
                                        id="search_filter" name="search_query">
                                    <div class="input-group-append cursor-pointer">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>

                                </div>
                            </form>



                            <div class="dropdown ml-4">
                                <button class="btn border dropdown-toggle" type="button" id="triggerId"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Sort by
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                    <a class="dropdown-item popularity " data-type="popularity" data-id=""
                                        href="javascript:void(0)">Latest</a>
                                    <a class="dropdown-item popularity" data-type="popularity" data-id="trandy"
                                        href="javascript:void(0)">Trandy</a>
                                    <a class="dropdown-item popularity" data-type="popularity" data-id="arrived"
                                        href="javascript:void(0)">Just Arrived</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div id="product-list" class="row">
                    @include('pages.frontend.product-list')
                </div>


            </div>

        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->


<script>
    $(document).ready(function() {
            const params = new URLSearchParams(window.location.search);
            const category = params.get('category');
            var filter = {

            };
            $('.filter_checkbox').change(function() {
                var id = $(this).val();
                var type = $(this).data('type');

                if (category !== null) {
                    if (!filter[type]) {
                        filter['category'] = [];
                    }
                    filter['category'].push(category)
                }
                if (!filter[type]) {
                    filter[type] = []
                }

                if ($(this).is(':checked')) {
                    filter[type].push(id)
                } else {
                    // Remove the color ID if unchecked
                    var index = filter[type].indexOf(id);
                    if (index !== -1) {
                        filter[type].splice(index, 1);
                    }
                }

                // Make AJAX request
                $.ajax({
                    url: "{{ route('filter_product') }}", // Your filter route
                    method: 'GET',
                    data: filter,
                    success: function(response) {
                        $('#product-list').html(response.view);

                        $('html, body').animate({
                            scrollTop: $('#product-container').offset().top
                        }, 1000); // Adjust duration as needed
                    },
                    error: function(xhr) {
                        console.error(xhr); // Log any errors for debugging
                        alert(
                            'An error occurred while fetching the products. Please try again.'
                        );
                    }
                });


            });


            // start here
            // search by category 
            function fetchFilteredProducts(page) {
                $.ajax({
                    url: "{{ route('filter_product') }}?page=" + page,
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        category: category ?? ''
                    },

                    success: function(response) {
                        $('#product-list').html(response.view);
                        $('html, body').animate({
                            scrollTop: $(
                                    '#product-container')
                                .offset().top
                        }, 1000); // Adjust duration as needed
                    },
                    error: function(xhr) {
                        console.error(xhr); // Log errors
                        alert(
                            'An error occurred while fetching the products. Please try again.');
                    }
                });


            }
            fetchFilteredProducts(1);

            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();

                // Get the page number from the pagination link
                var page = $(this).attr('href').split('page=')[1];
                fetchFilteredProducts(page);
            });


            // search filter
            $(document).ready(function() {
                let debounceTimer;

                $('#search_filter').on('input', function(e) {
                    // Prevent the form from submitting the traditional way
                    e.preventDefault();

                    // Clear the previous timer to prevent multiple requests
                    clearTimeout(debounceTimer);

                    // Get the value from the input field
                    var searchQuery = $(this).val();

                    // Check if there's a valid search query

                    // Set a debounce timer to limit the number of requests
                    debounceTimer = setTimeout(function() {
                        // Make the AJAX request
                        $.ajax({
                            url: "{{ route('filter_product') }}", // Your filter route
                            method: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr('content')
                            },
                            data: {
                                search: searchQuery
                            }, // Send the search query
                            success: function(response) {
                                // Update the product list with the response
                                $('#product-list').html(response.view);

                                // Scroll to the product container
                                $('html, body').animate({
                                    scrollTop: $(
                                            '#product-container')
                                        .offset().top
                                }, 1000); // Adjust duration as needed
                            },
                            error: function(xhr, status, error) {
                                // Handle errors
                                console.error('Error fetching products:',
                                    xhr.responseText);
                            }
                        });
                    }, 500); // Delay for 300ms (adjust as needed)

                });
            });

            // search by popularity
            $('.popularity').on('click', function() {

                var id = $(this).val();
                var type = $(this).data('type');
                var value = $(this).data('id')

                if(filter['popularity']){
                    delete filter['popularity'];
                }
                if (!filter['popularity']) {
                    filter['popularity'] = [];
                    filter['popularity'].push(value)
                }

                if (category !== null) {
                    if (!filter['category']) {
                        filter['category'] = [];
                    }
                    filter['category'].push(category)
                }

                if (!filter[type]) {
                    filter[type] = []
                }

                if ($(this).is(':checked')) {
                    filter[type].push(id)
                } else {
                    // Remove the color ID if unchecked
                    var index = filter[type].indexOf(id);
                    if (index !== -1) {
                        filter[type].splice(index, 1);
                    }
                }

                var value = $(this).data('popularity');
                var page = 1;
                $.ajax({
                    url: "{{ route('filter_product') }}?page=" + page,
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: filter,


                    success: function(response) {
                        $('#product-list').html(response.view);
                        $('html, body').animate({
                            scrollTop: $(
                                    '#product-container')
                                .offset().top
                        }, 1000); // Adjust duration as needed
                    },
                    error: function(xhr) {
                        console.error(xhr); // Log errors
                        alert(
                            'An error occurred while fetching the products. Please try again.'
                        );
                    }
                });
            })
        });
</script>
@endsection