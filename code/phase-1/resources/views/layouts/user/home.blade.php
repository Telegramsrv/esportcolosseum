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
	    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  		<link href="{!! asset('user/css/materialize.css') !!}" type="text/css" rel="stylesheet" media="screen,projection" />
  		<link href="{!! asset('user/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet" />
  		<link href="{!! asset('user/css/style.css') !!}" type="text/css" rel="stylesheet" media="screen,projection" />
	
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
          			<li><a href="#loginModal" class="white-text modal-trigger">Login<i class="material-icons right">perm_identity</i></a></li>
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
		    <div class="left-side-nav mobile_res">
		      	<div class="btn_area">
		          	<div class="card-panel hoverable nav-bar-card deep-orange darken-4">
		            	<div class="sidebar-title text-shadow">GAMES</div>
		          	</div>
		      	</div>
      			<div class="side-nav-row active-game">
        			<div class="image-container">
          				<img src="{!! asset('user/images/dota-game.png') !!}" />
          				<div class="image-overlay"></div>
        			</div>
      			</div>
      			<div class="side-nav-row">
        			<div class="image-container">
        				<img src="{!! asset('user/images/league-game.png') !!}" />
          				<div class="image-overlay"></div>
        			</div>
      			</div>
		      	<div class="side-nav-row">
        			<div class="image-container">
        				<img src="{!! asset('user/images/cs-game.png') !!}" />
          				<div class="image-overlay"></div>
        			</div>
      			</div>
		    </div>
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
        		<section>
          			<div class="section-title">Latest <span>Blogs</span></div>
            		<div class="row">
		                <div class="col s12 m3">
		                    <div class="card hoverable">
		                      <div class="card-image waves-effect waves-block waves-light">
		                        <img src="{!! asset('user/images/user1.png') !!}" alt="" class="circle responsive-img">
		                      </div>
		                      <div class="card-content blue-grey darken-4">
		                        <span class="card-title activator white-text text-darken-4">Blog Title<i class="material-icons right">more_vert</i></span>
		                      </div>
		                      <div class="card-reveal blue-grey darken-4">
		                        <span class="card-title white-text text-darken-4">Blog Title<i class="material-icons right">close</i></span>
		                        <p class="grey-text">Here is some more information about this product that is only revealed once clicked on.</p>
		                      </div>
		                    </div>
		                </div>
		                <div class="col s12 m3">
		                    <div class="card hoverable">
		                      <div class="card-image waves-effect waves-block waves-light">
		                        <img class="activator" src="{!! asset('user/images/user2.png') !!}">
		                      </div>
		                      <div class="card-content blue-grey darken-4">
		                        <span class="card-title activator white-text text-darken-4">Blog Title<i class="material-icons right">more_vert</i></span>
		                      </div>
		                      <div class="card-reveal blue-grey darken-4">
		                        <span class="card-title white-text text-darken-4">Blog Title<i class="material-icons right">close</i></span>
		                        <p class="grey-text">Here is some more information about this product that is only revealed once clicked on.</p>
		                      </div>
		                    </div>
		                </div>
		                <div class="col s12 m3">
		                    <div class="card hoverable">
		                      <div class="card-image waves-effect waves-block waves-light">
		                        <img class="activator" src="{!! asset('user/images/user2.png') !!}">
		                      </div>
		                      <div class="card-content blue-grey darken-4">
		                        <span class="card-title activator white-text text-darken-4">Blog Title<i class="material-icons right">more_vert</i></span>
		                      </div>
		                      <div class="card-reveal blue-grey darken-4">
		                        <span class="card-title white-text text-darken-4">Blog Title<i class="material-icons right">close</i></span>
		                        <p class="grey-text">Here is some more information about this product that is only revealed once clicked on.</p>
		                      </div>
		                    </div>
		                </div>
		                <div class="col s12 m3">
		                    <div class="card hoverable">
		                      <div class="card-image waves-effect waves-block waves-light">
		                        <img class="activator" src="{!! asset('user/images/user1.png') !!}">
		                      </div>
		                      <div class="card-content blue-grey darken-4">
		                        <span class="card-title activator white-text text-darken-4">Blog Title<i class="material-icons right">more_vert</i></span>
		                      </div>
		                      <div class="card-reveal blue-grey darken-4">
		                        <span class="card-title white-text text-darken-4">Blog Title<i class="material-icons right">close</i></span>
		                        <p class="grey-text">Here is some more information about this product that is only revealed once clicked on.</p>
		                      </div>
		                    </div>
		                </div>                                    
            		</div>
          			<hr/>
        		</section>
    		</div>
		</div>
		<footer class="page-footer footer-black">
    		<div class="container footer-main-content">
      			<div class="row">
        			<div class="col l9 s12">
          				<h5 class="white-text">Site Links</h5>
          				<div class="row footer-row">
			              	<div class="link-row"><a  href="#!">Home</a></div>
			              	<div class="link-row"><a  href="#!">About</a></div>
			              	<div class="link-row"><a  href="#!">FAQ</a></div>
			              	<div class="link-row"><a  href="#!">Press</a></div>
			              	<div class="link-row"><a  href="#!">Contact</a></div>
			              	<div class="link-row"><a  href="#!">Careers</a></div>
			              	<div class="link-row"><a  href="#!">Privacy</a></div>
			              	<div class="link-row"><a  href="#!">Legal</a></div>
			          	</div>
        			</div>
        			<div class="col l3 s12">
          				<h5 class="white-text">Contact US</h5>
          				<div class="row footer-row">
              				<div class="contact-row">support@esportcolosseum.com</div>
              				<div class="contact-row">+91 966-287-2090</div>
          				</div>
        			</div>
      			</div>
    		</div>
    		<div class="footer-copyright black">
      			<div class="container  center-align">
      				Copyright © 2016 All rights reserved by <a class="orange-text text-lighten-3" href="#!">Esport Colosseum</a>
      			</div>
    		</div>
  		</footer>
  		<div id="loginModal" class="modal modal-fixed-footer blue-grey darken-4 modal-form">
  			{!! Form::open(['route' => 'login', 'method' => 'post', 'id' => 'loginForm']) !!}
	    		<div class="modal-content">
	      			<h5 class="white-text center-align">LOGIN</h5>
	      			<div class="error-messages hide"></div>
	      			<div id="loginForm" class="modal-form-container">
	            		<div class="row">
	                		<div class="input-field col s12 m12">
	                			{!! Form::email('email', '', ['class' => 'validate', 'id' => 'email', 'name' => 'email']) !!}
	                			{!! Form::label('email', 'Email', ['data-error' => '', 'id' => 'emailLabel']) !!}
	                		</div>
	            		</div>
	            		<div class="row">
	                		<div class="input-field col s12 m12">
	                			{!! Form::password('password', ['class' => 'validate', 'id' => 'password', 'name' => 'password']) !!}
	                			{!! Form::label('password', 'Password', ['data-error' => '', 'id' => 'passwordLabel']) !!}
	                		</div>
	            		</div>
	            		<div class="row">
	            			<a id="loginSubmit" class="waves-effect waves-light btn-large btn-full deep-orange darken-4">Login</a>
	            		</div>
	      			</div>
	    		</div>
	    		<div class="modal-footer black">
	      			<a href="javascript:void(0);" class="btn-flat white-text forgot-password-btn">Forgot password?</a>
	      			<a href="javascript:void(0);" class="btn-flat white-text signup-btn" id="signupBtn">SIGNUP ></a>
	    		</div>
	    	{!! Form::close() !!}
  		</div>
  		<div id="signUpModal" class="modal modal-fixed-footer blue-grey darken-4 modal-form">
  			{!! Form::open(['route' => 'login', 'method' => 'post', 'id' => 'registerForm']) !!}
	        	<div class="modal-content">
	        		<h5 class="white-text center-align">SignUp</h5>
	        		<div id="signupForm" class="modal-form-container">
		                <div class="row">
		                    <div class="input-field col s12 m12">
		                        {!! Form::email('email', '', ['class' => 'validate', 'id' => 'email', 'name' => 'email']) !!}
	                			{!! Form::label('email', 'Email', ['data-error' => '', 'id' => 'emailLabel']) !!}
		                    </div>
		                </div>
		                <div class="row">
		                    <div class="input-field col s12 m12">
		                        {!! Form::password('password', ['class' => 'validate', 'id' => 'password', 'name' => 'password']) !!}
	                			{!! Form::label('password', 'Password', ['data-error' => '', 'id' => 'passwordLabel']) !!}
		                    </div>
		                </div>
		                <div class="row">
		                    <div class="input-field col s12 m12">
		                    	{!! Form::password('password', ['class' => 'validate', 'id' => 'password_confirmation', 'name' => 'password_confirmation']) !!}
		                    	{!! Form::label('password_confirmation', 'Confirm Password', ['data-error' => '']) !!}
		                    </div>
		                </div>
		                <div class="row">
		                    <a id="registerSubmit" class="waves-effect waves-light btn-large btn-full deep-orange darken-4">Sign Up</a>
		                </div>
	        		</div>
	        	</div>
	       		<div class="modal-footer black">
	        		<a href="javascript:void(0);" class="btn-flat white-text no-link-grey">Already registered?</a>
	        		<a href="javascript:void(0);" class="btn-flat white-text login-btn" id="loginBtn">LOGIN ></a>
	        	</div>
	        {!! Form::close() !!}	
    	</div>
    	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="{!! asset('user/js/materialize.js') !!}"></script>
		<script src="{!! asset('user/js/init.js') !!}"></script>
		<script src="{!! asset('user/js/index.js') !!}"></script>
		<script src="{!! asset('user/js/esportcolosseum.js') !!}"></script>
		
	</body>
</html>