<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	private $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('SAdmin/User_model');
		$this->load->model('SAdmin/Institution_model');
		$this->load->model('SAdmin/Level_model');
		$this->load->model('SAdmin/Kantor_model');

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
			$this->data['list'] = $this->User_model->list_all_user();
		}
		else {
			$this->data['list'] = $this->User_model->list_all_user_by_institution($this->session->userdata('institution'));
		}
		$this->data['listnamainstitusi'] = array();
		foreach ($this->data['list'] as $row):
			array_push($this->data['listnamainstitusi'],$this->Institution_model->get_institution_name($row->idinstitution));
		endforeach;
		$this->data['listnamalevel'] = array();
		foreach ($this->data['list'] as $row):
			array_push($this->data['listnamalevel'],$this->Level_model->get_level_name($row->idlevel));
		endforeach;
		$this->data['listnamakantor'] = array();
		foreach ($this->data['list'] as $row):
			array_push($this->data['listnamakantor'],$this->Kantor_model->get_kantor_name($row->idkantor));
		endforeach;
		$this->data['title'] = 'Tabel User';
		$this->load->view('templates/header', $this->data);
		$this->load->view('SAdmin/User_view', $this->data);
		$this->load->view('templates/footer');
	}

	public function add()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('name', 'Full Name', 'required|trim');
		$this->form_validation->set_rules('institution', 'Institution', 'required');
		$this->form_validation->set_rules('level', 'Level', 'required');
		$this->form_validation->set_rules('kantor', 'Kantor', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			if($this->session->userdata('role') == '1')
			{
				$this->data['listinstitution'] = $this->Institution_model->list_active_institution();
				$this->data['listkantor'] = $this->Kantor_model->list_all_kantor();
			}
			else {
				$this->data['listinstitution'] = array();
				array_push($this->data['listinstitution'],$this->Institution_model->get_institution($this->session->userdata('institution')));
				$this->data['listkantor'] = $this->Kantor_model->list_all_kantor_institution($this->session->userdata('institution'));
			}
			$this->data['listlevel'] = $this->Level_model->list_all_level();
			$this->data['title'] = 'Add New User';
			$this->load->view('templates/header', $this->data);
			$this->load->view('SAdmin/AddUser_view', $this->data);
			$this->load->view('templates/footer');
		}
		else
		{
			$this->User_model->post_new_user();
			$this->session->set_flashdata('information', 'Data berhasil dimasukkan');
			if($this->session->userdata('role') == '1')
			{
				$this->data['listinstitution'] = $this->Institution_model->list_active_institution();
				$this->data['listkantor'] = $this->Kantor_model->list_all_kantor();
			}
			else {
				$this->data['listinstitution'] = array();
				array_push($this->data['listinstitution'],$this->Institution_model->get_institution($this->session->userdata('institution')));
				$this->data['listkantor'] = $this->Kantor_model->list_all_kantor_institution($this->session->userdata('institution'));
			}
			$this->data['listlevel'] = $this->Level_model->list_all_level();
			$this->data['title'] = 'Add New User';
			$this->load->view('templates/header', $this->data);
			$this->load->view('SAdmin/AddUser_view', $this->data);
			$this->load->view('templates/footer');
		}
	}

	public function edit($username)
	{
		$this->form_validation->set_rules('name', 'Full Name', 'required|trim');
		$this->form_validation->set_rules('institution', 'Institution', 'required');
		$this->form_validation->set_rules('level', 'Level', 'required');
		$this->form_validation->set_rules('kantor', 'Kantor', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			$this->data['values'] = $this->User_model->get_userid($username);
			if($this->session->userdata('role') == '1' || $this->data['values']->idinstitution == $this->session->userdata('institution'))
            {
				if($this->session->userdata('role') == '1')
				{
					$this->data['listinstitution'] = $this->Institution_model->list_active_institution();
					$this->data['listkantor'] = $this->Kantor_model->list_all_kantor();
				}
				else {
					$this->data['listinstitution'] = array();
					array_push($this->data['listinstitution'],$this->Institution_model->get_institution($this->session->userdata('institution')));
					$this->data['listkantor'] = $this->Kantor_model->list_all_kantor_institution($this->session->userdata('institution'));
				}
				$this->data['listlevel'] = $this->Level_model->list_all_level();
				$this->data['title'] = 'Edit User';
				$this->load->view('templates/header', $this->data);
				$this->load->view('SAdmin/EditUser_view', $this->data);
				$this->load->view('templates/footer');
			}
			else
            {
                show_error("Access is forbidden.",403,"403 Forbidden");
            }
		}
		else
		{
			$this->User_model->update_user($username);
			redirect('user');
		}
	}

	public function delete($username)
	{
		$this->data['values'] = $this->User_model->get_userid($username);
		if($this->session->userdata('role') == '1' || $this->data['values']->idinstitution == $this->session->userdata('institution'))
        {
			$this->User_model->delete_user($username);
			redirect('user');
		}
		else
        {
        	show_error("Access is forbidden.",403,"403 Forbidden");
        }
	}
}
