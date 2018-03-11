<?php
class Level_model extends CI_Model {

    private $table = 'level';
    public function __construct()
    {
        $this->load->database('default');
    }

    public function post_new_level()
    {
    	$data = array(
		    'levelname' => $this->input->post('name',TRUE)
		);

		if( ! $this->db->insert($this->table, $data))
            var_dump($this->db->error());
        else
            return true;
    }

    public function list_all_level()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_level_name($id)
    {
        $this->db->select('levelname');
        return $this->db->get_where($this->table, array('idlevel' => $id))->row();
    }

    public function get_level($id)
    {
        return $this->db->get_where('level', array('idlevel' => $id))->row();
    }

    public function update_level($id)
    {
        $data = array(
            'levelname' => $this->input->post('name',TRUE)
        );
        $this->db->where('idlevel',$id);
        return $this->db->update($this->table,$data);
    }

    public function delete_level($id)
    {
        $this->db->where('idlevel',$id);
        return $this->db->delete($this->table);
    }

    public function post_new_level_detail()
    {
        $data = array(
            'idlevel' => $this->input->post('idlevel',TRUE),
            'idprivilege' => $this->input->post('idprivilege',TRUE),
        );

        return $this->db->insert('level_has_privilegedetail', $data);
    }
    public function get_level_detail()
    {
        $idlevel = $this->input->post('idlevel',TRUE);
        return $this->db->get_where('level_has_privilegedetail', array('idlevel' => $idlevel))->result();
    }

    public function sidebar_level_detail($id)
    {
        $idlevel = $id;
        return $this->db->get_where('level_has_privilegedetail', array('idlevel' => $idlevel))->result();
    }

    public function delete_level_detail()
    {

        $idlevel = $this->input->post('idlevel',TRUE);
        $idprivilege = $this->input->post('idprivilege',TRUE);

        $this->db->where('idlevel',$idlevel);
        $this->db->where('idprivilege',$idprivilege);
        return $this->db->delete('level_has_privilegedetail');
    }

    public function count_level_detail($id)
    {
        $idlevel = $id;
        return $this->db->get_where('level_has_privilegedetail', array('idlevel' => $idlevel))->num_rows();

    }

    public function check_level_detail()
    {
        $idlevel = $this->input->post('idlevel',TRUE);
        $idprivilege = $this->input->post('idprivilege',TRUE);
        return $this->db->get_where('level_has_privilegedetail', array('idlevel' => $idlevel, 'idprivilege' => $idprivilege))->row();
    }

}
