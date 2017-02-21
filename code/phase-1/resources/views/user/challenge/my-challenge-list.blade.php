@extends('layouts.user.gamer-layout',['bodyClass' => 'challenge_page'])

@section('game-info')
    <section>
        <div class="game-banner z-depth-2">
            <div class="game-banner-title text-shadow">{!! $selectedGame->name !!} (Open Challenge)</div>
            <img src="{!! url(env('UPLOAD_GAME_BANNER', 'storage/games/large/').$selectedGame->banner_image) !!}" />
        </div>
    </section>
@endsection
@section('gamer-content')
<section class="">
	<div class="section-title ">My <span>Challenges</span></div>
		<div class="inner-page-tab-back">
			<div class="row">
				<div class="disabled_for_mobile">
					<ul class="tabs" style="width: 100%;">
						<li><a class="active" href="#tab1">CURRENT CHALLENGE</a></li>
						<li><a href="#tab2">PAST CHALLENGE</a></li>
					<div class="indicator" style=""></div></ul>
				</div>
				<div class="display_for_mobile_drop">
					<select id="leave" style="display: block">
						<option value="tab1">CURRENT CHALLENGE </option>
						<option value="tab2">PAST CHALLENGE</option>
					</select>	
					<i class="fa fa-caret-down" aria-hidden="true"></i>
				</div>
				<div id="tab1">
					@if($myCurrentChallenges->count() == 0)
						<div class="first-challenge-section versus-image-one">
							<div class="row">
								No active challenges!
							</div>
						</div>	
					@else
						@foreach($myCurrentChallenges as $challenge)
							@include('user.partials.challenge.single-challenge', $challenge)
						@endforeach	
					@endif	
				</div>
				<div id="tab2" style="display: none;">
					@if($myPastChallenges->count() == 0)
						<div class="first-challenge-section versus-image-one">
							<div class="row">
								No past challenges!
							</div>
						</div>	
					@else
						@foreach($myPastChallenges as $challenge)
							@include('user.partials.challenge.single-challenge', $challenge)
						@endforeach	
					@endif	
				</div>
			</div>
		</div>
    </section>
@endsection