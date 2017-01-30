@extends('layouts.user.static-layout', ['displayLeftSidebar' => false])
@section('static-content')
	<div class="tab-content col s12 m12">
		<div class="section-title ">Generate <span>ticket/ Support</span></div>
		<div class="row">
			<div class="right">
				<a href="{!! route('user.ticket.add') !!}" class="waves-effect waves-light btn deep-orange darken-4 modal-trigger">Create</a>
			</div>
		</div>
		<div class="row">
			<table id="ticket-list" class="responsive-table bordered striped highlight">
				<thead>
					<th>Sr. No.</th>
					<th>Subject</th>
					<th>status</th>
					<th>Lastly Updated At</th>
				</thead>
				<tbody>
					@if($tickets->count() > 0)
						@php($cnt = 1)
						@foreach($tickets as $ticket)
						<tr>
							<td>{!! $cnt++ !!}</td>
							<td><a href="{!! route('user.ticket.view', md5($ticket->id)) !!}" ">{!! $ticket->title !!}</a></td>
							<td>{!! $ticket->status !!}</td>
							<td>{!! $ticket->ticketConversation()->orderBy('created_at', 'desc')->first()->created_at !!}</td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="4" class="center">No tickets to show!</td>
						</tr>
					@endif
					
				</tbody>
			</table>
		</div>
	</div>	
@endsection