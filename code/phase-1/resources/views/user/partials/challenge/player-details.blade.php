@foreach($players as $player)
	@if($captain->id != $player->id)
		<div class="player-section">
			<div class="player-image">
				@php
					$profilePicURL = displayProfileImage($player->userDetails->user_image)
				@endphp		
				<img class="challenge-team-image" src="{!! $profilePicURL !!}">
			</div>
			<div class="player-informations">
				<h2>{!! $player->userDetails->first_name !!} {!! $player->userDetails->last_name !!}</h2>
				
				@if($isCaptain == true)
					@include('user.partials.challenge.remove-player-from-team', ['
					player' => $player, 'team' => $challengerTeam, 'challenge' => $challenge])	
					| 
				@endif
				
				<p>Report</p>
			</div>
		</div>
	@endif
@endforeach