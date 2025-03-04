<?php

use App\Http\Controllers\SearchProductController;
use App\Http\Controllers\SubscriberUserController;
use App\Http\Controllers\User\AboutUsController;
use App\Http\Controllers\User\Auth\PasswordResetController;
use App\Http\Controllers\User\Auth\UserAuthController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\ContactUsController;
use App\Http\Controllers\User\CouponController;
use App\Http\Controllers\User\FacebookLoginController;
use App\Http\Controllers\User\GoogleAuthController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\OfferController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\SocialMediaShareController;
use App\Http\Controllers\User\UserOrderController;
use App\Http\Controllers\User\UserProductController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Middleware\CheckoutMiddleware;
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
    Route::patch('/update-profile-image/{id}', [UserProfileController::class, 'updateProfileImage'])->name('update_user_profile_image');
    Route::get('/change-password', [UserProfileController::class, 'changePasswordPage'])->name('change_password_page');
    Route::patch('/change-password', [UserProfileController::class, 'changePasswordSubmit'])->name('change_password_submit');

    Route::get('/all-order', [UserOrderController::class, 'getAllOrder'])->name('get_all_order');
    Route::get('/order-details/{id}', [UserOrderController::class, 'orderDetails'])->name('user_order_details');
    Route::get('/invoice-download/{id}', [UserOrderController::class, 'invoiceDownload'])->name('invoice_download');


});
// user auth route end



// socialite google auth route 
Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('google_auth_redirect');
Route::get('/auth/google/call-back', [GoogleAuthController::class, 'callback'])->name('google_auth_callback');


// socialite facebook auth route 
Route::get('/auth/facebook', [FacebookLoginController::class, 'redirect'])->name('facebook_auth_redirect');
Route::get('auth/facebook/call-back', [FacebookLoginController::class, 'callback'])->name('facebook_auth_callback');



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
    Route::get('/product-details/{id}/{slug}', 'productDetails')->name('product_details');
    Route::get('/products', 'searchByProduct')->name('search_by_product');
    Route::get('/filter-products-by', 'filterProducts')->name('filter_product');
});


// wishlist route start 
Route::controller(WishlistController::class)->group(function () {
    Route::get('/wishlist', 'wishlistPage')->name('wishlist_page');
    Route::post('/add-to-wishlist', 'productAddToWishlist')->name('product_add_to_wishlist');
    Route::post('/product-delete-to-wishlist', 'productDeleteToWishlist')->name('delete_product_to_wihslist');
});



// product add to cart route start
Route::controller(CartController::class)->group(function () {
    Route::get('/cart', 'addToCartPage')->name('add_to_cart_page');
    Route::post('/add-to-cart', 'productAddToCart')->name('add_to_cart_product');

    // quantity increment
    Route::post('/update-cart-quantity', 'updateCartQuantity')->name('update_cart_quantity');
    Route::delete('/delete-cart-item', 'deleteCartItem')->name('delete_cart_item');
});


// checkout route start here
Route::controller(CheckoutController::class)->middleware('checkout')->group(function () {
    Route::get('/checkout', 'checkoutPage')->name('checkout_page');
    Route::post('/checkout-submit', 'checkoutSubmit')->name('checkout_submit');
    Route::post('/addtion-with-shipping-charge-total', 'additionWishShippingChargeToTototal')->name('addition_shipping_charge_to_total');
    // apply coupon route
    Route::post('/apply-coupon', 'applyCoupon')->name('apply_coupon');
});

Route::get('/thanks/{order_code}', [CheckoutController::class, 'thenkasPage'])->name('thanks_page');



// review route start here
Route::post('/reiview-submit', [ReviewController::class, 'reviewSubmit'])->name('review_submit');

// about us page route
Route::get('/about-us', [AboutUsController::class, 'aboutUs'])->name('about_us');



Route::controller(ContactUsController::class)->group(function () {
    Route::get('/contact-us', 'contactUs')->name('contact_us');
    Route::post('/contact-us', 'contactSubmit')->name('contact_submit');
});


// offer route start here
Route::controller(OfferController::class)->group(function(){

    Route::get('/offers','getAllOffer')->name('get_all_offer');

});
Route::get('/search', [SearchProductController::class, 'search'])->name('search_product');
// subscriber user route start 
Route::post('subscriber-user-submit',[SubscriberUserController::class,'submit'])->name('subscriber_user_submit');
// subscriber user route end here




