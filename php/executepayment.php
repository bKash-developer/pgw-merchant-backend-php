<?php
session_start(); 
$strJsonFileContents = file_get_contents("config.json");
$array = json_decode($strJsonFileContents, true);
$paymentID = $_GET['paymentID'];
$proxy = $array["proxy"];

$url = curl_init($array["executeURL"].$paymentID);

$header=array(
    'Content-Type:application/json',
    'authorization:'.$array["token"],
    'x-app-key:'.$array["app_key"]              
);	
    
curl_setopt($url,CURLOPT_HTTPHEADER, $header);
curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
//curl_setopt($url, CURLOPT_PROXY, $proxy);

$resultdatax=curl_exec($url);
curl_close($url);
echo $resultdatax;  
?>
