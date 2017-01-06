<?php
class Endorsement_model extends CI_Model {
	public function __construct()
    {
        $this->load->database('default');
    }

    function getKuitansi($code)
    {
    	$sql = "SELECT
            		DATE_FORMAT(ku.kutglmasuk, '%d/%m/%Y') as kutglmasuk,
            		DATE_FORMAT(ku.kutglkuitansi, '%d/%m/%Y') as kutglkuitansi,
            		tp.tipe, ku.kuno, ku.kujmlbayar, ku.kupemohon, ku.idtipe, ku.username
		        FROM 
		           	kuitansi ku JOIN tipe tp ON tp.idtipe = ku.idtipe
		        WHERE 
		            ku.kukode = $code AND ku.kukode IS NOT NULL
		            AND ku.idinstitution = ".$this->session->userdata('institution')."";

		$query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }
}