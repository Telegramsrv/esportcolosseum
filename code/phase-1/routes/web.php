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
	Route::get('/user/resetpassword/{userId}', 'Admin\UserController@resetPassword')->name('admin.user.resetpassword');
	Route::get('/user/addcoins/{userId}', 'Admin\UserController@addCoins')->name('admin.user.addcoins');
	Route::post('/user/addcoins/{userId}', 'Admin\UserController@saveCoins')->name('admin.user.savecoins');
	Route::get('/user/changepassword', 'Admin\UserController@changePassword')->name('admin.user.changepassword');
	Route::post('/user/changepassword', 'Admin\UserController@savePassword')->name('admin.user.savepassword');
	Route::get('/user/transactionhistory/{userId}', 'Admin\UserController@transactionHistory')->name('admin.user.transactionhistory');
	
	//  ----------------------------------------------------------  blog routes  Start ----------------------------------------------------------------//
	Route::get('/blog', 'Admin\BlogController@index')->name('admin.blog.list');
	Route::get('/blog/add', 'Admin\BlogController@add')->name('admin.blog.add');
	Route::post('/blog/add', 'Admin\BlogController@save')->name('admin.blog.save');
	Route::get('/blog/edit/{blogId}', 'Admin\BlogController@edit')->name('admin.blog.edit');
	Route::put('/blog/edit/{blogId}', 'Admin\BlogController@update')->name('admin.blog.update');
	Route::get('/blog/delete/{blogId}', 'Admin\BlogController@delete')->name('admin.blog.delete');
	//  ----------------------------------------------------------  blog routes  End ----------------------------------------------------------------//
	
	//  ----------------------------------------------------------  Esc Challenge Template routes  Start ----------------------------------------------------------------//
	Route::get('/esc-challenge-template', 'Admin\EscChallengeTemplateController@index')->name('admin.esc-challenge-template.list');
	Route::get('/esc-challenge-template/add', 'Admin\EscChallengeTemplateController@add')->name('admin.esc-challenge-template.add');
	Route::post('/esc-challenge-template/add', 'Admin\EscChallengeTemplateController@save')->name('admin.esc-challenge-template.save');
	Route::get('/esc-challenge-template/edit/{challengeId}', 'Admin\EscChallengeTemplateController@edit')->name('admin.esc-challenge-template.edit');
	Route::put('/esc-challenge-template/edit/{challengeId}', 'Admin\EscChallengeTemplateController@update')->name('admin.esc-challenge-template.update');
	Route::get('/esc-challenge-template/delete/{challengeId}', 'Admin\EscChallengeTemplateController@delete')->name('admin.esc-challenge-template.delete');
	//  ----------------------------------------------------------  Esc Challenge Template routes  End ----------------------------------------------------------------//
	
	//  ----------------------------------------------------------  Game routes Start ----------------------------------------------------------------//
	Route::get('/game', 'Admin\GameController@index')->name('admin.game.list');
	Route::get('/game/add', 'Admin\GameController@add')->name('admin.game.add');
	Route::post('/game/add', 'Admin\GameController@save')->name('admin.game.save');
	Route::get('/game/edit/{gameId}', 'Admin\GameController@edit')->name('admin.game.edit');
	Route::put('/game/edit/{gameId}', 'Admin\GameController@update')->name('admin.game.update');
	Route::get('/game/delete/{gameId}', 'Admin\GameController@delete')->name('admin.game.delete');
	//  ----------------------------------------------------------  Game routes End ----------------------------------------------------------------//
});

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'role:user']], function() {
	Route::get('/', 'User\DashboardController@index')->name('user.home');
	Route::get('/dashboard/{gameSlug?}', 'User\DashboardController@index')->name('user.dashboard');
});

Auth::routes();

Route::get('/home/{gameSlug?}', 'User\HomeController@index')->name("user.home");
Route::post('/forgot-password', 'User\HomeController@forgotPassword')->name("forgot-password");
Route::get('logout', 'Auth\LoginController@logout')->name("logout");

//Blog Pages
Route::get('/blog', 'User\BlogController@index')->name("blog-listing");
Route::get('/blog/{blogSlug}', 'User\BlogController@detail')->name("blog-detail");
