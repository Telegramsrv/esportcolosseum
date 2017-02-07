<div id="addFriendModal" class="modal blue-grey darken-4 modal-form">
	{!! Form::open(['route' => 'user.friend.add', 'method' => 'post', 'id' => 'inviteFriendForm']) !!}
	{!! Form::hidden('friend_id', null, ['id' => 'friend_id','name' => 'friend_id']) !!}
	    <div class="modal-content">
	      	<h5 class="white-text center-align">Search Members</h5>
	      	<div id="inviteFriend" class="modal-form-container">
	            <div class="row">
	        		<div class="input-field col s12 m12">
	        			{!! Form::text('search', null, ['class' => 'validate input-field col s12 m12', 'id' => 'search', 'name' => 'search']) !!}
	        			{!! Form::label('Search', 'Gamer Name OR Email', ['data-error' => '', 'id' => 'searchLabel']) !!}
	        		</div>
	    		</div>
	            <div class="row">
	    			<a id="inviteFriendSubmit" class="waves-effect waves-light btn-large btn-full deep-orange darken-4">Invite Friend</a>
	    			<div class="progress">
	                	<div class="indeterminate"></div>
	                </div>
	    		</div>
	      	</div>
	    </div>
    {!! Form::close() !!}
</div>