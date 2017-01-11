<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\Game;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index(){
    	$games = Game::All();
    	return view("user.home.index")->with(["games" => $games]);
    }
    
    /*
     * This function is used to verify user account.
     * Input
     * 		- $verificationCode - string
     * 
     */
    public function verifyUserAccount($verificationCode){
    	$user = User::where([
    							[DB::raw('md5(email)'), $verificationCode],
    							['status', '=', 'Inactive'],
							])->firstOrFail();
    	
    	$user->status = "Active";
    	$user->save();
    	
    	return view("user.home.notify-user-verification")->with(["user" => $user]);
    }
}

