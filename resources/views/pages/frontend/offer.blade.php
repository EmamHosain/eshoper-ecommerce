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
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Our Shop</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{ route('index') }}">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Shop</p>
        </div>
    </div>
</div>

<style>
    .offer-image {
        width: 100%;
        object-fit: cover;
    }

    /* Height for small screens (sm) */
    @media (max-width: 767.98px) {
        .offer-image {
            height: 300px;
        }
    }

    /* Height for medium screens (md) and above */
    @media (min-width: 768px) {
        .offer-image {
            height: 500px;
        }
    }
</style>
<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        {{-- content here --}}
        @if ($offer->isNotEmpty())
        @foreach ($offer as $item)
        <div class="col-12 col-md-6 my-2">
            <a href="{{ route('product_details',['id'=>$item->product->id,'slug'=> $item->product->slug]) }}">
                <img src="{{ asset($item->banner_image) }}" alt="{{ $item->product->product_name }}"
                    class="img-fluid offer-image">
            </a>
        </div>
        @endforeach

        @else
        <h1 class="text-center w-100">No Offer Available</h1>
        @endif
        <!-- Shop Sidebar End -->
    </div>
</div>
<!-- Shop End -->
@endsection