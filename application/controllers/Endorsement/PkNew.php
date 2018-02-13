<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PkNew extends MY_Controller {

  private $data;

public function __construct()
  {

    parent::__construct();
    $this->load->model('Perlindungan/Agency_model');
    $this->load->model('Perlindungan/Pptkis_model');
    $this->load->model('SAdmin/Jobtype_model');
    $this->load->model('SAdmin/Institution_model');
    $this->load->model('SAdmin/Currency_model');
    $this->load->model('SAdmin/Input_model');
    $this->load->model('Endorsement/PK_model');
    $this->load->model('Endorsement/Kuitansi_model');
    $this->load->model('Endorsement/Endorsement_model');
    $this->load_sidebar();
    $this->data['listdp'] = $this->listdp;
    $this->data['usedpg'] = $this->usedpg;
    $this->data['usedmpg'] = $this->usedmpg;
    $this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
      $this->data['namakantor'] = $this->namakantor ? $this->namakantor->nama : ' ' ;
    $this->data['sidebar'] = 'SAdmin/Sidebar';
  }

  public function index()
  {
    if ($this->session->userdata('role') == 4 || $this->session->userdata('role') == 6 || $this->session->userdata('role') == 7 || $this->session->userdata('role') == 5){

      if($this->session->userdata('role') == 4){
        $this->data['dataagensi'] = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
        $this->data['datapptkis'] = $this->Pptkis_model->get_pptkis_by_agensi_in_pk($this->data['dataagensi']->agid);
      }

      if ($this->session->flashdata('data') != '')
      {
        $this->data = $this->session->flashdata('data');
      }

      $this->data['listagensi'] = $this->Agency_model->get_agency_from_institution($this->session->userdata('institution'), false, true);
      $this->data['listpptkis'] = $this->Pptkis_model->get_all_pptkis();
      $this->data['title'] = 'View Labour Contract (PK)';
      $this->data['subtitle'] = 'View Labour Contract (PK)';
      $this->data['subtitle2'] = 'View Labour Contract (PK)';
      $this->load->view('templates/headerendorsement', $this->data);
      $this->load->view('Endorsement/LihatPK_view', $this->data);
      $this->load->view('templates/footerendorsement');
    }
    else {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }
  }

  public function viewPkReentry()
  {
    if ($this->session->userdata('role') == 4 || $this->session->userdata('role') == 6 || $this->session->userdata('role') == 7 || $this->session->userdata('role') == 5){

      if($this->session->userdata('role') == 4){
        $this->data['dataagensi'] = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
        $this->data['datapptkis'] = $this->Pptkis_model->get_pptkis_by_agensi_in_pk($this->data['dataagensi']->agid);
      }

      if ($this->session->flashdata('data') != '')
      {
        $this->data = $this->session->flashdata('data');
      }

      $this->data['listagensi'] = $this->Agency_model->get_agency_from_institution($this->session->userdata('institution'), false, true);
      $this->data['listpptkis'] = $this->Pptkis_model->get_all_pptkis();
      $this->data['title'] = 'View Reentry Hiring';
      $this->data['subtitle'] = 'View Reentry Hiring';
      $this->data['subtitle2'] = 'View Reentry Hiring';
      $this->load->view('templates/headerendorsement', $this->data);
      $this->load->view('Endorsement/LihatPKReentry_view', $this->data);
      $this->load->view('templates/footerendorsement');
    }
    else {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }
  }

  public function viewPkTransfer()
  {
    if ($this->session->userdata('role') == 4 || $this->session->userdata('role') == 6 || $this->session->userdata('role') == 7 || $this->session->userdata('role') == 5){

      if($this->session->userdata('role') == 4){
        $this->data['dataagensi'] = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
        $this->data['datapptkis'] = $this->Pptkis_model->get_pptkis_by_agensi_in_pk($this->data['dataagensi']->agid);
      }

      if ($this->session->flashdata('data') != '')
      {
        $this->data = $this->session->flashdata('data');
      }

      $this->data['listagensi'] = $this->Agency_model->get_agency_from_institution($this->session->userdata('institution'), false, true);
      $this->data['listpptkis'] = $this->Pptkis_model->get_all_pptkis();
      $this->data['title'] = 'View Employer Transfer (PK)';
      $this->data['subtitle'] = 'View Employer Transfer (PK)';
      $this->data['subtitle2'] = 'View Employer Transfer (PK)';
      $this->load->view('templates/headerendorsement', $this->data);
      $this->load->view('Endorsement/LihatPKTransfer_view', $this->data);
      $this->load->view('templates/footerendorsement');
    }
    else {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }
  }

  public function uploadDokFin($pkkode)
  {
    if ($this->session->userdata('role') == 6 || $this->session->userdata('role') == 7)
    {
      if (empty($_FILES['dokumenfinalpk']['name']))
      {
        $this->form_validation->set_rules('dokumenfinalpk', 'Document', 'required');
        $this->form_validation->run();

        $this->data['values'] = $pkkode;

        $this->data['title'] = 'Upload Labour Contract (PK) Document';
        $this->data['subtitle'] = 'Upload Labour Contract (PK) Document';
        $this->data['subtitle2'] = 'Upload Labour Contract (PK) Document';
        $this->load->view('templates/headerendorsement', $this->data);
        $this->load->view('Endorsement/UploadDokumenPK_view', $this->data);
        $this->load->view('templates/footerendorsement');
      }
      else
      {
        $returnUploadPK = $this->PK_model->upload_dokumen_final_pk($pkkode);
        if ($returnUploadPK) {
          //echo "masuk if";
          $config['upload_path'] = './uploads/dokumenfinalpk/';
          $config['allowed_types'] = '*';
          $config['remove_spaces'] = TRUE;
          $config['file_name'] = "Dokumen_Final_PK_$pkkode";

          $this->load->library('upload', $config);

          if ( !$this->upload->do_upload('dokumenfinalpk'))
          {
            $this->data['error'] = $this->upload->display_errors('','');
          } else {
            $this->data['error'] = "";
            //$this->session->set_flashdata('information', 'Upload berhasil dilakukan');
          }
          $this->session->set_flashdata('information', 'Data successfully inserted');
        }
        else {
          $this->session->set_flashdata('information', 'Data failed to insert');
        }

        $this->session->set_flashdata('print', 'Document successfully uploaded');
        $datapk = $this->PK_model->get_pk_from_barcode($pkkode);
        $this->data['kuitansiag'] = $datapk[0]->agid;
        $this->data['kuitansipp'] = $datapk[0]->ppkode;
        $this->session->set_flashdata('data', $this->data);

        redirect('pknew/');
      }

    }
    else {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }
  }
  public function downloadDokFin($param)
  {
        $data['pk'] = $this->PK_model->get_pk_for_report($param);
        $data['bc'] = $data['pk']['tkbc'];

        ini_set('memory_limit', '64M');
        $nama_dokumen = "PK_Report";

        $html = $this->load->view('Endorsement/PK/'.$data['pk']['idinstitution'].'/'.$data['pk']['idjenispekerjaan'].'.php', $data, true); //render the view into HTML

        $this->load->library('pdfm');
        $pdf=$this->pdfm->load();

        //$data['pk']['idinstitution'] = 3;
        //$data['pk']['idjenispekerjaan'] = 2;

        if($data['pk']['idinstitution'] == 2){ // pk taiwan
          $html = $this->load->view('Endorsement/PK/'.$data['pk']['idinstitution'].'/'.$data['pk']['idjenispekerjaan'].'.php', $data, true); //render the view into HTML

          $pdf->SetImportUse();

          $pagecount = $pdf->SetDocTemplate('assets/pdf/'.$data['pk']['idinstitution'].'/'.$data['pk']['idjenispekerjaan'].'.pdf', true);

          $pdf->AddPage();
        }
        if($data['pk']['idinstitution'] == 3){ // pk malaysia
          // formal
          $html = $this->load->view('Endorsement/PK/'.$data['pk']['idinstitution'].'/formal.php', $data, true);
          // informal
          //$html = $this->load->view('Endorsement/PK/'.$data['pk']['idinstitution'].'/informal.php', $data, true);

          $this->load->library('pdfm');
          $pdf=$this->pdfm->load();
          $pdf->SetFooter(''.'|{PAGENO}|'.'<barcode code="'. $data['bc'].'" type="C39" /><br>'.$data['bc']);
        }

        $pdf->WriteHTML($html); //write the HTML into PDF
        $pdf->Output($nama_dokumen.".pdf" ,'I');
  }

  public function getDataPK()
  {
    $agid = $this->input->post('agid', TRUE);
    $ppkode = $this->input->post('ppkode', TRUE);
    $res = $this->PK_model->get_data_pk_by_agensi_and_pptkis($agid, $ppkode);
    //$res = $this->PKP_model->get_data_pkp_by_agensi_and_pptkis(26926, 'ABD022');
  //var_dump($res);
    echo json_encode($res);
  }

  public function getDataPKReentry()
  {
    $agid = $this->input->post('agid', TRUE);
    $ppkode = $this->input->post('ppkode', TRUE);
    $res = $this->PK_model->get_data_pk_reentry_by_agensi_and_pptkis($agid, $ppkode);
    //$res = $this->PKP_model->get_data_pkp_by_agensi_and_pptkis(26926, 'ABD022');
  //var_dump($res);
    echo json_encode($res);
  }

  public function getDataPKTransfer()
  {
    $agid = $this->input->post('agid', TRUE);
    $ppkode = $this->input->post('ppkode', TRUE);
    $res = $this->PK_model->get_data_pk_transfer_by_agensi_and_pptkis($agid, $ppkode);
    //$res = $this->PKP_model->get_data_pkp_by_agensi_and_pptkis(26926, 'ABD022');
  //var_dump($res);
    echo json_encode($res);
  }

  public function addPk()
  {
    $agensi = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
    if(!empty($agensi)) {
      $this->data['listconnpp'] = $this->Endorsement_model->get_connected_pptkis($agensi->agid);
      $this->data['listcekalpp'] = $this->Endorsement_model->get_connected_pptkis($agensi->agid, true);
    }
    $this->data['employer'] = $this->Input_model->get_input_dataworker($this->session->userdata('institution'));
    $this->data['joborder'] = $this->Input_model->get_input_joborder($this->session->userdata('institution'));
    $this->data['title'] = 'Apply Labour Contract (PK)';
    $this->data['subtitle'] = 'Apply Labour Contract (PK)';
    $this->data['subtitle2'] = 'Worker Data';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/AddPK_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function addPkPenempatan()
  {
    $this->data['listconnag'] =  $this->Agency_model->get_agency_from_institution($this->session->userdata('institution'),false,true);
    $this->data['employer'] = $this->Input_model->get_input_dataworker($this->session->userdata('institution'));
    $this->data['joborder'] = $this->Input_model->get_input_joborder($this->session->userdata('institution'));
    $this->data['title'] = 'Apply Labour Contract (PK)';
    $this->data['subtitle'] = 'Apply Labour Contract (PK)';
    $this->data['subtitle2'] = 'Worker Data';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/addPkPenempatan_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function addPkReentry()
  {
    $this->data['employer'] = $this->Input_model->get_input_dataworker($this->session->userdata('institution'));
    $this->data['joborder'] = $this->Input_model->get_input_joborder($this->session->userdata('institution'));
    $this->data['title'] = 'Reentry Hiring (Labour Contract)';
    $this->data['subtitle'] = 'Create Reentry Hiring (Labour Contract)';
    $this->data['subtitle2'] = 'Worker Data';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/addPkReentry_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function addPkTransfer()
  {
    $this->data['employer'] = $this->Input_model->get_input_dataworker($this->session->userdata('institution'));
    $this->data['joborder'] = $this->Input_model->get_input_joborder($this->session->userdata('institution'));
    $this->data['title'] = 'Employer Transfer (PK)';
    $this->data['subtitle'] = 'Employer Transfer (PK)';
    $this->data['subtitle2'] = 'Worker Data';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/addPkTransfer_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function quickInfo()
  {
    $agid = $this->input->post('agency', true);
    if(!($agid))
    {
      $agid = $agensi = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'))->agid;
    }
    $ppkode = $this->input->post('ppkode', true);
    echo json_encode($this->PK_model->last_pk($agid, $ppkode));
  }

  function checkPaspor()
  {
    $paspor = $this->input->post('paspor', TRUE);
    $data = $this->PK_model->query_paspor($paspor);

    echo json_encode($data);
  }

  public function legalize()
  {
    $currencyid = $this->Institution_model->get_institution($this->session->userdata('institution'))->idcurrency;
    $currencyname = $this->Currency_model->get_currency_name($currencyid);
    $this->data['title'] = 'Endorse Labour Contract (PK)';
    $this->data['currency'] = $currencyname->currencyname;
    $this->data['subtitle'] = 'Endorse Labour Contract (PK)';
    $this->data['subtitle2'] = 'Endorse Labour Contract (PK)';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/LegalizePK_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function legalizeReentry()
  {
    $currencyid = $this->Institution_model->get_institution($this->session->userdata('institution'))->idcurrency;
    $currencyname = $this->Currency_model->get_currency_name($currencyid);
    $this->data['title'] = 'Endorse Reentry Hiring Labour Contract (PK)';
    $this->data['currency'] = $currencyname->currencyname;
    $this->data['subtitle'] = 'Endorse Reentry Hiring Labour Contract (PK)';
    $this->data['subtitle2'] = 'Endorse Reentry Hiring Labour Contract (PK)';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/LegalizePKReentry_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function legalizeTransfer()
  {
    $currencyid = $this->Institution_model->get_institution($this->session->userdata('institution'))->idcurrency;
    $currencyname = $this->Currency_model->get_currency_name($currencyid);
    $this->data['title'] = 'Endorse Employer Transfer Labour Contract (PK)';
    $this->data['currency'] = $currencyname->currencyname;
    $this->data['subtitle'] = 'Endorse Employer Transfer Labour Contract (PK)';
    $this->data['subtitle2'] = 'Endorse Employer Transfer Labour Contract (PK)';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/LegalizePKTransfer_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function insertEJ()
  {
    $postdata = $this->input->post('postdata', TRUE);
    $posttki = $this->input->post('posttki', TRUE);
    $postdata = json_decode($postdata);
    $posttki = json_decode($posttki);
    $data = array();
    foreach(get_object_vars($postdata) as $prop => $val)
    {
      $data["$prop"] = $val;
    }
    $date = date('Y-m-d');
    $data['ejdatefilled'] = $date;
    $url = $this->Endorsement_model->geturlpekerjaan($data["idjenispekerjaan"]);
    $data["jodownloadurl"] = $url->curjodownloadurl;
    $splittgl = explode("/", $data["joclatgl"]);
    $data["joclatgl"] = $splittgl[0]."-".$splittgl[1]."-".$splittgl[2];
    if(!(array_key_exists('agid', $data)))
    {
      $data["agid"] = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'))->agid;
    }
    $data["idinstitution"] = $this->session->userdata('institution');
    $data["idkantor"] = $this->session->userdata('kantor');
    $ejid = $this->Endorsement_model->insert_ej($data);
    $datatki = array();
    foreach($posttki as $tki)
    {
        $datatki["ejid"] = $ejid;
        $datatki["tkidownloadurl"] = $url->curtkidownloadurl;
        $datatki["md5ej"] = md5($ejid);
        $check = $this->Endorsement_model->find_tkipaspor($tki->tkpaspor);
        if($check > 0)
        {
          $this->Endorsement_model->update_TKI($datatki,$tki->tkpaspor);
        }
    }
    echo json_encode(md5($ejid));
  }

  public function getDataFromBarcode()
  {
    $bc = $this->input->post('barcode', TRUE);
    $status = $this->input->post('status', TRUE) ? $this->input->post('status', TRUE) : 0;
    $result = $this->PK_model->get_pk_from_barcode($bc, $status);
    echo json_encode($result);
  }

  public function legalizeBarcode()
  {
    $bc = $this->input->post('barcode', TRUE);
    $result = $this->PK_model->legalize_barcode($bc);

    echo json_encode($result);
  }

  public function getPPTKISByAgensi()
  {
    $agid = $this->input->post('agid', TRUE);
    $result = $this->Pptkis_model->get_pptkis_by_agensi_in_pk($agid);

    echo json_encode($result);
  }

  public function generateBarcode()
  {
    $abnormalize[1] = '01';
    $abnormalize[2] = '02';
    $abnormalize[3] = '03';
    $abnormalize[4] = '04';
    $abnormalize[5] = '05';
    $abnormalize[6] = '06';
    $abnormalize[7] = '07';
    $abnormalize[8] = '08';
    $abnormalize[9] = '09';
    $abnormalize[10] = '10';
    $abnormalize[11] = '11';
    $abnormalize[12] = '12';
    $abnormalize[13] = '13';
    $abnormalize[14] = '14';
    $abnormalize[15] = '15';
    $abnormalize[16] = '16';
    $abnormalize[17] = '17';
    $abnormalize[18] = '18';
    $abnormalize[19] = '19';
    $abnormalize[20] = '20';
    $abnormalize[21] = '21';
    $abnormalize[22] = '22';
    $abnormalize[23] = '23';
    $abnormalize[24] = '24';
    $abnormalize[25] = '25';
    $abnormalize[26] = '26';
    $abnormalize[27] = '27';
    $abnormalize[28] = '28';
    $abnormalize[29] = '29';
    $abnormalize[30] = '30';
    $abnormalize[31] = '31';
    $kode[1] = 'A';$kode[2] = 'B';$kode[3] = 'C';$kode[4] = 'D';$kode[5] = 'E';
    $kode[6] = 'F';$kode[7] = 'G';$kode[8] = 'H';$kode[9] = 'I';$kode[10] = 'J';
    $kode[11] = 'K';$kode[12] = 'L';$kode[13] = 'M';$kode[14] = 'N';$kode[5] = 'O';
    $kode[16] = 'P';$kode[17] = 'Q';$kode[18] = 'R';$kode[19] = 'S';$kode[20] = 'T';
    $kode[21] = 'U';$kode[22] = 'V';$kode[23] = 'W';$kode[24] = 'X';$kode[25] = 'Y';
    $kode[26] = 'Z';
    $tglmasuk = $this->input->post('start',TRUE) ? $this->input->post('start',TRUE) : date("Y/m/d");
    $p = explode("/", $tglmasuk);
    $tglmasuk = intval($p[2]);
    $blnmasuk = intval($p[1]);
    $thnmasuk = $p[0];
    $extra = 0;

    if($blnmasuk == '12' && $thnmasuk == '2011')
    {
      $extra = 627;
    }
    $kodetahun = $kode[$thnmasuk-2010];
    $kodebulan = $kode[$blnmasuk];
    $kodetipe = $kode[1];
    $tglmasuk = $abnormalize[$tglmasuk];
    $blnmasuk = $abnormalize[$blnmasuk];
    $count = $this->Kuitansi_model->getCountKuitansi($thnmasuk,$blnmasuk);
    $order = $extra+$count->count;
    $barcodeku = '';
    if($order < 10){$barcodeku = '0000' . $order . $kodebulan . $kodetahun. $kodetipe;}
    else if($order < 100){$barcodeku = '000' . $order . $kodebulan . $kodetahun. $kodetipe;}
    else if($order < 1000){$barcodeku = '00' . $order . $kodebulan . $kodetahun. $kodetipe;}
    else if($order < 10000){$barcodeku = '0' . $order . $kodebulan . $kodetahun. $kodetipe;}
    return $barcodeku;
  }
  public function catatKuitansi()
  {
    if ($this->input->post('catatkuitansi', TRUE))
    {
      $this->form_validation->set_rules('start', 'Tanggal Masuk', 'required|trim');
      $this->form_validation->set_rules('tglkuitansi', 'Tanggal Kuitansi', 'required|trim');
      $this->form_validation->set_rules('kuno', 'Nomor Kuitansi', 'required|trim');
      $this->form_validation->set_rules('jmlterbayar', 'Jumlah Terbayar', 'required|trim');
      $this->form_validation->set_rules('pemohon', 'Nama Pemohon', 'required|trim');
      //$this->form_validation->set_rules('dokumenpkp', 'DokumenPKP', 'required|trim');

      if ($this->form_validation->run() === FALSE)
      {
        $this->session->set_flashdata('information', 'Complete receipt form!');
        redirect('pknew/legalize');
      }
      else {
        if (!($this->input->post('kuitansiag', true)))
        {
          redirect('pknew');
        }
        $username = $this->session->userdata('user');
        $institusi = $this->session->userdata('institution');
        $this->Kuitansi_model->catat_kuitansi($username, $institusi, $barcodeku, 1);
        $this->session->set_flashdata('print', 'Segera Upload Dokumen Final PK');
        $this->data['bc'] = $this->input->post('barcodeprint', true);
        $this->data['kuitansiag'] = $this->input->post('kuitansiag', true);
        $this->data['kuitansipp'] = $this->input->post('kuitansipp', true);
        $this->session->set_flashdata('data', $this->data);
        redirect('pknew');
      }
    }
    else {
      if (!($this->input->post('kuitansiag', true)))
      {
        redirect('pknew');
      }
      $this->session->set_flashdata('print', 'Segera Upload Dokumen Final PK ');
      $this->data['bc'] = $this->input->post('barcodeprint', true);
      $this->data['kuitansiag'] = $this->input->post('kuitansiag', true);
      $this->data['kuitansipp'] = $this->input->post('kuitansipp', true);
      $this->session->set_flashdata('data', $this->data);
      redirect('pknew');
    }
  }
}
