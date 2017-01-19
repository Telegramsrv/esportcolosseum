@extends('layouts.admin') 
@section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				@include('layouts.message')
				<h2 class="page-title">Pages</h2>
				<div class="panel panel-default">
					<div class="panel-body">
						<table id="zctb"
							class="display table table-striped table-bordered table-hover"
							cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>ID</th>
									<th>Title</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($pages as $page)
									<tr>
										<td>{{ $page->id }}</td>
										<td>{{ $page->title }}</td>
										<td>
											<a title="Edit" href="{{ url('admin/page/edit/'.$page->id) }}"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></a> | 
											<a title="Delete" href="#" onClick="return deletePage({{ $page->id }});" ><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
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
