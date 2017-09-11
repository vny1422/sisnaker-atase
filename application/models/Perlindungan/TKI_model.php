<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TKI_model extends CI_Model {
	function __construct() {
        $this->load->database('default');
	}

function get_all_endorsment($param){
  if($param=="" || $param==" ") return null;
  $q = $this->db->query("SELECT IF(e.statustki=1,'Resmi','Kaburan') AS statustki, t.idtkimasalah, i.nameinstitution,t.namatki,t.jk, t.paspor,e.agensi, j.namajenispekerjaan AS pekerjaan, e.pptkis , e.tanggalmasuktaiwan AS info , w.name as wilayah
                FROM tkimasalah t LEFT JOIN masalah e ON t.idmasalah=e.idmasalah LEFT JOIN jenispekerjaan j ON e.idjenispekerjaan=j.idjenispekerjaan LEFT JOIN institution i ON e.idinstitution = i.idinstitution LEFT JOIN wilayah w ON e.idwilayah = w.id
              WHERE ".$param." AND t.idtkimasalah IS NOT NULL AND e.tanggalmasuktaiwan IS NOT NULL
              ORDER BY e.tanggalmasuktaiwan DESC ");
  if($q->num_rows() > 0) return $q->result_array();
  return null;
}

function get_detail_endorse($idtki) {

	$q = $this->db->query("SELECT t.idtkimasalah, t.namatki,t.jk, t.paspor,e.agensi, j.namajenispekerjaan AS pekerjaan, e.pptkis , t.alamatindonesia
                FROM tkimasalah t LEFT JOIN masalah e ON t.idmasalah=e.idmasalah LEFT JOIN jenispekerjaan j ON e.idjenispekerjaan=j.idjenispekerjaan LEFT JOIN wilayah w ON e.idwilayah = w.id
              WHERE t.idtkimasalah = ".$idtki." AND t.idtkimasalah IS NOT NULL AND e.tanggalmasuktaiwan IS NOT NULL
              ORDER BY e.tanggalmasuktaiwan DESC ");
  return $q;
}

// function get_all_hiring($param){
//   if($param=="" || $param==" ") return null;
//   $q = $this->db->query("SELECT f.idhiring, f.namatki AS namatki, f.nomorpaspor AS paspor, CONCAT('','') AS agensi, CONCAT('','') AS pekerjaan, CONCAT('RE-','ENTRY HIRING') AS pptkis, k.kutglendorsement AS info
//                 FROM formulir f LEFT JOIN kuitansi k ON f.idhiring=k.idhiring
//               WHERE ".$param." AND k.kutglendorsement IS NOT NULL
//               ORDER BY k.kutglendorsement DESC ");
//   if($q->num_rows() > 0) return $q->result_array();
//   return null;
// }

}
