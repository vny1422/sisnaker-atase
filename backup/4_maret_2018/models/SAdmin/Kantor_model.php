<?php
class Kantor_model extends CI_Model {
    private $table = 'kantor';
    public function __construct()
    {
        $this->load->database('default');
    }

    public function post_new_kantor()
    {
    	$active = $this->input->post('active',TRUE);

    	if ($active) {
    		$active = true;
    	} else {
    		$active = false;
    	}

    	$data = array(
		    'namakantor' => $this->input->post('name',TRUE),
		    'idinstitution' => $this->input->post('institution',TRUE),
		    'isactive' => $active
		);

		return $this->db->insert($this->table, $data);
    }

    public function list_all_kantor()
    {
        return $this->db->get($this->table)->result();
    }

    public function list_all_kantor_institution($idinstitution)
    {
        return $this->db->get_where($this->table, array('idinstitution' => $idinstitution))->result();
    }

    public function get_kantor_name($id)
    {
        $this->db->select('namakantor');
        return $this->db->get_where($this->table, array('idkantor' => $id))->row();
    }

    public function get_kantor($id)
    {
        return $this->db->get_where($this->table, array('idkantor' => $id))->row();
    }

    public function get_active_kantor($id)
    {
        return $this->db->get_where($this->table, array('idkantor' => $id,'isactive' => 1))->row();
    }

    public function list_active_kantor()
    {
        return $this->db->get_where($this->table, array('isactive' => '1'))->result();
    }

    public function update_kantor($id)
    {
        $active = $this->input->post('active',TRUE);
        if ($active) {
            $active = true;
        } else {
            $active = false;
        }
        $data = array(
            'namakantor' => $this->input->post('name',TRUE),
            'idinstitution' => $this->input->post('institution',TRUE),
            'isactive' => $active
        );
        $this->db->where('idkantor',$id);
        return $this->db->update($this->table,$data);
    }

    public function delete_kantor($id)
    {
        $this->db->where('idkantor',$id);
        return $this->db->delete($this->table);
    }

    public function get_kantoragensi_name($user)
    {
      $this->db->select('agnama as nama');
      $this->db->where('username', $user);
      $query = $this->db->get('magensi');
      if ( $query->num_rows() > 0 )
      {
        return $query->row();
      }
      else
      {
        $this->db->select('idkantor');
        $result = $this->db->get_where('user',array('username' => $user))->row();
        $this->db->select('namakantor as nama');
        return $this->db->get_where($this->table, array('idkantor' => $result->idkantor))->row();
      }

    }
}
