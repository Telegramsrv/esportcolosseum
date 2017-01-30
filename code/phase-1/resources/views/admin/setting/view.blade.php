@extends('layouts.admin') @section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				@include('layouts.message')
				<h2 class="page-title">Settings</h2>
				<div class="panel panel-default">
					<div class="panel-body">
						{!! Form::model($setting, ['route' => ['admin.setting.update'], 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                         	<div class="form-group {{ $errors->has('coins_per_dollar') ? 'has-error' : '' }}">
	                        	{!! Form::label('Coins/$1', 'Coins/$1:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('coins_per_dollar', null, ['class'=>'form-control mb'] ); !!}
	                        		@if ($errors->has('coins_per_dollar'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('coins_per_dollar') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        
	                        <div class="form-group {{ $errors->has('esc_challenge_interval_hrs') ? 'has-error' : '' }}">
	                        	{!! Form::label('Challenge Interval Hrs', 'Challenge Interval Hrs:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('esc_challenge_interval_hrs', null, ['class'=>'form-control mb'] ); !!}
	                        		@if ($errors->has('esc_challenge_interval_hrs'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('esc_challenge_interval_hrs') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        
							<div class="form-group">
								<div class="col-sm-8 col-sm-offset-2">
									<a class="btn btn-default button" href="/admin/settings">Cancel</a>
									<button class="btn btn-primary" type="submit">Save</button>
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
