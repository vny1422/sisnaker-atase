<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shelter extends MY_Controller {

  private $data;

  public function __construct()
  {
    parent::__construct();
    $this->load->model('SAdmin/Institution_model');
    $this->load->model('Perlindungan/Shelter_model');
    $this->load->model('Perlindungan/Kasus_model');
    $this->load->model('SAdmin/Currency_model');

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
    if ($this->session->userdata('role') != 1 && $this->session->userdata('role') != 2)
    {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }

    if($this->session->userdata('role') == '1')
    {
      $this->data['list'] = $this->Shelter_model->list_all_shelter();
    }
    else
    {
      $this->data['list'] = $this->Shelter_model->query_shelter_institution($this->session->userdata('institution'));
    }
    $this->data['listnama'] = array();
    foreach ($this->data['list'] as $row):
      array_push($this->data['listnama'],$this->Institution_model->get_institution_name($row->idinstitution));
    endforeach;
    $this->data['title'] = 'Tabel Shelter';
    $this->load->view('templates/header', $this->data);
    $this->load->view('Perlindungan/Shelter_view', $this->data);
    $this->load->view('templates/footer');
  }

  public function hunian()
  {
    if ($this->session->userdata('role') > 3)
    {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }

    $currency = $this->Currency_model->get_currency_name_institution($this->session->userdata('institution'));
    $this->data['namacurrency'] = strtoupper($currency->currencyname);

    $this->data['title'] = 'Shelter';
    $this->data['subtitle'] = 'Daftar Penghuni Shelter';
    $this->load->view('templates/headerperlindungan', $this->data);
    $this->load->view('Perlindungan/HunianShelter_view', $this->data);
    $this->load->view('templates/footerperlindungan');
  }

  public function add()
  {
    if ($this->session->userdata('role') != 1 && $this->session->userdata('role') != 2)
    {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }

    $this->form_validation->set_rules('name', 'Shelter Name', 'required|trim');
    $this->form_validation->set_rules('institution', 'Institution', 'required');

    if ($this->form_validation->run() === FALSE)
    {
      if($this->session->userdata('role') == '1')
      {
        $this->data['listinstitution'] = $this->Institution_model->list_active_institution();
      }
      else {
        $this->data['listinstitution'] = array();
        array_push($this->data['listinstitution'],$this->Institution_model->get_institution($this->session->userdata('institution')));
      }
      $this->data['title'] = 'Add New Shelter';
      $this->load->view('templates/header', $this->data);
      $this->load->view('Perlindungan/AddShelter_view', $this->data);
      $this->load->view('templates/footer');
    }
    else
    {
      $this->Shelter_model->post_new_shelter();
      $this->session->set_flashdata('information', 'Data berhasil dimasukkan');
      if($this->session->userdata('role') == '1')
      {
        $this->data['listinstitution'] = $this->Institution_model->list_active_institution();
      }
      else {
        $this->data['listinstitution'] = array();
        array_push($this->data['listinstitution'],$this->Institution_model->get_institution($this->session->userdata('institution')));
      }
      $this->data['title'] = 'Add New Shelter';
      $this->load->view('templates/header', $this->data);
      $this->load->view('Perlindungan/AddShelter_view', $this->data);
      $this->load->view('templates/footer');
    }
  }

  public function edit($id)
  {
    if ($this->session->userdata('role') != 1 && $this->session->userdata('role') != 2)
    {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }

    $this->form_validation->set_rules('name', 'Shelter Name', 'required|trim');
    $this->form_validation->set_rules('institution', 'Institution', 'required');

    if ($this->form_validation->run() === FALSE)
    {
      $this->data['values'] = $this->Shelter_model->get_shelter($id);
      if($this->session->userdata('role') == '1' || $this->data['values']->idinstitution == $this->session->userdata('institution'))
      {
        if($this->session->userdata('role') == '1')
        {
          $this->data['listinstitution'] = $this->Institution_model->list_active_institution();
        }
        else {
          $this->data['listinstitution'] = array();
          array_push($this->data['listinstitution'],$this->Institution_model->get_institution($this->session->userdata('institution')));
        }
        $this->data['title'] = 'Edit Shelter';
        $this->load->view('templates/header', $this->data);
        $this->load->view('Perlindungan/EditShelter_view', $this->data);
        $this->load->view('templates/footer');
      }
      else
      {
        show_error("Access is forbidden.",403,"403 Forbidden");
      }
    }
    else
    {
      $this->Shelter_model->update_shelter($id);
      redirect('shelter');
    }
  }

  public function delete($id)
  {
    if ($this->session->userdata('role') != 1 && $this->session->userdata('role') != 2)
    {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }

    $this->data['values'] = $this->Shelter_model->get_shelter($id);
    if($this->session->userdata('institution') == '1' || $this->data['values']->idinstitution == $this->session->userdata('institution'))
    {
      $this->Shelter_model->delete_shelter($id);
      redirect('shelter');
    }
    else
    {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }
  }

  function getShelter(){
    $input = $this->getJSONpost();
    $id = intval($input['idinstitution']);
    $shlist = $this->Shelter_model->query_shelter_institution_array($id);
    echo json_encode($shlist);
  }

  function getResident(){
    $input = $this->getJSONpost();
    $date = explode("/",$input['dateyear']);
    $m = intval($date[0]);
    $y = intval($date[1]);
    $id = intval($input['shelter']);

    $resident = $this->Shelter_model->query_resident_month($id,$m,$y);
    if($resident != 0){
      for($i=0;$i<count($resident);$i++){
        $resident[$i]['idx'] = $i+1;
      }
    }

    echo json_encode($resident);
  }

  function getJSONpost(){
    $input = $this->input->post();
    if( isset( $_SERVER['CONTENT_TYPE'] ) && strpos( $_SERVER['CONTENT_TYPE'], "application/json" ) !== false )
    {
      $input = json_decode(trim(file_get_contents( 'php://input' ) ), true );
    }
    return $input;
  }

}
