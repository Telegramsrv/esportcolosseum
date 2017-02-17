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

?>
