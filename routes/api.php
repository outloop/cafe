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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function (){
    Route::get('/user', function (Request $request){
        return $request->user();
    });

    Route::resource('cafes', 'Api\CafesController');
    Route::post('/cafes/{cafe}/like', 'Api\CafesController@like');
    Route::delete('/cafes/{cafe}/dislike', 'Api\CafesController@dislike');

    Route::resource('brew-methods', 'Api\BrewMethodsController');
});
