<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dex extends MY_Controller {

  private $data;

  public function __construct()
  {
    parent::__construct();
    $this->load_sidebar();
    $this->load->model('Endorsement/Endorsement_model');

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
    $this->data['title'] = 'View All Data Direct Ext. Hiring';
    $this->data['subtitle'] = 'View All Data Direct Ext. Hiring';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/Dex/LihatDex_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function verify()
  {
    $this->data['title'] = 'Verify & Endorse Direct Ext. Hiring';
    $this->data['subtitle'] = 'Verify & Endorse Direct Ext. Hiring';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/Dex/VerifyDex_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function salary()
  {
    $this->data['title'] = 'Manage Salary Direct Ext. Hiring';
    $this->data['subtitle'] = 'Manage Salary Direct Ext. Hiring';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/Dex/SalaryDex_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

}
