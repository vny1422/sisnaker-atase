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

		function api_get_entry_jo_by_barcode($barcode) {
	    $this->db->select('ej.ejid,
			ej.idjenispekerjaan,
			ag.agnama,
			ag.agnamaoth,
			ag.agnoijincla,
			ag.agalmtkantor,
			ag.agalmtkantoroth,
			ag.agpngjwb,
			ag.agpngjwboth,
			ag.agtelp,
			ag.agfax,
			ej.mjktp,
			ej.mjnama,
			ej.mjnamacn,
			ej.mjalmt,
			ej.mjalmtcn,
			ej.mjtelp,
			ej.mjfax,
			ej.mjpngjwb,
			ej.mjpngjwbcn,
			pp.ppnama,
			pp.ppalmtkantor,
			pp.pptelp,
			pp.ppfax,
			pp.ppijin,
			pp.pppngjwb,
			ej.joclano,
			ej.joclatgl,
			ej.joestduedate,
			ej.jojmltki,
			ej.jomkthn,
			ej.jomkbln,
			ej.jomkhr,
			ej.jocatatan,
			ej.joposisi,
			ej.joposisicn,
			ej.joakomodasi,
			ej.ejtglendorsement,
			ej.ejdatefilled,
			ej.jpgaji,
			ej.jpakomodasi');
			$this->db->from('entryjo ej');
	    $this->db->join('magensi ag', 'ag.agid = ej.agid');
			$this->db->join('mpptkis pp', 'pp.ppkode = ej.ppkode');
	    $this->db->where('ej.ejbcsp', $barcode);
	    return $this->db->get()->result();
	  }
		
  }

  ?>
