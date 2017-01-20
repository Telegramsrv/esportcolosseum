@extends('layouts.email')

@section('content')
		<div class="email-template clearfix">
            <div class="email-name"> Hello {!! $user->email !!}, </div>
            We have created an account for you on Esport Colosseum. Your details are as below:
            <p>&nbsp;</p>
            <div class="username">Email: <span>{!! $user->email !!}</span></div>
            <div class="username">Password: <span>{!! $user->password !!}</span>
                <div class="logon-change">(You can change the password in the settings after you log-in)</div>
            </div>
            <br/>
            You can <a href="{!! env('APP_URL', 'http://dev.esportcolosseum.loc') !!}">login</a> with the above credentials.<br/>
            <br/>
            If you have any questions let us know.
            <div class="thank"> Thanks, <span>Esport Colosseum Admin</span> </div>
        </div>
@endsection 