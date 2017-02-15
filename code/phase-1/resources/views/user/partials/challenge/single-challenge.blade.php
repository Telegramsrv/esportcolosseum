@php
	$captainTeam = $challenge->captainTeam(Auth::user());
	$challangerTeam = $challenge->challangerTeam();
	$opponentTeam = $challenge->opponentTeam();

	$opponentTeamCaptain = ($challenge->opponent_id == Auth::id()) ? true : false;
	$challangerTeamCaptain = ($challenge->user_id == Auth::id()) ? true : false;

	$inviteAcceptedTeamCount = 0;
	$canCompleteChallenge = false;
	$canCancelChallenge = false;
	if($captainTeam != null ){
		$inviteAcceptedTeamCount = $captainTeam->players()->wherePivot('status', '=', 'Accepted')->count();	
		if($inviteAcceptedTeamCount == env('MAX_ALLOWED_PLAYERS_PER_TEAM')){
			$canCompleteChallenge = true;
		}
	}
	if($challenge->challenge_status == 'listed' && $challenge->opponent_id == null){
		$canCancelChallenge = true;
	}
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
				@if($canCancelChallenge)
					{!! Form::open(['route' => 'user.challenge.change-status', 'method'=>'POST']) !!}
						{!! Form::hidden('challenge_id', md5($challenge->id)) !!}
						{!! Form::hidden('challenge_status', md5('cancelled')) !!}
						{!! Form::submit('Cancel Challenge', ['class' => 'btn btn-default']) !!}
					{!! Form::close() !!}
				@elseif($canCompleteChallenge)
					{!! Form::open(['route' => 'user.challenge.change-status', 'method'=>'POST']) !!}
						{!! Form::hidden('challenge_id', md5($challenge->id)) !!}
						{!! Form::hidden('challenge_status', md5('listed')) !!}
						{!! Form::submit('Complete Challenge', ['class' => 'btn btn-default']) !!}
					{!! Form::close() !!}
				@else
					<label class="btn btn-default">COMPLETE CHALLENGE</label>	
				@endif
			</div>
		</div>
		<div class="vs_area">
			<div class="row">
				<div class="first-challenge-left-blog">
					<div class="first_challenge_left_width">
						<h2>
							<span>TEAM 1 :</span>
							@if($challangerTeam != null)
								{!! $challangerTeam-> name !!}
								@if($challenge->challenge_status == 'created' && $challangerTeamCaptain == true ) 
									<a href="#addTeamModal-{!! md5('add-team-'.$challenge->id) !!}" class="modal-trigger"><i class="tiny material-icons">mode_edit</i></a>
								@endif
							@elseif($challangerTeamCaptain == true)
								<a href="#addTeamModal-{!! md5('add-team-'.$challenge->id) !!}" class="modal-trigger">Click here</a> to create Team.
							@endif
						</h2>
						
						@if($challangerTeam != null)
							@if(count($challangerTeam->players) > 0)
								@foreach($challangerTeam->players as $player)
									@if($challenge->captain->id == $player->id)
										<ul class="captain-detail">
											<li>
												<a target="_blank" href="{!! route('user.profile', ['md5UserId' => md5($challenge->user_id), 'gameSlug' => $challenge->game->slug]) !!}">
													@php
														$profilePicURL = displayProfileImage($player->userDetails->user_image)
													@endphp		
													<img class="challenge-captain-image" src="{!! $profilePicURL !!}">
												</a>
											</li>
										</ul>
										<h3>
											{!! $player->userDetails->first_name !!} {!! $player->userDetails->last_name !!}
											<span>( Captain ) </span>
										</h3>
									@else
										<div class="player-section">
											<div class="player-image">
												@php
													$profilePicURL = displayProfileImage($player->userDetails->user_image)
												@endphp		
												<img class="challenge-team-image" src="{!! $profilePicURL !!}">
											</div>
											<div class="player-informations">
												<h2>{!! $player->userDetails->first_name !!} {!! $player->userDetails->last_name !!}</h2>
												
												@if($challangerTeamCaptain == true)
													@include('user.partials.challenge.remove-player-from-team', ['
													player' => $player, 'team' => $captainTeam, 'challenge' => $challenge])	
													| 
												@endif
												
												<p>Report</p>
											
											</div>
										</div>
									@endif
								@endforeach
							@endif
						@endif

						@if($captainTeam != null && $captainTeam->players->count() < env('MAX_ALLOWED_PLAYERS_PER_TEAM'))
							<div class="firt-team-image">
								<a href="#addTeamPlayerModal-{!! md5('add-team-player-'.$captainTeam->id) !!}" class="modal-trigger add-team-player">
									<img src="{!! url('user/images/person.png') !!}">
								</a>	
							</div>
							@include('user.partials.challenge.add-player-in-team', ['team' => $captainTeam])
						@endif
	 					
					</div>
				</div>
				<div class="versus-image">
					<img src="{!! url('user/images/vs.png') !!}">
				</div>
				<div class="first-challenge-left-blog">
					<div class="first_challenge_left_width">
						<h2><span>TEAM 2 </span>
							@if($opponentTeam != null)
								{!! $opponentTeam-> name !!}
								@if($challenge->challenge_status == 'created' && $opponentTeamCaptain == true)
									<a href="#addTeamModal-{!! md5('add-team-'.$challenge->id) !!}" class="modal-trigger"><i class="tiny material-icons">mode_edit</i></a>
								@endif
							@elseif($opponentTeamCaptain == true)
								<a href="#addTeamModal-{!! md5('add-team-'.$challenge->id) !!}" class="modal-trigger">Click here</a> to create Team.
							@endif
							</h2>
							@if($opponentTeam != null)
								@if(count($opponentTeam->players) > 0)
									@foreach($opponentTeam->players as $player)
										@if($challenge->opponent_id == $player->id)
											<ul class="captain-detail">
												<li>
													<a target="_blank" href="{!! route('user.profile', ['md5UserId' => md5($challenge->user_id), 'gameSlug' => $challenge->game->slug]) !!}">
														@php
															$profilePicURL = displayProfileImage($player->userDetails->user_imag)
														@endphp		
														<img class="challenge-captain-image" src="{!! $profilePicURL !!}">
													</a>
												</li>
											</ul>
											<h3>
												{!! $player->userDetails->first_name !!} {!! $player->userDetails->last_name !!}
												<span>( Captain ) </span>
											</h3>
										@else
											<div class="player-section">
												<div class="player-image">
													@php
														$profilePicURL = displayProfileImage($player->userDetails->user_image)
													@endphp		
													<img class="challenge-team-image" src="{!! $profilePicURL !!}">
												</div>
												<div class="player-informations">
													<h2>{!! $player->userDetails->first_name !!} {!! $player->userDetails->last_name !!}</h2>
													@if($opponentTeamCaptain == true)
														@include('user.partials.challenge.remove-player-from-team', ['
														player' => $player, 'team' => $captainTeam, 'challenge' => $challenge])
														| 
													@endif
													<p>Report</p>
												
												</div>
											</div>
										@endif
									@endforeach
								@endif

								@if($captainTeam != null && $captainTeam->players->count() < env('MAX_ALLOWED_PLAYERS_PER_TEAM'))
									<div class="firt-team-image">
										<a href="#addTeamPlayerModal-{!! md5('add-team-player-'.$captainTeam->id) !!}" class="modal-trigger add-team-player">
											<img src="{!! url('user/images/person.png') !!}">
										</a>	
									</div>
									@include('user.partials.challenge.add-player-in-team', ['team' => $captainTeam])
								@endif
							@else
							<div class="dont-right-image">
								<img src="{!! url('user/images/dont.png') !!}">
								<button class="btn btn-default">Challenge Is Not Accepted Yet</button>
							</div>
						@endif	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('user.partials.challenge.add-team', ['challenge' => $challenge])
