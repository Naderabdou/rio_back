<?php

use Illuminate\Support\Facades\Route;

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

// Localization Routes
Route::get('language/{locale}', function ($locale) {

    app()->setLocale($locale);

    session()->put('locale', $locale);

    return redirect()->back();
})->name('language');

Route::middleware('localization')->group(function () {

    Route::prefix('admin')->namespace('Dashboard')->name('admin.')->group(function () {

        // ------------------- Auth Routes -------------------//
        Route::get('login', 'AuthController@showLoginForm')->name('login');
        Route::post('login', 'AuthController@login')->name('login.post');
        Route::get('logout', 'AuthController@logout')->name('logout');
        Route::get('reset-password', 'AuthController@reset')->name('reset');
        Route::post('send-link', 'AuthController@sendLink')->name('sendLink');
        Route::get('changePassword/{code}', 'AuthController@changePassword')->name('changePassword');
        Route::post('update-password', 'AuthController@updatePassword')->name('updatePassword');
        //------------------- End Auth Routes -------------------//

        Route::middleware(['auth','role:admin'])->group(function () {
            //------------------- Dashboard Routes -------------------//
            Route::get('/', 'DashboardController@home')->name('home');
            Route::get('/test', function () {
                return view('welcome');
            });
            //------------------- End Dashboard Routes -------------------//



            //------------------- Settings Routes -------------------//
            Route::resource('settings', 'SettingController');
            //------------------- End Settings Routes -------------------//



            //------------------- Contacts Routes -------------------//
            Route::get('contacts', 'ContactController@index')->name('contacts.index');
            Route::get('contacts/{id}', 'ContactController@show')->name('contacts.show');
            Route::get('contacts/{id}/reply', 'ContactController@showReplyForm')->name('contacts.reply');
            Route::post('contacts/send-reply', 'ContactController@sendReply')->name('contacts.sendReply');
            Route::delete('contacts/{id}', 'ContactController@deleteMsg')->name('contacts.deleteMsg');
            //------------------- End Contacts Routes -------------------//




            // ------------------- Admin Profile Routes -------------------//
            Route::get('profile', 'ProfileController@getProfile')->name('profile');
            Route::post('update-profile', 'ProfileController@updateProfile')->name('update_profile');
            Route::post('update-password', 'ProfileController@updatePassword')->name('update_profile_password');
            //------------------- End Admin Profile Routes -------------------//


            // ------------------- Features Routes -------------------//
            Route::resource('features', 'FeatureController');
            //------------------- End Features Routes -------------------//

            //-------------------- Categories Routes -------------------//
            Route::resource('categories', 'CategoryController');
            //-------------------- End Categories Routes -------------------//








            //------------------- Our Values Routes -------------------//
            Route::resource('ourValues', 'OurValueController');
            //------------------- End Our Values Routes -------------------//

            //------------------- brands Routes -------------------//
            Route::resource('brands', 'BrandController');
            //------------------- End  brands Routes -------------------//


            //------------------- brands Routes -------------------//
            Route::resource('banners', 'BannerController');
            //------------------- End  brands Routes -------------------//

            //------------------- coupons Routes -------------------//
            Route::resource('coupons', 'CouponController');
            Route::get('coupon/change/status', 'CouponController@changeStatus')->name('coupon.status');
            //------------------- End  coupons Routes -------------------//


            //------------------- payments Routes -------------------//
            Route::resource('payments', 'PaymentController');
            Route::get('payment/change/status', 'PaymentController@changeStatus')->name('payment.status');

            //------------------- End  payments Routes -------------------//



            //-------------------- Tools Routes -------------------//
            Route::resource('tools', 'ConnectivityToolController')->except(['create', 'store', 'destroy']);
            Route::get('tools/toggle/{id}', 'ConnectivityToolController@toggle')->name('tools.toggle');
            //-------------------- End Tools Routes -------------------//


            //-------------------- subscribe Routes -------------------//
            Route::resource('subscribe', 'SubscribeController');
            //-------------------- End subscribe Routes -------------------//


            //-------------------- Blogs  Routes -------------------//
            Route::resource('blogs', 'BlogController');
            //-------------------- Blogs Routes -------------------//

            //-------------------- Partner  Routes -------------------//
            Route::resource('partners', 'PartnerController');
            //-------------------- Partner Routes -------------------//


            //------------------- Questions Routes -------------------//
            Route::resource('questions', 'QuestionController');
            //------------------- End Questions Routes -------------------//

            //------------------- Products Routes -------------------//
            Route::resource('products', 'ProductController');
            Route::get('product/change/status', 'ProductController@changeStatus')->name('product.status');
            Route::get('product/images/create/{id}', 'ProductController@Addimages')->name('product_images.create');
            Route::post('products_images', 'ProductController@StoreImage')->name('products_images.store');
            Route::delete('products_images/delete/{id}', 'ProductController@DestroryImage')->name('products.images.delete');
            Route::post('products_images/delete', 'ProductController@DestroryImageFile')->name('products.images.file');

            //------------------- End Products Routes -------------------//



            //------------------- Orders Routes -------------------//
            Route::resource('orders', 'OrderController')->except(['create', 'store', 'edit', 'update']);
            Route::get('orders/change-status/{id}/{status}', 'OrderController@changeStatus')->name('orders.change-status');
            //------------------- End  Orders Routes -------------------//






        });
        //  =========================== Check Attrbite  =========================== //

        Route::post('check-Category-name', 'CeckController@checkCategory')->name('check.CategoryName');
        Route::post('check-brand-name', 'CeckController@checkBrand')->name('check.brand.name');
        Route::post('check-features-name', 'CeckController@checkFeaturesName')->name('check.features.name');
        Route::post('check-value-name', 'CeckController@checkValueName')->name('check.valueName');
        Route::post('check-program-name', 'CeckController@checkProgramName')->name('check.ProgramName');
        Route::post('check-path-name', 'CeckController@checkPathName')->name('check.PathName');
        Route::post('check-regulationCategories-name', 'CeckController@cregulationCategoriesName')->name('check.regulationCategoriesName');
        Route::post('check-email', 'CeckController@checkEmail')->name('check.email');
        Route::post('check-emailMembership', 'CeckController@checkEmailMembership')->name('check.emailMembership');
        Route::post('check-phoneMembership', 'CeckController@checkPhoneMembership')->name('check.phoneMembership');
        Route::post('check-IDMembership', 'CeckController@checkIDMembership')->name('check.IDMembership');
        Route::post('check-codeCoupons', 'CeckController@CodeCoupons')->name('check.codeCoupons');
        Route::post('check-paymentName', 'CeckController@paymentName')->name('check.paymentName');




        //  =========================== End Check  =========================== //
    });
});



