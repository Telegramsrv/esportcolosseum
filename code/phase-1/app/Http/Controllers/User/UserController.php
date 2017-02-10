<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\SaveUser;
use App\Http\Requests\User\PasswordRequest;
use App\Http\Requests\User\SaveCoins;
use App\Http\Requests\User\SearchMembers;
use App\Http\Requests\User\InviteFriend;
use App\User;
use App\Models\Game;
use App\Models\Country;
use App\Models\CoinTransections;
use Illuminate\Support\Facades\URL;
use App\Models\UserDetails;
use App\Models\UserFriends;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\FriendRequestMail;
use App\Models\Notification;

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
    
    function addFriend(InviteFriend $request){
    	$requestData = $request->all();
    	$status = 0;
    	
    	if(!empty($requestData['friend_id']) && $requestData['friend_id'] > 0 && !UserFriends::isUserFriend(Auth::id(), $requestData['friend_id'])) {
    		$userFriends = new UserFriends(["user_id" => Auth::id(), "friend_id" => $requestData['friend_id'], "status" => "Invited"]);
    		$userFriends->save();
    		
    		//Save Notification
    		$data['user_id'] = $requestData['friend_id'];
    		$data['message'] = Auth::user()->email." has sent you friend request.";
    		$data['type'] = 'Friend Request';
    		$options = array('from_id' => Auth::id());
    		$data['data'] = json_encode($options);
    		
    		$notification = new Notification($data);
    		$notification->save();
    		
    		//Send Conversion Mail to friend
    		$user = User::findOrFail($requestData['friend_id']);
    		Mail::to($user)->send(new FriendRequestMail($user));
    		
    		$status = 1;
    	} 
    	
    	if (\Request::ajax()) {
    		return response()->json([
    				'status' => $status
    		]);
    	}
    }
    
    function acceptFriend(){
    	$requestData = \Request::all();
    	$userFriends = UserFriends::where('user_id', $requestData['friendID'])->where('friend_id', Auth::id())->where('status', "Invited")->firstOrFail();
    	
    	$userFriends->status = 'Accepted';
    	$userFriends->update();
    	
    	$notification = Notification::findOrFail($requestData['notificationID']);
    	$notification->delete();
    	 
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
    	
    	$notification = Notification::findOrFail($requestData['notificationID']);
    	$notification->delete();
    
    	if (\Request::ajax()) {
    		return response()->json([
    				'html' => "REJECTED"
    		]);
    	}
    }
    
    
    
    function myFriends() {
    	$user_id = Auth::id();
    	$userFriends = UserFriends::getUserFriends();
    	//$userFriends = UserFriends::with("userFriendDetails")->where('user_id', $user_id)->Orwhere('friend_id', $user_id)->where("status", "Accepted")->get();
    	return view('user.my-account.my-friends', compact('userFriends'));
    }
    
    function fetchAutocompleteList(Request $request) {
    	$requestData = $request->all();
    	$users = User::where('id', '!=', Auth::id())->active()->roleType('user')->seachGamerNameOrEmail($requestData["name"])->notUserFriends(Auth::id())->get();
    	$userLists = [];
    	foreach($users as $user){
    		$user = array("id" => $user->id,
	    				 "label" => $user->userDetails->first_name . " " . $user->userDetails->last_name,
	    				 "value" => $user->userDetails->first_name . " " . $user->userDetails->last_name);
    		array_push($userLists,$user);
    	}
    	if ($request->ajax()) { 
    		return response()->json(["succes" => true,'response' => json_encode($userLists)]);
    	}
    }
    
    
    public function withdrawFundCalculation(Request $request){
    	$requestData = $request->all();
    	$options = getOptions();
    
    	if($requestData['withdrawFund'] > 0 && preg_match('/^[0-9]+$/', $requestData['withdrawFund'])){
    		if(isset(Auth::user()->userDetails->coins) && Auth::user()->userDetails->coins >= $requestData['withdrawFund']){
    			$amount = round($requestData['withdrawFund'] / $options->coins_per_dollar, 2);
    			$serviceCharge = ($amount * $options->service_charge) / 100;
    			$amount = "$".($amount - $serviceCharge);
    		}
    		else{
    			$amount = 'Invalid';
    		}
    	}
    	else{
    		$amount = 'Invalid';
    	}
    	return response()->json([
    			'amount' => $amount
    	]);
    }
    
    public function updateWithdrawFund(SaveCoins $request){
    	if(Auth::user()->userDetails->paypal_id != '' || (Auth::user()->userDetails->account_no != '' && Auth::user()->userDetails->account_name != '' && Auth::user()->userDetails->account_swift_code != '')){
    		$options = getOptions();
	    	$requestData = $request->all();
	    	$input['user_id'] = Auth::user()->id;
	    	$input['source_id'] = 7;
	    	$input['coins'] = $requestData['withdrawFund'];
	    	$input['transaction_type'] = 'Debit';
	    	$input['challenge_id'] = 0;
	    	$CoinTransections = new CoinTransections($input);
	    	$CoinTransections->save();
	    
	    	$userDetails = Auth::user()->userDetails;
	    	$updatedCoins = Auth::user()->userDetails->coins - $input['coins'];
	    	$userDetails->update(['coins' => $updatedCoins]);
	    
	    	return response()->json([
	    			'intended' => URL::to(url()->previous())
	    	]);
    	}
    	else{
    		return response()->json([
    				'intended' => URL::to('user/profile/edit')
    		]);
    	}
    }
}
