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

  public function editPKPd($id)
  {
    $data = array(
      'pkpdl' => $this->input->post('laki', true),
      'pkpdp' => $this->input->post('perempuan', true),
      'pkpdc' => $this->input->post('campuran', true)
    );
    $this->db->where('pkpdid',$id);
    return $this->db->update('pkpdetail', $data);
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


}
