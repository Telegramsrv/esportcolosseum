<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\User\SaveUser;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Country;
use DB;
use Illuminate\Support\Facades\Hash;

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
		
		
		/* $request->user()->fill([
				'password' => Hash::make($request->password)
		])->save(); */
		
		
		DB::table('users')->insert([
			'email' => $input['email'], 
			'password' => Hash::make($input['password']), 
			'ip_address' => $_SERVER['REMOTE_ADDR'], 
			'status' => $input['status']
		]);
		
		$user_id = DB::getPdo()->lastInsertId();

		DB::table('user_details')->insert([
			'user_id' => $user_id,
			'first_name' => $input['first_name'],
			'last_name' => $input['last_name'],
			'gamer_name' => $input['gamer_name'],
			'mobile_number' => $input['mobile_number'],
			//'user_image' => $input['user_image'],
			'address_1' => $input['address_1'],
			'address_2' => $input['address_2'],
			'pincode' => $input['pincode'],
			'city' => $input['city'],
			'state' => $input['state'],
			'country_id' => $input['country_id'],
			'coins' => $input['coins'],
			'winning_coins' => $input['winning_coins'],
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
		$input 				= $request->all();
		DB::table('users')
            ->where('id', $userId)
            ->update(['status' => $input['status']]);
	
        DB::table('user_details')
            ->where('user_id', $userId)
            ->update([
			'first_name' => $input['first_name'],
			'last_name' => $input['last_name'],
			'gamer_name' => $input['gamer_name'],
			'mobile_number' => $input['mobile_number'],
			//'user_image' => $input['user_image'],
			'address_1' => $input['address_1'],
			'address_2' => $input['address_2'],
			'pincode' => $input['pincode'],
			'city' => $input['city'],
			'state' => $input['state'],
			'country_id' => $input['country_id'],
			'coins' => $input['coins'],
			'winning_coins' => $input['winning_coins'],
			]);
                        
		$request->session()->flash('alert-success', 'User updated successfully.');
		return redirect()->route('admin.user.list');
	}
}
