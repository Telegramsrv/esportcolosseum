<?php

namespace App; 

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use DB;
use App\Models\Team;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are guared againsts mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'last_login'
    ];

    public function userDetails()
    {
    	return $this->hasOne('App\Models\UserDetails');
    }

    public function blogs(){
        return $this->hasMany('App\Models\Blog');   
    }
    
    public function Transactions(){
    	return $this->hasMany('App\Models\CoinTransections');
    }

    /**
     * User can have many challenges
     * @return App\Models\Challenge set of challenges created by User.
     */
    public function challenges(){
        return $this->hasMany('App\Models\Challenge');
    }

    /**
     * User can be associated with meny teams
     * * @return App\Models\Team number of users associated with team.
     */
    public function teams(){
        return $this->belongsToMany('App\Models\Team');   
    } 

    /**
     * User can be captain in many teams.
     * * @return App\Models\Team number of user associated with team.
     */
    public function captainteams(){
        return $this->hasMany('App\Models\Team');
    }

    /**
     * User can be associated with many notifications
     * * @return App\Models\Notification number of notifications associated with User.
     */
    public function notifications(){
        return $this->hasMAny('App\Models\Notification');   
    } 

    /**
     * Scope a query to filter users whose status is "Active".
     * @param  \Illuminate\Database\Eloquent\Builder $query  
     * @param  String $role  Role name
     * @return \Illuminate\Database\Eloquent\Builder $query  
     */
    public function scopeActive($query){
        return $query->where('status', 'Active');
    }    

    /**
     * Scope a query to filter users with specific role.
     * @param  \Illuminate\Database\Eloquent\Builder $query  
     * @param  String $role  Role name
     * @return \Illuminate\Database\Eloquent\Builder $query  
     */
    public function scopeRoleType($query, $role){
        return $query->whereHas('Roles', function($query) use ($role){
                        $query->where('name', $role);
                    });
    }

    /**
     * Scope a query to filter users with below parameters.
     *     - email or gamer name matches with search criteria.
     * @param  \Illuminate\Database\Eloquent\Builder $query  
     * @param  String $search  Search keyword
     * @return \Illuminate\Database\Eloquent\Builder $query  
     */
    public function scopeSeachGamerNameOrEmail($query, $search){
        return $query->with('userDetails')
                    ->whereHas('userDetails', function($query) use ($search){
                        $query->where('email', 'like', '%' . $search . '%')
                                ->orWhere('gamer_name', 'like', '%' . $search . '%');
                    });
    }

    /**
     * Scope a query to filter users with below parameters.
     *     - list of players which are not added into specific team already.
     * @param  \Illuminate\Database\Eloquent\Builder $query  
     * @param  String $teamId  Team id
     * @return \Illuminate\Database\Eloquent\Builder $query  
     */
    public function scopePlayerlistForTeam($query, $teamId){
        return $query->whereNotIn('id', function($query) use ($teamId) {
                        $query->select('user_id')
                        ->from("team_user")
                        ->where(DB::raw('md5(team_id)'), $teamId);
                    });
    }
    
    /**
     * Scope a query to filter users with below parameters.
     *     - list of users which are not friends already.
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  String $teamId  Team id
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeNotUserFriends($query, $uid){
    	return  $query->whereNotIn('id', function($query) use ($uid) {
		    			$query->select('friend_id')
				    	->from("user_friends")
				    	->where('user_id', $uid);
			    })
			    ->whereNotIn('id', function($query) use ($uid) {
			    	$query->select('user_id')
			    	->from("user_friends")
			    	->where('friend_id', $uid);
			    });
    }
    
    public function userBankDetails()
    {
    	return $this->hasOne('App\Models\UserBankDetails');
    }
    
}
