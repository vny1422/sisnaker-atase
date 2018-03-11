<html>
<head><title>xmlrpc</title></head>
<body>
<h1>SISKOTKLN WS</h1>
<h2>&nbsp;</h2>

<?php
	include("xmlrpc.inc");
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
		
		print "<pre>Sending the following request:\n\n" . htmlentities($f->serialize()) . "\n\nDebug info of server data follows...\n\n";
		$c=new xmlrpc_client("xmlrpc/siskotkln_ws/index.php", "siskotkln.bnp2tki.go.id", 80);
		$c->setDebug(1);
		$r=&$c->send($f);
		if(!$r->faultCode())
		{
			$v=$r->value();
			print htmlspecialchars(($v->scalarval())) . "<br/>";
		}
		else
		{
			print "An error occurred: ";
			print "Code: " . htmlspecialchars($r->faultCode())
				. " Reason: '" . htmlspecialchars($r->faultString()) . "'</pre><br/>";
		}
    }

?>
<hr/>

</body>
</html>