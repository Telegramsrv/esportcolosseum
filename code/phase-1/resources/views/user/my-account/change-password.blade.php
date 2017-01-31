@extends('layouts.user.static-layout', ['displayLeftSidebar' => false])
@section('static-content')
	<div class="tab-content col s12 m10">
		<div class="section-title">Change <span>Password</span></div>
		<div class="row">
			{!! Form::open(['route' => 'user.change-password.update', 'method' => 'put']) !!}
				<div class="row">
					<div class="input-field col s12 m6">
						@php($errorFormat = formatErrorMessage($errors, 'old_password'))
							
						{!! Form::password('old_password', ['class' => 'black-text ' . $errorFormat['formControlClass'], 'id' => 'old_password', 'name' => 'old_password']) !!}
						{!! Form::label('old_password', 'Current Password', $errorFormat['validation']) !!}	
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12 m6">
						@php($errorFormat = formatErrorMessage($errors, 'password'))
							
						{!! Form::password('password', ['class' => 'black-text ' . $errorFormat['formControlClass'], 'id' => 'password', 'name' => 'password']) !!}
						{!! Form::label('password', 'New Password', $errorFormat['validation']) !!}	
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12 m6">
						@php($errorFormat = formatErrorMessage($errors, 'password_confirmation'))
							
						{!! Form::password('password_confirmation', ['class' => 'black-text ' . $errorFormat['formControlClass'], 'id' => 'password_confirmation', 'name' => 'password_confirmation']) !!}
						{!! Form::label('password_confirmation', 'Confirm Password', $errorFormat['validation']) !!}	
					</div>
				</div>
				<div class="row">
					<div class="input-field col s2">
						<button class="waves-effect waves-light btn-large btn-full deep-orange darken-4" type="submit">Submit</button>
					</div>
					<div class="input-field col s2">
						<a href="{!! route('user.dashboard') !!}" class="waves-effect waves-light btn-large btn-full deep-orange darken-4">Cancel</a>
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@endsection