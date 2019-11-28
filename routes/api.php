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

/** 認証 */
Route::post('/v1/register', 'Auth\RegisterController@register');
Route::post('/v1/login', 'Auth\LoginController@login');
Route::post('/v1/logout', 'Auth\LoginController@logout');
Route::get('/v1/userinfo', function() {
    return Auth::user();
});

/** 写真 */
Route::get('/v1/photos', 'PhotoController@index');
Route::post('/v1/upload/photos', 'PhotoController@store');

/** しおり */
Route::post('/v1/compose/guides', 'GuideController@store');
Route::get('/v1/guides', 'GuideController@index');
Route::get('/v1/edit/guides/{guideId}', 'GuideController@edit');
Route::post('/v1/edit/guides/{guide}', 'GuideController@update');