<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\TeamRequestMail;
use App\Mail\TeamRequestAcceptRejectMail;

class Notification extends Model
{
    protected $guarded = ['id'];

    /**
     * Notification belongs to only one user.
     */
    public function user(){
    	return $this->belongsTo('App\User');
    }

    /**
     * Scope a query to filter notifications with given type.
     * @param  \Illuminate\Database\Eloquent\Builder $query  
     * @param  String $type  Notification Type
     * @return \Illuminate\Database\Eloquent\Builder $query  
     */
    public function scopeType($query, $type){
        return $query->where('type', $type);
    }

    /**
	 * This function is used to remove user's pending notifications.
	 * @param  String $type Notification Type
	 * @param  User   $user User of which notifications to be removed.
	 * @param  Team   $team Team of which notifications to be removed.
	 * @return Bool   
	 */
	public static function removeNotification($type, User $user, Team $team){
		$notifications = Notification::type($type)->where('user_id', $user->id)->get();
		foreach($notifications as $notification){
			$data = json_decode($notification->data);
			if($data->team_id == $team->id){
				$notification->delete();
				break;
			}
		}
		return true;
	}

	/**
	 * This function is used for 
	 * 		- Adding notification in table.
	 * 		- Sending team invite mail to player.
	 * @param 	User $user    Player who is part of this team.
	 * @param 	User $captain Captain for current challenge.
	 * @param 	Team $team    Team in which player is being added.
	 * @return  Bool
	 */
	public static function addTeamInviteNotification(User $user, User $captain, Team $team){
		$notification = new Notification([	'type' => 'Team Invite',
    										'data' => json_encode(['captain_id' => $captain->id, 'team_id' => $team->id]),
    										 'message' => $captain->email." has sent you team request."
    	]);
		$user->notifications()->save($notification);
    	    
    	//Send Team Invitation
    	Mail::to($user)->send(new TeamRequestMail($user));
    	
    	return true;
	}


	/**
	 * This function is used for 
	 * 		- Adding accept team notification in table.
	 * 		- Sending team invite mail to player.
	 * @param 	User $user    Player who is part of this team.
	 * @param 	User $captain Captain for current challenge.
	 * @param 	Team $status  Team request Accept/Reject status
	 * @return  Bool
	 */
	public static function acceptRejectTeamInviteNotification(User $user, User $captain, $status){
		$notification = new Notification([	'type' => 'Other',
											'data' => json_encode(['user_id' => $user->id]),
    										'message' => $user->email . " has " . $status . " your team request."
    	]);

		$captain->notifications()->save($notification);
    	    
    	//Send Team Acceptation Mail
    	Mail::to($captain)->send(new TeamRequestAcceptRejectMail($user, $captain, $status));
    	
    	return true;
	}
}