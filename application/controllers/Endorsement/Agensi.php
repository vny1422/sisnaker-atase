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
		$this->load->model('SAdmin/User_model');
    $this->load->model('Perlindungan/Pptkis_model');
    $this->load->model('SAdmin/Institution_model');
    $this->load->model('SAdmin/Kantor_model');

    if ($this->session->userdata('role') != 1 && $this->session->userdata('role') != 2)
    {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }
  }

  public function index()
  {

  }


  public function cek()
  {
    $this->data['list'] = $this->Agency_model->get_agency_registration(NULL, $this->session->userdata['institution'], $this->session->userdata['kantor']);
    $this->data['listnamainstitusi'] = array();
    $this->data['listnamakantor'] = array();
    foreach ($this->data['list'] as $row):
      array_push($this->data['listnamainstitusi'], $this->Institution_model->get_institution_name($row->idinstitution));
      array_push($this->data['listnamakantor'], $this->Kantor_model->get_kantor_name($row->idkantor));
    endforeach;

    $this->data['title'] = 'Konfirmasi Pendaftaran Agensi';
    $this->data['subtitle'] = 'Konfirmasi Pendaftaran Agensi';
    $this->data['subtitle2'] = 'Tabel Pendaftar Agensi';
  	$this->load->view('templates/headerendorsement', $this->data);
  	$this->load->view('Endorsement/CekDaftarAgensi_view', $this->data);
  	$this->load->view('templates/footerendorsement');
  }

  function cekAgensi()
  {
    $cla = $this->input->post('cla');
    $agnama = $this->input->post('agnama');

    $agensi = $this->Agency_model->cek_agensi_magensi($cla, $agnama);

    if(isset($agensi)) {
      $list_agensi = array();
      foreach ($agensi as $row) {
        $temp = $this->Institution_model->get_institution_name($row->idinstitution);
        $row->namainst = $temp->nameinstitution;
        array_push($list_agensi, $row);
      }
      echo json_encode($list_agensi);
    } else {
      echo json_encode("0");
    }
  }

  function mergeAgensi()
  {
    $induk = $this->input->post('induk');
    $kembar = $this->input->post('kembar');
    $data = array();
    $inactive = array();

    for ($i = 0; $i < sizeof($kembar); $i++) {
      array_push($data, array('agid_kembar'=>$kembar[$i], 'agid_induk'=>$induk));
      array_push($inactive, array('agid'=>$kembar[$i], 'agenable'=>0));
    }

    $count = $this->Agency_model->merge_agensi_kembar($data);
    $count2 = $this->Agency_model->deactivate_agensi($inactive);

    if($count > 0 && $count2 > 0) {
      echo json_encode('Succeed');
    } else {
      echo json_encode('Failed');
    }
  }

  function updateStatusRegistrasi()
  {
    $agrid = $this->input->post('agrid');
    $agid = $this->input->post('agid');
    $status = $this->input->post('status');

    $now = date('Y-m-d H:i:s');

    $this->Agency_model->update_agency_registrasi_agid($agrid, $now, $status, $agid);
  }

	function updateMagensiUser()
	{
		$agid = $this->input->post('agid');
		$user = $this->input->post('user');
		$pass = $this->input->post('pass');
		$idinst = $this->input->post('idinst');
		$agnama = $this->input->post('agnama');
		$email = $this->input->post('email');
    $dataAgensi = $this->input->post('dataagensi');

		$this->User_model->post_new_userreg($user,$pass,$idinst,$agnama);
		$this->Agency_model->update_user_agency($agid,$user,$dataAgensi);
		$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
				'smtp_user' => 'sisnaker.noreply@gmail.com',
				'smtp_pass' => 'kmzwa8awaa',
				'mailtype'  => 'text',
				'charset'   => 'utf-8'
		);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");

		$this->email->from('sisnaker.noreply@gmail.com', 'No Reply - Atnaker Online');
		$this->email->to($email);

		$this->email->subject('ONLINE ATNAKER - Username Validated');
		$this->email->message("
		Dear Agency $agnama,

		This is your username and password :

		Username : $user
		Password : $user

		After login, please update your password.
		Thank you,

		ONLINE ATNAKER
		Ministry of Manpower of The Republic of Indonesia \r\n
		");

		$this->email->send();

		echo $this->email->print_debugger();

		// $this->load->view('email_view');
	}

}
