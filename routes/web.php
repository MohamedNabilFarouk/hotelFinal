<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function()
{
Route::group(['prefix'=>'dashboard','namespace' => 'Admin','middleware' => ['role:admin|moderator|vendor','auth']], function(){
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::resource('/hotel','HotelController');
    Route::resource('/room','RoomController');
    Route::resource('/space','SpaceController');
    Route::resource('/tour','TourController');
    Route::resource('/currency','CurrencyController');
    Route::resource('/attribute','AttributeController');
    Route::resource('/bookings','BookingController');
  Route::resource('/governorate','govController');

    Route::resource('/user','UsersController');
    Route::get('/user/zerobalance/{vendor_id}','UsersController@zerobalance')->name('user.zerobalance');
    Route::get('/user/Role/{role}','UsersController@getUserByRole')->name('user.byrole');

    Route::resource('/permissions','PermissionController');

//   vendor report
// Route::get('vendor/Dashboard', 'VendorController@report')->name('vendor.report');



});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
});
//
Route::resource('/product','productController');
// Route::post('product','productController@search')->name('filter.name');
Route::post('addorder','OrdersController@store')->name('order.store');

// Route::resource('/user','UsersController');
Route::get('/yourcodes','UsersController@userCode')->name('yourcodes');
Route::get('/userAddRole','UsersController@addRole');
Route::put('/userEditRole','UsersController@editUserRole')->name('user.role.edit');
Route::put('/RoomEditPrice\{id}','Admin\RoomController@editPrice')->name('room.updatePrice');

Route::get('/codeGenerator','productController@codeGenerator');
Route::get('/allproducts', 'productController@allproducts')->name('Allproducts');

Route::resource('/order','OrdersController');

// payment

Route::post('fawryPayment','paymentController@generate')->name('payment');
Route::get('Callback','paymentController@callback');
//


Route::any('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
