<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Team\CreateTeamRequest;
use App\Http\Requests\Team\AddPlayerInTeamRequest;
use App\Models\Team;
use App\Models\Challenge;
use App\Models\Notification;
use App\User;
use Auth;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\TeamRequestMail;

class TeamController extends Controller
{
	/**
	 * This method is used to create team.
	 * @return JSON 
	 */
    public function save(CreateTeamRequest $request){
    	$input = $request->all();
    	$user = Auth::user();
	    $challenge = Challenge::where(DB::raw('md5(id)'), $input['challenge_id'])->firstOrFail();

	    // Remove any previous team of user from challenge.
	    if($challenge->teams->count() > 0){
			$challengeTeams = $challenge->teams;
			foreach($challengeTeams as $challengeTeam){
				if($challengeTeam->captain->id == $user->id){
					$captain = $challengeTeam->captain;
					Team::removeTeamFromChallenge($challenge, $challengeTeam, $captain);
					break;
				}
			}
		}

		// Attach newly selected team to challenge.
    	if(isset($input['team_id']) && $input['team_id'] != '' && $input['team_id'] != null){
    		$team = Team::where(DB::raw('md5(id)'), '=', $input['team_id'])->firstOrFail();
    		// $captain = $challenge->captain;
    		$captain = $team->captain;
    		Team::setTeamPlayerStatus($team, $captain, 'Invited');
    	}
    	else{
    		// $user = Auth::user();

    		// Create new team adn attach it with user.
	    	$teamInput = $request->only('name');
	    	$teamInput['user_id'] = $user->id;
	    	$team = Team::create($teamInput);
	    	$team->players()->attach($user, ['status' => 'Accepted']);
    	}
    	//Attach Team with Challenge
    	$challenge->teams()->attach($team);

    	if ($request->ajax()) {
	    	return response()->json([
	    		'success' => true,
	    	]);
	    }
	}    	

	/**
	 * function to get team list of logged in user which is used for auto-complete functionality.
	 * @param  Request $request 
	 * @return JSON    $response      JSON string of team list of logged in user.
	 */
	public function getAutocompleteTeamList(Request $request){
		$input = $request->all();
		$user = Auth::user();
		$challenge = Challenge::where(DB::raw('md5(id)'), $input['challenge_id'])->firstOrFail();

		$teamLists = $user
						->captainteams()
						->where('teams.name', 'like', '%'.$input['name'].'%')
						->whereNotIn("teams.id", function($query) use ($challenge) {
			    			$query->select('team_id')
			    				->from("challenge_team")
			    				->where('challenge_id', $challenge->id);
			    		})
						->limit(env('AUTOCOMPLETE_RESULT_LIMIT', 6))
						->get(['teams.id', 'teams.name']);
		$response = [];

		foreach($teamLists as $team){
			$data = [
    			"id" => md5($team->id), 
    			"label" => $team->name, 
    			"value" => $team->name
    		];
    		array_push($response, $data);
		}
		
		if ($request->ajax()) {
			return response()->json([
				"succes" => true,
				'response' => json_encode($response)
	    		]
	    	);	
		}
	}

	/**
	 * Function to get Team Players except current user for respective team.
	 * @param  Request $request 
	 * @param  Team    $team      Team object of selected team.
	 * @return JSON    $response  Team Players except current user of selected team.
	 */
	public function getTeamPlayers(Request $request, Team $team){
		$user = Auth::user();
		$players = $team->players()->where('users.id', '!=', $user->id)->get();
		$playerDetails = [];
		$index = 0;
		foreach($players as $player){
			$playerDetails[$index]['name'] = $player->userDetails->first_name." ".$player->userDetails->last_name;
			$profileImage = '';
			if($player->userDetails->user_image != ""){
				$profileImage = url(env('PROFILE_PICTURE_PATH', 'storage/user/profile_pictures/') . $player->userDetails->user_image);
			}
			else{
				$profileImage = url(env('PROFILE_PICTURE_PATH', 'storage/user/profile_pictures/') . env('DEFAULT_USER_PROFILE_IMAGE', 'default-profile.png'));	
			}

			$playerDetails[$index]['profile_pic_url'] = $profileImage;
			$index++;
		}
		if ($request->ajax()) {
			return response()->json($playerDetails);	
		}
	}

