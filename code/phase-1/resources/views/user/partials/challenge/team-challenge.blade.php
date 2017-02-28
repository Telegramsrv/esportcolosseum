@php
	$winnerTeam =  $challenge->winnerTeam();
	$challengerTeam = $challenge->challengerTeam();
	$challengerCaptain = null;
	$isChallengerCaptain = isCaptain($challenge->user_id);
	

	if($challengerTeam != null){
		$challengerCaptain = $challenge->captainDetails;
	}

	$opponentTeam = $challenge->opponentTeam();
	$opponentCaptain = null;
	$isOpponentCaptain = isCaptain($challenge->opponent_id);
	
	if($opponentTeam != null ){
		$opponentCaptain = $challenge->opponentDetails;
	}
@endphp
<div class="first-challenge-section versus-image-one">
	<div class="row">
		@include('user.partials.challenge.challenge-header', [$challenge, $selectedGame])
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
										'canRemovePlayer' => false
									];
								@endphp	
								@include('user.partials.challenge.player-details', $parameters)
							@endif
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
											'canRemovePlayer' => false,
										];
									@endphp	
									@include('user.partials.challenge.player-details', $parameters)
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
