<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pkp extends MY_Controller {

  private $data;

  public function __construct()
  {

    parent::__construct();
    $this->load->model('SAdmin/Category_model');
    $this->load->model('SAdmin/Inputtype_model');
    $this->load->model('Perlindungan/Agency_model');
    $this->load->model('Perlindungan/Pptkis_model');
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
    $this->form_validation->set_rules('name', 'Nama Input', 'required|trim');
    $this->form_validation->set_rules('kategori', 'Kategori', 'required|trim');
    $this->form_validation->set_rules('inputtype', 'Tipe Input', 'required|trim');
    $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');

    if ($this->form_validation->run() === FALSE)
    {
      $this->data['listcategory'] = $this->Category_model->list_all_category('penempatan');
      $this->data['listinputtype'] = $this->Inputtype_model->list_all_inputtype();
      $this->data['listagensi'] = $this->Agency_model->get_agency_from_institution($this->session->userdata('institution'), false, true);
      $this->data['title'] = 'Pengajuan PKP';
      $this->load->view('templates/header', $this->data);
      $this->load->view('Endorsement/CreatePKP_view', $this->data);
      $this->load->view('templates/footer');
    }
    else
    {
     $conntable = $this->input->post('namatabel',TRUE);
     if($conntable == "")
     {
      $this->data = array(
       'nameinputdetail' => $this->input->post('name',TRUE),
       'idcategory_penempatan' => $this->input->post('kategori',TRUE),
       'idinputtype' => $this->input->post('inputtype',TRUE),
       'keterangan' => $this->input->post('keterangan',TRUE),
       'fieldname' => $this->input->post('fieldname', TRUE)
       );
    }
    else {
      $this->data = array(
       'nameinputdetail' => $this->input->post('name',TRUE),
       'idcategory_penempatan' => $this->input->post('kategori',TRUE),
       'idinputtype' => $this->input->post('inputtype',TRUE),
       'keterangan' => $this->input->post('keterangan',TRUE),
       'conntable' => $conntable,
       'fieldname' => $this->input->post('fieldname', TRUE)
       );
    }
    $inserted_id = $this->Input_model->post_new_input('penempatan',$this->data);

    $opsi_enabled = $this->input->post('opsi1',TRUE);

    if($opsi_enabled != "") {
     $this->data2 = array();

     for ($i = 1; $i <= 100; $i++) {
      $opsi = 'opsi' . $i;
      if($this->input->post($opsi,TRUE)) {
       $this->data_opsi = array(
        'nameinputoption' => $this->input->post($opsi,TRUE),
        'idinputdetail_penempatan' => $inserted_id
        );
       array_push($this->data2, $this->data_opsi);
     } else {
       break;
     }
   }

   $this->Input_model->post_new_input_option('penempatan',$this->data2);
 }
 $this->load_sidebar();
 $this->data['listdp'] = $this->listdp;
 $this->data['usedpg'] = $this->usedpg;
 $this->data['usedmpg'] = $this->usedmpg;
 $this->data['sidebar'] = 'SAdmin/Sidebar';
 $this->session->set_flashdata('information', 'Data berhasil dimasukkan');
 $this->data['listcategory'] = $this->Category_model->list_all_category('penempatan');
 $this->data['listinputtype'] = $this->Inputtype_model->list_all_inputtype();
 $this->data['title'] = 'Tambah Detil Input Penempatan';
 $this->load->view('templates/header', $this->data);
 $this->load->view('SAdmin/AddInputPenempatan_view', $this->data);
 $this->load->view('templates/footer');
}
}

}
