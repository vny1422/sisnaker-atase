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
    $this->data['list'] = $this->Agency_model->get_agency_registration();
    $this->data['listnama'] = array();
    foreach ($this->data['list'] as $row):
      array_push($this->data['listnama'],$this->Institution_model->get_institution_name($row->idinstitution));
    endforeach;

    $this->data['title'] = 'Konfirmasi Pendaftaran Agensi';
    $this->data['subtitle'] = 'Konfirmasi Pendaftaran Agensi';
    $this->data['subtitle2'] = 'Tabel Pendaftar Agensi';
  	$this->load->view('templates/headerendorsement', $this->data);
  	$this->load->view('Endorsement/CekDaftarAgensi_view', $this->data);
  	$this->load->view('templates/footerendorsement');
  }

  function cekCLA()
  {
    $cla = $this->input->post('cla');

    $agensi = $this->Agency_model->cek_cla_agensi_magensi($cla);
    if(isset($agensi)) {
      $username = $this->Agency_model->cek_username_magensi($cla);
      if(isset($username->username)) {
        echo json_encode(array('agid' => $agensi->agid, 'regist' => 1));
      } else {
        echo json_encode(array('agid' => $agensi->agid, 'regist' => 2));
      }
    } else {
      echo json_encode(array('agid' => 0, 'regist' => 0));
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
		$this->User_model->post_new_userreg($user,$pass,$idinst,$agnama);
		$this->Agency_model->update_user_agency($agid,$user);
		$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
				'smtp_user' => 'budi.pangestu.t@gmail.com',
				'smtp_pass' => 'blackYueru',
				'mailtype'  => 'html',
				'charset'   => 'iso-8859-1'
		);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");

		$this->email->from('budi.pangestu.t@gmail.com', 'Budi Pangestu');
		$this->email->to('veinya@hotmail.com');

		$this->email->subject('Sisnaker Username Validated');
		$this->email->message("Your Registration hass been validated. Username and Password are given below: \nUsername :$user \nPassword :$user\n");

		$this->email->send();

		echo $this->email->print_debugger();

		// $this->load->view('email_view');
	}

}
