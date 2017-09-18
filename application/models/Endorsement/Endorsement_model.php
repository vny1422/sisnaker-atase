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
					ej.ejid, ej.ejtglendorsement, ej.ejtoken, ej.ejbcsp, ej.ejbcsk, ej.md5ej, ej.jodownloadurl
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
    				tk.tkid, tk.tknama, tk.tkalmtid, tk.tkpaspor, tk.tktglkeluar, tk.tktmptkeluar, tk.tktgllahir, tk.tktmptlahir, tk.tkjk, tk.tkstatkwn, tk.tkjmlanaktanggungan, tk.tkahliwaris, tk.tknama2, tk.tkalmt2, tk.tktelp, tk.tkhub, tk.tkstat, tk2.tknama as 'tkrevnama', tk.tktglendorsement, tk.md5tki, tk.tkidownloadurl
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
    	$this->db->join('mpptkis m', 'jo.ppkode = m.ppkode');
    	$this->db->select('m.ppkode,m.ppnama,jo.jobid');
    	$this->db->group_by('m.ppkode');
    	return $this->db->get()->result();
    }

    function get_jodetail($ppkode,$agid)
    {
    	$this->db->select('j.*,jp.namajenispekerjaan as namajenispekerjaan,jp.jpgaji as gaji');
    	$this->db->from('jodetail j');
    	$this->db->join('jenispekerjaan jp', 'j.idjenispekerjaan = jp.idjenispekerjaan','left');
       	$this->db->join('jo', 'j.jobid = jo.jobid');
    	$this->db->where('jo.ppkode',$ppkode);
   	    $this->db->where('jo.agid',$agid);
    	return $this->db->get()->result();
    }

    function get_all_year(){
		$this->db->distinct();
		$this->db->select('YEAR(tktglendorsement) as tahun');
		$this->db->from('tki');
		$this->db->order_by('tktglendorsement','desc');
		return $this->db->get()->result();
	}

	function get_agid(){
		$this->db->distinct();
		$this->db->select('magensi.agid');
		$this->db->from('magensi');
		$this->db->where('magensi.idinstitution', $this->session->userdata('institution'));
		$this->db->where('magensi.username', $this->session->userdata('name'));
		return $this->db->get()->result();
	}

	function get_jk_this_year($tahun)
	{
		$this->db->select('tki.tkjk, COUNT(*) as total');
		$this->db->from('entryjo');
		$this->db->join('tki','entryjo.ejid = tki.ejid');
		$this->db->where('tki.tkstat',0);
		$this->db->where('tki.tkrevid',NULL);
		$where = "tki.tktglendorsement LIKE '%".$tahun."-%'";
		$this->db->where($where);
		$this->db->where('entryjo.idinstitution',$this->session->userdata('institution'));
		$this->db->group_by('tki.tkjk');
		return $this->db->get()->result();
	}

	function get_jk_this_year_agensi($tahun, $agid)
	{
		$this->db->select('tki.tkjk, COUNT(*) as total');
		$this->db->from('entryjo');
		$this->db->join('tki','entryjo.ejid = tki.ejid');
		$this->db->where('tki.tkstat',0);
		$this->db->where('tki.tkrevid',NULL);
		$where = "tki.tktglendorsement LIKE '%".$tahun."-%'";
		$this->db->where($where);
		$this->db->where('entryjo.agid', $agid);
		$this->db->group_by('tki.tkjk');
		return $this->db->get()->result();
	}

	function get_jk_this_month($tahun,$bulan)
	{
		$this->db->select('tki.tkjk, COUNT(*) as total');
		$this->db->from('entryjo');
		$this->db->join('tki','entryjo.ejid = tki.ejid');
		$this->db->where('tki.tkstat',0);
		$this->db->where('tki.tkrevid',NULL);
		$where = "tki.tktglendorsement LIKE '%".$tahun."-".$bulan."-%'";
		$this->db->where($where);
		$this->db->where('entryjo.idinstitution',$this->session->userdata('institution'));
		$this->db->group_by('tki.tkjk');
		return $this->db->get()->result();
	}

	function get_jk_this_month_agensi($tahun,$bulan, $agid)
	{
		$this->db->select('tki.tkjk, COUNT(*) as total');
		$this->db->from('entryjo');
		$this->db->join('tki','entryjo.ejid = tki.ejid');
		$this->db->where('tki.tkstat',0);
		$this->db->where('tki.tkrevid',NULL);
		$where = "tki.tktglendorsement LIKE '%".$tahun."-".$bulan."-%'";
		$this->db->where($where);
		$this->db->where('entryjo.agid',$agid);
		$this->db->group_by('tki.tkjk');
		return $this->db->get()->result();
	}



	function get_sektor_this_year($tahun)
	{
		$this->db->select('jenispekerjaan.sektor, COUNT(*) as total');
		$this->db->from('entryjo');
		$this->db->join('tki','entryjo.ejid = tki.ejid');
		$this->db->join('jenispekerjaan','entryjo.idjenispekerjaan = jenispekerjaan.idjenispekerjaan');
		$this->db->where('tki.tkstat',0);
		$this->db->where('tki.tkrevid',NULL);
		$where = "tki.tktglendorsement LIKE '%".$tahun."-%'";
		$this->db->where($where);
		$this->db->where('entryjo.idinstitution',$this->session->userdata('institution'));
		$this->db->group_by('jenispekerjaan.sektor');
		return $this->db->get()->result();
	}

	function get_sektor_this_year_agensi($tahun, $agid)
	{
		$this->db->select('jenispekerjaan.sektor, COUNT(*) as total');
		$this->db->from('entryjo');
		$this->db->join('tki','entryjo.ejid = tki.ejid');
		$this->db->join('jenispekerjaan','entryjo.idjenispekerjaan = jenispekerjaan.idjenispekerjaan');
		$this->db->where('tki.tkstat',0);
		$this->db->where('tki.tkrevid',NULL);
		$where = "tki.tktglendorsement LIKE '%".$tahun."-%'";
		$this->db->where($where);
		$this->db->where('entryjo.agid',$agid);
		$this->db->group_by('jenispekerjaan.sektor');
		return $this->db->get()->result();
	}

	function get_sektor_this_month($tahun,$bulan)
	{
		$this->db->select('jenispekerjaan.sektor, COUNT(*) as total');
		$this->db->from('entryjo');
		$this->db->join('tki','entryjo.ejid = tki.ejid');
		$this->db->join('jenispekerjaan','entryjo.idjenispekerjaan = jenispekerjaan.idjenispekerjaan');
		$this->db->where('tki.tkstat',0);
		$this->db->where('tki.tkrevid',NULL);
		$where = "tki.tktglendorsement LIKE '%".$tahun."-".$bulan."-%'";
		$this->db->where($where);
		$this->db->where('entryjo.idinstitution',$this->session->userdata('institution'));
		$this->db->group_by('jenispekerjaan.sektor');
		return $this->db->get()->result();
	}

	function get_sektor_this_month_agensi($tahun,$bulan, $agid)
	{
		$this->db->select('jenispekerjaan.sektor, COUNT(*) as total');
		$this->db->from('entryjo');
		$this->db->join('tki','entryjo.ejid = tki.ejid');
		$this->db->join('jenispekerjaan','entryjo.idjenispekerjaan = jenispekerjaan.idjenispekerjaan');
		$this->db->where('tki.tkstat',0);
		$this->db->where('tki.tkrevid',NULL);
		$where = "tki.tktglendorsement LIKE '%".$tahun."-".$bulan."-%'";
		$this->db->where($where);
		$this->db->where('entryjo.agid',$agid);
		$this->db->group_by('jenispekerjaan.sektor');
		return $this->db->get()->result();
	}

	function get_list_jp_this_year($tahun)
	{
		$this->db->distinct();
		$this->db->select('jenispekerjaan.namajenispekerjaan');
		$this->db->from('entryjo');
		$this->db->join('tki','entryjo.ejid = tki.ejid');
		$this->db->join('jenispekerjaan','entryjo.idjenispekerjaan = jenispekerjaan.idjenispekerjaan');
		$this->db->where('tki.tkstat',0);
		$this->db->where('tki.tkrevid',NULL);
		$where = "tki.tktglendorsement LIKE '%".$tahun."-%'";
		$this->db->where($where);
		$this->db->where('entryjo.idinstitution',$this->session->userdata('institution'));
		return $this->db->get()->result();
	}

	function get_list_jp_this_year_agensi($tahun, $agid)
	{
		$this->db->distinct();
		$this->db->select('jenispekerjaan.namajenispekerjaan');
		$this->db->from('entryjo');
		$this->db->join('tki','entryjo.ejid = tki.ejid');
		$this->db->join('jenispekerjaan','entryjo.idjenispekerjaan = jenispekerjaan.idjenispekerjaan');
		$this->db->where('tki.tkstat',0);
		$this->db->where('tki.tkrevid',NULL);
		$where = "tki.tktglendorsement LIKE '%".$tahun."-%'";
		$this->db->where($where);
		$this->db->where('entryjo.agid',$agid);
		return $this->db->get()->result();
	}

	function count_jp_this_month($tahun,$bulan,$namajp)
	{
		$this->db->select('*');
		$this->db->from('entryjo');
		$this->db->join('tki','entryjo.ejid = tki.ejid');
		$this->db->join('jenispekerjaan','entryjo.idjenispekerjaan = jenispekerjaan.idjenispekerjaan');
		$this->db->where('tki.tkstat',0);
		$this->db->where('tki.tkrevid',NULL);
		$this->db->where('MONTH(tki.tktglendorsement)',$bulan);
		$this->db->where('YEAR(tki.tktglendorsement)',$tahun);
		$this->db->where('jenispekerjaan.namajenispekerjaan',$namajp);
		$this->db->where('entryjo.idinstitution',$this->session->userdata('institution'));
		return $this->db->count_all_results();
	}

	function count_jp_this_month_agensi($tahun,$bulan,$namajp, $agid)
	{
		$this->db->select('*');
		$this->db->from('entryjo');
		$this->db->join('tki','entryjo.ejid = tki.ejid');
		$this->db->join('jenispekerjaan','entryjo.idjenispekerjaan = jenispekerjaan.idjenispekerjaan');
		$this->db->where('tki.tkstat',0);
		$this->db->where('tki.tkrevid',NULL);
		$this->db->where('MONTH(tki.tktglendorsement)',$bulan);
		$this->db->where('YEAR(tki.tktglendorsement)',$tahun);
		$this->db->where('jenispekerjaan.namajenispekerjaan',$namajp);
		$this->db->where('entryjo.agid',$agid);
		return $this->db->count_all_results();
	}

	function randomString($length) {
		$data = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$data .= "0123456789";
		$tmp = "";

		srand((double) microtime() * 1000000);

		for ($i=0; $i<$length; $i++) {
			$tmp .= substr($data, (rand()%(strlen($data))), 1);
		}

		return $tmp;
	}

	function createUID($tipe, $length = 3) {
		return $tipe.date("y").date("m").$this->randomString($length);
	}

	function uuid() {

		// The field names refer to RFC 4122 section 4.1.2

		return sprintf('%04x%04x%04x%03x4%04x%04x%04x%04x',
			mt_rand(0, 65535), mt_rand(0, 65535), // 32 bits for "time_low"
			mt_rand(0, 65535), // 16 bits for "time_mid"
			mt_rand(0, 4095),  // 12 bits before the 0100 of (version) 4 for "time_hi_and_version"
			bindec(substr_replace(sprintf('%016b', mt_rand(0, 65535)), '01', 6, 2)),
				// 8 bits, the last two of which (positions 6 and 7) are 01, for "clk_seq_hi_res"
				// (hence, the 2nd hex digit after the 3rd hyphen can only be 1, 5, 9 or d)
				// 8 bits for "clk_seq_low"
			mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535) // 48 bits for "node"
		);
	}

	function insert_ej($data)
	{
		for ($i=0; $i < 101; $i++) {
			$data["ejbcsp"] = $this->createUID('J',4);
			$this->db->from('entryjo');
			$this->db->where('ejbcsp', $data["ejbcsp"]);
			$total = $this->db->get()->num_rows();
			if($total == 0)
			{
				break;
			}
		}
		for ($i=0; $i < 101; $i++) {
			$data["ejbcform"] = $this->createUID('I',4);
			$this->db->from('entryjo');
			$this->db->where('ejbcform', $data["ejbcform"]);
			$total = $this->db->get()->num_rows();
			if($total == 0)
			{
				break;
			}
		}
		for ($i=0; $i < 101; $i++) {
			$data["ejbcsk"] = $this->createUID('K',4);
			$this->db->from('entryjo');
			$this->db->where('ejbcsk', $data["ejbcsk"]);
			$total = $this->db->get()->num_rows();
			if($total == 0)
			{
				break;
			}
		}
		for ($i=0; $i < 101; $i++) {
			$data["ejtoken"] = $this->uuid();
			$this->db->from('entryjo');
			$this->db->where('ejtoken', $data["ejtoken"]);
			$total = $this->db->get()->num_rows();
			if($total == 0)
			{
				break;
			}
		}
		$this->db->insert('entryjo',$data);
		$id = $this->db->insert_id();
		$updatemd5 = array(
			'md5ej' => md5($id)
		);
		$this->db->where('ejid', $id);
		$this->db->update('entryjo', $updatemd5);
		return $id;
	}

	function insert_tki($data)
	{
		for ($i=0; $i < 101; $i++) {
			$data["tkbc"] = $this->createUID('T',4);
			$this->db->from('tki');
			$this->db->where('tkbc', $data["tkbc"]);
			$total = $this->db->get()->num_rows();
			if($total == 0)
			{
				break;
			}
		}
		$this->db->insert('tki',$data);
		$id = $this->db->insert_id();
		$updatemd5 = array(
			'md5tki' => md5($id)
		);
		$this->db->where('tkid', $id);
		$this->db->update('tki', $updatemd5);
		return $id;
	}

	function update_tki($data,$paspor)
	{
		$this->db->where('tkpaspor',$paspor);
		return $this->db->update('tki',$data);
	}

	function geturlpekerjaan($idjp)
	{
		$this->db->select('curjodownloadurl,curtkidownloadurl');
		$this->db->from('jenispekerjaan');
		$this->db->where('idjenispekerjaan',$idjp);
		return $this->db->get()->row();
	}

	function get_tki_byej($md5ej)
	{
		$this->db->select('md5tki,tknama,tkidownloadurl');
		$this->db->from('tki');
		$this->db->where('md5ej',$md5ej);
		return $this->db->get()->result();
	}

	function get_url_byej($md5ej)
	{
		$this->db->select('jodownloadurl');
		$this->db->from('entryjo');
		$this->db->where('md5ej',$md5ej);
		return $this->db->get()->row();
	}

	function update_kuota($jo,$job,$laki,$perempuan,$campuran)
	{
		$this->db->select('jobdl,jobdp,jobdc');
		$this->db->where('jobid', $jo);
		$this->db->where('idjenispekerjaan', $job);
		$jodetail = $this->db->get('jodetail')->row();
		$data = array(
			'jobdl' => $jodetail->jobdl - $laki,
			'jobdp' => $jodetail->jobdp - $perempuan,
			'jobdc' => $jodetail->jobdc - $campuran
		);
		$this->db->where('jobid', $jo);
		$this->db->where('idjenispekerjaan', $job);
		$this->db->update('jodetail',$data);
	}

	function find_tkipaspor($paspor)
	{
		$this->db->select('tknama');
		$this->db->where('tkpaspor',$paspor);
		$query = $this->db->get('tki');
		return $query->num_rows();
	}


}
