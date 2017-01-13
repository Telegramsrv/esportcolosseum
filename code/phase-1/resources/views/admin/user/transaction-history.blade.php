@extends('layouts.admin') 
@section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				@include('layouts.message')
				<h2 class="page-title">Coin Transaction</h2>
				<!-- Zero Configuration Table -->
				<div class="panel panel-default">
					<div class="panel-body">
						<table id="zctb"
							class="display table table-striped table-bordered table-hover"
							cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>#</th>
									<th>Source</th>
									<th>Coins</th>
									<th>transaction_type</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($coinTransactions as $key => $transaction)
									<tr>
										<td>{{$key+1}}</td>
										<td>{{ isset($transaction->SourceTypes->name) ? $transaction->SourceTypes->name : '' }}</td>
										<td>{{ isset($transaction->coins) ? $transaction->coins: 0}}</td>
										<td>{{ isset($transaction->transaction_type) ? $transaction->transaction_type : '' }}</td>
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
