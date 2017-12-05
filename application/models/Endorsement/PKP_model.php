<?php
class PKP_model extends CI_Model {
  private $table = 'pkp';
	public function __construct()
    {
        $this->load->database('default');
    }


  public function post_new_pkp()
  {

    // get data dari form
    $data = array(
      'ppkode' => $this->input->post('pptkis', TRUE),
      'agid' => $this->input->post('agensi', TRUE),
      'idinstitution' => $this->session->userdata('institution'),
      'pkptglawal' => $this->input->post('start', TRUE),
      'pkptglakhir' => $this->input->post('end', TRUE)
    );

    // generate barcode
    for ($i=0; $i < 101; $i++) {
			$data["pkpkode"] = $this->createUID('P', 4);
			$this->db->from('pkp');
			$this->db->where('pkpkode', $data["pkpkode"]);
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
      $datapkpdetail = array(
        'pkpid' => $id,
        'idjenispekerjaan' => $value,
        'pkpdl' => $laki[$key],
        'pkpdp' => $perempuan[$key],
        'pkpdc' => $campuran[$key]
      );
      array_push($detail, $datapkpdetail);
    }
    return array($this->db->insert_batch('pkpdetail', $detail), $data["pkpkode"]);
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
