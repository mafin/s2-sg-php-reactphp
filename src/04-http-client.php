<?php

require_once '../vendor/autoload.php';

$loop = \React\EventLoop\Factory::create();

$client = new \React\HttpClient\Client($loop);

$stdOut = new \React\Stream\WritableResourceStream(STDOUT, $loop);

$request = $client->request('GET', 'https://enin.info/');

$request->on('response', function (React\HttpClient\Response $response) use ($stdOut) {
    $response->on('data', function ($chunk) use ($stdOut) {
        $stdOut->write($chunk);
    });
    $response->on('end', function() use ($stdOut) {
        $stdOut->write('DONE' . PHP_EOL);
    });
});

$request->on('error', function (\Exception $e) {
    echo $e->getMessage();
});

$request->end();

$loop->run();
