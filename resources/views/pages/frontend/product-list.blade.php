@if (isset($products))
    @foreach ($products as $product)
        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <a href="{{ route('product_details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                        <img class="img-fluid w-100"
                            src="{{ $product->productImages->first() ? asset($product->productImages->first()->product_image) : asset('assets/eshoper/img/product-2.jpg') }}"
                            alt="">
                    </a>
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <a href="{{ route('product_details', ['id' => $product->id, 'slug' => $product->slug]) }}">
                        <h6 class="text-truncate mb-3 text-capitalize">{{ Str::limit($product->product_name, 30) }}
                        </h6>
                    </a>


                    <div class="d-flex justify-content-center">
                        <h6>${{ $product->is_discount ? $product->discount_price : $product->price }}</h6>
                        @if ($product->is_discount)
                            <h6 class="text-muted ml-2"><del>${{ $product->price }}</del></h6>
                        @endif
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="javascript:void(0)" data-id="{{ $product->id }}"
                        class="btn btn-sm text-dark p-0 add_to_wishlist">
                        <i class="fas fa-heart text-primary mr-1"></i>Add To
                        Wishlist
                    </a>


                    <a href="javascript:void(0)" data-id="{{ $product->id }}"
                        class="btn btn-sm text-dark p-0 add_to_cart"><i
                            class="fas fa-shopping-cart text-primary mr-1"></i>Add To
                        Cart</a>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        $(document).ready(function() {

            // toastr message
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            })


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



    {{-- Conditionally show pagination links only if the products are paginated --}}
    @if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator && $products->hasPages())
        <div id="pagination-links">
            {!! $products->links('vendor.pagination.bootstrap-5') !!}
        </div>
    @endif

@endif
