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

Route::get('login', array('before'=>'sentry', 'uses'=>'AuthController@login', 'as'=>'login'));
Route::post('login', array('before'=>'sentry', 'uses'=>'AuthController@authenticate'));
Route::get('logout', array('before'=>'sentry', 'uses'=>'AuthController@logout', 'as'=>'logout'));

Route::get('registration', array('uses'=>'RegistrationController@index', 'as'=>'registration'));
Route::post('registration', array('uses'=>'RegistrationController@register'));

Route::resource('user', 'UserController');
Route::get('group/{id}/permission', array('uses'=>'GroupController@permission', 'as'=>'group.permission'));
Route::post('group/{id}/permission', array('uses'=>'GroupController@permission', 'as'=>'group.updatePermission'));
Route::resource('group', 'GroupController');
Route::resource('resource', 'ResourceController');

Route::get('denied', array('before'=>'sentry', 'uses'=>'ErrorController@denied', 'as'=>'denied'));
Route::get('notfound', array('before'=>'sentry','uses'=>'ErrorController@notfound', 'as'=>'notfound'));
