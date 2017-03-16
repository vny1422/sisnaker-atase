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
		$this->load->library('Pelaporan');

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
		$this->data['listshelter'] = $this->Shelter_model->query_shelter_institution($_SESSION['institution']);
		$this->data['listklasifikasi'] = $this->Perlindungan_model->get_klasifikasi_institution($_SESSION['institution']);

		$refresh = false;

		if(isset($_POST['submit-detailrekap'])) {
			$time	 = $this->input->post('time-detailrekap');
			$status  = $this->input->post('status-detailrekap');

			$laporan = new Pelaporan();
			$laporan->generateDetail($time,$status);
		}

		if(isset($_POST['submit-bulanrekap'])) {
			$dasar = $this->input->post('dasar-bulanrekap');
			$time  = $this->input->post('time-bulanrekap');

			$laporan = new Pelaporan();
			$laporan->generateBulananv2($time,$dasar,$this->data['namainstitusi']);
		}

		if(isset($_POST['submit-tahunrekap'])){
			$time = $this->input->post('time-tahunrekap');
			$lingkup = $this->input->post('lokasi-rekap');
			$list_shelter = $this->data['listshelter'];

			if($lingkup==0) $lingkup=null;

			$laporan = new Pelaporan();
			$laporan->generateTahunanv2($time,$lingkup,$list_shelter,$this->data['namainstitusi']);
		}

		if(isset($_POST['submit-uangrekap'])){
			$time = $this->input->post('time-uangrekap');
			$currency = $this->Currency_model->get_currency_name_institution($this->session->userdata('institution'));

			$laporan = new Pelaporan();
			$laporan->generateUang($time,$this->data['namainstitusi'],$currency->currencyname);
		}

		if(isset($_POST['submit-kelasrekap'])){
			$time = $this->input->post('time-kelasrekap');
			$katg = $this->input->post('status-kelasrekap');

			$laporan = new Pelaporan();
			$laporan->generateKelasv2($time,$katg,$this->data['namainstitusi']);
		}

		if(isset($_POST['submit-shelterrekap'])){
			$org = $this->input->post('status-shelterrekap');
			$time  = $this->input->post('time-shelterrekap');

			$laporan = new Pelaporan();
			$laporan->generateShelter($time,$org);
		}

		/// default or force refresh
		if (!$_POST || $refresh){
			$this->data['title'] = 'Rekap';
			$this->data['subtitle'] = 'Rekap Laporan';

			$this->load->view('templates/headerperlindungan', $this->data);
			$this->load->view('Perlindungan/RekapLaporan_view', $this->data);
			$this->load->view('templates/footerperlindungan');
		}
	}
}
