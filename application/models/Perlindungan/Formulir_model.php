<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formulir_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function formulir_pengaduan($idproblem) {
		$this->db->select('m.namapelapor, t.namatki, COUNT(t.namatki) as jumlah');
		$this->db->select('t.paspor, t.handphone, t.alamatindonesia, m.agensi');
		$this->db->select('m.pptkis, m.tanggalmasuktaiwan, m.majikan, m.teleponagensi');
		$this->db->select('m.permasalahan, m.tuntutan, m.nomormasalah');
		$this->db->select('m.tanggalpengaduan, me.name AS media, u.name, j.namajenispekerjaan AS jenis, j.sektor');
		$this->db->from('masalah m, tkimasalah t, jenispekerjaan j, media me, user u');
		$this->db->where('m.idmasalah', $idproblem);
		$this->db->where('m.idmasalah = t.idmasalah');
		$this->db->where('m.idjenispekerjaan = j.idjenispekerjaan');
		$this->db->where('m.idmedia = me.id');
		$this->db->where('m.petugaspenanganan = u.username');
		$query = $this->db->get();
		
		return $query;
	}
	
	function formulir_tindaklanjut($idproblem){
		$tl = $this->db->query(" SELECT tanggal,tindakan,username FROM tindak_lanjut ".
							   " WHERE idmasalah=".$idproblem." ORDER BY tanggal ASC");
		if($tl->num_rows()>0) {
			$tl = $tl->result_array();
			$story = "";
			
			for($i=0;$i<count($tl);$i++){
				$val = $tl[$i];
				$txt = "<b>[".$val['username']." ".$val['tanggal']."]</b> ".$val['tindakan']." <br/>";
				$story = $story.$txt;
			}
			
			return $story;
		}
		else return null;
	}
	
	function formulir_tindaklanjut_BNP2TKI($idproblem){
		$tl = $this->db->query(" SELECT tanggal,tindakan FROM bnp_sync_tindaklanjut ".
							   " WHERE idmasalah=".$idproblem." ORDER BY tanggal ASC");
		if($tl->num_rows()>0) {
			$tl = $tl->result_array();
			$story = "";
			
			for($i=0;$i<count($tl);$i++){
				$val = $tl[$i];
				$txt = "<b>[".$val['tanggal']."]</b> ".$val['tindakan']." <br/>";
				$story = $story.$txt;
			}
			
			return $story;
		}
		else return null;
	}
	
	function formulir_field_BNP2TKI($idproblem){
		$tl = $this->db->query(" SELECT kategoriBNP,eskalasi FROM bnp_sync ".
							   " WHERE idmasalah=".$idproblem);
		////jika tidak ada
		if($tl->num_rows()==0) {
			return null;
		}
		
		return $tl->row_array();
	}
}