<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rekap_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getRekapKuitansi($tahun,$bulan)
	{
		$sql = "SELECT kuitansi.kutglkuitansi,
					kuitansi.kutglmasuk,
					kuitansi.kuno, 
					kuitansi.kupemohon,
					kuitansi.kujmlbayar,
					tipe.TIPE,
					GROUP_CONCAT(kuitansi.kukode) as 'kukode'
				FROM (
					SELECT 
						DATE_FORMAT(kuitansi.kutglkuitansi, '%Y-%m-%d') as 'kutglkuitansi', 
						DATE_FORMAT(kuitansi.kutglmasuk, '%Y-%m-%d') as 'kutglmasuk', 
						kuitansi.kuno, 
						kuitansi.kupemohon,
						kuitansi.kujmlbayar,
						kuitansi.idtipe,
						kuitansi.kukode
					FROM 
						kuitansi
					WHERE    
						kuitansi.`kutglmasuk` LIKE '%".$tahun."-".$bulan."-%'
						AND kuitansi.idinstitution = ".$this->session->userdata('institution')."
						AND kuitansi.idtipe <> 1 AND kuitansi.kuhapus IS NULL
					UNION
					SELECT
						DATE_FORMAT(kuitansi.kutglkuitansi, '%Y-%m-%d') as 'kutglkuitansi', 
						DATE_FORMAT(kuitansi.kutglmasuk, '%Y-%m-%d') as 'kutglmasuk', 
						kuitansi.kuno, 
						kuitansi.kupemohon,
						kuitansi.kujmlbayar,
						kuitansi.idtipe,
						entryjo.ejbcsp as 'kukode'
					FROM
						kuitansi
						LEFT JOIN pencatatanej ON pencatatanej.kuid = kuitansi.kuid
						LEFT JOIN entryjo ON entryjo.ejid = pencatatanej.ejid
					WHERE
						kuitansi.`kutglmasuk` LIKE '%".$tahun."-".$bulan."-%'
						AND kuitansi.idinstitution = ".$this->session->userdata('institution')."
						AND kuitansi.idtipe = 1 AND kuitansi.kuhapus IS NULL 
				) kuitansi
				LEFT JOIN tipe ON tipe.idtipe = kuitansi.idtipe
				GROUP BY
					kuitansi.kuno
				ORDER BY 
					kuitansi.kutglmasuk asc, 
					DATE(kuitansi.kutglkuitansi) asc";

		$query = $this->db->query($sql);

        $result = $query->result();

        return $result;
	}

	function getRekapJO($tahun,$bulan)
	{
		$sql = "SELECT 
					DATE_FORMAT(`entryjo`.`ejtglendorsement`, '%Y-%m-%d') as 'ejtglendorsement', 
					`jenispekerjaan`.`namajenispekerjaan` , 
					`entryjo`.`agnama` , 
					`entryjo`.`ppnama` , 
					`entryjo`.`mjnama` , 
					`entryjo`.`jojmltki`,
					`entryjo`.`ejbcsp`
				FROM 
					`entryjo`
					LEFT JOIN `jenispekerjaan` ON entryjo.idjenispekerjaan = jenispekerjaan.idjenispekerjaan
				WHERE 
					entryjo.ejtglendorsement LIKE '%".$tahun."-".$bulan."-%'
					AND entryjo.idinstitution = ".$this->session->userdata('institution')."
				ORDER BY 
					`entryjo`.`ejtglendorsement` asc, 
					`entryjo`.ejdatefilled asc, 
					`entryjo`.`agnama` asc";

		$query = $this->db->query($sql);

        $result = $query->result();

        return $result;
	}

	function getRekapTKI($tahun,$bulan)
	{
		$sql = "SELECT 
					tki.tknama, 
					tki.tkbc, 
					tki.tkpaspor, 
					jenispekerjaan.namajenispekerjaan, 
					tki.tkjk, 
					tki.tktmptlahir, 
					tki.tktgllahir, 
					tki.tkalmtid, 
					tki.tkahliwaris, 
					tki.tktelp, 
					entryjo.agnama, 
					entryjo.agalmtkantor, 
					entryjo.agpngjwb, 
					entryjo.agtelp, 
					entryjo.ppnama, 
					entryjo.pppngjwb, 
					entryjo.ppalmtkantor, 
					entryjo.pptelp, 
					entryjo.mjnama, 
					entryjo.mjalmt, 
					entryjo.mjtelp
				FROM 
					tki
					JOIN entryjo ON entryjo.ejid = tki.ejid
					JOIN jenispekerjaan ON entryjo.idjenispekerjaan = jenispekerjaan.idjenispekerjaan
				WHERE 
					tki.tkstat = 0
					AND tki.tktglendorsement LIKE '%".$tahun."-".$bulan."-%'
					AND entryjo.idinstitution = ".$this->session->userdata('institution')."
				ORDER BY 
					tki.tkid ASC";

		$query = $this->db->query($sql);

        $result = $query->result();

        return $result;
	}

}