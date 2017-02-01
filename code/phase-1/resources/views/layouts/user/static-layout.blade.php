<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
	    <!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
	    <title>{{ config('app.name', 'Laravel') }}</title>
	    <!-- Styles -->

	    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="{!! asset('user/css/materialize.css') !!}" type="text/css" rel="stylesheet" media="screen,projection" />
		<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/zf/jq-2.2.4/dt-1.10.13/datatables.min.css"/> -->
		<link href="{!! asset('user/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet" />
		<link href="{!! asset('user/css/dashboard.css') !!}" type="text/css" rel="stylesheet" media="screen,projection"/>
		<link href="{!! asset('user/css/style.css') !!}" type="text/css" rel="stylesheet" media="screen,projection" />
		<link href="{!! asset('user/css/static.css') !!}" type="text/css" rel="stylesheet" media="screen,projection"/>
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
	<body>
		<div class="static_page clearfix">
			@include('layouts.user.partials.header', ['gameRequire' => false])
			<div class="no-pad-bot main-container" style="overflow:hidden;" > 
				<div class="row">
					<div class="static_container nav-wrapper">
						<div class="col s12 m2">
							@if(!isset($displayLeftSidebar) || $displayLeftSidebar)
								<ul class="nav nav-pills nav-stacked">
		                			<li class="{!! setActive(['blog/*', 'blog'], 'active') !!}">
		                				<a href="{!! route('blog-listing') !!}">Blogs</a>
		                			</li>
		                			<li><a href="#" class="">Faq</a></li>
		                			<li><a href="#" class="">press</a></li>
		                			<li><a href="#" class="">carEers</a></li>
		                			<li><a href="#" class="">privacy policy</a></li>
		                			<li><a href="#" class="">legal terms</a></li>
		              			</ul>
		              		@endif
              			</div>
              			@yield('static-content')
					</div>
				</div>
			</div>
		</div>
		@include('layouts.user.partials.footer')
		@include('layouts.user.partials.add-coin')
		@include('layouts.user.partials.add-friend')
		<script type="text/javascript" src="{!! asset('user/js/jquery.min.js') !!}"></script>
		<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/zf/jq-2.2.4/dt-1.10.13/datatables.min.js"></script> -->
		<script type="text/javascript" src="{!! asset('user/js/materialize.js') !!}"></script>
		<script type="text/javascript" src="{!! asset('user/js/init.js') !!}"></script>
		<script type="text/javascript" src="{!! asset('user/js/esportcolosseum.js') !!}"></script>
	</body>
</html>