<?php
class PPTKIS_model extends CI_Model {
    private $table = 'mpptkis';
    public function __construct()
    {
        $this->load->database('default');
    }

    public function post_new_pptkis()
    {
    	$active = $this->input->post('active',TRUE);

    	if ($active) {
    		$active = true;
    	} else {
    		$active = false;
    	}

    	$data = array(
        'ppkode' => $this->input->post('kode',TRUE),
        'ppnama' => $this->input->post('name',TRUE),
        'ppalmtkantor' => $this->input->post('address',TRUE),
        'pptelp' => $this->input->post('notelp',TRUE),
        'ppfax' => $this->input->post('nofax',TRUE),
		    'ppijin' => $this->input->post('ijin',TRUE),
        'pppngjwb' => $this->input->post('name',TRUE),
        'ppstatus' => $this->input->post('name',TRUE),
        'ppkota' => $this->input->post('name',TRUE),
		    'pppropinsi' => $this->input->post('type',TRUE),
		    'ppenable' => $active
		);

    return $this->db->insert($this->table, $data);

    }

    function get_pptkis($cekal=false) {

      if($cekal==false){
        return $this->db->get($this->table)->result_array();
      }
      else{
        // $this->db->select('*');
        // $this->db->from('magensi m, cekalagensi c');
        // $this->db->where('c.agid = m.agid AND c.enable=1 AND (c.caend IS NULL OR c.caend >= NOW())');
        //
      }

    }
    function get_pptkis_info($id) {
      $this->db->select('*');
      $this->db->from('mpptkis');
      $this->db->where('ppkode', $id);
      $query = $this->db->get();

      return $query->row_array();
    }
  }
