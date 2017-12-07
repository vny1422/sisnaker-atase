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

  public function upload_dokumen_final_pkp($pkpkode)
  {
    $data = array(
      'isuploaded' => '1'
    );
    $this->db->where('pkpkode',$pkpkode);
    return $this->db->update($this->table, $data);
  }

  function get_pkp_from_barcode($bc)
  {
    $this->db->select('p.*, ag.agnama, pp.ppnama, pd.pkpdl, pd.pkpdp, pd.pkpdc, jp.namajenispekerjaan');
    $this->db->from('pkp p');
    $this->db->join('pkpdetail pd', 'p.pkpid = pd.pkpid');
    $this->db->join('jenispekerjaan jp', 'pd.idjenispekerjaan = jp.idjenispekerjaan');
    $this->db->join('magensi ag', 'p.agid = ag.agid');
    $this->db->join('mpptkis pp', 'p.ppkode = pp.ppkode');
    $this->db->where('pkpkode', $bc);
    $this->db->where('p.idinstitution', $this->session->userdata('institution'));
    return $this->db->get()->result();
  }

  function verify_barcode($bc){
    $this->db->where('pkpkode', $bc);
    $this->db->where('idinstitution', $this->session->userdata('institution'));
    $this->db->where('isverified', 1);
    if ($this->db->get($this->table)->num_rows() > 0)
    {
      return FALSE;
    }
    else {
      $data = array(
        'isverified' => 1
      );

      $this->db->where('pkpkode', $bc);
      $this->db->where('pkp.idinstitution', $this->session->userdata('institution'));
      return $this->db->update($this->table, $data);
    }
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

  function get_data_pkp_by_agensi_and_pptkis ($agid, $ppkode) {
    $this->db->select('p.pkpkode, ag.agnama, pp.ppnama, p.pkptglawal, p.pkptglakhir, p.isverified, p.isuploaded, p.pkptimestamp');
    $this->db->from('pkp p');
    $this->db->order_by("p.pkptimestamp", "desc");
    $this->db->join('magensi ag', 'ag.agid = p.agid');
    $this->db->join('mpptkis pp', 'pp.ppkode = p.ppkode');
    $this->db->where('p.agid', $agid);
    $this->db->where('p.ppkode', $ppkode);
    $this->db->where('p.idinstitution', $this->session->userdata('institution'));


    return $this->db->get()->result();
  }
}