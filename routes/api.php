<?php

use Illuminate\Http\Request;

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

Route::post('/v1/bookmark', 'MainBookmarkController@store');
Route::get('/v1/bookmark', 'MainBookmarkController@index');
Route::post('/v1/register', 'Auth\RegisterController@register')->name('register');
Route::post('/v1/login', 'Auth\LoginController@login')->name('login');
Route::post('/v1/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/v1/userinfo', function() {
    return Auth::user();
})->name('userinfo');