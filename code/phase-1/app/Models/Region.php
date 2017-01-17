<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
	/**
	 * User can create number of challenges for single region.
	 * @return App\Models\Challenge challenge models created for region.
	 */
    public function challenges(){
    	return $this->hasMany('App\Models\Challenge');
    }
}
