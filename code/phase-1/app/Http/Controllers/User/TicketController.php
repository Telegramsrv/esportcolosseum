<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Auth;

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

    public function save(){
    	
    }
}
