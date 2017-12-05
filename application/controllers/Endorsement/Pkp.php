<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pkp extends MY_Controller {

  private $data;

  public function __construct()
  {

    parent::__construct();
    $this->load->model('Perlindungan/Agency_model');
    $this->load->model('Perlindungan/Pptkis_model');
    $this->load->model('SAdmin/Jobtype_model');
    $this->load_sidebar();
    $this->data['listdp'] = $this->listdp;
    $this->data['usedpg'] = $this->usedpg;
    $this->data['usedmpg'] = $this->usedmpg;
    $this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
    $this->data['namakantor'] = $this->namakantor->nama;
    $this->data['sidebar'] = 'SAdmin/Sidebar';

    if ($this->session->userdata('role') != 1 && $this->session->userdata('role') != 2 && $this->session->userdata('role') != 6 && $this->session->userdata('role') != 7)
    {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }
  }

  public function index()
  {
    $this->data['month'] = date('m');

    /// list tahun
    $this->data['tahunpenempatan'] = $this->Endorsement_model->get_all_year();

    $this->data['title'] = 'DASHBOARD';
    $this->data['subtitle'] = 'ENDORSEMENT';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/CreatePKP_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function addPkp()
  {
    $this->form_validation->set_rules('agensi', 'Agensi', 'required|trim');
    $this->form_validation->set_rules('pptkis', 'PPTKIS', 'required|trim');
    $this->form_validation->set_rules('start', 'Tanggal Mulai', 'required|trim');
    $this->form_validation->set_rules('end', 'Tanggal Selesai', 'required|trim');
    $this->form_validation->set_rules('jenispekerjaan[]', 'Jenis Pekerjaan', 'required|trim');
    $this->form_validation->set_rules('laki[]', 'Jumlah Kuota Laki-laki', 'required|trim');
    $this->form_validation->set_rules('perempuan[]', 'Jumlah Kuota Perempuan', 'required|trim');
    $this->form_validation->set_rules('campuran[]', 'Jumlah Kuota Campuran', 'required|trim');
    $this->form_validation->set_rules('dokumenpkp', 'DokumenPKP', 'required|trim');


    if ($this->form_validation->run() === FALSE)
    {
      $this->data['listagensi'] = $this->Agency_model->get_agency_from_institution($this->session->userdata('institution'), false, true);
      $this->data['listpptkis'] = $this->Pptkis_model->get_all_pptkis();
      $this->data['listjenispekerjaan'] = $this->Jobtype_model->list_all_jobtype_by_institution($this->session->userdata('institution'));
      $this->data['title'] = 'Pengajuan PKP';
     // $this->load->view('templates/header', $this->data);
      $this->load->view('templates/headerendorsement', $this->data);
      $this->load->view('Endorsement/CreatePKP_view', $this->data);
      //$this->load->view('templates/footer');
      $this->load->view('templates/footerendorsement');
    }
    else
    {
      var_dump($this->input->post('jenispekerjaan'));
    }
  }

  public function verify()
  {
    $this->data['title'] = 'Endorsement';
    $this->data['subtitle'] = 'Verifikasi & Legalisasi PKP';
    $this->data['subtitle2'] = 'Verifikasi & Legalisasi PKP';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/VerifyPKP_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }
}
