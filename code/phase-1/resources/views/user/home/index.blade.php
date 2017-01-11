@extends('layouts.user.home')

@section('game-section')
	@php ($i = 1)
	@foreach ($games as $game)
    	<div class="side-nav-row {{ $i%3 == 1 ? 'active-game' : '' }}">
			<div class="image-container">
				<img src="{!! url(env('UPLOAD_GAME_PATH', 'storage/games/').$game->image) !!}" />
		        <div class="image-overlay"></div>
		    </div>
		</div>
		@php ($i++)	
	@endforeach
@endsection
