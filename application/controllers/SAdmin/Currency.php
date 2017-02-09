<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Currency extends MY_Controller {

	private $data;

	public function __construct()
    {
        parent::__construct();
				$this->load->model('SAdmin/Currency_model');

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

    		$this->data['list'] = $this->Currency_model->list_all_currency();
				$this->data['title'] = 'Tabel Currency';
        $this->load->view('templates/header', $this->data);
        $this->load->view('SAdmin/Currency_view', $this->data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $this->form_validation->set_rules('name', 'Currency Name', 'required|trim');
        $this->form_validation->set_rules('kurs', 'Kurs', 'required|trim');

        if ($this->form_validation->run() === FALSE)
        {
            $this->data['title'] = 'Tambah Currency';
            $this->load->view('templates/header', $this->data);
            $this->load->view('SAdmin/AddCurrency_view', $this->data);
            $this->load->view('templates/footer');
        }
        else
        {
            $this->Currency_model->post_new_Currency();
            $this->session->set_flashdata('information', 'Data berhasil dimasukkan');
            $this->data['title'] = 'Tambah Currency';
            $this->load->view('templates/header', $this->data);
            $this->load->view('SAdmin/AddCurrency_view', $this->data);
            $this->load->view('templates/footer');
        }
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('name', 'Currency Name', 'required|trim');
        $this->form_validation->set_rules('kurs', 'Kurs', 'required|trim');

        if ($this->form_validation->run() === FALSE)
        {
            $this->data['values'] = $this->Currency_model->get_Currency($id);
            $this->data['title'] = 'Edit Currency';
            $this->load->view('templates/header', $this->data);
            $this->load->view('SAdmin/EditCurrency_view', $this->data);
            $this->load->view('templates/footer');
        }
        else
        {
            $this->Currency_model->update_Currency($id);
            redirect('Currency');
        }
    }

    public function delete($id)
    {
        $this->Currency_model->delete_Currency($id);
        redirect('Currency');
    }

}
