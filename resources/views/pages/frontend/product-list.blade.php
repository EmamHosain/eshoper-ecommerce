@if (isset($products))
@foreach ($products as $product)
<div class="col-lg-4 col-md-6 col-sm-12 pb-1">
    <div class="card product-item border-0 mb-4">
        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
            <img class="img-fluid w-100"
                src="{{ !empty($product->productImages->first()) ? asset($product->productImages->first()->product_image) : asset('assets/eshoper/img/product-2.jpg') }}"
                alt="">
        </div>
        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
            <h6 class="text-truncate mb-3 text-capitalize">{{ $product->id }}-{{ $product->product_name }}-{{
                $product->category->slug }}</h6>
            <div class="d-flex justify-content-center">
                <h6 class=" ">${{ $product->is_discount ? $product->discount_price : $product->price }}
                </h6>

                @if ($product->is_discount)
                <h6 class="text-muted ml-2"><del>${{ $product->price }}</del></h6>
                @endif
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between bg-light border">
            <a href="{{ route('product_details', ['id' => $product->id, 'slug' => $product->slug]) }}"
                class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View
                Detail</a>
            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To
                Cart</a>
        </div>
    </div>
</div>
@endforeach



{{-- Conditionally show pagination links only if the products are paginated --}}
@if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator && $products->hasPages())
<div id="pagination-links">
    {!! $products->links('vendor.pagination.bootstrap-5') !!}
</div>
@endif

@endif