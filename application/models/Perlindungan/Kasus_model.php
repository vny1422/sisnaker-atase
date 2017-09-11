<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kasus_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	public function post_new_kasus()
	{
		$input = $this->input->post();
		$data = array();
		foreach ($input as $key => $value) {
			if($key != 'submit' )
			{
				$data[$key] = $value;
			}
		return $this->db->insert('masalah', $data);
		}
	}

	public function get_kasus($id)
	{
		return $this->db->get_where('masalah', array('idmasalah' => $id))->row();
	}

	public function delete_kasus($id)
	{
		$this->db->where('idmasalah',$id);
        return $this->db->delete('masalah');
	}

	function list_category($id)
	{
		$this->db->select('c.idcategory_perlindungan,c.namecategory');
		$this->db->from('institution_has_inputdetail_perlindungan i');
		$this->db->join('inputdetail_perlindungan id', 'id.idinputdetail_perlindungan = i.idinputdetail_perlindungan','left');
		$this->db->join('inputcategory_perlindungan c', 'id.idcategory_perlindungan = c.idcategory_perlindungan','left');
		$this->db->group_by('c.namecategory');
		$this->db->where('i.idinstitution', $id);
		return $this->db->get()->result();
	}

	function list_input($id)
	{
		$this->db->select('id.*,it.nameinputtype');
		$this->db->from('institution_has_inputdetail_perlindungan i');
		$this->db->join('inputdetail_perlindungan id', 'id.idinputdetail_perlindungan = i.idinputdetail_perlindungan','left');
		$this->db->join('inputtype it', 'id.idinputtype = it.idinputtype','left');
		$this->db->where('i.idinstitution', $id);
		$this->db->where('it.nameinputtype NOT LIKE', 'select');
		return $this->db->get()->result();
	}

	function list_inputselectfromoption($id)
	{
		$this->db->select('id.*,it.nameinputtype');
		$this->db->from('institution_has_inputdetail_perlindungan i');
		$this->db->join('inputdetail_perlindungan id', 'id.idinputdetail_perlindungan = i.idinputdetail_perlindungan','left');
		$this->db->join('inputtype it', 'id.idinputtype = it.idinputtype','left');
		$this->db->where('i.idinstitution', $id);
		$this->db->where('it.nameinputtype LIKE', 'select');
		$this->db->where('conntable', null);
		return $this->db->get()->result();
	}

	function list_inputselectfromtable($id)
	{
		$this->db->select('id.*,it.nameinputtype');
		$this->db->from('institution_has_inputdetail_perlindungan i');
		$this->db->join('inputdetail_perlindungan id', 'id.idinputdetail_perlindungan = i.idinputdetail_perlindungan','left');
		$this->db->join('inputtype it', 'id.idinputtype = it.idinputtype','left');
		$this->db->where('i.idinstitution', $id);
		$this->db->where('it.nameinputtype LIKE', 'select');
		$this->db->where('conntable !=', null);
		return $this->db->get()->result();
	}

	function list_opsiinput($id)
	{
		$this->db->select('io.nameinputoption');
		$this->db->from('inputdetail_perlindungan i');
		$this->db->join('inputoption_perlindungan io', 'io.idinputdetail_perlindungan = i.idinputdetail_perlindungan','left');
		$this->db->where('io.idinputdetail_perlindungan', $id);
		return $this->db->get()->result();
	}

	function list_opsitable($table)
	{
		$this->db->select('name');
		return $this->db->get($table)->result();
	}

	function timespan_search($start, $end, $idinstitution=NULL){
		if ($idinstitution == NULL) {
			$ret = $this->db->query(" SELECT m.idmasalah, t.namatki, t.paspor, j.namajenispekerjaan AS jenispekerjaan, k.name AS klasifikasi, ".
			" u.name as petugas, m.tanggalpengaduan, m.tanggalpenyelesaian, m.keyword, it.nameinstitution as namainstitusi, ".
			" IF(m.statusmasalah=1,'Proses','Selesai') AS statusmasalah, ".
			" IF(m.statustki=1,'Resmi','Kaburan') AS statustki ".
			" FROM masalah m LEFT JOIN tkimasalah t ON m.idmasalah=t.idmasalah".
			" LEFT JOIN user u ON m.petugaspenanganan=u.username".
			" LEFT JOIN institution it ON m.idinstitution=it.idinstitution".
			" LEFT JOIN jenispekerjaan j ON m.idjenispekerjaan=j.idjenispekerjaan".
			" LEFT JOIN klasifikasi k ON m.idklasifikasi=k.id".
			" WHERE YEAR(m.tanggalpengaduan)>=".$start.
			" AND YEAR(m.tanggalpengaduan)<=".$end.
			" AND m.enable=1".
			" ORDER BY m.tanggalpengaduan DESC");
		} else {
			$ret = $this->db->query(" SELECT m.idmasalah, t.namatki, t.paspor, j.namajenispekerjaan AS jenispekerjaan, k.name AS klasifikasi, ".
			" u.name as petugas, m.tanggalpengaduan, m.tanggalpenyelesaian, m.keyword, it.nameinstitution as namainstitusi, ".
			" IF(m.statusmasalah=1,'Proses','Selesai') AS statusmasalah, ".
			" IF(m.statustki=1,'Resmi','Kaburan') AS statustki ".
			" FROM masalah m LEFT JOIN tkimasalah t ON m.idmasalah=t.idmasalah".
			" LEFT JOIN user u ON m.petugaspenanganan=u.username".
			" LEFT JOIN institution it ON m.idinstitution=it.idinstitution".
			" LEFT JOIN jenispekerjaan j ON m.idjenispekerjaan=j.idjenispekerjaan".
			" LEFT JOIN klasifikasi k ON m.idklasifikasi=k.id".
			" WHERE YEAR(m.tanggalpengaduan)>=".$start.
			" AND YEAR(m.tanggalpengaduan)<=".$end.
			" AND m.idinstitution=".$idinstitution.
			" AND m.enable=1".
			" ORDER BY m.tanggalpengaduan DESC");
		}
		
		if($ret->num_rows() > 0){
			return $ret->result_array();
		}
		return 0;
	}

	function get_work_type() {
	$query = $this->db->get('jenispekerjaan');
	return $query->result_array();
}

