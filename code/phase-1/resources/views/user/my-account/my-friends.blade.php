@extends('layouts.user.static-layout', ['displayLeftSidebar' => false])
@section('static-content')
	<div class="tab-content col s12 m12">
		<div class="section-title">My <span>Friends</span></div>
		<div class="row">
		@if(count($userFriends) > 0)
			<table class="responsive-table striped highlight">
		        <thead>
		          <tr>
		              <th data-field="id">First Name</th>
		              <th data-field="name">Last Name</th>
		              <th data-field="price">Image</th>
		          </tr>
		        </thead>
			
		        <tbody>
		        @foreach ($userFriends as $key => $userFriend)
		        	<tr>
						<td>{{$userFriend->userFriendDetails->first_name}}</td>
						<td>{{ $userFriend->userFriendDetails->last_name }}</td>
						<td><img class="user-image" src="{{ url(env('PROFILE_PICTURE_PATH').$userFriend->userFriendDetails->user_image) }}"></td>
					</tr>
		        @endforeach
		        </tbody>
		     </table>
		    @else
		     No Friend Found
		    @endif
		</div>
	</div>	
@endsection