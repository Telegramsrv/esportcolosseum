<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Game;

class DashboardController extends Controller
{
	public function index(Game $selectedGame) {
		return view("user.dashboard.index")->with(['selectedGame' => $selectedGame]);
	}
}
