<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kantor extends MY_Controller {

	private $data;

	public function __construct()
    {
        parent::__construct();
        $this->load->model('SAdmin/Institution_model');
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
        if($this->session->userdata('role') == '1')
        {
            $this->data['list'] = $this->Kantor_model->list_all_kantor();
        }
        else
        {
            $this->data['list'] = $this->Kantor_model->list_all_kantor_institution($this->session->userdata('institution'));
        }
        $this->data['listnama'] = array();
        foreach ($this->data['list'] as $row):
            array_push($this->data['listnama'],$this->Institution_model->get_institution_name($row->idinstitution));
        endforeach;
        $this->data['title'] = 'Tabel Kantor';
        $this->load->view('templates/header', $this->data);
        $this->load->view('SAdmin/Kantor_view', $this->data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $this->form_validation->set_rules('name', 'Kantor Name', 'required|trim');
        $this->form_validation->set_rules('institution', 'Institution', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            if($this->session->userdata('role') == '1')
            {
                $this->data['listinstitution'] = $this->Institution_model->list_active_institution();
            }
            else {
                $this->data['listinstitution'] = array();
                array_push($this->data['listinstitution'],$this->Institution_model->get_institution($this->session->userdata('institution')));
            }
            $this->data['title'] = 'Add New Kantor';
            $this->load->view('templates/header', $this->data);
            $this->load->view('SAdmin/AddKantor_view', $this->data);
            $this->load->view('templates/footer');
        }
        else
        {
            $this->Kantor_model->post_new_kantor();
            $this->session->set_flashdata('information', 'Data berhasil dimasukkan');
            if($this->session->userdata('role') == '1')
            {
                $this->data['listinstitution'] = $this->Institution_model->list_active_institution();
            }
            else {
                $this->data['listinstitution'] = array();
                array_push($this->data['listinstitution'],$this->Institution_model->get_institution($this->session->userdata('institution')));
            }
            $this->data['title'] = 'Add New Kantor';
            $this->load->view('templates/header', $this->data);
            $this->load->view('SAdmin/AddKantor_view', $this->data);
            $this->load->view('templates/footer');
        }
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('name', 'Kantor Name', 'required|trim');
        $this->form_validation->set_rules('institution', 'Institution', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->data['values'] = $this->Kantor_model->get_kantor($id);
            if($this->session->userdata('role') == '1' || $this->data['values']->idinstitution == $this->session->userdata('institution'))
            {
                if($this->session->userdata('role') == '1')
                {
                    $this->data['listinstitution'] = $this->Institution_model->list_active_institution();
                }
                else {
                    $this->data['listinstitution'] = array();
                    array_push($this->data['listinstitution'],$this->Institution_model->get_institution($this->session->userdata('institution')));
                }
                $this->data['title'] = 'Edit Kantor';
                $this->load->view('templates/header', $this->data);
                $this->load->view('SAdmin/EditKantor_view', $this->data);
                $this->load->view('templates/footer');
            }
            else
            {
                show_error("Access is forbidden.",403,"403 Forbidden");
            }
        }
        else
        {
            $this->Kantor_model->update_kantor($id);
            redirect('kantor');
        }
    }

    public function delete($id)
    {
        $this->data['values'] = $this->Kantor_model->get_kantor($id);
        if($this->session->userdata('institution') == '1' || $this->data['values']->idinstitution == $this->session->userdata('institution'))
        {
            $this->Kantor_model->delete_kantor($id);
            redirect('kantor');
        }
        else
        {
            show_error("Access is forbidden.",403,"403 Forbidden");
        }
    }

}
