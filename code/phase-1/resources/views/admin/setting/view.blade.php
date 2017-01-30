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
                         	<div class="form-group {{ $errors->has('coin') ? 'has-error' : '' }}">
	                        	{!! Form::label('$1 Coins', '$1 Coins:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('coin', null, ['class'=>'form-control mb'] ); !!}
	                        		@if ($errors->has('coin'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('coin') }}</strong>
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
