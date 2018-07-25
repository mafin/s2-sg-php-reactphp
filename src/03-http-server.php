<?php

require_once '../vendor/autoload.php';

$loop = \React\EventLoop\Factory::create();

$server = new \React\Http\Server(function (\Psr\Http\Message\RequestInterface $request){
    return new \React\Http\Response(
        200,
        ['Content-Type' => 'text/html'],
        '<h1>Hello world!</h1>'
    );
});

$socket = new \React\Socket\Server(8080, $loop);
$server->listen($socket);

echo 'Server running at http://127.0.0.1:8080' . PHP_EOL;

$loop->run();
