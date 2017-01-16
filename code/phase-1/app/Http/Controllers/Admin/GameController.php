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
		$games = Game::with('user')->get();
		return view("admin.game.index", compact('games'));
	}
	
	public function add() {
		return view("admin.game.add");
	}
	
	public function save(SaveBlog $request){
		$input = $request->all();
		
		//save 	display_image
		if(!empty($request->hasFile('menu_image'))){
			$input['display_image'] = saveMedia($request->file('menu_image'), 'UPLOAD_GAME_MENU_IMAGE');
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
	
	public function update(SaveBlog $request, $gameId){
		$game = Game::findOrFail($gameId);
		$input = $request->all();
		//update display_image
		if(!empty($request->hasFile('menu_image'))){
			if(!empty($blog->menu_image)){
				removeMedia($blog->menu_image, 'UPLOAD_GAME_MENU_IMAGE');
			}
			$input['menu_image'] = saveMedia($request->file('menu_image'), 'UPLOAD_GAME_MENU_IMAGE');
		}
		//update banner_image
		if(!empty($request->hasFile('banner_image'))){
			if(!empty($blog->banner_image)){
				removeMedia($blog->banner_image, 'UPLOAD_BLOG_BANNER');
			}
			$input['banner_image'] = saveMedia($request->file('banner_image'), 'UPLOAD_GAME_BANNER');
		}
		$game->update($input);
		$request->session()->flash('alert-success', 'Game updated successfully.');
		return redirect()->route('admin.game.list');
	}
	
	public function delete(SaveBlog $request, $gameId) {
		$blog = Game::findOrFail($gameId);
		$blog->delete();
		return redirect()->route('admin.game.list');
	}
	
}
