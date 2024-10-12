<nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
    <a href="" class="text-decoration-none d-block d-lg-none">
        <h1 class="m-0 display-5 font-weight-semi-bold"><span
                class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
    </a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
        <div class="navbar-nav mr-auto py-0">
            <a href="{{ route('index') }}"
                class="nav-item nav-link {{ Route::currentRouteName() === 'index' ? 'active' : '' }}">Home</a>
            <a href="{{ route('search_by_product') }}"
                class="nav-item nav-link {{ Route::currentRouteName() ===  'search_by_product' ? 'active' : ''}}">Products</a>


            <a href="detail.html" class="nav-item nav-link">About Us</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                <div class="dropdown-menu rounded-0 m-0">
                    <a href="cart.html" class="dropdown-item">Shopping Cart</a>
                    <a href="checkout.html" class="dropdown-item">Checkout</a>
                </div>
            </div>
            <a href="contact.html" class="nav-item nav-link">Contact Us</a>
        </div>
        <div class="navbar-nav ml-auto py-0">

            @if (Auth::guard('web')->user())
            <a href="{{ route('user_dashboard') }}" class="nav-item nav-link">Dashboard</a>

            <a href="{{ route('logout') }}" class="nav-item nav-link">
                Logout
            </a>
            @elseif (Auth::guard('admin')->user())
            <a href="{{ route('admin.admin_dasboard') }}" class="nav-item nav-link">Dashboard</a>
            <a href="{{ route('admin.logout') }}" class="nav-item nav-link">Logout</a>
            @else
            <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
            <a href="{{ route('register_page') }}" class="nav-item nav-link">Register</a>
            @endif

        </div>
    </div>
</nav>