<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Infografik_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

  function get_total_problem_year($month,$year,$institution='all'){
		$this->db->start_cache();
		$this->db->select('*');
		$this->db->from('masalah m');
		$this->db->where('MONTH(m.tanggalpengaduan)',$month);
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		$this->db->where('m.enable', 1);
		if($institution != 'all')
		{
			$this->db->where('m.idinstitution',$institution);
		}
		// $this->db->where('(m.recap=1 OR m.recap=0)');
		$this->db->stop_cache();

		// All problems
		$all = $this->db->count_all_results();

		// Finished
		$this->db->where('m.statusmasalah', 2);
		$fin = $this->db->count_all_results();

		// Processed
		$this->db->where('m.statusmasalah', 1);
		$pro = $this->db->count_all_results();

		$this->db->flush_cache();

		return array($all, $fin, $pro);
	}

  function get_total_money($month,$year,$institution='all'){
		$this->db->select_sum('m.uang');
		$this->db->from('masalah m');
		$this->db->where('MONTH(m.tanggalpengaduan)',$month);
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		$this->db->where('m.enable', 1);
		if($institution != 'all')
		{
			$this->db->where('m.idinstitution',$institution);
		}
		// $this->db->where('(m.recap=1 OR m.recap=0)');
		$query = $this->db->get();

		return $query;
	}

  function get_total_money_sektoral($month,$year,$institution='all'){
		$result = array('formal'=>0, 'informal'=>0);
		///informal
		$this->db->select_sum('m.uang');
		$this->db->from('masalah m');
		$this->db->join('jenispekerjaan j', 'j.idjenispekerjaan=m.idjenispekerjaan', 'left');
		$this->db->where('MONTH(m.tanggalpengaduan)',$month);
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		$this->db->where('m.enable', 1);
		$this->db->where('j.sektor', 1);
		if($institution != 'all')
		{
			$this->db->where('m.idinstitution',$institution);
		}
		// $this->db->where('(m.recap=1 OR m.recap=0)');
		$query = $this->db->get();
		$tmp = $query->row_array();
			if ($tmp['uang'] == ''){
				$tmp['uang'] = '0';
			}
		$result['informal'] = $tmp['uang'];

		///formal
		$this->db->select_sum('m.uang');
		$this->db->from('masalah m');
		$this->db->join('jenispekerjaan j', 'j.idjenispekerjaan=m.idjenispekerjaan', 'left');
		$this->db->where('MONTH(m.tanggalpengaduan)',$month);
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		$this->db->where('m.enable', 1);
		$this->db->where('j.sektor', 2);
		if($institution != 'all')
		{
			$this->db->where('m.idinstitution',$institution);
		}
		// $this->db->where('(m.recap=1 OR m.recap=0)');
		$query = $this->db->get();
		$tmp = $query->row_array();
			if ($tmp['uang'] == ''){
				$tmp['uang'] = '0';
			}
		$result['formal'] = $tmp['uang'];
		return $result;
	}


	function get_total_problem_a_year($year,$institution='all'){
		$this->db->select('*');
		$this->db->from('masalah m');
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		$this->db->where('m.enable', 1);
		if($institution != 'all')
		{
			$this->db->where('m.idinstitution',$institution);
		}
		// $this->db->where('(recap=1 OR recap=0)');
		$query = $this->db->count_all_results();

		return $query;
	}

	function get_problem_class_array($order=false) {
		if($order==true){
			$this->db->select('*')->from('klasifikasi')->order_by('id','asc');
			$query = $this->db->get();
		}
		else{
			$query = $this->db->get('klasifikasi');
		}

		if ( $query->num_rows() > 0 )
		{
			$response  = array();
			$buffer = array();
			foreach($query->result_array() as $row)
			{
				$buffer['value'] = $row['id'];
				$buffer['text'] = $row['name'];
				array_push($response,$buffer);
			}
			return $response;
		}
	}

  function get_finish_this_year($year) {
  $this->db->from('masalah');
  $this->db->where('YEAR(tanggalpengaduan)',$year);
  $this->db->where('statusmasalah',2);
  $this->db->where('enable',1);
  // $this->db->where('(recap=1 OR recap=0)');

  $query = $this->db->count_all_results();

  return $query;
}

function get_finish_within_year($year) {
  $this->db->from('masalah');
  $this->db->where('YEAR(tanggalpengaduan)',$year);
  $this->db->where('YEAR(tanggalpenyelesaian)',$year);
  $this->db->where('statusmasalah',2);
  $this->db->where('enable',1);
  // $this->db->where('(recap=1 OR recap=0)');

  $query = $this->db->count_all_results();

  return $query;
}

function get_total_money_year($year,$institution='all'){
  $this->db->select_sum('m.uang');
  $this->db->from('masalah m');
  $this->db->where('YEAR(m.tanggalpengaduan)',$year);
  $this->db->where('m.enable', 1);
	if($institution != 'all')
	{
		$this->db->where('m.idinstitution',$institution);
	}
  // $this->db->where('(m.recap=1 OR m.recap=0)');

  $query = $this->db->get();

  return $query;
}
function formatMoney($number, $fractional=false) {
  if ($fractional) {
    $number = sprintf('%.2f', $number);
  }
  while (true) {
    $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
    if ($replaced != $number) {
      $number = $replaced;
    } else {
      break;
    }
  }
  return $number;
}


}
