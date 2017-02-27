
@php
	$challengerCaptain = $challenge->captainDetails;
	$opponentCaptain = null;
	if($challenge->opponentDetails != null ){
		$opponentCaptain = $challenge->opponentDetails;
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
					<li>Time</li>
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
				
			</div>
		</div>
		<div class="vs_area">
			<div class="row">
				<div class="first-challenge-left-blog">
					@if(!empty($challenge->winner_id) && $challenge->user_id == $challenge->winner_id)
						<div class="past_challenge_winner_image">
							<img src="{!! url('user/images/winner.png') !!}">
						</div>
					@endif
					<div class="first_challenge_left_width">
						<h2>
							<span>TEAM 1 :</span>
							{!! $challengerCaptain->first_name !!} {!! $challengerCaptain->last_name !!}
						</h2>
						@if($challengerCaptain != null)
							@php
								$parameters = [
									'challenge' => $challenge, 
									'captain' => $challengerCaptain
								];
							@endphp	
							@include('user.partials.challenge.captain-details', $parameters)
						@endif
					</div>
				</div>
				<div class="versus-image">
					<img src="{!! url('user/images/vs.png') !!}">
				</div>
				<div class="first-challenge-left-blog">
					<div class="first_challenge_left_width">
						@if($opponentCaptain != null)
							<h2>
								<span>TEAM 2 :  </span>
								{!! $opponentCaptain->first_name !!} {!! $opponentCaptain->last_name !!}
							</h2>
							@php
								$parameters = [
									'challenge' => $challenge, 
									'captain' => $opponentCaptain
								];
							@endphp	
							@include('user.partials.challenge.captain-details', $parameters)
						@else
							<div class="dont-right-image">
								<img src="{!! url('user/images/dont.png') !!}">
								<button class="btn btn-default">Challenge Is Not Accepted Yet</button>
							</div>
						@endif	
					</div>
					@if(!empty($challenge->winner_id) && $challenge->opponent_id == $challenge->winner_id)
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
