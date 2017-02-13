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

    /**
     * Scope a query to filter notifications with given type.
     * @param  \Illuminate\Database\Eloquent\Builder $query  
     * @param  String $type  Notification Type
     * @return \Illuminate\Database\Eloquent\Builder $query  
     */
    public function scopeType($query, $type){
        return $query->where('type', $type);
    }
}
