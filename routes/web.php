<?php

use App\Http\Controllers\User\Auth\PasswordResetController;
use App\Http\Controllers\User\Auth\UserAuthController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\UserProductController;
use App\Http\Controllers\User\UserProfileController;
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
    Route::get('/logout', [UserAuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [UserAuthController::class, 'userDashboard'])->name('user_dashboard');
    Route::get('/user-profile', [UserProfileController::class, 'userProfilePage'])->name('user_profile_page');
    Route::patch('/update-profile/{id}', [UserProfileController::class, 'updateProfile'])->name('user_update_profile');
    Route::patch('/update-profile-image/{id}',[UserProfileController::class,'updateProfileImage'])->name('update_user_profile_image');
    Route::get('/change-password', [UserProfileController::class, 'changePasswordPage'])->name('change_password_page');
    Route::patch('/change-password', [UserProfileController::class, 'changePasswordSubmit'])->name('change_password_submit');



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


Route::controller(UserProductController::class)->group(function () {
    Route::get('/product-details/{id}/{slug}','productDetails')->name('product_details');
    Route::get('/products','searchByProduct')->name('search_by_product');
    Route::get('/filter-products-by','filterProducts')->name('filter_product');
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

Route::get('/user-dashboard', function () {
    return view('layouts.user.backend.dashboard.user-dashboard');
});
