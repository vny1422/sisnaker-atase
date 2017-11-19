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
    if(empty($this->namakantor->nama)){
      $this->data['namakantor'] = "";
    }
    else{
      $this->data['namakantor'] = $this->namakantor->nama;
    }
    $this->data['sidebar'] = 'SAdmin/Sidebar';

    if ($this->session->userdata('role') > 3)
    {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }
  }

  public function index()
  {
    $this->data['list'] = $this->PemulanganTKI_model->query_pemulangan_institution($this->session->userdata('institution'));

    $this->data['title'] = 'Pemulangan TKI';
    $this->data['subtitle'] = 'Tabel Pemulangan TKI';
    $this->load->view('templates/headerperlindungan', $this->data);
    $this->load->view('Perlindungan/PemulanganTKI_view', $this->data);
    $this->load->view('templates/footerperlindungan');
  }

  public function add()
  {
    $this->data['title'] = 'Pemulangan TKI';
    $this->data['subtitle'] = 'Add Pemulangan TKI';
    $this->load->view('templates/headerperlindungan', $this->data);
    $this->load->view('Perlindungan/AddPemulanganTKI_view', $this->data);
    $this->load->view('templates/footerperlindungan');
  }

  public function edit($id)
  {
    $this->data['list'] = $this->PemulanganTKI_model->get_pemulangan($id);
    if($this->data['list']->idinstitution == $this->session->userdata('institution'))
    {
      $this->data['title'] = 'Pemulangan TKI';
      $this->data['subtitle'] = 'Edit Pemulangan TKI';
      $this->load->view('templates/headerperlindungan', $this->data);
      $this->load->view('Perlindungan/AddPemulanganTKI_view', $this->data);
      $this->load->view('templates/footerperlindungan');
    }
    else
    {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }
  }

  public function delete($id)
  {
    $this->data['list'] = $this->PemulanganTKI_model->get_pemulangan($id);
    if($this->data['list']->idinstitution == $this->session->userdata('institution'))
    {
      $this->PemulanganTKI_model->delete_pemulangan($id);
      redirect('pemulangantki');
    }
    else
    {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }
  }

  public function insertData()
  {
    $postdata = $this->input->post('postdata', TRUE);
    $idtkipulang = $this->input->post('id', TRUE);
    $postdata = json_decode($postdata);
    $datas = array();
    foreach(get_object_vars($postdata) as $prop => $val)
    {
      $datas["$prop"] = $val;
    }
    $splittgl = explode("/", $datas["tanggalpemulangan"]);
    $datas["tanggalpemulangan"] = $splittgl[0]."-".$splittgl[1]."-".$splittgl[2];
    $datas["idinstitution"] = $this->session->userdata('institution');

    if($idtkipulang != ""){
      $val = $this->PemulanganTKI_model->get_pemulangan($idtkipulang);
      if($val->idinstitution == $this->session->userdata('institution')){
        $status = $this->PemulanganTKI_model->update_pemulangan($idtkipulang, $datas);
      } else {
        $status = false;
      }
    } else {
      $status = $this->PemulanganTKI_model->post_new_pemulangan($datas);
    }

    if($status){
      $message = "Data berhasil dimasukkan";
    } else {
      $message = "Maaf data tidak tidak berhasil dimasukkan";
    }
    echo json_encode($message);
  }

  public function checkPaspor()
  {
    $paspor = $this->input->post('paspor', TRUE);
    $data = $this->PemulanganTKI_model->query_pemulangan_paspor($paspor);

    echo json_encode($data);
  }

}
