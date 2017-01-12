@extends('layouts.admin') @section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				@include('layouts.message')
				<h2 class="page-title">Edit User</h2>
				<div class="panel panel-default">
					<div class="panel-body">
						{!! Form::model($user, ['route' => ['admin.user.update', $user->id], 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                         	<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
	                        	{!! Form::label('Email', 'Email:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('email', null, ['class'=>'form-control mb', 'disabled'=>'disabled'] ); !!}
	                        		@if ($errors->has('email'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('email') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        
	                        <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
	                        	{!! Form::label('First Name', 'First Name:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('first_name', (isset($user->userDetails->first_name) ? $user->userDetails->first_name : null), ['class'=>'form-control mb'] ); !!}
	                        		@if ($errors->has('first_name'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('first_name') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        
	                         <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
	                        	{!! Form::label('Last Name', 'Last Name:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('last_name', (isset($user->userDetails->last_name) ? $user->userDetails->last_name : null), ['class'=>'form-control mb'] ); !!}
	                        		@if ($errors->has('last_name'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('last_name') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        
	                        <div class="form-group {{ $errors->has('gamer_name') ? 'has-error' : '' }}">
	                        	{!! Form::label('Gamer Name', 'Gamer Name:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('gamer_name', (isset($user->userDetails->gamer_name) ? $user->userDetails->gamer_name : null), ['class'=>'form-control mb'] ); !!}
	                        		@if ($errors->has('gamer_name'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('gamer_name') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        
	                        <div class="form-group {{ $errors->has('mobile_number') ? 'has-error' : '' }}">
	                        	{!! Form::label('Mobile Number', 'Mobile Number:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('mobile_number', (isset($user->userDetails->mobile_number) ? $user->userDetails->mobile_number : null), ['class'=>'form-control mb'] ); !!}
	                        		@if ($errors->has('mobile_number'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('mobile_number') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        
	                        <div class="form-group {{ $errors->has('address_1') ? 'has-error' : '' }}">
	                        	{!! Form::label('Address 1', 'Address 1:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('address_1', (isset($user->userDetails->address_1) ? $user->userDetails->address_1 : null), ['class'=>'form-control mb'] ); !!}
	                        		@if ($errors->has('address_1'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('address_1') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        
	                        <div class="form-group {{ $errors->has('address_2') ? 'has-error' : '' }}">
	                        	{!! Form::label('Address 2', 'Address 2:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('address_2', (isset($user->userDetails->address_2) ? $user->userDetails->address_2 : null), ['class'=>'form-control mb'] ); !!}
	                        		@if ($errors->has('address_2'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('address_2') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        
	                        <div class="form-group {{ $errors->has('pincode') ? 'has-error' : '' }}">
	                        	{!! Form::label('Pincode', 'Pincode:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('pincode', (isset($user->userDetails->pincode) ? $user->userDetails->pincode : null), ['class'=>'form-control mb'] ); !!}
	                        		@if ($errors->has('pincode'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('pincode') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        
	                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
	                        	{!! Form::label('City', 'City:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('city', (isset($user->userDetails->city) ? $user->userDetails->city : null), ['class'=>'form-control mb'] ); !!}
	                        		@if ($errors->has('city'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('city') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        
	                        <div class="form-group {{ $errors->has('state') ? 'has-error' : '' }}">
	                        	{!! Form::label('State', 'State:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('state', (isset($user->userDetails->state) ? $user->userDetails->state : null), ['class'=>'form-control mb'] ); !!}
	                        		@if ($errors->has('state'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('state') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        
	                        <div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
	                        	{!! Form::label('Country', 'Country:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{{ Form::select('country_id', $countries, (isset($user->userDetails->country_id) ? $user->userDetails->country_id : null), array('class' => 'form-control mb')) }}
	                            </div>
	                        </div>
	                        
	                        <div class="form-group">
	                        	{!! Form::label('Status', 'Status:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{{ Form::select('status', array('Active' => 'Active', 'Inactive' => 'Inactive', 'Deleted' => 'Deleted', 'Locked' => 'Locked', 'Suspended' => 'Suspended'), null, array('class' => 'form-control mb')) }}
	                            </div>
	                        </div>
	                        
	                        <div class="form-group">
                             	 {!! Form::label('Image', 'Image:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-6">
	                        		{!! Form::file('user_image', null, ['class'=>'form-control mb'] ); !!}
	                        		@if ($errors->has('user_image'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('user_image') }}</strong>
	                                    </span>
	                                @endif
	                            </div> 
	                            
	                            @if (isset($user->userDetails->user_image))
	                             <div class="col-sm-4 user_profile_wrap" >
	                        			<img class="user_profile" src="{{ url(env('PROFILE_PICTURE_PATH').$user->userDetails->user_image) }}">
	                             </div>
	                              @endif
                         	</div>
                         	
                         	
							<div class="form-group">
								<div class="col-sm-8 col-sm-offset-2">
									<a class="btn btn-default button" href="/admin/user">Cancel</a>
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
