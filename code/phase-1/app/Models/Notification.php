<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = ['id'];

    /**
     * Notification belongs to only one user.
     */
    public function user(){
    	return $this->belongsTo('App\User');
    }
    

}
