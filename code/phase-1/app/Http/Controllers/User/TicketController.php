<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\Ticket\SaveTicket;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketConversation;
use App\User;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketReplayMail;

class TicketController extends Controller
{
    public function index(){
    	$tickets = Auth::user()->tickets()->get();
    	// dd($tickets);
    	return view('user.ticket.index', compact('tickets'));
    }

    public function add(){
    	return view('user.ticket.add');	
    }

    public function save(SaveTicket $ticket){
    	$user = Auth::user();
    	$ticketInput = $ticket->only('title', 'description');
    	$ticketConversationInput = $ticket->only('description');
    	$ticketConversationInput['subject'] = $ticketInput['title'];
    	$ticketConversationInput['reply_by'] = $user->id;

    	$ticket = $user->tickets()->save(new Ticket($ticketInput));
		$ticketConversation = $ticket->ticketConversation()->save(new TicketConversation($ticketConversationInput));

		//send Conversion Mali to User
		Mail::to(env('FROM_EMAIL'))->send(new TicketReplayMail($ticketConversation));

		return redirect(route('user.ticket.list'));
    }
}
