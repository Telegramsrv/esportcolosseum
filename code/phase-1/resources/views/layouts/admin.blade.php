<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>eSport - Admin</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="{!! asset('admin/css/font-awesome.min.css') !!}">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="{!! asset('admin/css/bootstrap.min.css') !!}">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="{!! asset('admin/css/dataTables.bootstrap.min.css') !!}">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="{!! asset('admin/css/bootstrap-social.css') !!}">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="{!! asset('admin/css/bootstrap-select.css') !!}">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="{!! asset('admin/css/fileinput.min.css') !!}">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="{!! asset('admin/css/awesome-bootstrap-checkbox.css') !!}">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="{!! asset('admin/css/style.css') !!}">
	<!-- Admin Custom Style -->
	<link rel="stylesheet" href="{!! asset('admin/css/custom.css') !!}">

	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
	<div class="brand clearfix">
		<a href="/" class="logo"><img src="{!! asset('user/images/logo.png') !!}" class="img-responsive" alt=""></a>
		<span class="menu-btn"><i class="fa fa-bars"></i></span>
		<ul class="ts-profile-nav">
			<li class="ts-account">
				<a href="#"><img src="{{ url(env('PROFILE_PICTURE_PATH'). (isset(Auth::user()->userDetails->user_image) ? Auth::user()->userDetails->user_image : '')) }}" class="ts-avatar hidden-side" alt=""> Account <i class="fa fa-angle-down hidden-side"></i></a>
				<ul>
					<li><a href="{{ url('admin/user/edit/'.Auth::user()->id) }}">My Account</a></li>
					<li><a href="{{ url('admin/user/changepassword') }}">Change Password</a></li>
					<li><a href="{{ url('logout') }}">Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<div class="ts-main-content">
		<nav class="ts-sidebar">
			<ul class="ts-sidebar-menu">
				<li class="ts-label">Main</li>
					@php $menu =  getMenu(); @endphp
					@foreach($menu as $item)
						<li class="{{setParentActive($item['path'], 'open')}}"><a href="/{{$item['url']}}"><i class="fa {{$item['icon']}}"></i> {{$item['name']}}</a>
						@php $subMenu =  getSubMenu($item['id']); @endphp
						 	@if (count($subMenu)) 
					            <ul>
						            @foreach ($subMenu as $subitem)
						                <li class="{{setActive($subitem['url'], 'open')}}"><a href="/{{ $subitem['url'] }}">{{ $subitem['name'] }}</a></li>
						            @endforeach
					            </ul>
					        @endif
						</li>
					@endforeach

				<!-- Account from above -->
				<ul class="ts-profile-nav">
					<li class="ts-account">
						<a href="#"><img src="img/ts-avatar.jpg" class="ts-avatar hidden-side" alt=""> Account <i class="fa fa-angle-down hidden-side"></i></a>
						<ul>
							<li><a href="{{ url('admin/user/edit/'.Auth::user()->id) }}">My Account</a></li>
							<li><a href="{{ url('admin/user/changepassword') }}">Change Password</a></li>
							<li><a href="{{ url('logout') }}">Logout</a></li>
						</ul>
					</li>
				</ul>

			</ul>
		</nav>
		
		@yield('content')	
		
	</div>
	
    @yield('footer')
    
    <!-- Loading Scripts -->
	<script src="{!! asset('admin/js/jquery.min.js') !!}"></script>
	<script src="{!! asset('admin/js/bootstrap-select.min.js') !!}"></script>
	<script src="{!! asset('admin/js/bootstrap.min.js') !!}"></script>
	<script src="{!! asset('admin/js/jquery.dataTables.min.js') !!}"></script>
	<script src="{!! asset('admin/js/dataTables.bootstrap.min.js') !!}"></script>
	<script src="{!! asset('admin/js/Chart.min.js') !!}"></script>
	<script src="{!! asset('admin/js/fileinput.js') !!}"></script>
	<script src="{!! asset('admin/js/chartData.js') !!}"></script>
	<script src="{!! asset('admin/js/ckeditor/ckeditor.js') !!}"></script>
	<script src="{!! asset('admin/js/main.js') !!}"></script>
	<script src="{!! asset('admin/js/custom.js') !!}"></script>
	<script>
		
	window.onload = function(){
    	if( document.getElementById("dashReport")){
			// Line chart from swirlData for dashReport
			var ctx = document.getElementById("dashReport").getContext("2d");
			window.myLine = new Chart(ctx).Line(swirlData, {
				responsive: true,
				scaleShowVerticalLines: false,
				scaleBeginAtZero : true,
				multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
			}); 
			
			// Pie Chart from doughutData
			var doctx = document.getElementById("chart-area3").getContext("2d");
			window.myDoughnut = new Chart(doctx).Pie(doughnutData, {responsive : true});
	
			// Dougnut Chart from doughnutData
			var doctx = document.getElementById("chart-area4").getContext("2d");
			window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {responsive : true});
    	}
	} 
	</script>
</body>
</html>
