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
Route::resource('version', 'VersionController', ['only' => ['index']]);

Route::post('auth/register', ['as' => 'auth.register', 'uses' => 'Api\AuthController@register']);
Route::post('auth/login', ['as' => 'auth.login', 'uses' => 'Api\AuthController@login']);
Route::post('auth/forget', ['as' => 'auth.forgot', 'uses' => 'Api\AuthController@forgot']);
Route::post('auth/social/{provider}', ['as' => 'auth.social', 'uses' => 'Api\AuthController@social']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('test', function (Request $request) {
        return response()->message('common.success');
    });
});