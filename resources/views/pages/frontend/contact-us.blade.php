@extends('layouts.user.master')

@section('title')
Contact Us
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
            <p class="m-0"><a href="{{ route('index') }}">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Contact Us</p>
        </div>
    </div>
</div>

{{-- contact us content start here --}}
<div class="container-fluid py-2 px-xl-5">
    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, illo deleniti dolores voluptates, libero
        reiciendis alias odit eius quae laudantium ipsa itaque ratione natus quidem iusto asperiores corporis blanditiis
        consequatur tempore debitis deserunt quam hic eos ut? Numquam quos inventore eius! Dolor commodi, perspiciatis
        obcaecati veniam, deleniti molestiae ipsum praesentium laudantium pariatur nam repellendus. Veniam aspernatur
        officia, libero sequi, velit nobis amet aperiam eligendi quae incidunt, accusantium alias molestiae magnam.
        Eveniet,
        atque animi at repudiandae neque dignissimos? Aperiam aut eum amet fuga placeat provident quaerat in dignissimos
        animi nihil, praesentium, totam vitae adipisci nemo illo officiis nobis facere voluptatibus. Quia.
    </p>
</div>
@endsection