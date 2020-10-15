<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/create-property', 'API\PropertyController@create');
    Route::post('/send-request', 'API\RequestController@create');
    Route::post('/create-listing', 'API\ListingController@store');
    Route::delete('/delete-listing/{id}', 'API\ListingController@destroy');
    Route::get('/auth-user', 'API\UserController@getAuthUser');
    Route::patch('/update-user', 'API\UserController@updateUser');
    Route::patch('/update-listing', 'API\ListingController@updateList');
 
    Route::post('/upload-file', 'API\UserController@uploadFile');
    Route::post('/upload-v-file', 'API\UserController@uploadVFile');
 
 
    Route::post('/listing-file-upload', 'API\ListingController@uploadFiles');
    
    Route::get('/all-request-limit-by-location','API\RequestController@requestLimit');
    Route::get('/all-request-by-location','API\RequestController@requestByLocation');
    
    
    Route::get('/all-listing-by-location', 'API\ListingController@listingByLocation');

    Route::post('/other-setup', 'API\AuthController@otherSetup');
    Route::post('/other-setup-signup', 'API\AuthController@otherSetupSignup');


    Route::post('/verify-id','API\AuthController@idVerify');


    Route::post('/create-chat','API\UserController@createChat');

    Route::post('/send-chat','API\UserController@sendChat');
    
    Route::get('/get-chats','API\UserController@getChat');

    Route::post('/change-pass','API\UserController@changePass');


    Route::get('/verify-payment','API\UserController@verifyPayment');


    Route::get('/get-chats-msg','API\UserController@getChatMessages');
    
    Route::get('/check-chat','API\UserController@checkChat');
    
    Route::get('/mark-chat','API\UserController@markChat');

    Route::post('/send-otp','API\UserController@otpSend');

    Route::post('/verify-otp','API\UserController@verifyOTP');

});

Route::get('/get-user-by-id','API\UserController@getUserById');

Route::post('/create-views','API\ListingController@createView');

Route::get('/search-request','API\RequestController@searchReq');

Route::get('/search-listing', 'API\ListingController@searchList');

Route::get('/filter-range', 'API\ListingController@filterRange');

Route::get('/filter-request-range', 'API\RequestController@filterRange');




Route::get('/all-listing-by-tag', 'API\ListingController@listingByTag');
Route::get('/all-listing-by-location-filter', 'API\ListingController@listingByFLocation');
Route::get('/all-request-by-location-filter', 'API\RequestController@requestByFilterLocation');


Route::post('/register', 'API\AuthController@register')->name('auth.register');
Route::post('/login', 'API\AuthController@login')->name('category.login');

Route::post('/login-passport', 'API\AuthController@loginP')->name('category.login');

Route::get('/all-property', 'API\PropertyController@getAll');

Route::get('/email-verification', 'API\AuthController@verify')->name('verification.verify');

Route::get('/all-request', 'API\RequestController@getAll');


Route::get('/all-listing', 'API\ListingController@index');

Route::get('/all-listing-for-guest', 'API\ListingController@guestList');


Route::get('/get-list-by-id/{id}', 'API\ListingController@listingById');
Route::get('/get-request-by-id/{id}', 'API\RequestController@requestById');



Route::get('/listing-tags', 'API\TagController@index');

// request requests
Route::get('/all-request-limit-guest','API\RequestController@requestLimitGuest');
Route::get('/all-request-guest','API\RequestController@requestGuest');



// social login

Route::get('/sign-in/{provider}', 'API\SocialAuthController@redirectToProvider');
Route::get('/sign-in/{provider}/redirect', 'API\SocialAuthController@handleProviderCallback');


// password reset

Route::post('request-password-reset','API\ForgotPasswordController@sendResetLinkEmail');
Route::post('/reset-password', 'Api\ResetPasswordController@reset')->name('api.reset-password');


