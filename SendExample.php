<?php

// Send order data to GitKargo

require_once "PATH/TO/LIB/GitKargo.php";

$gitKargo = new GitKargo;

$gitKargo->setAccessToken("XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"); // Access Token retrieved from GitKargo customer services
$gitKargo->setCustomerName("Ergin Keleş"); // Customer name and surname
$gitKargo->setCustomerAddress("X Mah, Y Cad, No:1/1"); // Customer address
$gitKargo->setCustomerPhone("532XXXXXXX"); // Customer phone
$gitKargo->setCustomerCity("Samsun"); // Customer city
$gitKargo->setCustomerDistrict("Atakum"); // Customer district
$gitKargo->setOrderType(18); // 18 for Git Standart, ask to GitKargo customer services for other shipment types
$gitKargo->setOrderPayment("offline"); // 'online' for cash on delivery, offline for prepaid
$gitKargo->setPrice(158.77); // Cash on delivery amount, zero-0 for offline
$gitKargo->setDesi(1); // Shipment desi amount
$gitKargo->setContent("Test İçerik"); // What's in the box? :)
$gitKargo->setSpecialTrackingNumber(12345678911); // Special tracking number

$send = $gitKargo->send();

print_r($send);