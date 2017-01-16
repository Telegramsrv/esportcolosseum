<div class="left-side-nav {!! $extraClass or '' !!}">
	<div class="btn_area">
	  	<div class="card-panel hoverable nav-bar-card deep-orange darken-4">
	    	<div class="sidebar-title text-shadow">GAMES</div>
	  	</div>
	</div>
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
</div>