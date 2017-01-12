<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\User\SaveUser;
use App\Http\Requests\User\SaveCoins;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Country;
use DB;
use Illuminate\Support\Facades\Hash;
use Password;

class UserController extends Controller
{
	public function index() {
		$users = User::all();
		return view("admin.user.index", compact('users'));
	}
	
	public function add() {
		$countries = Country::orderBy('name')->pluck('name', 'id');
		return view("admin.user.add", compact('countries'));
	}
	
	public function save(SaveUser $request){
		$input 				= $request->all();
		
		DB::table('users')->insert([
			'email' => $input['email'], 
			'password' => Hash::make($input['password']), 
			'ip_address' => $_SERVER['REMOTE_ADDR'], 
			'status' => $input['status']
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
		]);
		
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
            ->update(['status' => $input['status']]);
	
            
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
			->update(['status' => 'Deleted']);
		
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
		
		$response = Password::sendResetLink(array('email' => $user->email), function (Message $message) {
			$message->subject($this->getEmailSubject());
		});
		
		if($response == 'passwords.sent'){
			$request->session()->flash('alert-success', 'Send Reset password link successfully.');
		}
		else{
			$request->session()->flash('alert-danger', 'Error while sending reset password link.');
		}
		
		return redirect()->route('admin.user.list');
	}
	
	public function addCoins($userId){
		$user = User::findOrFail($userId);
		return view("admin.user.add-coins", compact('user'));
	}
	
	public function saveCoins(SaveCoins $request, $userId){
		$user = User::findOrFail($userId);
		
		$input 				= $request->all();
		
		DB::table('user_details')
			->where('user_id', $userId)
			->increment('coins', $input['coins']);
			
		//TODO ADD HISTORY
			
		$request->session()->flash('alert-success', 'Coin added successfully.');
		return redirect()->route('admin.user.list');
	}
}
