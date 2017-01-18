<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class TicketConversation extends Model
{
    protected $guarded = ['id'];
    
    public function getReplyByAttribute($userId){
	     $user = User::findOrFail($userId, $columns = array('email'));
	     return $user->email;
    }
    
}
