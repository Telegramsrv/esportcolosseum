@extends('layouts.admin') @section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				@include('layouts.message')
				<h2 class="page-title">View Request</h2>
				<div class="panel panel-default">
					<div class="panel-body">
						{!! Form::model($withdrawFundRequest, ['route' => ['admin.withdraw-fund.update', $withdrawFundRequest->id], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                         	<div class="form-group">
	                        	{!! Form::label('User Email', 'User Email:', ['class' => 'col-sm-2 control-label']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('user_id', $withdrawFundRequest->user->email, ['class'=>'form-control mb', 'disabled'=>'disabled'] ); !!}
	                            </div>
	                        </div>
	                        
	                        <div class="form-group">
	                        	{!! Form::label('Requested Coins', 'Requested Coins:', ['class' => 'col-sm-2 control-label']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('coins', null, ['class'=>'form-control mb', 'disabled'=>'disabled'] ); !!}
	                            </div>
	                        </div>
	                        
	                        <div class="form-group">
	                        	{!! Form::label('Coins/$1', 'Coins/$1:', ['class' => 'col-sm-2 control-label']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('coins_per_dollar', null, ['class'=>'form-control mb', 'disabled'=>'disabled'] ); !!}
	                            </div>
	                        </div>
	                        
	                        <div class="form-group">
	                        	{!! Form::label('Total Amount', 'Total Amount($):', ['class' => 'col-sm-2 control-label']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('total_amount', null, ['class'=>'form-control mb', 'disabled'=>'disabled'] ); !!}
	                            </div>
	                        </div>
	                        
	                        <div class="form-group">
	                        	{!! Form::label('Service Charge', 'Service Charge(%):', ['class' => 'col-sm-2 control-label']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('service_charge', null, ['class'=>'form-control mb', 'disabled'=>'disabled'] ); !!}
	                            </div>
	                        </div>
	                        
	                        <div class="form-group">
	                        	{!! Form::label('ESC Charge', 'ESC Charge($):', ['class' => 'col-sm-2 control-label']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('esc_charge', null, ['class'=>'form-control mb', 'disabled'=>'disabled'] ); !!}
	                            </div>
	                        </div>
	                        
	                        <div class="form-group">
	                        	{!! Form::label('Amount Given', 'Amount Given($):', ['class' => 'col-sm-2 control-label']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('amount_given', null, ['class'=>'form-control mb', 'disabled'=>'disabled'] ); !!}
	                            </div>
	                        </div>
	                        
	                        <div class="form-group">
	                        	{!! Form::label('Requested Date', 'Requested Date:', ['class' => 'col-sm-2 control-label']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('created_at', null, ['class'=>'form-control mb', 'disabled'=>'disabled'] ); !!}
	                            </div>
	                        </div>
	                        
	                        <div class="form-group">
	                        	{!! Form::label('Status', 'Status:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{{ Form::select('status', array('InProcess' => 'InProcess', 'Completed' => 'Completed'), null, array('class' => 'form-control mb')) }}
	                            </div>
	                        </div>
                         	
							<div class="form-group">
								<div class="col-sm-8 col-sm-offset-2">
									<a class="btn btn-default button" href="/admin/withdraw-fund">Cancel</a>
									<button class="btn btn-primary" type="submit">Save changes</button>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection @section('footer') @endsection
