<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = ['id', 'user_id'];
    
    
    /**
     * Ticket belongs to only one user.
     */
    public function user(){
    	return $this->belongsTo('App\User');
    }
    
    public function ticketConversation(){
    	return $this->hasMAny('App\Models\TicketConversation');
    }
    
}
