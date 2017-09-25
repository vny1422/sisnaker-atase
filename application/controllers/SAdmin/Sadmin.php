<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sadmin extends MY_Controller {

	private $data;

	public function __construct()
    {
        parent::__construct();
		$this->load->model('SAdmin/User_model');
		$this->load->model('SAdmin/Institution_model');
		$this->load->model('Perlindungan/Perlindungan_model');
        $this->load->model('SAdmin/Kantor_model');
        $this->load->model('SAdmin/Currency_model');
        $this->load->model('Endorsement/Endorsement_model');

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
        if ($this->session->userdata('role') != 1)
        {
            show_error("Access is forbidden.",403,"403 Forbidden");
        }
		$this->data['list'] = $this->User_model->list_all_user();
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
            if(isset($row->idkantor)) {
                array_push($this->data['listnamakantor'],$this->Kantor_model->get_kantor_name($row->idkantor));
            } else {
                $object = new stdClass();
                $object->namakantor = "";
                array_push($this->data['listnamakantor'],$object);
            }
        endforeach;
		$this->data['title'] = 'Super Admin';
		$this->load->view('templates/header', $this->data);
		$this->load->view('SAdmin/SAdmin_view', $this->data);
		$this->load->view('templates/footer');
	}

	public function local()
	{
        /// PARAMETER PERLINDUNGAN
		$data['month']  = date('m');
        $data['year']   = date('Y');
        $petugas = array();
        $shelter = array();
        $petugasArr = $this->Perlindungan_model->get_officer_username($_SESSION['institution']);
        foreach ($petugasArr->result_array() as $row):
            array_push($petugas,$row['username']);
        endforeach;
        $shelterArr = $this->Perlindungan_model->get_shelter_id($_SESSION['institution']);
        foreach ($shelterArr->result_array() as $row):
            array_push($shelter,$row['id']);
        endforeach;

        /// this year
        $this->data['datathisyear']           = $this->Perlindungan_model->get_problem_this_year($data['year'],$_SESSION['institution']);
        $this->data['datafinishthisyear']     = $this->Perlindungan_model->get_finish_this_year($data['year'],$_SESSION['institution']);
        $this->data['dataprocessthisyear']    = $this->Perlindungan_model->get_process_this_year($data['year'],$_SESSION['institution']);

        /// this month
        $this->data['datathismonth']          = $this->Perlindungan_model->get_problem_this_month($data['month'],$data['year'],$_SESSION['institution']);
        $this->data['datafinishthismonth']    = $this->Perlindungan_model->get_finish_this_month($data['month'],$data['year'],$_SESSION['institution']);
        $this->data['dataprocessthismonth']   = $this->Perlindungan_model->get_process_this_month($data['month'],$data['year'],$_SESSION['institution']);

        /// performance
        list($offname, $offpic, $offperform)           = $this->Perlindungan_model->get_officer_performance($data['year'], $petugas);
        $this->data['officername']            = $offname;
        $this->data['officerpicture']         = $offpic;
        $this->data['performance']            = $offperform;

        $this->data['year_performance']       = $this->Perlindungan_model->get_year_performance($data['year'],$_SESSION['institution']);

        /// list tahun
        $this->data['tahundb']                = $this->Perlindungan_model->get_all_yeardb($_SESSION['institution']);

        /// kasus
        $this->data['kasusproses']            = $this->Perlindungan_model->get_all_problem_process($_SESSION['institution']);
        $this->data['kasusselesai']           = $this->Perlindungan_model->get_all_problem_finished($_SESSION['institution']);

        if($this->data['year_performance'] <= 50){
            $this->data['panel_color'] = 'panel-danger';
        } else {
            $this->data['panel_color'] = 'panel-success';
        }

        $currency = $this->Currency_model->get_currency_name_institution($this->session->userdata('institution'));
        $this->data['namacurrency'] = strtoupper($currency->currencyname);

        /// PARAMETER PENEMPATAN
        $this->data['month'] = date('m');
        /// list tahun
        $this->data['tahunpenempatan'] = $this->Endorsement_model->get_all_year();

		$this->data['title'] = 'DASHBOARD';
        $this->data['subtitle'] = 'PERLINDUNGAN';
        $this->data['subtitle2'] = 'ENDORSEMENT';
		$this->load->view('templates/headerperlindungan', $this->data);
		$this->load->view('SAdmin/Dashboard_view', $this->data);
		$this->load->view('templates/footerperlindungan');
	}
}
