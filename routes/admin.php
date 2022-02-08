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

// Route::get('/', function () {
//     return view('auth.login');
// });

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::group(['namespace' => 'Admin'], function(){
Route::get('dashboard', 'DashboardController@index')->name('home');

Route::resource('/hotel','HotelController');
// Route::post('product','productController@search')->name('filter.name');
 Route::post('addorder','OrdersController@store')->name('order.store');

Route::resource('/user','UsersController');
Route::get('/yourcodes','UsersController@userCode')->name('yourcodes');
Route::get('/userAddRole','UsersController@addRole');
Route::put('/userEditRole','UsersController@editUserRole')->name('user.role.edit');

Route::get('/codeGenerator','productController@codeGenerator');
Route::get('/allproducts', 'productController@allproducts')->name('Allproducts');

Route::resource('/order','OrdersController');
});

// payment

Route::post('fawryPayment','paymentController@generate')->name('payment');
Route::get('Callback','paymentController@callback');