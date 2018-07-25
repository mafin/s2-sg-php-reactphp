<?php

require_once '../vendor/autoload.php';

$loop = \React\EventLoop\Factory::create();

$source = new \React\Stream\ReadableResourceStream(fopen('omg.txt', 'r'), $loop);
$dest = new \React\Stream\WritableResourceStream(fopen('wtf.txt', 'w'), $loop);

$source->pipe($dest);

$loop->run();
