@extends('layouts.admin') @section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				@include('layouts.message')
				<h2 class="page-title">Edit User</h2>
				<div class="panel panel-default">
					<div class="panel-body">
						{!! Form::model($page, ['route' => ['admin.page.update', $page->id], 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
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
	                        
	                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
	                        	{!! Form::label('Description', 'Description:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::textarea('description', null, ['class'=>'form-control mb', 'id' => 'page-description'] ); !!}
	                        		@if ($errors->has('description'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('description') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>
                         	
                         	
							<div class="form-group">
								<div class="col-sm-8 col-sm-offset-2">
									<a class="btn btn-default button" href="/admin/page">Cancel</a>
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
