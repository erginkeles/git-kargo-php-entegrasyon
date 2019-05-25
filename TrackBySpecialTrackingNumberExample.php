<?php

// Track by special tracking number

require_once "PATH/TO/LIB/GitKargo.php";

$gitKargo = new GitKargo;

$gitKargo->setAccessToken("XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"); // Access Token retrieved from GitKargo customer services
$gitKargo->setSpecialTrackingNumber(12345678911); // Special tracking number

$track = $gitKargo->trackBySpecialTrackingNumber();

print_r($track);