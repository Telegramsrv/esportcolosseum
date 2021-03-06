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
	
	//  ----------------------------------------------------------  Blog routes  Start ----------------------------------------------------------------//
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
	//  ----------------------------------------------------------  Blog routes  End ----------------------------------------------------------------//
	
	//  ----------------------------------------------------------  Blog routes  Start ----------------------------------------------------------------//
	Route::get('/blog', 'Admin\BlogController@index')->name('admin.blog.list');
	Route::get('/blog/add', 'Admin\BlogController@add')->name('admin.blog.add');
	Route::post('/blog/add', 'Admin\BlogController@save')->name('admin.blog.save');
	Route::get('/blog/edit/{blogId}', 'Admin\BlogController@edit')->name('admin.blog.edit');
	Route::put('/blog/edit/{blogId}', 'Admin\BlogController@update')->name('admin.blog.update');
	Route::get('/blog/delete/{blogId}', 'Admin\BlogController@delete')->name('admin.blog.delete');
	//  ----------------------------------------------------------  Blog routes  End ----------------------------------------------------------------//
	
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
	
	//  ---------------------------------------------------------- Ticket routes  Start ----------------------------------------------------------------//
	Route::get('/tickets', 'Admin\TicketController@index')->name('admin.ticket.list');
	Route::get('/ticket/view/{ticketId}', 'Admin\TicketController@view')->name('admin.ticket.view');
	Route::post('/ticket/view/{ticketId}', 'Admin\TicketController@update')->name('admin.ticket.update');
	Route::get('/ticket/conversation/{ticketId}', 'Admin\TicketController@conversation')->name('admin.ticket.conversation');
	Route::post('/ticket/conversation/{ticketId}', 'Admin\TicketController@conversationUpdate')->name('admin.ticket.conversation.update');
	//  ----------------------------------------------------------  Ticket routes  End ----------------------------------------------------------------//
	
	//  ----------------------------------------------------------  Page routes Start ----------------------------------------------------------------//
	Route::get('/page', 'Admin\PageController@index')->name('admin.page.list');
	Route::get('/page/add', 'Admin\PageController@add')->name('admin.page.add');
	Route::post('/page/add', 'Admin\PageController@save')->name('admin.page.save');
	Route::get('/page/edit/{pageId}', 'Admin\PageController@edit')->name('admin.page.edit');
	Route::post('/page/edit/{pageId}', 'Admin\PageController@update')->name('admin.page.update');
	Route::get('/page/delete/{pageId}', 'Admin\PageController@delete')->name('admin.page.delete');
	//  ----------------------------------------------------------  Page routes End ----------------------------------------------------------------//
	
	//  ----------------------------------------------------------  Match routes Start ----------------------------------------------------------------//
	Route::get('/match', 'Admin\MatchController@index')->name('admin.match.list');
	Route::get('/match/edit/{matchId}', 'Admin\MatchController@edit')->name('admin.match.edit');
	Route::post('/match/edit/{matchId}', 'Admin\MatchController@update')->name('admin.match.update');
	Route::get('/match/chat', 'Admin\MatchController@chat')->name('admin.match.chat');
	//  ----------------------------------------------------------  Match routes End ----------------------------------------------------------------//
	
	//  ---------------------------------------------------------- Settings routes  Start ----------------------------------------------------------------//
	Route::get('/settings', 'Admin\SettingController@view')->name('admin.setting.view');
	Route::post('/setting/edit/', 'Admin\SettingController@update')->name('admin.setting.update');
	//  ----------------------------------------------------------  Settings routes  End ----------------------------------------------------------------//
	
	//  ---------------------------------------------------------- Withdraw Fund routes  Start ----------------------------------------------------------------//
	Route::get('/withdraw-fund', 'Admin\WithdrawFundController@index')->name('admin.withdraw-fund.list');
	Route::get('/withdraw-fund/view/{requestId}', 'Admin\WithdrawFundController@view')->name('admin.withdraw-fund.view');
	Route::post('/withdraw-fund/view/{requestId}', 'Admin\WithdrawFundController@update')->name('admin.withdraw-fund.update');
	Route::get('/withdraw-fund/bank-details/{requestId}', 'Admin\WithdrawFundController@bankDetails')->name('admin.withdraw-fund.bank-details');
	//  ----------------------------------------------------------  Withdraw Fund routes  End ----------------------------------------------------------------//
});

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'role:user']], function() {
	Route::get('/', 'User\DashboardController@index')->name('user.home');
	Route::get('/dashboard/{gameSlug?}', 'User\DashboardController@index')->name('user.dashboard')->defaults('gameSlug', env('DEFAULT_GAME_SLUG'));

	Route::get('/challenge/open/{gameSlug}', 'User\ChallengeController@listOpenChallenges')->name('user.open-challenge.list');
	Route::post('/challenge/save/{gameSlug}', 'User\ChallengeController@saveOpenChallenge')->name('user.open-challenge.save');
	Route::get('/challenge/esc/{gameSlug}', 'User\ChallengeController@listEscChallenges')->name('user.esc-challenge.list');
	Route::get('/my-challenge/{gameSlug}/{challengeType}', 'User\ChallengeController@myChallengelist')->name('user.my-challenge.list');
	Route::post('/challenge/change-status', 'User\ChallengeController@changeStatus')->name('user.challenge.change-status');
	Route::post('/challenge/accept', 'User\ChallengeController@acceptChallenge')->name('user.challenge.accept');
	Route::post('/challenge/esc/save/{gameSlug}', 'User\ChallengeController@saveEscChallenge')->name('user.esc-challenge.save');
	Route::post('/challenge/esc/{gameSlug}', 'User\ChallengeController@listEscChallenges')->name('user.esc-challenge.list');
	Route::get('/challenge/{challengeId}/{gameSlug}', 'User\ChallengeController@viewChallenge')->name('user.challenge.view'); 

	Route::get('/profile/edit', 'User\UserController@editProfile')->name('user.profile.edit');
	Route::put('/profile/edit', 'User\UserController@updateProfile')->name('user.profile.update');
	Route::get('/profile/change-password', 'User\UserController@editPassword')->name('user.change-password.edit');
	Route::put('/profile/change-password', 'User\UserController@updatePassword')->name('user.change-password.update');
	Route::get('/profile/{md5UserId}/{gameSlug?}', 'User\UserController@showProfile')->name('user.profile')->defaults('gameSlug', env('DEFAULT_GAME_SLUG'));

	Route::get('/team/get-autocomplete-team-list', 'User\TeamController@getAutocompleteTeamList');
	Route::post('/team/save', 'User\TeamController@save')->name('user.team.save');
	Route::get('/team/get-team-players/{md5TeamId}', 'User\TeamController@getTeamPlayers');
	Route::get('/team/get-autocomplete-player-list/{md5TeamId}', 'User\TeamController@getAutocompletePlayerList');
	Route::post('/team/add-player-in-team', 'User\TeamController@savePlayerInTeam')->name('user.add-player-in-team.save');
	Route::delete('/team/remove-player', 'User\TeamController@removePlayer')->name('user.remove-player.remove');
	Route::get('/team/accept', 'User\TeamController@acceptTeamRequest')->name('user.team.accept');
	Route::get('/team/reject', 'User\TeamController@rejectTeamRequest')->name('user.team.reject');

	Route::get('/ticket/index', 'User\TicketController@index')->name('user.ticket.list');
	Route::get('/ticket/add', 'User\TicketController@add')->name('user.ticket.add');
	Route::post('/ticket/add', 'User\TicketController@save')->name('user.ticket.save');
	Route::get('/ticket/{md5TicketId}', 'User\TicketController@viewTicket')->name('user.ticket.view');
	Route::put('/ticket/update/{md5TicketId}', 'User\TicketController@updateTicket')->name('user.ticket.update');
	
	Route::post('/coins/update', 'User\UserController@updateCoins')->name('user.coins.update');
	Route::get('/coins/calculation', 'User\UserController@coinCalculation')->name('user.coins.calculation');
	
	Route::post('/friend/add', 'User\UserController@addFriend')->name('user.friend.add');
	Route::get('/friend/accept', 'User\UserController@acceptFriend')->name('user.friend.accept');
	Route::get('/friend/reject', 'User\UserController@rejectFriend')->name('user.friend.reject');
	Route::get('/my-friends', 'User\UserController@myFriends')->name('user.friends');
	Route::get('/member/fetch-auto-complete-list', 'User\UserController@fetchAutocompleteList')->name('user.member.fetch-auto-complete-list');
	
	Route::post('/withdraw-fund/update', 'User\UserController@updateWithdrawFund')->name('user.withdraw-fund.update');
	Route::get('/withdraw-fund/calculation', 'User\UserController@withdrawFundCalculation')->name('user.coins.withdraw-fund-calculation');

	Route::get('/notification/remove', 'User\UserController@removeNotifications')->name('user.notification.remove');

});

Auth::routes();

Route::get('/home/{gameSlug?}', 'User\HomeController@index')->name("user.home")->defaults('gameSlug', env('DEFAULT_GAME_SLUG'));
Route::post('/forgot-password', 'User\HomeController@forgotPassword')->name("forgot-password");
Route::get('logout', 'Auth\LoginController@logout')->name("logout");

//Blog Pages
Route::get('/blog/index', 'User\BlogController@index')->name("blog-listing");
Route::get('/blog/{blogSlug}', 'User\BlogController@detail')->name("blog-detail");

//Static Pages
Route::get('/page/{pageSlug}', 'User\PageController@index')->name("static-page");

// Crons
Route::get('/cron/make-challenge-expire', 'User\ChallengeController@makeChallengeExpire')->name('cron.challenge.make-expire');