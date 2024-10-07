<?php
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Auth\AdminAuthController;


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




});
