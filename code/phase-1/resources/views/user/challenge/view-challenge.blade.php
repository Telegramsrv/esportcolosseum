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
						<li>Valid Till</li>
						<li>Coins</li>
					</ul>
					<ul class="data-for-order-">
						<li>{!! ucfirst($challenge->challenge_type) !!} Challenge</li>
						<li>{!! ucfirst($challenge->game_type) !!}</li>
						<li>{!! findDateDifferenceInHours($challenge->valid_upto) !!}</li>
						<li>{!! $challenge->coins !!}</li>
					</ul>
				</div>
			</div>
			<div class="vs_area">
				<div class="row">
					@if($challenge->game_type == "solo")
						@include('user.partials.challenge.solo-challenge', $challenge)
					@else 
						@include('user.partials.challenge.team-challenge', $challenge)
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection