<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FlightPenempatan_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	public function list_all_departure($institution = 'all',$kantor = 'all')
    {
    	$this->db->select('k.keberangkatanid, k.tkpaspor, t.tknama, k.bandaracode, k.transitport, k.timestamp');
        $this->db->from('keberangkatan k, tki t');
        $this->db->where('k.tkpaspor = t.tkpaspor');
        $this->db->group_by('k.tkpaspor, k.bandaracode, k.transitport');
        $this->db->order_by('k.timestamp');
  //       if ($institution != 'all')
		// {
		// 	$this->db->where('k.idinstitution',$institution);
		// }
		// if ($kantor != 'all')
		// {
		// 	$this->db->where('k.idkantor',$kantor);
		// }
		$query = $this->db->get();

		return $query->result();
    }

    public function get_departure($idkeberangkatan)
    {
    	return $this->db->get_where('keberangkatan', array('keberangkatanid' => $idkeberangkatan))->row();
    }

    public function update_departure($idkeberangkatan)
    {
    	$data = array(
    		'bandaracode' => $this->input->post('bandaracode',TRUE),
    		'transitport' => $this->input->post('transitport',TRUE),
    		'timestamp' => $this->input->post('timestamp',TRUE)
    	);
    	$this->db->where('keberangkatanid',$idkeberangkatan);

    	return $this->db->update('keberangkatan', $data);
    }

    public function delete_departure($idkeberangkatan)
    {
    	$this->db->where('keberangkatanid',$idkeberangkatan);
        return $this->db->delete('keberangkatan');
    }

    public function list_all_arrival($institution = 'all',$kantor = 'all')
    {
    	$this->db->select('k.kepulanganid, k.tkpaspor, t.tknama, k.bandaracode, k.transitport, k.timestamp');
        $this->db->from('kepulangan k, tki t');
        $this->db->where('k.tkpaspor = t.tkpaspor');
        $this->db->group_by('k.tkpaspor, k.bandaracode, k.transitport');
        $this->db->order_by('k.timestamp');
  //       if ($institution != 'all')
		// {
		// 	$this->db->where('k.idinstitution',$institution);
		// }
		// if ($kantor != 'all')
		// {
		// 	$this->db->where('k.idkantor',$kantor);
		// }
		$query = $this->db->get();

		return $query->result();
    }

    public function get_arrival($idkepulangan)
    {
    	return $this->db->get_where('kepulangan', array('kepulanganid' => $idkepulangan))->row();
    }

    public function update_arrival($idkepulangan)
    {
    	$data = array(
    		'bandaracode' => $this->input->post('bandaracode',TRUE),
    		'transitport' => $this->input->post('transitport',TRUE),
    		'timestamp' => $this->input->post('timestamp',TRUE)
    	);
    	$this->db->where('kepulanganid',$idkepulangan);

    	return $this->db->update('kepulangan', $data);
    }

    public function delete_arrival($idkepulangan)
    {
    	$this->db->where('kepulanganid',$idkepulangan);
        return $this->db->delete('kepulangan');
    }
}