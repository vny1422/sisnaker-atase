<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Level extends MY_Controller {

	private $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('SAdmin/Level_model');
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
		$this->data['list'] = $this->Level_model->list_all_level();
		$this->data['title'] = 'View Level';
		$this->load->view('templates/header', $this->data);
		$this->load->view('SAdmin/Level_view', $this->data);
		$this->load->view('templates/footer');
	}

	public function add()
	{
		$this->form_validation->set_rules('name', 'Level Name', 'required|trim');

		if ($this->form_validation->run() === FALSE)
		{
			$this->data['title'] = 'Add Level';
			$this->load->view('templates/header', $this->data);
			$this->load->view('SAdmin/AddLevel_view', $this->data);
			$this->load->view('templates/footer');
		}
		else
		{
			$this->Level_model->post_new_level();
			$this->session->set_flashdata('information', 'Data berhasil dimasukkan');
			$this->data['title'] = 'Add Level';
			$this->load->view('templates/header', $this->data);
			$this->load->view('SAdmin/AddLevel_view', $this->data);
			$this->load->view('templates/footer');
		}
	}

	public function edit($id)
	{
		$this->form_validation->set_rules('name', 'Institution Name', 'required|trim');
		$this->form_validation->set_rules('type', 'Endorsement Type', 'required|trim');

		if ($this->form_validation->run() === FALSE)
		{
			$this->data['values'] = $this->Level_model->get_level($id);
			$this->data['title'] = 'Edit Level';
			$this->load->view('templates/header', $this->data);
			$this->load->view('SAdmin/EditLevel_view', $this->data);
			$this->load->view('templates/footer');
		}
		else
		{
			$this->Level_model->update_level();
			redirect('Level');
		}
	}

	public function delete($id)
	{
		$this->Level_model->delete_level($id);
		redirect('Level');
	}

	public function assign()
	{
		$this->data['listlevel'] = $this->Level_model->list_all_level();
		$this->data['listdpriv'] = $this->Privilege_model->list_all_dp();

		$this->data['listnamapg'] = array();
		foreach ($this->data['listdpriv'] as $row):
			array_push($this->data['listnamapg'],$this->Privilege_model->get_pg_name($row->idprivilegegroup));
		endforeach;

		$this->data['title'] = 'Assign Level';
		$this->load->view('templates/header', $this->data);
		$this->load->view('SAdmin/AssignLevel_view', $this->data);
		$this->load->view('templates/footer');
	}

	public function getLevelDetail()
	{
		$this->data['listleveldetail'] = $this->Level_model->get_level_detail();
		$this->data['listdpriv'] = array();
		foreach ($this->data['listleveldetail'] as $row):
			array_push($this->data['listdpriv'],$this->Privilege_model->get_dp($row->idprivilege));
		endforeach;

		$this->data['listnamapg'] = array();
		foreach ($this->data['listdpriv'] as $row):
			array_push($this->data['listnamapg'],$this->Privilege_model->get_pg_name($row->idprivilegegroup));
		endforeach;

		$complete_data = array();
		$i = 0;
		foreach ($this->data['listdpriv'] as $row):
			array_push($complete_data, (object) array("idprivilege" => $row->idprivilege, "menuname" => $row->menuname, "pageurl" => $row->pageurl, "namepg" => $this->data['listnamapg'][$i]->privilegegroupname));
		$i = $i + 1;
		endforeach;
		echo json_encode($complete_data);
	}

	public function addLevelDetail()
	{
		$this->Level_model->post_new_level_detail();
	}

	public function delLevelDetail()
	{
		$this->Level_model->delete_level_detail();
	}

	public function checkLevelDetail()
	{
		$exist = $this->Level_model->check_level_detail();
		echo json_encode($exist);
	}

}
