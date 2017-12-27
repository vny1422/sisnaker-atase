<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Infografik extends MY_Controller {

  private $data;

  public function __construct()
  {
    parent::__construct();

    $this->load_sidebar();
    $this->data['listdp'] = $this->listdp;
    $this->data['usedpg'] = $this->usedpg;
    $this->data['usedmpg'] = $this->usedmpg;
    $this->data['sidebar'] = 'SAdmin/Sidebar';
    $this->load->model('Perlindungan/TKI_model');
    $this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
    $this->data['namakantor'] = $this->namakantor->nama;
    $this->load->model('Perlindungan/Infografik_model');
    $this->load->model('Perlindungan/Perlindungan_model');
    $this->load->model('SAdmin/Currency_model');
  }

  public function index()
  {
    $currency = $this->Currency_model->get_currency_name_institution($this->session->userdata('institution'));
    $this->data['namacurrency'] = strtoupper($currency->currencyname);
    
    $this->data['title'] = 'Infografik';
    $this->data['subtitle'] = 'Statistik Ketenagakerjaan Indonesia';
    $this->load->view('templates/headerperlindungan', $this->data);
    $this->load->view('Perlindungan/Infografik_view', $this->data);
    $this->load->view('templates/footerperlindungan');
  }

  public function get_info_year(){
    $year = $this->getJSONpost();
    $year = $year['y'];
    $all = array();

    list($year_problem,$month_problem,$year_money,$month_money,$ratio,$ratioW) = $this->count_info_year($year);
    $year_money = $this->Infografik_model->formatMoney($year_money);

    array_push($all,$year_problem);
    array_push($all,$month_problem);
    array_push($all,$year_money);
    array_push($all,$month_money);
    array_push($all,$ratio);
    array_push($all,$ratioW);

    echo json_encode($all);//json_encode($all);
  }

  public function get_kategori_year(){
    $year = $this->getJSONpost();
    //$year = 2016;
    $year = $year['y'];
    $category = $this->Infografik_model->get_problem_class_array(true);
    $cat_count = $this->Perlindungan_model->get_total_kategori_a_year($year,count($category));

    $categoryx = array();
    for($i=0;$i<count($category);$i++){
      array_push($categoryx,$category[$i]['text']);
      //$categoryx[intval($category[$i]['value'])] = $category[$i]['text'];
    }

    $result = array($categoryx,$cat_count);
    echo json_encode($result);
  }

  public function count_info_year($year) {

    $month = range(1,12);
    $nm_month = array(1=>'Jan', '2'=> 'Feb', '3' => 'Mar', 4 => 'Apr',
    5=> 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
    9 => 'Sep', 10 => 'Okt', 11 => 'Nop', 12=> 'Des'
  );

  $all_problem = array();
  $fin_problem = array();
  $pro_problem = array();
  $mon_money   = array();

  $month_problem = array();
  $month_money   = array();

  for($i=0;$i<count($month);$i++){

    list($all,$fin,$pro) = $this->Infografik_model->get_total_problem_year($month[$i],$year);
    $mon_money = $this->Infografik_model->get_total_money($month[$i],$year);
    $mon_money_sektoral = $this->Infografik_model->get_total_money_sektoral($month[$i],$year);
    $uang = $mon_money->row_array();
    if ($uang['uang'] == ''){
      $uang['uang'] = '0';
    }

    $temporary = array(
      'bulan' => $nm_month[$month[$i]],
      'total' => $all,
      'fin' => $fin,
      'pro' => $pro
    );

    $temp_money = array(
      'bulan' => $nm_month[$month[$i]],
      'uang'	=> $uang['uang'],
      'formal' => $mon_money_sektoral['formal'],
      'informal' => $mon_money_sektoral['informal']
    );


    array_push($month_problem, $temporary);
    array_push($month_money,$temp_money);
  }

  $year_total_problem = $this->Infografik_model->get_total_problem_a_year($year);
  $year_total_finish = $this->Infografik_model->get_finish_this_year($year);
  $year_total_finish_within = $this->Infografik_model->get_finish_within_year($year);
  $year_money = $this->Infografik_model->get_total_money_year($year);
  $year_total_money   = $year_money->row_array();

  $ratio = ($year_total_finish / $year_total_problem)*100;
  $ratio = round($ratio,1);
  $ratiowithin = ($year_total_finish_within / $year_total_problem)*100;
  $ratiowithin = round($ratiowithin,1);

  return array($year_total_problem,$month_problem,$year_total_money['uang'],$month_money, $ratio,$ratiowithin);
}



function getJSONpost(){
  $input = $this->input->post();
  if( isset( $_SERVER['CONTENT_TYPE'] ) && strpos( $_SERVER['CONTENT_TYPE'], "application/json" ) !== false )
  {
    $input = json_decode(trim(file_get_contents( 'php://input' ) ), true );
  }
  return $input;
}

}
