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
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Basket\BasketController;
use App\Http\Controllers\Person\PersonController;
use App\Http\Controllers\Admin\AgerangeController;
use App\Http\Controllers\Admin\CallbackController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ConsumerController;
use App\Http\Controllers\Admin\SkinTypeController;
use App\Http\Controllers\Person\BookmarkController;
use App\Http\Controllers\Mail\MessageMailController;
use App\Http\Controllers\Admin\SubcategoryController;
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
        // Route::get('bookmarks', 'getBookmarks')->name('bookmarks');

        // Routes for getting User's order history
        Route::get('order-history', 'getOrderHistory')->name('order_history');

    });


    Route::controller(BookmarkController::class)->group(function(){
        // Routes for getting User's bookmarks
        Route::get('bookmarks', 'getBookmarks')->name('bookmarks');

        // Routes for adding User's bookmarks
        Route::post('bookmarks/{product}/add', 'addBookmarks')->name('bookmarks_add');


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

    // Route for processing archive categories
    Route::controller(CategoryController::class)->group(function(){

        Route::group(['prefix' => 'categories'], function(){
            Route::get('archive', 'archiveIndex')->name('category_archive')->withTrashed();;
            Route::get('archive/{category}', 'showArchive')->name('category_show')->withTrashed();
            Route::get('archive/{category}/restore', 'restoreArchive')->name('category_restore')->withTrashed();
            Route::delete('archive/{category}/delete', 'destroyArchive')->name('category_full_delete')->withTrashed();
        });

    });

    // Route for processing categories
    Route::resource('categories', CategoryController::class);

    // Route for processing archive subcategories
    Route::controller(SubcategoryController::class)->group(function(){

        Route::group(['prefix' => 'categories/{category}/subcategories'], function(){
            Route::get('archive', 'archiveIndex')->name('subcategory_archive')->withTrashed();;
            Route::get('archive/{subcategory}', 'showArchive')->name('subcategory_show')->withTrashed();
            Route::get('archive/{subcategory}/restore', 'restoreArchive')->name('subcategory_restore')->withTrashed();
            Route::delete('archive/{subcategory}/delete', 'destroyArchive')->name('subcategory_full_delete')->withTrashed();
        });

    })->scopeBindings();

    // Route for processing subcategories
    Route::resource('categories/{category}/subcategories', SubcategoryController::class);

    // Route for processing archive products
    Route::controller(ProductController::class)->group(function(){
        Route::group(['prefix' => 'products'], function(){
            Route::get('archive', 'archiveIndex')->name('products_archive')->withTrashed();;
            Route::get('archive/{product}', 'showArchive')->name('product_show')->withTrashed();
            Route::get('archive/{product}/restore', 'restoreArchive')->name('product_restore')->withTrashed();
            Route::delete('archive/{product}/delete', 'destroyArchive')->name('product_full_delete')->withTrashed();
        });
    });

    // Route for processing products
    Route::resource('products', ProductController::class);
    Route::post('products/{product}', [ProductController::class,'destroyPictures'])->name('product_pictures');
    Route::get('products/category/{category?}/create', [ProductController::class,'create'])->name('products_create');


    // Route for processing archive subcategory skin type
    Route::controller(SkinTypeController::class)->group(function(){
        Route::group(['prefix' => 'skintypes'], function(){
            Route::get('archive', 'archiveIndex')->name('skintype_archive')->withTrashed();;
            Route::get('archive/{skintype}', 'showArchive')->name('skintype_show')->withTrashed();
            Route::get('archive/{skintype}/restore', 'restoreArchive')->name('skintype_restore')->withTrashed();
            Route::delete('archive/{skintype}/delete', 'destroyArchive')->name('skintype_full_delete')->withTrashed();
        });
    });

    // Route for processing subcategory skin type
    Route::resource('skintypes', SkinTypeController::class);

    // Route for processing archive subcategory Age range
    Route::controller(AgerangeController::class)->group(function(){
        Route::group(['prefix' => 'ageranges'], function(){
            Route::get('archive', 'archiveIndex')->name('agerange_archive')->withTrashed();;
            Route::get('archive/{agerange}', 'showArchive')->name('agerange_show')->withTrashed();
            Route::get('archive/{agerange}/restore', 'restoreArchive')->name('agerange_restore')->withTrashed();
            Route::delete('archive/{agerange}/delete', 'destroyArchive')->name('agerange_full_delete')->withTrashed();
        });
    });

    // Route for processing subcategory Age range
    Route::resource('ageranges', AgerangeController::class);

    // Route for processing archive subcategory Consumer
    Route::controller(ConsumerController::class)->group(function(){
        Route::group(['prefix' => 'consumers'], function(){
            Route::get('archive', 'archiveIndex')->name('consumer_archive')->withTrashed();;
            Route::get('archive/{consumer}', 'showArchive')->name('consumer_show')->withTrashed();
            Route::get('archive/{consumer}/restore', 'restoreArchive')->name('consumer_restore')->withTrashed();
            Route::delete('archive/{consumer}/delete', 'destroyArchive')->name('consumer_full_delete')->withTrashed();
        });
    });

    // Route for processing subcategory Consumer
    Route::resource('consumers', ConsumerController::class);


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

});

// Main routes

Route::controller(MainController::class)->group(function() {
    Route::get('/', 'main')->name('index');
    Route::get('about-us', 'about')->name('about');
    Route::get('offers/{offer?}', 'offers')->name('offers')->withTrashed();
    Route::get('{category}/{subcategory}/{product}', 'getProduct')->name('product');
    Route::get('catalog/{category?}', 'catalog')->name('catalog');
    Route::get('catalogs/{quality}', 'catalogTopNew')->name('catalog_top_new');
    Route::get('brands/{brand?}', 'brands')->name('brands');
    Route::get('conditions', 'conditions')->name('conditions');
    Route::get('blogs/{blog:slug?}', 'blogs')->name('blogs');
    Route::post('/searching', 'getResultSearching')->name('header_search');
    Route::post('timezone', 'getTimezone')->name('get_timezone');
    Route::get('reviews/{review:reviewer_name?}', 'getAllReviews')->name('get_all_reviews');
    Route::post('screen-width', 'getScreenWidth')->name('get_screen_width');
});


// Route for creating reviews
Route::get('reviews-create', [ReviewController::class, 'create'])->name('reviews.create');

// Route for button in Header 'Request a call'
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

        // Routes for adding products to basket
        Route::post('add/{product:slug}', 'addProductToBasket')->name('basket_add');
    });

    // Route::group(['middleware' => 'basket_is_not_empty'], function(){

    // });


});




