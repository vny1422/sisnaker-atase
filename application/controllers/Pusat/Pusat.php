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

	    /// list tahun
	    $this->data['tahunpenempatan'] = $this->Pusat_model->get_all_year();

	    $this->data['title'] = 'DASHBOARD';
	    $this->data['subtitle'] = 'ENDORSEMENT';
	    $this->load->view('templates/headerpusat', $this->data);
	    $this->load->view('Pusat/Pusat_view', $this->data);
	    $this->load->view('templates/footerpusat');
	  }

	  public function get_info_year_dashboard(){
	    $year = $this->input->post('y');
	    $month = $this->input->post('m');
	    $all = array();

	    $year_jk = $this->Pusat_model->get_jk_this_year($year);
	    $total_year_jk = 0;
	    foreach ($year_jk as $jk) {
	      $total_year_jk += $jk->total;
	    }

	    $month_jk = $this->Pusat_model->get_jk_this_month($year,$month);
	    $total_month_jk = 0;
	    foreach ($month_jk as $jk) {
	      $total_month_jk += $jk->total;
	    }

	    $year_sektor = $this->Pusat_model->get_sektor_this_year($year);
	    $total_year_sektor = 0;
	    foreach ($year_sektor as $sektor) {
	      $total_year_sektor += $sektor->total;
	    }

	    $month_sektor = $this->Pusat_model->get_sektor_this_month($year,$month);
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
	    $listjpdb = $this->Pusat_model->get_list_jp_this_year($year);
	    foreach ($listjpdb as $jp) {
	      array_push($listjp, $jp->namajenispekerjaan);
	    }

	    $jppermonth = [];
	    for($i=0;$i<count($iterm);$i++){
	      $temp_1 = array('bulan' => $nm_month[$iterm[$i]]);
	      $tot = 0;
	      foreach($listjp as $jp){
	        $temp_1[$jp] = $this->Pusat_model->count_jp_this_month($year,$iterm[$i],$jp);
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
