<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Team\CreateTeamRequest;
use App\Models\Team;
use App\Models\Challenge;
use App\User;
use Auth;
use DB;

class TeamController extends Controller
{
	/**
	 * This method is used to create team.
	 * @return JSON 
	 */
    public function save(CreateTeamRequest $request){
    	$input = $request->all();
	    $challenge = Challenge::where(DB::raw('md5(id)'), $input['challenge_id'])->firstOrFail();

    	if($input['team_id'] != '' && $input['team_id'] != null){
    		// Attach already create team with challenge.
    		$team = Team::where(DB::raw('md5(id)'), '=', $input['team_id'])->firstOrFail();
    	}
    	else{
    		$user = Auth::user();

    		// Create new team adn attach it with user.
	    	$teamInput = $request->only('name');
	    	$team = Team::create($teamInput);
	    	$team->players()->attach($user);
    	}

    	//Sync Team with Challenge
    	$challenge->teams()->sync([$team->id]);
    	
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
		$currentUser = Auth::user();
		$currentChallenge = Challenge::where(DB::raw('md5(id)'), $input['challenge_id'])->firstOrFail();
		$currentTeam = $currentChallenge->captainTeam($currentUser);
		// dd($currentTeam);
		$teamLists = $currentUser->teams()->where('teams.name', 'like', '%'.$input['name'].'%');
		if($currentTeam){
			$teamLists = $teamLists->where('teams.id', '!=', $currentTeam->id);
		}
		$teamLists = $teamLists->limit(env('AUTOCOMPLETE_RESULT_LIMIT', 6))->get(['teams.id', 'teams.name']);

		$response = [];
		$index = 0;

		foreach($teamLists as $team){
			$response[$index]['id'] = md5($team->id);
			$response[$index]['label'] = $team->name;
			$response[$index]['value'] = $team->name;

			$index++;
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
		$currentUser = Auth::user();
		$players = $team->players()->where('users.id', '!=', $currentUser->id)->get();
		$playerDetails = [];
		$index = 0;
		foreach($players as $player){
			$playerDetails[$index]['name'] = $player->userDetails->first_name." ".$player->userDetails->last_name;
			$playerDetails[$index]['profile_pic'] = ($player->userDetails->user_image != '' ? $player->userDetails->user_image : env('DEFAULT_USER_PROFILE_IMAGE', 'default-profile.png'));
			$playerDetails[$index]['profile_pic_url'] = url(env('PROFILE_PICTURE_PATH') . $player->userDetails->user_image);
			$index++;
		}
		if ($request->ajax()) {
			return response()->json($playerDetails);	
		}
	}
}