	public function getAutocompletePlayerList(Team $team, Request $request){
		$input = $request->all();
		$challenge = Challenge::where(DB::raw('md5(id)'), $input['challenge_id'])->firstOrFail();
		$users = User::active()
					->roleType('user')
					->seachGamerNameOrEmail($input['player'])
					->playersNotAssociatedWithChallenge($challenge)
					// ->playersNotAssociatedWithAnyChallenge()
					->take(env('AUTOCOMPLETE_RESULT_LIMIT'))
					->get();

		$userLists = [];
    	foreach($users as $user){
    		$name = $user->userDetails->first_name . " " . $user->userDetails->last_name;
    		$user = array(
    			"id" => md5($user->id), 
    			"label" => $name, 
    			"value" => $name
    		);
    		array_push($userLists, $user);
    	}
    	if ($request->ajax()) { 
    		return response()->json(["succes" => true,'response' => json_encode($userLists)]);
    	}		
	}

	/**
	 * This function is used to add player in team.
	 * @param  Request 	$request 
	 * @return JSON 	$response success/failure response.
	 */
	public function savePlayerInTeam(AddPlayerInTeamRequest $request){
		$input = $request->all();
		$user = User::where(DB::raw('md5(id)'), $input['player_id'])->firstOrFail();
		$team = Team::where(DB::raw('md5(id)'), $input['team_id'])->firstOrFail();

		if($team->players()->count() < env('MAX_ALLOWED_PLAYERS_PER_TEAM')){

			//save user to team
			$team->players()->attach($user, ['status' => 'Invited']);
			/**
			 * 1) send "Team Invite" notification mail to player.
			 * 2) Add DB row in Notification table.
			 */
			Notification::addTeamInviteNotification($user, Auth::user(), $team);
		}
		else{
			$errors = array(
    			'player_id' => array(
    				'Team is full.'
    			)
    		);
    		return response()->json($errors, 422);
		}

		if ($request->ajax()) { 
			return response()->json(["success" => true]);
		}
	}

	/**
	 * This function is used to remove player from team.
	 * @param  Request   $request Request object
	 */
	public function removePlayer(Request $request){
		$input = $request->only('player_id', 'team_id', 'challenge_id');
		$user = User::where(DB::raw('md5(id)'), $input['player_id'])->firstOrFail();
		$team = Team::where(DB::raw('md5(id)'), $input['team_id'])->firstOrFail();
		$challenge = Challenge::where(DB::raw('md5(id)'), $input['challenge_id'])->firstOrFail();

		if(in_array($challenge->challenge_status, ['created', 'opponent-accepted'])){
			/**
			 * Peform below actions.
			 * 1) Remove team invite notification if any
			 * 2) Detach user from team if removed.
			 */
			$notifications = Notification::type('Team Invite')->where(DB::raw('md5(user_id)'), $input['player_id'])->get();

			foreach($notifications as $notification){
				$data = json_decode($notification->data, true);
				if(md5($data['team_id']) == $input['team_id']){
					$notification->delete();
					break;
				}
			}
			 
			if($team->players()->detach($user)){
				return redirect()->back();
			}
		}
		else{
			return redirect()->back();
		}
	}

	/**
	 * This function is used to accept team request.
	 * @param  Request   $request Request object
	 */
	public function acceptTeamRequest(Request $request){
		$notification = Notification::where(DB::raw('md5(id)'), $request->notificationID)->where('user_id', Auth::id())->firstOrFail();
		$notificationData = json_decode($notification->data);
		$captain = User::where('id', $notificationData->captain_id)->firstOrFail();

		$userTeam = Team::where('id' , $notificationData->team_id)->firstOrFail()->players()->updateExistingPivot(Auth::id(), ['status' => 'Accepted']);

		//Remove Notification
		$notification->delete();

		//Send Accept Team Notification To Captain
		Notification::acceptRejectTeamInviteNotification(Auth::user(), $captain, "Accept");

		if ($request->ajax()) { 
			return response()->json(["success" => true]);
		}else{
			return redirect()->back();
		}
	}

	/**
	 * This function is used to reject team request.
	 * @param  Request   $request Request object
	 */
	public function rejectTeamRequest(Request $request){
		$notification = Notification::where(DB::raw('md5(id)'), $request->notificationID)->where('user_id', Auth::id())->firstOrFail();
		$notificationData = json_decode($notification->data);
		$captain = User::where('id', $notificationData->captain_id)->firstOrFail();
		$userTeam = Team::where('id' , $notificationData->team_id)->firstOrFail()->players()->detach(Auth::id());

		//Remove Notification
		$notification->delete();

		//Send Accept Team Notification To Captain
		Notification::acceptRejectTeamInviteNotification(Auth::user(), $captain, "Reject");

		if ($request->ajax()) { 
			return response()->json(["success" => true]);
		}else{
			return redirect()->back();
		}
	}
}
