
@foreach ($products as $product)
<div class="col-lg-3 col-md-6 col-sm-12 pb-1">
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


            <a href="javascript:void(0)" class="btn btn-sm text-dark p-0 add_to_cart" data-id="{{ $product->id }}">
                <i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart
            </a>
        </div>
    </div>
</div>
@endforeach