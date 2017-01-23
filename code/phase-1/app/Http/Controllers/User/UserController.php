<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Game;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\SaveUser;

class UserController extends Controller
{
    public function showProfile(User $user, Game $selectedGame){
    	return view('user.my-account.profile', compact('user', 'selectedGame'));
    }

    public function editProfile(){
    	$userDetails = Auth::user()->userDetails;

    	$countries = Country::all()->pluck('name', 'id');	
    	$countries->prepend("Select Country", '');

    	return view('user.my-account.edit-profile', compact('userDetails', 'countries'));
    }

    public function updateProfile(SaveUser $request){
    	$input = $request->all();
    	$userDetails = Auth::user()->userDetails;	

    	if($request->hasFile('user_image')){
            $destinationPath 	= public_path(env('PROFILE_PICTURE_PATH'));

            if(isset($userDetails->user_image)){
            	deleteMedia($destinationPath . $userDetails->user_image);
            }
            
            $file = $request->file('user_image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);
            $input['user_image'] = $filename;
        }

        $userDetails->update($input);
        return redirect(route('user.dashboard'));
    }
}
