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



	Route::post('login', 'Auth\LoginController@login');
	Route::post('register', 'Auth\RegisterController@register');

	Route::get('login/{social}', 'Auth\LoginController@redirectToProvider')->where('social', 'google|facebook');

	Route::get('auth/{social}/callback', 'Auth\LoginController@handleProviderCallback')->where('social', 'google|facebook');

	Route::middleware('jwt.auth')->group(function(){
	    Route::get('logout', 'Auth\LoginController@logout');
	    Route::post('refresh', 'Auth\LoginController@refresh');

	    Route::resource('demo', 'Admin\ActividadController');
		Route::get('melocation', 'UserController@meLocation');
		Route::post('confirmarTelefono', 'PhoneController@postConfirmPhone');
		Route::post('enviarTelefono', 'PhoneController@requestSms');
	});

