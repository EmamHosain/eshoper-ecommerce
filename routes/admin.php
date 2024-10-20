<?php
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RolePermissionController;
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
use App\Http\Controllers\Admin\SubscriberUserController;


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
        Route::get('/all-brand', 'index')->name('all_brand')->middleware('permission:brand_read');
        Route::get('/add-brand', 'add')->name('add_brand')->middleware('permission:brand_create');
        Route::post('/store-brand', 'store')->name('store_brand')->middleware('permission:brand_create');
        Route::get('/edit-brand/{brand}', 'edit')->name('edit_brand')->middleware('permission:brand_edit');
        Route::patch('/update-brand/{brand}', 'update')->name('update_brand')->middleware('permission:brand_edit');
        Route::get('/delete-brand/{brand}', 'delete')->name('delete_brand')->middleware('permission:brand_delete');
    });


    // category route start
    // Route::controller(CategoryController::class)->group(function () {
    //     Route::get('/all-category', 'index')->name('all_category'); // List all categories
    //     Route::get('/add-category', 'add')->name('add_category'); // Show add category form
    //     Route::post('/store-category', 'store')->name('store_category'); // Store a new category
    //     Route::get('/edit-category/{category}', 'edit')->name('edit_category'); // Show edit category form
    //     Route::patch('/update-category/{category}', 'update')->name('update_category'); // Update a category
    //     Route::get('/delete-category/{category}', 'delete')->name('delete_category'); // Delete a category
    // });

    // category route start
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/all-category', 'index')->name('all_category')->middleware('permission:category_read'); // List all categories
        Route::get('/add-category', 'add')->name('add_category')->middleware('permission:category_create'); // Show add category form
        Route::post('/store-category', 'store')->name('store_category')->middleware('permission:category_create'); // Store a new category
        Route::get('/edit-category/{category}', 'edit')->name('edit_category')->middleware('permission:category_edit'); // Show edit category form
        Route::patch('/update-category/{category}', 'update')->name('update_category')->middleware('permission:category_edit'); // Update a category
        Route::get('/delete-category/{category}', 'delete')->name('delete_category')->middleware('permission:category_delete'); // Delete a category
    });


    // category slider route start
    // Route::controller(CategorySliderController::class)->group(function () {
    //     Route::get('/all-category-slider', 'index')->name('all_category_slider'); // List all category sliders
    //     Route::get('/add-category-slider', 'add')->name('add_category_slider'); // Show add category slider form
    //     Route::post('/store-category-slider', 'store')->name('store_category_slider'); // Store a new category slider
    //     Route::get('/edit-category-slider/{id}', 'edit')->name('edit_category_slider'); // Show edit category slider form
    //     Route::patch('/update-category-slider/{categorySlider}', 'update')->name('update_category_slider'); // Update a category slider
    //     Route::get('/delete-category-slider/{categorySlider}', 'delete')->name('delete_category_slider'); // Delete a category slider
    // });

    // category slider route start
    Route::controller(CategorySliderController::class)->group(function () {
        Route::get('/all-category-slider', 'index')->name('all_category_slider')->middleware('permission:category_slider_read'); // List all category sliders
        Route::get('/add-category-slider', 'add')->name('add_category_slider')->middleware('permission:category_slider_create'); // Show add category slider form
        Route::post('/store-category-slider', 'store')->name('store_category_slider')->middleware('permission:category_slider_create'); // Store a new category slider
        Route::get('/edit-category-slider/{id}', 'edit')->name('edit_category_slider')->middleware('permission:category_slider_edit'); // Show edit category slider form
        Route::patch('/update-category-slider/{categorySlider}', 'update')->name('update_category_slider')->middleware('permission:category_slider_edit'); // Update a category slider
        Route::get('/delete-category-slider/{categorySlider}', 'delete')->name('delete_category_slider')->middleware('permission:category_slider_delete'); // Delete a category slider
    });








    // color route start
    // Route::controller(ColorController::class)->group(function () {
    //     Route::get('/all-color', 'index')->name('all_color'); // List all colors
    //     Route::get('/add-color', 'add')->name('add_color'); // Show add color form
    //     Route::post('/store-color', 'store')->name('store_color'); // Store a new color
    //     Route::get('/edit-color/{color}', 'edit')->name('edit_color'); // Show edit color form
    //     Route::patch('/update-color/{color}', 'update')->name('update_color'); // Update a color
    //     Route::get('/delete-color/{color}', 'delete')->name('delete_color'); // Delete a color
    // });

    // color route start
    Route::controller(ColorController::class)->group(function () {
        Route::get('/all-color', 'index')->name('all_color')->middleware('permission:color_read'); // List all colors
        Route::get('/add-color', 'add')->name('add_color')->middleware('permission:color_create'); // Show add color form
        Route::post('/store-color', 'store')->name('store_color')->middleware('permission:color_create'); // Store a new color
        Route::get('/edit-color/{color}', 'edit')->name('edit_color')->middleware('permission:color_edit'); // Show edit color form
        Route::patch('/update-color/{color}', 'update')->name('update_color')->middleware('permission:color_edit'); // Update a color
        Route::get('/delete-color/{color}', 'delete')->name('delete_color')->middleware('permission:color_delete'); // Delete a color
    });




    // size route start
    // Route::controller(SizeController::class)->group(function () {
    //     Route::get('/all-size', 'index')->name('all_size'); // List all sizes
    //     Route::get('/add-size', 'add')->name('add_size'); // Show add size form
    //     Route::post('/store-size', 'store')->name('store_size'); // Store a new size
    //     Route::get('/edit-size/{size}', 'edit')->name('edit_size'); // Show edit size form
    //     Route::patch('/update-size/{size}', 'update')->name('update_size'); // Update a size
    //     Route::get('/delete-size/{size}', 'delete')->name('delete_size'); // Delete a size
    // });


    // size route start
    Route::controller(SizeController::class)->group(function () {
        Route::get('/all-size', 'index')->name('all_size')->middleware('permission:size_read'); // List all sizes
        Route::get('/add-size', 'add')->name('add_size')->middleware('permission:size_create'); // Show add size form
        Route::post('/store-size', 'store')->name('store_size')->middleware('permission:size_create'); // Store a new size
        Route::get('/edit-size/{size}', 'edit')->name('edit_size')->middleware('permission:size_edit'); // Show edit size form
        Route::patch('/update-size/{size}', 'update')->name('update_size')->middleware('permission:size_edit'); // Update a size
        Route::get('/delete-size/{size}', 'delete')->name('delete_size')->middleware('permission:size_delete'); // Delete a size
    });



    // product rouet start here
    // Route::controller(ProductController::class)->group(function () {
    //     Route::get('/all-product', 'index')->name('all_product'); // List all products
    //     Route::get('/add-product', 'add')->name('add_product'); // Show add product form
    //     Route::post('/store-product', 'store')->name('store_product'); // Store a new product
    //     Route::get('/edit-product/{product}', 'edit')->name('edit_product'); // Show edit product form
    //     Route::patch('/update-product/{product}', 'update')->name('update_product'); // Update a product
    //     Route::get('/delete-product/{id}', 'delete')->name('delete_product'); // Delete a product
    //     // product image delete
    //     Route::post('/delete-image', 'deleteImage')->name('delete_image');
    // });


    // product route start here
    Route::controller(ProductController::class)->group(function () {
        Route::get('/all-product', 'index')->name('all_product')->middleware('permission:product_read'); // List all products
        Route::get('/add-product', 'add')->name('add_product')->middleware('permission:product_create'); // Show add product form
        Route::post('/store-product', 'store')->name('store_product')->middleware('permission:product_create'); // Store a new product
        Route::get('/edit-product/{product}', 'edit')->name('edit_product')->middleware('permission:product_edit'); // Show edit product form
        Route::patch('/update-product/{product}', 'update')->name('update_product')->middleware('permission:product_edit'); // Update a product
        Route::get('/delete-product/{id}', 'delete')->name('delete_product')->middleware('permission:product_delete'); // Delete a product
        // product image delete
        Route::post('/delete-image', 'deleteImage')->name('delete_image')->middleware('permission:product_edit'); // Delete a product image
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
    // Route::controller(ShippingManageController::class)->group(function () {
    //     Route::get('/all-shipping', 'index')->name('all_shipping');
    //     Route::get('/add-shipping', 'add')->name('add_shipping');
    //     Route::post('/store-shipping', 'store')->name('store_shipping');
    //     Route::get('/edit-shipping/{id}', 'edit')->name('edit_shipping');
    //     Route::patch('/update-shipping/{id}', 'update')->name('update_shipping');
    //     Route::get('/delete-shipping/{id}', 'delete')->name('delete_shipping');
    // });

    // shipping manage route start here
    Route::controller(ShippingManageController::class)->group(function () {
        Route::get('/all-shipping', 'index')->name('all_shipping')->middleware('permission:shipping_read'); // List all shippings
        Route::get('/add-shipping', 'add')->name('add_shipping')->middleware('permission:shipping_create'); // Show add shipping form
        Route::post('/store-shipping', 'store')->name('store_shipping')->middleware('permission:shipping_create'); // Store a new shipping
        Route::get('/edit-shipping/{id}', 'edit')->name('edit_shipping')->middleware('permission:shipping_edit'); // Show edit shipping form
        Route::patch('/update-shipping/{id}', 'update')->name('update_shipping')->middleware('permission:shipping_edit'); // Update a shipping
        Route::get('/delete-shipping/{id}', 'delete')->name('delete_shipping')->middleware('permission:shipping_delete'); // Delete a shipping
    });



    // customer manage route start here
    // Route::controller(CustomerManageController::class)->group(function () {
    //     Route::get('/all-customer', 'index')->name('all_customer');
    //     Route::get('/add-customer', 'add')->name('add_customer');
    //     Route::post('/store-customer', 'store')->name('store_customer');
    //     Route::get('/edit-customer/{id}', 'edit')->name('edit_customer');
    //     Route::patch('/update-customer/{id}', 'update')->name('update_customer');
    //     Route::get('/delete-customer/{id}', 'delete')->name('delete_customer');
    // });



    // customer manage route start here
    Route::controller(CustomerManageController::class)->group(function () {
        Route::get('/all-customer', 'index')->name('all_customer')->middleware('permission:customer_read'); // List all customers
        Route::get('/add-customer', 'add')->name('add_customer')->middleware('permission:customer_create'); // Show add customer form
        Route::post('/store-customer', 'store')->name('store_customer')->middleware('permission:customer_create'); // Store a new customer
        Route::get('/edit-customer/{id}', 'edit')->name('edit_customer')->middleware('permission:customer_edit'); // Show edit customer form
        Route::patch('/update-customer/{id}', 'update')->name('update_customer')->middleware('permission:customer_edit'); // Update a customer
        Route::get('/delete-customer/{id}', 'delete')->name('delete_customer')->middleware('permission:customer_delete'); // Delete a customer
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
        Route::get('/about-us', 'aboutUs')->name('about_us');
        Route::patch('/about-us', 'AboutUpdateOrCreate')->name('about_us_update_or_create');
    });



    // Route::controller(ContactController::class)->group(function () {
    //     Route::get('/all-contact', 'allContact')->name('all_contact');
    //     Route::get('/delete-contact/{id}', 'deleteContact')->name('delete_contact');
    //     Route::get('/view-contact/{id}', 'viewContact')->name('view_contact');
    //     Route::get('/edit-contact-page', 'editContactPage')->name('edit_contact_page');
    //     Route::patch('/update-contact-page', 'updateContactPageInfo')->name('update_contact_page_info');
    // });


    // contact manage route start here
    Route::controller(ContactController::class)->group(function () {
        Route::get('/all-contact', 'allContact')->name('all_contact');
        Route::get('/delete-contact/{id}', 'deleteContact')->name('delete_contact');
        Route::get('/view-contact/{id}', 'viewContact')->name('view_contact');
        Route::get('/edit-contact-page', 'editContactPage')->name('edit_contact_page');
        Route::patch('/update-contact-page', 'updateContactPageInfo')->name('update_contact_page_info');
    });


    // offer route start here
    // Route::controller(OfferController::class)->group(function () {
    //     Route::get('/all-offer', 'index')->name('all_offer');
    //     Route::get('/add-offer', 'add')->name('add_offer');
    //     Route::post('/store-offer', 'store')->name('store_offer');
    //     Route::get('/edit-offer/{id}', 'edit')->name('edit_offer');
    //     Route::patch('/update-offer/{id}', 'update')->name('update_offer');
    //     Route::get('/delete-offer/{id}', 'delete')->name('delete_offer');
    // });



    // offer manage route start here
    Route::controller(OfferController::class)->group(function () {
        Route::get('/all-offer', 'index')->name('all_offer')->middleware('permission:offer_read'); // List all offers
        Route::get('/add-offer', 'add')->name('add_offer')->middleware('permission:offer_create'); // Show add offer form
        Route::post('/store-offer', 'store')->name('store_offer')->middleware('permission:offer_create'); // Store a new offer
        Route::get('/edit-offer/{id}', 'edit')->name('edit_offer')->middleware('permission:offer_edit'); // Show edit offer form
        Route::patch('/update-offer/{id}', 'update')->name('update_offer')->middleware('permission:offer_edit'); // Update an offer
        Route::get('/delete-offer/{id}', 'delete')->name('delete_offer')->middleware('permission:offer_delete'); // Delete an offer
    });



    Route::controller(SubscriberUserController::class)->group(function () {
        Route::get('/all-subscriber-user', 'getAllSubscriberUser')->name('get_all_subscriber_user')->middleware('permission:subscriber_user_read');
        Route::get('/delete-subscriber-user/{id}', 'deleteSubscriberUser')->name('delete_subscriber_user')->middleware('permission:subscriber_user_delete');
    });




    //permission route start here
    Route::controller(PermissionController::class)->group(function () {
        Route::get('/all-permission', 'getAllPermission')->name('get_all_permission');
        Route::get('/edit-permission/{id}', 'editPermission')->name('edit_permission');
        Route::get('/delete-permission/{id}', 'deletePermission')->name('delete_permission');
    });


    // role route start here
    Route::controller(RoleController::class)->group(function () {
        Route::get('/all-role', 'getAllRole')->name('get_all_role');
        Route::post('/store-role', 'storeRole')->name('store_role'); 
        Route::get('/edit-role/{id}', 'editRole')->name('edit_role'); 
        Route::patch('/update-role/{id}', 'updateRole')->name('update_role'); 
        Route::get('/delete-role/{id}', 'deleteRole')->name('delete_role');
        Route::patch('/update-role-and-permission/{id}', 'updateRoleAndPermission')->name('update_role_and_permission');
    });



    // role and permission setup
    Route::controller(RolePermissionController::class)->group(function () {
        Route::get('/add-role-permission', 'addRolePermission')->name('add_role_permission');
        Route::get('/add-user-and-role', 'addUserAndRole')->name('add_user_and_role');
        Route::post('/create-user-for-role', 'createUserForRole')->name('create_user_for_role');
        Route::post('/assing-role-to-user', 'assingRoleToUser')->name('assing_role_to_user');
        Route::post('/assing-permission-to-role', 'assingPermissionToRole')->name('assign_permission_to_role');
    });



});
