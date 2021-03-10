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
//     return view('welcome');
// });
Route::get('/', 'App\Http\Controllers\AuthController@index');
Route::post('/admin/login', [ 'as' => 'login', 'uses' => 'App\Http\Controllers\AuthController@login']);
Route::get('/admin/logout', 'App\Http\Controllers\AuthController@logout');

Route::group(['prefix' => 'admin', 'middleware' => ['CheckSession']], function(){
	
	Route::get('/profile', 'App\Http\Controllers\Users\UserController@profileDetail');
	Route::post('/profile/change-password', 'App\Http\Controllers\Users\UserController@changePassword');
	Route::group(['middleware' => ['CheckPermission']], function(){
		Route::get('/user', 'App\Http\Controllers\Users\UserController@index');
		Route::get('/user/edit/{id}', 'App\Http\Controllers\Users\UserController@show');
		Route::get('/user/edit/{id}', 'App\Http\Controllers\Users\UserController@show');
		Route::get('/user/add', 'App\Http\Controllers\Users\UserController@add');
		Route::post('/user/create', 'App\Http\Controllers\Users\UserController@store');
		Route::post('/user/update/{id}', 'App\Http\Controllers\Users\UserController@update');
		Route::get('/user/delete/{id}', 'App\Http\Controllers\Users\UserController@destroy');

		Route::get('/manage-parking', 'App\Http\Controllers\Parking\ParkingController@index');
        Route::post('/manage-parking/check-in', 'App\Http\Controllers\Parking\ParkingController@checkIn');
        Route::post('/manage-parking/check-out', 'App\Http\Controllers\Parking\ParkingController@checkout');
        Route::get('/manage-parking/receipt', 'App\Http\Controllers\Parking\ParkingController@receipt');


        Route::get('/report-parking', 'App\Http\Controllers\Parking\ParkingController@report');
        Route::post('/report-parking/filter', 'App\Http\Controllers\Parking\ParkingController@report');
    });

});
