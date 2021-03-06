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
        'valid_upto', 'esc_date'
    ];

    /**
     * Scope a query to filter with below parameters.
     *     - Fetch only user's challenges.
     *
     * @param  \Illuminate\Database\Eloquent\Builder     $query
     * @param  App\User                                  $user
     * @param  String                                    $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMyChallenges($query, User $user){
        //"captainDetails", 
        return $query->with(["captainDetails", "teamsWithDetails"])
                    ->where(function ($query) use ($user) {
                        $query->where('user_id', $user->id)
                            ->Orwhere('opponent_id', $user->id)
                            ->orWhereHas('teamsWithDetails', function ($q) use ($user) {
                                $q->WhereHas('players', function ($qq) use ($user) {
                                    $qq->where('user_id', $user->id);
                            });
                        });
                    });
    }

/**
     * Scope a query to filter with below parameters.
     *     - Fetch only user's challenges.
     *
     * @param  \Illuminate\Database\Eloquent\Builder     $query
     * @param  App\User                                  $user
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMyEscChallenges($query, User $user){
         return $query->where(function ($query) use ($user) {
            $query->where('user_id', $user->id)->Orwhere('opponent_id', $user->id);
         });
    }

    /**
     * Scope a query to fetch challanges for selected games.
     * @param  \Illuminate\Database\Eloquent\Builder    $query 
     * @param  Game                                     $game  Selected game for which challenges needed to be fetched.
     * @return \Illuminate\Database\Eloquent\Builder    $query
     */
    public function scopeChallengesForGame($query, Game $game){
        return $query->where('game_id', $game->id);   
    }

    /**
     * Scope a query to filter challenges of selected type(ESC/Open).
     * @param  \Illuminate\Database\Eloquent\Builder    $query
     * @param  String                                   $challengeType
     * @return \Illuminate\Database\Eloquent\Builder    $query
     */
    public function scopeChallengesPerType($query, $challengeType){
        return $query->where('challenge_type', $challengeType);
    }

    /**
     * Scope a query to filter challenges not accepted by client
     * @param  \Illuminate\Database\Eloquent\Builder    $query
     * @return \Illuminate\Database\Eloquent\Builder    $query
     */
    public function scopeNotAcceptedByOpponent($query){
        return $query->whereNull("opponent_id");
    }
    
    /**
     * Scope a query to filter data with below parameters.
     *     - Fetch challenges whose status is "Created" or "Accepted".
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCurrentChallenges($query){
        return $query->whereIn('challenge_status', ['created', 'challenger-submitted', 'opponent-accepted', 'opponent-submitted']);
    }

    /**
     * Scope a query to filter data with below parameters.
     *     - Fetch challenges whose status is "Cancelled" or "Completed".
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePastChallenges($query){
        return $query->whereIn('challenge_status', ['cancelled', 'completed']);
    }


     /**
     * Scope a query to filter data with below parameters.
     *     - Fetch challenges whose status is "Created" or "Accepted".
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeChallengeByDateTime($query, $dateTime){
        return $query->where('esc_date', '=' , $dateTime->toDateTimeString());
    }
    
      /**
     * Scope a query to filter data with below parameters.
     *     - Fetch challenges whose challenge_type is "open".
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOpenChallenges($query){
        return $query->where('challenge_type', 'open');
    }

      /**
     * Scope a query to filter data with below parameters.
     *     - Fetch challenges whose challenge_type is "esc".
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeEscChallenges($query){
        return $query->where('challenge_type', 'esc');
    }

        /**
     * Scope a query to filter data with below parameters.
     *     - Filter challenges whose game_type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGameType($query, $type){
        return $query->where('game_type', $type);
    }

    /**
     * Scope a query to filter a data with challenge status
     * @param  \Illuminate\Database\Eloquent\Builder    $query  Query object
     * @param  String                                   $status Challenge Status to filter data with
     * @return \Illuminate\Database\Eloquent\Builder    $query  Query object
     */
    public function scopeChallengeStatus($query, $status){
        return $query->where('challenge_status', '=', $status);
    }

    /**
     * Scope a query to filter a data with challenge status
     * @param  \Illuminate\Database\Eloquent\Builder    $query  Query object
     * @param  String                                   $status Challenge Status to filter data with
     * @return \Illuminate\Database\Eloquent\Builder    $query  Query object
     */
    public function scopeOpenValidUpto($query, $date){
        return $query->where('valid_upto', '>=' , $date->toDateTimeString());
    }

    
    /**
     * Challenge belongs to only one user who has created it.
     * @return App\User User model who has created challenge.
     */
    public function captain(){
        return $this->hasOne("App\User", "id", "user_id");
    }

    /**
     * Only one Opponent can accept a challenge.
     * @return App\User User model who has created challenge.
     */
    public function opponent(){
        return $this->hasOne("App\User", "id", "opponent_id");
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
     * User can create challenge for only one region at a time.
     * @return App\Models\Region Region model associated with this challenge.
     */
    public function opponentDetails(){
        return $this->belongsTo("App\Models\UserDetails", "opponent_id", "user_id");  
    }   
    /**
     * Teams that belongs to challenge.
     * @return App\Models\Team Team Models associated with this challenge.
     */
    public function teams(){
        return $this->belongsToMany('App\Models\Team');
    }

    /**
     * Teams that belongs to challenge.
     * @return App\Models\Team Team Models associated with this challenge.
     */
    public function teamsWithDetails(){
        return $this->belongsToMany('App\Models\Team')->with("players.userDetails");
    }

    /**
     * This function is used to get challeger team object.
     * @return Team  $team  Challenger team object associated with challenge.
     */
    public function challengerTeam(){
        if($this->teamsWithDetails->count() > 0) {
            foreach($this->teamsWithDetails as $k => $team) {
                if($team->user_id == $this->user_id) {
                    return $team;
                }
            }
        }
    }

    /**
     * This function is used to get opponent team object.
     * @return Team  $team  Challenger team object associated with opponent.
     */
    public function opponentTeam(){
        if($this->teamsWithDetails->count() > 0) {
            foreach($this->teamsWithDetails as $k => $team) {
                if($team->user_id == $this->opponent_id) {
                    return $team;
                }
            }
        }
    }


    /**
     * This function is used to get opponent team object.
     * @return Team  $team  Challenger team object associated with opponent.
     */
    public function winnerTeam(){
        if($this->teamsWithDetails->count() > 0 && !empty($this->winner_id)) {
            foreach($this->teamsWithDetails as $k => $team) {
                if($team->user_id == $this->winner_id) {
                    return $team;
                }
            }
        }
    }
}
