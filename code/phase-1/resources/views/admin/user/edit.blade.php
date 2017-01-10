@extends('layouts.admin') @section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h2 class="page-title">Edit User</h2>
				<div class="panel panel-default">
					<div class="panel-body">
						{!! Form::model($user, ['route' => ['admin.user.edit', $user->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
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
	                        
							<div class="form-group">
								<label class="col-sm-2 control-label">Status</label>
								<div class="col-sm-10">
									<select class="form-control">
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>
								</div>
							</div>
							<div class="hr-dashed"></div>
							<div class="form-group">
								<div class="col-sm-8 col-sm-offset-2">
									<button class="btn btn-default" type="submit">Cancel</button>
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
