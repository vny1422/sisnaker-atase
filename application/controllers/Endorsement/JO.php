<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JO extends MY_Controller {

  private $data;

  public function __construct()
  {

    parent::__construct();
    $this->load->model('Perlindungan/Agency_model');
    $this->load->model('Perlindungan/Pptkis_model');
    $this->load->model('SAdmin/Jobtype_model');
    $this->load->model('SAdmin/Institution_model');
    $this->load->model('Endorsement/JO_model');
    $this->load->model('SAdmin/Currency_model');

    // $this->load->model('SAdmin/Currency_model');
    // $this->load->model('Endorsement/PKP_model');
    // $this->load->model('Endorsement/Kuitansi_model');
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
    if ($this->session->userdata('role') == 4 || $this->session->userdata('role') == 6 || $this->session->userdata('role') == 7){

      if($this->session->userdata('role') == 4){
        $this->data['dataagensi'] = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
      }

      if ($this->session->flashdata('data') != '')
      {
        $this->data = $this->session->flashdata('data');
      }

      $this->data['listagensi'] = $this->Agency_model->get_agency_from_institution($this->session->userdata('institution'), false, true);
      $this->data['listpptkis'] = $this->Pptkis_model->get_all_pptkis();
      $this->data['title'] = 'Endorsement';
      $this->data['subtitle'] = 'Lihat Data JO';
      $this->data['subtitle2'] = 'Lihat Data JO';
      $this->load->view('templates/headerendorsement', $this->data);
      $this->load->view('Endorsement/LihatJO_view', $this->data);
      $this->load->view('templates/footerendorsement');
    }
    else {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }
  }

  public function addJO()
  {
    if ($this->session->userdata('role') == 4 || $this->session->userdata('role') == 6 || $this->session->userdata('role') == 7)
    {
      $this->form_validation->set_rules('agensi', 'Agensi', 'required|trim');
      $this->form_validation->set_rules('pptkis', 'PPTKIS', 'required|trim');
      $this->form_validation->set_rules('start', 'Tanggal Mulai', 'required|trim');
      $this->form_validation->set_rules('end', 'Tanggal Selesai', 'required|trim');
      $this->form_validation->set_rules('jenispekerjaan[]', 'Jenis Pekerjaan', 'required|trim');
      $this->form_validation->set_rules('laki[]', 'Jumlah Kuota Laki-laki', 'required|trim');
      $this->form_validation->set_rules('perempuan[]', 'Jumlah Kuota Perempuan', 'required|trim');
      $this->form_validation->set_rules('campuran[]', 'Jumlah Kuota Campuran', 'required|trim');
      //$this->form_validation->set_rules('dokumenpkp', 'DokumenPKP', 'required|trim');

      if ($this->form_validation->run() === FALSE)
      {
        if($this->session->userdata('role') == 4){
          $this->data['dataagensi'] = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
        }

        $this->data['listagensi'] = $this->Agency_model->get_agency_from_institution($this->session->userdata('institution'), false, true);
        $this->data['listpptkis'] = $this->Pptkis_model->get_all_pptkis();
        $this->data['listjenispekerjaan'] = $this->Jobtype_model->list_all_jobtype_by_institution($this->session->userdata('institution'));
        $this->data['title'] = 'Pengajuan JO';
        // $this->load->view('templates/header', $this->data);
        $this->load->view('templates/headerendorsement', $this->data);
        $this->load->view('Endorsement/CreateJOInter_view', $this->data);
        //$this->load->view('templates/footer');
        $this->load->view('templates/footerendorsement');
      }
      else
      {
        $returnPKP = $this->JO_model->post_new_jo();
        if ($returnPKP[0]) {
          $this->session->set_flashdata('information', 'Data berhasil dimasukkan');
        }
        else {
          $this->session->set_flashdata('information', 'Data gagal dimasukkan');
        }
        redirect('jo/addJO');
      }
    }
    else {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }
  }

  public function verify()
  {
    $currencyid = $this->Institution_model->get_institution($this->session->userdata('institution'))->idcurrency;
    $currencyname = $this->Currency_model->get_currency_name($currencyid);
    $this->data['listjo'] = $this->JO_model->get_jo_verify_list();
    //var_dump($this->data['listjo']);
    $this->data['title'] = 'Endorsement';
    $this->data['currency'] = $currencyname->currencyname;
    $this->data['subtitle'] = 'Verifikasi JO';
    $this->data['subtitle2'] = 'Verifikasi JO';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/VerifyJO_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function verifyJO($jobno)
  {
    if ($this->JO_model->toggle_jo($jobno))
    {
        $this->session->set_flashdata('information', 'JO berhasil diverifikasi!');
        redirect('jo/verify');
    }
    else {
        $this->session->set_flashdata('information', 'JO gagal diverifikasi!');
        redirect('jo/verify');
    }
  }

  public function rejectJO()
  {
    $jobno = $this->input->post('hiddenjobno', true);
    if ($this->JO_model->toggle_jo($jobno, TRUE))
    {
        $this->session->set_flashdata('information', 'JO berhasil ditolak!');
        redirect('jo/verify');
    }
    else {
        $this->session->set_flashdata('information', 'JO gagal ditolak!');
        redirect('jo/verify');
    }
  }

  public function legalize()
  {
    $currencyid = $this->Institution_model->get_institution($this->session->userdata('institution'))->idcurrency;
    $currencyname = $this->Currency_model->get_currency_name($currencyid);
    $this->data['title'] = 'Endorsement';
    $this->data['currency'] = $currencyname->currencyname;
    $this->data['subtitle'] = 'Legalisasi JO';
    $this->data['subtitle2'] = 'Legalisasi JO';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/LegalizeJO_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function legalizeBarcode()
  {
    $bc = $this->input->post('barcode', TRUE);
    $result = $this->JO_model->legalize_barcode($bc);

    echo json_encode($result);
  }

  public function catatKuitansi()
  {
    if ($this->input->post('catatkuitansi', TRUE))
    {
      $this->form_validation->set_rules('start', 'Tanggal Masuk', 'required|trim');
      $this->form_validation->set_rules('tglkuitansi', 'Tanggal Kuitansi', 'required|trim');
      $this->form_validation->set_rules('kuno', 'Nomor Kuitansi', 'required|trim');
      $this->form_validation->set_rules('jmlterbayar', 'Jumlah Terbayar', 'required|trim');
      $this->form_validation->set_rules('pemohon', 'Nama Pemohon', 'required|trim');

      if ($this->form_validation->run() === FALSE)
      {
        $this->session->set_flashdata('information', 'Complete receipt form!');
        redirect('jo/legalize');
      }
      else {
        if (!($this->input->post('kuitansiag', true)))
        {
          redirect('jo');
        }
        $barcodeku = $this->generateBarcode();
        $username = $this->session->userdata('user');
        $institusi = $this->session->userdata('institution');
        $this->Kuitansi_model->catat_kuitansi($username, $institusi, $barcodeku, 1);
        $this->session->set_flashdata('print', 'Segera Upload Dokumen Final PKP');
        $this->data['bc'] = $barcodeku;
        $this->data['kuitansiag'] = $this->input->post('kuitansiag', true);
        $this->data['kuitansipp'] = $this->input->post('kuitansipp', true);
        $this->session->set_flashdata('data', $this->data);
        redirect('jo');
      }
    }
    else {
      if (!($this->input->post('kuitansiag', true)))
      {
        redirect('jo');
      }
      $barcodeku = $this->generateBarcode();
      $this->session->set_flashdata('print', 'Segera Upload Dokumen Final PKP ');
      $this->data['bc'] = $barcodeku;
      $this->data['kuitansiag'] = $this->input->post('kuitansiag', true);
      $this->data['kuitansipp'] = $this->input->post('kuitansipp', true);
      $this->session->set_flashdata('data', $this->data);
      redirect('jo');
    }
  }

  //ajax
  public function editJO(){
    //var_dump($this->input->post('jobid', true));
    var_dump($this->input->post('tglawal', true));
    var_dump($this->input->post('tglakhir', true));
    echo json_encode($this->JO_model->editDate_from_bc($this->input->post('jobno', true)));
  }

  public function editJOd(){
    echo json_encode($this->JO_model->editJOd($this->input->post('id', true)));
  }

  public function getDataFromBarcode()
  {
    $jobno = $this->input->post('jobno', TRUE);
    $result = $this->JO_model->get_jo_from_barcode($jobno);

    echo json_encode($result);
  }

  public function getDataJO()
  {
    $agid = $this->input->post('agid', TRUE);
    $ppkode = $this->input->post('ppkode', TRUE);

    $res = $this->JO_model->get_data_jo_by_agensi_and_pptkis($agid, $ppkode);
    //$res = $this->PKP_model->get_data_pkp_by_agensi_and_pptkis(26926, 'ABD022');
  //var_dump($res);
    echo json_encode($res);
  }
}
