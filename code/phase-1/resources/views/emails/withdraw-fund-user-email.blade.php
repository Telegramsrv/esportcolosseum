@extends('layouts.email')

@section('content')
		<div class="email-template clearfix">
            <div class="email-name"> Hello {!! $mailData->email !!}, </div>
            You have been requested for withdraw fund of {!! $mailData->coins !!} coins.
            <div class="thank"> Thanks, <span>Esport Colosseum Admin</span> </div>
        </div>
@endsection 