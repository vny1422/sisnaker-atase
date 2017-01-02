<?php
class Paket_model extends CI_Model {
	public function __construct()
    {
        $this->load->database('default');
    }

    function getJobOrder($jobdid)
    {
    	$this->db->select('jo.*');
    	$this->db->from('jodetail, jo');
    	$this->db->where('jodetail.jobid = jo.jobid');
    	$this->db->where('jo.jobenable = 1');
    	$this->db->where('jodetail.jobdid', $jobdid);
    	$result = $this->db->get()->result();

    	return $result;
    }

    function getJO_ForTable($agid,$ppkode,$start,$limit,$sidx,$sord,$wh)
    {
        $sql = "SELECT *, DATE_FORMAT(jobtglawal, '%d/%m/%Y') as jobtglawal, DATE_FORMAT(jobtglakhir, '%d/%m/%Y') as jobtglakhir FROM jo WHERE ppkode = ".$ppkode." AND agid = ".$agid."".$wh." ORDER BY ".$sidx." ".$sord." LIMIT ".$start.",".$limit;
        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }

    function countJO($agid,$ppkode,$wh)
    {
        $sql = "SELECT COUNT(*) AS count FROM jo WHERE ppkode = ".$ppkode." AND agid = ".$agid."".$wh;
        $query = $this->db->query($sql);

        $num = $query->result()[0];

        return $num;
    }

    function addJO($ppkode,$agid)
    {
        $jobtglawal = DateTime::createFromFormat('d/m/Y', $this->input->post('jobtglawal', TRUE));
        $tglawalbaru = $jobtglawal->format('Y-m-d');
        $jobtglakhir = DateTime::createFromFormat('d/m/Y', $this->input->post('jobtglakhir', TRUE));
        $tglawalakhir = $jobtglakhir->format('Y-m-d');

        $data = array(
            'ppkode' => $ppkode,
            'agid' => $agid,
            'idinstitution' => $this->session->userdata('institution'),
            'jobno' => $this->input->post('jobno', TRUE),
            'jobtglawal' => $tglawalbaru,
            'jobtglakhir' => $tglawalakhir,
            'jobenable' => $this->input->post('jobenable', TRUE),
            'username' => $this->session->userdata('user')
        );
        
        return $this->db->insert('jo', $data);
    }

    function updateJO($id)
    {
        $jobtglawal = DateTime::createFromFormat('d/m/Y', $this->input->post('jobtglawal', TRUE));
        $tglawalbaru = $jobtglawal->format('Y-m-d');
        $jobtglakhir = DateTime::createFromFormat('d/m/Y', $this->input->post('jobtglakhir', TRUE));
        $tglawalakhir = $jobtglakhir->format('Y-m-d');

        $data = array(
            'idinstitution' => $this->session->userdata('institution'),
            'jobno' => $this->input->post('jobno', TRUE),
            'jobtglawal' => $tglawalbaru,
            'jobtglakhir' => $tglawalakhir,
            'jobenable' => $this->input->post('jobenable', TRUE),
            'username' => $this->session->userdata('user')
        );
        
        $this->db->where('jobid',$id);
        return $this->db->update('jo', $data);
    }

    function deleteJO($id)
    {
        $this->db->where('jobid',$id);
        return $this->db->delete('jo');
    }

    function addJODetail($jobid)
    {
        $data = array(
            'jobid' => $jobid,
            'idjenispekerjaan' => $this->input->post('jpnama', TRUE),
            'jobdl' => $this->input->post('jobdl', TRUE),
            'jobdp' => $this->input->post('jobdp', TRUE),
            'jobdc' => $this->input->post('jobdc', TRUE)
        );
        
        return $this->db->insert('jodetail', $data);
    }

    function updateJODetail($id)
    {
        $data = array(
            'idjenispekerjaan' => $this->input->post('jpnama', TRUE),
            'jobdl' => $this->input->post('jobdl', TRUE),
            'jobdp' => $this->input->post('jobdp', TRUE),
            'jobdc' => $this->input->post('jobdc', TRUE)
        );
        
        $this->db->where('jobdid',$id);
        return $this->db->update('jodetail', $data);
    }

    function deleteJODetail($id)
    {
        $this->db->where('jobdid',$id);
        return $this->db->delete('jodetail');
    }

