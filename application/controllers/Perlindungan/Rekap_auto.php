<?php

class Rekap_auto extends CI_Controller {
    
	public function __construct() {
		parent::__construct();
        
        $this->load->library('Pelaporan');
	}
    
    public function index(){        
        $laporan = new Pelaporan();
        
        $basicDir = $this->input->server('DOCUMENT_ROOT')."/sisnaker-atase/assets/rekap/";
        
        $nowDate = intval(date('j'));
        $nowHour = intval(date('H'));
        
        $stime = strtotime('first day of last month');
        
        $preDate = date('d/m/Y',$stime);        
        $dirname = date("M_Y",$stime); 
        
        $laporan->filedir = $basicDir.$dirname."/";
        
        $type = array('jenis','sektor','status');
        
        if(is_dir($basicDir.$dirname) == FALSE)
        {
            mkdir($basicDir.$dirname, 0777);
            $fname = $laporan->generateTahunan($preDate);
            
            $fname = $laporan->generateBulanan($type,$preDate);
            $fname = $laporan->generateUang($preDate);
        }
        chmod($basicDir.$dirname,0777);
    }
}

?>