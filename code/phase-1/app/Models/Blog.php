<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    
	/**
	 * The attributes that are guared againsts mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id', 'user_id'];
	
	/**
	 * @param  \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
    public function scopeLatestFour($query){
        return $query->orderBy("created_at", "desc")->take(4);
    }

	/**
	 * Blog belongs to only one user.
	 */
    public function user(){
    	return $this->belongsTo('App\User');
    }

}
