@extends('layouts.user.gamer-layout',['bodyClass' => 'challenge_page'])

@section('game-info')
    <section>
        <div class="game-banner z-depth-2">
            <div class="game-banner-title text-shadow">{!! $selectedGame->name !!} (Open Challenge)</div>
            <img src="{!! url(env('UPLOAD_GAME_BANNER', 'storage/games/large/').$selectedGame->banner_image) !!}" />
        </div>
    </section>
@endsection
@section('gamer-content')
<input type="text" name="testname" id="testname" class="" autocomplete="off" />
<section class="">
	<div class="section-title ">My <span>Challenges</span></div>
		<div class="inner-page-tab-back">
			<div class="row">
				<div class="disabled_for_mobile">
					<ul class="tabs" style="width: 100%;">
						<li><a class="active" href="#tab1">CURRENT CHALLENGE</a></li>
						<li><a href="#tab2">PAST CHALLENGE</a></li>
					<div class="indicator" style=""></div></ul>
				</div>
				<div class="display_for_mobile_drop">
					<select id="leave" style="display: block">
						<option value="tab1">CURRENT CHALLENGE </option>
						<option value="tab2">PAST CHALLENGE</option>
					</select>	
					<i class="fa fa-caret-down" aria-hidden="true"></i>
				</div>
				<div id="tab1">
					@foreach($myCurrentChallenges as $challenge)
						@include('user.partials.challenge.single-challenge', $challenge)
					@endforeach	
				</div>
				<div id="tab2" style="display: none;">
					<div class="first-challenge-section">
						<div class="row">
							<div class="row">
								<div class="first-challenge-header">
									<img src="images/game-icon.png">	
								</div>
								<div class="first-challenge-header-ul">
									<ul>
										<li>Challenge Type</li>
										<li>Playing As</li>
										<li>Time</li>
										<li>Coins</li>
									</ul>
									<ul class="data-for-order-">
										<li>Open Challenge / ESC Challenge</li>
										<li>Team</li>
										<li>12:00 to 15:00</li>
										<li>500</li>
									</ul>
									
								</div>
								<div class="first-challenge-header-button">
									<button class="btn btn-default">CHALLENGE COMPLETED</button>
								</div>
							</div>
							<div class="vs_area">
								<div class="row">
									<div class="first-challenge-left-blog">
										<div class="past_challenge_left_blog">
											<div class="past_challenge_winner_image">
												<img src="images/winner.png">
											</div>
											<div class="first_challenge_left_width">
												<h2><span>TEAM 1 :</span> WASHINGTON REDSKINS ROADSTER</h2>
												<ul>
													<li><a href="#"><img src="images/i.png"></a></li>
													<li><a href="#"><img src="images/blog1.png"></a></li>
													<li><a href="#"><img src="images/minus.png"></a></li>
												</ul>
												<h3>Lorem Ipsum<span>( Captain ) </span></h3>
												<div class="player-section">
													<div class="player-image">
														<img src="images/blog2.png">
													</div>
													<div class="player-informations">
														<h2>Kavit Varma</h2>
														<p>Remove  |  Report</p>
													</div>
													
												</div>
												<div class="player-section">
													<div class="player-image">
														<img src="images/blog3.png">
													</div>
													<div class="player-informations">
														<h2>Kavit Varma</h2>
														<p>Remove  |  Report</p>
													</div>
													
												</div>
												<div class="player-section">
													<div class="player-image">
														<img src="images/blog4.png">
													</div>
													<div class="player-informations">
														<h2>Andrew Bullock</h2>
														<p>Remove  |  Report</p>
													</div>
													
												</div>
												<div class="player-section">
													<div class="player-image">
														<img src="images/blog5.png">
													</div>
													<div class="player-informations">
														<h2>Andrew Bullock</h2>
														<p>Remove  |  Report</p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="versus-image">
										<img src="images/vs.png">
									</div>
									<div class="first-challenge-left-blog">
									<div class="past_challenge_right_blog">
									<div class="first_challenge_left_width">
										<h2><span>TEAM 2 :</span> MANCHESTER UNITED</h2>
										<ul>
											<li><a href="#"><img src="images/i.png"></a></li>
											<li><a href="#"><img src="images/blog1.png"></a></li>
											<li><a href="#"><img src="images/minus.png"></a></li>
										</ul>
										<h3>Lorem Ipsum<span>( Captain ) </span></h3>
										<div class="team-two-blog">
											<div class="player-section">
												<div class="player-image">
													<img src="images/blog2.png">
												</div>
												<div class="player-informations">
													<h2>Kavit Varma</h2>
													<p>Remove  |  Report</p>
												</div>
												
											</div>
											<div class="player-section">
												<div class="player-image">
													<img src="images/blog3.png">
												</div>
												<div class="player-informations">
													<h2>Kavit Varma</h2>
													<p>Remove  |  Report</p>
												</div>
												
											</div>
											<div class="player-section">
												<div class="player-image">
													<img src="images/blog4.png">
												</div>
												<div class="player-informations">
													<h2>Andrew Bullock</h2>
													<p>Remove  |  Report</p>
												</div>
												
											</div>
											<div class="player-section">
												<div class="player-image">
													<img src="images/blog5.png">
												</div>
												<div class="player-informations">
													<h2>Andrew Bullock</h2>
													<p>Remove  |  Report</p>
												</div>
											</div>
										</div>
									</div>
									</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>
@endsection