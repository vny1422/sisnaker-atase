<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rekap_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function getCategoryDetail($idClass,$year,$idinstitution){
		$this->db->select('m.idmasalah, t.namatki, t.paspor, m.statustki, m.agensi, m.pptkis, m.permasalahan, m.statusmasalah, m.tanggalpenyelesaian, u.name AS nama, j.namajenispekerjaan as jenis');
		$this->db->from('masalah m, tkimasalah t, user u, jenispekerjaan j');
		$this->db->where('m.idmasalah = t.idmasalah');
		$this->db->where('u.username = m.petugaspenanganan');
		$this->db->where('j.idjenispekerjaan = m.idjenispekerjaan');
		$this->db->where_in('m.idklasifikasi',$idClass);
		$this->db->where('m.idinstitution',$idinstitution);
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		$this->db->order_by('m.statusmasalah','DESC');
		$this->db->order_by('t.namatki','ASC');

		$query = $this->db->get();
		$final = $query->result_array();
		
		////////////////
		for($i=0;$i<count($final);$i++){
			$id = $final[$i]['idmasalah'];
			$final[$i]['tindaklanjut'] = $this->getFormatedTindakLanjut($id);			
		}		
		
		return $final;
	}
	
	function getFormatedTindakLanjut($idproblem){
		$tl = $this->db->query(" SELECT tanggal,tindakan,username FROM tindak_lanjut ".
			" WHERE idmasalah=".$idproblem." ORDER BY tanggal ASC");
		if($tl->num_rows()>0) {
			$tl = $tl->result_array();
			$story = "";
			
			for($i=0;$i<count($tl);$i++){
				$val = $tl[$i];
				$val['tindakan'] = preg_replace("/\n+/", "\n", $val['tindakan']);
				$txt = "[".$val['username']." ".$val['tanggal']."] \r\n ".$val['tindakan']." \r\n";
				$story = $story.$txt;
			}
			
			return $story;
		}
		else return null;
	}
	
	function get_detailrekap($month=NULL, $year, $status, $kelas=NULL, $idinstitution) {
		$this->db->select('m.idmasalah, t.namatki, t.paspor, m.pptkis, m.agensi, m.permasalahan');
		$this->db->select('u.name AS nama, m.statusmasalah, me.name AS media');
		$this->db->from('masalah m, tkimasalah t, user u, media me, klasifikasi k');
		$this->db->where('m.idmasalah = t.idmasalah');
		$this->db->where('u.username  = m.petugaspenanganan');
		$this->db->where('me.id  = m.idmedia');
		$this->db->where('k.id = m.idklasifikasi');
		$this->db->where('m.idinstitution',$idinstitution);
		
		if(!is_null($kelas)){			
			$this->db->like('k.name AS klasifikasi',$kelas,'after');
		}
		if(!is_null($month)){			
			$this->db->where('MONTH(m.tanggalpengaduan)',$month);
		}		
		
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		$this->db->where('m.enable',1);
		
		if ($status != 'all')
			$this->db->where('m.statusmasalah', $status);
		
		$this->db->order_by('m.tanggalpengaduan');
		
		$query = $this->db->get();
		$query = $query->result_array();
		
		//////////////// get tindak lanjut versi baru
		for($i=0;$i<count($query);$i++){
			$id = $query[$i]['idmasalah'];
			$query[$i]['tindaklanjut'] = $this->getFormatedTindakLanjut($id);			
		}	
		
		return $query;
	}
	
	function get_classification($contain=NULL) {
		if(is_null($contain)) $query = $this->db->get('klasifikasi');
		else {
			$this->db->select('*');
			$this->db->from('klasifikasi');
			$this->db->like('name',$contain,'after');
			$query = $this->db->get();
		}		
		return $query;
	}
	
	function get_work_type() {
		$query = $this->db->get('jenispekerjaan');
		return $query;
	}
	
	function count_based_typeclass($type, $class, $month, $year, $idinstitution) {
		$this->db->select('*');
		$this->db->from('masalah m');
		$this->db->where('m.idjenispekerjaan',$type);
		$this->db->where('m.idklasifikasi',$class);
		$this->db->where('MONTH(m.tanggalpengaduan)',$month);
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		$this->db->where('m.enable', 1);
		$this->db->where('m.idinstitution',$idinstitution);
		$jumlah = $this->db->count_all_results();
		
		return $jumlah;		
	}

	function count_aggregate($field,$field_val,$month,$year,$idinstitution) {
		$this->db->start_cache();
		$this->db->select('*');
		$this->db->from('masalah m');
		if ($field == 'sektor') {
			$this->db->join('jenispekerjaan j', 'j.idjenispekerjaan=m.idjenispekerjaan', 'left');
		}
		$this->db->where($field,$field_val);
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		$this->db->where('m.idinstitution',$idinstitution);
		$this->db->where('m.enable', 1);
		$this->db->stop_cache();
		
		// All problems (Finished + Processed)
		$this->db->where('MONTH(m.tanggalpengaduan)',$month);
		$all1 = $this->db->count_all_results();
		
		$this->db->where("MONTH(m.tanggalpengaduan) < $month");
		$all2 = $this->db->count_all_results();
		
		$this->db->where("MONTH(m.tanggalpengaduan) <= $month");
		$all3 = $this->db->count_all_results();
		
		// Finished problems
		$this->db->where('MONTH(m.tanggalpengaduan)',$month);
		$this->db->where('m.statusmasalah', 2);
		$fin1 = $this->db->count_all_results();
		
		$this->db->where("MONTH(m.tanggalpengaduan) < $month");
		$this->db->where('m.statusmasalah', 2);
		$fin2 = $this->db->count_all_results();
		
		$this->db->where("MONTH(m.tanggalpengaduan) <= $month");
		$this->db->where('m.statusmasalah', 2);
		$fin3 = $this->db->count_all_results();
		
		// Processed problems
		$this->db->where('MONTH(m.tanggalpengaduan)',$month);
		$this->db->where('m.statusmasalah', 1);
		$pro1 = $this->db->count_all_results();
		
		$this->db->where("MONTH(m.tanggalpengaduan) < $month");
		$this->db->where('m.statusmasalah', 1);
		$pro2 = $this->db->count_all_results();
		
		$this->db->where("MONTH(m.tanggalpengaduan) <= $month");
		$this->db->where('m.statusmasalah', 1);
		$pro3 = $this->db->count_all_results();
		
		$this->db->flush_cache();
		
		return array($all1, $all2, $all3, $fin1, $fin2, $fin3, $pro1, $pro2, $pro3);
	}

	function count_sector_based_class($sector,$class,$month,$year,$idinstitution) {
		$this->db->select('*');
		$this->db->from('masalah m');
		$this->db->join('jenispekerjaan j', 'j.idjenispekerjaan=m.idjenispekerjaan', 'left');
		$this->db->where('m.idklasifikasi',$class);
		$this->db->where('sektor',$sector);
		$this->db->where('MONTH(m.tanggalpengaduan)',$month);
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		$this->db->where('m.enable', 1);
		$this->db->where('m.idinstitution',$idinstitution);
		$jumlah = $this->db->count_all_results();
				
		return $jumlah;
	}
	
	function count_split_class($sector,$class,$month,$year,$idinstitution) {
		$this->db->start_cache();
		$this->db->select('*');
		$this->db->from('masalah m');
		$this->db->join('jenispekerjaan j', 'j.idjenispekerjaan=m.idjenispekerjaan', 'left');
		$this->db->where('sektor',$sector);
		$this->db->where('MONTH(m.tanggalpengaduan)',$month);
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		$this->db->where('m.enable', 1);
		$this->db->where('m.idinstitution',$idinstitution);
		$this->db->stop_cache();
		
		$jumlah = array();
		foreach($class as $oneClass){
			$this->db->where('m.idklasifikasi',$oneClass);
			$val = $this->db->count_all_results();
			array_push($jumlah, $val);
		}
		
		$this->db->flush_cache();
		return $jumlah;
	}
	
	function count_status_based_class($status,$class,$month,$year,$idinstitution) {
		$this->db->select('*');
		$this->db->from('masalah m');
		$this->db->where('m.idklasifikasi',$class);
		$this->db->where('m.statustki',$status);
		$this->db->where('MONTH(m.tanggalpengaduan)',$month);
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		$this->db->where('m.enable', 1);
		$this->db->where('m.idinstitution',$idinstitution);
		$jumlah = $this->db->count_all_results();
		
		return $jumlah;
	}
	
	function get_yearrekap($class,$month, $year,$lingkup=null,$idinstitution){
		$this->db->select('*');
		$this->db->from('masalah m');
		$this->db->where('m.idklasifikasi',$class);
		$this->db->where('MONTH(m.tanggalpengaduan)',$month);
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		if(!is_null($lingkup)) $this->db->where('idshelter',$lingkup);
		$this->db->where('m.enable', 1);
		$this->db->where('m.idinstitution',$idinstitution);
		
		$jumlah = $this->db->count_all_results();
		
		return $jumlah;		
	}
	
	function get_yearrekap_permonth($month, $year,$lingkup=null,$idinstitution){
		$this->db->start_cache();

		$this->db->select('*');
		$this->db->from('masalah m');
		$this->db->where('MONTH(m.tanggalpengaduan)',$month);
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		if(!is_null($lingkup)) $this->db->where('idshelter',$lingkup);
		$this->db->where('m.enable', 1);
		$this->db->where('m.idinstitution',$idinstitution);
		
		$this->db->stop_cache();
		
		// All problems (Finished + Processed)
		$all = $this->db->count_all_results();
		
		// Finished problems
		$this->db->where('m.statusmasalah', 2);
		$fin = $this->db->count_all_results();
		
		// Processed problems
		$this->db->where('m.statusmasalah', 1);
		$pro = $this->db->count_all_results();
		
		$this->db->flush_cache();
		
		return array($all,$fin,$pro);
	}
	
	function get_yearrekap_based_class($class,$year,$lingkup=null,$idinstitution){
		$this->db->start_cache();

		$this->db->select('*');
		$this->db->from('masalah m');
		$this->db->where('m.idklasifikasi',$class);
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		if(!is_null($lingkup)) $this->db->where('idshelter',$lingkup);
		$this->db->where('m.enable', 1);
		$this->db->where('m.idinstitution',$idinstitution);
		
		$this->db->stop_cache();
		
		// All problems (Finished + Processed)
		$all = $this->db->count_all_results();
		
		// Finished problems
		$this->db->where('m.statusmasalah', 2);
		$fin = $this->db->count_all_results();
		
		// Processed problems
		$this->db->where('m.statusmasalah', 1);
		$pro = $this->db->count_all_results();
		
		$this->db->flush_cache();
		
		return array($all,$fin,$pro);
	}
	
	function get_year_dynamic($work=NULL,$class=NULL,$sector=NULL,$statustki=NULL, $month=NULL, $year,$complete=FALSE,$idinstitution){
		/// if complete --> all, pro, fin
		if($complete) $this->db->start_cache();
		
		$this->db->select('*');
		$this->db->from('masalah m');
		$this->db->join('jenispekerjaan j', 'j.idjenispekerjaan=m.idjenispekerjaan', 'left');
		if(!is_null($work))	$this->db->where('m.idjenispekerjaan',$work);
		if(!is_null($class)) $this->db->where('m.idklasifikasi',$class);
		if(!is_null($sector)) $this->db->where('sektor',$sector);
		if(!is_null($statustki)) $this->db->where('m.statustki',$statustki);
		if(!is_null($month)) $this->db->where('MONTH(m.tanggalpengaduan)',$month);
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		$this->db->where('m.enable', 1);
		$this->db->where('m.idinstitution',$idinstitution);
		
		/// if complete --> all, pro, fin
		if($complete){
			//stopping cache
			$this->db->stop_cache();
			// All problems (Finished + Processed)
			$all = $this->db->count_all_results();
			// Finished problems
			$this->db->where('m.statusmasalah', 2);
			$fin = $this->db->count_all_results();
			// Processed problems
			$this->db->where('m.statusmasalah', 1);
			$pro = $this->db->count_all_results();
			//flushing cache
			$this->db->flush_cache();
			/// return array
			return array($all,$fin,$pro);
		}
		else return $this->db->count_all_results();
	}
	
	function get_year_dynamic_array($idinstitution,$param,$month=null,$year,$complete=FALSE){
		/// if complete --> all, pro, fin
		if($complete) $this->db->start_cache();
		
		$this->db->select('*');
		$this->db->from('masalah m');
		$this->db->join('jenispekerjaan j', 'j.idjenispekerjaan=m.idjenispekerjaan', 'left');
		if(isset($param['work'])) 		$this->db->where('m.idjenispekerjaan',$param['work']);
		if(isset($param['class'])) 		$this->db->where('m.idklasifikasi',$param['class']);
		if(isset($param['sector'])) 	$this->db->where('sektor',$param['sector']);
		if(isset($param['statustki'])) 	$this->db->where('m.statustki',$param['statustki']);
		if(isset($param['lingkup']))	$this->db->where('m.idshelter',$param['lingkup']);
		if(!is_null($month)) 			$this->db->where('MONTH(m.tanggalpengaduan)',$month);
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		$this->db->where('m.enable', 1);
		$this->db->where('m.idinstitution',$idinstitution);
		
		/// if complete --> all, pro, fin
		if($complete){
			//stopping cache
			$this->db->stop_cache();
			// All problems (Finished + Processed)
			$all = $this->db->count_all_results();
			// Finished problems
			$this->db->where('m.statusmasalah', 2);
			$fin = $this->db->count_all_results();
			// Processed problems
			$this->db->where('m.statusmasalah', 1);
			$pro = $this->db->count_all_results();
			//flushing cache
			$this->db->flush_cache();
			/// return array
			return array($all,$fin,$pro);
		}
		else return $this->db->count_all_results();
	}
	
	
	
}