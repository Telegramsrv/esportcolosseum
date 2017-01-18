@extends('layouts.admin') @section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				@include('layouts.message')
				<h2 class="page-title">View Ticket Conversations</h2>
				
				@if(count($conversations) > 0)
					@foreach ($conversations as $conversation)
						<b>From : </b> {{ $conversation->reply_by }}  <br>
						<b>Subject : </b> {{ $conversation->subject }}  <br>
						<b>Description : </b> {!! $conversation->description !!}  <br>
						<b>Date : </b> {{ $conversation->created_at }}  <br>
						<hr>
					@endforeach
				@else
					No Converstions Found.
				@endif
						
						
				<div class="panel panel-default">
						
					<div class="panel-body">
					
						{!! Form::model($ticket, ['route' => ['admin.ticket.conversation.update', $ticket->id], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                         	<div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
	                        	{!! Form::label('Subject', 'Subject:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('subject', 'Re: ' . $ticket->title, ['class'=>'form-control mb'] ); !!}
	                        		@if ($errors->has('subject'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('subject') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        
	                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
	                        	{!! Form::label('Description', 'Description:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::textarea('description', '', ['class'=>'form-control mb', 'id' => 'ticket-description'] ); !!}
	                        		@if ($errors->has('description'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('description') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
                         	
							<div class="form-group">
								<div class="col-sm-8 col-sm-offset-2">
									<a class="btn btn-default button" href="/admin/tickets">Cancel</a>
									<button class="btn btn-primary" type="submit">Reply</button>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection @section('footer') 
<style>
<!--
ul, ul li, ol li {
	list-style: inherit;
	margin: inherit;
	padding: inherit;
}

ol {
	padding: 0px 15px;
}
-->
</style>
@endsection
