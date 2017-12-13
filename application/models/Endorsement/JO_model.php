<?php
class JO_model extends CI_Model {
  private $table = 'jo';
  public function __construct()
  {
    $this->load->database('default');
  }

  public function post_new_jo()
  {
    // get data dari form
    $data = array(
      'ppkode' => $this->input->post('pptkis', TRUE),
      'agid' => $this->input->post('agensi', TRUE),
      'idinstitution' => $this->session->userdata('institution'),
      'idkantor' => $this->session->userdata('kantor'),
      'jobtglawal' => $this->input->post('start', TRUE),
      'jobtglakhir' => $this->input->post('end', TRUE),
      'pkpid' => $this->input->post('pkpid', TRUE),
      'username' => $this->session->userdata('user')
    );

    // generate barcode
    for ($i=0; $i < 101; $i++) {
      $data["jobno"] = $this->createUID('J', 4);
      $this->db->from('jo');
      $this->db->where('jobno', $data["jobno"]);
      $total = $this->db->get()->num_rows();
      if($total == 0)
      {
        break;
      }
    }

    // save data pkp
    $this->db->insert($this->table, $data);

    #BAGIAN SAVE DATA PKP DETAIL
    // get id pkp
    $id = $this->db->insert_id();

    $detail = array();

    $laki = $this->input->post('laki', TRUE);
    $perempuan = $this->input->post('perempuan', TRUE);
    $campuran = $this->input->post('campuran', TRUE);

    foreach ($this->input->post('jenispekerjaan', TRUE) as $key => $value) {
      $datajodetail = array(
        'jobid' => $id,
        'idjenispekerjaan' => $value,
        'jobdl' => $laki[$key],
        'jobdp' => $perempuan[$key],
        'jobdc' => $campuran[$key]
      );
      array_push($detail, $datajodetail);
    }
    return array($this->db->insert_batch('jodetail', $detail), $data["pkpkode"]);
  }

  function createUID($tipe, $length = 3) {
    return $tipe.date("y").date("m").$this->randomString($length);
  }

  function randomString($length) {
    $data = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $data .= "0123456789";
    $tmp = "";

    srand((double) microtime() * 1000000);

    for ($i=0; $i<$length; $i++) {
      $tmp .= substr($data, (rand()%(strlen($data))), 1);
    }

    return $tmp;
  }

  public function get_jo_verify_list()
  {
    $this->db->select('j.jobid, j.jobno, ag.agnama, pp.ppnama, j.jobtglawal, j.jobtglakhir, j.isverified, j.isuploaded, j.jobtimestamp, pkp.pkpkode');
    $this->db->from('jo j');
    $this->db->order_by("j.jobtimestamp", "dsc");
    $this->db->join('magensi ag', 'ag.agid = j.agid');
    $this->db->join('mpptkis pp', 'pp.ppkode = j.ppkode');
    $this->db->join('pkp', 'pkp.pkpid = j.pkpid');
    $this->db->where('j.isverified', 0);
    $this->db->where('j.idinstitution', $this->session->userdata('institution'));
    $this->db->where('j.idkantor', $this->session->userdata('kantor'));

    //var_dump($this->db);
    //echo $this->db->get_compiled_select();
    return $this->db->get()->result();
  }

  public function editDate_from_bc($jobno)
  {
    $data = array(
      'jobtglawal' => $this->input->post('tglawal', true),
      'jobtglakhir' => $this->input->post('tglakhir', true)
    );
    $this->db->where('jobno', $jobno);
    //$this->db->update($this->table, $data);
    //echo $this->db->last_query();
    return $this->db->update($this->table, $data);
  }

  public function editJOd($id)
  {
    $data = array(
      'jobdl' => $this->input->post('laki', true),
      'jobdp' => $this->input->post('perempuan', true),
      'jobdc' => $this->input->post('campuran', true)
    );
    $this->db->where('jobdid',$id);
    return $this->db->update('jodetail', $data);
  }

  function get_jo_from_barcode($jobno) // bc = jobno
  {
    $this->db->select('j.*, jd.jobdid, ag.agnama, pp.ppnama, jd.jobdl, jd.jobdp, jd.jobdc, jp.namajenispekerjaan, pkp.pkpkode');
    $this->db->from('jo j');
    $this->db->join('jodetail jd', 'j.jobid = jd.jobid');
    $this->db->join('jenispekerjaan jp', 'jd.idjenispekerjaan = jp.idjenispekerjaan');
    $this->db->join('magensi ag', 'j.agid = ag.agid');
    $this->db->join('mpptkis pp', 'j.ppkode = pp.ppkode');
    $this->db->join('pkp', 'pkp.pkpid = j.pkpid');
    $this->db->where('jobno', $jobno);
    $this->db->where('j.idinstitution', $this->session->userdata('institution'));
    return $this->db->get()->result();
  }

  function toggle_jo($jobno, $reject=FALSE)
  {
    if(!$reject)
    {
      $data = array(
        'isverified' => 2
      );
    }
    else {
      $data = array(
        'isverified' => 1,
        'alasanpenolakan' => $this->input->post('alasan', true)
      );
    }
    $this->db->where('jo.jobno', $jobno);
    $this->db->where('jo.idinstitution', $this->session->userdata('institution'));
    $this->db->where('jo.idkantor', $this->session->userdata('kantor'));
    return $this->db->update($this->table, $data);
  }

  function legalize_barcode($bc){
    $this->db->where('jobno', $bc);
    $this->db->where('idinstitution', $this->session->userdata('institution'));
    $this->db->where('isverified', 3);
    if ($this->db->get($this->table)->num_rows() > 0)
    {
      return FALSE;
    }
    else {
      $data = array(
        'isverified' => 3,
        'jotglendorsement' => date("Y-m-d")
      );

      $this->db->where('jobno', $bc);
      $this->db->where('idinstitution', $this->session->userdata('institution'));
      return $this->db->update($this->table, $data);
    }
  }
}
