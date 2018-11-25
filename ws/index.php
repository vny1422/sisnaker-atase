<?php

	$uri = "http://ws-sisnaker.kemnaker.go.id/kemenaker/bnp/agency/insert/";
	//die($uri);
	
	$_user 		= "atnaker";
	$_pwd 		= "atnaker@2018";
	
	$param["header"]["username"] 		= $_user;
	$param["header"]["password"] 		= $_pwd;
	$param["detail"]["agc_source_id"] = "142227";
	$param["detail"]["agc_name"] = "Ilyaszzz";
	$param["detail"]["agc_director"] = "Ilyaszzz";
	$param["detail"]["agc_address"] = "BAMBU";
	$param["detail"]["agc_phone"] = "021 1234567";
	$param["detail"]["agc_fax"] = "021 1234567";
	$param["detail"]["agc_country_id"] = "001.123.456";
	$param["detail"]["agc_email"] = "ilyaszzz@gmail.com";
	$param["detail"]["agc_iicense"] = "TP.SIUP. 025/PPTKLN/XII/2017";
	
	$param_send = json_encode ( $param );
	
	
	$param_send = json_encode ( $param );
	$ch = curl_init($uri);
	curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $param_send );
	curl_setopt_array($ch, array(
	    CURLOPT_RETURNTRANSFER  =>true,
	    CURLOPT_VERBOSE     => 1
	));
	
	$out = curl_exec($ch);
	curl_close($ch);
	
	echo $out;	



?>