function get_officer_all() {
	$this->db->select('u.username, u.name as namapetugas, k.idkantor, k.namakantor as namakantor');
	$this->db->from('user u, kantor k');
	$this->db->where('u.idlevel',3);
	$this->db->where('u.idinstitution = k.idinstitution');
	$this->db->order_by('u.name','ASC');
	$query = $this->db->get();

	return $query->result_array();
}
function get_problem_class() {
	$query = $this->db->get('klasifikasi');
	return $query->result_array();
}
function get_media() {
	$query = $this->db->get('media');
	return $query->result_array();
}

function get_shelter() {
	$query = $this->db->get('shelter');
	return $query->result_array();
}

function query_paspor($paspor) {
	$this->db->select('t.tkiid, t.namatki, t.jk, t.alamatindonesia, t.alamattaiwan, j.idjenispekerjaan, j.namajenispekerjaan');
	$this->db->select('m.agensi, m.cpagensi, m.teleponagensi, m.pptkis, m.majikan');
	$this->db->from('masalah m, tkimasalah t, jenispekerjaan j');
	$this->db->where('t.idmasalah = m.idmasalah');
	$this->db->where('m.idjenispekerjaan = j.idjenispekerjaan');
	$this->db->where('t.enable = 1');
	$this->db->where('t.paspor',$paspor);
	$query = $this->db->get();

	return $query->row();
}

function org_count_problem_thismonth($month,$year,$idorganisasi) {
		$this->db->select('*');
		$this->db->from('masalah m');
		$this->db->where('MONTH(m.tanggalpengaduan)',$month);
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		$this->db->where('m.idinstitution',$idorganisasi);
		$query = $this->db->count_all_results();

		return $query;
	}

	function org_count_problem_thisyear($year,$idorganisasi) {
		$this->db->select('*');
		$this->db->from('masalah m');
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		$this->db->where('m.idinstitution',$idorganisasi);
		$query = $this->db->count_all_results();

		return $query;
	}

	function input_problem($data_arr) {
		$this->db->insert('masalah', $data_arr);
		//print $this->db->last_query();

		$id = $this->db->insert_id();

		return $id;
	}

	function input_tki($data_arr) {
	$this->db->insert('tkimasalah', $data_arr);
	$id = $this->db->insert_id();

	return $id;
	}

	function insert_tindak_lanjut($id,$tindaklanjut,$date,$petugas)
	{
		$data = array(
			'idmasalah' => $id,
			'tindakan' => $tindaklanjut,
			'tanggal' => $date,
			'username' => $petugas
		);
		return $this->db->insert('tindak_lanjut', $data);
	}

	function input_shelter($data_arr) {
	return $this->db->insert_batch('masalah_has_shelter', $data_arr);
	}

	function input_file($data_arr) {
	$this->db->insert('file', $data_arr);
	return true;
	}

	function input_history($data_arr) {
	$this->db->insert('history', $data_arr);
	return true;
}

//check kasus
public function similar_test($nama,$paspor){

		$query = "";
		for($i=0;$i<count($nama);$i++){
				$query = $query." namatki LIKE '%".$nama[$i]."%' ";
				if($i+1 < count($nama)){
						$query = $query." OR ";
				}
		}
		if(!empty($query) && count($paspor)>0){
				$query = $query." ) AND ( ";
		}
		for($i=0;$i<count($paspor);$i++){
				$query = $query." paspor LIKE '%".$paspor[$i]."%' ";
				if($i+1 < count($paspor)){
						$query = $query." OR ";
				}
		}
		$query = "SELECT m.idmasalah, t.namatki, t.paspor, k.name, j.namajenispekerjaan, m.tanggalpengaduan ".
			", IF(m.statusmasalah=1,'Proses','Selesai') AS status, u.name AS petugas ".
								"FROM tkimasalah t, masalah m, klasifikasi k, jenispekerjaan j, user u ".
								"WHERE (".$query.") AND t.idmasalah=m.idmasalah AND m.idjenispekerjaan=j.idjenispekerjaan AND m.idklasifikasi=k.id AND m.petugaspenanganan=u.username ".
								"ORDER BY m.tanggalpengaduan DESC ";

		/// multi white space removal
		$query = preg_replace('/\s+/', ' ', $query);

		//return $query;

		$result = $this->db->query($query);

		return $result->result_array();

}

}
