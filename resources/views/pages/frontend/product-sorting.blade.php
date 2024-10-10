@extends('layouts.user.master')

@section('title')
Products
@endsection



@section('header')
@include('pages.frontend.component.header2')
@endsection



@section('content')
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Our Shop</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Shop</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


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
                        <input type="checkbox" class="custom-control-input filter-checkbox" id="price-1">
                        <label class="custom-control-label" for="price-1">$0 - $100</label>
                        <span class="badge border font-weight-normal">{{ $product_0_to_100 }}</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input filter-checkbox" id="price-2">
                        <label class="custom-control-label" for="price-2">$100 - $200</label>
                        <span class="badge border font-weight-normal">{{ $product_100_to_200 }}</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input filter-checkbox" id="price-3">
                        <label class="custom-control-label" for="price-3">$200 - $300</label>
                        <span class="badge border font-weight-normal">{{ $product_200_to_300 }}</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input filter-checkbox" id="price-4">
                        <label class="custom-control-label" for="price-4">$300 - $400</label>
                        <span class="badge border font-weight-normal">{{ $product_300_to_400 }}</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input filter-checkbox" id="price-5">
                        <label class="custom-control-label" for="price-5">$400 - $500</label>
                        <span class="badge border font-weight-normal">{{ $product_400_to_500 }}</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-control-input filter-checkbox" id="price-6">
                        <label class="custom-control-label" for="price-6">$500+</label>
                        <span class="badge border font-weight-normal">{{ $product_greater_than_500 }}</span>
                    </div>
                </form>
            </div>
            <!-- Price End -->

            <!-- Color Start -->
            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Filter by Color</h5>
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
                        <input type="checkbox" class="custom-control-input filter_checkbox" data-type="sizes" value="{{ $item->id }}"
                            id="{{ $item->size_name . '-' . $item->id }}">
                        <label class="custom-control-label text-uppercase"
                            for="{{ $item->size_name . '-' . $item->id }}">{{ $item->size_name }}</label>
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
                            <form action="">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search by name">
                                    <div class="input-group-append">
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
                                    <a class="dropdown-item" href="#">Latest</a>
                                    <a class="dropdown-item" href="#">Popularity</a>
                                    <a class="dropdown-item" href="#">Best Rating</a>
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
            var filter = {

            };


            $('.filter_checkbox').change(function() {
                var colorId = $(this).val();
                var type = $(this).data('type');

                if(!filter[type]){
                    filter[type] = []
                }

                if ($(this).is(':checked')) {
                    filter[type].push(colorId)
                   // colors.push(colorId); // Add the color ID to the array
                } else {
                    // Remove the color ID if unchecked
                    var index =filter[type].indexOf(colorId);
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
            function fetchFilteredProducts(page) {
                $.ajax({
                    url: "{{ route('filter_product') }}?page=" + page,
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function(response) {
                        $('#product-list').removeClass('hidden');
                        $('#product-list').html(response.view); // Update product list
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








        });
</script>
@endsection