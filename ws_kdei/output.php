<?php
/**
 * Client untuk menembak ke xmlrpc_server
 */

/* Include dulu library XMLRPC-nya */
require_once 'xmlrpc-func.php';

$xmlrpc_server_host     = 'siskotkln.bnp2tki.go.id';
$xml_rpc_server_path    = '/xmlrpc/siskotkln_ws/index.php';

define(XMLRPC_DEBUG, 1);

$USER_ID 			= $_POST["userName"];
$USER_PASS  		= $_POST["pswd"];
$SERVICE_NAME 		= $_POST["service"];
$SERVICE_PARAM		= $_POST["param"];
$_submit 	= $_POST["submit"];

if(isset($_submit)){
	$inputArray['USER_ID'] 			= $USER_ID;
	$inputArray['USER_PASS'] 		= $USER_PASS;
	$inputArray['SERVICE_NAME'] 	= $SERVICE_NAME;
	$inputArray['SERVICE_PARAM'] 	= $SERVICE_PARAM;	
    //var_dump($inputArray);
    $result = XMLRPC_request($xmlrpc_server_host,  $xml_rpc_server_path ,"siskotkln_ws" , array( XMLRPC_prepare( $inputArray ) ) );
    var_dump($result);
    if ( $result[0] == 1 )
    {
		//var_dump($result[1]);
        $result = XMLRPC_parse($result[1]);
		var_dump($result);
//var_dump($result);
        $records = $result['ws_response']['reqString']['record'];
		
		echo "<br />". $result['ws_response']['reqString'];
		//echo "total". count($records);
		//if ($records[0]["TKI_TKIID"] != NULL) echo "TKInya lebih dari satu";
		//else if($records["TKI_TKIID"] != NULL) echo "TKInya satu aja";
		//foreach ($records as $record)
		//{echo "/".$record["TKI_TKIID"]."/";}
		//echo json_encode($records);
		//}
    }
}
