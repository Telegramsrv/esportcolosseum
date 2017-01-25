<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\Blog;
use App\Models\Game;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;

class HomeController extends Controller
{
    public function index(Game $selectedGame){
        $blogs = Blog::active()->latestFour()->get();
    	return view("user.home.index")->with(['blogs' => $blogs, 'selectedGame' => $selectedGame]);
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
            return redirect()->intended(URL::route('/'));
        }
    }
}

