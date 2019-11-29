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

/** 認証 */
Route::post('/v1/register', 'Auth\RegisterController@register');
Route::post('/v1/login', 'Auth\LoginController@login');
Route::post('/v1/logout', 'Auth\LoginController@logout');
Route::get('/v1/userinfo', function() {
    return Auth::user();
});

/** 写真 */
Route::get('/v1/photos/{photos}', 'PhotoController@show');
Route::post('/v1/upload/photos', 'PhotoController@store');

/** しおり */
Route::post('/v1/compose/guides', 'GuideController@store');
Route::get('/v1/guides', 'GuideController@index');
Route::get('/v1/edit/guides/{guide}', 'GuideController@edit');
Route::put('/v1/guides/{guide}/edit', 'GuideController@update');
Route::delete('/v1/guides/{guide}', 'GuideController@destroy');