//-------------------- site auth Routes -------------------//
Route::namespace('Site')->name('site.')->group(function () {
    Route::post('login', 'AuthController@login')->name('login')->middleware('guest');

    Route::post('register', 'AuthController@register')->name('register')->middleware('guest');
    Route::get('logout', 'AuthController@logout')->name('logout')->middleware('auth');
    Route::post('forget-password', 'AuthController@forgetPassword')->name('forgetPassword')->middleware('guest');
    Route::post('check-code', 'AuthController@checkCode')->name('checkCode')->middleware('guest');
    Route::get('resend-code/{email?}', 'AuthController@resendCode')->name('resendCode')->middleware('guest');
    Route::post('update-password', 'AuthController@updatePassword')->name('updatePassword')->middleware('guest');
});

Route::namespace('Site')->name('site.')->middleware('lang')->group(function () {

    Route::get('/', 'HomeController@index')->name('home');

    // ------------------- Products Routes -------------------//
    Route::get('products', 'ProductController@index')->name('products');
    Route::get('products/{id}', 'ProductController@show')->name('products.show');
    Route::get('products/search', 'ProductController@search')->name('products.search');
    //------------------- End Products Routes -------------------//

    //------------------- About Us Routes -------------------//
    Route::get('aboutUs', 'AboutUsController@index')->name('aboutUs');
    //------------------- End About Us Routes -------------------//

    //------------------- Contact Us Routes -------------------//
    Route::get('contactUs', 'ContactUsController@index')->name('contactUs');
    Route::post('contactUs', 'ContactUsController@store')->name('contactUs.store');
    //------------------- End Contact Us Routes -------------------//

    //-------------------- Favorite Routes -------------------//
    Route::get('favorite', 'FavoriteController@index')->name('favorite');
    Route::post('favorite', 'FavoriteController@store')->name('favorite.store');
    Route::delete('favorite/{id}', 'FavoriteController@destroy')->name('favorite.destroy');
    //-------------------- End Favorite Routes -------------------//

    Route::middleware('auth')->group(function () {
        //-------------------- Profile Routes -------------------//
        Route::get('profile', 'ProfileController@index')->name('profile');
        Route::post('profile', 'ProfileController@update')->name('profile.update');
        Route::post('profile/change-password', 'ProfileController@changePassword')->name('profile.changePassword');
        //-------------------- End Profile Routes -------------------//


        //-------------------- Address Routes -------------------//
        Route::resource('profile/address', 'AddressController')->only(['index','store','update','destroy']);
        Route::post('cities', 'AddressController@cities')->name('cities');
        //-------------------- End Address Routes -------------------//

        //-------------------- Orders Routes -------------------//
        Route::get('profile/orders', 'OrderController@index')->name('orders');
        Route::get('profile/orders/{id}', 'OrderController@show')->name('orders.show');
        Route::get('profile/filter', 'OrderController@filter')->name('orders.filter');
        //-------------------- End Orders Routes -------------------//

        //-------------------- reviews Products Routes -------------------//
        Route::post('reviews', 'ReviewController@store')->name('reviews.store');
        //-------------------- End reviews Products Routes -------------------//






        //-------------------- End Profile Routes -------------------//



    });




    Route::get('/lang/{lang}', 'HomeController@lang')->name('lang');
});


Route::fallback(function () {
    abort(404);
});
// Route::get('login', function(){
//     return redirect()->route('site.home');
// })->name('login')->middleware('guest');
