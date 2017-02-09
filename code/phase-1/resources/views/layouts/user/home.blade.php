<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	    <!-- CSRF Token -->
	    <meta name="csrf-token" content="{{ csrf_token() }}">
	
	    <title>{{ config('app.name', 'Laravel') }}</title>
	
	    <!-- Styles -->
	    <link rel="stylesheet" href="{!! asset('user/css/jquery-ui.css') !!}">
	    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  		<link href="{!! asset('user/css/materialize.css') !!}" type="text/css" rel="stylesheet" media="screen,projection" />
  		<link href="{!! asset('user/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet" />
  		<link href="{!! asset('user/css/style.css') !!}" type="text/css" rel="stylesheet" media="screen,projection" />
  		<link href="{!! asset('user/css/esportcolosseum.css') !!}" type="text/css" rel="stylesheet" />
	
	    <!-- Scripts -->
	    <script>
	        window.Laravel = <?php echo json_encode([
	            'csrfToken' => csrf_token(),
	        ]); ?>
	    </script>
	</head>
	<body>
		<nav class="nav-bar nav-bar-transparent" role="navigation">
    		<div class="nav-wrapper">
        		<a id="logo-container" href="#" class="brand-logo">
        			<img src="{!! asset('user/images/logo.png') !!}" />
        		</a>
        		<ul class="right hide-on-med-and-down">
        		@if (Auth::check())
        			<li><a href="{!! route('logout') !!}" class="white-text modal-trigger">Logout<i class="material-icons right dp48">power_settings_new</i></a></li>
          		@else
          			<li><a href="#loginModal" class="white-text modal-trigger">Login<i class="material-icons right">perm_identity</i></a></li>
          		@endif
      			</ul>
    		</div>
  		</nav>
  		<div class="no-pad-bot banner-container valign-wrapper z-depth-1 mobile_banner" id="index-banner">
    		<div class="container sm_margin_top">
      			<h4 class="header center white-text hidden-xs">WELCOME TO</h4>
      			<h2 class="header center white-text text-shadow hidden-xs">ESPORT COLOSSEUM</h2>
      			<div class="row center hidden-xs">
        			<h5 class="header col s12 white-text text-shadow banner-tagline">A platform where you can earn with your gaming skills</h5>
      			</div>
      			<div class="section mob_margin_top">
        			<div class="row">
          				<div class="col s12 m4">
            				<div class="card-panel banner-card hoverable">
              					<div class="icon-block">
                					<h2 class="center white-text"><i class="fa fa-gamepad" aria-hidden="true"></i></h2>
                					<h5 class="center white-text">Play</h5>
                					<p class="light center white-text">Play your favourite games</p>
              					</div>
            				</div>
          				</div>
          				<div class="col s12 m4">
            				<div class="card-panel banner-card hoverable">
              					<div class="icon-block">
                					<h2 class="center white-text"><i class="material-icons">group</i></h2>
                					<h5 class="center white-text">COMPETE</h5>
                					<p class="light center white-text">Compete as Solo/Team with your friends </p>
              					</div>
            				</div>
          				</div>
          				<div class="col s12 m4">
            				<div class="card-panel banner-card hoverable">
            					<div class="icon-block">
                					<h2 class="center white-text"><i class="fa fa-usd" aria-hidden="true"></i></h2>
                					<h5 class="center white-text">EARN</h5>
                					<p class="light center white-text">Earn money and prices with your gaming skills</p>
              					</div>
            				</div>
          				</div>	
        			</div>
      			</div>
    		</div>
		</div>
		<div class="no-pad-bot main-container" style="overflow:hidden;" >
      		@include("user.partials.game", ['games' => $games, 'extraClass' => 'mobile_res'])
    		<div class="main-content mob_main_conten">
       	 		<section class="">
            		<div class="section-title ">Upcoming <span>Games</span></div>
                	<div class="match-list upcomming_games">
                    	<div class="row card-panel blue-grey lighten-5">
                        	<div class="col s12 m5 left-team">
                            	<div class="team-detail card-panel deep-orange darken-4 white-text center-align hoverable">
                                	<div class="team-name" data-gameid="1">Rajan's Team</div>
                                	<div class="player-list card-panel blue-grey lighten-5 game-players-1">
	                                    <div class="player-row">
                                        	<div class="player-image">
                                        		<img src="{!! asset('user/images/user1.png') !!}" alt="" class="circle responsive-img">
                                        	</div>
	                                        <div class="player-details">
	                                            <div class="player-detail-row player-name">Rajan Kaneria</div>
	                                            <div class="player-detail-row player-earning">Earnings: 14,250</div>
	                                        </div>
	                                        <div class="player-stats">
	                                            <div class="stat-container">
	                                                <div class="stat-value">49.6%</div>
	                                                <div class="stat-title">WINNING</div>
	                                            </div>
	                                            <div class="stat-container">
	                                                <div class="stat-value">367</div>
	                                                <div class="stat-title">MATCHES</div>
	                                            </div>
	                                        </div>
                                    	</div>
	                                    <div class="player-row">
	                                        <div class="player-image">
	                                        	<img src="{!! asset('user/images/user1.png') !!}" alt="" class="circle responsive-img">
	                                        </div>
	                                        <div class="player-details">
	                                            <div class="player-detail-row player-name">Rajan Kaneria</div>
	                                            <!--<div class="player-detail-row player-region">Region: NA</div>-->
	                                            <div class="player-detail-row player-earning">Earnings: 14,250</div>
	                                        </div>
	                                        <div class="player-stats">
	                                            <div class="stat-container">
	                                                <div class="stat-value">49.6%</div>
	                                                <div class="stat-title">WINNING</div>
	                                            </div>
	                                            <div class="stat-container">
	                                                <div class="stat-value">367</div>
	                                                <div class="stat-title">MATCHES</div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="player-row">
	                                        <div class="player-image">
	                                        	<img src="{!! asset('user/images/user1.png') !!}" alt="" class="circle responsive-img">
	                                        </div>
	                                        <div class="player-details">
	                                            <div class="player-detail-row player-name">Rajan Kaneria</div>
	                                            <!--<div class="player-detail-row player-region">Region: NA</div>-->
	                                            <div class="player-detail-row player-earning">Earnings: 14,250</div>
	                                        </div>
	                                        <div class="player-stats">
	                                            <div class="stat-container">
	                                                <div class="stat-value">49.6%</div>
	                                                <div class="stat-title">WINNING</div>
	                                            </div>
	                                            <div class="stat-container">
	                                                <div class="stat-value">367</div>
	                                                <div class="stat-title">MATCHES</div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="player-row">
	                                        <div class="player-image">
	                                        	<img src="{!! asset('user/images/user1.png') !!}" alt="" class="circle responsive-img">
	                                        </div>
	                                        <div class="player-details">
	                                            <div class="player-detail-row player-name">Rajan Kaneria</div>
	                                            <!--<div class="player-detail-row player-region">Region: NA</div>-->
	                                            <div class="player-detail-row player-earning">Earnings: 14,250</div>
	                                        </div>
	                                        <div class="player-stats">
	                                            <div class="stat-container">
	                                                <div class="stat-value">49.6%</div>
	                                                <div class="stat-title">WINNING</div>
	                                            </div>
	                                            <div class="stat-container">
	                                                <div class="stat-value">367</div>
	                                                <div class="stat-title">MATCHES</div>
	                                            </div>
	                                        </div>
	                                    </div>
                                	</div>
                            	</div>
                        	</div>
	                        <div class="col s12 m2 match-stats">
	                            <div class="match-detail center-align match-type">Team Match | Captian's Pick</div>
	                            <div class="match-detail center-align match-coins">100 Coins</div>
	                            <div class="match-detail center-align match-date-time"><span class="match-time">11:25PM</span><span class="match-date">29th October, 2016</span></div>
	                        </div>
                        	<div class="col s12 m5 right-team">
                            	<div class="team-detail card-panel blue-grey darken-3 white-text center-align hoverable">
                              		<div class="team-name"  data-gameid="1">Team Kavit</div>
                              		<div class="player-list card-panel blue-grey lighten-5 game-players-1" >
	                                    <div class="player-row">
	                                        <div class="player-image">
	                                        	<img src="{!! asset('user/images/user1.png') !!}" alt="" class="circle responsive-img">
	                                        </div>
	                                        <div class="player-details">
	                                            <div class="player-detail-row player-name">Rajan Kaneria</div>
	                                            <!--<div class="player-detail-row player-region">Region: NA</div>-->
	                                            <div class="player-detail-row player-earning">Earnings: 14,250</div>
	                                        </div>
	                                        <div class="player-stats">
	                                            <div class="stat-container">
	                                                <div class="stat-value">49.6%</div>
	                                                <div class="stat-title">WINNING</div>
	                                            </div>
	                                            <div class="stat-container">
	                                                <div class="stat-value">367</div>
	                                                <div class="stat-title">MATCHES</div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="player-row">
	                                        <div class="player-image">
	                                        	<img src="{!! asset('user/images/user1.png') !!}" alt="" class="circle responsive-img">
	                                        </div>
	                                        <div class="player-details">
	                                            <div class="player-detail-row player-name">Rajan Kaneria</div>
	                                            <!--<div class="player-detail-row player-region">Region: NA</div>-->
	                                            <div class="player-detail-row player-earning">Earnings: 14,250</div>
	                                        </div>
	                                        <div class="player-stats">
	                                            <div class="stat-container">
	                                                <div class="stat-value">49.6%</div>
	                                                <div class="stat-title">WINNING</div>
	                                            </div>
	                                            <div class="stat-container">
	                                                <div class="stat-value">367</div>
	                                                <div class="stat-title">MATCHES</div>
	                                            </div>
	                                        </div>
                                    	</div>
	                                    <div class="player-row">
	                                        <div class="player-image">
	                                        	<img src="{!! asset('user/images/user1.png') !!}" alt="" class="circle responsive-img">
	                                        </div>
	                                        <div class="player-details">
	                                            <div class="player-detail-row player-name">Rajan Kaneria</div>
	                                            <!--<div class="player-detail-row player-region">Region: NA</div>-->
	                                            <div class="player-detail-row player-earning">Earnings: 14,250</div>
	                                        </div>
	                                        <div class="player-stats">
	                                            <div class="stat-container">
	                                                <div class="stat-value">49.6%</div>
	                                                <div class="stat-title">WINNING</div>
	                                            </div>
	                                            <div class="stat-container">
	                                                <div class="stat-value">367</div>
	                                                <div class="stat-title">MATCHES</div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                    <div class="player-row">
	                                        <div class="player-image">
	                                        	<img src="{!! asset('user/images/user1.png') !!}" alt="" class="circle responsive-img">
	                                        </div>
	                                        <div class="player-details">
	                                            <div class="player-detail-row player-name">Rajan Kaneria</div>
	                                            <!--<div class="player-detail-row player-region">Region: NA</div>-->
	                                            <div class="player-detail-row player-earning">Earnings: 14,250</div>
	                                        </div>
	                                        <div class="player-stats">
	                                            <div class="stat-container">
	                                                <div class="stat-value">49.6%</div>
	                                                <div class="stat-title">WINNING</div>
	                                            </div>
	                                            <div class="stat-container">
	                                                <div class="stat-value">367</div>
	                                                <div class="stat-title">MATCHES</div>
	                                            </div>
	                                        </div>
	                                    </div>
                              		</div>
                            	</div>
                        	</div>
                   		</div>
                	</div>
            		<hr/>
        		</section>
        		@yield("blog-section")
    		</div>
		</div>
		@include('layouts.user.partials.footer')
  		@include('layouts.user.partials.login')
  		@include('layouts.user.partials.register')
  		@include('layouts.user.partials.forgot-password')
  		
    	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="{!! asset('user/js/materialize.js') !!}"></script>
		<script type="text/javascript" src="{!! asset('user/js/init.js') !!}"></script>
		<script type="text/javascript" src="{!! asset('user/js/index.js') !!}"></script>
		<script type="text/javascript" src="{!! asset('user/js/esportcolosseum.js') !!}"></script>
	</body>
</html>