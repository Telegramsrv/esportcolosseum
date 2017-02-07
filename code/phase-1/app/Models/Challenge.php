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
    public function scopeMyChallengesPerGamePerName($query, User $user, Game $game, $challengeType){
        return $query->with(["captainDetails"])->where('user_id', $user->id)->where('challenge_type', $challengeType)->where('game_id', $game->id);
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
    	return $this->hasOne("App\User", "id", "user_id");
    }

    /**
     * User can create challenge for one game at a time.
     * @return App\Models\Game Game model for which this challenge has been created.
     */
    public function game(){
    	return $this->belongsTo("App\Models\Game");	
    }

    /**
     * User can create challenge for only one region at a time.
     * @return App\Models\Region Region model associated with this challenge.
     */
    public function region(){
    	return $this->belongsTo("App\Models\Region");	
    }

    /**
     * User can create challenge for only one region at a time.
     * @return App\Models\Region Region model associated with this challenge.
     */
    public function captainDetails(){
        return $this->belongsTo("App\Models\UserDetails", "user_id", "user_id");  
    }    

    /**
     * Teams that belongs to challenge.
     * @return App\Models\Team Team Models associated with this challenge.
     */
    public function teams(){
        return $this->belongsToMany('App\Models\Team');
    }

    public function captainTeam(User $user){
        $teams = $this::teams()->get();
        foreach($teams as $team){
            if($team->players()->find($user->id)->count()){
                return $team;
            }
        }
    }


}
