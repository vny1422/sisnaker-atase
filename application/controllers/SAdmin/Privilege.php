<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privilege extends MY_Controller {

  private $data;

  public function __construct()
  {
    parent::__construct();
    $this->load->model('SAdmin/Privilege_model');

    $this->load_sidebar();
    $this->data['listdp'] = $this->listdp;
    $this->data['usedpg'] = $this->usedpg;
    $this->data['usedmpg'] = $this->usedmpg;
    $this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
    $this->data['namakantor'] = $this->namakantor->nama;
    $this->data['sidebar'] = 'SAdmin/Sidebar';

    if ($this->session->userdata('role') != 1)
    {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }
  }

  public function index()
  {

  }

    public function addMPG() //Master Privilege Group
    {
      $this->form_validation->set_rules('name', 'Master Privilege Group Name', 'required|trim');


      if ($this->form_validation->run() === FALSE)
      {
        $this->data['title'] = 'Add Master Privilege Group';
        $this->load->view('templates/header', $this->data);
        $this->load->view('SAdmin/AddMasterPrivilegeGroup_view', $this->data);
        $this->load->view('templates/footer');
      }
      else
      {
        $result = $this->Privilege_model->post_new_mpg();
        $this->session->set_flashdata('information', 'Data berhasil dimasukkan');
        $this->data['title'] = 'Add Master Privilege Group';
        $this->load->view('templates/header', $this->data);
        $this->load->view('SAdmin/AddMasterPrivilegeGroup_view', $this->data);
        $this->load->view('templates/footer');
      }
    }

    public function addPG() //Privilege Group
    {
      $this->form_validation->set_rules('name', 'Privilege Group Name', 'required|trim');
      $this->form_validation->set_rules('mpg', 'Master Privilege Group', 'required|trim');

      if ($this->form_validation->run() === FALSE)
      {
        $this->data['listmpg'] = $this->Privilege_model->list_all_mpg();
        $this->data['title'] = 'Add Privilege Group';
        $this->load->view('templates/header', $this->data);
        $this->load->view('SAdmin/AddPrivilegeGroup_view', $this->data );
        $this->load->view('templates/footer');
      }
      else
      {
        $this->Privilege_model->post_new_pg();
        $this->session->set_flashdata('information', 'Data berhasil dimasukkan');
        $this->data['listmpg'] = $this->Privilege_model->list_all_mpg();
        $this->data['title'] = 'Add Privilege Group';
        $this->load->view('templates/header', $this->data);
        $this->load->view('SAdmin/AddPrivilegeGroup_view', $this->data );
        $this->load->view('templates/footer');
      }
    }

    public function addDP()
    {
      $this->form_validation->set_rules('name', 'Nama Menu', 'required|trim');
      $this->form_validation->set_rules('url', 'Page URL', 'required|trim');
      $this->form_validation->set_rules('pg', 'Nama Privilege Group', 'required|trim');

      if ($this->form_validation->run() === FALSE)
      {
        $this->data['list'] = $this->Privilege_model->list_all_pg();
        $this->data['title'] = 'Tambah Detail Privilege';
        $this->load->view('templates/header', $this->data);
        $this->load->view('SAdmin/AddDetailPrivilege_view', $this->data);
        $this->load->view('templates/footer');
      }
      else
      {
        $this->Privilege_model->post_new_dp();
        $this->session->set_flashdata('information', 'Data berhasil dimasukkan');
        $this->data['list'] = $this->Privilege_model->list_all_pg();
        $this->data['title'] = 'Tambah Detail Privilege';
        $this->load->view('templates/header', $this->data);
        $this->load->view('SAdmin/AddDetailPrivilege_view', $this->data);
        $this->load->view('templates/footer');
      }
    }

    public function viewMPG()
    {
      $this->data['list'] = $this->Privilege_model->list_all_mpg();
      $this->data['title'] = 'View Master Privilege Group';
      $this->load->view('templates/header', $this->data);
      $this->load->view('SAdmin/MasterPrivilegeGroup_view', $this->data);
      $this->load->view('templates/footer');
    }

    public function viewPG()
    {
      $this->data['list'] = $this->Privilege_model->list_all_pg();
      $this->data['listnama'] = array();
      foreach ($this->data['list'] as $row):
        array_push($this->data['listnama'],$this->Privilege_model->get_mpg_name($row->masterprivilegegroupid));
      endforeach;
      $this->data['title'] = 'View Privilege Group';
      $this->load->view('templates/header', $this->data);
      $this->load->view('SAdmin/PrivilegeGroup_view', $this->data);
      $this->load->view('templates/footer');
    }

    public function editPG($id)
    {
      $this->form_validation->set_rules('name', 'Privilege Group Name', 'required|trim');
      $this->form_validation->set_rules('mpg', 'Master Privilege Group', 'required|trim');

      if ($this->form_validation->run() === FALSE)
      {
        $this->data['values'] = $this->Privilege_model->get_pg($id);
        $this->data['listmpg'] = $this->Privilege_model->list_all_mpg();
        $this->data['title'] = 'Edit Privilege Group';
        $this->load->view('templates/header', $this->data);
        $this->load->view('SAdmin/EditPrivilegeGroup_view', $this->data);
        $this->load->view('templates/footer');
      }
      else
      {
       $this->Privilege_model->update_pg($id);
       redirect('Privilege/viewPG');
     }
   }

   public function viewDP()
   {
    $this->data['list'] = $this->Privilege_model->list_all_dp();
    $this->data['listnama'] = array();
    foreach ($this->data['list'] as $row):
      array_push($this->data['listnama'],$this->Privilege_model->get_pg_name($row->idprivilegegroup));
    endforeach;
    $this->data['title'] = 'Lihat Privilege Detail';
    $this->load->view('templates/header', $this->data);
    $this->load->view('SAdmin/DetailPrivilege_view', $this->data);
    $this->load->view('templates/footer');
  }

  public function editDP($id)
  {
    $this->form_validation->set_rules('name', 'Nama Menu', 'required|trim');
    $this->form_validation->set_rules('url', 'Page URL', 'required|trim');
    $this->form_validation->set_rules('pg', 'Nama Privilege Group', 'required|trim');

    if ($this->form_validation->run() === FALSE)
    {
      $this->data['values'] = $this->Privilege_model->get_dp($id);
      $this->data['listpg'] = $this->Privilege_model->list_all_pg();
      $this->data['title'] = 'Edit Detail Privilege';
      $this->load->view('templates/header', $this->data);
      $this->load->view('SAdmin/EditDetailPrivilege_view', $this->data);
      $this->load->view('templates/footer');
    }
    else
    {
      $this->Privilege_model->update_dp($id);
      redirect('Privilege/viewDP');
    }
  }

  public function editMPG($id)
  {
    $this->form_validation->set_rules('name', 'Master Privilege Group Name', 'required|trim');

    if ($this->form_validation->run() === FALSE)
    {
      $this->data['values'] = $this->Privilege_model->get_mpg($id);
      $this->data['title'] = 'Edit Master Privilege Group';
      $this->load->view('templates/header', $this->data);
      $this->load->view('SAdmin/EditMasterPrivilegeGroup_view', $this->data);
      $this->load->view('templates/footer');
    }
    else
    {
     $this->Privilege_model->update_mpg($id);
     redirect('Privilege/viewMPG');
   }
 }

 public function deleteMPG($id)
 {
  $this->Privilege_model->delete_mpg($id);
  redirect('Privilege/viewMPG');
}

public function deletePG($id)
{
  $this->Privilege_model->delete_pg($id);
  redirect('Privilege/viewPG');
}

public function deleteDP($id)
{
  $this->Privilege_model->delete_dp($id);
  redirect('Privilege/viewDP');
}

public function viewlala()
{
  $this->data['list'] = $this->Privilege_model->list_all_pg();
  $this->data['listnama'] = array();
  foreach ($this->data['list'] as $row):
    array_push($this->data['listnama'],$this->Privilege_model->get_mpg_name($row->masterprivilegegroupid));
  endforeach;
  $this->data['title'] = 'View Privilege Group';
  $this->load->view('templates/header', $this->data);
  $this->load->view('SAdmin/HunianShelter_view', $this->data);
  $this->load->view('templates/footer');
}
}
