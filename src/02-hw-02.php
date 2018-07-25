<?php

require_once '../vendor/autoload.php';

$loop = \React\EventLoop\Factory::create();
$stdOut = new \React\Stream\WritableResourceStream(STDOUT, $loop);

// event subscription and notification via callback function
$loop->addTimer(1, function () use ($stdOut) {
    $stdOut->write('world!' . PHP_EOL);
});

$loop->addTimer(0.5, function () use ($stdOut) {
    $stdOut->write('Hello ' );
});

$loop->run();
