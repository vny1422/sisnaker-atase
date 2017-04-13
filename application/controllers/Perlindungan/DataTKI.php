<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datatki extends MY_Controller {

  private $data;

  public function __construct()
  {
    parent::__construct();

    $this->load_sidebar();
    $this->data['listdp'] = $this->listdp;
    $this->data['usedpg'] = $this->usedpg;
    $this->data['usedmpg'] = $this->usedmpg;
    $this->data['sidebar'] = 'SAdmin/Sidebar';
    $this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
    $this->data['namakantor'] = $this->namakantor->nama;
    $this->load->model('Perlindungan/TKI_model');
  }

  public function index()
  {

  }

  function query_detail(){
		$idr = $this->input->post('idref');
		$this->search_async_endorsement($idr);
	}
  function search_async_endorsement($idtki=null){
		////////////////////////////////////////////////////////////
		///  ENDORSEMENT
		////////////////////////////////////////////////////////////
			$tmp = $this->TKI_model->get_detail_endorse($idtki);
			if($tmp->num_rows()==0) $tmp=null;
			else $tmp = $tmp->row_array(0);
		// else{
		// 	$tmp = $this->get_endorsment_data($paspor);
		// }

		$result = array();
		$file = array();
		$final = array();

		if($tmp != 'null'){
			///form data
			$result['Nama'] 			= $tmp['namatki'];
			$result['Jenis Kelamin'] 	= $tmp['jk'];
			$result['Paspor'] 			= $tmp['paspor'];
			$result['Alamat'] 			= $tmp['alamatindonesia'];
			// $result['TTL'] 				= $tmp['tktmptlahir'].",".$tmp['tktgllahir'];
			// $result['Ahli Waris'] 		= $tmp['tkahliwaris']." (".$tmp['tkhub'].")";
			// $result['Kontak Ahli Waris'] = $tmp['tktelp'];
			$result['Jenis Pekerjaan']	= $tmp['pekerjaan'];
			// $result['Agency'] 			= $tmp['agnama']." ".$tmp['agnamacn'];
			// $result['Penanggung Jawab']= $tmp['agpngjwb'].' '.$tmp['agpngjwbcn'];
			// $result['Ijin CLA']			= $tmp['agnoijincla'];
			// $result['Alamat']			= $tmp['agalmtkantor']." ".$tmp['agalmtkantorcn'];
			// $result['Telp/Fax Agency']	= $tmp['agtelp'].' / '.$tmp['agfax'];
			// $result['Nama Majikan']	= $tmp['mjnama']." ".$tmp['mjnamacn'];
			// $result['Alamat Majikan']	= $tmp['mjalmt']." ".$tmp['mjalmtcn'];
			// $result['Telp. Majikan']	= $tmp['mjtelp'];
			$result['PPTKIS']			= $tmp['pptkis'];
			// $result['Penanggung Jawab']	= $tmp['pppngjwb'];
			// $result['Alamat PPTKIS']	= $tmp['ppalmtkantor'];
			// $result['Telp/Fax PPTKIS']	= $tmp['pptelp'].'/'.$tmp['ppfax'];
			// $result['Ijin PPTKIS']		= $tmp['ppijin'];


			// // file data
			// $jp_arr = array(1 => 'nelayan.php', 2 => 'pekerja.php',
			// 	    3 => 'perawatpanti.php', 4 => 'perawatsakit.php',
			// 	    5 => 'enata.php', 6 => 'konstruksi.php'
		  //         );
			// $jp = $jp_arr[$tmp['jpid']];
      //
			// $file['Surat Permintaan'] 	= "http://endorsement.kdei-taipei.org/doc/permintaan.php?id=".$tmp['ejtoken'];
			// $file['Surat Kuasa']		= "http://endorsement.kdei-taipei.org/doc/kuasa.php?id=".$tmp['ejtoken'];
			// $file['Perjanjian Kerja']	= "http://endorsement.kdei-taipei.org/doc/".$jp."?id=".$tmp['ejtoken']."&x=".base64_encode($tmp['tkbc']);
      //
			// merge data
			$final = array($result,$file);
		}
		echo json_encode($final);
	}


  public function search()
  {
    if ($this->session->userdata('role') > 3)
    {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }
    
    $param = $this->input->post();
    if($param==NULL){
			$this->data['hasil'] = null;
      $this->data['title'] = 'Pencarian Data TKI';
      $this->data['subtitle'] = 'Pencarian Data TKI';
      $this->load->view('templates/headerperlindungan', $this->data);
      $this->load->view('Perlindungan/PencarianDataTKI_view', $this->data);
      $this->load->view('templates/footerperlindungan');
		}
    else {
      $result = array();
			$paramx = $this->split_context_endorse($param);
			$result[0] = $this->TKI_model->get_all_endorsment($paramx);
			$result[2] = $paramx;
			///
			$paramx = $this->split_context_hiring($param);
			$result[1] = null;
			$result[3] = $paramx;
			///
			if($result[0]==null) $result[0]=[];
			if($result[1]==null) $result[1]=[];
			$this->data['hasil'] = $result;
      $this->data['title'] = 'Pencarian Data TKI';
      $this->data['subtitle'] = 'Pencarian Data TKI';
      $this->load->view('templates/headerperlindungan', $this->data);
      $this->load->view('Perlindungan/PencarianDataTKI_view', $this->data);
      $this->load->view('templates/footerperlindungan');
     }
  }

  function split_context_endorse($src){
  $string = "";
  /////
  if($src['nama'] != ""){
    if($string != "") $string = $string."AND ";
    $tmp = explode(" ",$src['nama']);
    for($k=0;$k<sizeof($tmp);$k++){
      if($k>0) $string=$string."AND ";
      $string = $string."t.namatki LIKE '%".$tmp[$k]."%' ";
    }
  }
  /////
  if($src['paspor'] != ""){
    if($string != "") $string = $string."AND ";
    $tmp = explode(" ",$src['paspor']);
    for($k=0;$k<sizeof($tmp);$k++){
      if($k>0) $string=$string."AND ";
      $string = $string."t.paspor LIKE '%".$tmp[$k]."%' ";
    }
  }
  /////
  if($src['asal'] != ""){
    if($string != "") $string = $string."AND ";
    $tmp = explode(" ",$src['asal']);
    for($k=0;$k<sizeof($tmp);$k++){
      if($k>0) $string=$string."AND ";
      $string = $string."t.alamatindonesia LIKE '%".$tmp[$k]."%' ";
    }
  }
  /////
  if($src['kerja'] != ""){
    if($string != "") $string = $string."AND ";
    $tmp = explode(" ",$src['kerja']);
    for($k=0;$k<sizeof($tmp);$k++){
      if($k>0) $string=$string."AND ";
      $string = $string."j.namajenispekerjaan LIKE '%".$tmp[$k]."%' ";
    }
  }
  /////
  if($src['wilayahkerja'] != ""){
    if($string != "") $string = $string."AND ";
    $tmp = explode(" ",$src['wilayahkerja']);
    for($k=0;$k<sizeof($tmp);$k++){
      if($k>0) $string=$string."AND ";
      $string = $string."(w.name LIKE '%".$tmp[$k]."%' OR e.mjalmtcn LIKE '%".$tmp[$k]."%')";
    }
  }
  $string = str_replace('$','%',$string);
  $string = str_replace('%%','',$string);

  return $string;
}

function split_context_hiring($src){
  $string = "";
  /////
  if($src['nama'] != ""){
    if($string != "") $string = $string."AND ";
    $tmp = explode(" ",$src['nama']);
    for($k=0;$k<sizeof($tmp);$k++){
      if($k>0) $string=$string."AND ";
      $string = $string."f.namatki LIKE '%".$tmp[$k]."%' ";
    }
  }
  /////
  if($src['paspor'] != ""){
    if($string != "") $string = $string."AND ";
    $tmp = explode(" ",$src['paspor']);
    for($k=0;$k<sizeof($tmp);$k++){
      if($k>0) $string=$string."AND ";
      $string = $string."f.nomorpaspor LIKE '%".$tmp[$k]."%' ";
    }
  }
  /////
  if($src['asal'] != ""){
    if($string != "") $string = $string."AND ";
    $tmp = explode(" ",$src['asal']);
    for($k=0;$k<sizeof($tmp);$k++){
      if($k>0) $string=$string."AND ";
      $string = $string."f.alamatindonesia LIKE '%".$tmp[$k]."%' ";
    }
  }
  if($src['wilayahkerja'] != ""){
    if($string != "") $string = $string."AND ";
    $tmp = explode(" ",$src['wilayahkerja']);
    for($k=0;$k<sizeof($tmp);$k++){
      if($k>0) $string=$string."AND ";
      $string = $string."f.alamattempatbekerja LIKE '%".$tmp[$k]."%' ";
    }
  }
  $string = str_replace('$','%',$string);
  $string = str_replace('%%','',$string);

  return $string;
}

}
