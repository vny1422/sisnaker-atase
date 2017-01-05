<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pk extends MY_Controller {

  private $data;

  public function __construct()
  {
    parent::__construct();
    $this->load_sidebar();
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

    $this->load->view('templates/headerperlindungan', $this->data);
    $this->load->view('Perlindungan/CatatanAktivitas_view', $this->data);
    $this->load->view('templates/footerperlindungan');
  }

  public function revisi()
  {
    $this->data['title'] = 'Perjanjian Kerja';
    $this->data['subtitle'] = 'Revisi Perjanjian Kerja';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/RevisiPK_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

}
