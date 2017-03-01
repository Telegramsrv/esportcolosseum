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
						<table border="0" class="display table table-striped table-bordered table-hover">
					        <tbody>
					        	<tr>
						            <td>From Date: <input type="text" id="dateStart" name="dateStart"></td>
						            <td>To Date: <input type="text" id="dateEnd" name="dateEnd"></td>
					        	</tr>
					        	<tr>
						            <td>Minimum Coin: <input type="text" id="minCoin" name="minCoin"></td>
						            <td>Maximum Coin: <input type="text" id="maxCoin" name="maxCoin"></td>
					        	</tr>
					    	</tbody>
					    </table>
    					<br>
						<table id="match-table" 
							class="display table table-striped table-bordered table-hover"
							cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Sr No</th>
									<th>Game Name</th>
									<th>Game Type</th>
									<th>Challenge Type</th>
									<th>Date and Time</th>
									<th>Challenger Name</th>
									<th>Acce pted</th>
									<th>Opponent Name</th>
									<th>Coin</th>
									<th>Status</th>
									<th>Result</th>
<!-- 									<th>Actions</th> -->
								</tr>
							</thead>
							<tbody>
								@php
									$srNo = 1;
								@endphp
								@foreach ($matches as $match)
									<tr>
										<td>{{ $srNo++ }}</td>
										<td>{{ $match->game->name }}</td>
										<td>{{ $match->challenge_type }}</td>
										<td>{{ $match->game_type }}</td>
										<td>
											@if( $match->challenge_type == 'esc')
												{{ $match->esc_date }}
											@else
												{{ $match->valid_upto }}
											@endif
										</td>
										<td>{{ $match->captainDetails->first_name.' '.$match->captainDetails->last_name }}</td>
										<td>
											@if($match->opponent_id > 0)
												Yes
											@else
												No
											@endif
										</td>
										<td>
											@if($match->opponent_id > 0)
												{{ $match->opponentDetails->first_name.' '.$match->opponentDetails->last_name }}
											@endif
										</td>
										<td>{{ $match->coins }}</td>
										<td>{{ $match->challenge_status }}</td>
										<td>
											@if( $match->winner_id > 0)
												@if( $match->winner_id == $match->user_id)
													{{ $match->captainDetails->first_name.' '.$match->captainDetails->last_name }}
												@else
													{{ $match->opponentDetails->first_name.' '.$match->opponentDetails->last_name }}
												@endif
											@endif
										</td>
<!--  										<td> -->
<!--  											<a title="Edit" href="{{ url('admin/match/edit/'.$match->id) }}"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></a>  -->
<!--  										</td> -->
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
