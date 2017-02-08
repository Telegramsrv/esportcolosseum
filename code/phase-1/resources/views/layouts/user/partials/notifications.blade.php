<ul id="dropdown2" class="dropdown-content">
	@foreach($notifications as $notification)
		<li>
			<a href="#!">
				{!! $notification->message !!}
				<i class="fa fa-check-circle fa-lg" aria-hidden="true" onClick="acceptFriend()"></i>
				<i class="fa fa-times fa-lg" aria-hidden="true"></i>
			</a>
		</li>
	@endforeach
</ul>
<a class="dropdown-button white-text" href="#!" data-activates="dropdown2"><i class="fa fa-bell-o collection-item" aria-hidden="true"></i></a>