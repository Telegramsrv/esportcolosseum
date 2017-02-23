@extends('layouts.user.gamer-layout')
@section('game-info')
    <section>
        <div class="game-banner z-depth-2">
            <div class="game-banner-title text-shadow">{!! $selectedGame->name !!} (ESC Challenge)</div>
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
                  <li><a class="active" href='javascript:void(0);'><i class="fa fa-user" aria-hidden="true"></i><span>Solo </span></a></li>
                  <li><a href='javascript:void(0);'><i class="fa fa-users" aria-hidden="true"></i><span>Team</span></a></li>
              </ul>
          </div>
        </div>
        <div class="inner-page-tab-back"> 
        	<div class="row">           
                @php($today = \Carbon\Carbon::now())
                <div class="row buttons-block">
                    <div class="col s13">
                        <button class="challengr-btn" data-date = "{{$today->format('d M Y')}}">
                            {!! $today->format('d M Y'); !!}   
                        </button>
                    </div>
                    
                    @for($i=1; $i<7; $i++)
                         @php($date = $today->addDays(1)->format('d M Y'))
                        <div class="col s13">
                            <button class="challengr-btn" data-date = "{{ $date }}">
                                {!! $date; !!}   
                            </button>
                        </div>
                    @endfor
                </div>
                <div class="col s12">
                    <div class="time-block">
                        <ul class="timing disabled_for_mobile">
                            @php($hours = 0)
                            @while($hours<24)
                                <li data-id = "{{ $hours}}">{!! sprintf('%02d:00', $hours) !!}</li>
                                @php($hours = $hours + $settings->esc_challenge_interval_hrs)
                            @endwhile
                        </ul>
                        <div class="timing display_for_mobile_drop">
                            <select id="leave" class="no-material-select"  style="display: block">
                                @php($hours = 0)
                                @while($hours <24)
                                    <option value="tab1">
                                        <a href="#">{!! sprintf('%02d:00', $hours) !!}</a>
                                    </option>
                                    @php($hours = $hours + $settings->esc_challenge_interval_hrs)
                                @endwhile
                            </select>
                            <i class="fa fa-caret-down" aria-hidden="true"></i> 
                        </div>
                        <div class="ist-time">
                            <i class="fa fa-angle-down" aria-hidden="true"></i><span>{!! \Carbon\Carbon::now()->format('H:i:s') !!} (IST)</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @php($cnt = 0)
                    @foreach($escChallangeTemplates as $escChallangeTemplate)
                        {!! Form::open(['route' => ['user.esc-challenge.save', $selectedGame->slug], 'method' => 'post', 'class' => 'esc-challenge-form']) !!}
                        {!! Form::hidden('date', '', ['class' => 'esc-date']) !!}
                        {!! Form::hidden('time', '', ['class' => 'esc-time']) !!}
                        {!! Form::hidden('game_type', 'solo') !!}
                        {!! Form::hidden('esc_challenge_template_id',  $escChallangeTemplate->id) !!}
                        {!! Form::hidden('coins',  $escChallangeTemplate->joining_coins) !!}
                        {!! Form::hidden('win_coins',  $escChallangeTemplate->winning_coins) !!}
                        <div class="col s12 m3">
                            <div class="challenge-member">
                                <div class="ch-coin-block">
                                    <div class="ch-coin">
                                        win <span>{!! $escChallangeTemplate->winning_coins !!}</span> coins
                                    </div>
                                    <div class="ch-coin-black">
                                        Pay <span>{!! $escChallangeTemplate->joining_coins !!}</span> coins
                                    </div>
                                </div>
                                <div class="member-block">
                                    <div class="members">members<span class="members-span">0 / 0</span></div>
                                    <input type="button" class="join-btn" onclick="joinEscGame(this)"  value="Join" />
                                </div>
                            </div>
                        </div>
                        @php($cnt++)
                        @if($cnt%4 == 0)
                            </div>
                            <div class="row">
                        @endif
                        {!! Form::close() !!}
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection