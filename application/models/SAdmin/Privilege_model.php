<?php
class Privilege_model extends CI_Model {

    public function __construct()
    {
        $this->load->database('default');
    }

    public function post_new_mpg()
    {
    	$data = array(
		    'masterprivilegegroupname' => $this->input->post('name',TRUE)
		);

		if( ! $this->db->insert('masterprivilegegroup', $data))
            var_dump($this->db->error());
        else
            return true;

    }

    public function post_new_pg()
    {
        $data = array(
            'privilegegroupname' => $this->input->post('name',TRUE),
            'masterprivilegegroupid' => $this->input->post('mpg',TRUE)
        );

        if( ! $this->db->insert('privilegegroup', $data))
            var_dump($this->db->error());
        else
            return true;

    }

    public function post_new_dp()
    {
        $data = array(
            'menuname' => $this->input->post('name',TRUE),
            'pageurl' => $this->input->post('url',TRUE),
            'idprivilegegroup' => $this->input->post('pg',TRUE)
        );

        if( ! $this->db->insert('privilegedetail', $data))
            var_dump($this->db->error());
        else
            return true;

    }
    public function get_mpg_name($id)
    {
        $this->db->select('masterprivilegegroupname');
        return $this->db->get_where('masterprivilegegroup', array('masterprivilegegroupid' => $id))->row();
    }

    public function get_pg_name($id)
    {
        $this->db->select('privilegegroupname');
        return $this->db->get_where('privilegegroup', array('idprivilegegroup' => $id))->row();
    }


    public function list_all_mpg()
    {
        $query = $this->db->get('masterprivilegegroup');
        return $query->result();
    }

    public function list_all_pg()
    {
        $query = $this->db->get('privilegegroup');
        return $query->result();
    }

    public function list_all_dp()
    {
        $query = $this->db->get('privilegedetail');
        return $query->result();
    }

    public function get_mpg($id)
    {
        return $this->db->get_where('masterprivilegegroup', array('masterprivilegegroupid' => $id))->row();
    }

    public function get_pg($id)
    {
        return $this->db->get_where('privilegegroup', array('idprivilegegroup' => $id))->row();
    }

    public function get_dp($id)
    {
        return $this->db->get_where('privilegedetail', array('idprivilege' => $id))->row();
    }

    public function update_mpg($id)
    {
        $data = array(
            'masterprivilegegroupname' => $this->input->post('name',TRUE)
        );
        $this->db->where('masterprivilegegroupid',$id);
        return $this->db->update('masterprivilegegroup',$data);
    }

    public function update_pg($id)
    {
        $data = array(
            'privilegegroupname' => $this->input->post('name',TRUE),
            'masterprivilegegroupid' => $this->input->post('mpg',TRUE)
        );
        $this->db->where('idprivilegegroup',$id);
        return $this->db->update('privilegegroup',$data);
    }

    public function update_dp($id)
    {
        $data = array(
            'menuname' => $this->input->post('name',TRUE),
            'pageurl' => $this->input->post('url',TRUE),
            'idprivilegegroup' => $this->input->post('pg',TRUE)
        );
        $this->db->where('idprivilege',$id);
        return $this->db->update('privilegedetail',$data);
    }

    public function delete_mpg($id)
    {
        $this->db->where('masterprivilegegroupid',$id);
        return $this->db->delete('masterprivilegegroup');
    }

    public function delete_pg($id)
    {
        $this->db->where('idprivilegegroup',$id);
        return $this->db->delete('privilegegroup');
    }

    public function delete_dp ($id)
    {
        $this->db->where('idprivilege',$id);
        return $this->db->delete('privilegedetail');
    }

    public function group_dp($listid)
    {
      $query = $this->db->query('SELECT idprivilegegroup FROM privilegedetail WHERE idprivilege IN ('.$listid.') GROUP BY idprivilegegroup');
      return $query->result();
    }

    public function count_group_dp($listid)
    {
      $query = $this->db->query('SELECT idprivilegegroup FROM privilegedetail WHERE idprivilege IN ('.$listid.') GROUP BY idprivilegegroup');
      return $query->num_rows();
    }

    public function group_pg($listid)
    {
      $query = $this->db->query('SELECT masterprivilegegroupid FROM privilegegroup WHERE idprivilegegroup IN ('.$listid.') GROUP BY masterprivilegegroupid');
      return $query->result();
    }


}
