<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kuitansi extends MY_Controller {

  private $data;

  public function __construct()
  {
    parent::__construct();
    $this->load_sidebar();
    $this->data['listdp'] = $this->listdp;
    $this->data['usedpg'] = $this->usedpg;
    $this->data['usedmpg'] = $this->usedmpg;
    $this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
    $this->data['namakantor'] = $this->namakantor->nama;
    $this->data['sidebar'] = 'SAdmin/Sidebar';
    $this->load->model('SAdmin/Currency_model');
    $this->load->model('SAdmin/Institution_model');
    $this->load->model('Endorsement/Kuitansi_model');
    $this->load->model('Endorsement/Endorsement_model');
    $this->load->model('Endorsement/EntryJO_model');
    $this->load->model('Endorsement/TKIEndorse_model');
    $this->load->model('Perlindungan/Agency_model');
    $this->load->model('Perlindungan/Pptkis_model');
    $this->load->library('Barcode');
    $this->load->library('encrypt');
  }

  public function index()
  {

  }

  public function ubah()
  {
    $datenow = date("Y-m-d");
    $this->data['title'] = 'Ubah Kuitansi';
    $this->data['subtitle'] = 'Pencatatan Kuitansi';
    $this->data['list'] = $this->Kuitansi_model->getKuitansiByDate('datenow');
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/UbahKuitansi_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function edit($id)
  {
    $this->form_validation->set_rules('kutglmasuk', 'Tanggal Masuk Kuitansi', 'required|trim');
    $this->form_validation->set_rules('kutglkuitansi', 'Tanggal Kuitansi', 'required|trim');
    $this->form_validation->set_rules('idtipe', 'Jenis Dokumen', 'required|trim');
    $this->form_validation->set_rules('noku', 'Nomor Kuitansi', 'required|trim');
    $this->form_validation->set_rules('kujmlbayar', 'Jumlah Terbayar', 'required|trim');
    $this->form_validation->set_rules('kupemohon', 'Nama Pemohon', 'required|trim');

    if ($this->form_validation->run() === FALSE) {
      $this->data['values'] = $this->Kuitansi_model->get_kuitansi($id);
      $tgl = explode("-", $this->data['values']->kutglmasuk);
      $tglkuisplit = explode("-", $this->data['values']->kutglkuitansi);
      $tglkui = $tglkuisplit[0]."/".$tglkuisplit[1]."/".$tglkuisplit[2];
      $tglkuisplittime = explode(" ", $tglkui);
      $this->data['values']->kutglmasuk = $tgl[0]."/".$tgl[1]."/".$tgl[2];
      $this->data['values']->kutglkuitansi = $tglkuisplittime[0];
      //var_dump($this->data['values']->kutglmasuk);
      $this->data['listtipe'] = $this->Kuitansi_model->list_all_tipe();
      //var_dump($this->data['values']);
      //var_dump($this->data['listtipe']);

      $this->data['title'] = 'Edit Data Kuitansi';
      $this->data['subtitle'] = 'Pencatatan Kuitansi';
      $this->load->view('templates/headerendorsement', $this->data);
      $this->load->view('Endorsement/EditKuitansi_view', $this->data);
      $this->load->view('templates/footerendorsement');
    }
    else{
      $this->Kuitansi_model->updatekui($id);
      redirect('Kuitansi/Ubah');
    }



  }

  public function cetak($bc)
  {
    $data['bc'] = $this->encrypt->encode($bc);
    $data['namainstitusi'] = $this->namainstitusi->nameinstitution;

    $this->load->view('Endorsement/print_label', $data);
  }

  public function getKuitansiByDate()
  {
    $fieldtgl = $this->input->post('fieldtgl',TRUE);
    $tglsplitted = explode("/", $fieldtgl);
    $tglfix = $tglsplitted[0]."-".$tglsplitted[1]."-".$tglsplitted[2];
    $datakuitansi = $this->Kuitansi_model->getKuitansiByDate($tglfix);

    echo json_encode($datakuitansi);
  }

  public function catat()
  {
    $this->form_validation->set_rules('start', 'Tanggal Masuk', 'required|trim');

    if ($this->form_validation->run() === FALSE)
    {
      $currencyid = $this->Institution_model->get_institution($this->session->userdata('institution'))->idcurrency;
      $currencyname = $this->Currency_model->get_currency_name($currencyid);
      $this->data['listdokumen'] = $this->Kuitansi_model->list_dokumen_kuitansi();
      $this->data['currency'] = $currencyname->currencyname;
      $this->data['title'] = 'Catat Kuitansi';
      $this->data['subtitle'] = 'Pencatatan Kuitansi';
      $this->data['subtitle2'] = 'History';
      $this->load->view('templates/headerendorsement', $this->data);
      $this->load->view('Endorsement/PencatatanKuitansi_view', $this->data);
      $this->load->view('templates/footerendorsement');
    }
    else {
        //preparing variables
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
        $tglmasuk = $this->input->post('start',TRUE);
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
        $kodetipe = $kode[$this->input->post('dokumen', TRUE)];
        $tglmasuk = $abnormalize[$tglmasuk];
        $blnmasuk = $abnormalize[$blnmasuk];
        $count = $this->Kuitansi_model->getCountKuitansi($thnmasuk,$blnmasuk);
        $order = $extra+$count->count;
        $barcodeku = '';
        if($order < 10){$barcodeku = '0000' . $order . $kodebulan . $kodetahun. $kodetipe;}
        else if($order < 100){$barcodeku = '000' . $order . $kodebulan . $kodetahun. $kodetipe;}
        else if($order < 1000){$barcodeku = '00' . $order . $kodebulan . $kodetahun. $kodetipe;}
        else if($order < 10000){$barcodeku = '0' . $order . $kodebulan . $kodetahun. $kodetipe;}

      if($this->input->post('bc',TRUE) == "" && $this->input->post('dokumen', TRUE) != 1)
      {


        //proses insert
        $username = $this->session->userdata('user');
        $institusi = $this->session->userdata('institution');
        $this->Kuitansi_model->catat_kuitansi($username,$institusi,$barcodeku);
        $this->session->set_flashdata('print', 'Data berhasil dimasukkan');
        $currencyid = $this->Institution_model->get_institution($this->session->userdata('institution'))->idcurrency;
        $currencyname = $this->Currency_model->get_currency_name($currencyid);
        $this->data['listdokumen'] = $this->Kuitansi_model->list_dokumen_kuitansi();
        $this->data['currency'] = $currencyname->currencyname;
        $this->data['title'] = 'Catat Kuitansi';
        $this->data['subtitle'] = 'Pencatatan Kuitansi';
        $this->data['subtitle2'] = 'History';
        $this->data['bc'] = $barcodeku;
        $this->load->view('templates/headerendorsement', $this->data);
        $this->load->view('Endorsement/PencatatanKuitansi_view', $this->data);
        $this->load->view('templates/footerendorsement');
      }
      else {
        $hasil = $this->Kuitansi_model->check_barcode();
        if($hasil)
        {
          if($hasil->ejtglendorsement)
          {
            $this->session->set_flashdata('information', 'Data dengan Barcode tersebut telah diendorse!');
            $currencyid = $this->Institution_model->get_institution($this->session->userdata('institution'))->idcurrency;
            $currencyname = $this->Currency_model->get_currency_name($currencyid);
            $this->data['listdokumen'] = $this->Kuitansi_model->list_dokumen_kuitansi();
            $this->data['currency'] = $currencyname->currencyname;
            $this->data['title'] = 'Catat Kuitansi';
            $this->data['subtitle'] = 'Pencatatan Kuitansi';
            $this->data['subtitle2'] = 'History';
            $this->load->view('templates/headerendorsement', $this->data);
            $this->load->view('Endorsement/PencatatanKuitansi_view', $this->data);
            $this->load->view('templates/footerendorsement');
          }
          else {
            $cekalagen =  $this->Agency_model->get_cekalagid($hasil->agid);
            $cekalpptkis = $this->Pptkis_model->get_cekalppkode($hasil->ppkode);
            if($cekalagen)
            {
              $this->session->set_flashdata('information', 'Agensi terkait masih dalam status cekal!');
              $currencyid = $this->Institution_model->get_institution($this->session->userdata('institution'))->idcurrency;
              $currencyname = $this->Currency_model->get_currency_name($currencyid);
              $this->data['listdokumen'] = $this->Kuitansi_model->list_dokumen_kuitansi();
              $this->data['currency'] = $currencyname->currencyname;
              $this->data['title'] = 'Catat Kuitansi';
              $this->data['subtitle'] = 'Pencatatan Kuitansi';
              $this->data['subtitle2'] = 'History';
              $this->load->view('templates/headerendorsement', $this->data);
              $this->load->view('Endorsement/PencatatanKuitansi_view', $this->data);
              $this->load->view('templates/footerendorsement');
            }
            else if($cekalpptkis){
              $this->session->set_flashdata('information', 'PPTKIS terkait masih dalam status cekal!');
              $currencyid = $this->Institution_model->get_institution($this->session->userdata('institution'))->idcurrency;
              $currencyname = $this->Currency_model->get_currency_name($currencyid);
              $this->data['listdokumen'] = $this->Kuitansi_model->list_dokumen_kuitansi();
              $this->data['currency'] = $currencyname->currencyname;
              $this->data['title'] = 'Catat Kuitansi';
              $this->data['subtitle'] = 'Pencatatan Kuitansi';
              $this->data['subtitle2'] = 'History';
              $this->load->view('templates/headerendorsement', $this->data);
              $this->load->view('Endorsement/PencatatanKuitansi_view', $this->data);
              $this->load->view('templates/footerendorsement');
            }
            else{
              $username = $this->session->userdata('user');
              $institusi = $this->session->userdata('institution');
              $kuid = $this->Kuitansi_model->catat_kuitansi($username,$institusi,$barcodeku);
              $this->Endorsement_model->catatKuitansi_ej($hasil->ejid,$kuid);
              $endorse = $this->input->post('endorse',TRUE);
              if($endorse)
              {
                $this->TKIEndorse_model->updateTglEndorse($hasil->ejid);
                $this->EntryJO_model->updateTglEndorse($hasil->ejid);
              }
              $this->session->set_flashdata('print', 'Data berhasil dimasukkan');
              $currencyid = $this->Institution_model->get_institution($this->session->userdata('institution'))->idcurrency;
              $currencyname = $this->Currency_model->get_currency_name($currencyid);
              $this->data['listdokumen'] = $this->Kuitansi_model->list_dokumen_kuitansi();
              $this->data['currency'] = $currencyname->currencyname;
              $this->data['title'] = 'Catat Kuitansi';
              $this->data['subtitle'] = 'Pencatatan Kuitansi';
              $this->data['subtitle2'] = 'History';
              $this->data['bc'] = $barcodeku;
              $this->load->view('templates/headerendorsement', $this->data);
              $this->load->view('Endorsement/PencatatanKuitansi_view', $this->data);
              $this->load->view('templates/footerendorsement');
            }
          }
        }
        else {
          $this->session->set_flashdata('information', 'Barcode tidak ditemukan!');
          $currencyid = $this->Institution_model->get_institution($this->session->userdata('institution'))->idcurrency;
          $currencyname = $this->Currency_model->get_currency_name($currencyid);
          $this->data['listdokumen'] = $this->Kuitansi_model->list_dokumen_kuitansi();
          $this->data['currency'] = $currencyname->currencyname;
          $this->data['title'] = 'Catat Kuitansi';
          $this->data['subtitle'] = 'Pencatatan Kuitansi';
          $this->data['subtitle2'] = 'History';
          $this->load->view('templates/headerendorsement', $this->data);
          $this->load->view('Endorsement/PencatatanKuitansi_view', $this->data);
          $this->load->view('templates/footerendorsement');
        }
      }
    }

  }

  public function checkkuitansi()
  {
    $noku = $this->input->post('noku', TRUE);
    $result = $this->Kuitansi_model->check_kuitansi($noku);
    echo json_encode($result);
  }

  function printLabel()
  {
    $bc = $this->input->post('barcode', TRUE);

    $data['bc'] = $this->encrypt->encode($bc);
    $data['namainstitusi'] = $this->namainstitusi->nameinstitution;

    $this->load->view('Endorsement/print_label',$data);
  }


}
