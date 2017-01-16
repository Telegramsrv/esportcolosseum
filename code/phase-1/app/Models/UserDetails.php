<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
	protected $guarded = ['id', 'user_id'];
	
	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
