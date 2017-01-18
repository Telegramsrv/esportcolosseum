<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\Challenge\createOpenChallengeRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Game;
use App\Models\Region;
use App\Models\Team;
use App\Models\Challenge;
use Carbon\Carbon;

class ChallengeController extends Controller
{
	public function listOpenChallenges(Game $selectedGame){
		$regions = Region::all()->pluck('name', 'id');	
		$regions->prepend("Select Region", '');
		$challengeModes = ['' => 'Select Mode', 'captain-pick' => 'Captain\'s Pick', 'team' => 'Team'];
		return view("user.challenge.create-open-challenge")->with(['selectedGame' => $selectedGame, 'regions' => $regions, 'challengeModes' => $challengeModes]);
	}

	public function saveOpenChallenge(createOpenChallengeRequest $request){
		$input = $request->all();
		$team = Team::Create(['name' => $input['team_name']]);
		unset($input['team_name']);

		$input['user_id'] = Auth::user()->id;
		$input['challenge_status'] = 'created';
		$input['valid_upto'] = Carbon::now()->addHours(env('CHALLENGE_EXPIRATION_TIME_IN_HOURS', 72));

		$challenge = Challenge::Create($input);

		if ($request->ajax()) {
	    	return response()->json([
	    		'success' => true,
	    		'message' => 'You have created challenge successfully.',
	    	]);
	    }
	}

	public function myChallengelist(Game $selectedGame){
		dd($selectedGame);
	}
}
