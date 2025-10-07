<?php
$s = file_get_contents(__DIR__ . '/../docs_output.json');
if (strpos($s, '/api/profiles/{profile}') !== false) echo "HAS_PROFILE_PARAM\n";
if (strpos($s, '/api/users/{id}') !== false) echo "HAS_USER_ID\n";
if (strpos($s, 'bearerAuth') !== false) echo "HAS_BEARER\n";
