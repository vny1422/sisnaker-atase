<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Institution extends MY_Controller {

	private $data;

	public function __construct()
    {
        parent::__construct();
        $this->load->model('SAdmin/Institution_model');
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

    		$this->data['list'] = $this->Institution_model->list_all_institution();
				$this->data['listnama'] = array();
				foreach ($this->data['list'] as $row):
					array_push($this->data['listnama'],$this->Currency_model->get_currency_name($row->idcurrency));
				endforeach;
				$this->data['title'] = 'Tabel Institusi';
        $this->load->view('templates/header', $this->data);
        $this->load->view('SAdmin/Institution_view', $this->data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $this->form_validation->set_rules('name', 'Institution Name', 'required|trim');
        $this->form_validation->set_rules('type', 'Endorsement Type', 'required|trim');

        if ($this->form_validation->run() === FALSE)
        {
						$this->data['currency'] = $this->Currency_model->list_all_currency();
            $this->data['title'] = 'Tambah Institusi';
            $this->load->view('templates/header', $this->data);
            $this->load->view('SAdmin/AddInstitution_view', $this->data);
            $this->load->view('templates/footer');
        }
        else
        {
            $this->Institution_model->post_new_institution();
            $this->session->set_flashdata('information', 'Data berhasil dimasukkan');
            $this->data['title'] = 'Tambah Institusi';
            $this->load->view('templates/header', $this->data);
            $this->load->view('SAdmin/AddInstitution_view', $this->data);
            $this->load->view('templates/footer');
        }
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('name', 'Institution Name', 'required|trim');
        $this->form_validation->set_rules('type', 'Endorsement Type', 'required|trim');

        if ($this->form_validation->run() === FALSE)
        {
            $this->data['values'] = $this->Institution_model->get_institution($id);
            $this->data['title'] = 'Edit Institusi';
            $this->load->view('templates/header', $this->data);
            $this->load->view('SAdmin/EditInstitution_view', $this->data);
            $this->load->view('templates/footer');
        }
        else
        {
            $this->Institution_model->update_institution($id);
            redirect('institution');
        }
    }

    public function delete($id)
    {
        $this->Institution_model->delete_institution($id);
        redirect('institution');
    }

}
