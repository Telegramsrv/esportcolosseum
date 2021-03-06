<?php
//namespace App;
//require_once __DIR__.'/../vendor/autoload.php';

require __DIR__.'/../bootstrap/autoload.php';
require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
		$request = Illuminate\Http\Request::capture()
);
//$response->send();
$kernel->terminate($request, $response);

/*Create a server variable with the link to the tcp IP and custom port you need to
specify the Homestead IP if you are using homestead or, for local environment using
WAMP, MAMP, ... use 127.0.0..1*/


$server = new \Hoa\Websocket\Server(
    new \Hoa\Socket\Server('tcp://'.env('CHAT_HOST').':8889')
);

$server->on('open', function ( \Hoa\Event\Bucket $bucket) {
	echo 'new connection', "\n";
	return;
});

//Manages the message event to get send data for each client using the broadcast method
$server->on('message', function ( \Hoa\Event\Bucket $bucket ) {
    $data = $bucket->getData();
    echo 'message: ', $data['message'], "\n";
    $bucket->getSource()->broadcast($data['message']);
    return;
});

$server->on('close', function ( \Hoa\Event\Bucket $bucket) {
	echo 'connection closed', "\n";
	return;
});
	
//Execute the server
$server->run();