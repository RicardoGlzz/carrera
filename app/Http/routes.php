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

Route::get('registro',[
	'uses' 	=> 'RegistroController@index',
	'as'	=> 'registro'
]);

Route::get('lista',[
	'uses' 	=> 'RegistroController@lista',
	'as'	=> 'lista'
]);

Route::post('registro',[
	'uses' => 'RegistroController@store'
]);