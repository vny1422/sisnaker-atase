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
    $this->load->model('Endorsement/PKP_model');
    $this->load->model('Perlindungan/Agency_model');
    $this->load->model('Perlindungan/Pptkis_model');
    $this->load->model('SAdmin/Input_model');
    $this->load->model('SAdmin/Jobtype_model');


    $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file', 'key_prefix' => 'penempatan_'));

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

  public function index()
  {
    $this->data['month'] = date('m');

    $this->data['kantors'] = $this->Kantor_model->list_all_kantor_institution($this->session->userdata('institution'));

    /// list tahun
    $this->data['tahunpenempatan'] = $this->Endorsement_model->get_all_year();

    $this->data['title'] = 'DASHBOARD';
    $this->data['subtitle'] = 'ENDORSEMENT';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/Endorsement_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function indexold()
  {
    $this->data['month'] = date('m');

    /// list tahun
    $this->data['tahunpenempatan'] = $this->Endorsement_model->get_all_year();

    $this->data['title'] = 'DASHBOARD';
    $this->data['subtitle'] = 'ENDORSEMENT';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/EndorsementOld_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function dashboard()
  {
    $this->data['month'] = date('m');

    /// list tahun
    $this->data['tahunpenempatan'] = $this->Endorsement_model->get_all_year();
    $this->data['title'] = 'DASHBOARD';
    $this->data['subtitle'] = 'ENDORSEMENT';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/Dashboard_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function listagensi()
  {
    $this->data['title'] = 'View Agensi';
    $this->data['subtitle'] = 'View Agensi';
    $this->load->view('templates/headerperlindungan', $this->data);
    $this->load->view('Endorsement/ListAgency_view', $this->data);
    $this->load->view('templates/footerperlindungan');
  }

  public function humao()
  {
    if ($this->session->userdata('role') == 8 || $this->session->userdata('role') == 9)
    {
      $this->form_validation->set_rules('agensi', 'Agensi', 'required|trim');
      $this->form_validation->set_rules('pptkis', 'PPTKIS', 'required|trim');
      $this->form_validation->set_rules('start', 'Tanggal Mulai', 'required|trim');
      $this->form_validation->set_rules('end', 'Tanggal Selesai', 'required|trim');
      $this->form_validation->set_rules('jenispekerjaan[]', 'Jenis Pekerjaan', 'required|trim');
      $this->form_validation->set_rules('laki[]', 'Jumlah Kuota Laki-laki', 'required|trim');
      $this->form_validation->set_rules('perempuan[]', 'Jumlah Kuota Perempuan', 'required|trim');
      $this->form_validation->set_rules('campuran[]', 'Jumlah Kuota Campuran', 'required|trim');

      if ($this->form_validation->run() === FALSE)
      {
        if($this->session->userdata('role') == 8){
          $this->data['dataagensi'] = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
        }

        $this->data['listagensi'] = $this->Agency_model->get_agency_from_institution($this->session->userdata('institution'), false, true);
        $this->data['listpptkis'] = $this->Pptkis_model->get_pptkis_non_cekal();
        $this->data['cekalpptkis'] = $this->Pptkis_model->get_pptkis(true);
        $this->data['listjenispekerjaan'] = $this->Jobtype_model->list_all_jobtype_by_institution($this->session->userdata('institution'));
        $this->data['title'] = 'Create Recruitment Agreement (HUMAO)';
        // $this->load->view('templates/header', $this->data);
        $this->load->view('templates/headerendorsement', $this->data);
        $this->load->view('Endorsement/CreateHumao_view', $this->data);
        //$this->load->view('templates/footer');
        $this->load->view('templates/footerendorsement');
      }
      else
      {
        $returnPKP = $this->PKP_model->post_new_humao();
        if ($returnPKP[0]) {
          $this->session->set_flashdata('information', 'Humao successfully created');
        }
        else {
          $this->session->set_flashdata('information', 'Humao failed to created');
        }
        redirect('endorsement/humao');
      }
    }
    else {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }

  }

  public function viewhumao()
  {
    if ($this->session->userdata('role') == 8 || $this->session->userdata('role') == 9){

      if($this->session->userdata('role') == 8){
        $this->data['dataagensi'] = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
        $this->data['datapptkis'] = $this->Pptkis_model->get_pptkis_by_agensi_in_pkp($this->data['dataagensi']->agid);
      }

      if ($this->session->flashdata('data') != '')
      {
        $this->data = $this->session->flashdata('data');
      }

      $this->data['listagensi'] = $this->Agency_model->get_agency_from_institution($this->session->userdata('institution'), false, true);
      $this->data['listpptkis'] = $this->Pptkis_model->get_all_pptkis();
      $this->data['title'] = 'View Recruitment Agreement (PKP)';
      $this->data['subtitle'] = 'View Recruitment Agreement (PKP)';
      $this->data['subtitle2'] = 'View Recruitment Agreement (PKP)';
      $this->load->view('templates/headerendorsement', $this->data);
      $this->load->view('Endorsement/ViewHumao_view', $this->data);
      $this->load->view('templates/footerendorsement');
    }
    else {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }
  }

  public function downloadhumao()
  {
    if ($this->session->userdata('role') == 8 || $this->session->userdata('role') == 9){
      //CONTROLLER FOR DOWNLOAD PKP/HUMAO TAIWAN

    }
    else {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }
  }



  public function get_info_year_dashboard(){
    $year = $this->input->post('y');
    $month = $this->input->post('m');
    $kantor = $this->input->post('kantor');
    $institution = $this->session->userdata('institution');

    if (!$all = $this->cache->get($kantor.'_'.$year.'_'.$month)) {
      $all = array();

      $year_jk = $this->Endorsement_model->get_jk_this_year($year,$institution,$kantor);
      $total_year_jk = 0;
      foreach ($year_jk as $jk) {
        $total_year_jk += $jk->total;
      }

      $month_jk = $this->Endorsement_model->get_jk_this_month($year,$month,$institution,$kantor);
      $total_month_jk = 0;
      foreach ($month_jk as $jk) {
        $total_month_jk += $jk->total;
      }

      $year_sektor = $this->Endorsement_model->get_sektor_this_year($year,$institution,$kantor);
      $total_year_sektor = 0;
      foreach ($year_sektor as $sektor) {
        $total_year_sektor += $sektor->total;
      }

      $month_sektor = $this->Endorsement_model->get_sektor_this_month($year,$month,$institution,$kantor);
      $total_month_sektor = 0;
      foreach ($month_sektor as $sektor) {
        $total_month_sektor += $sektor->total;
      }

      $iterm = range(1,12);
      $nm_month = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
      5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
      9 => 'Sep', 10 => 'Okt', 11 => 'Nop', 12=> 'Des'
    );
    $nm_month_complete = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
    5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
    9 => 'September', 10 => 'October', 11 => 'November', 12=> 'December'
  );

  $list_jp_temp_names = array();
  $list_jp_months = array();

  $list_jp = $this->Endorsement_model->get_list_jp_this_year($year,$institution,$kantor);
  foreach ($list_jp as $jp) {
    array_push($list_jp_temp_names, $jp->namajenispekerjaan);
    $list_jp_months[$jp->namajenispekerjaan][$jp->month] = $jp->count;
  }

  $list_jp_names = array();
  $list_jp_temp_names = array_unique($list_jp_temp_names);
  foreach ($list_jp_temp_names as $jp_name) {
    array_push($list_jp_names, $jp_name);
  }

  $list_jp = array();
  for($i = 0; $i < count($iterm); $i++){
    $temp_1 = array('bulan' => $nm_month[$iterm[$i]]);
    $tot = 0;
    foreach ($list_jp_names as $jp_name) {
      if (array_key_exists($nm_month_complete[$iterm[$i]], $list_jp_months[$jp_name])) {
        $temp_1[$jp_name] = (int)$list_jp_months[$jp_name][$nm_month_complete[$iterm[$i]]];
      } else {
        $temp_1[$jp_name] = 0;
      }
      $tot += $temp_1[$jp_name];
    }
    $temp_1['total'] = $tot;
    array_push($list_jp, $temp_1);
  }

  array_push($all,$total_year_jk);
  array_push($all,$year_jk);
  array_push($all,$total_month_jk);
  array_push($all,$month_jk);
  array_push($all,$total_year_sektor);
  array_push($all,$year_sektor);
  array_push($all,$total_month_sektor);
  array_push($all,$month_sektor);
  array_push($all,$list_jp_names);
  array_push($all,$list_jp);

  $this->cache->save($kantor.'_'.$year.'_'.$month, $all, 300);
}

echo json_encode($all);
}


public function get_info_year_dashboard_agensi(){
  $year = $this->input->post('y');
  $month = $this->input->post('m');
  $all = array();
  $agid = $this->Endorsement_model->get_agid();

  $year_jk = $this->Endorsement_model->get_jk_this_year_agensi($year, $agid[0]->agid);
  $total_year_jk = 0;
  foreach ($year_jk as $jk) {
    $total_year_jk += $jk->total;
  }

  $month_jk = $this->Endorsement_model->get_jk_this_month_agensi($year,$month, $agid[0]->agid);
  $total_month_jk = 0;
  foreach ($month_jk as $jk) {
    $total_month_jk += $jk->total;
  }

  $year_sektor = $this->Endorsement_model->get_sektor_this_year_agensi($year, $agid[0]->agid);
  $total_year_sektor = 0;
  foreach ($year_sektor as $sektor) {
    $total_year_sektor += $sektor->total;
  }

  $month_sektor = $this->Endorsement_model->get_sektor_this_month_agensi($year,$month, $agid[0]->agid);
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
$listjpdb = $this->Endorsement_model->get_list_jp_this_year_agensi($year, $agid[0]->agid);
foreach ($listjpdb as $jp) {
  array_push($listjp, $jp->namajenispekerjaan);
}

$jppermonth = [];
for($i=0;$i<count($iterm);$i++){
  $temp_1 = array('bulan' => $nm_month[$iterm[$i]]);
  $tot = 0;
  foreach($listjp as $jp){
    $temp_1[$jp] = $this->Endorsement_model->count_jp_this_month_agensi($year,$iterm[$i],$jp,$agid[0]->agid);
    $tot += $temp_1[$jp];
  }
  $temp_1['total'] = $tot;
  array_push($jppermonth, $temp_1);
}

$listpptkis = [];
$listppkode = [];
$listpptkisdb = $this->Endorsement_model->get_list_pptkis_this_year_agensi($year, $agid[0]->agid);
foreach ($listpptkisdb as $pptkis) {
  array_push($listppkode, $pptkis->ppkode);
  array_push($listpptkis, $pptkis->ppnama);
}

$pptkispermonth = [];
for($i=0;$i<count($iterm);$i++){
  $temp_1 = array('bulan' => $nm_month[$iterm[$i]]);
  $tot = 0;
  for ($x = 0; $x < sizeof($listppkode); $x++) {
    $temp_1[$listpptkis[$x]] = $this->Endorsement_model->count_pptkis_this_month_agensi($year,$iterm[$i],$listppkode[$x],$agid[0]->agid);
    $tot += $temp_1[$listpptkis[$x]];
  }
  $temp_1['total'] = $tot;
  array_push($pptkispermonth, $temp_1);
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
array_push($all,$listpptkis);
array_push($all,$listppkode);
array_push($all,$pptkispermonth);

echo json_encode($all);
}

public function updateagency()
{
  if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2 || $this->session->userdata('role') == 8)
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

      $data_agency = array(
        'agnama' => $this->input->post('name'),
        'agnamaoth' => $this->input->post('nameother'),
        'agnoijincla' => $this->input->post('noijin'),
        'agalmtkantor' => $this->input->post('address'),
        'agalmtkantoroth' => $this->input->post('addressother'),
        'username' => $this->input->post('user'),
        'idinstitution' => $this->input->post('institution'),
        'agpngjwb' => $this->input->post('penanggung'),
        'agpngjwboth' => $this->input->post('penanggungother'),
        'agtelp' => $this->input->post('notelp'),
        'agfax' => $this->input->post('nofax')
      );

      //var_dump($data_agency);
      // var_dump("cek");
      // var_dump($cek);
      // var_dump("dapet ngga");
      // var_dump($this->Agency_model->get_id_induk_agensi($this->data['values']->agid));



      $flag_success_push_bnp = FALSE;
      if($cek != false){

        if(!empty($this->Agency_model->get_id_induk_agensi($this->data['values']->agid))){
          $agc_id = $this->Agency_model->get_id_induk_agensi($this->data['values']->agid);
        }
        else {
          $agc_id = ($this->data['values']->agid);
        }

        $country_id = $this->Agency_model->get_idcountry_by_idinstitution($this->session->userdata('institution'));
        // var_dump($country_id[0]->tcode);

        //PUSH UPDATE AGENCY TO BNP
        $url = "http://ws-sisnaker.kemnaker.go.id/kemenaker/bnp/agency/update/";
        $param["detail"]["agc_id"] 	        = $agc_id; ### isi detailnya disini
        $param["detail"]["agc_source_id"] 	= $this->data['values']->agid; ### isi detailnya disini
        $param["detail"]["agc_name"] 	      = $this->input->post('name'); ### isi detailnya disini
        $param["detail"]["agc_director"] 	  = $this->input->post('penanggung'); ### isi detailnya disini
        $param["detail"]["agc_address"] 	  = $this->input->post('address'); ### isi detailnya disini
        $param["detail"]["agc_phone"] 	   = $this->input->post('notelp'); ### isi detailnya disini
        $param["detail"]["agc_fax"] 	     = $this->input->post('nofax'); ### isi detailnya disini
        $param["detail"]["agc_country_id"] 	= $country_id[0]->tcode; ### isi detailnya disini
        $param["detail"]["agc_email"] 	   = $this->input->post('email'); ### isi detailnya disini
        $param["detail"]["agc_iicense"] 	 = $this->input->post('noijin'); ### isi detailnya disini

        $result = $this->send_request($url, $param);
      }

      if(!empty($result->response_code)){
        $flag_success_push_bnp = TRUE;
      }

      if($flag_success_push_bnp)
      {
        $this->Endorsement_model->catat_logagensi($this->data['values']->agid);
        $this->session->set_flashdata('information', 'Congratulation, Your Profile Updated!');
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
  else
  {
    show_error("Access is forbidden.",403,"403 Forbidden");
  }
}



public function checkBarcode()
{
  if (!($this->session->userdata('role') <= 2 || $this->session->userdata('role') == 5 || $this->session->userdata('role') == 6 || $this->session->userdata('role') == 7 || $this->session->userdata('role') == 9))
  {
    show_error("Access is forbidden.",403,"403 Forbidden");
  }

  $this->data['title'] = 'Endorsement';
  $this->data['subtitle'] = 'Check Barcode';
  $this->data['subtitle2'] = 'Check Barcode';
  $this->load->view('templates/headerendorsement', $this->data);
  $this->load->view('Endorsement/CheckBarcode_view', $this->data);
  $this->load->view('templates/footerendorsement');
}

public function cetakStiker()
{
  if (!($this->session->userdata('role') <= 2 || $this->session->userdata('role') == 5 || $this->session->userdata('role') == 6 || $this->session->userdata('role') == 7 || $this->session->userdata('role') == 9))
  {
    show_error("Access is forbidden.",403,"403 Forbidden");
  }

  $this->data['title'] = 'Endorsement';
  $this->data['subtitle'] = 'Cetak Stiker';
  $this->data['subtitle2'] = 'Cetak Stiker';
  $this->load->view('templates/headerendorsement', $this->data);
  $this->load->view('Endorsement/PrintStiker_view', $this->data);
  $this->load->view('templates/footerendorsement');
}

public function cetakStikerEJ()
{
  if (!($this->session->userdata('role') <= 2 || $this->session->userdata('role') == 5 || $this->session->userdata('role') == 6 || $this->session->userdata('role') == 7 || $this->session->userdata('role') == 9))
  {
    show_error("Access is forbidden.",403,"403 Forbidden");
  }

  $this->data['title'] = 'Endorsement';
  $this->data['subtitle'] = 'Cetak Stiker';
  $this->data['subtitle2'] = 'Cetak Stiker Job Order';
  $this->load->view('templates/headerendorsement', $this->data);
  $this->load->view('Endorsement/PrintStikerEJ_view', $this->data);
  $this->load->view('templates/footerendorsement');
}

public function getKukodeByBC()
{
  $this->load->model('Endorsement/Kuitansi_model');
  $res = $this->Kuitansi_model->getKuitansiByBC($this->input->post('barcode', true));
  echo json_encode($res);
}


public function createJO()
{
  $agensi = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
  if(!empty($agensi)) {
    $this->data['listconnpp'] = $this->Endorsement_model->get_connected_pptkis($agensi->agid);
    $this->data['listcekalpp'] = $this->Endorsement_model->get_connected_pptkis($agensi->agid, true);
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

public function createJOv2()
{
  $this->data['listconnag'] =  $this->Agency_model->get_agency_from_institution($this->session->userdata('institution'),false,true);
  $this->data['employer'] = $this->Input_model->get_input_dataworker($this->session->userdata('institution'));
  $this->data['joborder'] = $this->Input_model->get_input_joborder($this->session->userdata('institution'));
  $this->data['title'] = 'Endorsement';
  $this->data['subtitle'] = 'Create JO Packet';
  $this->data['subtitle2'] = 'Worker Data';
  $this->load->view('templates/headerendorsement', $this->data);
  $this->load->view('Endorsement/CreateJOv2_view', $this->data);
  $this->load->view('templates/footerendorsement');
}

public function viewJO()
{
  if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2 || $this->session->userdata('role') == 8 || $this->session->userdata('role') == 7)
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
          $row->ejtglendorsement,
          $row->idjenispekerjaan,
          $row->ppkode
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
  else
  {
    show_error("Access is forbidden.",403,"403 Forbidden");
  }
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

function reviseTKI()
{
  $tki = json_decode($this->input->post('datatki', TRUE), TRUE);
  $ejid = $this->input->post('ejid', TRUE);
  $jpid = $this->input->post('jpid', TRUE);
  $idTkiLama = $this->input->post('idTkiLama', TRUE);
  $idTkiPengganti = '';

  $tmp['success'] = true;
  $tmp['message'] = "Updated!";

  $keluar = DateTime::createFromFormat('d-m-Y', $tki['TKI_KELUARBLKDATE']);
  $keluarFormatted = $keluar->format('Y-m-d');
  $lahir = DateTime::createFromFormat('d-m-Y', $tki['TKI_TKIDOB']);
  $lahirFormatted = $lahir->format('Y-m-d');
  $datatki["ejid"] = $ejid;
  $datatki["tknama"] = $tki['TKI_TKINAME'];
  $datatki["tkalmtid"] = $tki['TKI_TKIADDRESS'];
  $datatki["tkpaspor"] = $tki['TKI_PASPORNO'];
  $datatki["tktglkeluar"] = $keluarFormatted;
  $datatki["tktmptkeluar"] = $tki['tkitmptkeluar'];
  $datatki["tktgllahir"] = $lahirFormatted;
  $datatki["tktmptlahir"] = $tki['TKI_TKIPOBDESC'];
  $datatki["tkjk"] = $tki['TKI_TKIGENDER'];
  $datatki["tkstatkwn"] = $tki['tkistatkwn'];
  $datatki["tkjmlanaktanggungan"] = $tki['tkijmlanaktanggungan'];
  $datatki["tkahliwaris"] = $tki['tkiahliwaris'];
  $datatki["tknama2"] = $tki['tkinama2'];
  $datatki["tkalmt2"] = $tki['tkialmt2'];
  $datatki["tktelp"] = $tki['tkitelp'];
  $datatki["tkhub"] = $tki['tkihub'];
  $datatki["tkstat"] = 0;
  $datatki["tkiid"] = $tki['TKI_TKIID'];
  $url = $this->Endorsement_model->geturlpekerjaan($jpid);
  $datatki["tkidownloadurl"] = $url->curtkidownloadurl;
  $datatki["md5ej"] = md5($ejid);

  $query = $this->Endorsement_model->getTKI_FromPassport($tki['TKI_PASPORNO']);

  if (!empty($query)) {
    if ($query[0]['tkstat'] == '1' || $query[0]['tktglendorsement']) {
      $tmp['success'] = false;
      $tmp['message'] = "Worker already endorsed";
    } else {
      $idTkiPengganti = $query[0]['tkid'];
      $this->Endorsement_model->update_tki_byid($datatki, $idTkiPengganti);
    }
  } else {
    $idTkiPengganti = $this->Endorsement_model->insert_tki($datatki);
  }

  if (!empty($idTkiPengganti)) {
    $this->Endorsement_model->reviseTKI($idTkiLama, $idTkiPengganti);
  }

  echo json_encode($tmp);
}

function getJodetail()
{
  if($this->input->post('agid', true))
  {
    $ppkode = $this->input->post('ppkode', TRUE);
    $listjob = $this->Endorsement_model->get_jodetail($ppkode,$this->input->post('agid'), true);
  }
  else {
    $agensi = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
    $ppkode = $this->input->post('ppkode', TRUE);
    $listjob = $this->Endorsement_model->get_jodetail($ppkode,$agensi->agid);
  }
  $i=0;
  foreach ($listjob as $row):
    $sisa = $this->getSisa($row->jobdid, $row->idjenispekerjaan);
    $rows[$i] = array(
      $row->jobdid,
      $row->idjenispekerjaan,
      $row->namajenispekerjaan,
      $sisa[0],
      $sisa[1],
      $sisa[2],
      $row->gaji,
      $row->jobid
    );
    $i++;
  endforeach;
  echo json_encode($rows);
}

function getConnPPTKIS()
{
  $agid = $this->input->post('agid', TRUE);
  $rows = $this->Endorsement_model->get_connected_pptkis($agid);
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
  if(isset($agensi)){
    $r->my_agid = $agensi->agid;
  } else {
    $r->my_agid = '';
  }
  $r->tki_agid = 0;
  $r->jpid = $jpid;

  if ( $result[0] == 1 )
  {
    $result = XMLRPC_parse($result[1]);
    if (isset($result['ws_response']['reqString']['record'])) {
      if (array_key_exists(0, $result['ws_response']['reqString']['record'])) {
        $records = $result['ws_response']['reqString']['record'][0];
      } else {
        $records = $result['ws_response']['reqString']['record'];
      }

      $r->status = 1;
      if ($records["TKI_TKIID"] != NULL) {$r->data = $records;}

      $agid_induk = $this->Endorsement_model->check_agensi_induk($r->data["TKI_PJTKAID"]);
      if (isset($agid_induk)) {
        $r->tki_agid = $agid_induk->agid_induk;
      } else {
        $r->tki_agid = $r->data["TKI_PJTKAID"];
      }

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

function insert_agency()
{
  require_once("ws_kdei/xmlrpc-func.php");
  $agrid = $this->input->post('agrid', TRUE);
  $idinst = $this->input->post('idinst', TRUE);
  $agensi = $this->Agency_model->get_agency_registration($agrid);
  $status = "D";
  $now = date('Y-m-d H:i:s');

  if (isset($agensi)) {
    $xmlrpc_server_host = 'siskotkln.bnp2tki.go.id';
    $xml_rpc_server_path = '/xmlrpc/siskotkln_ws/index.php';

    define('XMLRPC_DEBUG', 1);

    $USER_ID = "ws_twn";
    $USER_PASS = "ws_twn";
    $SERVICE_NAME = "exec.ins_agency";
    $SERVICE_PARAM = $agensi->agrnama ."|" . $agensi->agralmtkantor ."|" . $agensi->agrtelp ."|" .$agensi->agrfax ."|" . $agensi->agrpngjwb ."|" . "|" . $agensi->agrnoijincla;

    $inputArray = array(
      "USER_ID" => $USER_ID,
      "USER_PASS" => $USER_PASS,
      "SERVICE_NAME" => $SERVICE_NAME,
      "SERVICE_PARAM" => $SERVICE_PARAM
    );

    $result = XMLRPC_request($xmlrpc_server_host,  $xml_rpc_server_path ,"siskotkln_ws" , array( XMLRPC_prepare( $inputArray ) ) );
    if ( $result[0] == 1 ) {
      $result = XMLRPC_parse($result[1]);
      $agid = trim($result['ws_response']['reqString']);
      if ($agid !== "FAILED") {
        $this->Agency_model->insert_new_agency($agensi, $agid, $idinst);
        $status = "A";
        $this->Agency_model->update_agency_registrasi_agid($agrid, $now, $status, $agid);
        echo json_encode(array("msg" => "Registration successful.", "status" => 1, "agid" => $agid));
      }
      else {
        $this->Agency_model->update_agency_registrasi_agid($agrid, $now, $status);
        echo json_encode(array("msg" => "Registration failed. Invalid Data.", "status" => 0));
      }
    }
    else {
      echo json_encode(array("msg" => "Registration failed. No response from server.", "status" => 0));
    }
  } else {
    echo json_encode(array("msg" => "Registration failed. Invalid ID.", "status" => 0));
  }
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

function ws_push_pk($ej, $tki, $ejid)
{
  $url = "http://ws-sisnaker.kemnaker.go.id/kemenaker/bnp/pk/endorsement/";
  $pk_duration = $data["jomkthn"];
  $jp_bnp2tki = $this->Jobtype_model->get_jobtype($data["idjenispekerjaan"]);
  $dateexpire = strtotime("+$pk_duration year");
  $param["detail"]["tki_id"] 	= $tki->tki_id;;
  $param["detail"]["tki_majikanid"] 	= $data["mjktp"];
  $param["detail"]["tki_majikanname"] 	= $data["mjnama"];
  $param["detail"]["tki_majikanaddress"] 	= $data["mjalmt"];
  $param["detail"]["tki_pkno"] 	= $ejid;
  $param["detail"]["tki_pkdate"] 	= date('Y-m-d');;
  $param["detail"]["tki_pkexpire"] 	= data('Y-m-d', $dateexpire);
  $param["detail"]["tki_negaraid"] 	= '001.002.207';
  $param["detail"]["tki_pptkis"] 	= $data["ppkode"];
  $param["detail"]["tki_agency"] 	= $data["agid"];
  $param["detail"]["tki_pasporno"] 	= $tki->tki_pasporno;;
  $param["detail"]["tki_paspordate"] 	= date('Y-m-d');
  $param["detail"]["tki_jabatan"] 	= $jp_bnp2tki->idpekerjaan_bnp2tki;
  $param["detail"]["tki_perwakilan"] 	= 'KBRI205';
  $param["detail"]["tki_visano"] 	= $ejid;
  $param["detail"]["tki_visadate"] 	= date('Y-m-d');
  $result = $this->send_request($url, $param);
}

public function insertEJ()
{
  $postdata = $this->input->post('postdata', TRUE);
  $posttki = $this->input->post('posttki', TRUE);
  $jo = $this->input->post('jo', TRUE);
  $job = $this->input->post('job', TRUE);
  $laki = $this->input->post('laki', TRUE);
  $perempuan = $this->input->post('perempuan', TRUE);
  $campuran = $this->input->post('campuran', TRUE);
  $postdata = json_decode($postdata);
  $posttki = json_decode($posttki);
  $jo = json_decode($jo);
  $job = json_decode($job);
  $laki = json_decode($laki);
  $perempuan = json_decode($perempuan);
  $campuran = json_decode($campuran);
  $data = array();
  foreach(get_object_vars($postdata) as $prop => $val)
  {
    $data["$prop"] = $val;
  }
  $date = date('Y-m-d');
  $data['ejdatefilled'] = $date;
  $url = $this->Endorsement_model->geturlpekerjaan($data["idjenispekerjaan"]);
  $data["jodownloadurl"] = $url->curjodownloadurl;
  $splittgl = explode("/", $data["joclatgl"]);
  $data["joclatgl"] = $splittgl[0]."-".$splittgl[1]."-".$splittgl[2];
  if(!(array_key_exists('agid', $data)))
  {
    $data["agid"] = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'))->agid;
  }
  $data["idinstitution"] = $this->session->userdata('institution');
  $data["idkantor"] = $this->session->userdata('kantor');
  $ejid = $this->Endorsement_model->insert_ej($data);
  $this->Endorsement_model->update_kuota($jo,$job,$laki,$perempuan,$campuran);
  $datatki = array();
  foreach($posttki as $tki)
  {
    $keluar = DateTime::createFromFormat('d-m-Y', $tki->tki_pasporexpire);
    $keluarFormatted = $keluar->format('Y-m-d');
    $lahir = DateTime::createFromFormat('d-m-Y', $tki->tki_dob);
    $lahirFormatted = $lahir->format('Y-m-d');
    $datatki["ejid"] = $ejid;
    $datatki["tknama"] = $tki->tki_name;
    $datatki["tkalmtid"] = $tki->tki_alamat;
    $datatki["tkpaspor"] = $tki->tki_pasporno;
    $datatki["tktglkeluar"] = $keluarFormatted;
    $datatki["tktmptkeluar"] = $tki->tkitmptkeluar;
    $datatki["tktgllahir"] = $lahirFormatted;
    $datatki["tktmptlahir"] = $tki->tki_pob;
    $datatki["tkjk"] = $tki->tki_gender;
    $datatki["tkstatkwn"] = $tki->tkistatkwn;
    $datatki["tkjmlanaktanggungan"] = $tki->tkijmlanaktanggungan;
    $datatki["tkahliwaris"] = $tki->tkiahliwaris;
    $datatki["tknama2"] = $tki->tkinama2;
    $datatki["tkalmt2"] = $tki->tkialmt2;
    $datatki["tktelp"] = $tki->tkitelp;
    $datatki["tkhub"] = $tki->tkihub;
    $datatki["tkstat"] = 0;
    $datatki["tkiid"] = $tki->tki_id;
    $datatki["tkidownloadurl"] = $url->curtkidownloadurl;
    $datatki["md5ej"] = md5($ejid);
    $check = $this->Endorsement_model->find_tkipaspor($tki->tki_pasporno);
    if($check > 0)
    {
      $this->Endorsement_model->update_TKI($datatki,$tki->tki_pasporno);
    }
    else {
      $this->Endorsement_model->insert_tki($datatki);
    }

    $this->ws_push_pk($data, $tki, $ejid);
  }

  echo json_encode(md5($ejid));
}

public function printDokumen($md5ej)
{
  $this->data["md5ej"] = $md5ej;
  $this->data["jourl"] = $this->Endorsement_model->get_url_byej($md5ej);
  $this->data["listtki"] = $this->Endorsement_model->get_tki_byej($md5ej);
  $this->data['title'] = 'Endorsement';
  $this->data['subtitle'] = 'Print Dokumen';
  $this->data['subtitle2'] = 'Entry JO';
  $this->load->view('templates/headerendorsement', $this->data);
  $this->load->view('Endorsement/PrintDokumen_view', $this->data);
  $this->load->view('templates/footerendorsement');
}

public function printDokumenV2($md5ej)
{
  $this->data["md5ej"] = $md5ej;
  $this->data["jourl"] = $this->Endorsement_model->get_url_byej($md5ej);
  $this->data["listtki"] = $this->Endorsement_model->get_tki_byej($md5ej);
  $this->data['title'] = 'Endorsement';
  $this->data['subtitle'] = 'Print Dokumen';
  $this->data['subtitle2'] = 'Entry JO';
  $this->load->view('templates/headerendorsement', $this->data);
  $this->load->view('Endorsement/PrintDokumenV2_view', $this->data);
  $this->load->view('templates/footerendorsement');
}

public function printJOSK($md5ej)
{
  $this->load->library('Pdf');
  $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
  $pdf->AddPage();
  $pdf->Image('./assets/template/perawatpanti_01.jpg', 0, 0, $pdf->w, $pdf->h);
  $pdf->Output();
}

public function printPKTKI($md5tki)
{
  $this->load->library('Pdf');
  $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
  $pdf->AddPage();
  $pdf->Image('./assets/template/perawatpanti_01.jpg', 0, 0, $pdf->w, $pdf->h);
  $pdf->Output();}

}
