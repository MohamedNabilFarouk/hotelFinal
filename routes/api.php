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
    Route::post('OpayCallback','BookingController@Opaycallback');

    Route::post('doBooking', 'BookingController@booking')->name('doBooking');
    Route::get('checkAvailability', 'BookingController@checkAvailability')->name('checkAvailability');
    Route::get('checkRoomInDateroom/{room}/{date}', 'BookingController@checkRoomInDate')->name('checkRoomInDate'); //not used

    // return all home page
    Route::get('home', 'HomeController@home')->name('home');
    Route::get('sittings', 'HomeController@sittings')->name('sittings');

    // return all hotels
    Route::get('hotels', 'HotelsController@hotels')->name('hotels');
    Route::post('hotel', 'HotelsController@singleHotel')->name('hotel');
    Route::get('searchHotel', 'HotelsController@searchHotel')->name('search.hotel');
    Route::get('filterHotels', 'HotelsController@filterHotels')->name('filter.hotel');
    Route::post('hotelRoomsMinMaxPrice', 'HotelsController@hotelRoomsMinMaxPrice')->name('roomsMinMaxPrice.hotel');

    // return all tours
    Route::get('tours', 'ToursController@tours')->name('tours');
    Route::post('tour', 'ToursController@singleTour')->name('tour');
    Route::get('searchTour', 'ToursController@searchTour')->name('search.tour');
    Route::get('filterTours', 'ToursController@filterTours')->name('filter.hotel');

    //get special tours
    Route::get('tours/special', 'SiteController@SpecialTours')->name('tours.special');

    // become a vendor
    Route::get('user/create', 'UsersController@create')->name('user.create');
    Route::post('user/store', 'UsersController@store')->name('user.store');
    Route::get('user/edit/{id}', 'UsersController@edit')->name('user.edit');
    Route::post('user/update/{id}', 'UsersController@update')->name('user.update');
    Route::post('user/login', 'UsersController@login')->name('user.login');
    //get user history booking
    Route::get('user/booking-history/{id}', 'UsersController@historyBooking')->name('user.historyBooking');

    //get all Cities
    Route::get('cities', 'CitiesController@cities')->name('cities');

//get all currency and lang

Route::get('langcurrency', 'SiteController@lang_currency');


//});
});
