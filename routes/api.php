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

	Route::post('moviApiLogin', 'Auth\LoginController@loginProvider');

	Route::middleware('jwt.auth')->group(function(){
	    Route::get('logout', 'Auth\LoginController@logout');
	    Route::post('refresh', 'Auth\LoginController@refresh');

	    Route::resource('demo', 'Admin\ActividadController');
			Route::get('melocation', 'UserController@meLocation');
			Route::post('confirmarTelefono', 'PhoneController@postConfirmPhone');
			Route::post('enviarTelefono', 'PhoneController@requestSms');

			Route::post('infoBancaria','UserController@infoBancaria');
			Route::get('getInfoBancaria/{id}','UserController@getInfoBancaria');
			Route::get('getBancos','UserController@getBancos');
			Route::get('getCredenciales/{id}','Tecnico\TecnicoDocumentController@credenciales');

			Route::post('uploadCredential', 'Tecnico\TecnicoDocumentController@store');

			Route::post('setUserRol', 'UserController@setRol');
			Route::get('getUser', 'UserController@getUser');

			Route::delete('credentialDelete/{id}', 'Tecnico\TecnicoDocumentController@destroy');

			Route::post('pay-payu', 'PayuController@payPayu');

			Route::post('pay-payu', 'PayuController@payPayuMount');

			// Route::get('payu/response' , 'PayuController@response');

			Route::get('getSaldo/{id}','UserController@getSaldo');
			Route::post('retirarSaldo','UserController@retirarSaldo');

			Route::post('publish-emergency','EmergencyController@publishEmergency');
			Route::get('getMyEmergencys/{id}','EmergencyController@myEmergencys');
			Route::get('getEmergencys','EmergencyController@emergencys');

			Route::get('asignarEspecialista/{id}/{emergency}','EmergencyController@asignarEspecialista');


			Route::post('horario','HorarioController@store');
			Route::delete('horario/{id}', 'HorarioController@destroy');
			Route::get('getHorarios/{id}','HorarioController@myHorarios');
	});

