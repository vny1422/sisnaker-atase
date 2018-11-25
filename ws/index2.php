<?php

	$uri = "http://ws-sisnaker.kemnaker.go.id/kemenaker/bnp/pptkis/get_by_id/";
	//die($uri);
	
	$_user 		= "atnaker";
	$_pwd 		= "atnaker@2018";
	
	$param["header"]["username"] 		= $_user;
	$param["header"]["password"] 		= $_pwd;
	$param["detail"]["id_pptkis"] 		= "2";
	
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
