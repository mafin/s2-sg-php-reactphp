<?php

require_once '../vendor/autoload.php';

$loop = \React\EventLoop\Factory::create();

customSleep($loop, 5)->then(function (){
    echo 'Woke up after 5 seconds' . PHP_EOL;
});

$stdOut = new \React\Stream\WritableResourceStream(STDOUT, $loop);

$loop->addPeriodicTimer(1, function () use ($stdOut) {
    static $counter = 1;
    $stdOut->write($counter++ . PHP_EOL);
});

$loop->run();

function customSleep(\React\EventLoop\LoopInterface $loop, int $waitTime)
{
    return new \React\Promise\Promise(function ($resolve, $reject) use ($loop, $waitTime) {
        $loop->addTimer($waitTime, function () use ($resolve) {
            $resolve();
        });
    });
}
