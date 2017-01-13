<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoinTransections extends Model
{
    

	/**
	 * Blog belongs to only one user.
	 */
    public function user(){
    	return $this->belongsTo('App\Models\User');
    }

    
    public function SourceTypes()
    {
    	return $this->belongsTo('App\Models\SourceTypes', 'source_id');
    }
    
}
