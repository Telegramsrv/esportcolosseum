<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Game\SaveGame;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Game;
use Illuminate\Support\Facades\Hash;

class GameController extends Controller
{
	public function index() {
		$games = Game::all();
		return view("admin.game.index", compact('games'));
	}
	
	public function add() {
		return view("admin.game.add");
	}
	
	public function save(SaveGame $request){
		$input = $request->all();
		
		//save 	display_image
		if(!empty($request->hasFile('image'))){
			$input['image'] = saveMedia($request->file('image'), 'UPLOAD_GAME_THUMBNAIL');
		}
		//save	banner_image
		if(!empty($request->hasFile('banner_image'))){
			$input['banner_image'] = saveMedia($request->file('banner_image'), 'UPLOAD_GAME_BANNER');
		}
		
		$game = new Game($input);
		$game->save();
 		$request->session()->flash('alert-success', 'Game added successfully.');
 		return redirect()->route('admin.game.list');
	}
	
	public function edit($gameId) {
		$game = Game::findOrFail($gameId);
		return view("admin.game.edit", compact('game'));
	}
	
	public function update(SaveGame $request, $gameId){
		$game = Game::findOrFail($gameId);
		$input = $request->all();
		//update display_image
		if(!empty($request->hasFile('image'))){
			if(!empty($game->image)){
				removeMedia($game->image, 'UPLOAD_GAME_THUMBNAIL');
			}
			$input['image'] = saveMedia($request->file('image'), 'UPLOAD_GAME_THUMBNAIL');
		}
		//update banner_image
		if(!empty($request->hasFile('banner_image'))){
			if(!empty($game->banner_image)){
				removeMedia($game->banner_image, 'UPLOAD_GAME_BANNER');
			}
			$input['banner_image'] = saveMedia($request->file('banner_image'), 'UPLOAD_GAME_BANNER');
		}
		$game->update($input);
		$request->session()->flash('alert-success', 'Game updated successfully.');
		return redirect()->route('admin.game.list');
	}
	
	public function delete(SaveGame $request, $gameId) {
		$game = Game::findOrFail($gameId);
		$game->status = "Deleted";
		$game->save();
		return redirect()->route('admin.game.list');
	}
	
}
