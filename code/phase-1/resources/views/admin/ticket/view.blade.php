@extends('layouts.admin') @section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				@include('layouts.message')
				<h2 class="page-title">View Ticket</h2>
				<div class="panel panel-default">
					<div class="panel-body">
						{!! Form::model($ticket, ['route' => ['admin.ticket.update', $ticket->id], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                         	<div class="form-group">
	                        	{!! Form::label('Title', 'Title:', ['class' => 'col-sm-2 control-label']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('title', null, ['class'=>'form-control mb', 'disabled'=>'disabled'] ); !!}
	                            </div>
	                        </div>
	                        
	                        <div class="form-group">
	                        	{!! Form::label('From', 'From:', ['class' => 'col-sm-2 control-label']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('user_id', $ticket->user->email, ['class'=>'form-control mb', 'disabled'=>'disabled'] ); !!}
	                            </div>
	                        </div>
	                        
	                        <div class="form-group">
	                        	{!! Form::label('Description', 'Description:', ['class' => 'col-sm-2 control-label']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::textarea('description', null, ['class'=>'form-control mb', 'disabled'=>'disabled'] ); !!}
	                            </div>
	                        </div>
	                        
	                        <div class="form-group">
	                        	{!! Form::label('Status', 'Status:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{{ Form::select('status', array('Open' => 'Open', 'Inprogress' => 'Inprogress', 'Closed' => 'Closed'), null, array('class' => 'form-control mb')) }}
	                            </div>
	                        </div>
	                        
                         	
							<div class="form-group">
								<div class="col-sm-8 col-sm-offset-2">
									<a class="btn btn-default button" href="/admin/tickets">Cancel</a>
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
