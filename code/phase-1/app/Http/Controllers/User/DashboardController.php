<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Challenge;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
	public function index(Game $selectedGame) {
		$matchHistory = Challenge::with(["opponentDetails"])
							->myChallenges(Auth::user())
							->challengeStatus('completed')
							->paginate(env('PAGINATION_LINK_LIMIT'));
		return view("user.dashboard.index")->with(['selectedGame' => $selectedGame, 'matchHistory' => $matchHistory]);
	}
}
