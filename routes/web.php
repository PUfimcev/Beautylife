<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Person\UserController;
use App\Http\Controllers\Person\PersonController;
use App\Http\Controllers\Admin\CallbackController;
use App\Http\Controllers\Basket\BasketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

// Roure for setting of locale

Route::get('/locales/{locale?}', [MainController::class, 'setLocale'])->name('set_locale');

// redirection to login form

Route::get('/to-login', [AdminController::class, 'getToLogin'])->name('to_login');

// Route if No-admin user tries to get an access to admin panel

Route::middleware(['auth'])->group(function(){

    Route::get('/no-admin', [AdminController::class, 'allusionNoAdmin'])->name('no_admin');
});

// Authorized user's routes

Route::group(['namespace' => 'App\Http\Controllers\Person', 'prefix' => 'personal', 'as' => 'person.'], function(){

    Route::controller(UserController::class)->group(function() {

        // Route for resetting User's account
        Route::get('/', 'index')->name('user_account');

        // Routes for resetting User's name
        Route::get('/edit-name/{user}','editName')->name('reset_username');
        Route::put('/edit-name/{user}','updateName')->name('update_username');

        // Routes for resetting User's email
        Route::get('/edit-email','formForCheckPassword')->name('get_check_form_email');
        Route::post('/edit-emal','formForEditEmail')->name('reset_email_form');
        Route::put('/update-email/{user}','updateEmail')->name('update_email');

        // Routes for resetting User's password
        Route::get('/edit-password','formForCheckPassword')->name('get_check_form_password');
        Route::post('/edit-password/check-password','checkPassword')->name('check_password');
        Route::get('/edit-password/reset','showResetForm')->name('reset_password_form');
    });

    Route::controller(PersonController::class)->group(function(){
        // Routes for getting User's bookmarks
        Route::get('/bookmarks', 'getBookmarks')->name('bookmarks');

        // Routes for getting User's order history
        Route::get('/order-history', 'getOrderHistory')->name('order_history');


    });

});

// Admin routes

Route::group(['middleware' =>'is_admin', 'prefix' => 'admin', 'as' => 'admin.'], function(){

    Route::get('/', [AdminController::class, 'index'])->name('index');
});

// Main routes

Route::controller(MainController::class)->group(function() {
    Route::get('/', 'main')->name('index');
    Route::get('/about-us', 'about')->name('about');
    Route::get('/offers', 'offers')->name('offers');
    Route::get('/catalog', 'catalog')->name('catalog');
    Route::get('/brands', 'brands')->name('brands');
    Route::get('/conditions', 'conditions')->name('conditions');
    Route::get('/blogs', 'blogs')->name('blogs');
    Route::post('/searching', 'getResultSearching')->name('header_search');
    Route::post('/timezone', 'getTimezone')->name('get_timezone');
});


// Route for button in Header 'Reqest a call'

Route::resource('/admin/callbacks', CallbackController::class);

// Basker routes

Route::group(['namespace' => 'App\Http\Controllers\Basket', 'prefix' => 'basket', ], function(){

    Route::controller(BasketController::class)->group(function(){

        Route::get('/', 'getBasket')->name('basket');
        Route::get('/basket-empty', 'basketIsEmpty')->name('basket_empty');
    });

    // Route::group(['middleware' => 'basket_is_not_empty'], function(){

    // });


});




