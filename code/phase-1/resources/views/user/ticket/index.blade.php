@extends('layouts.user.static-layout')
@section('static-content')
	<div>
		<table id="ticket-list" class="responsive-table">
			<thead>
				<th>Sr. No.</th>
				<th>Subject</th>
				<th>status</th>
				<th>Updated At</th>
			</thead>
			<tbody>
				@php($cnt = 1)
				@foreach($tickets as $ticket)
				<tr>
					<td>{!! $i++ !!}</td>
					<td>{!! $ticket->title !!}</td>
					<td>{!! $ticket->status !!}</td>
					<td>{!! $ticket->ticketConversation()->orderBy('created_at', 'desc')->first()->created_at !!}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection