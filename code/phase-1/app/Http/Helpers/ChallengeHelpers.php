<?php  
use App\Models\Challenge;
use App\Models\Team;

/**
 * This function checks if logged in user is challenger-captain or not.
 * @param  Interger $user 
 * @return boolean              
 */
function isCaptain($user){
	if($user == Auth::user()->id){
		return true;	
	}
	else{
		return false;
	}
}

/**
 * This function is to determine whether logged in user can complete challenge and list on challenge listing page.
 * @param  Challenge $challenge Challenge object
 * @param  Team      $team      Team object associated with challenge.
 * @return Boolean               
 */
function canCompleteChallenge(Challenge $challenge, Team $team, $type = 'challenger'){
	if($type == 'opponent') {
		$challengeCaptainId = $challenge->opponent_id;
		$checkStatus = "opponent-accepted";
	} else {
		$challengeCaptainId = $challenge->user_id;
		$checkStatus = "created";
	}

	$isCaptain = isCaptain($challengeCaptainId);
	$teamInviteAcceptCount = $team->players()->wherePivot('status', '=', 'Accepted')->count();

	if($isCaptain && $challenge->challenge_status == $checkStatus && $teamInviteAcceptCount == env('MAX_ALLOWED_PLAYERS_PER_TEAM')){
		return true;
	}
	else{
		return false;
	}
}

/**
 * This function is used to check whether logged in user can cancel challenge or not.
 * @param  Challenge $challenge Challenge object
 * @return Boolean
 */
function canCancelChallenge(Challenge $challenge){
	$isCaptain = isCaptain($challenge->user_id);
	if($isCaptain && $challenge->challenge_status == 'challenger-submitted' && $challenge->opponent_id == null){
		return true;
	}
	else{
		return false;
	}
}

/**
 * This function is used to check whether challenger can remove player from team or not.
 * @param  Challenge $challenge Challenge Object
 * @return Boolean              
 */
function canChallengerRemovePlayerFromTeam(Challenge $challenge){
	$isCaptain = isCaptain($challenge->user_id);
	if($challenge->challenge_status == "created" && $isCaptain){
		return true;
	}
	else{
		return false;
	}
}

/**
 * This function is used to check whether opponent can remove player from team or not.
 * @param  Challenge $challenge Challenge Object
 * @return Boolean              
 */
function canOpponentRemovePlayerFromTeam(Challenge $challenge){
	$isCaptain = isCaptain($challenge->opponent_id);
	if($challenge->challenge_status == "opponent-accepted" && $isCaptain){
		return true;
	}
	else{
		return false;
	}
}

function formatChallengeSubType($challenge){
	$formattedString = "";

	if($challenge->challenge_sub_type == "captain-pick"){
		$formattedString = "Captain's Pick";
	}
	else if($challenge->challenge_sub_type == "team"){
		$formattedString = "Team Pick";
	}
	else{
		$formattedString = $challenge->challenge_sub_type;	
	}

	return $formattedString;
}

function formatChallengeGameType($challenge){
	return ucfirst($challenge->game_type)." Match";
}


/**
 * This function user find my teams and my opponent teams
 * @return Team  $team  Challenger team object associated with challenge.
 */
function myChallengeTeams($challenge, $userId){
	$teams = [];
    if($challenge->teamsWithDetails->count() > 0) {
        foreach($challenge->teamsWithDetails as $k => $team) {
        	$opponentTeams[$team->id] = $team ;
             foreach($team->players as $player) { 
                if($player->id == $userId) {
                	$teams['my_team'] = $team;
                	unset($opponentTeams[$team->id]);
                }
             }
        }

        if(count($opponentTeams) > 0 ){
        	$teams['opponent_team'] = array_values($opponentTeams)[0];	
        }
        else{
        	$teams['opponent_team'] = [];
        }
        
    }
     return $teams;
}


function generateEscChallengeTemplate($escChallangeTemplates, $challenges, $selectedGame, $input){
	$challengesArr = [];
	$html = "<div class='row'>";
	if($challenges->count() > 0) {
        foreach ($challenges as $key => $challenge) {
            if($challenge->challenge_status == 'challenger-submitted') {
                $challengesArr[$challenge->esc_challenge_template_id]["currentCount"] = 1;
            }

            if($challenge->user_id == Auth::id() || $challenge->opponent_id == Auth::id()) {
                $challengesArr[$challenge->esc_challenge_template_id]["canJoinGame"] = false;
            }
        }
    }
    $totalCnt = $escChallangeTemplates->count();
    foreach($escChallangeTemplates as $k => $escChallangeTemplate) {
        $canJoinGame = isset($challengesArr[$escChallangeTemplate->id]["canJoinGame"]) ? $challengesArr[$escChallangeTemplate->id]["canJoinGame"] : true;
        $currentCount = isset($challengesArr[$escChallangeTemplate->id]["currentCount"]) ? $challengesArr[$escChallangeTemplate->id]["currentCount"] : 0;
        $html .= view('user.partials.challenge.esc-challenge-template', ['escChallangeTemplate' => $escChallangeTemplate, 'cnt' => ($k + 1), 'canJoinGame' => $canJoinGame, 'currentCount' => $currentCount, 'selectedGame' => $selectedGame, 'date' => $input["date"] ,'time' =>$input['time'], 'totalCnt' => $totalCnt])->render();
    }
    $html .= "</div>";
	return $html;
}

?>
