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
});

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'role:user']], function() {
	Route::get('/dashboard', 'User\DashboardController@index')->name('user.dashboard');
});



// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', 'HomeController@index');
