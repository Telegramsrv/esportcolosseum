@extends('layouts.admin') 
@section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				@include('layouts.message')
				<h2 class="page-title">Esc challenge Templates</h2>
				<!-- Zero Configuration Table -->
				<div class="panel panel-default">
					<div class="panel-body">
						<table id="zctb"
							class="display table table-striped table-bordered table-hover"
							cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>#</th>
									<th>Joining Coins</th>
									<th>Winning Coins</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($escChallengeTemplates as $key => $escChallengeTemplate)
									<tr>
										<td>{{$key+1}}</td>
										<td>{{ $escChallengeTemplate->joining_coins }}</td>
										<td>{{ $escChallengeTemplate->winning_coins }}</td>
										<td>
											<a title="Edit" href="{{ url('admin/esc-challenge-template/edit/'.$escChallengeTemplate->id) }}"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></a> | 
											<a title="Delete" href="#" onClick="return deleteEscChallengeTemplate({{ $escChallengeTemplate->id }});" ><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
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
