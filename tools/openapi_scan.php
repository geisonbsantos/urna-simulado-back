<?php

require __DIR__ . '/../vendor/autoload.php';

use OpenApi\Generator;
use OpenApi\Loggers\DefaultLogger;

echo "Running OpenApi Generator scan...\n";

try {
    $logger = new DefaultLogger();
    $generator = new Generator($logger);

    // Configurar paths para scannear
    $paths = [
        realpath(__DIR__ . '/../app/OpenApi'),
        realpath(__DIR__ . '/../app'),
    ];

    $generator->setConfig(['scan' => ['paths' => $paths]]);

    $analysis = $generator->generate();

    echo "Analysis generated. Serializing to JSON...\n";
    echo $analysis->toJson();
} catch (\Throwable $e) {
    echo "EXCEPTION: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}

echo "Done.\n";
