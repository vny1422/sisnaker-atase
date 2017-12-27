<?php
class Institution_model extends CI_Model {
    private $table = 'institution';
    public function __construct()
    {
        $this->load->database('default');
    }

    public function post_new_institution()
    {
    	$active = $this->input->post('active',TRUE);

    	if ($active) {
    		$active = true;
    	} else {
    		$active = false;
    	}

    	$data = array(
		    'nameinstitution' => $this->input->post('name',TRUE),
		    'endorsementtype' => $this->input->post('type',TRUE),
        'idcurrency' => $this->input->post('currency',TRUE),
		    'isactive' => $active
		);

		return $this->db->insert($this->table, $data);
    }

    public function list_all_institution()
    {
        return $this->db->get($this->table)->result();
    }

    public function get_institution_name($id)
    {
        $this->db->select('nameinstitution');
        return $this->db->get_where($this->table, array('idinstitution' => $id))->row();
    }

    public function get_institution($id)
    {
        return $this->db->get_where($this->table, array('idinstitution' => $id))->row();
    }

    public function get_active_institution($id)
    {
        return $this->db->get_where($this->table, array('idinstitution' => $id,'isactive' => 1))->row();
    }

    public function list_active_institution()
    {
        return $this->db->get_where($this->table, array('isactive' => '1'))->result();
    }

    public function update_institution($id)
    {
        $active = $this->input->post('active',TRUE);
        if ($active) {
            $active = true;
        } else {
            $active = false;
        }
        $data = array(
            'nameinstitution' => $this->input->post('name',TRUE),
            'endorsementtype' => $this->input->post('type',TRUE),
            'isactive' => $active
        );
        $this->db->where('idinstitution',$id);
        return $this->db->update($this->table,$data);
    }

    public function delete_institution($id)
    {
        $this->db->where('idinstitution',$id);
        return $this->db->delete($this->table);
    }
}
