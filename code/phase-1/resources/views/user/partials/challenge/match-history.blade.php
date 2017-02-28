@php
 $challengeSubType = ["captain-pick" => "Captian's Pick", "team" => "Team Pick"];
@endphp
<div class="row card-panel table-container  blue-grey darken-4">
 <div class="table-responsive">
     <table class="table">
         <thead>
            <tr>
                <th data-field="srno">Sr.No</th>
                <th data-field="gameid">GameID</th>
                <th data-field="opponent">Opponent</th>
                <th data-field="type">Game Type</th>
                <th data-field="result">Result</th>
                <th data-field="price" class="center-align">Game Coins</th>
                <th data-field="viewDetails" class="right-align" width="10%">View Details</th>
            </tr>
        </thead>
        <tbody>
        @if($matchHistory->count() > 0)
            @foreach($matchHistory as $k => $match)
                @php
                    $opponent = "";
                    $result = "";
                    if($match->game_type == "solo")  {
                        $result = ($match->winner_id == Auth::id()) ? "Won": "Loss";
                        $opponentUser = ($match->user_id == Auth::id()) ? $match->opponentDetails : $match->captainDetails;
                        $opponent = $opponentUser->first_name . " " . $opponentUser->last_name;
                    } else if($match->game_type == "team") {
                        $winnerTeam =  $match->winnerTeam();
                        $myChallengeTeams = myChallengeTeams($match, Auth::id());
                        $myTeam = $myChallengeTeams['my_team'];
                        $opponentTeam = $myChallengeTeams['opponent_team'];
                        $opponent = $opponentTeam->name;
                        $result = ($winnerTeam->id == $myTeam->id) ? "Won": "Loss";
                    }
                @endphp
                <tr>
                    <td>{{ $k + 1 }}</td>
                    <td>{{ $match->game_id }}</td>
                    <td>{{ $opponent }}</td>
                    <td>{{ ucfirst($match->game_type) }} {{ ($match->challenge_sub_type) ? '(' . $challengeSubType[$match->challenge_sub_type] . ')' : "" }}  </td>
                    <td>{{ $result }}</td>
                    <td class="center-align">{{ $match->coins }}</td>
                    <td class="center-align"><a class="orange-link" href="{{ route('user.challenge.view', ['challengeId' => md5($match->id), 'gameSlug' => $selectedGame->slug]) }}"><i class="material-icons white-text">launch</i></a></td>
                </tr>
            @endforeach 
        @else
            <tr>
                <td colspan="7">No Match</td>  
            </tr>  
        @endif
        </tbody>
    </table>                                   
</div>
</div>
@if($matchHistory->count() > 0)
    {{ $matchHistory->links('user.partials.pagination') }}
    <hr/>
@endif