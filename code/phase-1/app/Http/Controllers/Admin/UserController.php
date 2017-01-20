<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\User\SaveUser;
use App\Http\Requests\User\SaveCoins;
use App\Http\Requests\User\PasswordRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Country;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;
//use Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;
use App\Models\Role;

class UserController extends Controller
{
	public function index() {
		$users = User::with('userDetails')->get();
		return view("admin.user.index", compact('users'));
	}
	
	public function add() {
		$countries = Country::orderBy('name')->pluck('name', 'id');
		$roles = Role::orderBy('name')->pluck('name', 'id');
		return view("admin.user.add", compact('countries', 'roles'));
	}
	
	public function save(SaveUser $request){
		$input 				= $request->all();
		
		DB::table('users')->insert([
			'email' => $input['email'], 
			'password' => Hash::make($input['password']), 
			'ip_address' => $_SERVER['REMOTE_ADDR'], 
			'status' => $input['status'],
			'created_at' => new \DateTime(),
			'updated_at' => new \DateTime(),
		]);
		
		$user_id = DB::getPdo()->lastInsertId();
		
		$input['user_image'] = '';
		if($request->hasFile('user_image')){
			$destinationPath 	= public_path(env('PROFILE_PICTURE_PATH'));
			$file = $request->file('user_image');
			$filename = time().'.'.$file->getClientOriginalExtension();
			$file->move($destinationPath, $filename);
			$input['user_image'] = $filename;
		}
		
		DB::table('user_details')->insert([
			'user_id' => $user_id,
			'first_name' => $input['first_name'],
			'last_name' => $input['last_name'],
			'gamer_name' => $input['gamer_name'],
			'mobile_number' => $input['mobile_number'],
			'user_image' => $input['user_image'],
			'address_1' => $input['address_1'],
			'address_2' => $input['address_2'],
			'pincode' => $input['pincode'],
			'city' => $input['city'],
			'state' => $input['state'],
			'country_id' => $input['country_id'],
			'created_at' => new \DateTime(),
			'updated_at' => new \DateTime(),
		]);
		
		
		$user = User::findOrFail($user_id);
// 		$userRole = Role::where("name", "=", "user")->firstOrCreate(
// 				array(
// 						'name' => 'user',
// 						'display_name' => 'User',
// 						'description' => 'User role for user'
// 				)
// 		);
		$user->attachRole($input['role']);
		
 		$request->session()->flash('alert-success', 'User added successfully.');
 		return redirect()->route('admin.user.list');
	}
	
	public function edit($userId) {
		$user = User::findOrFail($userId);
		$countries = Country::orderBy('name')->pluck('name', 'id');
		return view("admin.user.edit", compact('user', 'countries'));
	}
	
	public function update(SaveUser $request, $userId){
		$user = User::findOrFail($userId);
		
		$input 				= $request->all();
		DB::table('users')
            ->where('id', $userId)
            ->update(['status' => $input['status'], 'updated_at' => new \DateTime()]);
	
            
        if($user->userDetails){
        	//Update User Details
	        $input['user_image'] = isset($user->userDetails->user_image) ? $user->userDetails->user_image : '';
	        if($request->hasFile('user_image')){
	            	$destinationPath 	= public_path(env('PROFILE_PICTURE_PATH'));
	            	if(isset($user->userDetails->user_image)){
	            		deleteMedia($destinationPath.$user->userDetails->user_image);
	            	}
	            	$file = $request->file('user_image');
	            	$filename = time().'.'.$file->getClientOriginalExtension();
	            	$file->move($destinationPath, $filename);
	            	$input['user_image'] = $filename;
	        }
	            
	        DB::table('user_details')
	            ->where('user_id', $userId)
	            ->update([
				'first_name' => $input['first_name'],
				'last_name' => $input['last_name'],
				'gamer_name' => $input['gamer_name'],
				'mobile_number' => $input['mobile_number'],
				'user_image' => $input['user_image'],
				'address_1' => $input['address_1'],
				'address_2' => $input['address_2'],
				'pincode' => $input['pincode'],
				'city' => $input['city'],
				'state' => $input['state'],
				'country_id' => $input['country_id'],
				'updated_at' => new \DateTime(),
				]);
        }
        else{
        	//Insert User Details
        	$input['user_image'] = '';
        	if($request->hasFile('user_image')){
        		$destinationPath 	= public_path(env('PROFILE_PICTURE_PATH'));
        		$file = $request->file('user_image');
        		$filename = time().'.'.$file->getClientOriginalExtension();
        		$file->move($destinationPath, $filename);
        		$input['user_image'] = $filename;
        	}
        	
        	DB::table('user_details')->insert([
	        	'user_id' => $userId,
	        	'first_name' => $input['first_name'],
	        	'last_name' => $input['last_name'],
	        	'gamer_name' => $input['gamer_name'],
	        	'mobile_number' => $input['mobile_number'],
	        	'user_image' => $input['user_image'],
	        	'address_1' => $input['address_1'],
	        	'address_2' => $input['address_2'],
	        	'pincode' => $input['pincode'],
	        	'city' => $input['city'],
	        	'state' => $input['state'],
	        	'country_id' => $input['country_id'],
	        	'created_at' => new \DateTime(),
	        	'updated_at' => new \DateTime(),
        	]);
        }
                        
		$request->session()->flash('alert-success', 'User updated successfully.');
		return redirect()->route('admin.user.edit', $userId);
	}
	
