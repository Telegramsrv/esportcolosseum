@extends('layouts.user.static-layout')
@section('static-content')
	<div class="row">
		{!! Form::open(['route' => 'user.ticket.save', 'method' => 'post']) !!}
			<div class="row">
				<div class="input-field col s12">
					@php($errorFormat = formatErrorMessage($errors, 'title'))
						
					{!! Form::text('title', null, ['class' => $errorFormat['formControlClass'], 'id' => 'title', 'name' => 'title']) !!}
					{!! Form::label('title', 'Subject', $errorFormat['validation']) !!}	
				</div>
			</div>
			
			<div class="row">
				<div class="input-field col s12">
					@php($errorFormat = formatErrorMessage($errors, 'description', 'materialize-textarea'))

					{!! Form::textarea('description', null, ['class' => $errorFormat['formControlClass'], 'id' => 'description', 'name' => 'description']) !!}
					{!! Form::label('description', 'Address 1', $errorFormat['validation']) !!}
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
@endsection