<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\SaveUser;
use App\Http\Requests\User\PasswordRequest;
use App\Http\Requests\User\SaveCoins;
use App\Http\Requests\User\SearchMembers;
use App\User;
use App\Models\Game;
use App\Models\Country;
use App\Models\CoinTransections;
use Illuminate\Support\Facades\URL;
use App\Models\UserDetails;
use App\Models\UserFriends;
use DB;

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

    public function editPassword(){
        return view('user.my-account.change-password');
    }

    public function updatePassword(PasswordRequest $request){
        $input = $request->only('password');
        $input['password'] = bcrypt($input['password']);
        $user = Auth::user();
        $user->update($input);

        return redirect(route('user.dashboard'));
    }
    
    public function updateCoins(SaveCoins $request){
    	$options = getOptions();
    	$requestData = $request->all();
    	$input['user_id'] = Auth::user()->id;
    	$input['source_id'] = 7;
    	//$input['coins'] = $requestData['amount'] * $options->coins_per_dollar;
    	$input['coins'] = $requestData['coins'];
    	$input['transaction_type'] = 'Credit';
    	$input['challenge_id'] = 0;
		$CoinTransections = new CoinTransections($input);
		$CoinTransections->save();
		
		$userDetails = Auth::user()->userDetails;
		$updatedCoins = Auth::user()->userDetails->coins + $input['coins'];
		$userDetails->update(['coins' => $updatedCoins]);
		
		return response()->json([
				'intended' => URL::to(url()->previous())
		]);
    }
    
    public function coinCalculation(SaveCoins $request){
    	$requestData = $request->all();
    	$options = getOptions();

    	if($requestData['coins'] > 0 && preg_match('/^[0-9]+$/', $requestData['coins'])){
    		$amount = "$".round($requestData['coins'] / $options->coins_per_dollar, 2);
    	}
    	else{
    		$amount = 'Invalid';
    	}
    	return response()->json([
				'amount' => $amount
		]);
    }
    
    public function memberSearch(SearchMembers $request){
    	$requestData = $request->all();
    	
    	$user = User::with('userDetails')
    						->whereHas('roles', function($q){
					    		$q->where('name', 'user');
					    	})
					    	->where('email', $requestData['search'])
					    	->where('status', 'Active')
					    	->where('id', '!=', Auth::id())
					    	->first();
    	
    	if(!$user){
    		$user = User::with('userDetails')
    							->whereHas('roles', function($q){
    								$q->where('name', 'user');
    							})
			    				->whereHas('userDetails', function($q){
			    					$q->where('gamer_name', \Request::all()['search']);
			    				})
			    				->where('status', 'Active')
			    				->where('id', '!=', Auth::id())
			    				->first();
    	}
    		
    	if($user){
    		$member = array('id' => $user->id, 'name' => $user->userDetails->first_name." ".$user->userDetails->last_name, 'image' => $user->userDetails->user_image);
    		$errorBool = false;
    		
    		$buttonText = 'Add Friend';
    		$friendsData = DB::table('user_friends')->where('user_id', Auth::id())->where('friend_id', $user->id)->first();
    		if($friendsData){
    			if($friendsData->status == 'Invited'){
    				$buttonText = 'Invited';
    			}
    		}
    		
    		$html = '<div class="player-section"><div class="player-image"><img src="'.url(env('PROFILE_PICTURE_PATH').$member['image']).'"></div><div class="player-informations">';
    		$html .= '<h2>'.$member['name'].'</h2>';
    		
    		$friendsData = DB::table('user_friends')->where(array('user_id' => Auth::id(), 'friend_id' => $user->id))
    												->orWhere(array('friend_id' => Auth::id(), 'user_id' => $user->id))
    												->first();
    		if($friendsData){
    			if($friendsData->status == 'Invited' && Auth::id() == $friendsData->user_id){
    				$html .= '<a id="addFriend" class="addFriend waves-effect waves-light btn deep-orange">REQUESTED</a>';
    			}
    			else if($friendsData->status == 'Invited' && Auth::id() == $friendsData->friend_id){
    				$html .= '<a id="addFriend" onClick="acceptFriend('.$member['id'].')" class="addFriend waves-effect waves-light btn deep-orange">ACCEPT</a>';
    				$html .= '&nbsp;&nbsp;<a id="rejectFriend" onClick="rejectFriend('.$member['id'].')" class="addFriend waves-effect waves-light btn deep-orange">REJECT</a>';
    			}
    		}
    		else{
    			$html .= '<a id="addFriend" onClick="addFriend('.$member['id'].')" class="addFriend waves-effect waves-light btn deep-orange">ADD FRIEND</a>';
    		}
    		
    		$html .= '</div></div>';
    	}
    	else{
    		$errorBool = true;
    		$html = '<div id="message">No members found!</div>';
    	}
    	
    	if ($request->ajax()) {
    		return response()->json([
    				'html' => $html,
    				'error' => $errorBool
    		]);
    	}
    }
    
    function addFriend(){
    	$requestData = \Request::all();
    	
    	if($requestData['friendID'] > 0){
    		$data['user_id'] = Auth::id();
    		$data['friend_id'] = $requestData['friendID'];
    		$data['status'] = 'Invited';
    		$userFriends = new UserFriends($data);
    		$userFriends->save();
    	}
    	
    	if (\Request::ajax()) {
    		return response()->json([
    				'html' => "REQUESTED"
    		]);
    	}
    }
    
    function acceptFriend(){
    	$requestData = \Request::all();
    	$userFriends = UserFriends::where('user_id', $requestData['friendID'])->where('friend_id', Auth::id())->where('status', "Invited")->firstOrFail();
    	
    	$userFriends->status = 'Accepted';
    	$userFriends->update();
    	 
    	if (\Request::ajax()) {
    		return response()->json([
    				'html' => "ACCEPTED"
    		]);
    	}
    }
    
    function rejectFriend(){
    	$requestData = \Request::all();
    	$userFriends = UserFriends::where('user_id', $requestData['friendID'])->where('friend_id', Auth::id())->where('status', "Invited")->firstOrFail();
    	 
    	$userFriends->delete();
    
    	if (\Request::ajax()) {
    		return response()->json([
    				'html' => "REJECTED"
    		]);
    	}
    }
    
    
    
    function myFriends() {
    	$user_id = Auth::id();
    	$userFriends = UserFriends::with("userFriendDetails")->where('user_id', $user_id)->where("status", "Accepted")->get();
    	return view('user.my-account.my-friends', compact('userFriends'));
    }
}
