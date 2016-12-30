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
    $this->data['sidebar'] = 'SAdmin/Sidebar';
  }

  public function index()
  {
    $this->data['title'] = 'Catatan Aktivitas';
    $this->data['subtitle'] = 'Catatan Aktivitas Petugas Penanganan';

    $this->data['result_log'] = array();

    foreach($listlog as $row):
      $user = $this->Log_model->get_namapetugas($row->user_username);
      $namatki = $this->Log_model->get_namatki($row->idmasalah);
      $history = $row;
      array_push($this->data['result_log'], array($user[0]->name,strtoupper($namatki[0]->namatki),$history));
    endforeach;

    $this->load->view('templates/headerperlindungan', $this->data);
    $this->load->view('Perlindungan/CatatanAktivitas_view', $this->data);
    $this->load->view('templates/footerperlindungan');
  }

  public function add()
  {
    $this->data['title'] = 'Mendaftarkan Paket JO';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('endorsement/DaftarPaketJO_view');
    $this->load->view('templates/footerendorsement');
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

    $totalrows = isset($_POST['totalrows']) ? $_POST['totalrows']: false;
    if($totalrows) {
      $limit = $totalrows;
    }

    //$count = $this->Paket_model->countJO($agid,$ppkode);
    $count = $this->Paket_model->countJO('2','12345')->count;

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
    
    $query = $this->Paket_model->getJO('2','12345',$start,$limit,$sidx,$sord);
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

  public function getSisa()
  {
    $jobd = $this->input->get('jobdid', TRUE);
    $jpid = $this->input->get('jpid', TRUE);

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

  // AJAX AUTOCOMPLETE
  public function ambilnamaagensi($kode=NULL){
    $keyword = $this->input->post('kode',TRUE);
    $query = $this->Agency_model->ambilnamaagensi($keyword);
    $json_array = array();
    foreach ($query as $row)
      $json_array[]=$row->agnama;
    echo json_encode($json_array);
  }

  public function ambilnamapptkis($kode=NULL){
    $keyword = $this->input->post('kode',TRUE);
    $query = $this->Pptkis_model->ambilnamapptkis($keyword);
    $json_array = array();
    foreach ($query as $row)
      $json_array[]=$row->ppnama;
    echo json_encode($json_array);
  }

}
