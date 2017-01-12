@extends('layouts.admin') @section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h2 class="page-title">Add Coins</h2>
				<div class="panel panel-default">
					<div class="panel-body">
                        {!! Form::open(['route' => ['admin.user.addcoins', $user->id], 'method' => 'POST', 'class' => 'form-horizontal']) !!}	
                         	<div class="form-group {{ $errors->has('coins') ? 'has-error' : '' }}">
	                        	{!! Form::label('Coins', 'Coins:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('coins', 0, ['class'=>'form-control mb'] ); !!}
	                        		@if ($errors->has('coins'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('coins') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        
	                        
							<div class="form-group">
								<div class="col-sm-8 col-sm-offset-2">
									<a class="btn btn-default button" href="/admin/user">Cancel</a>
									<button class="btn btn-primary" type="submit">Add Coins</button>
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
