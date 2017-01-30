@extends('layouts.user.static-layout', ['displayLeftSidebar' => false])
@section('static-content')
	<div class="tab-content col s12 m12">
		<div class="section-title">Generate <span>ticket/ Support</span></div>
		<div class="row">
			<div class="row">
				<div class="col s12">
					<h3 class="page-title"> {{ $ticket->title }} </h3>
					<div class="col s6">
					 	<p><strong>Owner:</strong> {{ $ticket->user->email }} </p>
					</div>
					<div class="col s6">
					 	<p><strong>Created:</strong> {{ $ticket->created_at->diffForHumans() }} </p>
					 	<p><strong>Last Update:</strong> {{ $ticket->updated_at->diffForHumans() }} </p>
					</div>
					<div class="row">
				        <div class="col s12">
					         <div class="card">
							    <div class="card-block">
							        <p class="card-text">{!! $ticket->description !!}</p>
							    </div>
							</div>
				        </div>
				      </div>
				</div>
			</div>
			<div class="row">
				@if(count($ticketConversations) > 0)
					<hr class="full-width">
					<h2 class="page-title">Comments</h2>
					@foreach ($ticketConversations as $conversation)
					 <div class="row">
				        <div class="col s12">
					         <div class="card">
					         	<h3 class="card-header primary-color">
							       <span class="left">{{ $conversation->reply_by }}</span> 
							       <span class="right">{{ $conversation->updated_at->diffForHumans() }}</span> 
							    </h3>
							    <div class="card-block">
							        <p class="card-text">{!! $conversation->description !!}</p>
							    </div>
							</div>
				        </div>
				      </div>
					@endforeach
				@endif
			</div>
			<hr class="full-width">
			<h2 class="page-title">Replay</h2>
			{!! Form::model($ticket, ['route' => ['user.ticket.update', md5($ticket->id)], 'method' => 'PUT']) !!}
				<div class="row">
					<div class="input-field col s12">
						@php($errorFormat = formatErrorMessage($errors, 'description', 'materialize-textarea'))
	
						{!! Form::textarea('description', '', ['class' => 'black-text ' . $errorFormat['formControlClass'], 'id' => 'description', 'name' => 'description']) !!}
						{!! Form::label('description', 'Message', $errorFormat['validation']) !!}
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						{{ Form::select('status', array('Open' => 'Open', 'Inprogress' => 'Inprogress', 'Closed' => 'Closed'), null, array('class' => 'form-control mb')) }}
						{!! Form::label('Status', 'Status:', ['class' => 'col-sm-2 control-label required']) !!}
					</div>
				</div>
		                        
				<div class="row">
					<div class="input-field col s2">
						<button class="waves-effect waves-light btn-large btn-full deep-orange darken-4" type="submit">Submit</button>
					</div>
					<div class="input-field col s2">
						<a href="{!! route('user.ticket.list') !!}" class="waves-effect waves-light btn-large btn-full deep-orange darken-4">Cancel</a>
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>	
@endsection