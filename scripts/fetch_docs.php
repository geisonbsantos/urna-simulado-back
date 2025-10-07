<?php
$url = 'http://127.0.0.1:8000/docs.json';
$c = file_get_contents($url);
if ($c === false) { echo "FAILED\n"; exit(1); }
file_put_contents(__DIR__ . '/../docs_output.json', $c);
echo "WROTE " . strlen($c) . " bytes\n";
