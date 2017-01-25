@extends('layouts.admin') 
@section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				@include('layouts.message')
				<h2 class="page-title">Matches</h2>
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="container-fluid">
						    <div class="row ">
						        <div class="col-xs-12">
						            <br/>
						            <input type="text" id="input" placeholder="Message…"/>
						            <hr/>
						            <pre id="messages">
						            </pre>
						        </div>
						     </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection 
@section('footer') 
<script>
    //The homestead or local host server (don't forget the ws prefix)
    var host = 'ws://<?php echo env('CHAT_HOST');?>:8889';
    var socket = null;
    var input = document.getElementById('input');
    var messages = document.getElementById('messages');
    var print = function (message) {
        var samp = document.createElement('samp');
        samp.innerHTML = '\n' + message + '\n';
        messages.appendChild(samp);
        return;
    };

    //Manges the keyup event
    input.addEventListener('keyup', function (evt) {
        if (13 === evt.keyCode) {
            var msg = input.value;
            if (!msg)
                return;
            try {
                //Send the message to the socket
                socket.send(msg);
                input.value = '';
                input.focus();
            } catch (e) {
                console.log(e);
            }
                print(msg);
            return;
        }
    });

    try {
        socket = new WebSocket(host);
        
        //Manages the open event within your client code
        socket.onopen = function () {
            print('Connection Opened');
            input.focus();
            return;
        };
        //Manages the message event within your client code
        socket.onmessage = function (msg) {
            print(msg.data);
            return;
        };
        //Manages the close event within your client code
        socket.onclose = function () {
            print('Connection Closed');
            return;
        };
    } catch (e) {
        console.log(e);
    }
</script>
@endsection
