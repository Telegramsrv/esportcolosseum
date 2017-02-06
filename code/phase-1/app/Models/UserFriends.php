<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
