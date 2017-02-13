<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawFundRequest extends Model
{
    protected $guarded = ['id'];
    
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
