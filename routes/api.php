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
Auth::routes();

Route::resource('version', 'VersionController', ['only' => ['index']]);

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('register', ['as' => 'auth.register', 'uses' => 'Api\AuthController@register']);
    Route::post('login', ['as' => 'auth.login', 'uses' => 'Api\AuthController@login']);
    Route::post('forget', ['as' => 'auth.forgot', 'uses' => 'Api\AuthController@forgot']);
    Route::post('social/{provider}', ['as' => 'auth.social', 'uses' => 'Api\AuthController@social']);
    Route::middleware('auth:api')->get('logout', ['as' => 'auth.logout', 'uses' => 'Api\AuthController@logout']);

});

Route::group(['middleware' => 'auth:api'], function ($router) {

    Route::get('user', function (Request $request) {
        return $request->user();
    });

    //Projects store
    Route::resource('project', 'Api\ProjectController');

    //Project step store
    Route::resource('step', 'Api\StepController');

    //Sorucevap, random soru al
    Route::get('question/get', 'Api\QuestionController@getQuestion');
    //Soru
    Route::resource('question', 'Api\QuestionController');

    //Sorucevap, soru cevapla
    Route::post('answer', 'Api\QuestionController@giveAnswer');

});