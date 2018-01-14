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

Route::get('/', function () {
    return view('home');
});

Route::get('/gallery', function () {
    return view('gallery');
});

Route::get('/usercp', 'PanelController@index');
Route::post('//editbooking/{booking}', 'PanelController@upbooking');
Route::post('/usercp', 'PanelController@cclbooking');
Route::get('/editbooking/{booking}', 'PanelController@editbook');

Route::get('/rooms', 'RoomsController@index');
Route::get('/rooms/{room}', 'RoomsController@show');


Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');