<?php

use App\Http\Controllers\User\Auth\PasswordResetController;
use App\Http\Controllers\User\Auth\UserAuthController;
use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('index');



Route::controller(UserAuthController::class)->middleware('guest')->group(function () {
    Route::get('/login', 'loginPage')->name('login');
    Route::post('/login', 'loginSubmit')->name('login_submit');
    Route::get('/register', 'registerPage')->name('register_page');
    Route::post('/register', 'registerSubmit')->name('register_submit');

});



// user auth route start
Route::middleware('auth')->group(function () {
    Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [UserAuthController::class, 'userDashboard'])->name('user_dashboard');
});
// user auth route end




Route::controller(PasswordResetController::class)->group(function () {
    // Show the form for requesting the password reset link
    Route::get('/password/reset', 'showLinkRequestForm')->name('password.request');
    // Handle sending the reset link
    Route::post('/password/email', 'sendResetLinkEmail')->name('password.email');
    // Show the password reset form (the user will access this form through the reset link they receive)
    Route::get('/password/reset/{token}', 'showResetForm')->name('password.reset');
    // Handle the actual password reset
    Route::post('/password/reset', 'reset')->name('password.update');
});

Route::get('/product-details', function () {
    return view('pages.frontend.product-details');
});

Route::get('/add-to-cart', function () {
    return view('pages.frontend.add-to-cart');
});
Route::get('/contact', function () {
    return view('pages.frontend.contact');
});

Route::get('/checkout', function () {
    return view('pages.frontend.checkout');
});
Route::get('/products', function () {
    return view('pages.frontend.product-sorting');
});

Route::get('/user-dashboard', function () {
    return view('layouts.user.backend.dashboard.user-dashboard');
});
