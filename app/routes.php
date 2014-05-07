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
Route::get('retrieve-username', array('uses'=>'RetrievalController@retrieveUsername', 'as'=>'retrieve-username'));
Route::post('retrieve-username', array('uses'=>'RetrievalController@sendUsername'));
Route::get('reset-password', array('uses'=>'RetrievalController@resetPassword', 'as'=>'reset-password'));
Route::post('reset-password', array('uses'=>'RetrievalController@sendResetCode'));
Route::get('new-password/{code}', array('uses'=>'RetrievalController@newPassword', 'as'=>'new-password'));
Route::post('new-password', array('uses'=>'RetrievalController@setNewPassword'));

Route::resource('user', 'UserController');
Route::get('profile', array('before'=>'sentry', 'uses'=>'UserController@profile', 'as'=>'user.profile'));
Route::put('profile', array('before'=>'sentry', 'uses'=>'UserController@profileUpdate', 'as'=>'user.profileUpdate'));

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

Route::put('message/{id}/read', array('before'=>'sentry', 'uses'=>'MessageController@read', 'as'=>'message.read'));
Route::put('message', array('before'=>'sentry', 'uses'=>'MessageController@show', 'as'=>'message.show'));
Route::get('message/outbox', array('before'=>'sentry', 'uses'=>'MessageController@outbox', 'as'=>'message.outbox'));

Route::get('indent/mine', array('before'=>'sentry', 'uses'=>'IndentController@mine', 'as'=>'indent.mine'));
Route::get('indent/{id}/process', array('before'=>'sentry', 'uses'=>'IndentController@process', 'as'=>'indent.process'));
Route::post('indent/{id}/process', array('before'=>'sentry', 'uses'=>'IndentController@postProcess', 'as'=>'indent.postProcess'));
Route::get('indent/{id}/dispatch', array('before'=>'sentry', 'uses'=>'IndentController@dispatch', 'as'=>'indent.dispatch'));
Route::post('indent/{id}/dispatch', array('before'=>'sentry', 'uses'=>'IndentController@postDispatch', 'as'=>'indent.postDispatch'));
Route::get('contact-us', array('uses'=>'ContactController@create', 'as'=>'contact-us'));

Route::resource('group', 'GroupController');
Route::resource('contact', 'ContactController');
Route::resource('resource', 'ResourceController');
Route::resource('store', 'StoreController');
Route::resource('product', 'ProductController');
Route::resource('category', 'CategoryController');
Route::resource('setting', 'SettingController');
Route::resource('stock', 'StockController');
Route::resource('department','DepartmentController');
Route::resource('damage','DamageController');
Route::resource('message','MessageController');
Route::resource('indent','IndentController');

Route::get('denied', array('uses'=>'ErrorController@denied', 'as'=>'denied'));
Route::get('notfound', array('uses'=>'ErrorController@notfound', 'as'=>'notfound'));

Route::resource('option', 'OptionController');

Route::get('set-theme/{theme}',function($theme){
	$theme = Cookie::forever('theme',$theme);
	return Response::json(array('status' => 'success'))->withCookie($theme);
});

Route::get('report/product', array('before'=>'sentry', 'uses'=>'ReportController@product', 'as'=>'report.product'));
Route::get('report/user', array('before'=>'sentry', 'uses'=>'ReportController@user', 'as'=>'report.user'));
Route::get('report/overview', array('before'=>'sentry', 'uses'=>'ReportController@overview', 'as'=>'report.overview'));
Route::get('report/super', array('before'=>'sentry', 'uses'=>'ReportController@super', 'as'=>'report.super'));

Route::get('ajax-super/{type}/{option?}',array('before'=>'sentry', 'uses'=>'HomeController@ajaxSuper','as'=>'home.ajax-super'));
Route::get('ajax-admin/{type}/{option?}',array('before'=>'sentry', 'uses'=>'HomeController@ajaxAdmin','as'=>'home.ajax-admin'));
