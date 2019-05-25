<?php

class GitKargo{
	
	function __construct(){
		$this->sendEndpoint = "https://api.gitkargo.com/create-order";
		$this->trackEndpoint = "https://api.gitkargo.com/track-order";
	}

	function setAccessToken($accessToken){
		$this->accessToken = $accessToken;
	}

	function setCustomerName($customerName){
		$this->customerName = $customerName;
	}

	function setCustomerAddress($address){
		$this->customerAddress = $address;
	}

	function setCustomerPhone($phone){
		$this->customerPhone = $phone;
	}

	function setCustomerCity($city){
		$this->customerCity = $city;
	}

	function setCustomerDistrict($district){
		$this->customerDistrict = $district;
	}

	function setOrderType($orderType){
		$this->orderType = $orderType;
	}

	function setOrderPayment($orderPayment){
		$this->orderPayment = $orderPayment;
	}

	function setPrice($price){
		$this->price = $price;
	}

	function setDesi($desi){
		$this->desi = $desi;
	}

	function setContent($content){
		$this->content = $content;
	}

	function setSpecialTrackingNumber($specialTrackingNumber){
		$this->specialTrackingNumber = $specialTrackingNumber;
	}

	function setOrderId($orderId){
		$this->orderId = $orderId;
	}

	function send(){

		$params = array(
			"access_token" 				=> $this->accessToken,
			"customer_name" 			=> $this->customerName,
			"address" 					=> $this->customerAddress,
			"phone_number" 				=> $this->customerPhone,
			"city" 						=> $this->customerCity,
			"district" 					=> $this->customerDistrict,
			"order_type" 				=> $this->orderType,
			"order_payment" 			=> $this->orderPayment,
			"price" 					=> $this->price,
			"desi" 						=> $this->desi,
			"shipping_content" 			=> $this->content,
			"special_tracking_number" 	=> $this->specialTrackingNumber
		);

		$send = $this->gitPost($this->sendEndpoint, $params);

		return $send;

	}

	function trackByOrderId(){

		$url = $this->trackEndpoint . "?access_token=" . $this->accessToken . "&order_id=" . $this->orderId;

		return $track = $this->gitGet($url);

	}

	function trackBySpecialTrackingNumber(){

		$url = $this->trackEndpoint . "?access_token=" . $this->accessToken . "&special_tracking_number=" . $this->specialTrackingNumber;

		return $track = $this->gitGet($url);

	}

	private function gitPost($url, $postParams = array()){
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_POST, 1);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $postParams);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 5000);
        
        $result = curl_exec($ch);
        $error = curl_error($ch);

        if(strlen($error) > 0){
        	return $this->gitPostResult("error", $error);
        }
        else{

        	$result = $this->gitDecode($result);

        	if(isset($result["order_id"])){
        		return $this->gitPostResult("success", $result["message"], $result["order_id"]);
        	}
        	else{
        		return $this->gitPostResult("error", $result["message"]);
        	}

        }
        
    }

    private function gitGet($url){
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 5000);
        
        $result = curl_exec($ch);
        $error = curl_error($ch);

        print_r($this->gitDecode($result));

        if(strlen($error) > 0){
        	return $this->gitGetResult("error", $error);
        }
        else{

        	$result = $this->gitDecode($result);

        	if(isset($result["order"])){
        		return $this->gitGetResult("success", "Kargo detayları getirildi.", $result["status"], $result["movements"]);
        	}
        	else{
        		return $this->gitGetResult("error", $result["message"]);
        	}

        }
        
    }

    private function gitPostResult($status, $message = "", $data = 0){

    	return array(
    		"status" => $status,
        	"message" => $message,
        	"order_id" => $data
    	);

    }

    private function gitGetResult($status, $message = "", $orderStatus = "", $orderMovements = array()){

    	return array(
    		"status" => $status,
        	"message" => $message,
        	"orderStatus" => $orderStatus,
        	"orderMovements" => $orderMovements
    	);

    }

    private function gitEncode($array){
     	return json_encode($array, JSON_UNESCAPED_UNICODE);
	}

	private function gitDecode($string){
	    return json_decode($string, JSON_UNESCAPED_UNICODE);
	}

}