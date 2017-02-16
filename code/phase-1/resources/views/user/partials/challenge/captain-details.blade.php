<ul class="captain-detail">
	<li>
		<a target="_blank" href="{!! route('user.profile', ['md5UserId' => md5($challenge->user_id), 'gameSlug' => $challenge->game->slug]) !!}">
			@php
				$profilePicURL = displayProfileImage($captain->userDetails->user_image);
			@endphp		
			<img class="challenge-captain-image" src="{!! $profilePicURL !!}">
		</a>
	</li>
</ul>
<h3>
	{!! $captain->userDetails->first_name !!} {!! $captain->userDetails->last_name !!}
	<span>( Captain ) </span>
</h3>