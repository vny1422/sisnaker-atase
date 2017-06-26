<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DaftarAgensi extends MY_Controller {

  

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->load->view('Endorsement/DaftarAgensi_view');
  }

}
