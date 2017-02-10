@extends('layouts.email')

@section('content')
		<div class="email-template clearfix">
            <div class="email-name"> Hello {!! $user->email !!}, </div>
            You have new team request. Please login to check it.
            <div class="thank"> Thanks, <span>Esport Colosseum Admin</span> </div>
        </div>
@endsection