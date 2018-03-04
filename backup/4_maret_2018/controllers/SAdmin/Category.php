<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller {

    private $data;

	public function __construct()
    {
        parent::__construct();
        $this->load->model('SAdmin/Category_model');

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
		$this->form_validation->set_rules('name', 'Nama Kategori', 'required|trim');

        if ($this->form_validation->run() === FALSE)
        {
            $this->data['title'] = 'Tambah Kategori Penempatan';
            $this->load->view('templates/header', $this->data);
            $this->load->view('SAdmin/AddCategoryPenempatan_view', $this->data);
            $this->load->view('templates/footer');
        }
        else
        {
            $this->Category_model->post_new_category('penempatan');
			$this->session->set_flashdata('information', 'Data berhasil dimasukkan');
			$this->data['title'] = 'Tambah Kategori Penempatan';
			$this->load->view('templates/header', $this->data);
			$this->load->view('SAdmin/AddCategoryPenempatan_view', $this->data);
			$this->load->view('templates/footer');
        }
	}

    public function addPerlindungan()
    {
        $this->form_validation->set_rules('name', 'Nama Kategori', 'required|trim');

        if ($this->form_validation->run() === FALSE)
        {
            $this->data['title'] = 'Tambah Kategori Perlindungan';
            $this->load->view('templates/header', $this->data);
            $this->load->view('SAdmin/AddCategoryPerlindungan_view', $this->data);
            $this->load->view('templates/footer');
        }
        else
        {
            $this->Category_model->post_new_category('perlindungan');
			$this->session->set_flashdata('information', 'Data berhasil dimasukkan');
			$this->data['title'] = 'Tambah Kategori Perlindungan';
			$this->load->view('templates/header', $this->data);
			$this->load->view('SAdmin/AddCategoryPerlindungan_view', $this->data);
			$this->load->view('templates/footer');
        }
    }
}
