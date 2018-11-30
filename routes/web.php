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

Route::get('/', 'Home\HomeController@index')->name('home');
Route::get('/kamers', 'Home\RoomController@index')->name('rooms');
Route::post('/kamers/filter', 'Home\RoomController@filter')->name('filterRooms');
Route::post('/kamers/search', 'Home\RoomController@search')->name('searchRooms');
Route::get('/kamers/{id}', 'Home\RoomController@individual')->name('rooms.individual');
