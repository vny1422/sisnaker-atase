<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Input extends MY_Controller {

  private $data;

  public function __construct()
  {
    parent::__construct();
    $this->load->model('SAdmin/Input_model');
    $this->load->model('SAdmin/Institution_model');
    $this->load->model('SAdmin/Category_model');
    $this->load->model('SAdmin/Inputtype_model');

    $this->load_sidebar();
    $this->data['listdp'] = $this->listdp;
    $this->data['usedpg'] = $this->usedpg;
    $this->data['usedmpg'] = $this->usedmpg;
    $this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
    $this->data['namakantor'] = $this->namakantor->nama;
    $this->data['sidebar'] = 'SAdmin/Sidebar';

    if ($this->session->userdata('role') != 1 && $this->session->userdata('role') != 2)
    {
        show_error("Access is forbidden.",403,"403 Forbidden");
    }
  }

  public function index()
  {

  }

  public function addPenempatan()
  {
    $this->form_validation->set_rules('name', 'Nama Input', 'required|trim');
    $this->form_validation->set_rules('kategori', 'Kategori', 'required|trim');
    $this->form_validation->set_rules('inputtype', 'Tipe Input', 'required|trim');
    $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');

    if ($this->form_validation->run() === FALSE)
    {
      $this->data['listcategory'] = $this->Category_model->list_all_category('penempatan');
      $this->data['listinputtype'] = $this->Inputtype_model->list_all_inputtype();
      $this->data['title'] = 'Tambah Detil Input Penempatan';
      $this->load->view('templates/header', $this->data);
      $this->load->view('SAdmin/AddInputPenempatan_view', $this->data);
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

public function addPerlindungan()
{
  $this->form_validation->set_rules('name', 'Nama Input', 'required|trim');
  $this->form_validation->set_rules('kategori', 'Kategori', 'required|trim');
  $this->form_validation->set_rules('inputtype', 'Tipe Input', 'required|trim');
  $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');

  if ($this->form_validation->run() === FALSE)
  {
    $this->data['listcategory'] = $this->Category_model->list_all_category('perlindungan');
    $this->data['listinputtype'] = $this->Inputtype_model->list_all_inputtype();
    $this->data['title'] = 'Tambah Detil Input Perlindungan';
    $this->load->view('templates/header', $this->data);
    $this->load->view('SAdmin/AddInputPerlindungan_view', $this->data);
    $this->load->view('templates/footer');
  }
  else
  {
   $conntable = $this->input->post('namatabel',TRUE);
   if($conntable == "")
   {
    $this->data = array(
     'nameinputdetail' => $this->input->post('name',TRUE),
     'idcategory_perlindungan' => $this->input->post('kategori',TRUE),
     'idinputtype' => $this->input->post('inputtype',TRUE),
     'keterangan' => $this->input->post('keterangan',TRUE),
     'fieldname' => $this->input->post('fieldname', TRUE)
     );
  }
  else {
    $this->data = array(
     'nameinputdetail' => $this->input->post('name',TRUE),
     'idcategory_perlindungan' => $this->input->post('kategori',TRUE),
     'idinputtype' => $this->input->post('inputtype',TRUE),
     'keterangan' => $this->input->post('keterangan',TRUE),
     'conntable' => $conntable,
     'fieldname' => $this->input->post('fieldname', TRUE)
     );
  }
  $inserted_id = $this->Input_model->post_new_input('perlindungan',$this->data);

  if($this->input->post('opsi1',TRUE)) {
   $this->data2 = array();

   for ($i = 1; $i <= 4; $i++) {
    $opsi = 'opsi' . $i;
    if($this->input->post($opsi,TRUE)) {
     $this->data_opsi = array(
      'nameinputoption' => $this->input->post($opsi,TRUE),
      'idinputdetail_perlindungan' => $inserted_id
      );
     array_push($this->data2, $this->data_opsi);
   } else {
     break;
   }
 }

 $this->Input_model->post_new_input_option('perlindungan',$this->data2);
}
$this->session->set_flashdata('information', 'Data berhasil dimasukkan');
$this->load_sidebar();
$this->data['listdp'] = $this->listdp;
$this->data['usedpg'] = $this->usedpg;
$this->data['usedmpg'] = $this->usedmpg;
$this->data['sidebar'] = 'SAdmin/Sidebar';
$this->data['listcategory'] = $this->Category_model->list_all_category('perlindungan');
$this->data['listinputtype'] = $this->Inputtype_model->list_all_inputtype();
$this->data['title'] = 'Tambah Detil Input Perlindungan';
$this->load->view('templates/header', $this->data);
$this->load->view('SAdmin/AddInputPerlindungan_view', $this->data);
$this->load->view('templates/footer');
}
}

public function assignPenempatan()
{
  if ($this->session->userdata('institution') == 1) {
    $this->data['listinstitution'] = $this->Institution_model->list_active_institution();
  } else {
    $this->data['listinstitution'] = $this->Institution_model->get_institution($this->session->userdata('institution'));
  }
  $this->data['listinput'] = $this->Input_model->list_all_input('penempatan');

  $this->data['listnamacategory'] = array();
  foreach ($this->data['listinput'] as $row):
    array_push($this->data['listnamacategory'],$this->Category_model->get_category_name('penempatan',$row->idcategory_penempatan));
  endforeach;

  $this->data['listnamainputtype'] = array();
  foreach ($this->data['listinput'] as $row):
    array_push($this->data['listnamainputtype'],$this->Inputtype_model->get_inputtype_name($row->idinputtype));
  endforeach;

  $this->data['title'] = 'Assign Input Penempatan';
  $this->load->view('templates/header', $this->data);
  $this->load->view('SAdmin/AssignInputPenempatan_view', $this->data);
  $this->load->view('templates/footer');
}

public function assignPerlindungan()
{
  if ($this->session->userdata('institution') == 1) {
    $this->data['listinstitution'] = $this->Institution_model->list_active_institution();
  } else {
    $this->data['listinstitution'] = $this->Institution_model->get_institution($this->session->userdata('institution'));
  }
  $this->data['listinput'] = $this->Input_model->list_all_input('perlindungan');

  $this->data['listnamacategory'] = array();
  foreach ($this->data['listinput'] as $row):
    array_push($this->data['listnamacategory'],$this->Category_model->get_category_name('perlindungan',$row->idcategory_perlindungan));
  endforeach;

  $this->data['listnamainputtype'] = array();
  foreach ($this->data['listinput'] as $row):
    array_push($this->data['listnamainputtype'],$this->Inputtype_model->get_inputtype_name($row->idinputtype));
  endforeach;

  $this->data['title'] = 'Assign Input Perlindungan';
  $this->load->view('templates/header', $this->data);
  $this->load->view('SAdmin/AssignInputPerlindungan_view', $this->data);
  $this->load->view('templates/footer');
}

public function getPenempatanInstitution()
{
  $this->data['listinputinstitution'] = $this->Input_model->get_input_institution('penempatan');

  $this->data['listinput'] = array();
  foreach ($this->data['listinputinstitution'] as $row):
    array_push($this->data['listinput'],$this->Input_model->get_input('penempatan',$row->idinputdetail_penempatan));
  endforeach;

  $this->data['listnamacategory'] = array();
  foreach ($this->data['listinput'] as $row):
    array_push($this->data['listnamacategory'],$this->Category_model->get_category_name('penempatan',$row->idcategory_penempatan));
  endforeach;

  $this->data['listnamainputtype'] = array();
  foreach ($this->data['listinput'] as $row):
    array_push($this->data['listnamainputtype'],$this->Inputtype_model->get_inputtype_name($row->idinputtype));
  endforeach;

  $complete_data = array();
  $i = 0;
  foreach ($this->data['listinput'] as $row):
    array_push($complete_data, (object) array("idinput" => $row->idinputdetail_penempatan, "nameinputdetail" => $row->nameinputdetail, "namecategory" => $this->data['listnamacategory'][$i]->namecategory, "nameinputtype" => $this->data['listnamainputtype'][$i]->nameinputtype, "keterangan" => $row->keterangan, "isactive" => $this->data['listinputinstitution'][$i]->isactive));
  $i = $i + 1;
  endforeach;

  echo json_encode($complete_data);
}

public function addPenempatanInstitution()
{
  $idinstitution = $this->input->post('idinstitution',TRUE);

  if($this->session->userdata('role') == '1' || $idinstitution == $this->session->userdata('institution')){
    $this->Input_model->post_new_input_institution('penempatan',$idinstitution);
  }
  else {
    show_error("Access is forbidden.",403,"403 Forbidden");
  }
}

public function delPenempatanInstitution()
{
  $idinstitution = $this->input->post('idinstitution',TRUE);

  if($this->session->userdata('role') == '1' || $idinstitution == $this->session->userdata('institution')){
    $this->Input_model->delete_input_institution('penempatan',$idinstitution);
  }
  else {
    show_error("Access is forbidden.",403,"403 Forbidden");
  }
}

public function checkPenempatanInstitution()
{
  $exist = $this->Input_model->check_input_institution('penempatan');
  echo json_encode($exist);
}

public function getPerlindunganInstitution()
{
  $this->data['listinputinstitution'] = $this->Input_model->get_input_institution('perlindungan');

  $this->data['listinput'] = array();
  foreach ($this->data['listinputinstitution'] as $row):
    array_push($this->data['listinput'],$this->Input_model->get_input('perlindungan',$row->idinputdetail_perlindungan));
  endforeach;

  $this->data['listnamacategory'] = array();
  foreach ($this->data['listinput'] as $row):
    array_push($this->data['listnamacategory'],$this->Category_model->get_category_name('perlindungan',$row->idcategory_perlindungan));
  endforeach;

  $this->data['listnamainputtype'] = array();
  foreach ($this->data['listinput'] as $row):
    array_push($this->data['listnamainputtype'],$this->Inputtype_model->get_inputtype_name($row->idinputtype));
  endforeach;

  $complete_data = array();
  $i = 0;
  foreach ($this->data['listinput'] as $row):
    array_push($complete_data, (object) array("idinput" => $row->idinputdetail_perlindungan, "nameinputdetail" => $row->nameinputdetail, "namecategory" => $this->data['listnamacategory'][$i]->namecategory, "nameinputtype" => $this->data['listnamainputtype'][$i]->nameinputtype, "keterangan" => $row->keterangan, "isactive" => $this->data['listinputinstitution'][$i]->isactive));
  $i = $i + 1;
  endforeach;

  echo json_encode($complete_data);
}

public function addPerlindunganInstitution()
{
  $idinstitution = $this->input->post('idinstitution',TRUE);

  if($this->session->userdata('role') == '1' || $idinstitution == $this->session->userdata('institution')){
    $this->Input_model->post_new_input_institution('perlindungan',$idinstitution);
  }
  else {
    show_error("Access is forbidden.",403,"403 Forbidden");
  }
}

public function delPerlindunganInstitution()
{
  $idinstitution = $this->input->post('idinstitution',TRUE);

  if($this->session->userdata('role') == '1' || $idinstitution == $this->session->userdata('institution')){
    $this->Input_model->delete_input_institution('perlindungan',$idinstitution);
  }
  else {
    show_error("Access is forbidden.",403,"403 Forbidden");
  }
}

public function checkPerlindunganInstitution()
{
  $exist = $this->Input_model->check_input_institution('perlindungan');
  echo json_encode($exist);
}
}
