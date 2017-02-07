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
		//TODO :: aplredy friend not found;
		$members = DB::table('users as u')
		->join('user_details as ud', 'u.id', '=', 'ud.user_id')
		->join('role_user as ru', 'u.id', '=', 'ru.user_id')
		->select('u.id', 'ud.first_name', 'ud.last_name')
		->where('u.status', 'Active')
		->where('u.id', '!=', $uid)
		->where('ru.role_id', 2)
		->where('u.email', "like" , "%" . $searchKeyword . "%")
		->orWhere('ud.gamer_name',"like", "%" . $searchKeyword . "%")
		->get();
		return $members;
		
	}
}
