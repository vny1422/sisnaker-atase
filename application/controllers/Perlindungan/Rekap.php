<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap extends MY_Controller {

	private $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Perlindungan/Shelter_model');
		$this->load->model('Perlindungan/Perlindungan_model');
		$this->load->model('SAdmin/Currency_model');
		$this->load->model('SAdmin/Institution_model');
		$this->load->library('Pelaporan');

		$this->load_sidebar();
		$this->data['listdp'] = $this->listdp;
		$this->data['usedpg'] = $this->usedpg;
		$this->data['usedmpg'] = $this->usedmpg;
		$this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
		if(empty($this->namakantor->nama)){
			$this->data['namakantor'] = "";
		}
		else{
			$this->data['namakantor'] = $this->namakantor->nama;
		}
		$this->data['sidebar'] = 'SAdmin/Sidebar';
	}

	public function index()
	{
		if (!($this->session->userdata('role') <= 3 || $this->session->userdata('role') == 5))
	    {
	      show_error("Access is forbidden.",403,"403 Forbidden");
	    }

		$this->data['listshelter'] = $this->Shelter_model->query_shelter_institution($_SESSION['institution']);
		$this->data['listklasifikasi'] = $this->Perlindungan_model->get_klasifikasi_institution($_SESSION['institution']);

		$refresh = false;

		if(isset($_POST['submit-detailrekap'])) {
			$time	 = $this->input->post('time-detailrekap');
			$status  = $this->input->post('status-detailrekap');
			$idinstitution = $this->input->post('idinst');
			$namainstitusi = $this->input->post('namainst');

			$laporan = new Pelaporan();
			if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 5) {
				$laporan->generateDetail($time,$status,$idinstitution,$namainstitusi);
			} else {
				$laporan->generateDetail($time,$status,$_SESSION['institution'],$this->data['namainstitusi']);
			}
		}

		if(isset($_POST['submit-bulanrekap'])) {
			$dasar = $this->input->post('dasar-bulanrekap');
			$time  = $this->input->post('time-bulanrekap');
			$idinstitution = $this->input->post('idinst');
			$namainstitusi = $this->input->post('namainst');

			$laporan = new Pelaporan();
			if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 5) {
				$laporan->generateBulananv2($time,$dasar,$idinstitution,$namainstitusi);
			} else {
				$laporan->generateBulananv2($time,$dasar,$_SESSION['institution'],$this->data['namainstitusi']);
			}
		}

		if(isset($_POST['submit-tahunrekap'])){
			$time = $this->input->post('time-tahunrekap');
			$lingkup = $this->input->post('lokasi-rekap');
			$list_shelter = $this->Shelter_model->list_active_shelter();
			$idinstitution = $this->input->post('idinst');
			$namainstitusi = $this->input->post('namainst');

			if($lingkup==0) $lingkup=null;

			$laporan = new Pelaporan();
			if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 5) {
				$laporan->generateTahunanv2($time,$lingkup,$list_shelter,$idinstitution,$namainstitusi);
			} else {
				$laporan->generateTahunanv2($time,$lingkup,$list_shelter,$_SESSION['institution'],$this->data['namainstitusi']);
			}
		}

		if(isset($_POST['submit-uangrekap'])){
			$time = $this->input->post('time-uangrekap');
			$idinstitution = $this->input->post('idinst');
			$namainstitusi = $this->input->post('namainst');

			$laporan = new Pelaporan();
			if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 5) {
				$currency = $this->Currency_model->get_currency_name_institution($idinstitution);
				$laporan->generateUang($time,$idinstitution,$namainstitusi,$currency->currencyname);
			} else {
				$currency = $this->Currency_model->get_currency_name_institution($this->session->userdata('institution'));
				$laporan->generateUang($time,$_SESSION['institution'],$this->data['namainstitusi'],$currency->currencyname);
			}
		}

		if(isset($_POST['submit-kelasrekap'])){
			$time = $this->input->post('time-kelasrekap');
			$katg = $this->input->post('status-kelasrekap');
			$idinstitution = $this->input->post('idinst');
			$namainstitusi = $this->input->post('namainst');

			$laporan = new Pelaporan();
			if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 5) {
				$laporan->generateKelasv2($time,$katg,$idinstitution,$namainstitusi);
			} else {
				$laporan->generateKelasv2($time,$katg,$_SESSION['institution'],$this->data['namainstitusi']);
			}
		}

		if(isset($_POST['submit-shelterrekap'])){
			$org = $this->input->post('status-shelterrekap');
			$time  = $this->input->post('time-shelterrekap');
			$idinstitution = $this->input->post('idinst');
			$namainstitusi = $this->input->post('namainst');

			$laporan = new Pelaporan();
			$laporan->generateShelter($time,$org);
		}

		/// default or force refresh
		if (!$_POST || $refresh){
			$this->data['title'] = 'Rekap';
			$this->data['subtitle'] = 'Rekap Laporan';

			if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 5) {
				$this->data['listinstitusi'] = $this->Institution_model->list_active_institution();
			}

			$this->load->view('templates/headerperlindungan', $this->data);
			$this->load->view('Perlindungan/RekapLaporan_view', $this->data);
			$this->load->view('templates/footerperlindungan');
		}
	}

	function generateShelter()
	{
		$idinst = $this->input->post('idinst');

		$listshelter = $this->Shelter_model->query_shelter_institution($idinst);
		$listklasifikasi = $this->Perlindungan_model->get_klasifikasi_institution($idinst);

		echo json_encode(array($listshelter, $listklasifikasi));
	}
}
