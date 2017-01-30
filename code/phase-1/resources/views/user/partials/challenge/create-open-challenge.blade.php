<div id="createChallengeModal" class="modal modal-fixed-footer blue-grey darken-4 modal-form">
    {!! Form::open(['route' => ['user.open-challenge.save', $selectedGame->slug], 'method' => 'post', 'id' => 'createChallengeForm']) !!}
        {!! Form::hidden('game_id', $selectedGame->id) !!}
        {!! Form::hidden('challenge_type', $challengeType) !!}
        <div class="modal-content">
            <h5 class="white-text center-align">Create Challenge</h5>
            <div id="signupForm" class="modal-form-container">
                <div class="row" style="margin-bottom: 50px;">
                    <div class="input-field col s12 m6">
                        {!! Form::radio('game_type', 'solo', true, ['id'=>'solo', 'class'=>'game-type']) !!}
                        {!! Form::label('solo', 'Solo', ['data-error' => '']) !!}
                    </div>
                    <div class="input-field col s12 m6">
                        {!! Form::radio('game_type', 'team', false, ['id'=>'team', 'class'=>'game-type']) !!}
                        {!! Form::label('team', 'Team', ['data-error' => '']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m12">
                        {!! Form::text('coins', '', ['class' => 'validate', 'id' => 'coins', 'name' => 'coins']) !!}
                        {!! Form::label('coins', 'Coins', ['data-error' => '', 'id' => 'coinsLabel']) !!}
                    </div>
                </div>
                <div class="row" >
                    <div class="input-field col s12 m12">
                        {!! Form::select('region_id', $regions, ['class' => 'validate', 'id' => 'region_id', 'name' => 'region_id']) !!}
                        {!! Form::label('region_id', 'Region', ['data-error' => '', 'id' => 'regionLabel']) !!}
                    </div>
                </div>
                <div class="row challenge-team-field">
                    <div class="input-field col s12 m12">
                        {!! Form::text('team_name', '', ['class' => 'validate', 'id' => 'team_name', 'name' => 'team_name']) !!}
                        {!! Form::label('team_name', 'Team Name', ['data-error' => '', 'id' => 'teamLabel']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m12">
                        {!! Form::select('challenge_sub_type', $challengeModes, ['class' => 'validate', 'id' => 'challenge_sub_type', 'name' => 'challenge_sub_type']) !!}
                        {!! Form::label('challenge_sub_type', 'Challenge Mode', ['data-error' => '', 'id' => 'challengeTypeLabel']) !!}
                    </div>
                </div>
                <div class="row">
                    <a id="createChallengeSubmit" class="waves-effect waves-light btn btn-full deep-orange darken-4">Create</a>
                </div>
            </div>
        </div>
        <div class="modal-footer black"></div>
    {!! Form::close() !!}
</div>