<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inputtype extends MY_Controller {

	private $data;

	public function __construct()
	{
		parent::__construct();
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
		$this->data['list'] = $this->Inputtype_model->list_all_inputtype();
		$this->data['title'] = 'Lihat Tipe Input';
		$this->load->view('templates/header', $this->data);
		$this->load->view('SAdmin/Inputtype_view', $this->data);
		$this->load->view('templates/footer');
	}

	public function add()
	{
		$this->form_validation->set_rules('name', 'Nama Tipe Input', 'required|trim');

		if ($this->form_validation->run() === FALSE)
		{
			$this->data['title'] = 'Tambah Tipe Input';
			$this->load->view('templates/header', $this->data);
			$this->load->view('SAdmin/AddInputType_view', $this->data);
			$this->load->view('templates/footer');
		}
		else
		{
			$this->Inputtype_model->post_new_inputtype();
			$this->session->set_flashdata('information', 'Data berhasil dimasukkan');
			$this->data['title'] = 'Tambah Tipe Input';
			$this->load->view('templates/header', $this->data);
			$this->load->view('SAdmin/AddInputType_view', $this->data);
			$this->load->view('templates/footer');
		}
	}

	public function edit($id)
	{
		$this->form_validation->set_rules('name', 'Nama Tipe Input', 'required|trim');

		if ($this->form_validation->run() === FALSE)
		{
			$this->data['values'] = $this->Inputtype_model->get_inputtype($id);
			$this->data['title'] = 'Edit Jenis Input';
			$this->load->view('templates/header', $this->data);
			$this->load->view('SAdmin/EditInputType_view', $this->data);
			$this->load->view('templates/footer');
		}
		else
		{
			$this->Inputtype_model->update_inputtype($id);
			redirect('Inputtype');
		}
	}

	public function delete($id)
	{
		$this->Inputtype_model->delete_inputtype($id);
		redirect('Inputtype');
	}

}
