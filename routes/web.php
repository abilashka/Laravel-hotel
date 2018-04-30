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

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/usercp', 'PanelController@index');

Route::get('/usercp/report', 'PanelController@getreport');
Route::post('/editbooking/{booking}', 'PanelController@upbooking');
Route::post('/usercp', 'PanelController@cclbooking');
Route::get('/usercp/admin', 'PanelController@adminpanel');
Route::post('/usercp/admin/cancel', 'PanelController@cclbooking');
Route::post('/usercp/admin/clear', 'PanelController@clrbooking');
Route::post('/usercp/admin/delete', 'PanelController@dlbooking');

Route::get('/usercp/profile', 'PanelController@userprofile');
Route::post('/usercp/profile', 'PanelController@updateprofile');

Route::get('/editbooking/{booking}', 'PanelController@editbook');


Route::get('/rooms', 'RoomsController@index');
Route::get('/rooms/{room}', 'RoomsController@show');
Route::post('/rooms', 'RoomsController@createbking');

Route::post('/contact', 'PanelController@contact');

Route::post('usercp/search', 'PanelController@search');


Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


$s = 'social.';
Route::get('/social/redirect/{provider}',   ['as' => $s . 'redirect',   'uses' => 'Auth\SocialController@getSocialRedirect']);
Route::get('/social/handle/{provider}',     ['as' => $s . 'handle',     'uses' => 'Auth\SocialController@getSocialHandle']);
