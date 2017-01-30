<nav class="nav-bar blue-grey darken-4" role="navigation">
    		<div class="nav-wrapper">
				<div class="onclick-open-sidebar">
					<button id='show_sidebar' class="btn btn-default">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					@if($gameRequire == true)
					<div class="show_sidebar_onclick hidden">
						@include("user.partials.game", ['games' => $games]);
					</div>
					@endif
				</div>
        		<a id="logo-container" href="{!! route('user.home') !!}" class="brand-logo">
        			<img src="{!! asset('user/images/logo.png') !!}" />
        		</a>
        		@if (Auth::check())
		        	<ul class="right">
			            <li>
			            	<a href="#!" class="white-text">
			            		<i class="fa fa-bell-o" aria-hidden="true"></i>
			            	</a>
			            </li>
			            <li>
			            	<a href="#addCoinModal" class="white-text  modal-trigger">
			            		<i class="fa fa-usd" aria-hidden="true"></i> AddCoins
			            	</a>
			            </li>
			            <li>
			            	<a href="#!" class="white-text dropdown-button" data-activates="userMenu">
			            		<i class="fa fa-user-secret" aria-hidden="true"></i> 
			            		{!! Auth::user()->userDetails->first_name !!} {!! Auth::user()->userDetails->last_name !!}
			            	</a>
			            </li>
			        </ul>
				@else
					<ul class="right">
						<li>
							<a href="{!! route('user.home') !!}" class="white-text dropdown-button">
			            		<i class="fa fa-user-secret" aria-hidden="true"></i> Login
			            	</a>
			            </li>	
		            </ul>	
				@endif
    		</div>
  		</nav>