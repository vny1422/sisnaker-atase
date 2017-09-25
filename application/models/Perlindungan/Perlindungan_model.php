<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perlindungan_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function get_officer_username($idinstitution) {
		$this->db->select('username');
		$this->db->from('user');
		if ($idinstitution != 'all')
		{
			$this->db->where('idinstitution',$idinstitution);
		}
		$where = '(idlevel = 3)';
		$this->db->where($where);
		$query = $this->db->get();

		return $query;
	}

	function get_shelter_id($idinstitution) {
		$this->db->select('id');
		$this->db->from('shelter');
		if ($idinstitution != 'all')
		{
			$this->db->where('idinstitution',$idinstitution);
		}
		$this->db->where('isactive',1);
		$query = $this->db->get();

		return $query;
	}

	function get_problem_this_month($month,$year,$institution = 'all') {
		$this->db->from('masalah');
		if ($institution != 'all')
		{
			$this->db->where('idinstitution',$institution);
		}
		$this->db->where('MONTH(tanggalpengaduan)',$month);
		$this->db->where('YEAR(tanggalpengaduan)',$year);
		$this->db->where('enable',1);

		$query = $this->db->count_all_results();


		return $query;
	}

	function get_problem_this_year($year,$institution = 'all') {
		$this->db->from('masalah');
		$this->db->where('YEAR(tanggalpengaduan)',$year);
		$this->db->where('enable',1);
		if ($institution != 'all')
		{
			$this->db->where('idinstitution',$institution);
		}
		$query = $this->db->count_all_results();

		return $query;
	}

	// function get_problem_kdei_this_year($year) {
	// 	$this->db->from('masalah');
	// 	$this->db->where('YEAR(tanggalpengaduan)',$year);
	// 	$this->db->where('enable',1);
	// 	$this->db->where('recap',1);

	// 	$query = $this->db->count_all_results();

	// 	return $query;
	// }

	// function get_problem_shared_this_year($year) {
	// 	$this->db->from('masalah');
	// 	$this->db->where('YEAR(tanggalpengaduan)',$year);
	// 	$this->db->where('enable',1);
	// 	$this->db->where('recap',0);

	// 	$query = $this->db->count_all_results();

	// 	return $query;
	// }

	// function get_problem_cc_this_year($year) {
	// 	$this->db->from('masalah');
	// 	$this->db->where('YEAR(tanggalpengaduan)',$year);
	// 	$this->db->where('enable',1);
	// 	$this->db->where('recap',2);

	// 	$query = $this->db->count_all_results();

	// 	return $query;
	// }

	function get_finish_this_year($year,$institution = 'all') {
		$this->db->from('masalah');
		$this->db->where('YEAR(tanggalpengaduan)',$year);
		$this->db->where('statusmasalah',2);
		$this->db->where('enable',1);
		//$this->db->where('(recap=1 OR recap=0)');
		if ($institution != 'all')
		{
			$this->db->where('idinstitution',$institution);
		}
		$query = $this->db->count_all_results();

		return $query;
	}

	function get_finish_within_year($year,$institution = 'all') {
		$this->db->from('masalah');
		$this->db->where('YEAR(tanggalpengaduan)',$year);
		$this->db->where('YEAR(tanggalpenyelesaian)',$year);
		$this->db->where('statusmasalah',2);
		$this->db->where('enable',1);
		if ($institution != 'all')
		{
			$this->db->where('idinstitution',$institution);
		}
		//$this->db->where('(recap=1 OR recap=0)');

		$query = $this->db->count_all_results();

		return $query;
	}

	function get_process_this_year($year,$institution = 'all') {
		$this->db->from('masalah');
		$this->db->where('YEAR(tanggalpengaduan)', $year);
		$this->db->where('statusmasalah',1);
		$this->db->where('enable',1);
		if ($institution != 'all')
		{
			$this->db->where('idinstitution',$institution);
		}
		//$this->db->where('(recap=1 OR recap=0)');

		$query = $this->db->count_all_results();

		return $query;
	}

	function get_finish_this_month($month,$year,$institution = 'all') {
		$this->db->from('masalah');
		$this->db->where('MONTH(tanggalpengaduan)',$month);
		$this->db->where('YEAR(tanggalpengaduan)', $year);
		$this->db->where('statusmasalah',2);
		$this->db->where('enable',1);
		if ($institution != 'all')
		{
			$this->db->where('idinstitution',$institution);
		}
		//$this->db->where('(recap=1 OR recap=0)');

		$query = $this->db->count_all_results();

		return $query;
	}

	function get_process_this_month($month,$year,$institution = 'all') {
		$this->db->from('masalah');
		$this->db->where('MONTH(tanggalpengaduan)',$month);
		$this->db->where('YEAR(tanggalpengaduan)', $year);
		$this->db->where('statusmasalah',1);
		$this->db->where('enable',1);
		if ($institution != 'all')
		{
			$this->db->where('idinstitution',$institution);
		}
		//$this->db->where('(recap=1 OR recap=0)');

		$query = $this->db->count_all_results();

		return $query;
	}

	function get_officer_performance($year,$petugas) {
		$performance = array();
		$officername = array();
		$officerpic = array();

		foreach ($petugas as $nama) {
			/* Get Officer Name */
			$this->db->from('user');
			$this->db->where('username', $nama);
			$obj = $this->db->get()->row();

			/* All Problem */
			$this->db->from('masalah');
			$this->db->where('petugaspenanganan', $nama);
			$this->db->where('YEAR(tanggalpengaduan)', $year);
			$this->db->where('enable',1);
			$all = $this->db->count_all_results();

			/* Unfinished Problem */
			$this->db->from('masalah');
			$this->db->where('petugaspenanganan', $nama);
			$this->db->where('YEAR(tanggalpengaduan)', $year);
			$this->db->where('statusmasalah', 2);
			$this->db->where('enable',1);
			$finished = $this->db->count_all_results();

			$rat=0;
			if($all != 0){
				$rat = ($finished/$all)*100;
			}

			$performance[$nama] = array($all,$rat, $finished, $all-$finished);
			$officername[$nama] = $obj->name;
			$officerpic[$nama] = $obj->picture;
		}

		return array($officername, $officerpic, $performance);
	}

	function get_shelter_performance($year, $shelter) {
		$performance = array();
		$sheltername = array();

		foreach($shelter as $idshelter) {
			/* Get Shelter Name */
			$this->db->from('shelter');
			$this->db->where('id', $idshelter);
			$obj = $this->db->get()->row();

			/* All Problem */
			$this->db->from('masalah');
			$this->db->where('idshelter', $idshelter);
			$this->db->where('YEAR(tanggalpengaduan)', $year);
			$this->db->where('enable',1);
			$all = $this->db->count_all_results();

			/* Unfinished Problem */
			$this->db->from('masalah');
			$this->db->where('idshelter', $idshelter);
			$this->db->where('YEAR(tanggalpengaduan)', $year);
			$this->db->where('statusmasalah', 2);
			$this->db->where('enable',1);
			$finished = $this->db->count_all_results();

			$rat=0;
			if($all != 0){
				$rat = ($finished/$all)*100;
			}


			$performance[$idshelter] = array($all,$rat, $finished, $all-$finished);
			$sheltername[$idshelter] = $obj->name;
		}

		return array($sheltername, $performance);
	}

	function get_year_performance($year,$institution = 'all') {
		$this->db->from('masalah');
		$this->db->where('YEAR(tanggalpengaduan)',$year);
		$this->db->where('enable', 1);
		//$this->db->where('(recap=1 OR recap=0)');
		$all = $this->db->count_all_results();

		$this->db->from('masalah');
		$this->db->where('YEAR(tanggalpengaduan)',$year);
		$this->db->where('statusmasalah', 2);
		$this->db->where('enable', 1);
		if ($institution != 'all')
		{
			$this->db->where('idinstitution',$institution);
		}
		//$this->db->where('(recap=1 OR recap=0)');
		$finished = $this->db->count_all_results();

		$performance=0;
		if($all != 0){
			$performance = ($finished/$all)*100;
		}

		return $performance;
	}

	function get_officer_problem_process($petugas) {
		$this->db->select('m.idmasalah, m.tanggalpengaduan, t.namatki, t.paspor, k.warna, m.statustki');
		$this->db->select('k.klasifikasi, j.jenis, m.keyword');
		$this->db->select('count(t.idtki) as jumlah, DATEDIFF(CURDATE(), m.tanggalpengaduan ) as lama');
		$this->db->from('masalah m, tki t, klasifikasi k, jenis j');
		$this->db->where('m.idmasalah = t.idmasalah');
		$this->db->where('m.idklasifikasi = k.idklasifikasi');
		$this->db->where('m.idjenis = j.idjenis');
		$this->db->where('m.petugaspenanganan',$petugas);
		$this->db->where('m.statusmasalah',1);
		$this->db->where('m.enable',1);
		$this->db->group_by('m.idmasalah');
		$this->db->order_by('m.tanggalpengaduan','DESC');
		$query = $this->db->get();

		return $query;
	}

	function get_officer_problem_finished($petugas) {
		$this->db->select('m.idmasalah, m.tanggalpengaduan, t.namatki, t.paspor, k.warna, m.statustki');
		$this->db->select('k.klasifikasi, j.jenis, m.keyword');
		$this->db->select('count(t.idtki) as jumlah, DATEDIFF(m.tanggalpenyelesaian, m.tanggalpengaduan ) as lama');
		$this->db->from('masalah m, tki t, klasifikasi k, jenis j');
		$this->db->where('m.idmasalah = t.idmasalah');
		$this->db->where('m.idklasifikasi = k.idklasifikasi');
		$this->db->where('m.idjenis = j.idjenis');
		$this->db->where('m.petugaspenanganan',$petugas);
		$this->db->where('m.statusmasalah',2);
		$this->db->where('m.enable',1);
		$this->db->group_by('m.idmasalah');
		$this->db->order_by('m.tanggalpengaduan','DESC');
		$query = $this->db->get();

		return $query;
	}

	function get_all_problem_process($institution = 'all') {
		$this->db->select('m.idmasalah, m.tanggalpengaduan, t.namatki, t.paspor, m.statustki,i.nameinstitution');
		$this->db->select('k.name AS klasifikasi, j.namajenispekerjaan AS jenis, u.name AS nama, m.keyword');
		$this->db->select('count(t.idtkimasalah) AS jumlah, DATEDIFF(CURDATE(), m.tanggalpengaduan) AS lama');
		$this->db->from('institution i, masalah m, tkimasalah t, klasifikasi k, jenispekerjaan j, user u');
		$this->db->where('m.idmasalah = t.idmasalah');
		$this->db->where('m.idklasifikasi = k.id');
		$this->db->where('m.idjenispekerjaan = j.idjenispekerjaan');
		$this->db->where('m.petugaspenanganan = u.username');
		$this->db->where('m.petugaspenanganan = u.username');
		$this->db->where('m.statusmasalah',1);
		if ($institution != 'all')
		{
			$this->db->where('m.idinstitution',$institution);
		}
		$this->db->where('m.enable',1);
		$this->db->group_by('m.idmasalah');
		$this->db->order_by('m.tanggalpengaduan','DESC');
		$query = $this->db->get();

		return $query;
	}

	function get_all_problem_finished($institution = 'all') {
		$this->db->select('m.idmasalah, m.tanggalpengaduan, t.namatki, t.paspor, m.statustki,i.nameinstitution');
		$this->db->select('k.name AS klasifikasi, j.namajenispekerjaan AS jenis, u.name AS nama, m.keyword');
		$this->db->select('count(t.idtkimasalah) AS jumlah, DATEDIFF(CURDATE(), m.tanggalpengaduan) AS lama');
		$this->db->from('masalah m, tkimasalah t, klasifikasi k, jenispekerjaan j, user u,institution i');
		$this->db->where('m.idmasalah = t.idmasalah');
		$this->db->where('m.idklasifikasi = k.id');
		if ($institution != 'all')
		{
			$this->db->where('m.idinstitution',$institution);
		}
		$this->db->where('m.idjenispekerjaan = j.idjenispekerjaan');
		$this->db->where('m.petugaspenanganan = u.username');
		$this->db->where('m.statusmasalah',2);
		$this->db->where('m.enable',1);
		$this->db->group_by('m.idmasalah');
		$this->db->order_by('m.tanggalpengaduan','DESC');
		$query = $this->db->get();

		return $query;
	}

	function get_problem_officer_detail($id) {
		$this->db->select('idshelter');
		$this->db->from('masalah_has_shelter');
		$this->db->where('idmasalah',$id);
		$where_clause = $this->db->get_compiled_select();

		$this->db->select('m.idmasalah, s.name AS organisasi, m.nomormasalah, me.name AS media');
		$this->db->select('m.namapelapor, m.teleponpelapor, m.alamatpelapor');
		$this->db->select('m.tanggalpengaduan, m.penerimapengaduan, u.name as petugaspenanganan');
		$this->db->select('m.tanggalmasuktaiwan, m.agensi, m.cpagensi');
		$this->db->select('m.teleponagensi, m.pptkis, m.majikan, k.name AS klasifikasi');
		$this->db->select('j.namajenispekerjaan AS jenis, j.sektor, m.statustki, m.permasalahan');
		$this->db->select('m.tuntutan, m.uang, m.statusmasalah');
		$this->db->select('m.tanggalpenyelesaian, m.agid, cur.currencyname');
		$this->db->from('masalah m, shelter s, user u, jenispekerjaan j, klasifikasi k, media me, currency cur');
		$this->db->join('institution', 'm.idinstitution = institution.idinstitution');
		$this->db->where('m.idmasalah',$id);
		$this->db->where("`s`.`id` = ($where_clause)", NULL, FALSE);
		$this->db->where('m.idjenispekerjaan = j.idjenispekerjaan');
		$this->db->where('m.idklasifikasi = k.id');
		$this->db->where('m.idmedia = me.id');
		$this->db->where('m.petugaspenanganan = u.username');
		$this->db->where('institution.idcurrency = cur.idcurrency');
		$query_problem = $this->db->get();

		$this->db->select('t.idtkimasalah, t.namatki, t.jk, t.paspor, t.arc, t.handphone');
		$this->db->select('t.alamatindonesia, t.alamattaiwan');
		$this->db->from('tkimasalah t');
		$this->db->where('t.idmasalah',$id);
		$query_tki = $this->db->get();

		$this->db->select('filename');
		$this->db->from('file');
		$this->db->where('idmasalah',$id);
		$query_file = $this->db->get();

		return array($query_problem,$query_tki,$query_file);
	}

	function get_total_problem_year($month,$year,$institution=NULL){
		$this->db->start_cache();
		$this->db->select('*');
		$this->db->from('masalah m');
		if($institution)
		{
			$this->db->where('m.idinstitution', $institution);
		}
		$this->db->where('MONTH(m.tanggalpengaduan)',$month);
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		$this->db->where('m.enable', 1);
		$this->db->where('(m.recap=1 OR m.recap=0)');
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

	function get_total_problem_a_year($year){
		$this->db->select('*');
		$this->db->from('masalah m');
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		$this->db->where('m.enable', 1);
		$this->db->where('(recap=1 OR recap=0)');
		$query = $this->db->count_all_results();

		return $query;
	}

	function get_total_kategori_a_year($year,$cnt){
		$array = array();
		$this->db->start_cache();
		$this->db->select('*');
		$this->db->from('masalah m');
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		$this->db->where('m.enable', 1);
		$this->db->stop_cache();

		for($i=1;$i<=$cnt;$i++){
			$this->db->where('m.idklasifikasi', $i);
			$query = $this->db->count_all_results();
			array_push($array,$query);
		}

		$this->db->flush_cache();
		return $array;
	}

	function get_total_money($month,$year,$idinstitution=NULL){
		$this->db->select_sum('m.uang');
		$this->db->from('masalah m');
		$this->db->where('MONTH(m.tanggalpengaduan)',$month);
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		if($idinstitution) {
			$this->db->where('m.idinstitution',$idinstitution);
		}
		$this->db->where('m.enable', 1);
		$query = $this->db->get();

		return $query;
	}

	function get_total_money_sektoral($month,$year,$institution = NULL){
		$result = array('formal'=>0, 'informal'=>0);
		///informal
		$this->db->select_sum('m.uang');
		$this->db->from('masalah m');
		$this->db->where('MONTH(m.tanggalpengaduan)',$month);
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		$this->db->where('m.enable', 1);
		$this->db->where('m.sektor', 1);
		if($institution)
		{
			$this->db->where('m.idinstitution', $institution);
		}
		$query = $this->db->get();
		$tmp = $query->row_array();
			if ($tmp['uang'] == ''){
				$tmp['uang'] = '0';
			}
		$result['informal'] = $tmp['uang'];

		///formal
		$this->db->select_sum('m.uang');
		$this->db->from('masalah m');
		$this->db->where('MONTH(m.tanggalpengaduan)',$month);
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		$this->db->where('m.enable', 1);
		$this->db->where('m.sektor', 2);
		$this->db->where('(m.recap=1 OR m.recap=0)');
		$query = $this->db->get();
		$tmp = $query->row_array();
			if ($tmp['uang'] == ''){
				$tmp['uang'] = '0';
			}
		$result['formal'] = $tmp['uang'];
		return $result;
	}

	function get_total_money_year($year,$idinstitution=NULL){
		$this->db->select_sum('m.uang');
		$this->db->from('masalah m');
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		if($idinstitution) {
			$this->db->where('m.idinstitution',$idinstitution);
		}
		$this->db->where('m.enable', 1);

		$query = $this->db->get();

		return $query;
	}

	function get_all_yeardb($idinstitution=NULL){
		$this->db->distinct();
		$this->db->select('YEAR(tanggalpengaduan) as tahun');
		$this->db->from('masalah');
		if($idinstitution) {
			$this->db->where('idinstitution',$idinstitution);
		}
		$this->db->order_by('tanggalpengaduan','desc');
		$query = $this->db->get();

		return $query;
	}

	public function get_klasifikasi_institution($idinstitution)
    {
    	$query = "SELECT ik.id, k.name"
		." FROM institution_has_klasifikasi ik LEFT JOIN klasifikasi k ON k.id = ik.id"
		." WHERE (".$idinstitution.")"
		." AND ik.isactive=1";

		$query = $this->db->query($query)->result();

		return $query;
    }
}
