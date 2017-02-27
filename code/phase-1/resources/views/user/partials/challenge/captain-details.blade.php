<ul class="captain-detail">
	<li>
		<a target="_blank" href="{!! route('user.profile', ['md5UserId' => md5($challenge->user_id), 'gameSlug' => $challenge->game->slug]) !!}">
			@php
				$profilePicURL = displayProfileImage($captain->user_image);
			@endphp		
			<img class="challenge-captain-image" src="{!! $profilePicURL !!}">
		</a>
	</li>
</ul>
<h3>
	{!! $captain->first_name !!} {!! $captain->last_name !!}
	<span>( Captain ) </span>
</h3>