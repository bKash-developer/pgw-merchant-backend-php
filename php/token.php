<?php
    session_start();
    
	$request_token=bkash_Get_Token();
	$idtoken=$request_token['id_token'];
	
	$_SESSION['token']=$idtoken;
	
	echo $idtoken;
	

	function bkash_Get_Token(){
	$post_token=array(
	       'app_key'=>'shared-app-key',
		   'app_secret'=>'shared-app-secret'
	);	
		$url=curl_init('https://checkout.sandbox.bka.sh/v1.0.0-beta/checkout/token/grant');
		
		$posttoken=json_encode($post_token);
		$header=array(
		        'Content-Type:application/json',
				'password:shared-password',
				'username:shared-username');				
				curl_setopt($url,CURLOPT_HTTPHEADER, $header);
				curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
				curl_setopt($url,CURLOPT_POSTFIELDS, $posttoken);
				curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
				$resultdata=curl_exec($url);
				curl_close($url);
				return json_decode($resultdata, true);
	}

?>