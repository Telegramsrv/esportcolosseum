<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $guarded = ['id'];
    
	/**
	 * Challenge belongs to only one user who has created it.
	 * @return App\User User model who has created challenge.
	 */
    public function user(){
    	return $this->belongsTo("App\User");
    }

    /**
     * User can create challenge for one game at a time.
     * @return App\Models\Game Game model for which this challenge has been created.
     */
    public function game(){
    	return $this->belongsTo("App\Game");	
    }

    /**
     * User can create challenge for only one region at a time.
     * @return App\Models\Region Region model associated with this challenge.
     */
    public function region(){
    	return $this->belongsTo("App\Region");	
    }
}
