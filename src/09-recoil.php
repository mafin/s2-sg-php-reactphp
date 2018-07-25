<?php

require_once '../vendor/autoload.php';
require_once './08-library.php';

$loop = \React\EventLoop\Factory::create();

$stdOut = new \React\Stream\WritableResourceStream(STDOUT, $loop);

$kernel = \Recoil\React\ReactKernel::create($loop);

$kernel->execute(function () use ($loop, $stdOut) {
    $stdOut->write((yield dnsResolver($loop, 'enin.info')) . PHP_EOL);
    $stdOut->write((yield dnsResolver($loop, 'seznam.cz')) . PHP_EOL);

    yield customSleep($loop, 5);

    $stdOut->write(yield httpRequest($loop, 'https://enin.info'));
});

$loop->run();
