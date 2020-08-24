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
    Route::post('/create-request', 'API\RequestController@create');
    Route::post('/create-listing', 'API\ListingController@store');
    Route::get('/auth-user', 'API\UserController@getAuthUser');
});


Route::post('/register', 'API\AuthController@register')->name('auth.register');
Route::post('/login', 'API\AuthController@login')->name('category.login');

Route::post('/login-passport', 'API\AuthController@loginP')->name('category.login');

Route::get('/all-property', 'API\PropertyController@getAll');

Route::get('/email-verification', 'API\AuthController@verify')->name('verification.verify');

Route::get('/all-request', 'API\RequestController@getAll');


Route::get('/all-listing', 'API\ListingController@index');

Route::get('/all-listing-by-location', 'API\ListingController@listingByLocation');
