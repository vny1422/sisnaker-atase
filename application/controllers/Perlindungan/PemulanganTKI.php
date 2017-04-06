<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PemulanganTKI extends MY_Controller {

  private $data;

  public function __construct()
  {
    parent::__construct();
    $this->load_sidebar();
    $this->load->model('Perlindungan/PemulanganTKI_model');

    $this->data['listdp'] = $this->listdp;
    $this->data['usedpg'] = $this->usedpg;
    $this->data['usedmpg'] = $this->usedmpg;
    $this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
    $this->data['namakantor'] = $this->namakantor->nama;
    $this->data['sidebar'] = 'SAdmin/Sidebar';
  }

  public function index()
  {

  }

  public function add()
  {
    $this->data['title'] = 'Pemulangan TKI';
    $this->data['subtitle'] = 'Add Pemulangan TKI';
    $this->load->view('templates/headerperlindungan', $this->data);
    $this->load->view('Perlindungan/AddPemulanganTKI_view', $this->data);
    $this->load->view('templates/footerperlindungan');
  }

  public function insertData()
  {
    $postdata = $this->input->post('postdata', TRUE);
    $postdata = json_decode($postdata);
    $datas = array();
    foreach(get_object_vars($postdata) as $prop => $val)
    {
      $datas["$prop"] = $val;
    }
    $splittgl = explode("/", $datas["tanggalpemulangan"]);
    $datas["tanggalpemulangan"] = $splittgl[0]."-".$splittgl[1]."-".$splittgl[2];
    $datas["idinstitution"] = $this->session->userdata('institution');
    $status = $this->PemulanganTKI_model->post_new_pemulangan($datas);
    if($status){
      $message = "Data berhasil dimasukkan";
    } else {
      $message = "Maaf data tidak tidak berhasil dimasukkan";
    }
    echo json_encode($message);
  }

}