@include('pages.frontend.component.topbar')
<!-- Navbar Start -->
<div class="container-fluid">
    <div class="row border-top px-xl-5">

        {{-- category here --}}
        @include('pages.frontend.component.category')

        <div class="col-lg-9">
            @include('pages.frontend.component.navbar')
        </div>

    </div>
</div>
<!-- Navbar End -->