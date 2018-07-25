<?php

require_once '../vendor/autoload.php';
require_once './08-library.php';

$loop = \React\EventLoop\Factory::create();

$stdOut = new \React\Stream\WritableResourceStream(STDOUT, $loop);

dnsResolver($loop, 'enin.info')->then(function ($ip) use ($loop){
    echo $ip, PHP_EOL;

    return customSleep($loop, 5);
})->then(function () use ($loop) {
    return httpRequest($loop, 'https://enin.info');
})->then(function ($content) use ($loop) {
    echo $content;
});

$loop->run();
