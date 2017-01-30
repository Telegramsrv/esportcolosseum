<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChallengeInterval extends Model
{
     /**
     * Scope a query to filter with below parameters.
     *     - Fetch time interval for challenge type "esc"
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeEsc($query){
        return $query->where('challenge_type', 'esc');
    }
}
