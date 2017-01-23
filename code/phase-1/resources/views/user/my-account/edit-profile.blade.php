@extends('layouts.user.static-layout')
@section('static-content')
	<div class="row">
		{!! Form::model($userDetails, ['route' => 'user.profile.update', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
			<div class="row">
				<div class="input-field col s12 m6">
					@php($errorFormat = formatErrorMessage($errors, 'first_name'))
						
					{!! Form::text('first_name', null, ['class' => $errorFormat['formControlClass'], 'id' => 'first_name', 'name' => 'first_name']) !!}
					{!! Form::label('first_name', 'First Name', $errorFormat['validation']) !!}	
				</div>
				<div class="input-field col s12 m6">
					@php($errorFormat = formatErrorMessage($errors, 'last_name'))	

					{!! Form::text('last_name', null, ['class' => $errorFormat['formControlClass'], 'id' => 'last_name', 'name' => 'last_name']) !!}
					{!! Form::label('last_name', 'Last Name', $errorFormat['validation']) !!}
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12 m6">
					@php($errorFormat = formatErrorMessage($errors, 'gamer_name'))	

					{!! Form::text('gamer_name', null, ['class' => $errorFormat['formControlClass'], 'id' => 'gamer_name', 'name' => 'gamer_name']) !!}
					{!! Form::label('gamer_name', 'Gamer Name', $errorFormat['validation']) !!}
				</div>
				<div class="input-field col s12 m6">
					@php($errorFormat = formatErrorMessage($errors, 'mobile_number'))

					{!! Form::text('mobile_number', null, ['class' => $errorFormat['formControlClass'], 'id' => 'mobile_number', 'name' => 'mobile_number']) !!}
					{!! Form::label('mobile_number', 'Mobile', $errorFormat['validation']) !!}
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12 m6">
					@php($errorFormat = formatErrorMessage($errors, 'address_1', 'materialize-textarea'))

					{!! Form::textarea('address_1', null, ['class' => $errorFormat['formControlClass'], 'id' => 'address_1', 'name' => 'address_1']) !!}
					{!! Form::label('address_1', 'Address 1', $errorFormat['validation']) !!}
				</div>
				<div class="input-field col s12 m6">
					{!! Form::textarea('address_2', null, ['class' => 'validate materialize-textarea', 'id' => 'address_2', 'name' => 'address_2']) !!}
					{!! Form::label('address_2', 'Address 2:') !!}
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12 m6">
					@php($errorFormat = formatErrorMessage($errors, 'pincode'))

					{!! Form::text('pincode', null, ['class' => $errorFormat['formControlClass'], 'id' => 'pincode', 'name' => 'pincode']) !!}
					{!! Form::label('pincode', 'Pincode', $errorFormat['validation']) !!}
				</div>
				<div class="input-field col s12 m6">
					@php($errorFormat = formatErrorMessage($errors, 'city'))

					{!! Form::text('city', null, ['class' => $errorFormat['formControlClass'], 'id' => 'city', 'name' => 'city']) !!}
					{!! Form::label('city', 'City', $errorFormat['validation']) !!}
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12 m6">
					@php($errorFormat = formatErrorMessage($errors, 'city'))

					{!! Form::text('state', null, ['class' => $errorFormat['formControlClass'], 'id' => 'state', 'name' => 'state']) !!}
					{!! Form::label('state', 'State', $errorFormat['validation']) !!}
				</div>
				<div class="input-field col s12 m6">
					@php($errorFormat = formatErrorMessage($errors, 'country_id'))

					{!! Form::select('country_id', $countries, null,['class' => $errorFormat['formControlClass'], 'id' => 'country_id', 'name' => 'country_id']) !!}
                    {!! Form::label('country_id', 'Country', $errorFormat['validation']) !!}
				</div>
			</div>
			<div class="row">
				<div class="file-field input-field">
					<div class="btn">
						@php($errorFormat = formatErrorMessage($errors, 'user_image'))

						{!! Form::label('user_image', 'Profile Image', $errorFormat['validation']) !!}
						{!! Form::file('user_image', '', ['id' => 'user_image', 'name' => 'user_image', 'class' => $errorFormat['formControlClass']]) !!}
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text">
					</div>
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
@endsection