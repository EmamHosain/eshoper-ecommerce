<?php
use App\Http\Controllers\Admin\Auth\AdminAuthController;


Route::controller(AdminAuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'loginSubmit')->name('login_submit');
    Route::get('/forgot-password', 'forgotPasswordPage')->name('forgot_password_page');
    Route::post('/forgot-password', 'forgotPasswordSubmit')->name('forgot_password_submit');
    Route::get('/reset-password/{token}', 'resetPasswordPage')->name('reset_password_page');
    Route::post('/reset-password', 'resetPasswordSubmit')->name('reset_password_submit');
});
