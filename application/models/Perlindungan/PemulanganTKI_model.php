<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PemulanganTKI_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	public function post_new_pemulangan($data)
	{
      	if($this->db->insert('tki_pulang', $data)){
      		return true;
      	} else {
      		return false;
      	}
    }

    public function query_pemulangan_institution($id){
		$q = $this->db->get_where('tki_pulang', array('idinstitution' => $id));
		return $q->result();
	}
}