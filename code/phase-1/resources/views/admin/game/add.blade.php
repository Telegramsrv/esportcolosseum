@extends('layouts.admin') @section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h2 class="page-title">Add Game</h2>
				<div class="panel panel-default">
					<div class="panel-body">
                        {!! Form::open(['route' => ['admin.game.save'], 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}	
                         	
	                        
	                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
	                        	{!! Form::label('Game Name', 'Game Name:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('name', null, ['class'=>'form-control mb'] ); !!}
	                        		@if ($errors->has('name'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('name') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        
	                         <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
	                        	{!! Form::label('Slug', 'Slug:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('slug', null, ['class'=>'form-control mb'] ); !!}
	                        		@if ($errors->has('slug'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('slug') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        
	                        <div class="form-group {{ $errors->has('logo') ? 'has-error' : '' }}">
	                        	{!! Form::label('Logo', 'Logo:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::file('logo', null, ['class'=>'form-control mb'] ); !!}
	                        		@if ($errors->has('logo'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('logo') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        
	                        <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
	                        	{!! Form::label('Menu Image', 'Menu Image:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::file('image', null, ['class'=>'form-control mb'] ); !!}
	                        		@if ($errors->has('image'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('image') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        
	                        <div class="form-group {{ $errors->has('banner_image') ? 'has-error' : '' }}">
	                        	{!! Form::label('Banner Image', 'Banner Image:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::file('banner_image', null, ['class'=>'form-control mb'] ); !!}
	                        		@if ($errors->has('banner_image'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('banner_image') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        
							<div class="form-group">
								<div class="col-sm-8 col-sm-offset-2">
									<a class="btn btn-default button" href="/admin/game">Cancel</a>
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
