<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/', function () {
	
	if(Entrust::hasRole('admin')){
		return redirect()->route('admin.dashboard');
	}
	else if(Entrust::hasRole('user')){
		return redirect()->route('user.dashboard');
	}
	else{
		return redirect("/home");
	}
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function() {
	Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
	Route::get('/user', 'Admin\UserController@index')->name('admin.user.list');
	Route::get('/user/add', 'Admin\UserController@add')->name('admin.user.add');
	Route::post('/user/add', 'Admin\UserController@save')->name('admin.user.save');
	Route::get('/user/edit/{userId}', 'Admin\UserController@edit')->name('admin.user.edit');
	Route::post('/user/edit/{userId}', 'Admin\UserController@update')->name('admin.user.update');
	Route::get('/user/delete/{userId}', 'Admin\UserController@delete')->name('admin.user.delete');
});

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'role:user']], function() {
	Route::get('/', 'User\DashboardController@index')->name('user.home');
	Route::get('/dashboard', 'User\DashboardController@index')->name('user.dashboard');
});

Auth::routes();

Route::get('/home', 'User\HomeController@index')->name("user.home");
Route::get('/verify-user-account/{verificationCode}', 'User\HomeController@verifyUserAccount')->name("user.verify-user-account");

Route::get('logout', 'Auth\LoginController@logout')->name("logout");
