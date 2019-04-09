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

