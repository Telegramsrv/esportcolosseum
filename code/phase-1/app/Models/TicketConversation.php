<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class TicketConversation extends Model
{
    protected $guarded = ['id'];
    
    public function user(){
    	return $this->belongsTo('App\User');
    }
    
    public function ticket(){
    	return $this->belongsTo('App\Models\Ticket');
    }
    
    
    public function getReplyByAttribute($userId){
	     $user = User::findOrFail($userId, $columns = array('email'));
	     return $user->email;
    }
    
}
