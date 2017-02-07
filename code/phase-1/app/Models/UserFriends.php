<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserFriends extends Model
{
	protected $guarded = ['id'];
	
	public function user()
	{
		return $this->belongsTo('App\User');
	} 
	
	public function userFriendDetails()
	{
		return $this->belongsTo('App\Models\UserDetails', 'friend_id', 'user_id');
	}
	
	public static function getMembers($uid, $searchKeyword) {
		$members = DB::table('users as u')
		->join('user_details as ud', 'u.id', '=', 'ud.user_id')
		->join('role_user as ru', 'u.id', '=', 'ru.user_id')
		->select('u.id', 'ud.first_name', 'ud.last_name')
		->where('u.status', 'Active')
		->where('u.id', '!=', $uid)
		->where('ru.role_id', 2)
		->whereNotIn('u.id', function($query) use ($uid) {
			$query->select('friend_id')
		    ->from("user_friends")
		    ->where('user_id', $uid);
		})
		->whereNotIn('u.id', function($query) use ($uid) {
			$query->select('user_id')
			->from("user_friends")
			->where('friend_id', $uid);
		})
		->where(function($query) use ($searchKeyword) {
			$query->where('u.email', "like" , "%" . $searchKeyword . "%")
				  ->orWhere('ud.gamer_name',"like", "%" . $searchKeyword . "%");
		})
// 		->where('u.email', "like" , "%" . $searchKeyword . "%")
// 		->orWhere('ud.gamer_name',"like", "%" . $searchKeyword . "%")
		->get();
		return $members;
		
	}
	
	public static function isUserFriend($uid, $friend_id) {
		return  DB::table('user_friends')->where(array('user_id' => $uid, 'friend_id' => $friend_id))
		->orWhere(array('friend_id' => $uid, 'user_id' => $friend_id))
		->exists();
	}
	
}
