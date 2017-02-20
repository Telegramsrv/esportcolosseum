<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\Challenge\CreateOpenChallengeRequest;
use App\Http\Requests\Challenge\ChangeChallengeStatusRequest;
use App\Http\Requests\Challenge\AcceptChallengeRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Game;
use App\Models\Region;
use App\Models\Team;
use App\Models\Challenge;
use App\Models\EscChallengeTemplate;
use Carbon\Carbon;
use DB;

class ChallengeController extends Controller
{
	public function listOpenChallenges(Game $selectedGame){
		$regions = Region::all()->pluck('name', 'id');	
		$regions->prepend("Select Region", '');
		$challengeModes = ['' => 'Select Mode', 'captain-pick' => 'Captain\'s Pick', 'team' => 'Team'];

		$excludeChallengesArr = array_column(Challenge::myChallenges(Auth::user())->get(['id'])->toArray(), 'id');

		$challenges = Challenge::with(["captain", "captainDetails"])
						->challengesForGame($selectedGame)
						->whereNotIn('id', $excludeChallengesArr)
						->currentChallenges()
						->notAcceptedByOpponent()
						->paginate(env('RECORDS_PER_PAGE'));

		return view("user.challenge.open-challenge-list", compact('selectedGame', 'regions', 'challengeModes', 'challenges'));
	}

	public function saveOpenChallenge(createOpenChallengeRequest $request, Game $selectedGame){
		$input = $request->all();

		// $input['user_id'] = Auth::user()->id;
		$input['game_id'] = $selectedGame->id;
		$input['challenge_status'] = 'created';
		$input['valid_upto'] = Carbon::createFromFormat('Y-m-d H', date('Y-m-d H'))->addHours(72);

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
		$myCurrentChallenges = Challenge::myChallenges($user)
								->challengesForGame($selectedGame) 
								->challengesPerType($challengeType)
								->currentChallenges()
								->get();
		$myPastChallenges = Challenge::myChallenges($user)
								->challengesForGame($selectedGame) 
								->challengesPerType($challengeType)
								->pastChallenges()
								->get();
		return view("user.challenge.my-challenge-list", compact('selectedGame', 'myCurrentChallenges', 'myPastChallenges'));
	}

	public function listEscChallenges(Game $selectedGame){
		$escChallangeTemplates = EscChallengeTemplate::all();
		$settings = getOptions();

    	return view("user.challenge.esc-challenge-list", compact('selectedGame', 'settings', 'escChallangeTemplates'));
    }

    /**
     * This function is used to complete challenge.
     * @param  ChangeChallengeStatusRequest $request Request Parameter
     */
    public function changeStatus(ChangeChallengeStatusRequest $request){
    	$input = $request->all();
    	$challenge = Challenge::where(DB::raw('md5(id)'), $input['challenge_id'])->firstOrFail();

    	switch($input['challenge_status']){
    		case md5('challenger-submitted'):
    			$challenge->challenge_status = 'challenger-submitted';
    			$challenge->update();
    			break;
    		case md5('cancelled'):
    			$challenge->challenge_status = 'cancelled';
    			$challenge->update();
    			break;
            case md5('opponent-submitted'):
                $challenge->challenge_status = 'opponent-submitted';
                $challenge->update();
                break;
    		default:
    			break;
    	}
    	
    	return redirect()->back();
    }

    /**
     * This function is used to check all current games and 
     * 	- set to "cancelled" if expired(current time > 'valid_upto' field)
     * 
     */
    public function makeChallengeExpire(){
    	$challenges = Challenge::currentGames()->get();
    	$now = Carbon::now();

    	foreach($challenges as $challenge){
    		if($now->gt($challenge->valid_upto)){
    			$challenge->challenge_status = 'cancelled';
    			$challenge->save();
    		}
    	}
    }

    /**
     * This function is used to accept any valid challenge.
     * @param  AcceptChallengeRequest $request [description]
     * @return [type]                          [description]
     */
    public function acceptChallenge(AcceptChallengeRequest $request){
    	$input = $request->all();
    	
    	$challenge = Challenge::where(DB::raw('md5(id)'), $input['challenge_id'])->firstOrFail();
    	$challenge->opponent_id = Auth::user()->id;
    	$challenge->challenge_status = 'opponent-accepted';
    	$challenge->save();
    	
    	return redirect()->route('user.my-challenge.list', ['gameSlug' => $challenge->game->slug, 'challengeType' => 'open']);
    }
}
