@php
	$challengerTeam = $challenge->challengerTeam();
	$challengerCaptain = null;
	$isChallengerCaptain = isCaptain($challenge->user_id);
	$canChallengerCompleteChallenge = false;
	$canChallengerCancelChallenge = false;
	$canChallengerRemovePlayer = true;
	$canOpponentCompleteChallenge = false;
	
	if($challengerTeam != null ){
		$challengerCaptain = $challenge->captain;
		$canChallengerCompleteChallenge = canCompleteChallenge($challenge, $challengerTeam, 'challenger');
		$canChallengerCancelChallenge = canCancelChallenge($challenge);
		$canChallengerRemovePlayer = canChallengerRemovePlayerFromTeam($challenge, $challengerTeam);
	}

	$opponentTeam = $challenge->opponentTeam();
	$opponentCaptain = null;
	$isOpponentCaptain = isCaptain($challenge->opponent_id);
	$canOpponentCompleteChallenge = true;
	$canOpponentRemovePlayer = true;
	
	if($opponentTeam != null){
		$opponentCaptain = $challenge->opponent;
		$canOpponentCompleteChallenge = canCompleteChallenge($challenge, $opponentTeam, 'opponent');
		$canOpponentRemovePlayer = canOpponentRemovePlayerFromTeam($challenge,$opponentTeam);
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
				@if($canChallengerCancelChallenge)
					{!! Form::open(['route' => 'user.challenge.change-status', 'method'=>'POST']) !!}
						{!! Form::hidden('challenge_id', md5($challenge->id)) !!}
						{!! Form::hidden('challenge_status', md5('cancelled')) !!}
						{!! Form::submit('Cancel Challenge', ['class' => 'btn btn-default', 'id' => 'cancelChallengeBtn']) !!}
					{!! Form::close() !!}
				@elseif($canChallengerCompleteChallenge)
					{!! Form::open(['route' => 'user.challenge.change-status', 'method'=>'POST']) !!}
						{!! Form::hidden('challenge_id', md5($challenge->id)) !!}
						{!! Form::hidden('challenge_status', md5('challenger-submitted')) !!}
						{!! Form::submit('Complete Challenge', ['class' => 'btn btn-default', 'id' => 'completeChallengeBtn']) !!}
					{!! Form::close() !!}
				@elseif($canOpponentCompleteChallenge)
					{!! Form::open(['route' => 'user.challenge.change-status', 'method'=>'POST']) !!}
						{!! Form::hidden('challenge_id', md5($challenge->id)) !!}
						{!! Form::hidden('challenge_status', md5('opponent-submitted')) !!}
						{!! Form::submit('Complete Challenge', ['class' => 'btn btn-default', 'id' => 'completeChallengeBtn']) !!}
					{!! Form::close() !!}
				@else
					<!-- <label class="btn btn-default">COMPLETE CHALLENGE</label>	 -->
				@endif
			</div>
		</div>
		<div class="vs_area">
			<div class="row">
				<div class="first-challenge-left-blog">
					<div class="first_challenge_left_width">
						<h2>
							<span>TEAM 1 :</span>
							@if($challengerTeam != null)
								{!! $challengerTeam-> name !!}
								@if($challenge->challenge_status == 'created' && $isChallengerCaptain == true ) 
									<a href="#addTeamModal-{!! md5('add-team-'.$challenge->id) !!}" class="modal-trigger"><i class="tiny material-icons">mode_edit</i></a>
								@endif
							@elseif($isChallengerCaptain == true)
								<a href="#addTeamModal-{!! md5('add-team-'.$challenge->id) !!}" class="modal-trigger">Click here</a> to create Team.
							@endif
						</h2>
						
						@if($challengerTeam != null)
							@if($challengerCaptain != null)
								@php
									$parameters = [
										'challenge' => $challenge, 
										'captain' => $challengerCaptain
									];
								@endphp	
								@include('user.partials.challenge.captain-details', $parameters)
							@endif
							@if($challengerTeam->players->count() > 0)
								@php
									$parameters = [
										'challenge' => $challenge,
										'team' => $challengerTeam,
										'players' => $challengerTeam->players,
										'captain' => $challengerCaptain,
										'isCaptain' => $isChallengerCaptain,
										'canRemovePlayer' => $canChallengerRemovePlayer
									];
								@endphp	
								@include('user.partials.challenge.player-details', $parameters)
							@endif
						@endif

						@if($challengerTeam != null && $isChallengerCaptain == true && $challengerTeam->players->count() < env('MAX_ALLOWED_PLAYERS_PER_TEAM'))
							<div class="firt-team-image">
								<a href="#addTeamPlayerModal-{!! md5('add-team-player-'.$challengerTeam->id) !!}" class="modal-trigger add-team-player">
									<img src="{!! url('user/images/person.png') !!}">
								</a>	
							</div>
							@php
								$parameters = [
									'team' => $challengerTeam,
									'challenge' => $challenge
								];
							@endphp
							@include('user.partials.challenge.add-player-in-team', $parameters)
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
								@if($challenge->challenge_status == 'opponent-accepted' && $isOpponentCaptain == true)
									<a href="#addTeamModal-{!! md5('add-team-'.$challenge->id) !!}" class="modal-trigger"><i class="tiny material-icons">mode_edit</i></a>
								@endif
							@elseif($isOpponentCaptain == true)
								<a href="#addTeamModal-{!! md5('add-team-'.$challenge->id) !!}" class="modal-trigger">Click here</a> to create Team.
							@endif
							</h2>
							@if($opponentTeam != null)
								@if($opponentCaptain != null)
									@php
										$parameters = [
											'challenge' => $challenge, 
											'captain' => $opponentCaptain
										];
									@endphp	
									@include('user.partials.challenge.captain-details', $parameters)
								@endif
								@if(count($opponentTeam->players) > 0)
									@php
										$parameters = [
											'challenge' => $challenge,
											'team' => $opponentTeam,
											'players' => $opponentTeam->players,
											'captain' => $opponentCaptain,
											'isCaptain' => $isOpponentCaptain,
											'canRemovePlayer' => $canOpponentRemovePlayer,
										];
									@endphp	
									@include('user.partials.challenge.player-details', $parameters)
								@endif

								@if($opponentTeam != null && $isOpponentCaptain == true && $opponentTeam->players->count() < env('MAX_ALLOWED_PLAYERS_PER_TEAM'))
									<div class="firt-team-image">
										<a href="#addTeamPlayerModal-{!! md5('add-team-player-'.$opponentTeam->id) !!}" class="modal-trigger add-team-player">
											<img src="{!! url('user/images/person.png') !!}">
										</a>	
									</div>
									@php
										$parameters = [
											'team' => $opponentTeam,
											'challenge' => $challenge
										];
									@endphp
									@include('user.partials.challenge.add-player-in-team', $parameters)
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
