<?php

$logger = call_user_func(function () {
    while(true) {
        echo 'Log: ' . yield . PHP_EOL;
    }
});

$logger->send('Hello ');
$logger->send('world');
