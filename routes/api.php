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
    
    Route::post('/other-setup', 'API\AuthController@otherSetup');
    Route::post('/other-setup-signup', 'API\AuthController@otherSetupSignup');
});


Route::post('/register', 'API\AuthController@register')->name('auth.register');
Route::post('/login', 'API\AuthController@login')->name('category.login');

Route::post('/login-passport', 'API\AuthController@loginP')->name('category.login');

Route::get('/all-property', 'API\PropertyController@getAll');

Route::get('/email-verification', 'API\AuthController@verify')->name('verification.verify');

Route::get('/all-request', 'API\RequestController@getAll');


Route::get('/all-listing', 'API\ListingController@index');

Route::get('/all-listing-by-location', 'API\ListingController@listingByLocation');

Route::get('/get-list-by-slug/{slug}', 'API\ListingController@listingBySlug');


// social login

Route::get('/sign-in/{provider}', 'API\SocialAuthController@redirectToProvider');
Route::get('/sign-in/{provider}/redirect', 'API\SocialAuthController@handleProviderCallback');


// password reset

Route::post('request-password-reset','API\ForgotPasswordController@sendResetLinkEmail');
Route::post('/reset-password', 'Api\ResetPasswordController@reset')->name('api.reset-password');