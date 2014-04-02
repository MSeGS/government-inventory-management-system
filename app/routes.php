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
Route::post('login', array('uses'=>'AuthController@authenticate', 'as'=>'login.submit'));
Route::get('logout', array('before'=>'sentry', 'uses'=>'AuthController@logout', 'as'=>'logout'));

Route::get('registration', array('uses'=>'RegistrationController@index', 'as'=>'registration'));
Route::post('registration', array('uses'=>'RegistrationController@register', 'as'=>'registration.submit'));

Route::resource('user', 'UserController');

Route::get('group/{id}/permission', array('before'=>'sentry', 'uses'=>'GroupController@permission', 'as'=>'group.permission'));
Route::put('group/{id}/permission', array('before'=>'sentry', 'uses'=>'GroupController@updatePermission', 'as'=>'group.updatePermission'));


Route::resource('group', 'GroupController');
Route::resource('resource', 'ResourceController');
Route::resource('store', 'StoreController');
Route::resource('product', 'ProductController');
Route::resource('category', 'CategoryController');
Route::resource('setting', 'SettingController');

Route::get('denied', array('before'=>'sentry', 'uses'=>'ErrorController@denied', 'as'=>'denied'));
Route::get('notfound', array('before'=>'sentry','uses'=>'ErrorController@notfound', 'as'=>'notfound'));

Route::resource('option', 'OptionController');

