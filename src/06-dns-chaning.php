<?php

require_once '../vendor/autoload.php';

$loop = \React\EventLoop\Factory::create();

$dns = (new \React\Dns\Resolver\Factory())->create('8.8.8.8', $loop);

$dns->resolve('enin.info')
    ->then(function ($ip) use ($dns) {
        echo '01 -> ', $ip, PHP_EOL;

        return $dns->resolve('seznam.cz');
    })
    ->then(function ($ip) use ($dns) {
        echo '02 -> ', $ip, PHP_EOL;

        return $dns->resolve('sinnerschrader.cz');
    })
    ->then(function ($ip) use ($dns) {
        echo '03 -> ', $ip, PHP_EOL;

        return $dns->resolve('yandex.ru');
    })
    ->then(function ($ip) {
        echo '04 -> ', $ip, PHP_EOL;
    });

$loop->run();
