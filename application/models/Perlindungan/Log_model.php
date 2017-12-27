<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function get_history() {
		$this->db->select("*");
		$this->db->from("history");
		$this->db->where("timestamp > (DATE(SUBDATE( NOW(), INTERVAL 20 DAY)))");
		$this->db->order_by("timestamp","DESC");
		$query = $this->db->get();
		
		return $query;
	}

	function get_namatki($idmasalah) {
		$this->db->select("namatki");
		$q = $this->db->get_where("tkimasalah", array('idmasalah' => $idmasalah));
		return $q->result();
	}

	function get_namapetugas($iduser) {
		$this->db->select("name");
		$q = $this->db->get_where("user", array('username' => $iduser));
		return $q->result();
	}
	
}