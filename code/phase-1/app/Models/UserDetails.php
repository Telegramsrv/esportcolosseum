<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
	protected $guarded = array();
	
	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
