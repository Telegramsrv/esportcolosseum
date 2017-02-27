@extends('layouts.user.gamer-layout')

@section('game-info')
    <section>
        <div class="game-banner z-depth-2">
            <div class="game-banner-title text-shadow">{!! $selectedGame->name !!} (Open Challenge)</div>
            <img src="{!! url(env('UPLOAD_GAME_BANNER', 'storage/games/large/').$selectedGame->banner_image) !!}" />
        </div>
    </section>
@endsection

@section('gamer-content')
	<section>
    	<div class="section-title">
    		Challenge <span>List</span> 
    		<a href="#createChallengeModal" class="waves-effect waves-light btn deep-orange darken-4 modal-trigger" id="createChallengeBtn">Create Challenge</a>
    	</div>
        <div class="row card-panel table-container  blue-grey darken-4">
        	<div class="table-responsive">
                <table class="table">
                    <thead>
	                    <tr>
	                        <th data-field="gameid">GameID</th>
	                        <th data-field="challenger">Challenger Name</th>
	                        <th data-field="type" class="center-align">Challenge Type</th>
	                        <th data-field="coins" class="center-align">Coins</th>
	                        <th data-field="validDate" class="center-align">Valid Upto</th>
	                        <th data-field="region" class="center-align">Region</th>
	                        @if($canUserAcceptChallenge == true)
	                        <th data-field="acceptBtn">Accept</th>
	                        @endif
	                    </tr>
                    </thead>
                    <tbody>
                    	@if($challenges->count() > 0)
		                    @foreach($challenges as $k => $challenge)
		                    <tr>
		                    	<td>{!! ($k + 1) !!}</td>
		                        <td>{!! $challenge->captain->userDetails->first_name !!} {!! $challenge->captain->userDetails->last_name !!}</td>
		                        <td class="center-align">{!! $challenge->game_type !!}</td>
		                        <td class="center-align">{!! $challenge->coins !!}</td>
		                        <td class="center-align">{!! !empty($challenge->valid_upto) ? $challenge->valid_upto->format('H:i A M d, Y') : "" !!}</td>
		                        <td class="center-align">{!! $challenge->region->name !!}</td>
		                        @if($canUserAcceptChallenge == true)
		                        <td>
		                        	
			                        	{!! Form::open(['route' => 'user.challenge.accept', 'method' => 'post']) !!}
											{!! Form::hidden('challenge_id', md5($challenge->id)) !!}
			                            	<button class="btn-flat waves-effect waves-light" type="submit" id="acceptChallengeBtn">
			                                	<i class="material-icons white-text">send</i>
			                            	</button>
			                           {!! Form::close() !!} 
		                           
		                        </td>
		                        @endif	
		                    </tr>
		                    @endforeach
		                @else    
		                	<tr>
		                		<td colspan="7">No challenges found!</td>
		                	</tr>
		                @endif    
                    </tbody>
                </table>                                   
			</div>
        </div>
        {{ $challenges->links('user.partials.pagination') }}
		<hr/>
    </section>
@endsection

@section('create-game-challenge')
	@include('user.partials.challenge.create-open-challenge',['regions' => $regions, 'selectedGame' => $selectedGame, 'challengeType' => 'open'])
@endsection	