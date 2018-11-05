<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpmi extends MY_Controller {

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
    }

    public function index()
    {
        
        $this->data['title']        = 'CPMI';

        $this->load->view('templates/header', $this->data);
        $this->load->view('Cpmi/Cpmi', $this->data);
        $this->load->view('templates/footer');
    }

}
