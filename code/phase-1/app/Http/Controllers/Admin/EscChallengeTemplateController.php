<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\EscChallengeTemplate\SaveEscChallengeTemplate;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\EscChallengeTemplate;
use Illuminate\Support\Facades\Hash;

class EscChallengeTemplateController extends Controller
{
	public function index() {
		$escChallengeTemplates = EscChallengeTemplate::all();
		return view("admin.esc-challenge-template.index", compact('escChallengeTemplates'));
	}
	
	public function add() {
		return view("admin.esc-challenge-template.add");
	}
	
	public function save(SaveEscChallengeTemplate $request){
		$input = $request->all();
		$escChallengeTemplate = new EscChallengeTemplate($input);
		$escChallengeTemplate->save();
 		$request->session()->flash('alert-success', 'Esc challenge template added successfully.');
 		return redirect()->route('admin.esc-challenge-template.list');
	}
	
	public function edit($challengeId) {
		$escChallengeTemplate = EscChallengeTemplate::findOrFail($challengeId);
		return view("admin.esc-challenge-template.edit", compact('escChallengeTemplate'));
	}
	
	public function update(SaveEscChallengeTemplate $request, $challengeId){
		$escChallengeTemplate = EscChallengeTemplate::findOrFail($challengeId);
		$input = $request->all();
		$escChallengeTemplate->update($input);
		$request->session()->flash('alert-success', 'Esc challenge template updated successfully.');
		return redirect()->route('admin.esc-challenge-template.list');
	}
	
	public function delete(SaveEscChallengeTemplate $request, $challengeId) {
		$escChallengeTemplate = EscChallengeTemplate::findOrFail($challengeId);
		$escChallengeTemplate->delete();
		return redirect()->route('admin.esc-challenge-template.list');
	}
	
	
}
