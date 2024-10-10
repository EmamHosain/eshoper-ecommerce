@include('pages.frontend.component.topbar')



<!-- Navbar Start -->
<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">


        {{-- all category --}}
        @include('pages.frontend.component.category', [
        'is_open' => $is_open,
        ])




        <div class="col-lg-9">

            {{-- nav here --}}
            @include('pages.frontend.component.navbar')

            @php
            $sliders = App\Models\CategorySlider::with('category')->whereHas('category', function ($query) {
            $query->where('status', 1);
            })
            ->where('status',1)
            ->get();
            @endphp

            {{-- header slider start --}}
            <div id="header-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">

                    @foreach ($sliders as $index => $item)
                    <div class="carousel-item {{ $index ==0 ? 'active' : '' }}" style="height: 410px;">
                        <img class="img-fluid"
                            src="{{ $item->slider_image ? asset($item->slider_image) : asset('assets/eshoper/img/carousel-1.jpg') }}"
                            alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h4 class="text-light text-uppercase font-weight-medium mb-3">{{ $item->heading_one ?? 'heading one' }}</h4>
                                <h3 class="display-4 text-white font-weight-semi-bold mb-4">{{ $item->heading_two ?? 'heading two' }}</h3>
                                <a href="" class="btn btn-light py-2 px-3">{{ $item->button_text ?? 'shop now' }}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>



                <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-prev-icon mb-n2"></span>
                    </div>
                </a>
                <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-next-icon mb-n2"></span>
                    </div>
                </a>
            </div>
            {{-- header slider start --}}

        </div>
    </div>
</div>
<!-- Navbar End -->