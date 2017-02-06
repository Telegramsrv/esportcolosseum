<div id="addTeamModal-{!! md5('add-team-'.$challenge->id) !!}" class="modal blue-grey darken-4 modal-smal-form add-team-model">
	{!! Form::open(['route' => 'user.team.save', 'method' => 'post', 'id' => 'createTeamForm']) !!}
		{!! Form::hidden('challenge_id', md5($challenge->id), ['id' => 'challenge_id']) !!}
	    <div class="modal-content">
	      	<div class="modal-form-container">
	            <div class="row">
	                <div class="input-field col s12 m12">
	                    <!-- <input id="teamNameAutoComplete" data-json-content="" type="text" class="validate autocomplete" value="Lorem Ipsum's Team"> -->
	                    <!-- validate input-field col s12 m12 -->
	                    {!! Form::text('name', '',['class' => '', 'id' => 'name', 'autocomplete' => 'off']) !!}
	                    {!! Form::label('name', 'Enter your team\'s name', ['data-error' => '', 'id' => 'nameLabel']) !!}
	                </div>
					<div class="input-field col s12 m12">
	                    <a id="createTeamSubmit" class="waves-effect waves-light btn-large btn-full deep-orange darken-4">SUBMIT</a>
	                </div>
	            </div>
				<div id="noTeamMessage">
					<div id="message">You dont have any teams yet</div>
				</div>
				<div id="teamPlayerList">
					<div class="player-section">
						<div class="player-image">
							<img src="images/blog2.png">
						</div>
						<div class="player-informations">
							<h2>Kavit Varma</h2>
						</div>
					</div>
				</div>
	      	</div>
	    </div>
    {!! Form::close() !!}
</div>