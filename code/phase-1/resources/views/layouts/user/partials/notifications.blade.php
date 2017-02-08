<ul id="dropdown2" class="dropdown-content">
	@foreach($notifications as $notification)
		<?php $notification->data = json_decode($notification->data); ?>
		<li id="notification-{{ $notification->id }}">
			<a href="#!">
				{!!  $notification->message !!}
				<i class="fa fa-check-circle fa-lg" aria-hidden="true" onClick="acceptFriend({{ $notification->data->from_id }}, {{ $notification->id }})"></i>
				<i class="fa fa-times fa-lg" aria-hidden="true" onClick="rejectFriend({{ $notification->data->from_id }}, {{ $notification->id }})"></i>
			</a>
		</li>
	@endforeach
</ul>
<a class="dropdown-button white-text" href="#!" data-activates="dropdown2"><i class="fa fa-bell-o collection-item" aria-hidden="true"></i></a>