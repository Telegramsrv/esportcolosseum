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
		return view("user.challenge.challenge-list")->with(['selectedGame' => $selectedGame, 'regions' => $regions, 'challengeModes' => $challengeModes]);
	}

	public function saveOpenChallenge(createOpenChallengeRequest $request, Game $selectedGame){
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
	    		'intended' => route('user.my-challenge.list', ['gameSlug' => $selectedGame->slug, 'challengeType' => $challenge->challenge_type])
	    	]);
	    }
	}

	public function myChallengelist(Game $selectedGame, $challengeType){
		$user = Auth::user();
		$myCurrentChallenges = Challenge::myChallengesPerGamePerName($user, $selectedGame, $challengeType)->currentGames()->get();
		$myPastChallenges = Challenge::myChallengesPerGamePerName($user, $selectedGame, $challengeType)->pastGames()->get();

		return view("user.challenge.my-challenge-list", compact('selectedGame', 'myCurrentChallenges', 'myPastChallenges'));
	}

	public function listEscChallenges(Game $selectedGame){
		$escChallengeInterval = 3;
    	return view("user.challenge.esc-challenge-list", compact('selectedGame', 'escChallengeInterval'));
    }
}
