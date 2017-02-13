@extends('layouts.admin') @section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				@include('layouts.message')
				<h2 class="page-title">User Details</h2>
				<b>Email : </b> {{ $bankData->email }}  <br>
				<b>Full Name : </b> {{ $bankData->full_name }}  <br>
				<b>Phone : </b> {{ $bankData->mobile_number }}  <br>
				
				<hr>
				
				<h2 class="page-title">Bank Details</h2>
				<b>Account No : </b> {{ $bankData->account_no }}  <br>
				<b>Account Name : </b> {{ $bankData->account_name }}  <br>
				<b>Account SWIFT Code : </b> {!! $bankData->account_swift_code !!}  <br>
				<b>Paypal ID : </b> {{ $bankData->paypal_id }}  <br>
				<hr>
			</div>
		</div>
	</div>
</div>

@endsection @section('footer') 
@endsection