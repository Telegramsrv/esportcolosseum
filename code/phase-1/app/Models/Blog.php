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
	 * Query scope function to fetch only latest 4 blogs(sort - created_at - desc).
	 * @param  \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
    public function scopeLatestFour($query){
        return $query->orderBy("created_at", "desc")->take(4);
    }

    /**
     * Query scope function to fetch only blogs whose status is "Active".
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query){
		return $query->where("status", "Active");
    }

	/**
	 * Blog belongs to only one user.
	 */
    public function user(){
    	return $this->belongsTo('App\User');
    }

}
