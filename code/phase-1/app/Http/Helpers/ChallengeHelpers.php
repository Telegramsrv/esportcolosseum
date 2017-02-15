<?php  
use App\Models\Challenge;
use App\Models\Team;

/**
 * This function checks if logged in user is challenger-captain or not.
 * @param  Challenge $challenge Challenge object
 * @return boolean              
 */
function isCaptain(Challenge $challenge){
	if($challenge->user_id == Auth::user()->id){
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
function canCompleteChallenge(Challenge $challenge, Team $team){
	$isCaptain = isCaptain($challenge);
	$teamInviteAcceptCount = $team->players()->wherePivot('status', '=', 'Accepted')->count();

	if($isCaptain && $teamInviteAcceptCount == env('MAX_ALLOWED_PLAYERS_PER_TEAM')){
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
	$isCaptain = isCaptain($challenge);
	if($isCaptain && $challenge->challenge_status == 'listed' && $challenge->opponent_id == null){
		return true;
	}
	else{
		return false;
	}
}


?>
