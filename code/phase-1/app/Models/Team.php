<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $guarded = ['id'];

    /**
     * The Users that belong to the Team.
     * @return App\User number of users associated with team.
     */
    public function players()
    {
        return $this->belongsToMany('App\User');
    }
}
