<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasus extends MY_Controller {

  private $data;

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Perlindungan/Kasus_model');
    $this->load->model('SAdmin/Jobtype_model');
    $this->load->model('SAdmin/User_model');
    $this->load->model('SAdmin/Currency_model');
    $this->load->helper('string');
    $this->load_sidebar();
    $this->data['listdp'] = $this->listdp;
    $this->data['usedpg'] = $this->usedpg;
    $this->data['usedmpg'] = $this->usedmpg;
    $this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
    if(empty($this->namakantor->nama)){
      $this->data['namakantor'] = "";
    }
    else{
      $this->data['namakantor'] = $this->namakantor->nama;
    }
    $this->data['sidebar'] = 'SAdmin/Sidebar';
  }

  public function index($adid = '')
  {
    if ($this->session->userdata('role') > 3)
    {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }

    $this->data['title'] = 'Kasus';
    $this->data['subtitle'] = 'Input Kasus Baru';
    $this->data['listcategory'] = $this->Kasus_model->list_category($this->session->userdata('institution'));
    $this->data['listinput'] = $this->Kasus_model->list_input($this->session->userdata('institution'));
    $this->data['listinputselect'] = $this->Kasus_model->list_inputselectfromoption($this->session->userdata('institution'));
    foreach ($this->data['listinputselect'] as $row):
      $this->data['i'.$row->idinputdetail_perlindungan] = $this->Kasus_model->list_opsiinput($row->idinputdetail_perlindungan);
    endforeach;
    $this->data['listselecttable'] = $this->Kasus_model->list_inputselectfromtable($this->session->userdata('institution'));
    foreach ($this->data['listselecttable'] as $row):
      $this->data['i'.$row->idinputdetail_perlindungan] = $this->Kasus_model->list_opsitable($row->conntable);
    endforeach;


    //dari simpati

    if($adid == '') $adid = 0;
		$adid = intval($adid);

		$username  = $this->session->userdata('user');
    $name  = $this->session->userdata('name');
    $institusi  = $this->session->userdata('institution');;
    // $data['siap_problem'] 	= $this->Common_model->num_siap_problem();
		$this->data['adid']			= $adid;
		$this->data['crex']			= $username."---".'1'."---".$name."---new---".$institusi;
		$this->load->view('templates/headerperlindungan', $this->data);
		$this->load->view('Perlindungan/InputKasus_view', $this->data);
		$this->load->view('templates/footerperlindungan');
  }

  public function search()
  {
    if (!($this->session->userdata('role') <= 3 || $this->session->userdata('role') == 5))
    {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }

    $this->data['title'] = 'Pencarian Kasus';
    $this->data['subtitle'] = 'Pencarian Aduan';
    $this->load->view('templates/headerperlindungan', $this->data);
    $this->load->view('Perlindungan/PencarianKasus_view', $this->data);
    $this->load->view('templates/footerperlindungan');
  }

  function get_table(){
    $input = $this->input->post();
    if( isset( $_SERVER['CONTENT_TYPE'] ) && strpos( $_SERVER['CONTENT_TYPE'], "application/json" ) !== false )
    {
      $input = json_decode(trim(file_get_contents( 'php://input' ) ), true );
    }

    $from = $input['from'];
    $to = $input['to'];
    $idinstitution = $input['idinstitution'];

    if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 5) {
      $data = $this->Kasus_model->timespan_search($from, $to);
    } else {
      $data = $this->Kasus_model->timespan_search($from, $to, $idinstitution);
    }

    echo json_encode($data);
  }

  function add(){
    $this->Kasus_model->post_new_kasus();
    $this->session->set_flashdata('information', 'Data berhasil dimasukkan');
    $this->data['title'] = 'Kasus';
    $this->data['subtitle'] = 'Input Kasus Baru';
    $this->data['listcategory'] = $this->Kasus_model->list_category($this->session->userdata('institution'));
    $this->data['listinput'] = $this->Kasus_model->list_input($this->session->userdata('institution'));
    $this->data['listinputselect'] = $this->Kasus_model->list_inputselect($this->session->userdata('institution'));
    foreach ($this->data['listinputselect'] as $row):
      $this->data[$row->idinputdetail_perlindungan] = $this->Kasus_model->list_opsiinput($row->idinputdetail_perlindungan);
    endforeach;
		$this->load->view('templates/headerperlindungan', $this->data);
		$this->load->view('Perlindungan/InputKasus_view', $this->data);
		$this->load->view('templates/footerperlindungan');
  }

  function kasuscheck(){
    $this->data['title'] = 'Verifikasi Input Kasus';
    $this->data['subtitle'] = 'Verifikasi Input Kasus';
    $this->load->view('templates/headerperlindungan', $this->data);
    $this->load->view('Perlindungan/InputCheck_view', $this->data);
    $this->load->view('templates/footerperlindungan');
  }

  function checkkasus(){
        $string = $this->getJSONpost();
        $string = $string['text'];

        preg_match_all("/\b[a-zA-Z]+\b/",$string,$nama);
        preg_match_all("/\S\d+\b/",$string,$paspor);
        $nama=$nama[0];
        $paspor=$paspor[0];

        $retval = array($nama,$paspor);
        $similar = $this->Kasus_model->similar_test($nama,$paspor);

		for($i=0;$i<count($similar);$i++){
			$similar[$i]['idx'] = $i+1;
		}

        //echo $similar;
        echo json_encode($similar);

  }

  function checkPaspor()
  {
    $paspor = $this->input->post('paspor', TRUE);
    $data = $this->Kasus_model->query_paspor($paspor);

    echo json_encode($data);
  }

  function delKasus(){
    $input = $this->getJSONpost();
    $id = intval($input['idmasalah']);

    $values = $this->Kasus_model->get_kasus($id);
    if($values->idinstitution == $this->session->userdata('institution')){
      $message = $this->Kasus_model->delete_kasus($id);
    } else {
      $message = false;
    }

    echo json_encode($message);
  }

  public function getParam(){
    $collection = array();
    $collection['worktype'] 	= $this->Kasus_model->get_work_type();
    $collection['klasifikasi'] 	= $this->Kasus_model->get_problem_class();
    $collection['media']		= $this->Kasus_model->get_media();
    $collection['petugas']  = $this->Kasus_model->get_officer_all();
    echo json_encode($collection);
   }

   public function getShelter(){
   $data = $this->Kasus_model->get_shelter();
   echo json_encode($data);
 }
 function deftest($src,$label){
   if(array_key_exists($label,$src) == true) return $src[$label];
   else {
     return "";
   }
 }
 public function save_entry(){
// GET FORM DATA
$fdata = $_POST['formdata'];
$flain = $_POST['formlain'];
$fdata = json_decode($fdata,true);
$flain = json_decode($flain,true);

//// preventif
/// $this->deftest untuk menghindari undefined index

////// data ADUAN
$tglmasuktw 	= $this->deftest($fdata,'tglmasukTW');									//$fdata['tglmasukTW'];
$jeniskerja 	= $this->deftest($fdata,'pekerjaan');									//$fdata['pekerjaan'];
$statustki  	= $this->deftest($fdata,'statustki');									//$fdata['statustki'];
$adid 			= $fdata['adid'];
$agensitw   	= quotes_to_entities(trim($this->deftest($fdata,'agensiTW')));			//$fdata['agensiTW']));
$cpagensitw 	= quotes_to_entities(trim($this->deftest($fdata,'cpagensiTW')));		//$fdata['cpagensiTW']));
$hpagensitw 	= quotes_to_entities(trim($this->deftest($fdata,'telpagensi')));		//$fdata['telpagensi']));
$pptkis     	= quotes_to_entities($this->deftest($fdata,'pptkis'));					//trim($fdata['pptkis']));
$majikan    	= quotes_to_entities(trim($this->deftest($fdata,'majikan')));			//$fdata['majikan']));
$pelapor    	= quotes_to_entities($this->deftest($fdata,'namapelapor'));				//($fdata['namapelapor']);
$tlppelapor		= quotes_to_entities($this->deftest($fdata,'telppelapor'));				//$fdata['telppelapor']);
$tgladuan   	= quotes_to_entities(trim($this->deftest($fdata,'tanggalpengaduan')));	//$fdata['tanggalpengaduan']));
$media  		= $fdata['media'];
$klasifi		= $fdata['klasifikasi'];
$masalah 		= quotes_to_entities(trim($this->deftest($fdata,'permasalahan')));
$tuntutan 		= quotes_to_entities(trim($this->deftest($fdata,'tuntutan')));
$nominal 		= quotes_to_entities(trim($this->deftest($fdata,'nominal')));
$statusmasalah 	= $fdata['statusmasalah'];
$tglselesai		= $this->deftest($fdata,'tglpenyelesaian');
$keyword 		= quotes_to_entities(trim($this->deftest($fdata,'keyword')));
$pulang 		= $fdata['pulangID'];
$tindaklanjut	= $this->deftest($fdata,'tindaklanjut');

/// complex entry
$sektor			= $this->Jobtype_model->get_sektor($fdata['pekerjaan']);
$petugas    	= $fdata['petugas'];
$organisasi = $this->User_model->get_userid($fdata['petugas'])->idinstitution;
$namaorganisasi		= $this->User_model->get_user_institution($fdata['petugas'])->nameinstitution;

$dataAduan = array(
        'idinstitution' => intval($organisasi),
        'nomormasalah' => $this->get_problem_number($tgladuan, $namaorganisasi,$organisasi),
        'idmedia' => intval($media),
        'namapelapor' => $pelapor,
        'teleponpelapor' => $tlppelapor,
        'tanggalpengaduan' => $tgladuan,
        'petugaspenanganan' => $petugas,
        'tanggalmasuktaiwan' => $tglmasuktw,
        'agensi' => $agensitw,
        'cpagensi' => $cpagensitw,
        'teleponagensi' => $hpagensitw,
        'pptkis' => $pptkis,
        'majikan' => $majikan,
        'idklasifikasi' => intval($klasifi),
        'idjenispekerjaan' => intval($jeniskerja),
        'statustki' => intval($statustki),
        'permasalahan' => $masalah,
        'tuntutan' => $tuntutan,
        'uang' => $nominal,
        'statusmasalah' => intval($statusmasalah),
        'tanggalpenyelesaian' => $tglselesai,
        'tanggalkeluarshelter' => '',
        'enable' => 1,
        'agid' => intval($adid),
        'pulang' => intval($pulang),
        'keyword' => $keyword
  );
  foreach ($flain as $key=>$value) {
    $dataAduan[$key] = $value;
  }
// Input Problem to Database
$id_problem = $this->Kasus_model->input_problem($dataAduan);
echo json_encode($dataAduan);

///input tindak lanjut
if($tindaklanjut != "" && strlen($tindaklanjut)>10){
  $date = date('Y-m-d');
  $this->Kasus_model->insert_tindak_lanjut($id_problem,$tindaklanjut,$date,$petugas);
}
//
// ///////////////////////////////////////////////////////////////////////////////
//
//// DATA TKI
$namatki_cur = quotes_to_entities(trim($this->deftest($fdata,'namatki')));
$paspor_cur  = quotes_to_entities(trim($this->deftest($fdata,'paspor')));
$gender_cur  = quotes_to_entities(trim($fdata['jk']));
$arc_cur	 = quotes_to_entities(trim($this->deftest($fdata,'arc')));
$tlptki_cur	 = quotes_to_entities(trim($this->deftest($fdata,'telptki')));
$addid_cur	 = quotes_to_entities(trim($this->deftest($fdata,'alamatID')));
$addtw_cur	 = quotes_to_entities(trim($this->deftest($fdata,'alamatTW')));
// prepare data
$data_tki = array(
    'idmasalah' => $id_problem,
    'namatki' => strtoupper($namatki_cur),
    'jk' => $gender_cur,
    'paspor' => strtoupper($paspor_cur),
    'arc' => $arc_cur,
    'handphone' => $tlptki_cur,
    'alamatindonesia' => $addid_cur,
    'alamattaiwan' => $addtw_cur,
);
// Input TKI to Database
$idtki = $this->Kasus_model->input_tki($data_tki);
///////////////////////////////////////////////////////////////////////////////

$fdata['shelter'] = $this->deftest($fdata,'shelter');
// SHELTER
if($fdata['shelter'] != '') {
  $data_fixsh = array();
  for($i=0;$i<count($fdata['shelter']);$i++){
    $data_sh = array(
      'idmasalah' 	=>	$id_problem,
      'tanggalmasukshelter'		=> 	$fdata['shelter'][$i]['in'],
      'tanggalkeluarshelter'		=> 	$fdata['shelter'][$i]['out'],
      'keterangan'	=> 	$fdata['shelter'][$i]['info'],
      'idshelter'	=> 	$fdata['shelter'][$i]['lokasi']['id']
    );
    array_push($data_fixsh,$data_sh);
  }
  $this->Kasus_model->input_shelter($data_fixsh);
}
///////////////////////////////////////////////////////////////////////////////
$data_file_list = array();
/// file upload + works perfectly
$config['upload_path'] = $this->input->server('DOCUMENT_ROOT').'/sisnaker-atase/data';
$this->load->library('upload',$config);
if(isset($_FILES['file']) && $_FILES['file']['size'] > 0){
  $name_array 	= $_FILES['file']['name'];
  $tmp_name_array = $_FILES['file']['tmp_name'];
  for ($i=0;$i < count($tmp_name_array); $i++) {
    if ($tmp_name_array[$i] != '') {
      if (!move_uploaded_file($tmp_name_array[$i], $config['upload_path'].'/'.$id_problem.'_'.$name_array[$i])) {
        print 'error';
      } else {
        $data_file = array(
            'idmasalah' => $id_problem,
            'filename' => 'data/'.$id_problem.'_'.$name_array[$i],
            'username' => $petugas,
            'timestamp' => date('Y-m-d H:i:s')
        );
        array_push($data_file_list,$data_file['filename']);
        /// Input File
        $this->Kasus_model->input_file($data_file);
        print '<br>input file to database<br>';
      }
    }
  }
}

/*
/// push data to CC-BNP2TKI
$syncstat = "";
$this->load->library("SyncWithCC");
///do the push
$dataAduan['eskalasi'] = $eskalasi;
$syncstat = $this->syncwithcc->pushAduanNew($data_tki,$dataAduan,$data_file_list);
$syncstat = "(Sync:".$syncstat.")";
*/

// Input History
$log = "menginputkan masalah baru";
$data_hist = array(
    'idmasalah' => $id_problem,
    'history' => $log,
    'timestamp' => date('Y-m-d H:i:s')
);
$this->Kasus_model->input_history($data_hist);
}
function get_problem_number($tglpengaduan,$namaorganisasi,$idorganisasi) {

		$romawi = array('01'=>'I','02'=>'II','03'=>'III','04'=>'IV','05'=>'V','06'=>'VI',
						'07'=>'VII','08'=>'VIII','09'=>'IX','10'=>'X','11'=>'XI','12'=>'XII'
						);
		$dt_exp  = explode('/',$tglpengaduan);
		$tahun   = $dt_exp[0];
		$bulan   = $dt_exp[1];
		$count_month_problem = $this->Kasus_model->org_count_problem_thismonth($bulan,$tahun,$idorganisasi);
		$count_year_problem  = $this->Kasus_model->org_count_problem_thisyear($tahun,$idorganisasi);

		$this_number_month = $count_month_problem + 1;
		$this_number_year  = $count_year_problem + 1;

		$problem_number = $this_number_month. "/ADU/" . $namaorganisasi ."/" .  $romawi[$bulan] . "/" . $tahun . " (".$this_number_year.".ADU.".$namaorganisasi.".".$tahun.")";

		return $problem_number;
	}
  function getJSONpost(){
  $input = $this->input->post();
  if( isset( $_SERVER['CONTENT_TYPE'] ) && strpos( $_SERVER['CONTENT_TYPE'], "application/json" ) !== false )
  {
    $input = json_decode(trim(file_get_contents( 'php://input' ) ), true );
  }
  return $input;
}
}
