<?php

require_once '../vendor/autoload.php';

$loop = \React\EventLoop\Factory::create();

$dns = (new \React\Dns\Resolver\Factory())->create('8.8.8.8', $loop);

$promise = $dns->resolve('enin.info');
$promise->then(function ($ip) {
    echo $ip, PHP_EOL;
});

echo 'Resolving ... ';

$loop->run();
