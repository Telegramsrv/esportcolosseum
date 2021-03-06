@php
	$challengerTeam = $challenge->challengerTeam();
	$challengerCaptain = null;
	$isChallengerCaptain = isCaptain($challenge->user_id);
	$canChallengerCompleteChallenge = false;
	$canChallengerCancelChallenge = false;
	$canChallengerRemovePlayer = true;
	$canOpponentCompleteChallenge = false;
	$pastChallengesStatus = ["cancelled", "completed"];
	$winnerTeam =  $challenge->winnerTeam();

	if($challengerTeam != null){
		$challengerCaptain = $challenge->captainDetails;
		if(!in_array($challenge->challenge_status, $pastChallengesStatus)) {
			$canChallengerCompleteChallenge = canCompleteChallenge($challenge, $challengerTeam, 'challenger');
			$canChallengerCancelChallenge = canCancelChallenge($challenge);
			$canChallengerRemovePlayer = canChallengerRemovePlayerFromTeam($challenge, $challengerTeam);
		} else {
			$canChallengerRemovePlayer = false;
		}
		
	}

	$opponentTeam = $challenge->opponentTeam();
	$opponentCaptain = null;
	$isOpponentCaptain = isCaptain($challenge->opponent_id);
	$canOpponentCompleteChallenge = false;
	$canOpponentRemovePlayer = true;
	
	if($opponentTeam != null ){
		$opponentCaptain = $challenge->opponentDetails;
		if(!in_array($challenge->challenge_status, $pastChallengesStatus)) {
			$canOpponentCompleteChallenge = canCompleteChallenge($challenge, $opponentTeam, 'opponent');
			$canOpponentRemovePlayer = canOpponentRemovePlayerFromTeam($challenge,$opponentTeam);
		} else {
			$canOpponentRemovePlayer = false;
		}
	}
@endphp

<div class="first-challenge-section versus-image-one">
	<div class="row">
		@include('user.partials.challenge.challenge-header', [$challenge, $selectedGame, $canChallengerCancelChallenge, $canChallengerCompleteChallenge, $canOpponentCompleteChallenge])
		<div class="vs_area">
			<div class="row">
				<div class="first-challenge-left-blog">
					@if(!empty($winnerTeam) && $winnerTeam->user_id == $challengerTeam->user_id)
					<div class="past_challenge_winner_image">
						<img src="{!! url('user/images/winner.png') !!}">
					</div>
					@endif
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
						<h2><span>TEAM 2 :  </span>
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
					@if(!empty($winnerTeam) && $winnerTeam->user_id == $opponentTeam->user_id)
					<div class="past_challenge_winner_image_one">
						<img src="{!! url('user/images/winner.png') !!}">
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@include('user.partials.challenge.add-team', ['challenge' => $challenge])
