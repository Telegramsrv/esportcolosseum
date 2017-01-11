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
		<a href="/" class="logo"><img src="{!! asset('admin/img/logo.jpg') !!}" class="img-responsive" alt=""></a>
		<span class="menu-btn"><i class="fa fa-bars"></i></span>
		<ul class="ts-profile-nav">
			<li class="ts-account">
				<a href="#"><img src="{!! asset('admin/img/ts-avatar.jpg') !!}" class="ts-avatar hidden-side" alt=""> Account <i class="fa fa-angle-down hidden-side"></i></a>
				<ul>
<!-- 					<li><a href="#">My Account</a></li> -->
<!-- 					<li><a href="#">Edit Account</a></li> -->
					<li><a href="{{ url('logout') }}">Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<div class="ts-main-content">
		<nav class="ts-sidebar">
			<ul class="ts-sidebar-menu">
				<li class="ts-label">Main</li>
				<li class="open"><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><a href="#"><i class="fa fa-desktop"></i> User Manager</a>
					<ul>
						<li><a href="{{ url('/admin/user') }}">User List</a></li>
						<li><a href="{{ url('/admin/user/add') }}">Add New User</a></li>
					</ul>
				</li>

				<!-- Account from above -->
				<ul class="ts-profile-nav">
					<li class="ts-account">
						<a href="#"><img src="img/ts-avatar.jpg" class="ts-avatar hidden-side" alt=""> Account <i class="fa fa-angle-down hidden-side"></i></a>
						<ul>
<!-- 							<li><a href="#">My Account</a></li> -->
<!-- 							<li><a href="#">Edit Account</a></li> -->
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
