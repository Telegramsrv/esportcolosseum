<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\User\SaveUser;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Blog;
use Illuminate\Support\Facades\Hash;

class BlogController extends Controller
{
	public function index() {
		$blogs = Blog::with('user')->get();
		return view("admin.blog.index", compact('blogs'));
	}
	
	public function add() {
		return view("admin.blog.add");
	}
	
	public function save(SaveUser $request){
		$input = $request->all();
		
		//save 	display_image
		if(!empty($request->hasFile('display_image'))){
			$input['display_image'] = saveMedia($request->file('display_image'), 'UPLOAD_BLOG_THUMBNAIL');
		}
		//save	banner_image
		if(!empty($request->hasFile('banner_image'))){
			$input['banner_image'] = saveMedia($request->file('banner_image'), 'UPLOAD_BLOG_BANNER');
		}
		
		$user = Auth::user();
		$user->blogs()->save(new Blog($input));
 		$request->session()->flash('alert-success', 'Blog added successfully.');
 		return redirect()->route('admin.blog.list');
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
	
	
}
