<div class='remove-player-div'>
	{!! Form::open(['route' => 'user.remove-player.remove', 'method'=>'DELETE', 'id' => "remove-player-form"]) !!}
		{!! Form::hidden('player_id', md5($player->id), ['id' => 'player_id']) !!}
		{!! Form::hidden('team_id', md5($team->id), ['id' => 'team_id']) !!}
		{!! Form::hidden('challenge_id', md5($challenge->id), ['id' => 'challenge_id']) !!}
		<p>
			@if($canRemovePlayer)
				<a class="remove-player" href="javascript::void(0);">Remove</a>
			@else
				Remove
			@endif
		</p>
	{!! Form::close() !!}
</div>