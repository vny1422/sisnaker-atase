<?php
class API_model extends CI_Model {
  public function __construct()
  {
    $this->load->database('default');
  }

  ############JO#####################
  function getJOByDate ($date) {
    $this->db->select('j.jobid, j.agid, j.ppkode, j.jobno, j.jobtglawal, j.jobtglakhir');
    $this->db->from('jo j');
    $this->db->order_by("j.jobid", "asc");
    $this->db->where("STR_TO_DATE('$date', '%Y-%m-%d') BETWEEN jobtglawal AND jobtglakhir");
    return $this->db->get()->result();
  }

  function getJOByAgidPpkode ($agid, $ppkode) {
    $this->db->select('j.jobid, j.agid, j.ppkode, j.jobno, j.jobtglawal, j.jobtglakhir');
    $this->db->from('jo j');
    $this->db->order_by("j.jobtimestamp", "desc");
    $this->db->join('magensi ag', 'ag.agid = j.agid');
    $this->db->join('mpptkis pp', 'pp.ppkode = j.ppkode');
    $this->db->where('j.agid', $agid);
    $this->db->where('j.ppkode', $ppkode);
    return $this->db->get()->result();
  }

  function getJODetail ($jobid) {
    $this->db->select('j.jobdid, j.idjenispekerjaan, j.jobdl, j.jobdp, j.jobdc');
    $this->db->from('jodetail j');
    $this->db->order_by("j.jobdid", "asc");
    $this->db->where('j.jobid', $jobid);
    return $this->db->get()->result();
  }

  ############PK#######################
  function getPKByDate($date) {
    $this->db->where("ejtglendorsement = DATE_FORMAT('$date', '%Y-%m-%d')");
    $this->db->order_by('ejid', 'asc');
    return $this->db->get('entryjo')->result();
  }

  ###########TKI#######################
  function getTKI($ejid) {
    $this->db->where('ejid', $ejid);
    $this->db->order_by('tkid', 'asc');
    return $this->db->get('tki')->result();
  }

  ##########AGENSI CEKAL###############
  function getBlacklistAgenByDate($date)
  {
    $this->db->select('agid');
    $this->db->where("(STR_TO_DATE('$date', '%Y-%m-%d') BETWEEN castart AND caend) OR caend is NULL");
    return $this->db->get('cekalagensi')->result();
  }

  #############KEBERANGKATAN##################
  function pushKeberangkatan($post)
  {
      $db_debug = $this->db->db_debug;
      $data = array();
      foreach($post as $key => $value)
      {
        $data[$key] = $value;
      }
      $this->db->db_debug = false;
      $this->db->insert('keberangkatan', $data);
      $this->db->db_debug = $db_debug;
      return $this->db->insert_id();
  }

  function pushKepulangan($post)
  {
      $db_debug = $this->db->db_debug;
      $data = array();
      foreach($post as $key => $value)
      {
        $data[$key] = $value;
      }
      $this->db->db_debug = false;
      $this->db->insert('kepulangan', $data);
      $this->db->db_debug = $db_debug;
      return $this->db->insert_id();
  }
}
