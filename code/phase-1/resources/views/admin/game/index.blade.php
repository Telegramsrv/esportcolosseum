@extends('layouts.admin') 
@section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				@include('layouts.message')
				<h2 class="page-title">Games</h2>
				<!-- Zero Configuration Table -->
				<div class="panel panel-default">
					<div class="panel-body">
						<table id="zctb"
							class="display table table-striped table-bordered table-hover"
							cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Slug</th>
									<th>Image</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($games as $key => $game)
									<tr>
										<td>{{$key+1}}</td>
										<td>{{ $game->name }}</td>
										<td>{{ $game->slug }}</td>
										<td><img class="game-disply-image" src="{{ url(env('UPLOAD_GAME_THUMBNAIL').$game->image) }}"></td>
										<td>{{ $game->status }}</td>
										<td>
											<a title="Edit" href="{{ url('admin/game/edit/'.$game->id) }}"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></a> | 
											<a title="Delete" href="#" onClick="return deleteGame({{ $game->id }});" ><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
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
