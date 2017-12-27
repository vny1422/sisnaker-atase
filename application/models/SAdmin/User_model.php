<?php
class User_model extends CI_Model {
    private $table = 'user';
    public function __construct()
    {
        $this->load->database('default');
    }

    public function get_user($username,$password)
    {
		$query = $this->db->get_where($this->table, array('username' => $username, 'password' => md5($password)));
        return $query->result_array();
    }

    public function get_userid($username)
    {
    $query = $this->db->get_where($this->table, array('username' => $username));
        return $query->row();
    }

    public function get_user_institution($username)
    {
      $query = $this->db->get_where($this->table, array('username' => $username));
      $hasil = $query->row();
      $this->db->select('nameinstitution');
      return $this->db->get_where('institution', array('idinstitution' => $hasil->idinstitution))->row();
    }

    public function post_new_user()
    {
        $data = array(
            'username' => $this->input->post('username',TRUE),
            'password' => md5($this->input->post('password',TRUE)),
            'name' => $this->input->post('name',TRUE),
            'idinstitution' => $this->input->post('institution',TRUE),
            'idlevel' => $this->input->post('level',TRUE),
            'idkantor' => empty($this->input->post('kantor',TRUE)) ? NULL : $this->input->post('kantor', TRUE)
        );
        return $this->db->insert($this->table, $data);
    }

    public function post_new_userreg($user,$pass,$idinst,$agnama)
    {
        $data = array(
            'username' => $user,
            'password' => $pass,
            'name' => $agnama,
            'idinstitution' => $idinst,
            'idlevel' => 4,
        );

        return $this->db->insert($this->table, $data);
    }

    public function list_all_user()
    {
        return $this->db->get($this->table)->result();
    }

    public function list_all_user_by_institution($id)
    {
        $this->db->where('idinstitution',$id);
        return $this->db->get($this->table)->result();
    }

    public function update_user($username)
    {
        $data = array(
          'name' => $this->input->post('name',TRUE),
          'idinstitution' => $this->input->post('institution',TRUE),
          'idlevel' => $this->input->post('level',TRUE),
          'idkantor' => empty($this->input->post('kantor',TRUE)) ? NULL : $this->input->post('kantor', TRUE)
        );
        $this->db->where('username',$username);
        return $this->db->update($this->table,$data);
    }

    public function delete_user($username)
    {
        $this->db->where('username',$username);
        return $this->db->delete($this->table);
    }

    public function update_pass_profile($username, $password=NULL, $picture=NULL){
        if($password) {
            $this->db->set('password', md5($password));
        }
        if($picture) {
            $this->db->set('picture', $picture);
        }
        $this->db->where('username',$username);
        return $this->db->update($this->table);
    }
}
