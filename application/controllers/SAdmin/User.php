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
	}

	public function index()
	{
		if ($this->session->userdata('role') != 1 && $this->session->userdata('role') != 2)
		{
			show_error("Access is forbidden.",403,"403 Forbidden");
		}
		else
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
	}

	public function add()
	{
		if ($this->session->userdata('role') != 1 && $this->session->userdata('role') != 2)
		{
			show_error("Access is forbidden.",403,"403 Forbidden");
		}
		else
		{
			$this->form_validation->set_rules('username', 'Username', 'required|trim');
			$this->form_validation->set_rules('password', 'Password', 'required|trim');
			$this->form_validation->set_rules('name', 'Full Name', 'required|trim');
			$this->form_validation->set_rules('institution', 'Institution', 'required');
			$this->form_validation->set_rules('level', 'Level', 'required');
			//$this->form_validation->set_rules('kantor', 'Kantor', 'required');

			if ($this->form_validation->run() !== FALSE)
			{
				if ((!empty($this->input->post('kantor',TRUE)) || $this->input->post('level',TRUE) == 5))
				{
					$this->User_model->post_new_user();
					$this->session->set_flashdata('information', 'Data berhasil dimasukkan');
				}
				else {
					$this->session->set_flashdata('warning', 'Kantor harus diisi!');
				}
			}
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
		if ($this->session->userdata('role') != 1 && $this->session->userdata('role') != 2)
		{
			show_error("Access is forbidden.",403,"403 Forbidden");
		}
		else
		{
			$this->form_validation->set_rules('name', 'Full Name', 'required|trim');
			$this->form_validation->set_rules('institution', 'Institution', 'required');
			$this->form_validation->set_rules('level', 'Level', 'required');
			// $this->form_validation->set_rules('kantor', 'Kantor', 'required');

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
				if ((!empty($this->input->post('kantor',TRUE)) || $this->input->post('level',TRUE) == 5))
				{
					$this->User_model->update_user($username);
					redirect('user');
				}
				else {
					redirect('user');
				}
			}
		}
	}

	public function delete($username)
	{
		if ($this->session->userdata('role') != 1 && $this->session->userdata('role') != 2)
		{
			show_error("Access is forbidden.",403,"403 Forbidden");
		}
		else
		{
			$this->data['values'] = $this->User_model->get_userid($username);
			if($this->data['values']->idlevel == 1)
			{
				show_error("Access is forbidden.",403,"403 Forbidden");
			}
			elseif($this->session->userdata('role') == '1' || $this->data['values']->idinstitution == $this->session->userdata('institution'))
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

	public function profile()
	{
		$this->data['error'] = "";

		if (!empty($_POST) && !empty($_FILES))
		{
			$passbaru = NULL;
			$namapic = NULL;

			if(!empty($_POST['passlama']) && !empty($_POST['passbaru'])) {
				$user = $this->User_model->get_user($this->session->userdata('user'),$_POST['passlama']);
				if($user == NULL) {
					$this->data['error'] = "Password tidak valid.";
				} else {
					$passbaru = $this->input->post('passbaru',TRUE);
				}
			}

			if(!empty($_FILES['picture']['name'])) {
				$config['upload_path'] = './assets/images/';
				$config['allowed_types'] = 'jpg|png';
				$config['max_size']     = '4096';
				$config['max_width'] = '1024';
				$config['max_height'] = '768';
				$config['overwrite'] = TRUE;
				$config['remove_spaces'] = TRUE;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('picture'))
				{
					$this->data['error'] = $this->upload->display_errors('','');
				} else {
					$namapic = $this->upload->data('file_name');
				}
			}

			if($passbaru || $namapic) {
				$this->User_model->update_pass_profile($this->session->userdata('user'),$passbaru,$namapic);
			}
			if($this->data['error'] == "") {
				$this->session->set_flashdata('information', 'Update profil berhasil dilakukan');
			}
		}

		$this->data['values'] = $this->User_model->get_userid($this->session->userdata('user'));

		$this->data['title'] = 'Profile';
		$this->load->view('templates/header', $this->data);
		$this->load->view('Profile_view', $this->data);
		$this->load->view('templates/footer');
	}
}
