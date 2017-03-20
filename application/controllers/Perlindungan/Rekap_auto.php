<?php

class Rekap_auto extends CI_Controller {
    
	public function __construct() {
		parent::__construct();
        
        $this->load->model('SAdmin/Institution_model');
        $this->load->model('SAdmin/Currency_model');
        $this->load->library('Pelaporan');
	}
    
    public function index(){
        $institusi = $this->Institution_model->get_institution_name($this->session->userdata('institution'));
        $currency = $this->Currency_model->get_currency_name_institution($this->session->userdata('institution'));

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
            $fname = $laporan->generateTahunan($preDate,NULL,NULL,$institusi->nameinstitution);
            $fname = $laporan->generateBulanan($preDate,$type,$institusi->nameinstitution);
            $fname = $laporan->generateUang($preDate,$institusi->nameinstitution,$currency->currencyname);
        }
        chmod($basicDir.$dirname,0777);
    }
}

?>