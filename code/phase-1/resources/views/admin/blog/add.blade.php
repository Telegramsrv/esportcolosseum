@extends('layouts.admin') @section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h2 class="page-title">Add Blog</h2>
				<div class="panel panel-default">
					<div class="panel-body">
                        {!! Form::open(['route' => ['admin.blog.save'], 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}	
                         	
	                        
	                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
	                        	{!! Form::label('Title', 'Title:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('title', null, ['class'=>'form-control mb'] ); !!}
	                        		@if ($errors->has('title'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('title') }}</strong>
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
	                        
	                        <div class="form-group {{ $errors->has('	description') ? 'has-error' : '' }}">
	                        	{!! Form::label('Description', 'Description:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::textarea('description', null, ['class'=>'form-control mb', 'id' => 'blog-description'] ); !!}
	                        		@if ($errors->has('description'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('	description') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
	                        
	                        <div class="form-group {{ $errors->has('display_image') ? 'has-error' : '' }}">
	                        	{!! Form::label('Display Image', 'Display Image:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::file('display_image', null, ['class'=>'form-control mb'] ); !!}
	                        		@if ($errors->has('display_image'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('display_image') }}</strong>
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
									<a class="btn btn-default button" href="/admin/blog">Cancel</a>
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
