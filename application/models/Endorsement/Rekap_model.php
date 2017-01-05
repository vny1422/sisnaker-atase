<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rekap_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getKuitansi($tahun,$bulan)
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

}