@extends('layouts.admin') 
@section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				@include('layouts.message')
				<h2 class="page-title">Matches</h2>
				<div class="panel panel-default">
					<div class="panel-body">
						<table id="zctb"
							class="display table table-striped table-bordered table-hover"
							cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Challenger</th>
									<th>Game</th>
									<th>Game Type</th>
									<th>Coins</th>
									<th>Status</th>
									<th>Valid Upto</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($matches as $match)
									<tr>
										<td>{{ $match->captain->email }}</td>
										<td>{{ $match->game->name }}</td>
										<td>{{ $match->game_type }}</td>
										<td>{{ $match->coins }}</td>
										<td>{{ $match->challenge_status }}</td>
										<td>{{ $match->valid_upto }}</td>
 										<td>
 											<a title="Edit" href="{{ url('admin/match/edit/'.$match->id) }}"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></a> 
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
