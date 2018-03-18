<?php
class API_model extends CI_Model {
  public function __construct()
  {
    $this->load->database('default');
  }

  function getJOByDate ($date) {
    $this->db->select('j.jobid, j.agid, j.ppkode, j.jobno, j.jobtglawal, j.jobtglakhir');
    $this->db->from('jo j');
    $this->db->order_by("j.jobid", "asc");
    $this->db->where("STR_TO_DATE('$date', '%Y-%m-%d') BETWEEN jobtglawal AND jobtglakhir");
    return $this->db->get()->result();
  }

}
