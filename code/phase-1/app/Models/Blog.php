<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    
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
    	return $this->belongsTo('App\Models\User');
    }

}
