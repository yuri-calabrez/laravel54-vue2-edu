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

Route::group(['as' => 'api.', 'namespace' => 'Api\\'], function () {
    Route::post('/access_token', 'AuthController@accessToken');
    Route::group(['middleware' => 'auth.renew'], function () {

        Route::group([
            'prefix' => 'teacher',
            'as' => 'teacher.',
            'namespace' => 'Teacher\\',
            'middleware' => 'can:teacher'
        ], function () {
            Route::resource('class_informations', 'ClassInformationsController', ['only' => ['index', 'show']]);
        });

        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('/logout', 'AuthController@logout');
    });

});