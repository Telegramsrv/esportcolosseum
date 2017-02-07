@php
	$captainTeam = $challenge->captainTeam(Auth::user());
@endphp
<div class="first-challenge-section versus-image-one">
	<div class="row">
		<div class="row">
			<div class="first-challenge-header">
				<img src="{!! url(env('UPLOAD_GAME_LOGO', 'storage/games/logo/').$selectedGame->logo) !!}">	
			</div>
			<div class="first-challenge-header-ul">
				<ul>
					<li>Challenge Type</li>
					<li>Playing As</li>
					<li>Valid Till</li>
					<li>Coins</li>
				</ul>
				<ul class="data-for-order-">
					<li>{!! ucfirst($challenge->challenge_type) !!} Challenge</li>
					<li>{!! ucfirst($challenge->game_type) !!}</li>
					<li>{!! findDateDifferenceInHours($challenge->valid_upto) !!}</li>
					<li>{!! $challenge->coins !!}</li>
				</ul>
				
			</div>
			<div class="first-challenge-header-button">
				<button class="btn btn-default">COMPLETE CHALLENGE</button>
			</div>
		</div>
		<div class="vs_area">
			<div class="row">
				<div class="first-challenge-left-blog">
					<div class="first_challenge_left_width">
						<h2>
							<span>TEAM 1 :</span>
							@if($captainTeam != null)
								{!! $captainTeam-> name !!}
								<a href="#addTeamModal-{!! md5('add-team-'.$challenge->id) !!}" class="modal-trigger"><i class="tiny material-icons">mode_edit</i></a>
							@else
								<a href="#addTeamModal-{!! md5('add-team-'.$challenge->id) !!}" class="modal-trigger">Click here</a> to create Team.
							@endif
							
						</h2>
						<ul>
							<li><a href="#"><img src="{!! url('user/images/i.png') !!}"></a></li>
							<li>
								<a target="_blank" href="{!! route('user.profile', ['md5UserId' => md5($challenge->user_id), 'gameSlug' => $challenge->game->slug]) !!}">
									<img class="challenge-captain-image" src="{!! url(env('PROFILE_PICTURE_PATH', 'storage/user/profile_pictures/') . $challenge->captainDetails->user_image) !!}">
								</a>
							</li>
							<li><a href="#"><img src="{!! url('user/images/minus.png') !!}"></a></li>
						</ul>
						<h3>{!! $challenge->captainDetails->first_name !!} {!! $challenge->captainDetails->last_name !!}<span>( Captain ) </span></h3>
						@if($captainTeam != null)
							@if($captainTeam->players->count())
								@foreach($captainTeam->players as $player)
									@if($challenge->captain->id != $player->id)
										<div class="player-section">
											<div class="player-image">
												<img class="challenge-team-image" src="{!! url(env('PROFILE_PICTURE_PATH', 'storage/user/profile_pictures/') . $player->userDetails->user_image) !!}">
											</div>
											<div class="player-informations">
												<h2>{!! $player->userDetails->first_name !!} {!! $player->userDetails->last_name !!}</h2>
												<p>Remove  |  Report</p>
											</div>
										</div>
									@endif
								@endforeach
							@endif
						@endif	
						<div class="firt-team-image">
							<img src="{!! url('user/images/person.png') !!}">
						</div>
					</div>
				</div>
				<div class="versus-image">
					<img src="{!! url('user/images/vs.png') !!}">
				</div>
				<div class="first-challenge-left-blog">
					<div class="first_challenge_left_width">
						<h2><span>TEAM 2 </span></h2>
						<div class="dont-right-image">
							<img src="images/dont.png">
							<button class="btn btn-default">Challenge Is Not Accepted Yet</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('layouts.user.partials.add-team', ['challenge' => $challenge])