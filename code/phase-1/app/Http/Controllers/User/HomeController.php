<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\Game;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;

class HomeController extends Controller
{

    public function index(){
    	$games = Game::All();
    	return view("user.home.index")->with(["games" => $games]);
    }
    
    /*
     * This function is used to recover user password.
     */
    public function forgotPassword(ForgotPasswordRequest $request){
        $input = $request->all();
        $newPassword = str_random(8);

        $user = User::where('email', "=", $input['email'])->firstOrFail();
        $user->password = bcrypt($newPassword);
        $user->save();            

        $recoverPassword = new User();
        $recoverPassword->email = $input['email'];
        $recoverPassword->password = $newPassword;

        // Send mail for new password to user.
        Mail::to($user)->send(new ForgotPasswordMail ($recoverPassword));

        if ($request->ajax()) {
                return response()->json([
                        'success' => true,
                        'message' => "System has sent password to you email address.",
                        'intended' => URL::to("/")
                    ]);
        }
        else{
            return redirect()->intended(URL::route('dashboard'));
        }


        dd($request->all()); 
    }
}

