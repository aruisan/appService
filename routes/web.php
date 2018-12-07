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

Route::get('/', function () {
    return view('welcome');
});


Route::get('login/{social}', 'Auth\LoginController@redirectToProvider')->where('social', 'google|facebook');

Route::get('login/{social}/callback', 'Auth\LoginController@handleProviderCallback')->where('social', 'google|facebook');

Route::get('auth/{social}/callback', 'Auth\LoginController@handleProviderCallback')->where('social', 'google|facebook');

