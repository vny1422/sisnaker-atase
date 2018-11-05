<?php
class EntryJO_model extends CI_Model {
	public function __construct()
    {
        $this->load->database('default');
    }

    public function updateTglEndorse($ejid){
      $date = date('Y-m-d');
      $data = array(
        'ejtglendorsement' => $date
      );
      $this->db->where('ejid', $ejid);
      return $this->db->update('entryjo',$data);
    }

  }

  ?>
