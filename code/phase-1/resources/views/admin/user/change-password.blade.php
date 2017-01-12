@extends('layouts.admin') @section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h2 class="page-title">Change Password</h2>
				<div class="panel panel-default">
					<div class="panel-body">
                        {!! Form::model($user, ['route' => ['admin.user.changepassword'], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
	            	<div class="col-sm-12">
	            		<div class="form-group {{ $errors->has('old_password') ? 'has-error' : '' }}">
                        	{!! Form::label('Current Password', 'Current Password:', ['class' => 'col-sm-3 control-label']) !!}
                        	<div class="col-sm-6">
                        		{!! Form::password('old_password', ['class'=>'form-control']) !!}
                        		@if ($errors->has('old_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        	{!! Form::label('New Password', 'New Password:', ['class' => 'col-sm-3 control-label required']) !!}
                        	<div class="col-sm-6">
                        		{!! Form::password('password', ['class'=>'form-control']) !!}
                        		@if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                        	{!! Form::label('Confirm New Password', 'Confirm New Password:', ['class' => 'col-sm-3 control-label required']) !!}
                        	<div class="col-sm-6">
                        		{!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
                        		@if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
							<div class="form-group">
								<div class="col-sm-8 col-sm-offset-2">
									<a class="btn btn-default button" href="/admin/user">Cancel</a>
									<button class="btn btn-primary" type="submit">Update</button>
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
