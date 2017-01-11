<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index(){
    	return view("user.home.index");
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
