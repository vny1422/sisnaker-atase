<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shelter_model extends CI_Model {

	public function __construct()
	{
		$this->load->database('default');
	}

	public function post_new_shelter()
    {
    	$active = $this->input->post('active',TRUE);

    	if ($active) {
    		$active = true;
    	} else {
    		$active = false;
    	}

    	$data = array(
		    'name' => $this->input->post('name',TRUE),
		    'idinstitution' => $this->input->post('institution',TRUE),
		    'isactive' => $active
		);

		return $this->db->insert('shelter', $data);
    }

    public function list_all_shelter()
    {
        return $this->db->get('shelter')->result();
    }

	public function query_shelter_list(){
		$q = $this->db->get('shelter');
		return $q->result_array();		
	}

	public function query_shelter_institution($id){
		$q = $this->db->get_where('shelter', array('idinstitution' => $id));
		return $q->result();
	}

	public function query_shelter_institution_array($id){
		$q = $this->db->get_where('shelter', array('idinstitution' => $id));
		return $q->result_array();
	}

	public function get_shelter_name($id)
    {
        $this->db->select('name');
        return $this->db->get_where('shelter', array('id' => $id))->row();
    }

    public function get_shelter($id)
    {
        return $this->db->get_where('shelter', array('id' => $id))->row();
    }

    public function get_active_shelter($id)
    {
        return $this->db->get_where('shelter', array('id' => $id,'isactive' => 1))->row();
    }

    public function list_active_shelter()
    {
        return $this->db->get_where('shelter', array('isactive' => '1'))->result();
    }

    public function update_shelter($id)
    {
        $active = $this->input->post('active',TRUE);

    	if ($active) {
    		$active = true;
    	} else {
    		$active = false;
    	}

    	$data = array(
		    'name' => $this->input->post('name',TRUE),
		    'idinstitution' => $this->input->post('institution',TRUE),
		    'isactive' => $active
		);
        $this->db->where('id',$id);
        return $this->db->update('shelter',$data);
    }

    public function delete_shelter($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete('shelter');
    }
	
	// function query_resident_month($id,$month,$year){
	// 	$this->db->select("m.idmasalah, t.namatki, t.paspor, k.name AS klasifikasi, YEAR(m.tanggalpengaduan) AS yearadu, u.name AS petugas, m.statusmasalah ");
	// 	$this->db->from("shelter s, tkimasalah t, masalah m, klasifikasi k, user u");
	// 	$this->db->where("m.isinshelter = 1");
	// 	$this->db->where("m.idshelter = s.id");
	// 	$this->db->where("m.petugaspenanganan = u.username");
	// 	$this->db->where("m.idmasalah = t.idmasalah");
	// 	$this->db->where("m.idklasifikasi = k.id");
	// 	$this->db->where("s.id",$id);
	// 	$this->db->where("m.tanggalmasukshelter <= LAST_DAY('".$year."-".$month."-01')");
	// 	$this->db->where("(m.tanggalkeluarshelter = '0000-00-00' OR m.tanggalkeluarshelter>='".$year."-".$month."-01')");
	// 	$q = $this->db->get();
	// 	if($q->num_rows() > 0){
	// 		return $q->result_array();	
	// 	}
	// 	return 0;	
	// }

	function query_resident_month($id,$month,$year){
		$this->db->select('idmasalah');
		$this->db->from('masalah_has_shelter');
		$this->db->where('idshelter',$id);
		$this->db->where("tanggalmasukshelter <= LAST_DAY('".$year."-".$month."-01')");
		$this->db->where("(tanggalkeluarshelter = '0000-00-00' OR tanggalkeluarshelter>='".$year."-".$month."-01')");
		$where_clause = $this->db->get_compiled_select();

		$this->db->select("m.idmasalah, t.namatki, t.paspor, k.name AS klasifikasi, YEAR(m.tanggalpengaduan) AS yearadu, u.name AS petugas, m.statusmasalah ");
		$this->db->from("tkimasalah t, masalah m, klasifikasi k, user u");
		$this->db->where("`m`.`idmasalah` IN ($where_clause)", NULL, FALSE);
		$this->db->where("m.petugaspenanganan = u.username");
		$this->db->where("m.idmasalah = t.idmasalah");
		$this->db->where("m.idklasifikasi = k.id");
		$this->db->where("m.isinshelter = 1");
		$q = $this->db->get();
		if($q->num_rows() > 0){
			return $q->result_array();	
		}
		return 0;	
	}

	function recap_shelter($idorg,$month,$year){
		$this->db->select('idmasalah');
		$this->db->from('masalah_has_shelter');
		$this->db->where('idshelter',$idorg);
		$this->db->where("tanggalmasukshelter <= LAST_DAY('".$year."-".$month."-01')");
		$this->db->where("(tanggalkeluarshelter = '0000-00-00' OR tanggalkeluarshelter>='".$year."-".$month."-01')");
		$where_clause = $this->db->get_compiled_select();

		$this->db->select('m.idmasalah, t.namatki, t.paspor, m.pptkis, m.agensi, m.teleponagensi, m.tanggalmasuktaiwan,
			m.majikan, m.namapelapor, m.permasalahan, m.tanggalmasukshelter, m.tanggalkeluarshelter, s.name');
		$this->db->from('masalah m, tkimasalah t, shelter s');
		$this->db->where("`m`.`idmasalah` IN ($where_clause)", NULL, FALSE);
		$this->db->where("m.isinshelter = 1");
		$this->db->where("m.idmasalah = t.idmasalah");
		$this->db->where("s.id",$idorg);
		
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$final = $query->result_array();
			
			for($i=0;$i<count($final);$i++){
				$id = $final[$i]['idmasalah'];
				$final[$i]['tindaklanjut'] = $this->getFormatedTindakLanjut($id);			
			}
			return $final;
		}
		else{
			return 0;
		}
	}
	
	function getFormatedTindakLanjut($idproblem){
		$tl = $this->db->query(" SELECT tanggal,tindakan,username FROM tindak_lanjut ".
			" WHERE idmasalah=".$idproblem." ORDER BY tanggal ASC");
		if($tl->num_rows()>0) {
			$tl = $tl->result_array();
			$story = "";
			
			for($i=0;$i<count($tl);$i++){
				$val = $tl[$i];
				$val['tindakan'] = preg_replace("/\n+/", "\n", $val['tindakan']);
				$txt = "[".$val['username']." ".$val['tanggal']."] \r\n ".$val['tindakan']." \r\n";
				$story = $story.$txt;
			}
			
			return $story;
		}
		else return null;
	}
}