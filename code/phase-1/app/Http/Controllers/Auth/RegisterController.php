<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Role;
use App\Models\UserDetails;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserWelcomeMail;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    
    public function register(RegisterRequest $request){
    	$userInput = $request->only('email', 'password');
        $userInput['password']      = bcrypt($userInput['password']);
        $userInput['ip_address']    = request()->ip();
        $userInput['status']        = 'Active';
        $userInput['last_login']    = \Carbon\Carbon::now();
        $user                       = User::create($userInput);

    	$userRole = Role::where("name", "=", "user")->firstOrCreate(
    		array(
    			'name' => 'user',
    			'display_name' => 'User',
    			'description' => 'User role for user'		
    		)
    	);
    	$user->attachRole($userRole);

        $userDetailsInput = $request->only('first_name', 'last_name', 'gamer_name');
        $user->userDetails()->save(new UserDetails($userDetailsInput));

        // Send welcome email to newly registered user!
        Mail::to($user)->send(new UserWelcomeMail ($user));

    	if($user->id){
            Auth::login($user);
    		return response()->json([
    				'success' => true,
    				'message' => "You have been registered successfully. Kindly login to continue!",
                    'intended' => URL::to("/")
    				]);
    	}
    	else{
    		$errors = array(
    				'email' => array(
    						'something went wrong!'
    				)
    		);
    		return response()->json($errors, 422);
    	}
    }
}
