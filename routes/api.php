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

    Route::resource('user', 'Api\UserController');

    //Projects store
    Route::resource('project', 'Api\ProjectController');

    //Project step store
    Route::post('project/{project}/step', 'Api\StepController@store');

    //Get project steps
    Route::get('project/{project}/step', 'Api\StepController@index');

    //Update project step
    Route::post('step/{step}', 'Api\StepController@update');

    //Delete project step
    Route::delete('step/{step}', 'Api\StepController@destroy');

    Route::resource('rosette', 'Api\RosetteController');

    Route::resource('role', 'Api\RoleController');

    Route::resource('permission', 'Api\PermissionController');

    //Sorucevap, random soru al
    Route::get('question/get', 'Api\QuestionController@getQuestion');

    //Soru
    Route::resource('question', 'Api\QuestionController');

    //Sorucevap, soru cevapla
    Route::post('answer', 'Api\QuestionController@giveAnswer');

});


Route::post('image', function (Request $request) {


    if ($request->hasFile('image')) {
        $image = new \App\Models\Image([
            'image' => $request->file('image'),
        ]);
        $image->save();
    }
    return response()->success('common.success');
});
