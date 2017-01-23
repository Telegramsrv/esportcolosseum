@extends('layouts.admin') @section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				@include('layouts.message')
				<h2 class="page-title">View Match</h2>
				<div class="panel panel-default">
					<div class="panel-body">
						{!! Form::model($match, ['route' => ['admin.match.update', $match->id], 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                         	<div class="form-group">
	                        	{!! Form::label('Challenger', 'Challenger:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('user_id', $match->captain->email, ['class'=>'form-control mb', 'disabled'=>'disabled'] ); !!}
	                            </div>
	                        </div>
	                        
	                         <div class="form-group">
	                        	{!! Form::label('Challenge Type', 'Challenge Type:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('challenge_type',  null , ['class'=>'form-control mb', 'disabled'=>'disabled'] ); !!}
	                            </div>
	                        </div>
	                        
	                        <div class="form-group">
	                        	{!! Form::label('Game', 'Game:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('game_id',  $match->game->name , ['class'=>'form-control mb', 'disabled'=>'disabled'] ); !!}
	                            </div>
	                        </div>
	                        
	                        <div class="form-group">
	                        	{!! Form::label('Game Type', 'Game Type:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('game_type',  $match->game_type , ['class'=>'form-control mb', 'disabled'=>'disabled'] ); !!}
	                            </div>
	                        </div>
	                        
	                        <div class="form-group">
	                        	{!! Form::label('Region', 'Region:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('region_id',  $match->region->name , ['class'=>'form-control mb', 'disabled'=>'disabled'] ); !!}
	                            </div>
	                        </div>
	                        
	                        <div class="form-group">
	                        	{!! Form::label('Name', 'Name:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('name',  null , ['class'=>'form-control mb', 'disabled'=>'disabled'] ); !!}
	                            </div>
	                        </div>
	                        
	                        <div class="form-group">
	                        	{!! Form::label('Coins', 'Coins:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('coins',  null , ['class'=>'form-control mb', 'disabled'=>'disabled'] ); !!}
	                            </div>
	                        </div>
	                        
	                        <div class="form-group">
	                        	{!! Form::label('Is Accepted', 'Is Accepted:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('is_accepted',  null , ['class'=>'form-control mb', 'disabled'=>'disabled'] ); !!}
	                            </div>
	                        </div>
	                        
	                        <div class="form-group">
	                        	{!! Form::label('Status', 'Status:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('challenge_status',  null , ['class'=>'form-control mb', 'disabled'=>'disabled'] ); !!}
	                            </div>
	                        </div>
	                        
	                        <div class="form-group">
	                        	{!! Form::label('Valid Upto', 'Valid Upto:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('valid_upto',  null , ['class'=>'form-control mb', 'disabled'=>'disabled'] ); !!}
	                            </div>
	                        </div>
	                        
	                        <div class="form-group">
	                        	{!! Form::label('Created At', 'Created At:', ['class' => 'col-sm-2 control-label required']) !!}
	                        	<div class="col-sm-10">
	                        		{!! Form::text('created_at',  null , ['class'=>'form-control mb', 'disabled'=>'disabled'] ); !!}
	                            </div>
	                        </div>
	                        
							<div class="form-group">
								<div class="col-sm-8 col-sm-offset-2">
									<a class="btn btn-default button" href="/admin/match">Back</a>
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
