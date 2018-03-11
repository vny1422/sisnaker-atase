<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends MY_Controller {

    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SAdmin/Media_model');
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
        $this->data['list'] = $this->Media_model->list_all_Media();
        $this->data['title'] = 'Media Table';
        $this->load->view('templates/header', $this->data);
        $this->load->view('SAdmin/Media_view', $this->data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $this->form_validation->set_rules('name', 'Media Name', 'required|trim');

        if ($this->form_validation->run() === FALSE)
        {
            $this->data['title'] = 'Tambah Media';
            $this->load->view('templates/header', $this->data);
            $this->load->view('SAdmin/AddMedia_view', $this->data);
            $this->load->view('templates/footer');
        }
        else
        {
            $this->Media_model->post_new_Media();
            $this->session->set_flashdata('information', 'Data berhasil dimasukkan');
            $this->data['title'] = 'Tambah Media';
            $this->load->view('templates/header', $this->data);
            $this->load->view('SAdmin/AddMedia_view', $this->data);
            $this->load->view('templates/footer');
        }
    }

    public function edit($id)
    {
      $this->form_validation->set_rules('name', 'Media Name', 'required|trim');

          if ($this->form_validation->run() === FALSE)
          {
              $this->data['title'] = 'Edit Media';
              $this->data['values'] =  $this->Media_model->get_Media($id);
              $this->load->view('templates/header', $this->data);
              $this->load->view('SAdmin/EditMedia_view', $this->data);
              $this->load->view('templates/footer');
          }
          else
          {
              $this->Media_model->update_Media($id);
              redirect('Media');
          }
      }

      public function delete($id)
      {
          $this->Media_model->delete_Media($id);
          redirect('Media');
      }

      public function assign()
      {
          if ($this->session->userdata('institution') == 1) {
            $this->data['listinstitution'] = $this->Institution_model->list_active_institution();
          } else {
            $this->data['listinstitution'] = $this->Institution_model->get_institution($this->session->userdata('institution'));
          }
          $this->data['listMedia'] = $this->Media_model->list_all_Media();

          $this->data['title'] = 'Assign Media';
          $this->load->view('templates/header', $this->data);
          $this->load->view('SAdmin/AssignMedia_view', $this->data);
          $this->load->view('templates/footer');
      }

      public function getMediaInstitution()
  		{
  				$this->data['listMediainstitusi'] = $this->Media_model->get_media_institution();
          $this->data['listMedia'] = array();
  				foreach ($this->data['listMediainstitusi'] as $row):
  						array_push($this->data['listMedia'],$this->Media_model->get_Media($row->id));
  				endforeach;
          $complete_data = array();
          $i = 0;
          foreach ($this->data['listMedia'] as $row):
              array_push($complete_data, (object) array("idMedia" => $row->id, "nameMedia" => $row->name, "isactive" => $this->data['listMediainstitusi'][$i]->isactive));
              $i = $i + 1;
          endforeach;
          echo json_encode($complete_data);
  		}

  		public function addMediaInstitution()
  		{
          $idinstitution = $this->input->post('idinstitution',TRUE);

          if($this->session->userdata('role') == '1' || $idinstitution == $this->session->userdata('institution')){
            $this->Media_model->post_new_media_institution($idinstitution);
          }
          else {
            show_error("Access is forbidden.",403,"403 Forbidden");
          }
  		}

  		public function delMediaInstitution()
  		{
          $idinstitution = $this->input->post('idinstitution',TRUE);

          if($this->session->userdata('role') == '1' || $idinstitution == $this->session->userdata('institution')){
            $this->Media_model->delete_media_institution($idinstitution);
          }
          else {
            show_error("Access is forbidden.",403,"403 Forbidden");
          }
  		}

      public function checkMediaInstitution()
      {
          $exist = $this->Media_model->check_media_institution();
          echo json_encode($exist);
      }
}
