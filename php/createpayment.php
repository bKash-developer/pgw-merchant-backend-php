<?php
session_start();

$amount=$_GET['amount'];
$invoice="YOUR_MERCHANT_INVOICE_NUMBER";//must be unique
$intent = "sale";

	   $createpaybody=array(
	       'amount'=>$amount,
		   'currency'=>'BDT',
		   'intent'=>$intent,
		   'merchantInvoiceNumber'=>$invoice
		   );	
		
		$url=curl_init('https://checkout.sandbox.bka.sh/v1.0.0-beta/checkout/payment/create');
		
		$createpaybodyx=json_encode($createpaybody);
		$header=array(
		        'Content-Type:application/json',
				'authorization:'.$_SESSION['token'],
				'x-app-key:shared-app-key');				
				curl_setopt($url,CURLOPT_HTTPHEADER, $header);
				curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
				curl_setopt($url,CURLOPT_POSTFIELDS, $createpaybodyx);
				curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
				$resultdata=curl_exec($url);
				curl_close($url);
				echo $resultdata;
?>