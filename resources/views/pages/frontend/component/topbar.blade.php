<!-- Topbar Start -->
<div class="container-fluid">
    <div class="row bg-secondary py-2 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center">
                <a class="text-dark" href="#">FAQs</a>
                <span class="text-muted px-2">|</span>
                <a class="text-dark" href="#">Help</a>
                <span class="text-muted px-2">|</span>
                <a class="text-dark" href="#">Support</a>
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                <a class="text-dark px-2" href="#">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a class="text-dark px-2" href="#">
                    <i class="fab fa-twitter"></i>
                </a>
                <a class="text-dark px-2" href="#">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a class="text-dark px-2" href="#">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="text-dark pl-2" href="#">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row align-items-center py-3 px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="{{ route('index') }}" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span
                        class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
            </a>
        </div>

        {{-- search product start --}}
        <div class="col-lg-6 col-6 text-left">
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control" id="searchInput" placeholder="Search for products">
                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>

        {{-- modal start --}}
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="searchModalLabel">Search</h5>
                        <button type="button" class="btn btn-secondary" id="closeBtn">x</button>
                    </div>
                    <div class="modal-body">
                        <!-- Modal body with search field -->
                        <form id="search_submit_form">
                            <div id="search_submit" class="d-flex">
                                <input type="text" class="form-control" id="searchProduct"
                                    placeholder="Search product...">
                                <button type="submit" id="submit_button"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                        <div id="searchContent" class="mt-3">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- modal start --}}

        {{-- modal end --}}
        {{-- search product end --}}

        <div class="col-lg-3 col-6 text-right">
            @php
            $wishlist_item_count = count(Session::get('wishlist', []));
            $cart_item_count = count(Session::get('cart', []));

            @endphp
            <a href="{{ route('wishlist_page') }}" class="btn border">
                <i class="fas fa-heart text-primary"></i>
                <span id="wishlist_count" class="badge">{{ $wishlist_item_count ?? '0' }}</span>
            </a>
            <a href="{{ route('add_to_cart_page') }}" class="btn border">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span id="cart_count" class="badge">{{ $cart_item_count ?? '0' }}</span>
            </a>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Show the modal when input gets focus

        $('#search_submit_form').on('submit', function(event) {
            event.preventDefault();
            var value = $('#searchProduct').val();
            $.ajax({
                url: "{{ route('search_product') }}?query="+value,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // console.log(response)
                    $('#searchContent').html(response.view);
                    $('#searchContent').css({
                        'max-height': '400px',
                        'overflow-y': 'scroll',
                    });

                },
                error: function(xhr) {
                    console.error(xhr);
                    alert(
                        'An error occurred while fetching the products. Please try again.'
                    );
                }
            });
        })

        // console.log('keyword', keyword);





        $('#searchInput').on('focus', function() {
            $('#searchModal').modal('show');
            $('#searchContent').addClass('hidden');
        });


        $('#closeBtn').on('click', function() {
            $('#searchModal').modal('hide');
            $('#searchProduct').val('')
            $('#searchContent').empty();
        });






    });
</script>