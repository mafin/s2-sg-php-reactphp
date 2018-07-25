<?php

function dnsResolver(\React\EventLoop\LoopInterface $loop, string $domain)
{
    static $dns = null;

    if (is_null($dns)) {
        $dns = (new \React\Dns\Resolver\Factory())->create('8.8.8.8', $loop);
    }

    return $dns->resolve($domain);
}

function httpRequest(\React\EventLoop\LoopInterface $loop, string $domain)
{
    return new \React\Promise\Promise(function ($resolve, $reject) use ($loop, $domain) {
        static $client = null;

        if (is_null($client)) {
            $client = new \React\HttpClient\Client($loop);
        }

        $content = '';

        $client->request('GET', $domain)
            ->on('response', function (\React\HttpClient\Response $response) use (&$content) {
                $response->on('data', function ($chunk) use (&$content) {
                    $content .= $chunk;
                });
            })->on('close', function () use ($resolve, &$content) {
                $resolve($content);
            })->on('error', function () use ($reject, &$content) {
                $reject('Rejected');
            })->end();
    });
}

function customSleep(\React\EventLoop\LoopInterface $loop, int $waitTime)
{
    return new \React\Promise\Promise(function ($resolve, $reject) use ($loop, $waitTime) {
        $loop->addTimer($waitTime, function () use ($resolve) {
            $resolve();
        });
    });
}
