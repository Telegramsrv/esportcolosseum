@extends('layouts.user.static-layout', ['displayLeftSidebar' => false])
@section('static-content')
	<div class="tab-content col s12 m12">
		<div class="section-title">My <span>Friends</span></div>
		<?php $cnt = count($userFriends);?>
		@if($cnt > 0)
			@foreach ($userFriends as $key => $userFriend)
				@if($key % 2 == 0)
				@if($key != 0) 
				</div>
				@endif
				<div class="row">
				@endif
			      <div class="col s6">
			      		<img class="user-image" src="{{ url(env('PROFILE_PICTURE_PATH').$userFriend->userFriendDetails->user_image) }}">
			      		{{$userFriend->userFriendDetails->first_name}} {{ $userFriend->userFriendDetails->last_name }}
			      </div>
			     @if($key == ($cnt-1))
			    </div>
			    @endif
			 @endforeach
    	@else
		     No Friend Found
		@endif
	</div>	
@endsection