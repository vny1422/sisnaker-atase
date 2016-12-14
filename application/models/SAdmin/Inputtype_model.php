<?php
class Inputtype_model extends CI_Model {
    private $table = 'inputtype';
    public function __construct()
    {
        $this->load->database('default');
    }

    public function post_new_inputtype()
    {
    	$data = array(
		    'nameinputtype' => $this->input->post('name',TRUE)
		);

		return $this->db->insert($this->table, $data);
    }

    public function get_inputtype_name($id)
    {
        $this->db->select('nameinputtype');
        return $this->db->get_where($this->table, array('idinputtype' => $id))->row();
    }

    public function get_inputtype($id)
    {
        return $this->db->get_where($this->table, array('idinputtype' => $id))->row();
    }

    public function list_all_inputtype()
    {
        return $this->db->get($this->table)->result();
    }

    public function update_inputtype($id)
    {
        $data = array(
          'nameinputtype' => $this->input->post('name',TRUE)
        );
        $this->db->where('idinputtype',$id);
        return $this->db->update($this->table,$data);
    }

    public function delete_inputtype($id)
		{
				$this->db->where('idinputtype',$id);
				return $this->db->delete($this->table);
		}

}
