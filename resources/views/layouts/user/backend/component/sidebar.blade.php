<nav class="col-md-3 col-lg-2 d-md-block sidebar">
    <div class="text-center">
        <img src="https://via.placeholder.com/80" alt="User" class="profile-photo">
        <h5>Hello, John Doe</h5>
    </div>
    <ul class="nav flex-column mt-4">
        <li><a href="{{ route('user_dashboard') }}"
                class="{{ Route::currentRouteName() === 'user_dashboard' ? 'active' : '' }}">Dashboard</a></li>
        <li><a href="{{ route('user_profile_page') }}"
                class="{{ Route::currentRouteName() === 'user_profile_page' ? 'active' : '' }}">My Profile</a></li>
        <li>
            <a href="{{ route('change_password_page') }}"
                class="{{ Route::currentRouteName() === 'change_password_page' ? 'active' : '' }}">Change Password</a>
        </li>
        <li>
            <a href="{{ route('get_all_order') }}"
                class="{{ Route::currentRouteName() === 'get_all_order' || Route::currentRouteName() === 'user_order_details'  ? 'active' : '' }}">Order</a>
        </li>

        <li><a href="{{ route('logout') }}">Logout</a></li>
    </ul>
</nav>