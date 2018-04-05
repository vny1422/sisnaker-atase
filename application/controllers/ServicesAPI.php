
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ServicesAPI extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Endorsement/API_model');
  }

  function insert_jo()
  {
    $jobid = $this->input->post('jobid', TRUE);

    $r = new stdClass;
    $r->status = 0;


    // cek cekal pptkis di BNP2TKI
    require_once 'xmlrpc-func.php';

    $xmlrpc_server_host     = 'siskotkln.bnp2tki.go.id';
    $xml_rpc_server_path    = '/xmlrpc/siskotkln_ws/index.php';

    define(XMLRPC_DEBUG, 1);


    $sql = "	SELECT
    *, DATE_FORMAT(jobtglawal, '%Y%m%d') as jobtglawal2, DATE_FORMAT(jobtglakhir, '%Y%m%d') as jobtglakhir2
    FROM jo
    WHERE
    jo.jobid = $jobid";
    $result = mysql_query($sql) or die($messages['err_query']);
    $tmp = array();
    if ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
      $tmp = $row;
    }

    $USER_ID            = "ws_twn";
    $USER_PASS          = "ws_twn";
    $SERVICE_NAME       = "exec.insert_jo";
    $SERVICE_PARAM	  = $tmp['jobno']."|".$tmp['jobtglawal2']."|".$tmp['jobtglakhir2']."|".$tmp['ppkode']."|".$tmp['agid']."|";

    $sql = "	SELECT
    *
    FROM jodetail
    JOIN jenispekerjaan ON jenispekerjaan.jpid = jodetail.jpid
    WHERE
    jodetail.jobid = $jobid";
    $result = mysql_query($sql) or die($messages['err_query']);
    $tmp = array();
    $n = mysql_num_rows($result);
    $i = 0;
    while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
      $SERVICE_PARAM .= $row['idpekerjaan_bnp2tki']."[,]".$row['jobdl']."[,]".$row['jobdp']."[,]".$row['jobdc']."[,]".(int)$row['jpgaji'];
      if ($i < ($n - 1)) {
        $SERVICE_PARAM .= "[.]";
      }
      $i++;
    }

    $inputArray['USER_ID']          = $USER_ID;
    $inputArray['USER_PASS']        = $USER_PASS;
    $inputArray['SERVICE_NAME']     = $SERVICE_NAME;
    $inputArray['SERVICE_PARAM']    = $SERVICE_PARAM;

    $result = XMLRPC_request($xmlrpc_server_host,  $xml_rpc_server_path ,"siskotkln_ws" , array( XMLRPC_prepare( $inputArray ) ) );
    if ($result[0] == 1) {
      $r->response = $result[1];

      $sql = "UPDATE jo SET jobispushed = 1, jopushtimestamp = NOW() WHERE jobid = $jobid";
      $result = mysql_query($sql) or die($messages['err_query']);

      $r->status = 1;
    }

    echo json_encode($r);
  }

  function cobak(){
    // $jo_data = $this->API_model->getJOByJobId(1);
    // $jo_data_fix = $jo_data[0];
    // var_dump($jo_data_fix);


    $jo_detail = $this->API_model->getJODetailWithGaji(1);
    var_dump($jo_detail);

  }

  function cobak2(){
    $uri = "http://atnaker.kemnaker.go.id/RestfulAPI/pushTundaLayan/";
  	//die($uri);

  	$_user 		= "atnaker";
  	$_pwd 		= "atnaker@2018";

  	$param["tl_stk_kode"] 			= "ILY003";
  	$param["tl_type"] 				= "PPTKIS";
  	$param["tl_startdate"] 			= "31-11-2012";
  	$param["tl_expiredate"] 		= "31-11-2017";
  	$param["tl_status"] 			= "1";
  	$param["tl_issuer_catatan"] 	= "CATATAN TUNDA LAYAN";


  	$param_send = json_encode ( $param );


  	//$param_send = json_encode ( $param );
  	$ch = curl_init($uri);

    $headers = array(
    'Content-Type:application/json',
    'Authorization: Basic '. base64_encode("$_user:$_pwd") // <---
    );

    //echo base64_encode("$_user:$_pwd");

  	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  	curl_setopt($ch, CURLOPT_USERPWD, "$_user:$_pwd");
  	curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
  	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $param_send );
  	curl_setopt_array($ch, array(
  	    CURLOPT_RETURNTRANSFER  =>true,
  	    CURLOPT_VERBOSE     => 1
  	));



  	$out = curl_exec($ch);
  	curl_close($ch);

  	echo $out;
  }

  function insert_jo_to_bnp()
  {
    $jobid = $this->input->post('jobid', TRUE);

    // get data jo
    $jo_data = $this->API_model->getJOByJobId($jobid);
    $jo_data_fix = $jo_data[0];

    // get jo detail
    $jo_detail = $this->API_model->getJODetailWithGaji($jobid);

    $a = array();
    foreach ($jo_detail as $detail) {
      $data = array(
        'jo_det_id'     => $detail->jobdid,
        'jo_det_job_id' => $detail->idjenispekerjaan,
        'jo_det_L'      => $detail->jobdl,
        'jo_det_P'      => $detail->jobdc,
        'jo_det_C'      => $detail->jobdc,
        'jo_det_gaji'   => $detail->jpgaji
      );
      array_push($a, $data);
    }

    // get country code
    $country_id = $this->Agency_model->get_idcountry_by_idinstitution($this->session->userdata('institution'));

    $url = "http://ws-sisnaker.kemnaker.go.id/kemenaker/bnp/jo/insert/";
    $param["detail"]["jo_id"] 	       = $jo_data_fix->jobid; ### isi detailnya disini
    $param["detail"]["jo_no"] 	       = $jo_data_fix->jobno; ### isi detailnya disini
    $param["detail"]["jo_tgl"] 	       = $jo_data_fix->jobtglawal; ### isi detailnya disini
    $param["detail"]["jo_takhir"] 	   = $jo_data_fix->jobtglakhir; ### isi detailnya disini
    $param["detail"]["jo_pt"] 	       = $jo_data_fix->ppkode; ### isi detailnya disini
    $param["detail"]["jo_agency"] 	   = $jo_data_fix->agid; ### isi detailnya disini
    $param["detail"]["jo_negara"] 	   = $country_id; ### isi detailnya disini
    //$param["detail"]["jo_url"] 	       = $jo_data_fix->; ### isi detailnya disini
    $param["detail"]["jo_detail"] 	   = $a; ### isi detailnya disini

    $result = $this->send_request($url, $param);
    var_dump($result);
  }

  function get_tki_by_paspor($paspor)
  {
    $url = "http://ws-sisnaker.kemnaker.go.id/kemenaker/bnp/pk/get_by_paspor/";
    $param["detail"]["tki_pasporno"] 	= $paspor; ### isi detailnya disini
    //$param["detail"]["other_detail"] 	= "AT6773978"; semisal banyak detail
    $result = $this->send_request($url, $param);
    var_dump($result);
    switch ($result->response_code) {
      case '0':
        return 'TKI not found.';
      case '1':
        return $result->response_data;
      case '-1':
        return 'Failed to Authenticate Service to SISKOTKLN.';
      case '-2':
        return 'TKI belum bayar jamsospra.';
    }
  }

  function ws_get_pptkis_status_by_id($idpptkis)
  {
    $url = "http://ws-sisnaker.kemnaker.go.id/kemenaker/bnp/pptkis/get_by_id/";
    $param["detail"]["id_pptkis"] 	= $idpptkis; ### isi detailnya disini
    //$param["detail"]["other_detail"] 	= "AT6773978"; semisal banyak detail
    $result = $this->send_request($url, $param);

    //return json_encode()
    var_dump($result);
    return ($result);
    //var_dump($result->response_code); ## to access the property
  }

  function send_request($url, $detail)
  {
    $detail["header"]["username"] = "atnaker";
    $detail["header"]["password"] = "atnaker@2018";

    $param_send = json_encode ( $detail );

    $ch = curl_init($url);
    curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $param_send );
    curl_setopt_array($ch, array(
        CURLOPT_RETURNTRANSFER  =>true,
        CURLOPT_VERBOSE     => 1
    ));

    $out = curl_exec($ch);
    curl_close($ch);

    return json_decode($out);
  }

}
?>
