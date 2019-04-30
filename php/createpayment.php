<?php
session_start();
$strJsonFileContents = file_get_contents("config.json");
$array = json_decode($strJsonFileContents, true);
$amount = $_GET['amount'];
$invoice = "46f647h7"; // must be unique
$intent = "sale";
$proxy = $array["proxy"];
    $createpaybody=array('amount'=>$amount, 'currency'=>'BDT', 'merchantInvoiceNumber'=>$invoice,'intent'=>$intent);   
    $url = curl_init($array["createURL"]);

    $createpaybodyx = json_encode($createpaybody);

    $header=array(
        'Content-Type:application/json',
        'authorization:'.$array["token"],
        'x-app-key:'.$array["app_key"]
    );

    curl_setopt($url,CURLOPT_HTTPHEADER, $header);
	curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
	curl_setopt($url,CURLOPT_POSTFIELDS, $createpaybodyx);
    curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
    //curl_setopt($url, CURLOPT_PROXY, $proxy);
    
    $resultdata = curl_exec($url);
    curl_close($url);
    echo $resultdata;
    

?>
