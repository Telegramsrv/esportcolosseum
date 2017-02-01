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
	 * @return [type] [description]
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
}
