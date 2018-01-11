<?php if ( ! defined('BASEPATH')) exit('Tidak ada akses langsung script diperbolehkan');
 
class pdfm{
    function pdf(){
        $CI =& get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }

    function load($param=NULL){
        include_once APPPATH.'libraries/mpdf/mpdf.php';
        if($params == NULL){
            $param = '"en-GB-x","A4","","",10,10,10,10,6,3,"P"';
        }
        return new mPDF($param);
    }
}