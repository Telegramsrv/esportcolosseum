@extends('layouts.email')

@section('content')
		<div class="email-template clearfix">
            <div class="email-name"> Hello {!! $ticket->ticket->user->email !!}, </div>
            {!! $ticket->description !!}
            <div class="thank"> Thanks, <span>Esport Colosseum Admin</span> </div>
        </div>
@endsection 