<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wilayah extends MY_Controller {

    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SAdmin/Wilayah_model');
        $this->load->model('SAdmin/Institution_model');

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
        $this->data['list'] = $this->Wilayah_model->list_all_wilayah();
        $this->data['title'] = 'Wilayah Table';
        $this->load->view('templates/header', $this->data);
        $this->load->view('SAdmin/Wilayah_view', $this->data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $this->form_validation->set_rules('name', 'Wilayah Name', 'required|trim');

        if ($this->form_validation->run() === FALSE)
        {
            $this->data['title'] = 'Tambah Wilayah';
            $this->load->view('templates/header', $this->data);
            $this->load->view('SAdmin/AddWilayah_view', $this->data);
            $this->load->view('templates/footer');
        }
        else
        {
            $this->Wilayah_model->post_new_wilayah();
            $this->session->set_flashdata('information', 'Data berhasil dimasukkan');
            $this->data['title'] = 'Tambah Wilayah';
            $this->load->view('templates/header', $this->data);
            $this->load->view('SAdmin/AddWilayah_view', $this->data);
            $this->load->view('templates/footer');
        }
    }

    public function edit($id)
    {
      $this->form_validation->set_rules('name', 'Wilayah Name', 'required|trim');

          if ($this->form_validation->run() === FALSE)
          {
              $this->data['title'] = 'Edit Wilayah';
              $this->data['values'] =  $this->Wilayah_model->get_wilayah($id);
              $this->load->view('templates/header', $this->data);
              $this->load->view('SAdmin/EditWilayah_view', $this->data);
              $this->load->view('templates/footer');
          }
          else
          {
              $this->Wilayah_model->update_wilayah($id);
              redirect('wilayah');
          }
      }

      public function delete($id)
      {
          $this->Wilayah_model->delete_wilayah($id);
          redirect('wilayah');
      }

      public function assign()
      {
          if ($this->session->userdata('institution') == 1) {
            $this->data['listinstitution'] = $this->Institution_model->list_active_institution();
          } else {
            $this->data['listinstitution'] = $this->Institution_model->get_institution($this->session->userdata('institution'));
          }
          $this->data['listwilayah'] = $this->Wilayah_model->list_all_wilayah();

          $this->data['title'] = 'Assign Wilayah';
          $this->load->view('templates/header', $this->data);
          $this->load->view('SAdmin/AssignWilayah_view', $this->data);
          $this->load->view('templates/footer');
      }

      public function getWilayahInstitution()
  		{
  				$this->data['listwilayahinstitusi'] = $this->Wilayah_model->get_wilayah_institution();
          $this->data['listwilayah'] = array();
  				foreach ($this->data['listwilayahinstitusi'] as $row):
  						array_push($this->data['listwilayah'],$this->Wilayah_model->get_wilayah($row->id));
  				endforeach;
          $complete_data = array();
          $i = 0;
          foreach ($this->data['listwilayah'] as $row):
              array_push($complete_data, (object) array("idwilayah" => $row->id, "namewilayah" => $row->name, "isactive" => $this->data['listwilayahinstitusi'][$i]->isactive));
              $i = $i + 1;
          endforeach;
          echo json_encode($complete_data);
  		}

  		public function addWilayahInstitution()
  		{
          $idinstitution = $this->input->post('idinstitution',TRUE);

          if($this->session->userdata('role') == '1' || $idinstitution == $this->session->userdata('institution')){
            $this->Wilayah_model->post_new_wilayah_institution($idinstitution);
          }
          else {
            show_error("Access is forbidden.",403,"403 Forbidden");
          }
  		}

  		public function delWilayahInstitution()
  		{
          $idinstitution = $this->input->post('idinstitution',TRUE);

          if($this->session->userdata('role') == '1' || $idinstitution == $this->session->userdata('institution')){
            $this->Wilayah_model->delete_wilayah_institution($idinstitution);
          }
          else {
            show_error("Access is forbidden.",403,"403 Forbidden");
          }
  		}

      public function checkWilayahInstitution()
      {
          $exist = $this->Wilayah_model->check_wilayah_institution();
          echo json_encode($exist);
      }

}
