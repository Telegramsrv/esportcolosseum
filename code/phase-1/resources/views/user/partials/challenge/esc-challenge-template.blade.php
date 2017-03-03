@php
    $canJoinGame = isset($canJoinGame) ? $canJoinGame : true;
@endphp

{!! Form::open(['route' => ['user.esc-challenge.save', $selectedGame->slug], 'method' => 'post', 'class' => 'esc-challenge-form', 'id' => 'esc-challenge-form-' . $escChallangeTemplate->id]) !!}
{!! Form::hidden('date', isset($date) ? $date : '', ['class' => 'esc-date']) !!}
{!! Form::hidden('time', isset($time) ? $time : '', ['class' => 'esc-time']) !!}
{!! Form::hidden('game_type', 'solo') !!}
{!! Form::hidden('esc_challenge_template_id',  $escChallangeTemplate->id) !!}
{!! Form::hidden('coins',  $escChallangeTemplate->joining_coins) !!}
{!! Form::hidden('win_coins',  $escChallangeTemplate->winning_coins) !!}
<div class="col s12 m3">
    <div class="challenge-member" id="template-id-{{ $escChallangeTemplate->id }}">
        <div class="ch-coin-block">
            <div class="ch-coin">
                win <span>{!! $escChallangeTemplate->winning_coins !!}</span> coins
            </div>
            <div class="ch-coin-black">
                Pay <span>{!! $escChallangeTemplate->joining_coins !!}</span> coins
            </div>
        </div>
        <div class="member-block">
            <div class="members">members<span class="members-span">{{ (isset($currentCount) && $currentCount > 0) ? "1 / 2" : "0 / 0" }}</span></div>
            @if($canJoinGame == true) 
                <input type="button" class="join-btn" onclick="joinEscGame(this)"  value="Join" />
            @endif
        </div>
    </div>
</div>
@if($cnt%4 == 0 && $totalCnt > $cnt)
    </div>
    <div class="row">
@endif
{!! Form::close() !!}
   
