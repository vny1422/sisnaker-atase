<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends MY_Controller {

  private $data;

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Perlindungan/Log_model');
    $this->load->model('SAdmin/Currency_model');

    $this->load_sidebar();
    $this->data['listdp'] = $this->listdp;
    $this->data['usedpg'] = $this->usedpg;
    $this->data['usedmpg'] = $this->usedmpg;
    $this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
    $this->data['namakantor'] = $this->namakantor->nama;
    $this->data['sidebar'] = 'SAdmin/Sidebar';
  }

  public function index()
  {
    if (!($this->session->userdata('role') <= 3 || $this->session->userdata('role') == 5 || $this->session->userdata('role') == 10))
    {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }

    $this->data['title'] = 'Catatan Aktivitas';
    $this->data['subtitle'] = 'Catatan Aktivitas Petugas Penanganan';

    $this->data['result_log'] = array();

    $listlog = $this->Log_model->get_history()->result();
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
}
