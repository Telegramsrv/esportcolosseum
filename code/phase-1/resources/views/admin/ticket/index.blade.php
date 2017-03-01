@extends('layouts.admin') 
@section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				@include('layouts.message')
				<h2 class="page-title">Tickets</h2>
				<!-- Zero Configuration Table -->
				<div class="panel panel-default">
					<div class="panel-body">
						<table id="ticket-table" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>ID</th>
									<th>Title</th>
									<th>From</th>
									<th>Status</th>
									<th>Created Time</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($tickets as $ticket)
									<tr>
										<td>{{ md5($ticket->id) }}</td>
										<td>{{ $ticket->title }}</td>
										<td>{{ $ticket->user->email }}</td>
										<td>{{ $ticket->status }}</td>
										<td>{{ $ticket->created_at }}</td>
										<td>
											<a title="View" href="{{ url('admin/ticket/view/'.$ticket->id) }}"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a> |
											<a title="Reply" href="{{ url('admin/ticket/conversation/'.$ticket->id) }}"><i class="fa fa-reply fa-lg" aria-hidden="true"></i></a> 
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
