@extends('layouts.user.static-layout', ['displayLeftSidebar' => false])
@section('static-content')
	<div class="tab-content col s12 m12">
		<div class="section-title">My <span>Friends</span></div>
		<?php $cnt = count($userFriends);?>
		@if($cnt > 0)
			@foreach ($userFriends as $key => $userFriend)
				@if($key % 3 == 0)
				@if($key != 0) 
				</div>
				 <br>
				@endif
				<div class="row">
				@endif
			      <div class="col s4 text-center">
			      		<a href="{{ url('user/profile/'.md5($userFriend->user_id)) }}"><img class="friend-img responsive-img circle" src="{{ url(env('PROFILE_PICTURE_PATH').($userFriend->user_image != '' ? $userFriend->user_image : env('DEFAULT_USER_PROFILE_IMAGE'))) }}"></a>
			      		<br>
			      		<b>{{$userFriend->first_name}} {{ $userFriend->last_name }}</b>
			      </div>
			     @if($key == ($cnt-1))
			    </div>
			     <br>
			    @endif
			 @endforeach
    	@else
		     No Friend Found
		@endif
	</div>	
@endsection