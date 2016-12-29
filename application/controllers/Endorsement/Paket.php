<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paket extends MY_Controller {

  private $data;

  public function __construct()
  {
    parent::__construct();
    $this->load_sidebar();
    $this->load->model('Perlindungan/Agency_model');
    $this->load->model('Perlindungan/Pptkis_model');
    $this->data['listdp'] = $this->listdp;
    $this->data['usedpg'] = $this->usedpg;
    $this->data['usedmpg'] = $this->usedmpg;
    $this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
    $this->data['sidebar'] = 'SAdmin/Sidebar';
  }

  public function index()
  {
    $this->data['title'] = 'Catatan Aktivitas';
    $this->data['subtitle'] = 'Catatan Aktivitas Petugas Penanganan';

    $this->data['result_log'] = array();

    foreach($listlog as $row):
      $user = $this->Log_model->get_namapetugas($row->user_username);
      $namatki = $this->Log_model->get_namatki($row->idmasalah);
      $history = $row;
      array_push($this->data['result_log'], array($user[0]->name,strtoupper($namatki[0]->namatki),$history));
    endforeach;

    $this->load->view('templates/headerperlindungan', $this->data);
    $this->load->view('Perlindungan/CatatanAktivitas_view', $this->data);
    $this->load->view('templates/footerperlindungan');
  }

  public function add()
  {
    $this->data['title'] = 'Mendaftarkan Paket JO';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('endorsement/DaftarPaketJO_view');
    $this->load->view('templates/footerendorsement');
  }

  // AJAX AUTOCOMPLETE
  public function ambilnamaagensi($kode=NULL){
    $keyword = $this->input->post('kode',TRUE);
    $query = $this->Agency_model->ambilnamaagensi($keyword);
    $json_array = array();
    foreach ($query as $row)
      $json_array[]=$row->agnama;
    echo json_encode($json_array);
  }

  public function ambilnamapptkis($kode=NULL){
    $keyword = $this->input->post('kode',TRUE);
    $query = $this->Pptkis_model->ambilnamapptkis($keyword);
    $json_array = array();
    foreach ($query as $row)
      $json_array[]=$row->ppnama;
    echo json_encode($json_array);
  }

}
