<?php

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

Route::get('/kamers', 'Home\RoomController@index')->name('rooms');
Route::post('/kamers/filter', 'Home\RoomController@filter')->name('filterRooms');
Route::post('/kamers/search', 'Home\RoomController@search')->name('searchRooms');
Route::get('/kamers/{id}', 'Home\RoomController@individual')->name('rooms.individual');

Route::get('/contact', 'Home\ContactController@index')->name('contact');

Route::get('/home', 'Home\HomeController@index')->name('home');
Route::get('/', 'Home\HomeController@index')->name('home');

Route::get('/logout', 'Home\LogoutController@logout')->name('logout');

Route::group(['middleware' => 'App\Http\Middleware\UserMiddleware'], function()
{
	Route::get('/bookings', 'Home\BookingController@index')->name('bookings');	
	Route::post('/bookings/add', 'Home\BookingController@addBooking')->name('bookings.add');	
	
	Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
	{
		Route::get('/admin', 'Home\AdminController@index')->name('admin');
	});
});

Auth::routes();

