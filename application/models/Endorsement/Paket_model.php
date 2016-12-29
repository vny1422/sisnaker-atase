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