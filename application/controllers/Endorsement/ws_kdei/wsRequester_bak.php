<?php
/**
 * Client untuk menembak ke xmlrpc_server
 */

/* Include dulu library XMLRPC-nya */
require_once 'xmlrpc-func.php';

$xmlrpc_server_host     = 'siskotkln.bnp2tki.go.id';
$xml_rpc_server_path    = '/xmlrpc/siskotkln_ws/index.php';

define(XMLRPC_DEBUG, 1);

/*
 * COntoh kirim user dan pass
 */
echo "<h3>SISKOTKLN REQUESTER</h3>";
?>
    <div>
        <form action="?" method="post" enctype="multipart/form-data" name="myForm" id="myForm">
<table>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><input type="text" name="userName" id="userName" value="ws_twn">
              <i>* ws_twn</i></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td><input type="password" name="pswd" id="pswd">
              </td>
            </tr>
            <tr>
                <td>Service</td>
                <td>:</td>
                <td>
                    <select name="service" id="service" style="width:155px">
                      <option value="request.getpptkisterkait">Get PPTKIS Terkait</option>
                      <option value="request.getpptkis">Get Data PPTKIS </option>
                      <option value="exec.ins_agency">INSERT AGENCY</option>
                      <option value="exec.upd_agency">UPDATE AGENCY</option>
                      <option value="exec.insert_jo">INSERT JOB ORDER</option>
                      <option value="exec.change_agensi">UBAH AGENCY TKI</option>
                      <option value="exec.change_status">UBAH STATUS TKI</option>
            </select>
                    <i>*pilih service yang tersedia</i>
                </td>
            </tr>
            <tr>
                <td>Param</td>
                <td>:</td>
                <td><input type="text" name="param" id="param"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" name="submit" id="submit" value="PROSES"></td>
            </tr>
        </table>
        </form>
</div>
<?

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

    $result = XMLRPC_request($xmlrpc_server_host,  $xml_rpc_server_path ,"siskotkln_ws" , array( XMLRPC_prepare( $inputArray ) ) );
    if ( $result[0] == 1 )
    {
        echo "<pre>";
        htmlspecialchars(print_r($result[1]));
        echo "</pre>";
    }
    else 
    {
        echo "ERROR:<pre>";
        htmlspecialchars(print_r($result[1]));
        echo "</pre>";
    }
}
?>