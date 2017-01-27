<?php
class Endorsement_model extends CI_Model {
	public function __construct()
    {
        $this->load->database('default');
    }

	function catatKuitansi_ej($ejid,$kuid)
	{
		$data = array(
			'kuid' => $kuid,
			'ejid' => $ejid
		);

		return $this->db->insert('pencatatanej', $data);
	}

	function catat_logagensi($agid)
	{
		$date = date("Y-m-d");
		$data = array(
			'agid' => $agid,
			'timestamp' => $date
		);

		return $this->db->insert('logagensi', $data);
	}

    function getKuitansi_FromBarcode($code)
    {
    	$sql = "SELECT
            		DATE_FORMAT(ku.kutglmasuk, '%d/%m/%Y') as kutglmasuk,
            		DATE_FORMAT(ku.kutglkuitansi, '%d/%m/%Y') as kutglkuitansi,
            		tp.tipe, ku.kuno, ku.kujmlbayar, ku.kupemohon, ku.idtipe, ku.username
		        FROM
		           	kuitansi ku JOIN tipe tp ON tp.idtipe = ku.idtipe
		        WHERE
		            ku.kukode = '$code' AND ku.kukode IS NOT NULL
		            AND ku.idinstitution = ".$this->session->userdata('institution')."";

		$query = $this->db->query($sql);

        $result = $query->result_array();

        return $result;
    }

    function checkEntryJO_FromBarcode($code)
    {
    	$sql = "SELECT
					count(ej.ejid) as count, ej.ejid
				FROM
					entryjo ej
					LEFT JOIN tki tk ON tk.ejid = ej.ejid
				WHERE
					(ej.ejbcsp = '$code' OR ej.ejbcsk = '$code' OR ej.ejbcform = '$code' OR tk.tkbc = '$code')
					AND ej.idinstitution = ".$this->session->userdata('institution')."
				GROUP BY
					ej.ejid";

		$query = $this->db->query($sql);

        $result = $query->result_array();

        return $result;
    }

    function checkEntryJO_ForRevisiPK($code)
    {
    	$sql = "SELECT
					count(ej.ejid) as count, ej.ejid
				FROM
					entryjo ej
					LEFT JOIN tki tk ON tk.ejid = ej.ejid
				WHERE
					tk.tkbc = '$code'
					AND ej.idinstitution = ".$this->session->userdata('institution')."
				GROUP BY
					ej.ejid";

		$query = $this->db->query($sql);

        $result = $query->result_array();

        return $result;
    }

    function checkEJOForPrint($token,$bc)
    {
    	$sql = "SELECT
					count(*) as count
				FROM
					tki tk
					JOIN entryjo ej ON ej.ejid = tk.ejid
				WHERE
					(ej.ejbcsp = '$bc' OR ej.ejbcsk = '$bc' OR ej.ejbcform = '$bc' OR tk.tkbc = '$bc')
					AND ej.ejtoken = '$token'";

		$query = $this->db->query($sql);

        $result = $query->result_array();

        return $result;
    }

    function getEntryJO($ejid)
    {
    	$sql = "SELECT
					mag.agnama, mag.agnoijincla, mag.agalmtkantor, mag.agpngjwb, mag.agtelp, mag.agfax,
					mpp.ppnama, mpp.ppalmtkantor, mpp.pptelp, mpp.ppfax, mpp.ppijin, mpp.pppngjwb,
					ej.mjktp, ej.mjnama, ej.mjnamacn, ej.mjalmt, ej.mjtelp, ej.mjfax, ej.mjpngjwb,
					jp.idjenispekerjaan, jp.namajenispekerjaan, jp.sektor, jp.jpgaji,
					ej.joclano, ej.joclatgl, ej.joestduedate, ej.joposisi, ej.jojmltki, ej.jomkthn, ej.jomkbln, ej.jomkhr, ej.jocatatan, ej.joakomodasi,
					ej.ejid, ej.ejtglendorsement, ej.ejtoken, ej.ejbcsp, ej.ejbcsk
				FROM
					entryjo ej
					JOIN jenispekerjaan jp ON jp.idjenispekerjaan = ej.idjenispekerjaan
					JOIN magensi mag ON mag.agid = ej.agid
					JOIN mpptkis mpp ON mpp.ppkode = ej.ppkode
				WHERE
					ej.ejid = '$ejid'
					AND ej.idinstitution = ".$this->session->userdata('institution')."";

		$query = $this->db->query($sql);

        $result = $query->result_array();

        return $result;
    }

