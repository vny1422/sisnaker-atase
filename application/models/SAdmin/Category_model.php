<?php
class Category_model extends CI_Model {
    
    public function __construct()
    {
        $this->load->database('default');
    }

    public function post_new_category($param)
    {
        if ($param == 'penempatan'){
            $table = 'inputcategory_penempatan';
            
        } else {
            $table = 'inputcategory_perlindungan';
        }
        $data = array(
            'namecategory' => $this->input->post('name',TRUE)
        );
    	
		return $this->db->insert($table, $data);
    }

    public function get_category_name($param, $id)
    {
        if ($param == 'penempatan'){
            $table = 'inputcategory_penempatan';
            $idcategory = 'idcategory_penempatan';
        } else {
            $table = 'inputcategory_perlindungan';
            $idcategory = 'idcategory_perlindungan';
        }

        $this->db->select('namecategory');
        return $this->db->get_where($table, array($idcategory => $id))->row();
    }

    public function list_all_category($param)
    {
        if ($param == 'penempatan'){
            $table = 'inputcategory_penempatan';
            
        } else {
            $table = 'inputcategory_perlindungan';
        }
        
        return $this->db->get($table)->result();
    }
}