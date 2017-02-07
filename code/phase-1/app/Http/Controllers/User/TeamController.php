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
    	$user = Auth::user();

    	$teamInput = $request->only('name');
    	$team = Team::create($teamInput);
    	$team->users()->attach($user);

    	$challengeInput = $request->only('challenge_id');
    	$challenge = Challenge::where(DB::raw('md5(id)'), $challengeInput['challenge_id'])->firstOrFail();

    	$challenge->teams()->attach($team);

    	if ($request->ajax()) {
	    	return response()->json([
	    		'success' => true,
	    	]);
	    }
	}    	

	public function fetchAutocompleteList(Request $request){
		$input = $request->all();
		$currentUser = Auth::user();
		$currentChallenge = Challenge::where(DB::raw('md5(id)'), $input['challenge_id'])->firstOrFail();
		$currentTeam = $currentChallenge->captainTeam($currentUser)->firstOrFail();
		$teamLists = $currentUser->teams()->where(
			[
				['teams.name', 'like', '%'.$input['name'].'%'],
				// ['teams.id', '!=', $currentTeam->id]
			])->get(['teams.id', 'teams.name']);
		$response = [];
		$index = 0;
		foreach($teamLists as $team){

			$response[$index]['id'] = $team->id;
			$response[$index]['label'] = $team->name;
			$response[$index]['value'] = $team->name;

			$index++;
		}
		
		if ($request->ajax()) {
			// return $response;
			return response()->json([
				"succes" => true,
				'response' => json_encode($response)
	    		// $response
	    		]
	    	);	
		}
	}
}
