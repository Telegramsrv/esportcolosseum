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
	                        <th data-field="acceptBtn">Accept</th>
	                    </tr>
                    </thead>
                    <tbody>
	                    <tr>
	                        <td>12</td>
	                        <td>Kavit Varma</td>
	                        <td class="center-align">Solo</td>
	                        <td class="center-align">100</td>
	                        <td class="center-align">09:12PM 16th Nov, 2016</td>
	                        <td class="center-align">NA</td>
	                        <td>
	                            <button class="btn-flat waves-effect waves-light" type="button">
	                                <i class="material-icons white-text">send</i>
	                            </button>
	                        </td>
	                    </tr>
	                    <tr>
	                        <td>12</td>
	                        <td>Kavit Varma</td>
	                        <td class="center-align">Solo</td>
	                        <td class="center-align">100</td>
	                        <td class="center-align">09:12PM 16th Nov, 2016</td>
	                        <td class="center-align">NA</td>
	                        <td>
	                            <button class="btn-flat waves-effect waves-light" type="button">
	                                <i class="material-icons white-text">send</i>
	                            </button>
	                        </td>
	                    </tr>
	                    <tr>
	                        <td>12</td>
	                        <td>Kavit Varma</td>
	                        <td class="center-align">Solo</td>
	                        <td class="center-align">100</td>
	                        <td class="center-align">09:12PM 16th Nov, 2016</td>
	                        <td class="center-align">NA</td>
	                        <td>
	                            <button class="btn-flat waves-effect waves-light" type="button">
	                                <i class="material-icons white-text">send</i>
	                            </button>
	                        </td>
	                    </tr>
	                    <tr>
	                        <td>12</td>
	                        <td>Kavit Varma</td>
	                        <td class="center-align">Solo</td>
	                        <td class="center-align">100</td>
	                        <td class="center-align">09:12PM 16th Nov, 2016</td>
	                        <td class="center-align">NA</td>
	                        <td>
	                            <button class="btn-flat waves-effect waves-light" type="button">
	                                <i class="material-icons white-text">send</i>
	                            </button>
	                        </td>
	                    </tr>
	                    <tr>
	                        <td>12</td>
	                        <td>Kavit Varma</td>
	                        <td class="center-align">Solo</td>
	                        <td class="center-align">100</td>
	                        <td class="center-align">09:12PM 16th Nov, 2016</td>
	                        <td class="center-align">NA</td>
	                        <td>
	                            <button class="btn-flat waves-effect waves-light" type="button">
	                                <i class="material-icons white-text">send</i>
	                            </button>
	                        </td>
	                    </tr>
                    </tbody>
                </table>                                   
			</div>
        </div>
        <center>
        	<ul class="pagination">
            	<li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                <li class="active  blue-grey darken-4"><a href="#!">1</a></li>
                <li class="waves-effect"><a href="#!">2</a></li>
                <li class="waves-effect"><a href="#!">3</a></li>
                <li class="waves-effect"><a href="#!">4</a></li>
                <li class="waves-effect"><a href="#!">5</a></li>
                <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
            </ul>
        </center>
		<hr/>
    </section>
@endsection

@section('create-game-challenge')
	@include('user.partials.create-challenge',['regions' => $regions, 'selectedGame' => $selectedGame, 'challengeName' => 'open'])
@endsection	