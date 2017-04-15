<?php
class Currency_model extends CI_Model {
    private $table = 'currency';
    public function __construct()
    {
        $this->load->database('default');
    }

    public function post_new_currency()
    {
    	$data = array(
		    'currencyname' => $this->input->post('name',TRUE),
        'kurs' => $this->input->post('kurs',TRUE)
		);
    return $this->db->insert($this->table, $data);
    }

    public function update_currency($id)
    {
      $data = array(
        'currencyname' => $this->input->post('name',TRUE),
        'kurs' => $this->input->post('kurs',TRUE)
      );
      $this->db->where('idcurrency',$id);
      return $this->db->update($this->table, $data);
    }

    public function delete_currency($id)
    {
        $this->db->where('idcurrency',$id);
        return $this->db->delete($this->table);
    }

    public function list_all_currency()
    {
        return $this->db->get($this->table)->result();
    }


    public function get_currency($id)
    {
        return $this->db->get_where($this->table, array('idcurrency' => $id))->row();
    }

    public function get_currency_name($id)
    {
        $this->db->select('currencyname');
        return $this->db->get_where($this->table, array('idcurrency' => $id))->row();
    }

    public function get_currency_name_institution($idinstitution)
    {
        $this->db->select('currencyname');
        $this->db->from('institution i');
        $this->db->join('currency c', 'c.idcurrency=i.idcurrency');
        $this->db->where('idinstitution',$idinstitution);
        $query = $this->db->get();
        
        return $query->row();
    }

}
