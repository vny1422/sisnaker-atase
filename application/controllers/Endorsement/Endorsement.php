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
    $this->data['title'] = 'Endorsement';
    $this->data['subtitle'] = 'Agency Dashboard';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/Endorsement_view', $this->data);
    $this->load->view('templates/footerendorsement');
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
      $this->data['values'] = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
      $cek = $this->Agency_model->update_agency($this->data['values']->agid,true);
      if($cek != false)
      {
        $this->Endorsement_model->catat_logagensi($this->data['values']->agid);
        $this->session->set_flashdata('information', 'Profile Updated!');
        $this->data['values'] = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
        $this->data['title'] = 'Endorsement';
        $this->data['subtitle'] = 'Update Agency';
        $this->load->view('templates/headerendorsement', $this->data);
        $this->load->view('Endorsement/UpdateAgency_view', $this->data);
        $this->load->view('templates/footerendorsement');
      }
      else {
        $this->session->set_flashdata('warning', 'You can only EDIT THRICE a YEAR!');
        $this->data['title'] = 'Endorsement';
        $this->data['subtitle'] = 'Update Agency';
        $this->load->view('templates/headerendorsement', $this->data);
        $this->load->view('Endorsement/UpdateAgency_view', $this->data);
        $this->load->view('templates/footerendorsement');
      }
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


  public function createJO()
  {
    $this->data['title'] = 'Endorsement';
    $this->data['subtitle'] = 'Create JO Packet';
    $this->data['subtitle2'] = 'Worker Data';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/CreateJO_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function viewJO()
  {
  	$agensi = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
  	if(!empty($agensi)) {
  		$query = $this->Endorsement_model->getEntryJO_Agensi($agensi->agid);
  		$i=0;
    	foreach ($query as $row):
    		$this->data['rows'][$i] = array(
    			$row->ejid,
		      	$row->ejdatefilled,
		      	$row->ppnama,
		      	$row->namajenispekerjaan,
		      	$row->ejbcsp,
		      	$row->ejtglendorsement
    		);
    		$i++;
    	endforeach;
  	}
    $this->data['title'] = 'Endorsement';
    $this->data['subtitle'] = 'History of JO Packet';
    $this->data['subtitle2'] = 'JO Packet Detail';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/PacketJO_view', $this->data);
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

  function getDataFromEJID()
  {
  	$ejid = $this->input->post('ejid', TRUE);
  	$tmp['success'] = false;

  	// data entry jo
  	$query = $this->Endorsement_model->getEntryJO($ejid);
    $tmp = $query[0];
    $tmp['jocatatan'] = str_replace("\n", "<br/>", $query[0]['jocatatan']);

    // data tki
   	$query = $this->Endorsement_model->getTKI($ejid);
   	$i = 0;
   	foreach ($query as $row):
   		$tmp['tkiall'][$i++] = $row;
   	endforeach;

   	$tmp['success'] = true;

   	echo json_encode($tmp);
  }

}
