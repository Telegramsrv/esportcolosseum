<div id="addTeamPlayerModal-{!! md5('add-team-player-'.$team->id) !!}" class="modal blue-grey darken-4 modal-smal-form add-player-model">
	{!! Form::open(['route' => 'user.add-player-in-team.save', 'method' => 'post', 'id' => 'addPlayerInTeamForm']) !!}
		{!! Form::hidden('team_id', md5($team->id), ['id' => 'team_id']) !!}
		{!! Form::hidden('player_id', '', ['id' => 'player_id']) !!}
		
	    <div class="modal-content">
	      	<div class="modal-form-container">
	            <div class="row">
	                <div class="input-field col s12 m12">
	                    {!! Form::text('player', '',['class' => 'validate', 'id' => 'player', 'autocomplete' => 'off']) !!}
	                    {!! Form::label('player', 'Gamer Name OR Email', ['data-error' => '', 'id' => 'playerLabel']) !!}
	                </div>
					<div class="input-field col s12 m12">
	                    <a id="addPlayerSubmit" class="waves-effect waves-light btn-large btn-full deep-orange darken-4">SUBMIT</a>
	                    <div class="progress">
		                	<div class="indeterminate"></div>
		                </div>
	                </div>
	            </div>
				<div id="no-team-selected">
					<div id="message">You dont have any teams yet</div>
				</div>
				<div id="team-player-list"></div>
	      	</div>
	    </div>
    {!! Form::close() !!}
</div>