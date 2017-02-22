@extends('layouts.user.gamer-layout')

@section('game-info')
    <section>
        <div class="game-banner z-depth-2">
            <div class="game-banner-title text-shadow">{!! $selectedGame->name !!}</div>
            <img src="{!! url(env('UPLOAD_GAME_BANNER', 'storage/games/large/').$selectedGame->banner_image) !!}" />
        </div>
    </section>
@endsection

@section('game-challenge')
<section class="challenge-types">
    <div class="row">
        <div class="col s12 m6">
            <a href="{!! route('user.esc-challenge.list',['gameSlug' => $selectedGame->slug]) !!}">
                <div class="challenge-type-container valign-wrapper">
                    <div class="challenge-title valign">
                        <div class="title text-shadow">ESC</div>
                        <div class="subtitle text-shadow">CHALLENGES</div>
                    </div>
                    <img src="{!! asset('user/images/tournament-bg.jpg') !!}" />
                    <div class="image-overlay"></div>
                </div>
            </a>    
        </div>
        <div class="col s12 m6">
            <a href="{!! route('user.open-challenge.list',['gameSlug' => $selectedGame->slug]) !!}">
                <div class="challenge-type-container valign-wrapper">
                    <div class="challenge-title valign">
                        <div class="title text-shadow">OPEN</div>
                        <div class="subtitle text-shadow">CHALLENGES</div>
                    </div>
                    <img src="{!! asset('user/images/chalange-bg.jpg') !!}" />
                    <div class="image-overlay"></div>
                </div>
            </a>        
        </div>
    </div>
</section>
@endsection

@section('gamer-content')
<section>
	<div class="section-title">Match <span>History</span></div>
	   @include('user.partials.challenge.match-history', $matchHistory)
</section>
@endsection