    function getEntryJO_Agensi($agid)
    {
    	$this->db->select('ej.ejid,ej.ejdatefilled,ej.ejtglendorsement,ej.ejbcsp,mpp.ppnama,jp.namajenispekerjaan');
		$this->db->from('entryjo ej');
    	$this->db->join('mpptkis mpp','mpp.ppkode = ej.ppkode');
    	$this->db->join('jenispekerjaan jp','jp.idjenispekerjaan = ej.idjenispekerjaan');
    	$this->db->where('ej.agid',$agid);
    	return $this->db->get()->result();
    }

    function getKuitansi($ejid)
    {
    	$sql = "SELECT
					DATE_FORMAT(ku.kutglmasuk, '%d/%m/%Y') as kutglmasuk,
					DATE_FORMAT(ku.kutglkuitansi, '%d/%m/%Y') as kutglkuitansi,
					tp.tipe, ku.kuno, ku.kujmlbayar, ku.kupemohon, ku.idtipe, ku.username
				FROM
					entryjo ej
					JOIN pencatatanej pej ON pej.ejid = ej.ejid
					JOIN kuitansi ku ON ku.kuid = pej.kuid
					JOIN tipe tp ON tp.idtipe = ku.idtipe
				WHERE
					ej.ejid = '$ejid'
					AND ej.idinstitution = ".$this->session->userdata('institution')."";

		$query = $this->db->query($sql);

        $result = $query->result_array();

        return $result;
    }

    function getTKINow($ejid)
    {
    	$sql = "SELECT
					tk.tknama, tk.tkbc
				FROM tki tk
				WHERE tk.ejid = '$ejid' AND tk.tkrevid IS NULL";

		$query = $this->db->query($sql);

        $result = $query->result_array();

        return $result;
    }

    function getTKI($ejid)
    {
    	$sql = "SELECT
    				tk.tkid, tk.tknama, tk.tkalmtid, tk.tkpaspor, tk.tktglkeluar, tk.tktmptkeluar, tk.tktgllahir, tk.tktmptlahir, tk.tkjk, tk.tkstatkwn, tk.tkjmlanaktanggungan, tk.tkahliwaris, tk.tknama2, tk.tkalmt2, tk.tktelp, tk.tkhub, tk.tkstat, tk2.tknama as 'tkrevnama', tk.tktglendorsement
    			FROM
    				tki tk
    				LEFT JOIN tki tk2 ON tk2.tkid = tk.tkrevid
    			WHERE tk.ejid = '$ejid'";

    	$query = $this->db->query($sql);

        $result = $query->result_array();

        return $result;
    }

    function getTKI_FromBarcode($code)
    {
    	$sql = "SELECT
					tk.*
				FROM
					tki tk
				WHERE tk.tkbc = '$code'";

		$query = $this->db->query($sql);

        $result = $query->result_array();

        return $result;
    }

    function countRevisiTKI($ejid)
    {
    	$sql = "SELECT
					tk.tkid, tk.tkbc, tk.tkrevid, tk.tktglendorsement
				FROM tki tk
				WHERE tk.ejid = '$ejid'";

		$query = $this->db->query($sql);

        $result = $query->result_array();

        return $result;
    }

    function getTKILama($tkid)
    {
    	$sql = "SELECT
					tk.*
				FROM tki tk
				WHERE tk.tkrevid = $tkid";

		$query = $this->db->query($sql);

        $result = $query->result_array();

        return $result;
    }

    function updateEndorseTKI($code)
    {
    	$this->db->set('tktglendorsement', 'NOW()', FALSE);
    	$this->db->where('tkbc',$code);
    	return $this->db->update('tki');
    }

	//for jo Packet

    function get_connected_pptkis($agid)
    {
    	$this->db->where('agid',$agid);
    	$this->db->where('jobtglawal <= curdate() AND jobtglakhir >= curdate()');
    	$this->db->from('jo');
    	$this->db->join('mpptkis m', 'jo.ppkode = m.ppkode','left');
    	$this->db->select('m.ppkode,m.ppnama,jo.jobid');
    	return $this->db->get()->result();
    }

    function get_jodetail($jobid)
    {
    	$this->db->select('j.*,jp.namajenispekerjaan as namajenispekerjaan');
    	$this->db->from('jodetail j');
    	$this->db->join('jenispekerjaan jp', 'j.idjenispekerjaan = jp.idjenispekerjaan','left');
    	$this->db->where('j.jobid',$jobid);
    	return $this->db->get()->result();
    }

    function get_all_year(){
		$this->db->distinct();
		$this->db->select('YEAR(ejtglendorsement) as tahun');
		$this->db->from('entryjo');
		$this->db->order_by('ejtglendorsement','desc');
		return $this->db->get()->result();
	}

}
