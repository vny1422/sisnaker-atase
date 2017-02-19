<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Endorsement extends MY_Controller {

  private $data;

  public function __construct()
  {
    parent::__construct();
    $this->load_sidebar();
    $this->load->model('Endorsement/Endorsement_model');
    $this->load->model('Endorsement/Paket_model');
    $this->load->model('Perlindungan/Agency_model');
    $this->load->model('SAdmin/Input_model');

    $this->data['listdp'] = $this->listdp;
    $this->data['usedpg'] = $this->usedpg;
    $this->data['usedmpg'] = $this->usedmpg;
    $this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
    $this->data['namakantor'] = $this->namakantor->nama;
    $this->data['sidebar'] = 'SAdmin/Sidebar';
  }

  public function index()
  {
    $this->data['month'] = date('m');

    /// list tahun
    $this->data['tahunpenempatan'] = $this->Endorsement_model->get_all_year();

    $this->data['title'] = 'DASHBOARD';
    $this->data['subtitle'] = 'ENDORSEMENT';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/Endorsement_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function get_info_year_dashboard(){
    $year = $this->input->post('y');
    $month = $this->input->post('m');
    $all = array();

    $year_jk = $this->Endorsement_model->get_jk_this_year($year);
    $total_year_jk = 0;
    foreach ($year_jk as $jk) {
      $total_year_jk += $jk->total;
    }

    $month_jk = $this->Endorsement_model->get_jk_this_month($year,$month);
    $total_month_jk = 0;
    foreach ($month_jk as $jk) {
      $total_month_jk += $jk->total;
    }

    $year_sektor = $this->Endorsement_model->get_sektor_this_year($year);
    $total_year_sektor = 0;
    foreach ($year_sektor as $sektor) {
      $total_year_sektor += $sektor->total;
    }

    $month_sektor = $this->Endorsement_model->get_sektor_this_month($year,$month);
    $total_month_sektor = 0;
    foreach ($month_sektor as $sektor) {
      $total_month_sektor += $sektor->total;
    }

    $iterm = range(1,12);
    $nm_month = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
      5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
      9 => 'Sep', 10 => 'Okt', 11 => 'Nop', 12=> 'Des'
      );
    $listjp = [];
    $listjpdb = $this->Endorsement_model->get_list_jp_this_year($year);
    foreach ($listjpdb as $jp) {
      array_push($listjp, $jp->namajenispekerjaan);
    }

    $jppermonth = [];
    for($i=0;$i<count($iterm);$i++){
      $temp_1 = array('bulan' => $nm_month[$iterm[$i]]);
      $tot = 0;
      foreach($listjp as $jp){
        $temp_1[$jp] = $this->Endorsement_model->count_jp_this_month($year,$iterm[$i],$jp);
        $tot += $temp_1[$jp];
      }
      $temp_1['total'] = $tot;
      array_push($jppermonth, $temp_1);
    }

    array_push($all,$total_year_jk);
    array_push($all,$year_jk);
    array_push($all,$total_month_jk);
    array_push($all,$month_jk);
    array_push($all,$total_year_sektor);
    array_push($all,$year_sektor);
    array_push($all,$total_month_sektor);
    array_push($all,$month_sektor);
    array_push($all,$listjp);
    array_push($all,$jppermonth);

    echo json_encode($all);
  }

  public function updateagency()
  {
    $this->form_validation->set_rules('name', 'Agency Name', 'required|trim');
    if ($this->form_validation->run() === FALSE)
    {
      $this->data['values'] = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
      $this->data['title'] = 'Endorsement';
      $this->data['subtitle'] = 'Update Agency';
      $this->load->view('templates/headerendorsement', $this->data);
      $this->load->view('Endorsement/UpdateAgency_view', $this->data);
      $this->load->view('templates/footerendorsement');
    }
    else {
      $this->data['values'] = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
      $cek = $this->Agency_model->update_agency($this->data['values']->agid,true);
      if($cek != false)
      {
        $this->Endorsement_model->catat_logagensi($this->data['values']->agid);
        $this->session->set_flashdata('information', 'Profile Updated!');
        $this->data['values'] = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
        $this->data['title'] = 'Endorsement';
        $this->data['subtitle'] = 'Update Agency';
        $this->load->view('templates/headerendorsement', $this->data);
        $this->load->view('Endorsement/UpdateAgency_view', $this->data);
        $this->load->view('templates/footerendorsement');
      }
      else {
        $this->session->set_flashdata('warning', 'You can only EDIT THRICE a YEAR!');
        $this->data['title'] = 'Endorsement';
        $this->data['subtitle'] = 'Update Agency';
        $this->load->view('templates/headerendorsement', $this->data);
        $this->load->view('Endorsement/UpdateAgency_view', $this->data);
        $this->load->view('templates/footerendorsement');
      }
    }
  }

  public function checkBarcode()
  {
    $this->data['title'] = 'Endorsement';
    $this->data['subtitle'] = 'Check Barcode';
    $this->data['subtitle2'] = 'Check Barcode';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/CheckBarcode_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }


  public function createJO()
  {
    $agensi = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
    if(!empty($agensi)) {
      $this->data['listconnpp'] = $this->Endorsement_model->get_connected_pptkis($agensi->agid);
    }
    $this->data['employer'] = $this->Input_model->get_input_dataworker($this->session->userdata('institution'));
    $this->data['joborder'] = $this->Input_model->get_input_joborder($this->session->userdata('institution'));
    $this->data['title'] = 'Endorsement';
    $this->data['subtitle'] = 'Create JO Packet';
    $this->data['subtitle2'] = 'Worker Data';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/CreateJO_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function viewJO()
  {
  	$agensi = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
  	if(!empty($agensi)) {
  		$query = $this->Endorsement_model->getEntryJO_Agensi($agensi->agid);
  		$i=0;
    	foreach ($query as $row):
    		$this->data['rows'][$i] = array(
    			$row->ejid,
		      	$row->ejdatefilled,
		      	$row->ppnama,
		      	$row->namajenispekerjaan,
		      	$row->ejbcsp,
		      	$row->ejtglendorsement
    		);
    		$i++;
    	endforeach;
  	}
    $this->data['title'] = 'Endorsement';
    $this->data['subtitle'] = 'History of JO Packet';
    $this->data['subtitle2'] = 'JO Packet Detail';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/PacketJO_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  //post function
  function getDataFromBarcode()
  {
    $code = $this->input->post('barcode', TRUE);

    $tmp['success'] = false;
    $tmp['message'] = "Barcode atau Token tidak valid!!!";

    $query = $this->Endorsement_model->getKuitansi_FromBarcode($code);

    if(!empty($query)) {
      $tmp['kuitansi'][0] = $query[0];
      $tmp['success'] = true;
    }
    else {
      $query = $this->Endorsement_model->checkEntryJO_FromBarcode($code);

      if(!empty($query)) {
        $count = $query[0]['count'];
        $ejid = $query[0]['ejid'];

        if ($count > 0) {
          // data entry jo
          $query = $this->Endorsement_model->getEntryJO($ejid);
          $tmp = $query[0];
          $tmp['jocatatan'] = str_replace("\n", "<br/>", $query[0]['jocatatan']);
          $tmp['success'] = true;
          $tmp['message'] = "Barcode valid.";

          // data kuitansi
          $query = $this->Endorsement_model->getKuitansi($ejid);
          $i = 0;
          foreach ($query as $row):
            $tmp['kuitansi'][$i++] = $row;
          endforeach;

          // data tki sekarang
          $query = $this->Endorsement_model->getTKINow($ejid);
          $i = 0;
          foreach ($query as $row):
            $tmp['tki'][$i++] = $row;
          endforeach;

          // data tki
          $query = $this->Endorsement_model->getTKI($ejid);
          $i = 0;
          foreach ($query as $row):
            $tmp['tkiall'][$i++] = $row;
          endforeach;
        }
      }
    }
    echo json_encode($tmp);
  }

  function getDataFromEJID()
  {
  	$ejid = $this->input->post('ejid', TRUE);
  	$tmp['success'] = false;

  	// data entry jo
  	$query = $this->Endorsement_model->getEntryJO($ejid);
    $tmp = $query[0];
    $tmp['jocatatan'] = str_replace("\n", "<br/>", $query[0]['jocatatan']);

    // data tki
   	$query = $this->Endorsement_model->getTKI($ejid);
   	$i = 0;
   	foreach ($query as $row):
   		$tmp['tkiall'][$i++] = $row;
   	endforeach;

   	$tmp['success'] = true;

   	echo json_encode($tmp);
  }

  function getJodetail()
  {
    $jobid = $this->input->post('jobid', TRUE);
    $listjob = $this->Endorsement_model->get_jodetail($jobid);
    $i=0;
    foreach ($listjob as $row):
      $sisa = $this->getSisa($row->jobdid, $row->idjenispekerjaan);
      $rows[$i] = array(
        $row->jobdid,
        $row->idjenispekerjaan,
        $row->namajenispekerjaan,
        $sisa[0],
        $sisa[1],
        $sisa[2]
      );
      $i++;
    endforeach;
    echo json_encode($rows);

  }

  //fungsi hitung

  function getSisa($jobd,$jpid)
  {
    $row = $this->Paket_model->getJobOrder($jobd);
    $agid = $row[0]->agid;
    $ppkode = $row[0]->ppkode;
    $jobtglawalnya = $row[0]->jobtglawal;
    $jobtglakhirnya = $row[0]->jobtglakhir;

    $i = 0;
    $query = $this->Paket_model->getJobDetail($jpid,$agid,$ppkode,$jobtglawalnya,$jobtglakhirnya);
    foreach ($query as $row):
      $i++;
      $jobid[$i] = $row->jobid;
      $jobdid[$i] = $row->jobdid;
      $jobtglawal[$i] = $row->jobtglawal;
      $jobtglakhir[$i] = $row->jobtglakhir;
      $jobdl[$i] = $row->jobdl;
      $jobdp[$i] = $row->jobdp;
      $jobdc[$i] =  $row->jobdc;
    endforeach;

    $prevdate = '0000-00-00';
    $j = 0;
    $query = $this->Paket_model->getDate($jpid,$agid,$ppkode,$jobtglawalnya,$jobtglakhirnya);
    foreach ($query as $row):
      $curdate = $row->date;
      if($curdate != $prevdate)
      {
        $j++;
        $period[$j] = $row->date;
      }
      $prevdate = $curdate;
    endforeach;

    for($k = 1; $k < $j; $k++)
    {
      $start = $period[$k];
      $end = $period[$k+1];
      $lriil = $this->Paket_model->getEntryJOLaki($start,$end,$jpid,$agid,$ppkode);
      $priil = $this->Paket_model->getEntryJOPerempuan($start,$end,$jpid,$agid,$ppkode);
      for($l = 1; $l <= $i; $l++)
      {
        if($jobtglawal[$l] <= $start && $jobtglakhir[$l] >= $end)
        {
          $lavail = $jobdl[$l];
          if($lavail < $lriil) { $jobdl[$l] = 0; $lriil -= $lavail;}
          else {$jobdl[$l] -= $lriil; $lriil = 0;}
          $pavail = $jobdp[$l];
          if($pavail < $priil) { $jobdp[$l] = 0; $priil -= $pavail;}
          else {$jobdp[$l] -= $priil; $priil = 0;}
          if($lriil > 0){
            $cavail = $jobdc[$l];
            if($cavail < $lriil) { $jobdc[$l] = 0; $lriil -= $cavail;}
            else {$jobdc[$l] -= $lriil; $lriil = 0;}
          }
          if($priil > 0){
            $cavail = $jobdc[$l];
            if($cavail < $priil) { $jobdc[$l] = 0; $priil -= $cavail;}
            else {$jobdc[$l] -= $priil; $priil = 0;}
          }
        }
      }
    }

    $sisa[0] = $jobdl[$i];
    $sisa[1] = $jobdp[$i];
    $sisa[2] = $jobdc[$i];
    return $sisa;
  }

  function requestTKI()
  {
    require_once("ws_kdei/xmlrpc-func.php");
    $agensi = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
    $paspor = $this->input->post('paspor', TRUE);
    $jpid = $this->input->post('jpid', TRUE);
    $xmlrpc_server_host     = 'siskotkln.bnp2tki.go.id';
			$xml_rpc_server_path    = '/xmlrpc/siskotkln_ws/index.php';

			define('XMLRPC_DEBUG', 1);

			$USER_ID 			= "ws_twn";
			$USER_PASS  		= "ws_twn";
			$SERVICE_NAME 		= "request.tkibypaspor";
			$SERVICE_PARAM		= $paspor;

			$inputArray = array(
				"USER_ID" => $USER_ID,
				"USER_PASS" => $USER_PASS,
				"SERVICE_NAME" => $SERVICE_NAME,
				"SERVICE_PARAM" => $SERVICE_PARAM
			);
      $result = XMLRPC_request($xmlrpc_server_host,  $xml_rpc_server_path ,"siskotkln_ws" , array( XMLRPC_prepare( $inputArray ) ) );
  			$r = new stdClass;
  			$r->status = 0;
  			$r->my_agid = $agensi->agid;
  			$r->tki_agid = 0;
  			$r->jpid = $jpid;

        if ( $result[0] == 1 )
			{
				$result = XMLRPC_parse($result[1]);
				if (isset($result['ws_response']['reqString']['record'])) {
          $records = $result['ws_response']['reqString']['record'];
					$r->status = 1;
					if ($records["TKI_TKIID"] != NULL) {$r->data = $records;}


					// $sql = "SELECT agid_induk FROM agensi_merge_map WHERE agid_kembar = '" . $r->data["TKI_PJTKAID"] . "'";
					// $result = mysql_query($sql) or die($messages['err_query']);
					// if(mysql_num_rows($result)>0){
					// 	$row = mysql_fetch_array($result,MYSQL_ASSOC);
					// 	$r->tki_agid = $row["agid_induk"];
					// }
					// else {
						$r->tki_agid = $r->data["TKI_PJTKAID"];
					//}

					//antisipasi agensi mirip
					// $sql = "SELECT agensi_dua FROM agensi_mirip_map WHERE agensi_satu = '" . $r->data["TKI_PJTKAID"] . "'";
					// $result = mysql_query($sql) or die($messages['err_query']);
					// if(mysql_num_rows($result)>0){
					// 	$row = mysql_fetch_array($result,MYSQL_ASSOC);
					// 	$r->tki_agid_mirip = $row["agensi_dua"];
					// }
					// else {
					// 	$r->tki_agid_mirip = NULL;
					// }
          echo json_encode($r);
				}
        else {
          echo json_encode("0");
        }
			}

  }


public function insertEJ()
{
  $postdata = $this->input->post('postdata', TRUE);
  $posttki = $this->input->post('posttki', TRUE);
  $postdata = json_decode($postdata);
  $posttki = json_decode($posttki);
  $data = array();
  foreach(get_object_vars($postdata) as $prop => $val)
  {
    $data["$prop"] = $val;
  }
  $url = $this->Endorsement_model->geturlpekerjaan($data["idjenispekerjaan"]);
  $data["jodownloadurl"] = $url->curjodownloadurl;
  $splittgl = explode("/", $data["joclatgl"]);
  $data["joclatgl"] = $splittgl[0]."-".$splittgl[1]."-".$splittgl[2];
  $data["agid"] = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'))->agid;
  $data["idinstitution"] = $this->session->userdata('institution');
  $ejid = $this->Endorsement_model->insert_ej($data);
  foreach($posttki as $tki)
  {
    var_dump($tki);
    var_dump($tki->TKI_TKIID);
  }
  echo json_encode(md5($ejid));
}

public function printDokumen($md5ej)
{
  $this->data['title'] = 'Endorsement';
  $this->data['subtitle'] = 'Print Dokumen';
  $this->data['subtitle2'] = 'Entry JO';
  $this->load->view('templates/headerendorsement', $this->data);
  $this->load->view('Endorsement/PrintDokumen_view', $this->data);
  $this->load->view('templates/footerendorsement');
}

public function printJOSK($md5ej)
{
  //code pdf job order
}

public function printPKTKI($md5tki)
{
  //code pdf Perjanjian Kerja
}



}
