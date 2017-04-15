<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classification extends MY_Controller {

    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SAdmin/Classification_model');
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
        $this->data['list'] = $this->Classification_model->list_all_classification();
        $this->data['title'] = 'Classification Table';
        $this->load->view('templates/header', $this->data);
        $this->load->view('SAdmin/Classification_view', $this->data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $this->form_validation->set_rules('name', 'Classification Name', 'required|trim');

        if ($this->form_validation->run() === FALSE)
        {
            $this->data['title'] = 'Tambah Klasifikasi';
            $this->load->view('templates/header', $this->data);
            $this->load->view('SAdmin/AddClassification_view', $this->data);
            $this->load->view('templates/footer');
        }
        else
        {
            $this->Classification_model->post_new_classification();
            $this->session->set_flashdata('information', 'Data berhasil dimasukkan');
            $this->data['title'] = 'Tambah Klasifikasi';
            $this->load->view('templates/header', $this->data);
            $this->load->view('SAdmin/AddClassification_view', $this->data);
            $this->load->view('templates/footer');
        }
    }

    public function edit($id)
    {
      $this->form_validation->set_rules('name', 'Classification Name', 'required|trim');

          if ($this->form_validation->run() === FALSE)
          {
              $this->data['title'] = 'Edit Klasifikasi';
              $this->data['values'] =  $this->Classification_model->get_classification($id);
              $this->load->view('templates/header', $this->data);
              $this->load->view('SAdmin/EditClassification_view', $this->data);
              $this->load->view('templates/footer');
          }
          else
          {
              $this->Classification_model->update_classification($id);
              redirect('classification');
          }
      }

      public function delete($id)
      {
          $this->Classification_model->delete_classification($id);
          redirect('classification');
      }

      public function assign()
      {
          if ($this->session->userdata('institution') == 1) {
            $this->data['listinstitution'] = $this->Institution_model->list_active_institution();
          } else {
            $this->data['listinstitution'] = $this->Institution_model->get_institution($this->session->userdata('institution'));
          }
          $this->data['listklasifikasi'] = $this->Classification_model->list_all_classification();

          $this->data['title'] = 'Assign Klasifikasi';
          $this->load->view('templates/header', $this->data);
          $this->load->view('SAdmin/AssignKlasifikasi_view', $this->data);
          $this->load->view('templates/footer');
      }

      public function getKlasifikasiInstitution()
  		{
  				$this->data['listklasifikasiinstitusi'] = $this->Classification_model->get_klasifikasi_institution();
          $this->data['listklasifikasi'] = array();
  				foreach ($this->data['listklasifikasiinstitusi'] as $row):
  						array_push($this->data['listklasifikasi'],$this->Classification_model->get_classification($row->id));
  				endforeach;
          $complete_data = array();
          $i = 0;
          foreach ($this->data['listklasifikasi'] as $row):
              array_push($complete_data, (object) array("idklasifikasi" => $row->id, "nameklasifikasi" => $row->name, "isactive" => $this->data['listklasifikasiinstitusi'][$i]->isactive));
              $i = $i + 1;
          endforeach;
          echo json_encode($complete_data);
  		}

  		public function addKlasifikasiInstitution()
  		{
          $idinstitution = $this->input->post('idinstitution',TRUE);

          if($this->session->userdata('role') == '1' || $idinstitution == $this->session->userdata('institution')){
            $this->Classification_model->post_new_klasifikasi_institution($idinstitution);
          }
  				else {
            show_error("Access is forbidden.",403,"403 Forbidden");
          }
  		}

  		public function delKlasifikasiInstitution()
  		{
          $idinstitution = $this->input->post('idinstitution',TRUE);

          if($this->session->userdata('role') == '1' || $idinstitution == $this->session->userdata('institution')){
            $this->Classification_model->delete_klasifikasi_institution($idinstitution);
          }
          else {
            show_error("Access is forbidden.",403,"403 Forbidden");
          }
  		}

      public function checkKlasifikasiInstitution()
      {
          $exist = $this->Classification_model->check_klasifikasi_institution();
          echo json_encode($exist);
      }

}
