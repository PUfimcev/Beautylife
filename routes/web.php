<?php


use App\Models\Offer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Person\UserController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Basket\BasketController;
use App\Http\Controllers\Person\PersonController;
use App\Http\Controllers\Admin\CallbackController;
use App\Http\Controllers\Mail\MessageMailController;
use App\Http\Controllers\Admin\OfferArchiveController;

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

Route::get('locales/{locale?}', [MainController::class, 'setLocale'])->name('set_locale');

// redirection to login form

Route::get('to-login', [AdminController::class, 'getToLogin'])->name('to_login');

// Route if No-admin user tries to get an access to admin panel

Route::middleware(['auth'])->group(function(){

    Route::get('no-admin', [AdminController::class, 'allusionNoAdmin'])->name('no_admin');
});

// Authorized user's routes

Route::group(['namespace' => 'App\Http\Controllers\Person', 'prefix' => 'personal', 'as' => 'person.'], function(){

    Route::controller(UserController::class)->group(function() {

        // Route for resetting User's account
        Route::get('/', 'index')->name('user_account');

        // Routes for resetting User's name
        Route::get('edit-name/{user}','editName')->name('reset_username');
        Route::put('edit-name/{user}','updateName')->name('update_username');

        // Routes for resetting User's email
        Route::get('edit-email','formForCheckPassword')->name('get_check_form_email');
        Route::post('edit-emal','formForEditEmail')->name('reset_email_form');
        Route::put('update-email/{user}','updateEmail')->name('update_email');

        // Routes for resetting User's password
        Route::get('edit-password','formForCheckPassword')->name('get_check_form_password');
        Route::post('edit-password/check-password','checkPassword')->name('check_password');
        Route::get('edit-password/reset','showResetForm')->name('reset_password_form');
    });

    Route::controller(PersonController::class)->group(function(){
        // Routes for getting User's bookmarks
        Route::get('bookmarks', 'getBookmarks')->name('bookmarks');

        // Routes for getting User's order history
        Route::get('order-history', 'getOrderHistory')->name('order_history');


    });

});

// Admin routes

Route::group(['middleware' =>'is_admin', 'prefix' => 'admin', 'as' => 'admin.'], function(){

    Route::controller(AdminController::class)->group(function(){
        Route::get('/', 'index')->name('index');

    });

    //  Route for creating e-mail messages
    Route::resource('messages', MessageController::class);

    // Mailing massages about any actions, ads
    Route::controller(MessageMailController::class)->group(function(){
        //Departure a message
        Route::get('messages-mailing/{message}', 'sendMessageMail')->name('mail_message');
    });

    // Route for updating and presenting reviews
    Route::resource('reviews', ReviewController::class);

    // Route for processing blogs
    Route::resource('blogs', BlogController::class);

    // Route for processing brands
    Route::resource('brands', BrandController::class);


    // Route for processing archive offers
    Route::controller(OfferController::class)->group(function(){

        Route::group(['prefix' => 'offers'], function(){

            Route::get('archive', 'archiveIndex')->name('offers_archive');

            Route::get('archive/{offer}', 'showArchive')->name('offer_show')->withTrashed();

            Route::get('archive/{offer}/restore', 'restoreArchive')->name('offers_restore')->withTrashed();

            Route::delete('archive/{offer}/delete', 'destroyArchive')->name('offers_full_delete')->withTrashed();

        });


    });

    // Route for processing offers
    Route::resource('offers', OfferController::class);



// GET|HEAD        admin/offers  admin.offers.index › Admin\OfferController@index
// POST            admin/offers  admin.offers.store › Admin\OfferController@store
// GET|HEAD        admin/offers/create  admin.offers.create › Admin\OfferController@create
// GET|HEAD        admin/offers/{offer}  admin.offers.show › Admin\OfferController@show
// PUT|PATCH       admin/offers/{offer} . admin.offers.update › Admin\OfferController@update
// DELETE          admin/offers/{offer} . admin.offers.destroy › Admin\OfferController@destroy
// GET|HEAD        admin/offers/{offer}/edit  admin.offers.edit › Admin\OfferController@edit

});

// Main routes

Route::controller(MainController::class)->group(function() {
    Route::get('/', 'main')->name('index');
    Route::get('about-us', 'about')->name('about');
    Route::get('offers', 'offers')->name('offers');
    Route::get('catalog', 'catalog')->name('catalog');
    Route::get('brands/{brand:brand_name?}', 'brands')->name('brands');
    Route::get('conditions', 'conditions')->name('conditions');
    Route::get('blogs/{blog:slug?}', 'blogs')->name('blogs');
    Route::post('searching', 'getResultSearching')->name('header_search');
    Route::post('timezone', 'getTimezone')->name('get_timezone');
    Route::get('reviews/{review:reviewer_name?}', 'getAllReviews')->name('get_all_reviews');
    Route::post('screen-width', 'getScreenWidth')->name('get_screen_width');
});


// Route for creating reviews
Route::get('reviews-create', [ReviewController::class, 'create'])->name('reviews.create');

// Route for button in Header 'Reqest a call'
Route::resource('admin/callbacks', CallbackController::class);

//  Route for subscription for Site in footer
Route::resource('/subscriptions', SubscriptionController::class);

//  Route for unsubscription from Site in footer
Route::get('/unsubscription/{subscription}', [SubscriptionController::class, 'getUnsubscribeForm'])->name('unsubscribe');



// Basket routes

Route::group(['namespace' => 'App\Http\Controllers\Basket', 'prefix' => 'basket', ], function(){

    Route::controller(BasketController::class)->group(function(){

        Route::get('/', 'getBasket')->name('basket');
        Route::get('/basket-empty', 'basketIsEmpty')->name('basket_empty');
    });

    // Route::group(['middleware' => 'basket_is_not_empty'], function(){

    // });


});




