<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shelter extends MY_Controller {

  private $data;

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Perlindungan/Shelter_model');

    $this->load_sidebar();
    $this->data['listdp'] = $this->listdp;
    $this->data['usedpg'] = $this->usedpg;
    $this->data['usedmpg'] = $this->usedmpg;
    $this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
    $this->data['sidebar'] = 'SAdmin/Sidebar';
  }

  public function index()
  {
    $this->data['title'] = 'Shelter';
    $this->data['subtitle'] = 'Daftar Penghuni Shelter';
    $this->load->view('templates/headerperlindungan', $this->data);
    $this->load->view('Perlindungan/HunianShelter_view', $this->data);
    $this->load->view('templates/footerperlindungan');
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
