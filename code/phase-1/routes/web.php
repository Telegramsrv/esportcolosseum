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
	Route::get('/user/edit', 'Admin\UserController@edit')->name('admin.user.edit');
});

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'role:user']], function() {
	Route::get('/', 'User\DashboardController@index')->name('user.home');
	Route::get('/dashboard', 'User\DashboardController@index')->name('user.dashboard');
});

Auth::routes();

Route::get('/home', 'User\HomeController@index')->name("user.home");

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name("logout");
