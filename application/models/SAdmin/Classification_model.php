<?php
class Classification_model extends CI_Model {
    private $table = 'klasifikasi';
    public function __construct()
    {
        $this->load->database('default');
    }

    public function post_new_classification()
    {
    	$data = array(
		    'name' => $this->input->post('name',TRUE)
		);
    return $this->db->insert($this->table, $data);
    }

    public function update_classification($id)
    {
      $data = array(
        'name' => $this->input->post('name',TRUE)
      );
      $this->db->where('id',$id);
      return $this->db->update($this->table, $data);
    }

    public function delete_classification($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete($this->table);
    }

    public function list_all_classification()
    {
        return $this->db->get($this->table)->result();
    }

    public function list_active_classification()
    {
        return $this->db->get_where($this->table, array('isactive' => '1'))->result();
    }

    public function get_classification($id)
    {
        return $this->db->get_where($this->table, array('id' => $id))->row();
    }

    public function post_new_klasifikasi_institution($idinstitution)
    {
        $data = array(
            'idinstitution' => $idinstitution,
            'id' => $this->input->post('idklasifikasi',TRUE),
            'isactive' => '1'
        );

        return $this->db->insert('institution_has_klasifikasi', $data);
    }
    public function get_klasifikasi_institution()
    {
        $idinstitution = $this->input->post('idinstitution',TRUE);
        return $this->db->get_where('institution_has_klasifikasi', array('idinstitution' => $idinstitution))->result();
    }
    public function delete_klasifikasi_institution($idinstitution)
    {
        $idklasifikasi = $this->input->post('idklasifikasi',TRUE);

        $this->db->where('idinstitution',$idinstitution);
        $this->db->where('id',$idklasifikasi);
        return $this->db->delete('institution_has_klasifikasi');
    }
    public function check_klasifikasi_institution()
    {
        $idinstitution = $this->input->post('idinstitution',TRUE);
        $idklasifikasi = $this->input->post('idklasifikasi',TRUE);
        return $this->db->get_where('institution_has_klasifikasi', array('id' => $idklasifikasi, 'idinstitution' => $idinstitution))->row();
    }
}
