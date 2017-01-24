<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App\Http\Requests\Auth\LoginRequest;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    
    public function login(LoginRequest $request){
    	
    	$credentials = $request->only('email', 'password');
    	
    	if ($this->attemptLogin($request)) {
    		$this->sendLoginResponse($request);
            Auth::user()->last_login = \Carbon\Carbon::now();
            Auth::user()->save();
    	}
    	else{
    		$errors = array(
    			'password' => array(
    				'Please provide valid credentials to login'
    			)
    		);
    		return response()->json($errors, 422);
    	}
    	
    	$this->incrementLoginAttempts($request);
	    
	    if ($request->ajax()) {
	    		return response()->json([
	    				'intended' => URL::to("/")
	    				]);
	    }
	    else{
	    	return redirect()->intended(URL::route('dashboard'));
	    }
    }
}
