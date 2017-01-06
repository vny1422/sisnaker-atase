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
    $this->load->model('SAdmin/Currency_model');
    $this->load->model('SAdmin/Institution_model');
    $this->load->model('Endorsement/Kuitansi_model');
  }

  public function index()
  {

  }

  public function catat()
  {
    $this->form_validation->set_rules('start', 'Tanggal Masuk', 'required|trim');

    if ($this->form_validation->run() === FALSE)
    {
      $currencyid = $this->Institution_model->get_institution($this->session->userdata('institution'))->idcurrency;
      $currencyname = $this->Currency_model->get_currency_name($currencyid);
      $this->data['listdokumen'] = $this->Kuitansi_model->list_dokumen_kuitansi();
      $this->data['currency'] = $currencyname->currencyname;
      $this->data['title'] = 'Catat Kuitansi';
      $this->data['subtitle'] = 'Pencatatan Kuitansi';
      $this->data['subtitle2'] = 'History';
      $this->load->view('templates/headerendorsement', $this->data);
      $this->load->view('Endorsement/PencatatanKuitansi_view', $this->data);
      $this->load->view('templates/footerendorsement');
    }
    else {
      $username = $this->session->userdata('user');
      $institusi = $this->session->userdata('institution');
      $this->Kuitansi_model->catat_kuitansi($username,$institusi);
      $this->session->set_flashdata('information', 'Data berhasil dimasukkan');
      $currencyid = $this->Institution_model->get_institution($this->session->userdata('institution'))->idcurrency;
      $currencyname = $this->Currency_model->get_currency_name($currencyid);
      $this->data['listdokumen'] = $this->Kuitansi_model->list_dokumen_kuitansi();
      $this->data['currency'] = $currencyname->currencyname;
      $this->data['title'] = 'Catat Kuitansi';
      $this->data['subtitle'] = 'Pencatatan Kuitansi';
      $this->data['subtitle2'] = 'History';
      $this->load->view('templates/headerendorsement', $this->data);
      $this->load->view('Endorsement/PencatatanKuitansi_view', $this->data);
      $this->load->view('templates/footerendorsement');
    }

  }

  public function checkkuitansi()
  {
    $noku = $this->input->post('noku', TRUE);
    $result = $this->Kuitansi_model->check_kuitansi($noku);
    echo json_encode($result);
  }


}
