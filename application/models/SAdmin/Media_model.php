<?php
class Media_model extends CI_Model {
    private $table = 'media';
    public function __construct()
    {
        $this->load->database('default');
    }

    public function post_new_Media()
    {
    	$data = array(
		    'name' => $this->input->post('name',TRUE)
		);
    return $this->db->insert($this->table, $data);
    }

    public function update_Media($id)
    {
      $data = array(
        'name' => $this->input->post('name',TRUE)
      );
      $this->db->where('id',$id);
      return $this->db->update($this->table, $data);
    }

    public function delete_Media($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete($this->table);
    }

    public function list_all_Media()
    {
        return $this->db->get($this->table)->result();
    }

    public function list_active_Media()
    {
        return $this->db->get_where($this->table, array('isactive' => '1'))->result();
    }

    public function get_Media($id)
    {
        return $this->db->get_where($this->table, array('id' => $id))->row();
    }

    public function post_new_media_institution($idinstitution)
    {
        $data = array(
            'idinstitution' => $idinstitution,
            'id' => $this->input->post('idMedia',TRUE),
            'isactive' => '1'
        );

        return $this->db->insert('institution_has_media', $data);
    }
    public function get_media_institution()
    {
        $idinstitution = $this->input->post('idinstitution',TRUE);
        return $this->db->get_where('institution_has_media', array('idinstitution' => $idinstitution))->result();
    }
    public function delete_media_institution($idinstitution)
    {
        $idmedia = $this->input->post('idMedia',TRUE);

        $this->db->where('idinstitution',$idinstitution);
        $this->db->where('id',$idmedia);
        return $this->db->delete('institution_has_media');
    }
    public function check_media_institution()
    {
        $idinstitution = $this->input->post('idinstitution',TRUE);
        $idmedia = $this->input->post('idMedia',TRUE);
        return $this->db->get_where('institution_has_media', array('id' => $idmedia, 'idinstitution' => $idinstitution))->row();
    }
}