	public function delete(SaveUser $request, $userId) {
		$user = User::findOrFail($userId);
		
		//SOFT DELETE
		DB::table('users')
			->where('id', $userId)
			->update(['status' => 'Deleted', 'updated_at' => new \DateTime()]);
		
		//HARD DELETE
		/* if(isset($user->userDetails->user_image)){
			$destinationPath 	= public_path(env('PROFILE_PICTURE_PATH'));
			deleteMedia($destinationPath.$user->userDetails->user_image);
		}
		
		DB::table('users')->where('id', '=', $userId)->delete();
		DB::table('user_details')->where('user_id', '=', $userId)->delete(); */
		
		$request->session()->flash('alert-success', 'User deleted successfully.');
		return redirect()->route('admin.user.list');
	}
	
	public function resetPassword(SaveUser $request, $userId){
		$user = User::findOrFail($userId);
		
		//Password reset link through Laravel
		/* $response = Password::sendResetLink(array('email' => $user->email), function (Message $message) {
			$message->subject($this->getEmailSubject());
		}); */
		
		$newPassword = str_random(8);
		
		DB::table('users')
			->where('id', $userId)
			->update(['password' => bcrypt($newPassword)]);
		
		$user->password = $newPassword;
		
		Mail::to($user)->send(new ForgotPasswordMail ($user));
		
		$request->session()->flash('alert-success', 'Send reset password successfully.');
		return redirect()->route('admin.user.list');
	}
	
	public function addCoins($userId){
		$user = User::findOrFail($userId);
		return view("admin.user.add-coins", compact('user'));
	}
	
	public function saveCoins(SaveCoins $request, $userId){
		$user = User::findOrFail($userId);
		
		$input 				= $request->all();
		
		$coins = 0;
		if(is_null($user->userDetails->coins)){
			$coins = $input['coins'];
		}
		else{
			$coins = $user->userDetails->coins + $input['coins'];
		}
		
		if($input['coins'] >= 0 ){
			$type = 'Credit';
		}
		else{
			$type = 'Debit';
		}
		
		DB::table('user_details')
			->where('user_id', $userId)
			->update(['coins' => $coins, 'updated_at' => new \DateTime()]);
			
		DB::table('coin_transections')->insert([
			'user_id' => $userId,
			'source_id' => 7,
			'coins' => $input['coins'],
			'transaction_type' => $type,
			'challenge_id' => 0,
			'created_at' => new \DateTime(),
			'updated_at' => new \DateTime(),
		]);
			
		$request->session()->flash('alert-success', 'Coin added successfully.');
		return redirect()->route('admin.user.list');
	}
	
	public function changePassword(){
		$user = User::findOrFail(Auth::user()->id);
		return view("admin.user.change-password", compact('user'));
	}
	
	public function savePassword(PasswordRequest $request){
		$request->user()->fill([
				'password' => Hash::make($request->password)
		])->save();
	
		$request->session()->flash('alert-success', 'Password updated successfully.');
		return redirect()->route('admin.user.list');
	}
	
	public function transactionHistory($userId){
		$user = User::findOrFail($userId);
		$coinTransactions = $user->Transactions()->with('sourceTypes')->get();
		return view("admin.user.transaction-history", compact('coinTransactions'));
	}
	
}
