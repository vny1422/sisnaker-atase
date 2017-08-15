<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobtype extends MY_Controller {

	private $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('SAdmin/Jobtype_model');
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
		if($this->session->userdata('role') == '1'){
			$this->data['list'] = $this->Jobtype_model->list_all_jobtype();
		} else {
			$this->data['list'] = $this->Jobtype_model->list_all_jobtype_by_institution($this->session->userdata('institution'));
		}
		$this->data['listnama'] = array();
		foreach ($this->data['list'] as $row):
			array_push($this->data['listnama'],$this->Institution_model->get_institution_name($row->idinstitution));
		endforeach;
		$this->data['title'] = 'Tabel Jenis Pekerjaan';
		$this->load->view('templates/header', $this->data);
		$this->load->view('SAdmin/JobType_view', $this->data);
		$this->load->view('templates/footer');
	}

	public function add()
	{
		$this->form_validation->set_rules('name', 'Job Name', 'required|trim');
		$this->form_validation->set_rules('institution', 'Institution', 'required');
		$this->form_validation->set_rules('gaji', 'Gaji', 'required');

		if ($this->form_validation->run() !== FALSE)
		{
			$this->Jobtype_model->post_new_jobtype();
			$this->session->set_flashdata('information', 'Data berhasil dimasukkan');
		}
		
		if($this->session->userdata('role') == '1')
		{
			$this->data['listinstitution'] = $this->Institution_model->list_active_institution();
		}
		else
		{
			$this->data['listinstitution'] = array();
			array_push($this->data['listinstitution'],$this->Institution_model->get_institution($this->session->userdata('institution')));
		}	
		$this->data['title'] = 'Add New Job Type';
		$this->load->view('templates/header', $this->data);
		$this->load->view('SAdmin/AddJobType_view', $this->data);
		$this->load->view('templates/footer');
	}


	public function edit($id)
	{
		$this->form_validation->set_rules('name', 'Job Name', 'required|trim');
		$this->form_validation->set_rules('institution', 'Institution', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			$this->data['values'] = $this->Jobtype_model->get_jobtype($id);
			if($this->session->userdata('role') == '1' || $this->data['values']->idinstitution == $this->session->userdata('institution'))
            {
            	if($this->session->userdata('role') == '1')
            	{
            		$this->data['listinstitution'] = $this->Institution_model->list_active_institution();
            	}
            	else
            	{
            		$this->data['listinstitution'] = array();
					array_push($this->data['listinstitution'],$this->Institution_model->get_institution($this->session->userdata('institution')));
            	}
				$this->data['title'] = 'Edit Tipe Pekerjaan';
				$this->load->view('templates/header', $this->data);
				$this->load->view('SAdmin/EditJobType_view', $this->data);
				$this->load->view('templates/footer');
			}
			else
            {
                show_error("Access is forbidden.",403,"403 Forbidden");
            }
		}
		else
		{
			$this->Jobtype_model->update_jobtype($id);
			redirect('Jobtype');
		}
	}

	public function delete($id)
	{
		$this->data['values'] = $this->Jobtype_model->get_jobtype($id);

		if($this->session->userdata('role') == '1' || $this->data['values']->idinstitution == $this->session->userdata('institution'))
        {
			$this->Jobtype_model->delete_jobtype($id);
			redirect('Jobtype');
		}
		else
        {
        	show_error("Access is forbidden.",403,"403 Forbidden");
        }
	}

}
