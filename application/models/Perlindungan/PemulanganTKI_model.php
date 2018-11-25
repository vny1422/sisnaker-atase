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

  public function query_pemulangan_institution($id)
  {
		if ($id == 'all') {
			return $this->db->get('tki_pulang')->result();
		}
		else {
			$this->db->where("idinstitution", $id);
			$q = $this->db->get('tki_pulang');
			return $q->result();
		}
	}

	public function query_pemulangan_institution_select($id)
  {
		if ($id == 'all') {
			return $this->db->get('tki_pulang')->result();
		}
		else {
			$q = $this->db->query(" SELECT * FROM tki_pulang WHERE idinstitution = '$id' ");
			return $q->result();
		}
	}

  public function query_pemulangan_paspor($paspor)
  {
    $query = "SELECT q1.*"
    ." FROM tki_pulang q1"
    ." WHERE q1.tanggalpemulangan = (SELECT MAX(q2.tanggalpemulangan) FROM tki_pulang q2 WHERE q2.paspor = q1.paspor)"
    ." AND q1.paspor = '".$paspor."'";

    return $this->db->query($query)->row();
  }

	public function get_pemulangan($id)
  {
    return $this->db->get_where('tki_pulang', array('idtkipulang' => $id))->row();
  }

  public function update_pemulangan($id,$data)
  {
     $this->db->where('idtkipulang',$id);
     if($this->db->update('tki_pulang', $data)){
      return true;
    } else {
      return false;
    }
  }

  public function delete_pemulangan($id)
  {
    $this->db->where('idtkipulang',$id);
    return $this->db->delete('tki_pulang');
  }

}
