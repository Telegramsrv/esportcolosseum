@extends('layouts.user.gamer-layout')

@section('game-info')
    <section>
        <div class="game-banner z-depth-2">
            <div class="game-banner-title text-shadow">{!! $selectedGame->name !!}</div>
            <img src="{!! url(env('UPLOAD_GAME_BANNER', 'storage/games/large/').$selectedGame->banner_image) !!}" />
        </div>
    </section>
@endsection

@section('gamer-content')
<section>
	<div class="section-title">Match <span>History</span></div>
	<div class="row card-panel table-container  blue-grey darken-4">
			<div class="table-responsive">
			<table class="table">
    			<thead>
    				<tr>
                        <th data-field="srno">Sr.No</th>
                        <th data-field="gameid">GameID</th>
                        <th data-field="opponent">Opponent</th>
                        <th data-field="type">Game Type</th>
                        <th data-field="result">Result</th>
                        <th data-field="price" class="center-align">Game Coins</th>
                        <th data-field="viewDetails" class="right-align" width="10%">View Details</th>
                    </tr>
    			</thead>
    			<tbody>
    				<tr>
                        <td>1</td>
                        <td>123234456</td>
                        <td>Kavit Varma</td>
                        <td>Solo</td>
                        <td>Won</td>
                        <td class="center-align">100</td>
                        <td class="center-align"><a class="orange-link" href="#"><i class="material-icons white-text">launch</i></a></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>123432457</td>
                        <td>Sanket Vaghasia</td>
                        <td>Team (Captian's Pick)</td>
                        <td>Loss</td>
                        <td class="center-align">250</td>
                        <td class="center-align"><a class="orange-link" href="#"><i class="material-icons white-text">launch</i></a></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>123534458</td>
                        <td>Rajan Kaneria</td>
                        <td>Team (Team Pick)</td>
                        <td>Won</td>
                        <td class="center-align">800</td>
                        <td class="center-align"><a class="orange-link" href="#"><i class="material-icons white-text">launch</i></a></td>
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