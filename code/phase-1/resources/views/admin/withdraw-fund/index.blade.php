@extends('layouts.admin') 
@section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				@include('layouts.message')
				<h2 class="page-title">Withdraw Fund Requests</h2>
				<!-- Zero Configuration Table -->
				<div class="panel panel-default">
					<div class="panel-body">
						<table id="withdraw-fund-table"class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>ID</th>
									<th>Date</th>
									<th>User</th>
									<th>Coin Requested</th>
									<th>Total Amount</th>
									<th>ESC Charges</th>
									<th>Amount Given</th>
									<th>Status</th>
									<th>Actions</th>
									<th>Account No</th>
									<th>Account Name</th>
									<th>SWIFT Code</th>
									<th>Paypal ID</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($withdrawFundRequests as $withdrawFundRequest)
									<tr>
										<td>{{ $withdrawFundRequest->id }}</td>
										<td>{{ $withdrawFundRequest->created_at }}</td>
										<td>{{ $withdrawFundRequest->user->email }}</td>
										<td>{{ $withdrawFundRequest->coins }}</td>
										<td>${{ $withdrawFundRequest->total_amount }}</td>
										<td>${{ $withdrawFundRequest->esc_charge }}</td>
										<td>${{ $withdrawFundRequest->amount_given }}</td>
										<td>{{ $withdrawFundRequest->status }}</td>
										<td>
											<a title="View" href="{{ url('admin/withdraw-fund/view/'.$withdrawFundRequest->id) }}"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a> |
											<a title="Bank Details" href="{{ url('admin/withdraw-fund/bank-details/'.$withdrawFundRequest->id) }}"><i class="fa fa-university fa-lg" aria-hidden="true"></i></a> 
										</td>
										<td>
											@if(isset($withdrawFundRequest->user->userBankDetails) && $withdrawFundRequest->user->userBankDetails->account_no != '')
												{{ decrypt($withdrawFundRequest->user->userBankDetails->account_no) }}
											@else
												{{ '' }}
											@endif
										</td>
										<td>
											@if(isset($withdrawFundRequest->user->userBankDetails) && $withdrawFundRequest->user->userBankDetails->account_name != '')
												{{ decrypt($withdrawFundRequest->user->userBankDetails->account_name) }}
											@else
												{{ '' }}
											@endif
										</td>
										<td>
											@if(isset($withdrawFundRequest->user->userBankDetails) && $withdrawFundRequest->user->userBankDetails->account_swift_code != '')
												{{ decrypt($withdrawFundRequest->user->userBankDetails->account_swift_code) }}
											@else
												{{ '' }}
											@endif
										</td>
										<td>
											@if(isset($withdrawFundRequest->user->userBankDetails) && $withdrawFundRequest->user->userBankDetails->paypal_id != '')
												{{ decrypt($withdrawFundRequest->user->userBankDetails->paypal_id) }}
											@else
												{{ '' }}
											@endif
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
