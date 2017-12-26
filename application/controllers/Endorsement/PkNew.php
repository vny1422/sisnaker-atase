<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PkNew extends MY_Controller {

  private $data;

public function __construct()
  {

    parent::__construct();
    $this->load->model('Perlindungan/Agency_model');
    $this->load->model('Perlindungan/Pptkis_model');
    $this->load->model('SAdmin/Jobtype_model');
    $this->load->model('SAdmin/Institution_model');
    $this->load->model('SAdmin/Currency_model');
    $this->load->model('SAdmin/Input_model');
    $this->load->model('Endorsement/PK_model');
    $this->load->model('Endorsement/Kuitansi_model');
    $this->load->model('Endorsement/Endorsement_model');
    $this->load_sidebar();
    $this->data['listdp'] = $this->listdp;
    $this->data['usedpg'] = $this->usedpg;
    $this->data['usedmpg'] = $this->usedmpg;
    $this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
      $this->data['namakantor'] = $this->namakantor ? $this->namakantor->nama : ' ' ;
    $this->data['sidebar'] = 'SAdmin/Sidebar';
  }

  public function index()
  {
    if ($this->session->userdata('role') == 4 || $this->session->userdata('role') == 6 || $this->session->userdata('role') == 7 || $this->session->userdata('role') == 5){

      if($this->session->userdata('role') == 4){
        $this->data['dataagensi'] = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
      }

      if ($this->session->flashdata('data') != '')
      {
        $this->data = $this->session->flashdata('data');
      }

      $this->data['listagensi'] = $this->Agency_model->get_agency_from_institution($this->session->userdata('institution'), false, true);
      $this->data['listpptkis'] = $this->Pptkis_model->get_all_pptkis();
      $this->data['title'] = 'Endorsement';
      $this->data['subtitle'] = 'View Data PK (LC)';
      $this->data['subtitle2'] = 'View Data PK (LC)';
      $this->load->view('templates/headerendorsement', $this->data);
      $this->load->view('Endorsement/LihatPK_view', $this->data);
      $this->load->view('templates/footerendorsement');
    }
    else {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }
  }

  public function getDataPK()
  {
    $agid = $this->input->post('agid', TRUE);
    $ppkode = $this->input->post('ppkode', TRUE);
    $res = $this->PK_model->get_data_pk_by_agensi_and_pptkis($agid, $ppkode);
    //$res = $this->PKP_model->get_data_pkp_by_agensi_and_pptkis(26926, 'ABD022');
  //var_dump($res);
    echo json_encode($res);
  }

  public function addPk()
  {
    $agensi = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
    if(!empty($agensi)) {
      $this->data['listconnpp'] = $this->Endorsement_model->get_connected_pptkis($agensi->agid);
    }
    $this->data['employer'] = $this->Input_model->get_input_dataworker($this->session->userdata('institution'));
    $this->data['joborder'] = $this->Input_model->get_input_joborder($this->session->userdata('institution'));
    $this->data['title'] = 'Endorsement';
    $this->data['subtitle'] = 'Create PK (LC)';
    $this->data['subtitle2'] = 'Worker Data';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/AddPK_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function addPkPenempatan()
  {
    $this->data['listconnag'] =  $this->Agency_model->get_agency_from_institution($this->session->userdata('institution'),false,true);
    $this->data['employer'] = $this->Input_model->get_input_dataworker($this->session->userdata('institution'));
    $this->data['joborder'] = $this->Input_model->get_input_joborder($this->session->userdata('institution'));
    $this->data['title'] = 'Endorsement';
    $this->data['subtitle'] = 'Create PK (LC)';
    $this->data['subtitle2'] = 'Worker Data';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/addPkPenempatan_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function quickInfo()
  {
    $agid = $this->input->post('agency', true);
    if(!($agid))
    {
      $agid = $agensi = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'))->agid;
    }
    $ppkode = $this->input->post('ppkode', true);
    echo json_encode($this->PK_model->last_pk($agid, $ppkode));
  }

  public function legalize()
  {
    $currencyid = $this->Institution_model->get_institution($this->session->userdata('institution'))->idcurrency;
    $currencyname = $this->Currency_model->get_currency_name($currencyid);
    $this->data['title'] = 'Endorsement';
    $this->data['currency'] = $currencyname->currencyname;
    $this->data['subtitle'] = 'Endorsement PK (LC)';
    $this->data['subtitle2'] = 'Endorsement PK (LC)';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/LegalizePK_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function getDataFromBarcode()
  {
    $bc = $this->input->post('barcode', TRUE);
    $result = $this->PK_model->get_pk_from_barcode($bc);
    echo json_encode($result);
  }

  public function legalizeBarcode()
  {
    $bc = $this->input->post('barcode', TRUE);
    $result = $this->PK_model->legalize_barcode($bc);

    echo json_encode($result);
  }

  public function generateBarcode()
  {
    $abnormalize[1] = '01';
    $abnormalize[2] = '02';
    $abnormalize[3] = '03';
    $abnormalize[4] = '04';
    $abnormalize[5] = '05';
    $abnormalize[6] = '06';
    $abnormalize[7] = '07';
    $abnormalize[8] = '08';
    $abnormalize[9] = '09';
    $abnormalize[10] = '10';
    $abnormalize[11] = '11';
    $abnormalize[12] = '12';
    $abnormalize[13] = '13';
    $abnormalize[14] = '14';
    $abnormalize[15] = '15';
    $abnormalize[16] = '16';
    $abnormalize[17] = '17';
    $abnormalize[18] = '18';
    $abnormalize[19] = '19';
    $abnormalize[20] = '20';
    $abnormalize[21] = '21';
    $abnormalize[22] = '22';
    $abnormalize[23] = '23';
    $abnormalize[24] = '24';
    $abnormalize[25] = '25';
    $abnormalize[26] = '26';
    $abnormalize[27] = '27';
    $abnormalize[28] = '28';
    $abnormalize[29] = '29';
    $abnormalize[30] = '30';
    $abnormalize[31] = '31';
    $kode[1] = 'A';$kode[2] = 'B';$kode[3] = 'C';$kode[4] = 'D';$kode[5] = 'E';
    $kode[6] = 'F';$kode[7] = 'G';$kode[8] = 'H';$kode[9] = 'I';$kode[10] = 'J';
    $kode[11] = 'K';$kode[12] = 'L';$kode[13] = 'M';$kode[14] = 'N';$kode[5] = 'O';
    $kode[16] = 'P';$kode[17] = 'Q';$kode[18] = 'R';$kode[19] = 'S';$kode[20] = 'T';
    $kode[21] = 'U';$kode[22] = 'V';$kode[23] = 'W';$kode[24] = 'X';$kode[25] = 'Y';
    $kode[26] = 'Z';
    $tglmasuk = $this->input->post('start',TRUE) ? $this->input->post('start',TRUE) : date("Y/m/d");
    $p = explode("/", $tglmasuk);
    $tglmasuk = intval($p[2]);
    $blnmasuk = intval($p[1]);
    $thnmasuk = $p[0];
    $extra = 0;

    if($blnmasuk == '12' && $thnmasuk == '2011')
    {
      $extra = 627;
    }
    $kodetahun = $kode[$thnmasuk-2010];
    $kodebulan = $kode[$blnmasuk];
    $kodetipe = $kode[1];
    $tglmasuk = $abnormalize[$tglmasuk];
    $blnmasuk = $abnormalize[$blnmasuk];
    $count = $this->Kuitansi_model->getCountKuitansi($thnmasuk,$blnmasuk);
    $order = $extra+$count->count;
    $barcodeku = '';
    if($order < 10){$barcodeku = '0000' . $order . $kodebulan . $kodetahun. $kodetipe;}
    else if($order < 100){$barcodeku = '000' . $order . $kodebulan . $kodetahun. $kodetipe;}
    else if($order < 1000){$barcodeku = '00' . $order . $kodebulan . $kodetahun. $kodetipe;}
    else if($order < 10000){$barcodeku = '0' . $order . $kodebulan . $kodetahun. $kodetipe;}
    return $barcodeku;
  }
  public function catatKuitansi()
  {
    if ($this->input->post('catatkuitansi', TRUE))
    {
      $this->form_validation->set_rules('start', 'Tanggal Masuk', 'required|trim');
      $this->form_validation->set_rules('tglkuitansi', 'Tanggal Kuitansi', 'required|trim');
      $this->form_validation->set_rules('kuno', 'Nomor Kuitansi', 'required|trim');
      $this->form_validation->set_rules('jmlterbayar', 'Jumlah Terbayar', 'required|trim');
      $this->form_validation->set_rules('pemohon', 'Nama Pemohon', 'required|trim');
      //$this->form_validation->set_rules('dokumenpkp', 'DokumenPKP', 'required|trim');

      if ($this->form_validation->run() === FALSE)
      {
        $this->session->set_flashdata('information', 'Complete receipt form!');
        redirect('PkNew/legalize');
      }
      else {
        if (!($this->input->post('kuitansiag', true)))
        {
          redirect('PkNew');
        }
        $barcodeku = $this->generateBarcode();
        $username = $this->session->userdata('user');
        $institusi = $this->session->userdata('institution');
        $this->Kuitansi_model->catat_kuitansi($username, $institusi, $barcodeku, 1);
        $this->session->set_flashdata('print', 'Segera Upload Dokumen Final PKP');
        $this->data['bc'] = $barcodeku;
        $this->data['kuitansiag'] = $this->input->post('kuitansiag', true);
        $this->data['kuitansipp'] = $this->input->post('kuitansipp', true);
        $this->session->set_flashdata('data', $this->data);
        redirect('PkNew');
      }
    }
    else {
      if (!($this->input->post('kuitansiag', true)))
      {
        redirect('PkNew');
      }
      $barcodeku = $this->generateBarcode();
      $this->session->set_flashdata('print', 'Segera Upload Dokumen Final PKP ');
      $this->data['bc'] = $barcodeku;
      $this->data['kuitansiag'] = $this->input->post('kuitansiag', true);
      $this->data['kuitansipp'] = $this->input->post('kuitansipp', true);
      $this->session->set_flashdata('data', $this->data);
      redirect('PkNew');
    }
  }
}
