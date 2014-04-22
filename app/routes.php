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

Route::post('/lang', function()
{
    $lang = Cookie::forever('lang', Input::get('language'));
    return Redirect::to(Input::get('redirect_to', '/'))->withCookie($lang);
});


Route::get('registration', array('uses'=>'RegistrationController@index', 'as'=>'registration'));
Route::post('registration', array('uses'=>'RegistrationController@register', 'as'=>'registration.submit'));

Route::resource('user', 'UserController');

Route::get('group/{id}/permission', array('before'=>'sentry', 'uses'=>'GroupController@permission', 'as'=>'group.permission'));
Route::put('group/{id}/permission', array('before'=>'sentry', 'uses'=>'GroupController@updatePermission', 'as'=>'group.updatePermission'));

Route::get('damage/trash', array('before'=>'sentry', 'uses'=>'DamageController@trash', 'as'=>'damage.trash'));
Route::get('damage/manage', array('before'=>'sentry', 'uses'=>'DamageController@manage', 'as'=>'damage.manage'));
Route::post('damage/{id}/approve', array('before'=>'sentry', 'uses'=>'DamageController@approve', 'as'=>'damage.approve'));
Route::post('damage/{id}/decline', array('before'=>'sentry', 'uses'=>'DamageController@decline', 'as'=>'damage.decline'));

Route::get('damage/trash', array('before'=>'sentry', 'uses'=>'DamageController@trash', 'as'=>'damage.trash'));
Route::put('damage/{id}/restore', array('before'=>'sentry', 'uses'=>'DamageController@restore', 'as'=>'damage.restore'));
Route::put('damage/{id}/delete', array('before'=>'sentry', 'uses'=>'DamageController@delete', 'as'=>'damage.delete'));

Route::put('product/{id}/trash', array('before'=>'sentry', 'uses'=>'ProductController@restore', 'as'=>'product.restore'));
Route::post('product/{id}', array('before'=>'sentry', 'uses'=>'ProductController@delete', 'as'=>'product.delete'));
Route::get('product/trash', array('before'=>'sentry', 'uses'=>'ProductController@trash', 'as'=>'product.trash'));

Route::resource('group', 'GroupController');
Route::resource('resource', 'ResourceController');
Route::resource('store', 'StoreController');
Route::resource('product', 'ProductController');
Route::resource('category', 'CategoryController');
Route::resource('setting', 'SettingController');
Route::resource('stock', 'StockController');
Route::resource('department','DepartmentController');
Route::resource('damage','DamageController');

Route::get('denied', array('before'=>'sentry', 'uses'=>'ErrorController@denied', 'as'=>'denied'));
Route::get('notfound', array('before'=>'sentry','uses'=>'ErrorController@notfound', 'as'=>'notfound'));

Route::resource('option', 'OptionController');

