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
use App\Mail\WithdrawFundUserMail;
use App\Mail\WithdrawFundAdminMail;
use App\Models\WithdrawFundRequest;
use App\Models\UserBankDetails;

class UserController extends Controller
{
    public function showProfile(User $user, Game $selectedGame){
    	return view('user.my-account.profile', compact('user', 'selectedGame'));
    }

    public function editProfile(){
    	$userDetails = Auth::user()->userDetails;
    	
    	$userBankDetails = Auth::user()->userBankDetails;
    	
    	$userDetails->account_no = '';
    	$userDetails->account_name = '';
    	$userDetails->account_swift_code = '';
    	$userDetails->paypal_id = '';
    	
    	if($userBankDetails){
	    	if($userBankDetails->account_no != ''){
	    		$userDetails->account_no = decrypt($userBankDetails->account_no);
	    	}
	    	if($userBankDetails->account_name != ''){
	    		$userDetails->account_name = decrypt($userBankDetails->account_name);
	    	}
	    	if($userBankDetails->account_swift_code != ''){
	    		$userDetails->account_swift_code = decrypt($userBankDetails->account_swift_code);
	    	}
	    	if($userBankDetails->paypal_id != ''){
	    		$userDetails->paypal_id = decrypt($userBankDetails->paypal_id);
	    	}
    	}
    	
    	$countries = Country::all()->pluck('name', 'id');	
    	$countries->prepend("Select Country", '');

    	return view('user.my-account.edit-profile', compact('userDetails', 'countries'));
    }

    public function updateProfile(SaveUser $request){
    	$input = $request->except(['account_no', 'account_name', 'account_swift_code', 'paypal_id']);
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
        
        
        $input = $request->only(['account_no', 'account_name', 'account_swift_code', 'paypal_id']);
        $userBankDetails = UserBankDetails::firstOrNew(array('user_id' => Auth::user()->id));
        $userBankDetails->account_no = '';
        $userBankDetails->account_name = '';
        $userBankDetails->account_swift_code = '';
        $userBankDetails->paypal_id = '';
        
        if($input['account_no'] != ''){
        	$userBankDetails->account_no = encrypt($input['account_no']);
        }
    	if($input['account_name'] != ''){
        	$userBankDetails->account_name = encrypt($input['account_name']);
        }
        if($input['account_swift_code'] != ''){
        	$userBankDetails->account_swift_code = encrypt($input['account_swift_code']);
        }
        if($input['paypal_id'] != ''){
        	$userBankDetails->paypal_id = encrypt($input['paypal_id']);
        }
        $userBankDetails->save();
       
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
    	if(Auth::user()->userBankDetails && (Auth::user()->userBankDetails->paypal_id != '' || (Auth::user()->userBankDetails->account_no != '' && Auth::user()->userBankDetails->account_name != '' && Auth::user()->userBankDetails->account_swift_code != ''))){
    		$options = getOptions();
	    	$requestData = $request->all();
	    	
	    	$input['user_id'] = Auth::user()->id;
	    	$input['source_id'] = 7;
	    	$input['coins'] = $requestData['withdrawFund'];
	    	$input['transaction_type'] = 'Debit';
	    	$input['challenge_id'] = 0;
	    	$CoinTransections = new CoinTransections($input);
	    	$CoinTransections->save();
	    
	    	//UPDATE USER COINS
	    	$userDetails = Auth::user()->userDetails;
	    	$updatedCoins = Auth::user()->userDetails->coins - $input['coins'];
	    	$userDetails->update(['coins' => $updatedCoins]);
	    	
	    	//SAVE WITHDRAW FUND REQUEST
	    	$totalAmount = round($requestData['withdrawFund'] / $options->coins_per_dollar, 2);
	    	$serviceCharge = ($totalAmount * $options->service_charge) / 100;
	    	$amount = $totalAmount - $serviceCharge;
	    	
	    	$data['user_id'] = $input['user_id'];
	    	$data['coins']	 = $input['coins'];
	    	$data['coins_per_dollar'] = $options->coins_per_dollar;
	    	$data['total_amount'] = $totalAmount;
	    	$data['service_charge'] = $options->service_charge;
	    	$data['esc_charge'] = $serviceCharge;
	    	$data['amount_given'] = $amount;
	    	$data['status'] = 'InProcess';
	    	
	    	$withdrawFundRequest = new WithdrawFundRequest($data);
	    	$withdrawFundRequest->save();
	    	
	    	//MAIL TO USER & ADMIN
	    	$mailData['email'] = Auth::user()->email;
	    	$mailData['coins'] = $input['coins'];
	    	$mailData = (object) $mailData;
	    	Mail::to(Auth::user()->email)->send(new WithdrawFundUserMail($mailData));
	    	Mail::to(env('FROM_EMAIL'))->send(new WithdrawFundAdminMail($mailData));
	    	
	    	return response()->json([
	    			'intended' => URL::to(url()->previous())
	    	]);
    	}
    	else{
    		return response()->json([
    				'intended' => URL::to('user/profile/edit'),
    				'error' => 1
    		]);
    	}
    }

//Remove User Notification
    public function removeNotifications(Request $request){
        $notification = Notification::where(DB::raw('md5(id)'), $request->notificationID)->where('user_id', Auth::id())->firstOrFail();
        //Remove Notification
        $notification->delete();
    }
}
