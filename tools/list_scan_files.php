<?php
require __DIR__ . '/../vendor/autoload.php';

use OpenApi\Util;

$paths = [
    realpath(__DIR__ . '/../app/OpenApi'),
    realpath(__DIR__ . '/../app'),
];

echo "Scanning paths:\n";
foreach ($paths as $p) {
    echo " - $p\n";
}

$finder = Util::finder($paths, [], '*.php');

foreach ($finder as $file) {
    echo $file->getRealPath() . PHP_EOL;
}

echo "Done.\n";
