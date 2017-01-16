<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
	/**
	 * The attributes that are guared againsts mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id'];
	
}
