<?php

// Track by GitKargo order id

require_once "PATH/TO/LIB/GitKargo.php";

$gitKargo = new GitKargo;

$gitKargo->setAccessToken("XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"); // Access Token retrieved from GitKargo customer services
$gitKargo->trackByOrderId(11111); // Special tracking number

$track = $gitKargo->trackByOrderId();

print_r($track);