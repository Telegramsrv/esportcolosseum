@extends('layouts.user.gamer-layout', ['bodyClass' => 'profile_page'])
@section('game-info')
    <section>
        <div class="game-banner z-depth-2">
            <div class="last-login">Last Login - {!! $user->last_login->format('M d, Y H:i A') !!}</div>
            <img src="{!! url(env('UPLOAD_GAME_BANNER', 'storage/games/large/').$selectedGame->banner_image) !!}" class="game-banner-image" />
        </div>
    </section>
@endsection

@section("gamer-content")
	@php
		$profileName = $user->userDetails->first_name . " " . $user->userDetails->last_name;
	@endphp
	<section class="name-bar">
	    <div class="row">
    		<div class="col l3 s12">
        		<div class="profile_pic">
      				<img src="{!! url(env('PROFILE_PICTURE_PATH', 'storage/user/profile_pictures/').$user->userDetails->user_image) !!}" alt="{!! $profileName !!}" title="{!! $profileName !!}" class="img-pro-pic">
			      	<div class="edit-pic">
			    		<i class="fa fa-pencil" aria-hidden="true"></i>
			      	</div>
        			<div class="pro-name">
            			<span>
            				{!! $profileName !!}
            				<img class="flag flag-{!! strtolower($user->userDetails->country->code) !!}" />
            			</span> 
            		</div>
            	</div>
        	</div>
	        <div class="col l9 s12">
	        		<div class="row">
	            		<div class="col s12 m3">
	                		<div class="member-img">
	                			<img src="{!! asset('user/images/member.png') !!}" />
	                		</div>
	                    <div class="member-side">
	                    		<div class="member-ttl">Member Since</div>
	                        <div class="join-date">{!! $user->created_at->format('M d, Y') !!}</div>
	                    </div>
	                </div>
	                <div class="col s12 m3">
	                	<div class="member-img">
	                		<img src="{!! asset('user/images/coin.png') !!}" />
	                	</div>
	                    <div class="member-side">
	                    	<div class="member-ttl">Total Coins</div>
	                        <div class="join-date">{!! $user->userDetails->coins !!}</div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>
	<div class="profile_container">
        <div class="section-title ">GAMES <span>PLAYING</span></div>
            <div class="row">
              	<div class="first-row">
	                <div class="col s12 m3 no-padding">
	                    <div class="dota-img">
	                        <img src="{!! asset('user/images/d1.jpg') !!}" class="hide-tab"/>
	                        <img src="{!! asset('user/images/d1.jpg') !!}" class="show-tab"/>
	                        <div class="dota-img-ttl">Dota 2</div>
	                    </div>
	                </div>
                	<div class="col s12 m9 no-padding">
                    	<div class="col s12 m6 no-padding br-5">
                        	<div class="statistics">Tournament Statistics</div>
                            <div class="row canvas-block">
                                <div class="col s12 m5 no-padding">
                                    <div class="darkblue-panel pn">
                                        <canvas id="serverstatus01" height="150" width="150"></canvas>
                                        <div class="can-ttl">Total <span>20</span></div>
                                        <script>
                                          var doughnutData = [
                                              {
                                                value: 80,
                                                color:"#1f77b4"
                                              },
                                              {
                                                value : 40,
                                                color : "#ff5f21"
                                              }
                                            ];
                                            var myDoughnut = new Chart(document.getElementById("serverstatus01").getContext("2d")).Doughnut(doughnutData);
                                        </script>
                                    </div>
                                </div>
                                <div class="col s12 m7 no-padding">
                                    <div class="matches-win">
                                        <div class="win-match">Won Matches <span>15</span></div>
                                        <div class="loose-match">Loose Matches <span>05</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="progress">
                              	<div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                	70%
                              	</div>
                              	30%
                            </div>
                            <div class="match-result">
                            	<div class="match-ttl">Last 10 Matches Result</div>
	                            <ul class="no_match">
	                                <li class="win">W</li><li class="win">W</li><li class="win">W</li>
	                                <li class="win">W</li><li class="win">W</li><li class="win">W</li>
	                                <li class="loose">L</li><li class="loose">L</li><li class="loose">L</li>
	                                <li class="loose">L</li>
	                            </ul>
                        	</div>
                    	</div>
                    	<div class="col s12 m6 no-padding">
                        	<div class="statistics">Team Blue Sky</div>
                            <div class="row canvas-block">
                                <div class="col s12 m5 no-padding">
                                    <div class="darkblue-panel pn">
                                    	<canvas id="serverstatus02" height="150" width="150"></canvas>
                                        <div class="can-ttl">Total <span>20</span></div>
                                        <script>
                                          var doughnutData = [
                                              {
                                                value: 80,
                                                color:"#1f77b4"
                                              },
                                              {
                                                value : 40,
                                                color : "#ff5f21"
                                              }
                                            ];
                                            var myDoughnut = new Chart(document.getElementById("serverstatus02").getContext("2d")).Doughnut(doughnutData);
                                        </script>
                                	</div>
                            	</div>
                            	<div class="col s12 m7 no-padding">
                                	<div class="matches-win">
                                        <div class="win-match">Won Matches <span>15</span></div>
                                        <div class="loose-match">Loose Matches <span>05</span></div>
                                	</div>
                            	</div>
                        	</div>
                        	<div class="progress">
                          		<div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                            		70%
                          		</div>
                          		30%
                        	</div>
                        	<div class="match-result">
                        		<div class="match-ttl">Last 10 Matches Result</div>
                        		<ul class="no_match">
	                                <li class="win">W</li><li class="win">W</li><li class="win">W</li>
	                                <li class="win">W</li><li class="win">W</li><li class="win">W</li>
	                                <li class="loose">L</li><li class="loose">L</li><li class="loose">L</li>
	                                <li class="loose">L</li>
	                            </ul>
                			</div>
            			</div>
          			</div>
        		</div>
    		</div>
    	</div>
@endsection
