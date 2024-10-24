<style>
    .item-container {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .item {
        margin-bottom: 1rem;
        border-bottom: 1px solid #ddd;
        padding-bottom: 1rem;
    }

    .item a {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: inherit;
    }

    .img {
        width: 50px;
        height: 50px;
    }

    .product-name {
        font-size: 1rem;
        text-transform: capitalize;
        margin: 0;
        font-weight: bold;
    }

    .product-desc {
        font-size: 0.875rem;
        margin: 0.25rem 0 0;
    }

    #pagination-links {
        margin-top: 1.5rem;
        text-align: center;
    }
</style>

<ul class="item-container">

    @if (count($products) > 0)
    <li class=" d-block mb-2">Search Result : {{ count($products) }} product</li>
    @foreach ($products as $product)
    <li class="item">
        <a href="{{ route('product_details', ['id' => $product->id, 'slug' => $product->slug]) }}"
            class="d-flex align-items-center">
            <img src="{{ asset( $product->productImages->isNotEmpty() ? $product->productImages->first()->product_image : 'assets/empty-image-300x240.jpg') }}"
                class="img-thumbnail rounded col-2 img" alt="{{ $product->product_name }} image">
            <div class="col-10 ms-2">
                <!-- Added margin start (ms) for spacing -->
                <h4 class="product-name">{{ $product->product_name }}</h4>
                <p class="product-desc">
                    {!! $product->short_description !!}
                </p>
            </div>
        </a>
    </li>
    @endforeach
    @else
    <li class="item text-center">
        No Product Available
    </li>
    @endif
</ul>