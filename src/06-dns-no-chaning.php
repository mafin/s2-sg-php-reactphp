<?php

require_once '../vendor/autoload.php';

$loop = \React\EventLoop\Factory::create();

$dns = (new \React\Dns\Resolver\Factory())->create('8.8.8.8', $loop);

$dns->resolve('enin.info')
    ->then(function ($ip) {
        echo '01 -> ', $ip, PHP_EOL;
    });

$dns->resolve('seznam.cz')
    ->then(function ($ip) {
        echo '02 -> ', $ip, PHP_EOL;
    });

$dns->resolve('sinnerschrader.cz')
    ->then(function ($ip) {
        echo '03 -> ', $ip, PHP_EOL;
    });

$dns->resolve('yandex.ru')
    ->then(function ($ip) {
        echo '04 -> ', $ip, PHP_EOL;
    });

$loop->run();
