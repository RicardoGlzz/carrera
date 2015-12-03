<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('',[
	'uses' 	=> 'ApplicationController@index',
]);

Route::get('',[
	'uses' 	=> 'ApplicationController@index',
	'as'	=> 'home'
]);

Route::post('virtual',[
	'uses' 	=> 'RegistroController@virtual',
	'as'	=> 'virtual'
]);

Route::get('casa',[
	'uses' 	=> 'ApplicationController@casa',
	'as'	=> 'casa'
]);

Route::get('registro',[
	'uses' 	=> 'RegistroController@index',
	'as'	=> 'registro'
]);

Route::get('registromaster',[
	'uses' 	=> 'RegistroController@indexmaster',
	'as'	=> 'registromaster'
]);

/*
Route::get('lista',[
	'uses' 	=> 'RegistroController@lista',
	'as'	=> 'lista'
]);
*/

Route::post('registro',[
	'uses' => 'RegistroController@store'
]);

Route::post('registromaster',[
	'uses' => 'RegistroController@storeMaster'
]);

Route::post('registroSeguir',[
	'uses' => 'RegistroController@storeSeguir'
]);

Route::post('registroSeguirMaster',[
	'uses' => 'RegistroController@storeSeguirMaster'
]);

Route::post('registroBoleto',[
	'uses' => 'RegistroController@storeBoleto'
]);

Route::post('checkFolio',[
	'uses' => 'RegistroController@checkFolio'
]);

Route::post('checkMaster',[
	'uses' => 'RegistroController@checkMaster'
]);

Route::get('corredores',[
	'uses' 	=> 'RegistroController@corredores',
	'as'	=> 'home'
]);