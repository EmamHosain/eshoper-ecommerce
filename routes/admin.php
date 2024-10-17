<?php
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderManageController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\CategorySliderController;
use App\Http\Controllers\Admin\CustomerManageController;
use App\Http\Controllers\Admin\ShippingManageController;


// admin auth route start here
Route::controller(AdminAuthController::class)->middleware(['adminGuest'])->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'loginSubmit')->name('login_submit');
    Route::get('/forgot-password', 'forgotPasswordPage')->name('forgot_password_page');
    Route::post('/forgot-password', 'forgotPasswordSubmit')->name('forgot_password_submit');
    Route::get('/reset-password/{token}', 'resetPasswordPage')->name('reset_password_page');
    Route::post('/reset-password', 'resetPasswordSubmit')->name('reset_password_submit');
});




// admin auth route end here
Route::middleware('adminAuth')->group(function () {
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    // admin backend route start here
    Route::controller(AdminDashboardController::class)->group(function () {
        Route::get('/dashboard', 'adminDashboard')->name('admin_dasboard');
    });
    // admin backend route end here
});


Route::middleware('adminAuth')->group(function () {

    // admin profile route start here
    Route::controller(AdminProfileController::class)->group(function () {
        Route::get('/profile', 'getProfilePage')->name('profile_page');
        Route::patch('/profile-update', 'profileUpdateSubmit')->name('profile_update_submit');
        Route::get('/change-password', 'changePasswordPage')->name('change_password_page');
        Route::patch('/change-password', 'changePasswordSubmit')->name('change_password_submit');
    });





    // brand route start 
    Route::controller(BrandController::class)->group(function () {
        Route::get('/all-brand', 'index')->name('all_brand');
        Route::get('/add-brand', 'add')->name('add_brand');
        Route::post('/store-brand', 'store')->name('store_brand');
        Route::get('/edit-brand/{brand}', 'edit')->name('edit_brand');
        Route::patch('/update-brand/{brand}', 'update')->name('update_brand');
        Route::get('/delete-brand/{brand}', 'delete')->name('delete_brand');
    });


    // category route start
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/all-category', 'index')->name('all_category'); // List all categories
        Route::get('/add-category', 'add')->name('add_category'); // Show add category form
        Route::post('/store-category', 'store')->name('store_category'); // Store a new category
        Route::get('/edit-category/{category}', 'edit')->name('edit_category'); // Show edit category form
        Route::patch('/update-category/{category}', 'update')->name('update_category'); // Update a category
        Route::get('/delete-category/{category}', 'delete')->name('delete_category'); // Delete a category
    });

    // category slider route start
    Route::controller(CategorySliderController::class)->group(function () {
        Route::get('/all-category-slider', 'index')->name('all_category_slider'); // List all category sliders
        Route::get('/add-category-slider', 'add')->name('add_category_slider'); // Show add category slider form
        Route::post('/store-category-slider', 'store')->name('store_category_slider'); // Store a new category slider
        Route::get('/edit-category-slider/{id}', 'edit')->name('edit_category_slider'); // Show edit category slider form
        Route::patch('/update-category-slider/{categorySlider}', 'update')->name('update_category_slider'); // Update a category slider
        Route::get('/delete-category-slider/{categorySlider}', 'delete')->name('delete_category_slider'); // Delete a category slider
    });








    // color route start
    Route::controller(ColorController::class)->group(function () {
        Route::get('/all-color', 'index')->name('all_color'); // List all colors
        Route::get('/add-color', 'add')->name('add_color'); // Show add color form
        Route::post('/store-color', 'store')->name('store_color'); // Store a new color
        Route::get('/edit-color/{color}', 'edit')->name('edit_color'); // Show edit color form
        Route::patch('/update-color/{color}', 'update')->name('update_color'); // Update a color
        Route::get('/delete-color/{color}', 'delete')->name('delete_color'); // Delete a color
    });


    // size route start
    Route::controller(SizeController::class)->group(function () {
        Route::get('/all-size', 'index')->name('all_size'); // List all sizes
        Route::get('/add-size', 'add')->name('add_size'); // Show add size form
        Route::post('/store-size', 'store')->name('store_size'); // Store a new size
        Route::get('/edit-size/{size}', 'edit')->name('edit_size'); // Show edit size form
        Route::patch('/update-size/{size}', 'update')->name('update_size'); // Update a size
        Route::get('/delete-size/{size}', 'delete')->name('delete_size'); // Delete a size
    });


    // product rouet start here
    Route::controller(ProductController::class)->group(function () {
        Route::get('/all-product', 'index')->name('all_product'); // List all products
        Route::get('/add-product', 'add')->name('add_product'); // Show add product form
        Route::post('/store-product', 'store')->name('store_product'); // Store a new product
        Route::get('/edit-product/{product}', 'edit')->name('edit_product'); // Show edit product form
        Route::patch('/update-product/{product}', 'update')->name('update_product'); // Update a product
        Route::get('/delete-product/{id}', 'delete')->name('delete_product'); // Delete a product
        // product image delete
        Route::post('/delete-image', 'deleteImage')->name('delete_image');
    });



    // coupon rouet start here
    Route::controller(CouponController::class)->group(function () {
        Route::get('/all-coupon', 'index')->name('all_coupon');
        Route::get('/add-coupon', 'add')->name('add_coupon');
        Route::post('/store-coupon', 'store')->name('store_coupon');
        Route::get('/edit-coupon/{coupon}', 'edit')->name('edit_coupon');
        Route::patch('/update-coupon/{coupon}', 'update')->name('update_coupon');
        Route::get('/delete-coupon/{id}', 'delete')->name('delete_coupon');
    });


    // shipping manage route start here
    Route::controller(ShippingManageController::class)->group(function () {
        Route::get('/all-shipping', 'index')->name('all_shipping');
        Route::get('/add-shipping', 'add')->name('add_shipping');
        Route::post('/store-shipping', 'store')->name('store_shipping');
        Route::get('/edit-shipping/{id}', 'edit')->name('edit_shipping');
        Route::patch('/update-shipping/{id}', 'update')->name('update_shipping');
        Route::get('/delete-shipping/{id}', 'delete')->name('delete_shipping');
    });


    // custom manage route start here
    Route::controller(CustomerManageController::class)->group(function () {
        Route::get('/all-customer', 'index')->name('all_customer');
        Route::get('/add-customer', 'add')->name('add_customer');
        Route::post('/store-customer', 'store')->name('store_customer');
        Route::get('/edit-customer/{id}', 'edit')->name('edit_customer');
        Route::patch('/update-customer/{id}', 'update')->name('update_customer');
        Route::get('/delete-customer/{id}', 'delete')->name('delete_customer');
    });




    // order manage route start here
    Route::controller(OrderManageController::class)->group(function () {
        Route::get('/all-order', 'index')->name('all_order');
        Route::get('/order-details/{id}', 'orderDetails')->name('order_details');
        Route::get('/delete-order/{id}', 'delete')->name('delete_order');
        Route::get('/order-download/{id}', 'downloadInvoice')->name('download_invoice');
        Route::get('/status-pending-to-completed/{id}', 'orderStatusChangePendingToCompleted')->name('order_status_change_pending_to_completed');
        Route::get('/status-pending-to-cancelled/{id}', 'orderStatusChangePendingToCancelled')->name('order_status_change_pending_to_cancelled');
    });





    // page setting route 
    Route::controller(AboutUsController::class)->group(function () {
        Route::get('/about-us','aboutUs')->name('about_us');
        Route::patch('/about-us','AboutUpdateOrCreate')->name('about_us_update_or_create');
    });


});
