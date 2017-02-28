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
			@if($challenge->game_type == "solo")
				@include('user.partials.challenge.solo-challenge', $challenge)
			@else 
				@include('user.partials.challenge.team-challenge', $challenge)
			@endif
		</div>
	</div>
@endsection