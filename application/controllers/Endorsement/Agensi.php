<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agensi extends MY_Controller {
	private $data;


  public function __construct()
  {
    parent::__construct();
    $this->load_sidebar();
    $this->data['listdp'] = $this->listdp;
    $this->data['usedpg'] = $this->usedpg;
    $this->data['usedmpg'] = $this->usedmpg;
    $this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
    $this->data['namakantor'] = $this->namakantor->nama;
    $this->data['sidebar'] = 'SAdmin/Sidebar';
    $this->load->model('Perlindungan/Agency_model');
    $this->load->model('Perlindungan/Pptkis_model');
  }

  public function index()
  {

  }


  public function cek()
  {
  	$this->data['title'] = 'Konfirmasi Pendaftaran Agensi';
	$this->data['subtitle'] = 'Konfirmasi Pendaftaran Agensi';
	$this->data['subtitle2'] = 'Tabel Pendaftar Agensi';
  	$this->load->view('templates/headerendorsement', $this->data);
  	$this->load->view('Endorsement/CekDaftarAgensi_view');
  	$this->load->view('templates/footerendorsement');
  }

}
