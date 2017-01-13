@extends('layouts.admin') 
@section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				@include('layouts.message')
				<h2 class="page-title">Blogs</h2>
				<!-- Zero Configuration Table -->
				<div class="panel panel-default">
					<div class="panel-body">
						<table id="zctb"
							class="display table table-striped table-bordered table-hover"
							cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Title</th>
									<th>User</th>
									<th>Description</th>
									<th>Display Image</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($blogs as $blog)
									<tr>
										<td>{{ $blog->title }}</td>
										<td>{{ $blog->user->email }}</td>
										<td>{{ $blog->description}}</td>
										<td>{{ '' }}</td>
										<td>
											<a title="Edit" href="{{ url('admin/user/edit/'.$user->id) }}"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></a> | 
											<a title="Delete" href="#" onClick="return deleteUser({{ $user->id }});" ><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
										</td>
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
