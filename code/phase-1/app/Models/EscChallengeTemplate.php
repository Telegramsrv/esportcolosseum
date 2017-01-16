<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EscChallengeTemplate extends Model
{
    
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'esc_challenge_template';
	
	/**
	 * The attributes that are guared againsts mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id'];
	
	/**
	 * @param  \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
    public function scopeLatest($query){
        return $query->orderBy("created_at", "desc");
    }


}
