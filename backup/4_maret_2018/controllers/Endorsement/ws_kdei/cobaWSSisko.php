<html>
<head><title>xmlrpc</title></head>
<body>
<h1>SISKOTKLN WS</h1>
<h2>&nbsp;</h2>

<?php
	include("xmlrpc.inc");
	require_once 'xmlrpc-func.php';

	
	define(XMLRPC_DEBUG, 1);
	if(!isset($HTTP_POST_VARS) && isset($_POST))
	{
		$HTTP_POST_VARS = $_POST;
	}
	
	if(isset($HTTP_POST_VARS["EXEC"])) {
		
		$data['USER_ID']		= $HTTP_POST_VARS["USER_ID"];
        $data['USER_PASS']		= $HTTP_POST_VARS["USER_PASS"];
		$data['SERVICE_NAME']   = $HTTP_POST_VARS["SERVICE_NAME"];
		$data['SERVICE_PARAM']  = $HTTP_POST_VARS["SERVICE_PARAM"];

		
		$f=new xmlrpcmsg('siskotkln_ws',array(php_xmlrpc_encode($data)));
		
		//print "<pre>Sending the following request:\n\n" . htmlentities($f->serialize()) . "\n\nDebug info of server data follows...\n\n";
		$c=new xmlrpc_client("xmlrpc/siskotkln_ws/index.php", "siskotkln.bnp2tki.go.id", 80);
		$c->setDebug(0);
		$r=&$c->send($f);
		if(!$r->faultCode())
		{
			$v=$r->value();
			//print htmlspecialchars(($v->scalarval())) . "<br/>";
			$result = $v->scalarval();
			//echo $result;
			//$records = $result['ws_response']['reqString']['record'];
			//echo "total". count($records);
			//var_dump($v);
			//$x = '<root><child><foo>23</foo><foo>34</foo></child></root>';
			//echo $result;
			
			//echo xmlrpc_decode( trim($result) );
			//var_dump($result);
			//$result = XMLRPC_parse($result);
        	$result = xmlrpc_decode($result);
			var_dump($result);
			
			//$records = $result['ws_response']['reqString']['record'];
			
			//	echo $records["TKI_TKIID"]."<br />";
			//	echo $records["TKI_PASPORNO"]."<br />";
	
			//foreach($records as $record)
			//{
			//	echo $record["TKI_TKIID"]."<br />";
			//	echo $record["TKI_PASPORNO"]."<br />";
			//}
		}
		
		else
		{
			print "An error occurred: ";
			print "Code: " . htmlspecialchars($r->faultCode())
				. " Reason: '" . htmlspecialchars($r->faultString()) . "'</pre><br/>";
		}
    }

?>
<form name="form1" method="post" action="">
  <table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td width="12%">user</td>
      <td width="1%">:</td>
      <td width="87%"><input type="text" name="USER_ID" id="USER_ID" style="width: 400px;" value="ws_twn"></td>
    </tr>
    <tr>
      <td>passs</td>
      <td>:</td>
      <td><input type="text" name="USER_PASS" id="USER_PASS" style="width: 400px;" value="ws_twn"></td>
    </tr>
    <tr>
      <td>ws name</td>
      <td>:</td>
      <td><input type="text" name="SERVICE_NAME" id="SERVICE_NAME" style="width: 400px;" value="request.tkibypaspor"></td>
    </tr>
    <tr>
      <td>ws paaram</td>
      <td>:</td>
      <td><input type="text" name="SERVICE_PARAM" id="SERVICE_PARAM" style="width: 400px;" value="<?=$data['SERVICE_PARAM'];?>"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="EXEC" id="button" value="Submit"></td>
    </tr>
  </table>
</form>
<hr/>

</body>
</html>