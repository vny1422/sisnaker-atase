<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Endorsement extends MY_Controller {

  private $data;

  public function __construct()
  {
    parent::__construct();
    $this->load_sidebar();
    $this->load->model('Endorsement/Endorsement_model');

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
    $this->data['title'] = 'Endorsement';
    $this->data['subtitle'] = 'Update Agency';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/UpdateAgency_view', $this->data);
    $this->load->view('templates/footerendorsement');
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

  function checkJO()
  {
    // $code = $this->input->post('barcode', TRUE);
    $code = 'kl988';
      
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

        // data tki
        $query = $this->Endorsement_model->getTKI($ejid);
        $i = 0;
        foreach ($query as $row):
          $tmp['tki'][$i++] = $row;
        endforeach;
      }
    }
    echo json_encode($tmp);
  }

}
