<?php

namespace App; 

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

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


    
    /* public function getAttribute($key)
    {
    	$profile = Models\UserDetails::where('user_id', '=', $this->attributes['id'])->first()->toArray();
    
    	foreach ($profile as $attr => $value) {
    		if (!array_key_exists($attr, $this->attributes)) {
    			$this->attributes[$attr] = $value;
    		}
    	}
    
    	return parent::getAttribute($key);
    } */
}
