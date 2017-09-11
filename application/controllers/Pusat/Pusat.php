<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pusat extends MY_Controller {

	private $data;

	public function __construct()
    {
			parent::__construct();
	    $this->load_sidebar();
	    $this->load->model('Pusat/Pusat_model');
	    $this->load->model('Endorsement/Paket_model');
	    $this->load->model('Perlindungan/Agency_model');
	    $this->load->model('SAdmin/Input_model');
			$this->load->model('SAdmin/Institution_model');
			$this->load->model('Perlindungan/Formulir_model');
			$this->load->model('Perlindungan/Perlindungan_model');
			$this->load->model('Perlindungan/Infografik_model');
			$this->load->model('Perlindungan/View_model');
			$this->load->model('Perlindungan/Kasus_model');
			$this->load->model('SAdmin/Currency_model');

	    $this->data['listdp'] = $this->listdp;
	    $this->data['usedpg'] = $this->usedpg;
	    $this->data['usedmpg'] = $this->usedmpg;
	    $this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
	    $this->data['namakantor'] = $this->namakantor->nama;
	    $this->data['sidebar'] = 'SAdmin/Sidebar';
    }

		public function index()
	  {
			$this->data['month'] = date('m');
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
			$this->data['datathisyear']           = $this->Perlindungan_model->get_problem_this_year($data['year']);
			$this->data['datafinishthisyear']     = $this->Perlindungan_model->get_finish_this_year($data['year']);
			$this->data['dataprocessthisyear']    = $this->Perlindungan_model->get_process_this_year($data['year']);

			/// this month
			$this->data['datathismonth']          = $this->Perlindungan_model->get_problem_this_month($data['month'],$data['year']);
			$this->data['datafinishthismonth']    = $this->Perlindungan_model->get_finish_this_month($data['month'],$data['year']);
			$this->data['dataprocessthismonth']   = $this->Perlindungan_model->get_process_this_month($data['month'],$data['year']);

			/// performance
			list($offname, $offpic, $offperform)           = $this->Perlindungan_model->get_officer_performance($data['year'], $petugas);
			$this->data['officername']            = $offname;
			$this->data['officerpicture']         = $offpic;
			$this->data['performance']            = $offperform;

			$this->data['year_performance']       = $this->Perlindungan_model->get_year_performance($data['year']);

			/// list tahun
			$this->data['tahundb']                = $this->Perlindungan_model->get_all_yeardb();

			/// kasus
			$this->data['kasusproses']            = $this->Perlindungan_model->get_all_problem_process();
			$this->data['kasusselesai']           = $this->Perlindungan_model->get_all_problem_finished();

			if($this->data['year_performance'] <= 50){
					$this->data['panel_color'] = 'panel-danger';
			} else {
					$this->data['panel_color'] = 'panel-success';
			}

			$currency = $this->Currency_model->get_currency_name_institution($this->session->userdata('institution'));
			$this->data['namacurrency'] = strtoupper($currency->currencyname);

			$this->data['institusi'] = $this->Institution_model->list_active_institution();

	    /// list tahun
	    $this->data['tahunpenempatan'] = $this->Pusat_model->get_all_year();

	    $this->data['title'] = 'DASHBOARD';
	    $this->data['subtitle'] = 'KANTOR PUSAT';
	    $this->load->view('templates/headerpusat', $this->data);
	    $this->load->view('Pusat/Pusat_view', $this->data);
	    $this->load->view('templates/footerpusat');
	  }

	  public function get_info_year_dashboard(){
	    $year = $this->input->post('y');
	    $month = $this->input->post('m');
			$institution = $this->input->post('i');

	    $all = array();

	    $year_jk = $this->Pusat_model->get_jk_this_year($year,$institution);
	    $total_year_jk = 0;
	    foreach ($year_jk as $jk) {
	      $total_year_jk += $jk->total;
	    }

	    $month_jk = $this->Pusat_model->get_jk_this_month($year,$month,$institution);
	    $total_month_jk = 0;
	    foreach ($month_jk as $jk) {
	      $total_month_jk += $jk->total;
	    }

	    $year_sektor = $this->Pusat_model->get_sektor_this_year($year,$institution);
	    $total_year_sektor = 0;
	    foreach ($year_sektor as $sektor) {
	      $total_year_sektor += $sektor->total;
	    }

	    $month_sektor = $this->Pusat_model->get_sektor_this_month($year,$month,$institution);
	    $total_month_sektor = 0;
	    foreach ($month_sektor as $sektor) {
	      $total_month_sektor += $sektor->total;
	    }

	    $iterm = range(1,12);
	    $nm_month = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
	      5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
	      9 => 'Sep', 10 => 'Okt', 11 => 'Nop', 12=> 'Des'
	      );
	    $listjp = [];
	    $listjpdb = $this->Pusat_model->get_list_jp_this_year($year,$institution);
	    foreach ($listjpdb as $jp) {
	      array_push($listjp, $jp->namajenispekerjaan);
	    }

	    $jppermonth = [];
	    for($i=0;$i<count($iterm);$i++){
	      $temp_1 = array('bulan' => $nm_month[$iterm[$i]]);
	      $tot = 0;
	      foreach($listjp as $jp){
	        $temp_1[$jp] = $this->Pusat_model->count_jp_this_month($year,$iterm[$i],$jp,$institution);
	        $tot += $temp_1[$jp];
	      }
	      $temp_1['total'] = $tot;
	      array_push($jppermonth, $temp_1);
	    }

	    array_push($all,$total_year_jk);
	    array_push($all,$year_jk);
	    array_push($all,$total_month_jk);
	    array_push($all,$month_jk);
	    array_push($all,$total_year_sektor);
	    array_push($all,$year_sektor);
	    array_push($all,$total_month_sektor);
	    array_push($all,$month_sektor);
	    array_push($all,$listjp);
	    array_push($all,$jppermonth);

	    echo json_encode($all);
	  }
}
