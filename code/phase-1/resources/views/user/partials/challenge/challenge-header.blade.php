<div class="row">
	<div class="first-challenge-header">
		<img src="{!! url(env('UPLOAD_GAME_LOGO', 'storage/games/logo/'). $selectedGame->logo) !!}">	
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
		@if(isset($canChallengerCancelChallenge) && $canChallengerCancelChallenge)
			{!! Form::open(['route' => 'user.challenge.change-status', 'method'=>'POST']) !!}
				{!! Form::hidden('challenge_id', md5($challenge->id)) !!}
				{!! Form::hidden('challenge_status', md5('cancelled')) !!}
				{!! Form::submit('Cancel Challenge', ['class' => 'btn btn-default', 'id' => 'cancelChallengeBtn']) !!}
			{!! Form::close() !!}
		@elseif(isset($canChallengerCompleteChallenge) && $canChallengerCompleteChallenge)
			{!! Form::open(['route' => 'user.challenge.change-status', 'method'=>'POST']) !!}
				{!! Form::hidden('challenge_id', md5($challenge->id)) !!}
				{!! Form::hidden('challenge_status', md5('challenger-submitted')) !!}
				{!! Form::submit('Complete Challenge', ['class' => 'btn btn-default', 'id' => 'completeChallengeBtn']) !!}
			{!! Form::close() !!}
		@elseif(isset($canOpponentCompleteChallenge) && $canOpponentCompleteChallenge)
			{!! Form::open(['route' => 'user.challenge.change-status', 'method'=>'POST']) !!}
				{!! Form::hidden('challenge_id', md5($challenge->id)) !!}
				{!! Form::hidden('challenge_status', md5('opponent-submitted')) !!}
				{!! Form::submit('Complete Challenge', ['class' => 'btn btn-default', 'id' => 'completeChallengeBtn']) !!}
			{!! Form::close() !!}
		@else

		@endif
	</div>
</div>