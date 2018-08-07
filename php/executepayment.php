<?php
session_start();
$paymentID=$_GET['paymentID'];
    
$url=curl_init('https://checkout.sandbox.bka.sh/v1.0.0-beta/checkout/payment/execute/'.$paymentID);
$header=array(
		'Content-Type:application/json',
		'authorization:'.$_SESSION['token'],
		'x-app-key:shared-app-key');	
		curl_setopt($url,CURLOPT_HTTPHEADER, $header);
		curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
		$resultdatax=curl_exec($url);
		curl_close($url);
	echo $resultdatax;   
    

?>