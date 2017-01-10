@extends('layouts.admin') 
@section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h2 class="page-title">Users</h2>
				<!-- Zero Configuration Table -->
				<div class="panel panel-default">
					<div class="panel-body">
						<table id="zctb"
							class="display table table-striped table-bordered table-hover"
							cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Email</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Coins</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($users as $user)
									<tr>
										<td>{{ $user->email }}</td>
										<td>{{ $user->userDetails->first_name }}</td>
										<td>{{ $user->userDetails->last_name }}</td>
										<td>{{ $user->userDetails->coins }}</td>
										<td>{{ $user->status }}</td>
										<td><a href="{{ url('admin/user/edit/'.$user->id) }}"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></a> | <a href="{{ url('admin/user/delete') }}"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a></td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection 
@section('footer') 
@endsection
