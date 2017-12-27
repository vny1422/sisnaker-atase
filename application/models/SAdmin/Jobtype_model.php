<?php
class Jobtype_model extends CI_Model {
    private $table = 'jenispekerjaan';
    public function __construct()
    {
        $this->load->database('default');
    }

    public function post_new_jobtype()
    {
    	$active = $this->input->post('active',TRUE);

    	if ($active) {
    		$active = true;
    	} else {
    		$active = false;
    	}

    	$data = array(
		    'namajenispekerjaan' => $this->input->post('name',TRUE),
		    'idinstitution' => $this->input->post('institution',TRUE),
        'idpekerjaan_bnp2tki' => $this->input->post('bnptki',TRUE),
        'sektor' => $this->input->post('sektor',TRUE),
        'jpgaji' => $this->input->post('gaji',TRUE),
        'curjodownloadurl' => $this->input->post('jourl',TRUE),
        'curtkidownloadurl' => $this->input->post('tkiurl',TRUE),
		    'isactive' => $active
		);

		return $this->db->insert($this->table, $data);
    }

    public function list_all_jobtype()
    {
        return $this->db->get($this->table)->result();
    }

    public function list_all_jobtype_by_institution($id)
    {
        $this->db->where('idinstitution',$id);
        return $this->db->get($this->table)->result();
    }

    public function get_jobtype($id)
    {
        return $this->db->get_where($this->table, array('idjenispekerjaan' => $id))->row();
    }

    public function update_jobtype($id)
    {
        $active = $this->input->post('active',TRUE);
        if ($active) {
            $active = true;
        } else {
            $active = false;
        }
        $data = array(
            'namajenispekerjaan' => $this->input->post('name',TRUE),
            'idinstitution' => $this->input->post('institution',TRUE),
            'isactive' => $active,
            'jpgaji' => $this->input->post('gaji',TRUE),
            'curjodownloadurl' => $this->input->post('jourl',TRUE),
            'curtkidownloadurl' => $this->input->post('tkiurl',TRUE),
            'idpekerjaan_bnp2tki' => $this->input->post('bnptki',TRUE)
        );
        $this->db->where('idjenispekerjaan',$id);
        return $this->db->update($this->table,$data);
    }

    public function delete_jobtype($id)
    {
        $this->db->where('idjenispekerjaan',$id);
        return $this->db->delete($this->table);
    }

    function get_sektor($idj){
      $this->db->select('*');
      $this->db->from('jenispekerjaan');
      $this->db->where('idjenispekerjaan',$idj);
      $query = $this->db->get();
      $query = $query->row();
      return $query->sektor;
    }
}
