@extends('layouts.user.home')

@section('blog-section')
<section>
	<div class="section-title">Latest <span>Blogs</span></div>
	@php($colCounter = 0)
	<div class="row">			
	@foreach ($blogs as $blog)
        <div class="col s12 m3">
            <div class="card hoverable">
              	<div class="card-image waves-effect waves-block waves-light">
              		<a href="{!! route('blog-detail', ['blogSlug' => $blog->slug])!!}">
                	<img src="{!! url(env('UPLOAD_BLOG_THUMBNAIL', 'storage/blogs/small/').$blog->display_image) !!}" alt="" class="circle responsive-img">
                	</a>
              	</div>
              	<div class="card-content blue-grey darken-4">
                	<span class="card-title activator white-text text-darken-4">
                		{!! $blog->title !!}
                		<i class="material-icons right">more_vert</i>
                	</span>
              	</div>
              	<div class="card-reveal blue-grey darken-4">
	                <span class="card-title white-text text-darken-4">
	                	Blog Title<i class="material-icons right">close</i>
	                </span>
                	<p class="grey-text">{!! str_limit($blog->description, 200) !!}</p>
              	</div>
            </div>
        </div>
        @php
        	$colCounter++;
        	if($colCounter%4 == 0){
        		echo '	</div>
        				<div class="row">';
        	}
        @endphp
	@endforeach
	</div>
    <hr/>
</section>
@endsection

@section('upcoming-games-section')
<section class="">
    <div class="section-title ">Upcoming <span>Games</span></div>
    <div class="match-list upcomming_games">
        @if($challenges->count() > 0)
            @foreach($challenges as $challenge)
                <div class="row card-panel blue-grey lighten-5">
                    <div class="col s12 m5 left-team">
                         <div class="team-detail card-panel deep-orange darken-4 white-text center-align hoverable">
                            <div class="team-name" data-gameid="1">{!! $challenge->challengerTeam()->name !!}</div>
                            <div class="player-list card-panel blue-grey lighten-5 game-players-1">
                                @foreach($challenge->challengerTeam()->players as $player)
                                    <div class="player-row">
                                        <div class="player-image">
                                            @php
                                                $profilePicURL = displayProfileImage($player->userDetails->user_image)
                                            @endphp     
                                            <img alt="" class="circle responsive-img" src="{!! $profilePicURL !!}">
                                        </div>
                                        <div class="player-details">
                                            <div class="player-detail-row player-name">
                                                {!! $player->userDetails->first_name !!} {!! $player->userDetails->last_name !!}
                                            </div>
                                            <div class="player-detail-row player-earning">Earnings: 14,250 Static</div>
                                        </div>
                                        <div class="player-stats">
                                            <div class="stat-container">
                                                <div class="stat-value">49.6% St</div>
                                                <div class="stat-title">WINNING</div>
                                            </div>
                                            <div class="stat-container">
                                                <div class="stat-value">367 St</div>
                                                <div class="stat-title">MATCHES</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m2 match-stats">
                        <div class="match-detail center-align match-type">
                            {!! formatChallengeGameType($challenge) !!} | {!! formatChallengeSubType($challenge) !!}
                        </div>
                        <div class="match-detail center-align match-coins">{!! $challenge->coins !!} Coins</div>
                        <div class="match-detail center-align match-date-time">
                            <span class="match-time">{!! $challenge->valid_upto->format('H:i A') !!}</span>
                            <span class="match-date">{!! $challenge->valid_upto->format('M d, Y') !!}</span>
                        </div>
                    </div>
                    <div class="col s12 m5 right-team">
                        <div class="team-detail card-panel blue-grey darken-3 white-text center-align hoverable">
                            <div class="team-name"  data-gameid="1">{!! $challenge->opponentTeam()->name !!}</div>
                            <div class="player-list card-panel blue-grey lighten-5 game-players-1">
                                @foreach($challenge->opponentTeam()->players as $player)
                                    <div class="player-row">
                                        <div class="player-image">
                                            @php
                                                $profilePicURL = displayProfileImage($player->userDetails->user_image)
                                            @endphp     
                                            <img alt="" class="circle responsive-img" src="{!! $profilePicURL !!}">
                                        </div>
                                        <div class="player-details">
                                            <div class="player-detail-row player-name">
                                                {!! $player->userDetails->first_name !!} {!! $player->userDetails->last_name !!}
                                            </div>
                                            <div class="player-detail-row player-earning">Earnings: 14,250 Static</div>
                                        </div>
                                        <div class="player-stats">
                                            <div class="stat-container">
                                                <div class="stat-value">49.6% St</div>
                                                <div class="stat-title">WINNING</div>
                                            </div>
                                            <div class="stat-container">
                                                <div class="stat-value">367 St</div>
                                                <div class="stat-title">MATCHES</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $challenges->links('user.partials.pagination') }}
        @else
            <div class="row card-panel blue-grey lighten-5">
                No upcoming challenges
            </div>    
        @endif
    </div>
    <hr/>
</section>
@endsection

