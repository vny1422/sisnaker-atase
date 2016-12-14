<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasus extends MY_Controller {

  private $data;

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Perlindungan/Kasus_model');
    $this->load->model('SAdmin/Jobtype_model');
    $this->load->helper('string');
    $this->load_sidebar();
    $this->data['listdp'] = $this->listdp;
    $this->data['usedpg'] = $this->usedpg;
    $this->data['usedmpg'] = $this->usedmpg;
    $this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
    $this->data['sidebar'] = 'SAdmin/Sidebar';
  }

  public function index($adid = '')
  {
    $this->data['title'] = 'Kasus';
    $this->data['subtitle'] = 'Input Kasus Baru';
    $this->data['listcategory'] = $this->Kasus_model->list_category($this->session->userdata('institution'));
    $this->data['listinput'] = $this->Kasus_model->list_input($this->session->userdata('institution'));
    $this->data['listinputselect'] = $this->Kasus_model->list_inputselectfromoption($this->session->userdata('institution'));
    foreach ($this->data['listinputselect'] as $row):
      $this->data[$row->idinputdetail_perlindungan] = $this->Kasus_model->list_opsiinput($row->idinputdetail_perlindungan);
    endforeach;
    $this->data['listselecttable'] = $this->Kasus_model->list_inputselectfromtable($this->session->userdata('institution'));
    foreach ($this->data['listselecttable'] as $row):
      $this->data[$row->idinputdetail_perlindungan] = $this->Kasus_model->list_opsitable($row->conntable);
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

    $data = $this->Kasus_model->timespan_search($from, $to);

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
$fdata = json_decode($fdata,true);

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
$organisasi		= $this->Input_model->get_officer_info($fdata['petugas'])->row_array()['idorganisasi'];

$dataAduan = array(
        'idorganisasi' => intval($organisasi),
        'nomormasalah' => $this->get_problem_number($tgladuan, $organisasi),
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
        'idjenis' => intval($jeniskerja),
        'sektor' => intval($sektor),
        'statustki' => intval($statustki),
        'permasalahan' => $masalah,
        'tuntutan' => $tuntutan,
        'tindaklanjut' => $tindaklanjut,
        'uang' => $nominal,
        'statusmasalah' => intval($statusmasalah),
        'tanggalpenyelesaian' => $tglselesai,
        'tanggalkeluarshelter' => '',
        'enable' => 1,
        'adid' => intval($adid),
        'pulang' => intval($pulang),
        'keyword' => $keyword
  );
// Input Problem to Database
$id_problem = $this->Input_model->input_problem($dataAduan);
//echo json_encode($dataAduan);

///input tindak lanjut
if($tindaklanjut != "" && strlen($tindaklanjut)>10){
  $date = date('Y-m-d');
  $this->Input_model->insert_tindak_lanjut($id_problem,$tindaklanjut,$date,$petugas);
}

///////////////////////////////////////////////////////////////////////////////

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
    'paspor' => $paspor_cur,
    'arc' => $arc_cur,
    'handphone' => $tlptki_cur,
    'alamatindonesia' => $addid_cur,
    'alamattaiwan' => $addtw_cur,
    'enable' => 1
);
// Input TKI to Database
$idtki = $this->Input_model->input_tki($data_tki);
///////////////////////////////////////////////////////////////////////////////

$fdata['shelter'] = $this->deftest($fdata,'shelter');
/// SHELTER
if($fdata['shelter'] != '') {
  for($i=0;$i<count($fdata['shelter']);$i++){
    $data_sh = array(
      'idmasalah' 	=>	$id_problem,
      'idtki' 		=>	$idtki,
      'tgmasuk'		=> 	$fdata['shelter'][$i]['in'],
      'tgkeluar'		=> 	$fdata['shelter'][$i]['out'],
      'keterangan'	=> 	$fdata['shelter'][$i]['info'],
      'idorganisasi'	=> 	$fdata['shelter'][$i]['lokasi']['idorganisasi']
    );
    $this->Input_model->input_shelter($data_sh);
  }
}
///////////////////////////////////////////////////////////////////////////////
$data_file_list = array();
/// file upload + works perfectly
$config['upload_path'] = $this->input->server('DOCUMENT_ROOT').'/data';
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
        $this->Input_model->input_file($data_file);
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
$log = "<em>".$fdata['ofname']."</em> menginput masalah baru <a href='view.php?id=".$id_problem."'>".strtoupper($namatki_cur)."</a> ".$syncstat;
$data_hist = array(
    'idmasalah' => $id_problem,
    'history' => $log,
    'timestamp' => date('Y-m-d H:i:s')
);
$this->Input_model->input_history($data_hist);



}
}
