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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'Web\AppController@getApp')->name('home');
});

Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', 'Web\AuthenticationController@getLogin')->name('login');
    Route::get('/auth/{social}', 'Web\AuthenticationController@getSocialRedirect')->name('doLogin');
    Route::get('/auth/{social}/callback', 'Web\AuthenticationController@getSocialCallback');
});

Route::get('/test', function (){
    $gaode = new \App\Utilities\Maps\Gaode();
    $res = $gaode->geocode('越秀区珠江宾馆', '广州市','广东省');
    var_dump($res);
});
