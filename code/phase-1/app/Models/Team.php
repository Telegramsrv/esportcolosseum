<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
// use App\Models\Notification;
// use App\Models\Challenge;

class Team extends Model
{
    protected $guarded = ['id'];

    /**
     * The Users that belong to the Team.
     * @return App\User number of users associated with team.
     */
    public function players()
    {
        return $this->belongsToMany('App\User')->withPivot('status');
    }

    /**
	 * This function is used to remove team from challenge.
	 * @param  Challenge 	$challenge 	Challenge from which team to be removed.
	 * @param  Team   		$team    	Team to be removed.
	 * @param  User   		$captain 	Captain of the team.
	 * @return Bool
	 */
	public static function removeTeamFromChallenge(Challenge $challenge, Team $team, User $captain){
		$players = $team->players()->wherePivot('user_id', '!=', $captain->id)->get();
		foreach($players as $player){
			Notification::removeNotification('Team Invite', $player, $team);
		}
		$challenge->teams()->detach($team);
		return true;
	}

	/**
	 * this function is used to set provided team's players' status
	 * @param Team    $team 	Current Team
	 * @param User    $captain 	Captain of the Team for specific challenge.
	 * @param String  $status 	Status to be set for all players of team except captain
	 */
	public static function setTeamPlayerStatus(Team $team, User $captain, $status){
		$players = $team->players()->wherePivot('user_id', '!=', $captain->id)->get();

		foreach($players as $player){
			Notification::addTeamInviteNotification($player, $captain, $team);
			$player->teams()->updateExistingPivot($team->id, ['status' => 'Invited']);
		}

		return true;
	}
}
