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
		}
		// $response = '[{"id":"Aegithalos caudatus","label":"Long-tailed Tit","value":"Long-tailed Tit"},{"id":"Buteo rufinus","label":"Long-legged Buzzard","value":"Long-legged Buzzard"},{"id":"Clangula hyemalis","label":"Long-tailed Duck","value":"Long-tailed Duck"},{"id":"Calcarius lapponicus","label":"Lapland Longspur","value":"Lapland Longspur"},{"id":"Porzana pusilla","label":"Baillon`s Crake","value":"Baillon`s Crake"},{"id":"Stercorarius longicaudus","label":"Long-tailed Jaeger","value":"Long-tailed Jaeger"},{"id":"Asio otus","label":"Long-eared Owl","value":"Long-eared Owl"},{"id":"Limnodromus scolopaceus","label":"Long-billed Dowitcher","value":"Long-billed Dowitcher"},{"id":"Lanius schach","label":"Long-Tailed Shrike","value":"Long-Tailed Shrike"},{"id":"Phalacrocorax africanus","label":"Long-Tailed Cormorant","value":"Long-Tailed Cormorant"}]';
		
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
