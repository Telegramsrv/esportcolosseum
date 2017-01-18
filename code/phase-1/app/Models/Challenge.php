<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Challenge extends Model
{
    protected $guarded = ['id'];

    /**
     * Scope a query to filter query with below parameters.
     *     - Fetch only user's challenges.
     *     - Fetch either "Open" or "ESC" challenges.
     *     - Fetch only perticular game's challenges.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param App\User $user
     * @param App\Models\Game $game
     * @param String $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMyChallengesPerGamePerName($query, User $user, Game $game, $name){
        return $query->where('user_id', $user->id)->where('name', $name)->where('game_id', $game->id);
    }
    
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
