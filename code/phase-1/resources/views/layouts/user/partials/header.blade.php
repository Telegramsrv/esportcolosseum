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
					@include("layouts.user.partials.notifications")
	            </li>
	            <li>
	            	<a href="#addFriendModal" class="white-text modal-trigger">
	            		<i class="fa fa-user" aria-hidden="true"></i> Add Friends
	            	</a>
	            </li>
	            <li>
	            	<a href="#addCoinModal" class="white-text  modal-trigger add-coins-button">
	            		<i class="fa fa-usd" aria-hidden="true"></i> Add Coins
	            	</a>
	            </li>
	            <li>
	            	<a href="#" class="white-text" title="Coins">
	            		<i class="fa fa-circle-o" aria-hidden="true"></i> {{ isset(Auth::user()->userDetails->coins) ? Auth::user()->userDetails->coins : 0 }}
	            	</a>
	            </li>
	            <li>
	            	<a href="javascript:void(0);" class="white-text dropdown-button" data-activates="userMenu">
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
@if(Auth::check())
	<ul id="userMenu" class="dropdown-content">
	    <li><a href="{!! route('user.profile.edit') !!}">Personal Info</a></li>
	    <li><a href="{!! route('user.change-password.edit') !!}">Change Password</a></li>
	    <li><a href="#!">Game Settings</a></li>
	    <li><a href="{!! route('user.friends') !!}">My Friends</a></li>
	    <li><a href="#withdrawFundModal" class="modal-trigger withdraw-fund-button">Withdraw Fund</a></li>
	    <li class="divider"></li>
	    <li><a href="{!! route('user.ticket.list') !!}" class="modal-trigger">Support</a></li>
	    <li><a href="{!! route('logout') !!}">Logout</a></li>
	</ul>
@endif