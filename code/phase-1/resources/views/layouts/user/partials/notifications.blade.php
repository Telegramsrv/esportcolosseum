<ul id="dropdown2" class="dropdown-content">
	<?php $total = count($notifications); ?>
	@if($total > 0)
		@foreach($notifications as $notification)
			<?php $notification->data = json_decode($notification->data); ?>
			@if($notification->type == "Friend Request")
				<li id="notification-{{ $notification->id }}">
					<a href="#!">
						{!!  $notification->message !!}
						<i class="fa fa-check-circle fa-lg" aria-hidden="true" onClick="acceptFriend({{ $notification->data->from_id }}, {{ $notification->id }})"></i>
						<i class="fa fa-times fa-lg" aria-hidden="true" onClick="rejectFriend({{ $notification->data->from_id }}, {{ $notification->id }})"></i>
					</a>
				</li>
			@elseif ($notification->type == "Team Invite") 
				<li id="notification-{{ md5($notification->id) }}">
					<a href="#!">
						{!!  $notification->message !!}
						<i class="fa fa-check-circle fa-lg" aria-hidden="true" onClick="acceptTeamRequest('{{ md5($notification->id) }}')"></i>
						<i class="fa fa-times fa-lg" aria-hidden="true" onClick="rejectTeamRequest('{{ md5($notification->id) }}')"></i>
					</a>
				</li>
			@elseif ($notification->type == "Other") 
				<li id="notification-{{ md5($notification->id) }}">
					<a href="#!">
						{!!  $notification->message !!}
						<i class="fa fa-trash fa-lg" aria-hidden="true" onClick="removeNotification('{{ md5($notification->id) }}')"></i>
					</a>
				</li>
			@endif
		@endforeach
	@else
		<li><a href="#!">Notification not found.</a></li>
	@endif
</ul>
<a class="dropdown-button white-text" href="#!" data-activates="dropdown2"><span id="total-notification" class="badge white-text">{{$total > 0 ? $total : ''}}</span><i class="fa fa-bell-o collection-item" aria-hidden="true"></i></a>