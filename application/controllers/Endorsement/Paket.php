<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paket extends MY_Controller {

  private $data;

  public function __construct()
  {
    parent::__construct();
    $this->load_sidebar();
    $this->load->model('Perlindungan/Agency_model');
    $this->load->model('Perlindungan/Pptkis_model');
    $this->load->model('Endorsement/Paket_model');

    $this->data['listdp'] = $this->listdp;
    $this->data['usedpg'] = $this->usedpg;
    $this->data['usedmpg'] = $this->usedmpg;
    $this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
    if(empty($this->namakantor->nama)){
      $this->data['namakantor'] = "";
    }
    else{
      $this->data['namakantor'] = $this->namakantor->nama;
    }
    $this->data['sidebar'] = 'SAdmin/Sidebar';
  }

  public function index()
  {
    if (!($this->session->userdata('role') <= 2 || $this->session->userdata('role') == 4 || $this->session->userdata('role') == 5 || $this->session->userdata('role') == 6 || $this->session->userdata('role') == 7))
    {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }

    if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 5) {
      $this->data['listinstitusi'] = $this->Institution_model->list_active_institution();
    }

    $this->data['title'] = 'Paket PK';
    $this->data['subtitle'] = 'View Quota';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/RekapPaketJO_view');
    $this->load->view('templates/footerendorsement');
  }

  public function add()
  {
    if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2 || $this->session->userdata('role') == 6 || $this->session->userdata('role') == 7)
    {
      $this->data['title'] = 'Paket PK';
      $this->data['subtitle'] = 'Register Quota';
      $this->load->view('templates/headerendorsement', $this->data);
      $this->load->view('Endorsement/DaftarPaketJO_view');
      $this->load->view('templates/footerendorsement');
    }
    else
    {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }
  }

  public function listAgensi()
  {
    $idinstitution = $this->input->post('idinstitution', TRUE);

    $page = $this->input->post('page', TRUE); // get the requested page
    $limit = $this->input->post('rows', TRUE); // get how many rows we want to have into the grid
    $sidx = $this->input->post('sidx', TRUE); // get index row - i.e. user click to sort
    $sord = $this->input->post('sord', TRUE); // get the direction
    if(!$sidx) $sidx = 1;

    $wh = "";
    if($this->input->post('_search',TRUE)=="true"){
      $filters = json_decode($this->input->post('filters',TRUE), true);
      $wh = $this->getSearch($filters);
    }

    $totalrows = isset($_POST['totalrows']) ? $_POST['totalrows']: false;
    if($totalrows) {
      $limit = $totalrows;
    }

    $count = $this->Paket_model->countAgensi($idinstitution,$wh)->count;

    if( $count >0 ) {
      $total_pages = ceil($count/$limit);
    } else {
      $total_pages = 0;
    }

    if ($page > $total_pages) $page=$total_pages;
    $start = $limit*$page - $limit; // do not put $limit*($page - 1)
    if ($start < 0) $start = 0;

    if (!isset($r)) $r = new stdClass();
    $r->page = $page;
    $r->total = $total_pages;
    $r->records = $count;

    $query = $this->Paket_model->getAgensi_ForTable($idinstitution,$start,$limit,$sidx,$sord,$wh);
    $i=0;
    foreach ($query as $row):
      $r->rows[$i]['id']=$i;
      $r->rows[$i]['cell'] = array(
        $row->agid,
        $row->agnama,
        $row->agnoijincla
      );
      $i++;
    endforeach;

    echo json_encode($r);
  }

  public function listPPTKIS()
  {
    $agid = $this->input->post('agid', TRUE);


    $page = $this->input->post('page', TRUE); // get the requested page
    $limit = $this->input->post('rows', TRUE); // get how many rows we want to have into the grid
    $sidx = $this->input->post('sidx', TRUE); // get index row - i.e. user click to sort
    $sord = $this->input->post('sord', TRUE); // get the direction
    // $page = '1'; // get the requested page
    // $limit = '20'; // get how many rows we want to have into the grid
    // $sidx = 'ppnama'; // get index row - i.e. user click to sort
    // $sord = 'ASC'; // get the direction
    if(!$sidx) $sidx = 1;

    $wh = "";
    if($this->input->post('_search',TRUE)=="true"){
      $filters = json_decode($this->input->post('filters',TRUE), true);
      $wh = $this->getSearch($filters);
    }

    $totalrows = isset($_POST['totalrows']) ? $_POST['totalrows']: false;
    if($totalrows) {
      $limit = $totalrows;
    }

    $count = $this->Paket_model->countPPTKIS($agid,$wh)->count;

    if( $count >0 ) {
      $total_pages = ceil($count/$limit);
    } else {
      $total_pages = 0;
    }

    if ($page > $total_pages) $page=$total_pages;
    $start = $limit*$page - $limit; // do not put $limit*($page - 1)
    if ($start < 0) $start = 0;

    if (!isset($r)) $r = new stdClass();
    $r->page = $page;
    $r->total = $total_pages;
    $r->records = $count;

    $query = $this->Paket_model->getPPTKIS_ForTable($agid,$start,$limit,$sidx,$sord,$wh);
    $i=0;
    foreach ($query as $row):
      $query = $this->Paket_model->checkJO($agid,$row->ppkode);

      $jobtglakhir = $query->result()[0]->jobtglakhir;

      if($query->num_rows() < 1) {
        $row->ppnama .= " - <strong style='color:#FF0000'>Expired / Inactive</strong>";
      } else if($jobtglakhir < date("Y-m-d")) {
        $row->ppnama .= " - <strong style='color:#FF0000'>Expired / Inactive</strong>";
      } else if(floor(abs(strtotime($jobtglakhir) - strtotime(date("Y-m-d")))/(60*60*24)) <= 30) {
        $row->ppnama .= " - <strong style='color:#D84700'>Sisa < 1 Bulan / Almost Expired</strong>";
      }

      $r->rows[$i]['id']=$i;
      $r->rows[$i]['cell'] = array(
        $row->ppkode,
        $row->ppnama
      );
      $i++;
    endforeach;

    echo json_encode($r);
  }

  public function listJP()
  {
    if (!isset($r)) $r = new stdClass();
    $query = $this->Paket_model->getJP();

    $i=0;
    foreach ($query as $row):
      $r->rows[$i++] = $row;
    endforeach;

    echo json_encode($r);
  }

  public function listJO()
  {
    $ppkode = $this->input->post('ppkode', TRUE);
    $agid = $this->input->post('agid', TRUE);

    $page = $this->input->post('page', TRUE); // get the requested page
    $limit = $this->input->post('rows', TRUE); // get how many rows we want to have into the grid
    $sidx = $this->input->post('sidx', TRUE); // get index row - i.e. user click to sort
    $sord = $this->input->post('sord', TRUE); // get the direction

    if(!$sidx) $sidx = 1;

    $wh = "";
    if($this->input->post('_search',TRUE)=="true"){
      $filters = json_decode($this->input->post('filters',TRUE), true);
      $wh = $this->getSearch($filters);
    }

    $totalrows = isset($_POST['totalrows']) ? $_POST['totalrows']: false;
    if($totalrows) {
      $limit = $totalrows;
    }

    $count = $this->Paket_model->countJO($agid,$ppkode,$wh)->count;

    if( $count >0 ) {
        $total_pages = ceil($count/$limit);
    } else {
      $total_pages = 0;
    }

    if ($page > $total_pages) $page=$total_pages;
    $start = $limit*$page - $limit; // do not put $limit*($page - 1)
    if ($start < 0) $start = 0;

    if (!isset($r)) $r = new stdClass();
    $r->page = $page;
    $r->total = $total_pages;
    $r->records = $count;

    $query = $this->Paket_model->getJO_ForTable($agid,$ppkode,$start,$limit,$sidx,$sord,$wh);
    $i=0;
    foreach ($query as $row):
      $r->rows[$i]['id']=$i;
      $r->rows[$i]['cell'] = array(
        $row->jobid,
        $row->jobno,
        $row->jobtglawal,
        $row->jobtglakhir,
        $row->jobenable,
        $row->jobispushed
      );
      $i++;
    endforeach;

    echo json_encode($r);
  }

  public function editJO()
  {
    if (!isset($r)) $r = new stdClass();
    $r->status = 0;

    $oper = $this->input->post('oper', TRUE);
    $ppkode = $this->input->post('ppkode', TRUE);
    $agid = $this->input->post('agid', TRUE);
    $id = $this->input->post('id', TRUE);

    $values = $this->Agency_model->get_agency_info($agid);

    if($values['idinstitution'] == $this->session->userdata('institution')){
      if ($oper === "add") {
        if (!empty($ppkode) && !empty($agid)) {
          $this->Paket_model->addJO($ppkode,$agid);
          $r->status = 1;
        }
      } else if ($oper === "edit") {
        if (!empty($ppkode) && !empty($agid)) {
          $this->Paket_model->updateJO($id);
          $r->status = 1;
        }
      } else if ($oper === "del") {
        if($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2){
          $this->Paket_model->deleteJO($id);
          $r->status = 1;
        } else {
          $val = $this->Paket_model->getJobOrder_from_jobid($id);
          if($val->username == $this->session->userdata('user')){
            $this->Paket_model->deleteJO($id);
            $r->status = 1;
          }
        }
      }
    }

    echo json_encode($r);
  }

  public function listJODetail()
  {
    $jobid = $this->input->post('jobid', TRUE);

    $page = $this->input->post('page', TRUE); // get the requested page
    $limit = $this->input->post('rows', TRUE); // get how many rows we want to have into the grid
    $sidx = $this->input->post('sidx', TRUE); // get index row - i.e. user click to sort
    if($sidx == 'jpnama') {
      $sidx = 'namajenispekerjaan';
    }
    $sord = $this->input->post('sord', TRUE); // get the direction
    if(!$sidx) $sidx = 1;

    $wh = "";
    if($this->input->post('_search',TRUE)=="true"){
      $filters = json_decode($this->input->post('filters',TRUE), true);
      $wh = $this->getSearch($filters);
    }

    $totalrows = isset($_POST['totalrows']) ? $_POST['totalrows']: false;
    if($totalrows) {
      $limit = $totalrows;
    }

    $count = $this->Paket_model->countJOD($jobid,$wh)->count;

    if( $count >0 ) {
        $total_pages = ceil($count/$limit);
    } else {
      $total_pages = 0;
    }

    if ($page > $total_pages) $page=$total_pages;
    $start = $limit*$page - $limit; // do not put $limit*($page - 1)
    if ($start < 0) $start = 0;

    if (!isset($r)) $r = new stdClass();
    $r->page = $page;
    $r->total = $total_pages;
    $r->records = $count;

    $query = $this->Paket_model->getJOD_ForTable($jobid,$start,$limit,$sidx,$sord,$wh);
    $i=0;
    foreach ($query as $row):
      $r->rows[$i]['id']=$i;
      $sisa = $this->getSisa($row->jobdid, $row->idjenispekerjaan);
      $r->rows[$i]['cell'] = array(
        $row->jobdid,
        $row->idjenispekerjaan,
        $row->namajenispekerjaan,
        $row->jobdl . " (Sisa:" .$sisa[0]. ")",
        $row->jobdp . " (Sisa:" .$sisa[1]. ")",
        $row->jobdc . " (Sisa:" .$sisa[2]. ")"
      );
      $i++;
    endforeach;

    echo json_encode($r);
  }

  public function editJODetail()
  {
    if (!isset($r)) $r = new stdClass();
    $r->status = 0;

    $oper = $this->input->post('oper', TRUE);
    $jobid = $this->input->post('jobid', TRUE);
    $id = $this->input->post('id', TRUE);

    $val = $this->Paket_model->getJobOrder_from_jobid($jobid);
    $values = $this->Agency_model->get_agency_info($val->agid);

    if($values['idinstitution'] == $this->session->userdata('institution')){
      if ($oper === "add") {
        if (!empty($jobid)) {
          $this->Paket_model->addJODetail($jobid);
          $r->status = 1;
        }
      } else if ($oper === "edit") {
        if($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2){
          if (!empty($jobid)) {
            $this->Paket_model->updateJODetail($id);
            $r->status = 1;
          }
        } else if($val->username == $this->session->userdata('user')){
          if (!empty($jobid)) {
            $this->Paket_model->updateJODetail($id);
            $r->status = 1;
          }
        }
      } else if ($oper === "del") {
        if($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2){
          $this->Paket_model->deleteJODetail($id);
          $r->status = 1;
        } else if($val->username == $this->session->userdata('user')){
          $this->Paket_model->deleteJODetail($id);
          $r->status = 1;
        }
      }
    }

    echo json_encode($r);
  }

  function getSisa($jobd,$jpid)
  {
    $row = $this->Paket_model->getJobOrder($jobd);
    $agid = $row[0]->agid;
    $ppkode = $row[0]->ppkode;
    $jobtglawalnya = $row[0]->jobtglawal;
    $jobtglakhirnya = $row[0]->jobtglakhir;

    $i = 0;
    $query = $this->Paket_model->getJobDetail($jpid,$agid,$ppkode,$jobtglawalnya,$jobtglakhirnya);
    foreach ($query as $row):
      $i++;
      $jobid[$i] = $row->jobid;
      $jobdid[$i] = $row->jobdid;
      $jobtglawal[$i] = $row->jobtglawal;
      $jobtglakhir[$i] = $row->jobtglakhir;
      $jobdl[$i] = $row->jobdl;
      $jobdp[$i] = $row->jobdp;
      $jobdc[$i] =  $row->jobdc;
    endforeach;

    $prevdate = '0000-00-00';
    $j = 0;
    $query = $this->Paket_model->getDate($jpid,$agid,$ppkode,$jobtglawalnya,$jobtglakhirnya);
    foreach ($query as $row):
      $curdate = $row->date;
      if($curdate != $prevdate)
      {
        $j++;
        $period[$j] = $row->date;
      }
      $prevdate = $curdate;
    endforeach;

    for($k = 1; $k < $j; $k++)
    {
      $start = $period[$k];
      $end = $period[$k+1];
      $lriil = $this->Paket_model->getEntryJOLaki($start,$end,$jpid,$agid,$ppkode);
      $priil = $this->Paket_model->getEntryJOPerempuan($start,$end,$jpid,$agid,$ppkode);
      for($l = 1; $l <= $i; $l++)
      {
        if($jobtglawal[$l] <= $start && $jobtglakhir[$l] >= $end)
        {
          $lavail = $jobdl[$l];
          if($lavail < $lriil) { $jobdl[$l] = 0; $lriil -= $lavail;}
          else {$jobdl[$l] -= $lriil; $lriil = 0;}
          $pavail = $jobdp[$l];
          if($pavail < $priil) { $jobdp[$l] = 0; $priil -= $pavail;}
          else {$jobdp[$l] -= $priil; $priil = 0;}
          if($lriil > 0){
            $cavail = $jobdc[$l];
            if($cavail < $lriil) { $jobdc[$l] = 0; $lriil -= $cavail;}
            else {$jobdc[$l] -= $lriil; $lriil = 0;}
          }
          if($priil > 0){
            $cavail = $jobdc[$l];
            if($cavail < $priil) { $jobdc[$l] = 0; $priil -= $cavail;}
            else {$jobdc[$l] -= $priil; $priil = 0;}
          }
        }
      }
    }

    $sisa[0] = $jobdl[$i];
    $sisa[1] = $jobdp[$i];
    $sisa[2] = $jobdc[$i];
    return $sisa;
  }

  function getSearch($filters)
  {
    $where = "";
    $ops = array(
      'eq'=>'=',
      'ne'=>'<>',
      'lt'=>'<',
      'le'=>'<=',
      'gt'=>'>',
      'ge'=>'>=',
      'bw'=>'LIKE',
      'bn'=>'NOT LIKE',
      'in'=>'LIKE',
      'ni'=>'NOT LIKE',
      'ew'=>'LIKE',
      'en'=>'NOT LIKE',
      'cn'=>'LIKE',
      'nc'=>'NOT LIKE'
    );

    if($filters['groupOp'] == 'OR') {
      $first = true;
      $where .= " AND ( ";
      foreach ( $filters['rules'] as $item){
        if (!$first) {
          $where .= " OR ";
        }
        $searchString = $item['data'];
        if($item['field'] == 'jobtglawal' || $item['field'] == 'jobtglakhir') {
          $tgl = "STR_TO_DATE('".$searchString."','%d/%m/%Y')";
          $where .= $item['field']." ".$ops[$item['op']]." ".$tgl;
        } else {
          if($item['op'] == 'eq' ) $searchString = "'".$searchString."'";
          if($item['op'] == 'bw' || $item['op'] == 'bn') $searchString = "'".$searchString."%'";
          if($item['op'] == 'ew' || $item['op'] == 'en' ) $searchString = "'%".$searchString."'";
          if($item['op'] == 'cn' || $item['op'] == 'nc' || $item['op'] == 'in' || $item['op'] == 'ni') $searchString = "'%".$searchString."%'";
          if($item['field'] == 'jpnama') {
            $where .= "namajenispekerjaan ".$ops[$item['op']]." ".$searchString;
          } else {
            $where .= $item['field']." ".$ops[$item['op']]." ".$searchString;
          }
        }
        if ($first) {
          $first = false;
        }
      }
      $where .= " )";
    } else {
      foreach ( $filters['rules'] as $item){
        $where .= " AND ";
        $searchString = $item['data'];
        if($item['field'] == 'jobtglawal' || $item['field'] == 'jobtglakhir') {
          $tgl = "STR_TO_DATE('".$searchString."','%d/%m/%Y')";
          $where .= $item['field']." ".$ops[$item['op']]." ".$tgl;
        } else {
          if($item['op'] == 'eq' ) $searchString = "'".$searchString."'";
          if($item['op'] == 'bw' || $item['op'] == 'bn') $searchString = "'".$searchString."%'";
          if($item['op'] == 'ew' || $item['op'] == 'en' ) $searchString = "'%".$searchString."'";
          if($item['op'] == 'cn' || $item['op'] == 'nc' || $item['op'] == 'in' || $item['op'] == 'ni') $searchString = "'%".$searchString."%'";
          if($item['field'] == 'jpnama') {
            $where .= "namajenispekerjaan ".$ops[$item['op']]." ".$searchString;
          } else {
            $where .= $item['field']." ".$ops[$item['op']]." ".$searchString;
          }
        }
      }
    }

    return $where;
  }

  // AJAX AUTOCOMPLETE
   public function ambilnamaagensi($kode=NULL){
     $keyword = $this->input->post('term',TRUE);
     $query = $this->Agency_model->ambilnamaagensi($keyword);
     $json_array = array();
     $r = new stdClass;
     $i=0;
     foreach ($query as $row)
       $r->rows[$i++]=$row;
     echo json_encode($r);
   }

   public function ambilnamapptkis($kode=NULL){
     $keyword = $this->input->post('term',TRUE);
     $query = $this->Pptkis_model->ambilnamapptkis($keyword);
     $json_array = array();
     $r = new stdClass;
     $i=0;
     foreach ($query as $row)
       $r->rows[$i++]=$row;
     echo json_encode($r);
   }

   public function checkCekal()
   {
    $idagensi = $this->input->post('idag', TRUE);
    $idpptkis = $this->input->post('idpp', TRUE);

    $tmp['success'] = true;
    $tmp['message'] = "";

    $query = $this->Agency_model->get_cekalagid($idagensi);
    $query2 = $this->Pptkis_model->get_cekalppkode($idpptkis);

    if(!empty($query) && !empty($query2)) {
      $tmp['success'] = false;
      $tmp['message'] = "Agensi dan PPTKIS terkena cekal";
    } elseif(!empty($query)) {
      $tmp['success'] = false;
      $tmp['message'] = "Agensi terkena cekal";
    } elseif(!empty($query2)) {
      $tmp['success'] = false;
      $tmp['message'] = "PPTKIS terkena cekal";
    }

    echo json_encode($tmp);
   }

}
