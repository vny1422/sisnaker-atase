<?php
class Agency_model extends CI_Model {
    private $table = 'magensi';
    public function __construct()
    {
        $this->load->database('default');
    }
    public function post_new_agency()
    {
      $active = $this->input->post('active',TRUE);

      if ($active) {
        $active = 1;
      } else {
        $active = 0;
      }

      $data = array(
        'agnama' => $this->input->post('name', TRUE),
        'agnamaoth' => $this->input->post('nameother', TRUE),
        'agnoijincla' => $this->input->post('noijin', TRUE),
        'agalmtkantor' => $this->input->post('address', TRUE),
        'agalmtkantoroth' => $this->input->post('addressother', TRUE),
        'username' => $this->input->post('user',TRUE),
        'idinstitution' => $this->input->post('institution',TRUE),
        'agpngjwb' => $this->input->post('penanggung',TRUE),
        'agpngjwboth' => $this->input->post('penanggungother',TRUE),
        'agtelp' => $this->input->post('notelp',TRUE),
        'agfax' => $this->input->post('nofax',TRUE),
        'agenable' => $active
    );

    return $this->db->insert($this->table, $data);
    }

    function get_agency($cekal=false) {
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

    function get_agency_info($id) {
      $this->db->select('agnama,agnamaoth,agalmtkantor,agalmtkantoroth,agpngjwb,agpngjwboth,agtelp,agfax,agnoijincla');
      $this->db->from('magensi');
      $this->db->where('agid', $id);
      $query = $this->db->get();

      return $query->row_array();
    }

}
