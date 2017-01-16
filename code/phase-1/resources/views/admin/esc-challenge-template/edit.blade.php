@extends('layouts.admin') @section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h2 class="page-title">Edit Esc Challenge Template</h2>
				<div class="panel panel-default">
					<div class="panel-body">
					{!! Form::model($escChallengeTemplate, ['route' => ['admin.esc-challenge-template.update', $escChallengeTemplate->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
	                                <div class="form-group {{ $errors->has('joining_coins') ? 'has-error' : '' }}">
	                        	{!! Form::label('Joining Coins', 'Joining Coins:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('joining_coins', null, ['class'=>'form-control mb'] ); !!}
	                        		@if ($errors->has('joining_coins'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('joining_coins') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        
	                        <div class="form-group {{ $errors->has('winning_coins') ? 'has-error' : '' }}">
	                        	{!! Form::label('Winning Coins', 'Winning Coins:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('winning_coins', null, ['class'=>'form-control mb'] ); !!}
	                        		@if ($errors->has('winning_coins'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('winning_coins') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        
							<div class="form-group">
								<div class="col-sm-8 col-sm-offset-2">
									<a class="btn btn-default button" href="/admin/esc-challenge-template">Cancel</a>
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
