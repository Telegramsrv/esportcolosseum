<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Team\CreateTeamRequest;
use App\Models\Team;
use App\Models\Challenge;
use App\User;
use Auth;

class TeamController extends Controller
{
	/**
	 * This method is used to create team.
	 * @return [type] [description]
	 */
    public function save(CreateTeamRequest $request){
    	dd($request->all());
    	$input = $request->only('name');
    	$team = Team::create($input);
    	$user = Auth::user();

    	$team->users()->attach($user);
	}    	
}
