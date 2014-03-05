<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('before'=>'sentry', 'uses'=>'HomeController@index', 'as'=>'home.index'));

Route::get('login', array('uses'=>'AuthController@login', 'as'=>'login'));
Route::post('login', 'AuthController@authenticate');
Route::get('logout', array('uses'=>'AuthController@logout', 'as'=>'logout'));

Route::get('/registration', array('uses'=>'RegistrationController@index', 'as'=>'registration'));
Route::post('/registration', 'RegistrationController@register');

Route::resource('user', 'UserController');
Route::resource('group', 'GroupController');
