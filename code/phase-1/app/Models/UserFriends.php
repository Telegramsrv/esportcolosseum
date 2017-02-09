<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;

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
	
	public static function getUserFriends(){
		$members = DB::table('user_friends as uf')
		->join('user_details as ud', function ($join) {
			$join->on('uf.user_id', '=', 'ud.user_id')->orOn('uf.friend_id', '=', 'ud.user_id');
		})
		->select('uf.id', 'ud.user_id', 'ud.first_name', 'ud.last_name', 'ud.user_image')
		->where('uf.status', 'Accepted')
		->where(function ($query) {
			$query->where('uf.user_id', Auth::id())
			->Orwhere('uf.friend_id', Auth::id());
		})
		->where('ud.user_id', '!=', Auth::id())
		->get();
		return $members;
	}
	
	public static function isUserFriend($uid, $friend_id) {
		return  DB::table('user_friends')->where(array('user_id' => $uid, 'friend_id' => $friend_id))
		->orWhere(array('friend_id' => $uid, 'user_id' => $friend_id))
		->exists();
	}
	
}
