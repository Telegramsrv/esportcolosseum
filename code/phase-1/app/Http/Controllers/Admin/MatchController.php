<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Challenge;

class MatchController extends Controller
{
public function index() {
		$matches = Challenge::all();
		return view("admin.match.index", compact('matches'));
	}
	
	public function edit($matchId) {
		$match = Challenge::findOrFail($matchId);
		return view("admin.match.edit", compact('match'));
	}
	
	public function update(SavePage $request, $matchId){
		$match = Challenge::findOrFail($matchId);
		$input = $request->all();
		$match->update($input);
		$request->session()->flash('alert-success', 'Match updated successfully.');
		return redirect()->route('admin.match.list');
	}
}
