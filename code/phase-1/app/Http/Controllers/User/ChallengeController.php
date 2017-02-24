<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\Challenge\CreateOpenChallengeRequest;
use App\Http\Requests\Challenge\CreateEscChallengeRequest;
use App\Http\Requests\Challenge\ChangeChallengeStatusRequest;
use App\Http\Requests\Challenge\AcceptChallengeRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Game;
use App\Models\Region;
use App\Models\Team;
use App\Models\Challenge;
use App\Models\CoinTransections;
use App\Models\EscChallengeTemplate;
use Carbon\Carbon;
use DB;

class ChallengeController extends Controller
{
	public function listOpenChallenges(Game $selectedGame){
		$regions = Region::all()->pluck('name', 'id');	
		$regions->prepend("Select Region", '');
		$challengeModes = ['' => 'Select Mode', 'captain-pick' => 'Captain\'s Pick', 'team' => 'Team'];

		$activeChallengesArr = array_column(Challenge::myChallenges(Auth::user())->currentChallenges()->get(['id'])->toArray(), 'id');
        
        $canUserAcceptChallenge = (count($activeChallengesArr) > 0) ? false : true;

		$challenges = Challenge::with(["captain", "captainDetails"])
						->challengesForGame($selectedGame)
						->whereNotIn('id', $activeChallengesArr)
						->currentChallenges()
						->notAcceptedByOpponent()
						->paginate(env('RECORDS_PER_PAGE'));

		return view("user.challenge.open-challenge-list", compact('selectedGame', 'regions', 'challengeModes', 'challenges', 'canUserAcceptChallenge'));
	}

	public function saveOpenChallenge(createOpenChallengeRequest $request, Game $selectedGame){
		$input = $request->all();

		$input['user_id'] = Auth::user()->id;
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

	public function listEscChallenges(Game $selectedGame, Request $request){
        if ($request->ajax()) {
            $input = $request->all();
            $html = "";
            if(!empty($input["date"]) && isset($input["time"])) {
                $date = Carbon::parse($input["date"]);
                $date->addHour($input["time"]);
                $escChallangeTemplates = EscChallengeTemplate::all();
                if($escChallangeTemplates->count() > 0 ) {
                    $challenges = Challenge::escChallengeByGameDateTime($date, $selectedGame->id)->whereIn('challenge_status', ['challenger-submitted', 'opponent-submitted'])->get();
                    $html = generateEscChallengeTemplate($escChallangeTemplates, $challenges, $selectedGame, $input);
                }
            }
            
            return response()->json(['success' => true, 'challenge_html' => $html]);

        } else {
            $escChallangeTemplates = EscChallengeTemplate::all();
            $settings = getOptions();

            return view("user.challenge.esc-challenge-list", compact('selectedGame', 'settings', 'escChallangeTemplates'));
        }
		
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


    public function saveEscChallenge(createEscChallengeRequest $request, Game $selectedGame){
        $input = $request->all();
        $date = Carbon::parse($input["date"]);
        $date->addHour($input["time"]);

        //get my esc challenges count for this date
        $myChallengeCount = Challenge::myEscChallenges(Auth::user())->escChallengeByGameDateTime($date, $selectedGame->id)->currentChallenges()->count();

        if($myChallengeCount <= 0) {

            //get all esc challenges for this date
            $challenge = Challenge::escChallengeByGameDateTime($date, $selectedGame->id)->whereIn('challenge_status', ['challenger-submitted'])->first();
        
            if(!empty($challenge)) {
                //oppenent added for challenge
                $challenge->opponent_id = Auth::id();
                $challenge->challenge_status = 'opponent-submitted';
                $members = "0 / 0";
            } else {
                //create new challenge for this date
                $challenge = new Challenge($request->only(['coins', 'win_coins', 'game_type', 'esc_challenge_template_id']));
                $challenge->user_id = Auth::id();
                $challenge->game_id = $selectedGame->id;
                $challenge->challenge_type = 'esc';
                $challenge->challenge_sub_type = 'captain-pick';
                $challenge->challenge_status = 'challenger-submitted';
                $challenge->esc_date = $date;
                $challenge->valid_upto = $date->subMinute(30);
                $members = "1 / 2";
            }

            $challenge->save();

            //update user coin 
            $userDetails = Auth::user()->userDetails;
            $userDetails->update(['coins' => ($userDetails->coins - $challenge->coins)]);

            //coin transaction         
            $coinTransections = new CoinTransections(['source_id' => 7, 'coins' => $challenge->coins, 'transaction_type' => 'Debit', 'challenge_id' => $challenge->id]);
            Auth::user()->coinTransections()->save($coinTransections);

           
             $res = [
                'success' => true,
                'members' => $members,
                'message' => 'You have created challenge successfully.',
            ];

        } else {
            $res = [
                'success' => false,
                'message' => 'You can no create challenge at this time.',
            ];
        }

        if ($request->ajax()) {
            return response()->json($res);
        }
    }

    
}
