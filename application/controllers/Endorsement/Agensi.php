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

		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');

		$this->email->send();

		echo $this->email->print_debugger();

		// $this->load->view('email_view');
  }


  public function cek()
  {
    $this->data['list'] = $this->Agency_model->get_agency_registration();

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
      echo json_encode($agensi->agid);
    } else {
      echo json_encode("0");
    }
  }

}
