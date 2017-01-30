@extends('layouts.user.gamer-layout')
@section('game-info')
    <section>
        <div class="game-banner z-depth-2">
            <div class="game-banner-title text-shadow">{!! $selectedGame->name !!} (Open Challenge)</div>
            <img src="{!! url(env('UPLOAD_GAME_BANNER', 'storage/games/large/').$selectedGame->banner_image) !!}" />
        </div>
    </section>
@endsection
@section('gamer-content')
	<section class="">
        <div class="section-title ">Challenges <span>List</span></div>
        <div class="challenge-page-tab-back">
            <div class="">
              <ul class='tabs'>
                  <li><a class="active" href='#tab1'><i class="fa fa-user" aria-hidden="true"></i><span>Solo </span></a></li>
                  <li><a href='#tab2'><i class="fa fa-users" aria-hidden="true"></i><span>Team</span></a></li>
              </ul>
          </div>
        </div>
        <div class="inner-page-tab-back"> 
        		<div class="row">           
                <div id='tab1'>
                    @php($today = \Carbon\Carbon::now())
                	@include('user.partials.challenge.esc-challenge-date-time-list', ['today' => $today, 'escChallengeInterval' => $escChallengeInterval])
                    <div class="row">
                        <div class="col s12 m3">
                            <div class="challenge-member">
                                <div class="ch-coin-block">
                                    <div class="ch-coin">
                                        win <span>16</span> coins
                                    </div>
                                    <div class="ch-coin-black">
                                        Pay <span>10</span> coins
                                    </div>
                                </div>
                                <div class="member-block">
                                    <div class="members">members<span>1 / 2</span></div>
                                    <button class="join-btn">Join</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id='tab2'> 
                    @php($today = \Carbon\Carbon::now())
                    @include('user.partials.challenge.esc-challenge-date-time-list', ['today' => $today, 'escChallengeInterval' => $escChallengeInterval])
                    <div class="row">
                    	<div class="col s12 m3">
                            <div class="challenge-member">
                                <div class="ch-coin-block">
                                    <div class="ch-coin">
                                        win <span>16</span> coins
                                    </div>
                                    <div class="ch-coin-black">
                                        Pay <span>10</span> coins
                                    </div>
                                </div>
                                <div class="member-block">
                                    <div class="members">members<span>1 / 2</span></div>
                                    <button class="join-btn">Join</button>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m3">
                            <div class="challenge-member">
                                <div class="ch-coin-block">
                                    <div class="ch-coin">
                                        win <span>16</span> coins
                                    </div>
                                    <div class="ch-coin-black">
                                        Pay <span>10</span> coins
                                    </div>
                                </div>
                                <div class="member-block">
                                    <div class="members">members<span>1 / 2</span></div>
                                    <button class="join-btn">Join</button>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m3">
                            <div class="challenge-member">
                                <div class="ch-coin-block">
                                    <div class="ch-coin">
                                        win <span>16</span> coins
                                    </div>
                                    <div class="ch-coin-black">
                                        Pay <span>10</span> coins
                                    </div>
                                </div>
                                <div class="member-block">
                                    <div class="members">members<span>1 / 2</span></div>
                                    <button class="join-btn">Join</button>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m3">
                            <div class="challenge-member">
                                <div class="ch-coin-block">
                                    <div class="ch-coin">
                                        win <span>16</span> coins
                                    </div>
                                    <div class="ch-coin-black">
                                        Pay <span>10</span> coins
                                    </div>
                                </div>
                                <div class="member-block">
                                    <div class="members">members<span>1 / 2</span></div>
                                    <button class="join-btn">Join</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection