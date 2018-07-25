<?php

//In this function, every new line from the file is yielded up to the calling code.
// So, you can consider getLinesFromFile() function as interruptible,
// because generators work by passing control back and forth between the generator and the calling code.

function getLinesFromFile($fileName) {
    if (!$fileHandle = fopen($fileName, 'r')) {
        return;
    }

    while (false !== $line = fgets($fileHandle)) {
        yield $line;
    }

    fclose($fileHandle);
}

$lines = getLinesFromFile('test.txt');

foreach ($lines as $line) {
    // do something with $line
}