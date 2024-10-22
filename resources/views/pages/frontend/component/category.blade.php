<div class="col-lg-3 d-none d-lg-block">
    <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
        data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
        <h6 class="m-0">Categories</h6>
        <i class="fa fa-angle-down text-dark"></i>
    </a>

    @php
        $categories = App\Models\Category::withCount([
            'products' => function ($query) {
                $query->where('status', 1);
            },
        ])
            // ->whereHas('products', function ($query) {
            //     $query->where('status', 1);
            // })
            ->where('status', 1)
            ->latest()
            ->get();
    @endphp
    <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light"
        id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
        <div class="navbar-nav w-100 overflow-auto" style="max-height: 410px">

            @foreach ($categories as $category)
                <a href="{{ route('search_by_product', ['category' => $category->slug]) }}"
                    class="nav-item nav-link d-flex justify-content-between">{{ $category->category_name }}

                    <span>{{ $category->products_count }}</span>
                </a>
            @endforeach

        </div>
    </nav>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var navbarVertical = document.getElementById('navbar-vertical');
        // var toggleBtn = document.getElementById('toggle-btn');
        // var toggleIcon = document.getElementById('toggle-icon');

        // Pass the is_open value from Blade to JavaScript
        var isOpen = @json($is_open ?? false); // Blade variable to JavaScript

        // Check if navbar should be open initially based on is_open
        if (isOpen) {
            navbarVertical.classList.add('show'); // Keep it open by default
            // toggleIcon.classList.remove('fa-angle-down');
            // toggleIcon.classList.add('fa-angle-up');
        }

        // Add event listener for the button click
        // toggleBtn.addEventListener('click', function(e) {
        //     e.preventDefault();

        //     if (navbarVertical.classList.contains('show')) {
        //         // Collapse the menu
        //         toggleIcon.classList.remove('fa-angle-up');
        //         toggleIcon.classList.add('fa-angle-down');
        //     } else {
        //         // Expand the menu
        //         toggleIcon.classList.remove('fa-angle-down');
        //         toggleIcon.classList.add('fa-angle-up');
        //     }
        // });
    });
</script>
