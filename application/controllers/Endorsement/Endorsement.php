<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Endorsement extends MY_Controller {

  private $data;

  public function __construct()
  {
    parent::__construct();
    $this->load_sidebar();
    $this->load->model('Endorsement/Endorsement_model');

    $this->data['listdp'] = $this->listdp;
    $this->data['usedpg'] = $this->usedpg;
    $this->data['usedmpg'] = $this->usedmpg;
    $this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
    $this->data['sidebar'] = 'SAdmin/Sidebar';
  }

  public function index()
  {
  }

  public function updateagency()
  {
    $this->data['title'] = 'Endorsement';
    $this->data['subtitle'] = 'Update Agency';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/UpdateAgency_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function checkBarcode()
  {
    $this->data['title'] = 'Endorsement';
    $this->data['subtitle'] = 'Check Barcode';
    $this->data['subtitle2'] = 'Pencatatan Kuitansi';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/CheckBarcode_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  function checkJO()
  {
    $code = $this->input->post('barcode', TRUE);
      
    $tmp['success'] = false;
    $tmp['message'] = "Barcode atau Token tidak valid!!!";
      
    $query = $this->Endorsement_model->getKuitansi($code);

    var_dump($query);
    // foreach ($query as $row):
    //   $r->rows[$i]['id']=$i;
    //   $r->rows[$i]['cell'] = array(
    //     $row->agid,
    //     $row->agnama,
    //     $row->agnoijincla
    //   );
    //   $i++;
    // endforeach;
      
    //   $result = mysql_query($sql) or die($messages['err_query']);
      
    //   if ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
    //     $tmp['kuitansi'][0] = $row;
    //     $tmp['success'] = true;
        
          
          
    //   } 
    //   else {
    //     // jumlah tki per ejid
    //     $sql = "SELECT
    //           count(ej.ejid) as count, ej.ejid
    //         FROM
    //           entryjo ej
    //         LEFT JOIN tki tk ON tk.ejid = ej.ejid
    //         WHERE
    //           ej.ejbcsp = $code OR ej.ejbcsk = $code OR ej.ejbcform = $code OR tk.tkbc = $code
    //         GROUP BY
    //           ej.ejid";
    //     $result = mysql_query($sql) or die($messages['err_query']);
    //     $count = 0;
    //     $ejid = 0;
    //     if ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
    //       $count = $row['count'];
    //       $ejid = $row['ejid'];
    //     }
        
    //     if ($count > 0) {
    //       // data entryjo
    //       $sql = "SELECT
    //             ej.agnama, ej.agnamacn, ej.agnoijincla, ej.agalmtkantor, ej.agalmtkantorcn, ej.agpngjwb, ej.agpngjwbcn, ej.agtelp, ej.agfax,
    //             ej.ppnama, ej.ppalmtkantor, ej.pptelp, ej.ppfax, ej.ppijin, ej.pppngjwb,
    //             ej.mjktp, ej.mjnama, ej.mjnamacn, ej.mjalmt, ej.mjalmtcn, ej.mjtelp, ej.mjfax, ej.mjpngjwb, ej.mjpngjwbcn,
    //             jp.jpid, jp.jpnama, jp.jpnamacn, jp.jpsektor, jp.jpgaji,
    //             ej.joclano, ej.joclano, ej.joclatgl, ej.joestduedate, ej.joposisi, ej.jojmltki, ej.jomkthn, ej.jomkbln, ej.jomkhr, ej.jocatatan, ej.joakomodasi,
    //             ej.ejid, ej.ejtglendorsement, ej.ejtoken, ej.ejbcsp, ej.ejbcsk
    //           FROM entryjo ej
    //           JOIN jenispekerjaan jp ON jp.jpid = ej.jpid
    //           WHERE ej.ejid = '$ejid'";
    //       $result = mysql_query($sql) or die($messages['err_query']);
            
    //       if ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
    //         $tmp = $row;
    //         $tmp['jocatatan'] = str_replace("\n", "<br/>", $row[jocatatan]);
    //         $tmp['success'] = true;
    //         $tmp['message'] = "Barcode valid.";
    //         $tmp['ejid'] = base64UrlEncode($row["ejid"]);
    //       }
          
    //       // data kuitansi
    //       $sql = "SELECT
    //             DATE_FORMAT(ku.kutglmasuk, '%d/%m/%Y') as kutglmasuk, DATE_FORMAT(ku.kutglkuitansi, '%d/%m/%Y') as kutglkuitansi, tp.tipe, ku.kuno, ku.kujmlbayar, ku.kupemohon, ku.kutipe, ku.uid
    //           FROM entryjo ej
    //           JOIN pencatatanej pej ON pej.ejid = ej.ejid
    //           JOIN kuitansi ku ON ku.kuid = pej.kuid
    //           JOIN tipe tp ON tp.idtipe = ku.kutipe
    //           WHERE ej.ejid = '$ejid'";
    //       $result = mysql_query($sql) or die($messages['err_query']);
          
    //       $tmp['kuitansi'] = array();
          
    //       $i = 0;
    //       while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
    //         $tmp['kuitansi'][$i++] = $row;
    //       }
          
    //       // data tki
    //       $sql = "SELECT
    //             tk.tknama, tk.tkbc
    //           FROM tki tk
    //           WHERE tk.ejid = '$ejid' AND tk.tkrevid IS NULL";
    //       $result = mysql_query($sql) or die($messages['err_query']);
    //       $i = 0;
    //       while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
    //         $tmp['tki'][$i++] = $row;
    //       }
    //     }
    //   }
      
    //   echo json_encode($tmp);
  }

}
