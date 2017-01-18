<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketConversation;
use App\Http\Requests\Ticket\SaveTicket;
use App\Http\Requests\Ticket\Conversation;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketReplayMail;

class TicketController extends Controller
{
	public function index() {
		$tickets = Ticket::with("user")->orderBy('id', 'desc')->get();
		return view("admin.ticket.index", compact('tickets'));
	}
	
	public function view($ticketId) {
		$ticket = Ticket::findOrFail($ticketId);
		return view("admin.ticket.view", compact('ticket'));
	}
	
	public function update($ticketId, SaveTicket $request) {
		$ticket = Ticket::findOrFail($ticketId);
		$input = $request->all();
		$ticket->update($input);
		$request->session()->flash('alert-success', 'Ticket updated successfully.');
		return redirect()->route('admin.ticket.list');
	}
	
	public function conversation($ticketId) {
		$ticket = Ticket::findOrFail($ticketId);
		$conversations = $ticket->ticketConversation;
		return view("admin.ticket.conversations", compact('conversations', 'ticket'));
	}
	
	public function conversationUpdate($ticketId, Conversation $request) {
		$ticket = Ticket::findOrFail($ticketId);
		$input = $request->all();
		$ticketConversation = new TicketConversation($input);
		$ticketConversation->reply_by = Auth::user()->id;
		
		//Save Ticket Conversion
		$ticket->ticketConversation()->save($ticketConversation);
		
		//send Conversion Mali to User
		Mail::to($ticket->user->email)->send(new TicketReplayMail($ticketConversation));
		
		$request->session()->flash('alert-success', 'Conversation updated successfully.');
		return redirect()->route('admin.ticket.conversation', $ticket->id);
		
	}
	
}
