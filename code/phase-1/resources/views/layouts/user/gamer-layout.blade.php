<!DOCTYPE html>
<html lang="en">
	<head>
  		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
	    <!--	 CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
	    <title>{{ config('app.name', 'Laravel') }}</title>
	    <!-- Styles -->

	    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="{!! asset('user/css/materialize.css') !!}" type="text/css" rel="stylesheet" media="screen,projection	" />
		<link href="{!! asset('user/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet" />
		<link href="{!! asset('user/css/flags.css') !!}" rel="stylesheet" />
		<link href="{!! asset('user/css/style.css') !!}" type="text/css" rel="stylesheet" media="screen,projection" />
		<link href="{!! asset('user/css/dashboard.css') !!}" type="text/css" rel="stylesheet" media="screen,projection"/>
		<link href="{!! asset('user/css/challenge.css') !!}" type="text/css" rel="stylesheet" media="screen,projection"/>
		<link href="{!! asset('user/css/profile.css') !!}" type="text/css" rel="stylesheet" media="screen,projection"/>
		<link href="{!! asset('user/css/esportcolosseum.css') !!}" type="text/css" rel="stylesheet" />

		<link rel="stylesheet" type="text/css" media="screen and (min-width: 992px) and (max-width: 1199px) "
              href="{!! asset('user/css/media/medium-devices.css') !!}"/>
    	<link rel="stylesheet" type="text/css" media="screen and (min-width: 768px) and (max-width: 991px)"
              href="{!! asset('user/css/media/tablet-devices.css') !!}"/>
    	<link rel="stylesheet" type="text/css" media="screen and (min-width: 640px) and (max-width: 767px)"
              href="{!! asset('user/css/media/mobile-devices.css') !!}"/>
    	<link rel="stylesheet" type="text/css" media="screen and (min-width: 440px) and (max-width: 639px)"
              href="{!! asset('user/css/media/indriodt-devices.css') !!}"/>
    	<link rel="stylesheet" type="text/css" media="screen and (min-width: 350px) and (max-width: 439px)"
              href="{!! asset('user/css/media/mini-indriod-devices.css') !!}"/>
    	<link rel="stylesheet" type="text/css" media="screen and (min-width: 1px) and (max-width: 349px)"
              href="{!! asset('user/css/media/small-mobiles.css') !!}"/>

		<!-- Scripts -->
	    <script>
	        window.Laravel = <?php echo json_encode([
	            'csrfToken' => csrf_token(),
	        ]); ?>
	    </script>
	</head>
	<body class="dashboard_page {!! $bodyClass or '' !!} clearfix">
		@include('layouts.user.partials.header', ['gameRequire' => true, 'games' => $games])
		<div class="no-pad-bot main-container" style="overflow:hidden;">
			<div class="display_for_mobile">
				@include("user.partials.game", ['games' => $games, 'extraClass' => 'mobile_res'])
			</div>
			<div class="main-content">
				@yield("game-info")
				@yield("game-challenge")
		        @yield("gamer-content")
			</div>
		</div>
		@include('layouts.user.partials.footer')
		@include('layouts.user.partials.add-coin')
		@include('layouts.user.partials.add-friend')
		@include('layouts.user.partials.add-team')
		@yield('create-game-challenge')
		
		
		<script type="text/javascript" src="{!! asset('user/js/jquery.min.js') !!}"></script>
		<script type="text/javascript" src="{!! asset('user/js/bootstrap.min.js') !!}"></script>
		<script type="text/javascript" src="{!! asset('user/js/materialize.js') !!}"></script>
		<script type="text/javascript" src="{!! asset('user/js/init.js') !!}"></script>
		<script type="text/javascript" src="{!! asset('user/js/dashboard.js') !!}"></script>
		<!-- <script type="text/javascript" src="{!! asset('user/js/challenge-list.js') !!}"></script> -->
		<script type="text/javascript" src="{!! asset('user/js/esportcolosseum.js') !!}"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('ul.tabs').each(function(){
  					// For each set of tabs, we want to keep track of
  					// which tab is active and its associated content
  					var $active, $content, $links = $(this).find('a');

					// If the location.hash matches one of the links, use that as the active tab.
					// If no match is found, use the first link as the initial active tab.
					$active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
  					$active.addClass('active');

  					$content = $($active[0].hash);

  					// Hide the remaining content
  					$links.not($active).each(function () {
    					$(this.hash).hide();
  					});

  					// Bind the click event handler
  					$(this).on('click', 'a', function(e){
    					// Make the old tab inactive.
    					$active.removeClass('active');
    					$content.hide();

    					// Update the variables with the new link and content
    					$active = $(this);
    					$content = $(this.hash);

					    // Make the tab active.
					    $active.addClass('active');
					    $content.show();

    					// Prevent the anchor's default click action
    					e.preventDefault();
  					});
				});	

				$(document).ready(function(){
					$("#show_sidebar").click(function(){
		 				$('.show_sidebar_onclick').toggleClass('hidden');
					});
				});

				$( document.body ).on( 'click', '.dropdown-menu li', function( event ) {
   					var $target = $( event.currentTarget );
   					$target.closest( '.btn-group' )
      					.find( '[data-bind="label"]' ).text( $target.text() )
         				.end()
      					.children( '.dropdown-toggle' ).dropdown( 'toggle' );
   					return false;
				});

				$('#leave').on('change', function() {
    				var tab=$(this).find(":checked").val();
					if(tab=="tab1"){
						$("#tab1").css("display", "block");
						$("#tab2").css("display", "none");
					}
					else{
						$("#tab1").css("display", "none");
						$("#tab2").css("display", "block");
					}
				});
			});
		</script>
	</body>
</html>