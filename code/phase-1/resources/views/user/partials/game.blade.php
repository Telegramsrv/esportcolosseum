<div class="left-side-nav {!! $extraClass or '' !!}">
	<div class="btn_area">
	  	<div class="card-panel hoverable nav-bar-card deep-orange darken-4">
	    	<div class="sidebar-title text-shadow">GAMES</div>
	  	</div>
	</div>
	@php ($i = 1)
	@php ($navigation = [])
	
	@foreach ($games as $game)
		@php($navigation = setNavigationForGame($game->slug), 'active-game', ''))
		<div class="side-nav-row {!! $navigation['class'] !!}">
			<div class="image-container">
				<a href="{!! $navigation['url'] !!}">
					<img src="{!! url(env('UPLOAD_GAME_PATH', 'storage/games/').$game->image) !!}" />
					<div class="image-overlay"></div>
				</a>
			</div>
		</div>
		@php ($i++)	
	@endforeach
</div>