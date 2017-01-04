<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kuitansi extends MY_Controller {

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

  public function catat()
  {
    $this->data['title'] = 'Catat Kuitansi';
    $this->data['subtitle'] = 'Pencatatan Kuitansi';
    $this->data['subtitle2'] = 'History';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/PencatatanKuitansi_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function pptkis()
  {
    $this->data['title'] = 'Cekal PPTKIS';
    $this->data['subtitle'] = 'Cekal PPTKIS';
    $this->data['subtitle2'] = 'Tabel Cekal PPTKIS';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/CekalPPTKIS_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function editcklag()
  {
    $this->data['title'] = 'Cekal Agensi';
    $this->data['subtitle'] = 'Edit Cekal Agensi';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/EditCekalAgensi_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

    public function editcklpptkis()
  {
    $this->data['title'] = 'Cekal PPTKIS';
    $this->data['subtitle'] = 'Edit Cekal PPTKIS';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/EditCekalPPTKIS_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }



}
