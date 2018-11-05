<?php if ( ! defined('BASEPATH')) exit('Tidak ada akses langsung script diperbolehkan');

class Nida extends MY_Controller {
	function __construct(){
		parent::__construct();
	}
	
	function abu_dhabi(){
		$data  = 0;
		ini_set('memory_limit', '64M');
		$nama_dokumen = "abu_dhabi_report";		
		
		$html = $this->load->view('forms/abu_dhabi', $data, true); //render the view into HTML
		$this->load->library('Pdfm');
		$pdf=$this->pdfm->load();
		$pdf->WriteHTML($html); //write the HTML into PDF	
		$pdf->Output($nama_dokumen.".pdf" ,'I');
	}

	function arab(){
		$data  = 0;
		ini_set('memory_limit', '64M');
		$nama_dokumen = "arab_report";		
		$html = $this->load->view('forms/arab', $data, true); //render the view into HTML
		$this->load->library('pdfm');
		$pdf=$this->pdfm->load();
		$pdf->WriteHTML($html); //write the HTML into PDF	
		$pdf->Output($nama_dokumen.".pdf" ,'I');
	}	
}