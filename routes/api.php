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

//Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function()
//{
Route::namespace("Api")->group(function () {

    Route::post('doBooking', 'BookingController@booking')->name('doBooking');
    Route::get('checkAvailability', 'BookingController@checkAvailability')->name('checkAvailability');
    Route::get('checkRoomInDateroom/{room}/{date}', 'BookingController@checkRoomInDate')->name('checkRoomInDate');

    // return all home page
    Route::get('home', 'HomeController@home')->name('home');

    // become a vendor
    Route::get('user/create', 'UsersController@create')->name('user.create');
    Route::post('user/store', 'UsersController@store')->name('user.store');
    Route::get('user/edit/{id}', 'UsersController@edit')->name('user.edit');
    Route::post('user/update/{id}', 'UsersController@update')->name('user.update');
    Route::post('user/login', 'UsersController@login')->name('user.login');
    //get user history booking
    Route::get('user/booking-history/{id}', 'UsersController@historyBooking')->name('user.historyBooking');
    //get special tours
    Route::get('tours/special', 'SiteController@SpecialTours')->name('tours.special');

//});
});