    function getJobDetail($jpid,$agid,$ppkode,$jobtglawalnya,$jobtglakhirnya)
    {
    	$this->db->select('jo.jobid, jobdid, jobtglawal, jobtglakhir, jobdl, jobdp, jobdc');
    	$this->db->from('jodetail, jo');
    	$this->db->where('jodetail.jobid = jo.jobid');
    	$this->db->where('jo.agid', $agid);
    	$this->db->where('jo.ppkode', $ppkode);
    	$this->db->where('jodetail.idjenispekerjaan', $jpid);
    	$this->db->where('jo.jobenable = 1');
    	$this->db->where("jo.jobtglawal <= '".$jobtglawalnya."' and jo.jobtglakhir <= '".$jobtglakhirnya."'");
    	$this->db->group_by('jobid');
    	$this->db->order_by('jobtglakhir ASC, jobtglawal ASC');
    	$result = $this->db->get()->result();

    	return $result;
    }

    function getJOD_ForTable($jobid,$start,$limit,$sidx,$sord,$wh)
    {
        $sql = "SELECT * FROM jodetail JOIN jenispekerjaan ON jenispekerjaan.idjenispekerjaan = jodetail.idjenispekerjaan WHERE jobid = ".$jobid."".$wh." ORDER BY ".$sidx." ".$sord." LIMIT ".$start.",".$limit;
        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }

    function countJOD($jobid,$wh)
    {
        $sql = "SELECT COUNT(*) AS count FROM jodetail JOIN jenispekerjaan ON jenispekerjaan.idjenispekerjaan = jodetail.idjenispekerjaan WHERE jobid = ".$jobid."".$wh;
        $query = $this->db->query($sql);

        $num = $query->result()[0];

        return $num;
    }

    function getJP()
    {
        $this->db->select('*');
        $this->db->from('jenispekerjaan');
        $this->db->order_by('namajenispekerjaan ASC');
        $result = $this->db->get()->result();

        return $result;
    }

    function getDate($jpid,$agid,$ppkode,$jobtglawalnya,$jobtglakhirnya)
    {
    	$this->db->distinct();
    	$this->db->select('jobtglawal AS date');
    	$this->db->from('jodetail, jo');
    	$this->db->where('jodetail.jobid = jo.jobid');
    	$this->db->where('jo.agid', $agid);
    	$this->db->where('jo.ppkode', $ppkode);
    	$this->db->where('jodetail.idjenispekerjaan', $jpid);
    	$this->db->where('jo.jobenable = 1');
    	$this->db->where("jo.jobtglakhir <= '".$jobtglakhirnya."'");
    	$query1 = $this->db->get_compiled_select();

    	$this->db->distinct();
    	$this->db->select('jobtglakhir AS date');
    	$this->db->from('jodetail, jo');
    	$this->db->where('jodetail.jobid = jo.jobid');
    	$this->db->where('jo.agid', $agid);
    	$this->db->where('jo.ppkode', $ppkode);
    	$this->db->where('jodetail.idjenispekerjaan', $jpid);
    	$this->db->where('jo.jobenable = 1');
    	$this->db->where("jo.jobtglakhir <= '".$jobtglakhirnya."'");
    	$query2 = $this->db->get_compiled_select();

    	$query = $this->db->query("(".$query1.") UNION (".$query2.") ORDER BY date ASC");

    	return $query->result();
    }

    function getEntryJOLaki($start,$end,$jpid,$agid,$ppkode)
    {
		$this->db->select('tkid');
		$this->db->from('tki, entryjo');
		$this->db->where('tki.ejid = entryjo.ejid');
		$this->db->where('tkrevid IS NULL');
		$this->db->where("tkjk like 'L'");
		$this->db->where("entryjo.ejtglendorsement >= '" . $start . "'");
		$this->db->where("entryjo.ejtglendorsement < '" . $end . "'");
		$this->db->where('entryjo.agid', $agid);
		$this->db->where('entryjo.ppkode', $ppkode);
		$this->db->where('entryjo.idjenispekerjaan', $jpid);

		$num = $this->db->count_all_results();

  		return $num;
    }

    function getEntryJOPerempuan($start,$end,$jpid,$agid,$ppkode)
    {
		$this->db->select('tkid');
		$this->db->from('tki, entryjo');
		$this->db->where('tki.ejid = entryjo.ejid');
		$this->db->where('tkrevid IS NULL');
		$this->db->where("tkjk like 'P'");
		$this->db->where("entryjo.ejtglendorsement >= '" . $start . "'");
		$this->db->where("entryjo.ejtglendorsement < '" . $end . "'");
		$this->db->where('entryjo.agid', $agid);
		$this->db->where('entryjo.ppkode', $ppkode);
		$this->db->where('entryjo.idjenispekerjaan', $jpid);

		$num = $this->db->count_all_results();

  		return $num;
    }

}