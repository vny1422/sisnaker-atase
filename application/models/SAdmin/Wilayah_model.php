<?php
class Wilayah_model extends CI_Model {
    private $table = 'wilayah';
    public function __construct()
    {
        $this->load->database('default');
    }

    public function post_new_wilayah()
    {
    	$data = array(
		    'name' => $this->input->post('name',TRUE)
		);
    return $this->db->insert($this->table, $data);
    }

    public function update_wilayah($id)
    {
      $data = array(
        'name' => $this->input->post('name',TRUE)
      );
      $this->db->where('id',$id);
      return $this->db->update($this->table, $data);
    }

    public function delete_wilayah($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete($this->table);
    }

    public function list_all_wilayah()
    {
        return $this->db->get($this->table)->result();
    }

    public function list_active_wilayah()
    {
        return $this->db->get_where($this->table, array('isactive' => '1'))->result();
    }

    public function get_wilayah($id)
    {
        return $this->db->get_where($this->table, array('id' => $id))->row();
    }

    public function post_new_wilayah_institution($idinstitution)
    {
        $data = array(
            'idinstitution' => $idinstitution,
            'id' => $this->input->post('idwilayah',TRUE),
            'isactive' => '1'
        );

        return $this->db->insert('institution_has_wilayah', $data);
    }
    public function get_wilayah_institution()
    {
        $idinstitution = $this->input->post('idinstitution',TRUE);
        return $this->db->get_where('institution_has_wilayah', array('idinstitution' => $idinstitution))->result();
    }
    public function delete_wilayah_institution($idinstitution)
    {
        $idwilayah = $this->input->post('idwilayah',TRUE);

        $this->db->where('idinstitution',$idinstitution);
        $this->db->where('id',$idwilayah);
        return $this->db->delete('institution_has_wilayah');
    }
    public function check_wilayah_institution()
    {
        $idinstitution = $this->input->post('idinstitution',TRUE);
        $idwilayah = $this->input->post('idwilayah',TRUE);
        return $this->db->get_where('institution_has_wilayah', array('id' => $idwilayah, 'idinstitution' => $idinstitution))->row();
    }
}
