# Installation

Download the GitKargo.php file and include it into your project like this and instantiate the GitKargo class.

```php
require_once "PATH/TO/LIB/GitKargo.php";
$gitKargo = new GitKargo;
```
Thats it!
## send() Example
To send package information to Git Kargo.

```php

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
```

send() method returns an array of:
```php
array(
	"status" => "error or success",
	"message" => "a message",
	"order_id" => "Git Kargo order id"
)
```

**status** will be **success** if a shipment data successfully created on Git Kargo. **order_id** will be the Git Kargo order id. Otherwise, status returns error, order_id returns 0 and message will be the error message returned from Git Kargo.

## trackByOrderId() Example
To track a shipment by Git Kargo order id.

```php

$gitKargo->setAccessToken("XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"); // Access Token retrieved from GitKargo customer services
$gitKargo->trackByOrderId(11111); // Special tracking number

$track = $gitKargo->trackByOrderId();

print_r($track);
```

## trackBySpecialTrackingNumber() Example
To track a shipment by Git Kargo order id.

```php
$gitKargo->setAccessToken("XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"); // Access Token retrieved from GitKargo customer services
$gitKargo->setSpecialTrackingNumber(12345678911); // Special tracking number

$track = $gitKargo->trackBySpecialTrackingNumber();

print_r($track);
```

Both trackByOrderId() and trackBySpecialTrackingNumber() methods returns an array of:

```php
return array(
	"status" => "error or success",
	"message" => "a message",
	"orderStatus" => "current status of the order",
	"orderMovements" => "movements of shipment array"
);
```

**status** will be success if a shipment data found on Git Kargo. If it is "success", then the current status of the order and movements will be returned on the array.
