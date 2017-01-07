<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Endorsement extends MY_Controller {

  private $data;

  public function __construct()
  {
    parent::__construct();
    $this->load_sidebar();
    $this->load->model('Endorsement/Endorsement_model');
    $this->load->model('Perlindungan/Agency_model');

    $this->data['listdp'] = $this->listdp;
    $this->data['usedpg'] = $this->usedpg;
    $this->data['usedmpg'] = $this->usedmpg;
    $this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
    $this->data['sidebar'] = 'SAdmin/Sidebar';
  }

  public function index()
  {
  }

  public function updateagency()
  {
    $this->form_validation->set_rules('name', 'Agency Name', 'required|trim');
    if ($this->form_validation->run() === FALSE)
    {
      $this->data['values'] = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
      $this->data['title'] = 'Endorsement';
      $this->data['subtitle'] = 'Update Agency';
      $this->load->view('templates/headerendorsement', $this->data);
      $this->load->view('Endorsement/UpdateAgency_view', $this->data);
      $this->load->view('templates/footerendorsement');
    }
    else {
      $this->session->set_flashdata('information', 'Profile Updated!');
      $this->data['values'] = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
      $this->Agency_model->update_agency($this->data['values']->agid,true);
      $this->data['values'] = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
      $this->data['title'] = 'Endorsement';
      $this->data['subtitle'] = 'Update Agency';
      $this->load->view('templates/headerendorsement', $this->data);
      $this->load->view('Endorsement/UpdateAgency_view', $this->data);
      $this->load->view('templates/footerendorsement');
    }
  }

  public function checkBarcode()
  {
    $this->data['title'] = 'Endorsement';
    $this->data['subtitle'] = 'Check Barcode';
    $this->data['subtitle2'] = 'Pencatatan Kuitansi';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/CheckBarcode_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  function getDataFromBarcode()
  {

    $code = $this->input->post('barcode', TRUE);
    $tmp['success'] = false;
    $tmp['message'] = "Barcode atau Token tidak valid!!!";

    $query = $this->Endorsement_model->getKuitansi_FromBarcode($code);

    if(!empty($query)) {
      $tmp['kuitansi'][0] = $query[0];
      $tmp['success'] = true;
    }
    else {
      $query = $this->Endorsement_model->checkEntryJO_FromBarcode($code);


      $count = $query[0]['count'];
      $ejid = $query[0]['ejid'];


      if(!empty($query)) {
        $count = $query[0]['count'];
        $ejid = $query[0]['ejid'];

        if ($count > 0) {
          // data entry jo
          $query = $this->Endorsement_model->getEntryJO($ejid);
          $tmp = $query[0];
          $tmp['jocatatan'] = str_replace("\n", "<br/>", $query[0]['jocatatan']);
          $tmp['success'] = true;
          $tmp['message'] = "Barcode valid.";

          // data kuitansi
          $query = $this->Endorsement_model->getKuitansi($ejid);
          $i = 0;
          foreach ($query as $row):
            $tmp['kuitansi'][$i++] = $row;
          endforeach;

          // data tki sekarang
          $query = $this->Endorsement_model->getTKINow($ejid);
          $i = 0;
          foreach ($query as $row):
            $tmp['tki'][$i++] = $row;
          endforeach;

          // data tki
          $query = $this->Endorsement_model->getTKI($ejid);
          $i = 0;
          foreach ($query as $row):
            $tmp['tkiall'][$i++] = $row;
          endforeach;
        }
      }
    }
    echo json_encode($tmp);
  }

}
