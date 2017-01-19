<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Challenge extends Model
{
    protected $guarded = ['id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'valid_upto'
    ];

    /**
     * Scope a query to filter with below parameters.
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
     * Scope a query to filter data with below parameters.
     *     - Fetch challenges whose status is "Created" or "Accepted".
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCurrentGames($query){
        return $query->whereIn('challenge_status', ['created', 'accepted']);
    }

    /**
     * Scope a query to filter data with below parameters.
     *     - Fetch challenges whose status is "Cancelled" or "Completed".
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePastGames($query){
        return $query->whereIn('challenge_status', ['cancelled', 'complete']);
    }

	/**
	 * Challenge belongs to only one user who has created it.
	 * @return App\User User model who has created challenge.
	 */
    public function captain(){
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
