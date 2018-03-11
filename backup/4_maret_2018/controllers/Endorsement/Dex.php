<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dex extends MY_Controller {

  private $data;

  public function __construct()
  {
    parent::__construct();
    $this->load_sidebar();
    $this->load->model('Endorsement/Endorsement_model');
    $this->load->model('Endorsement/Dex_model');

    $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file', 'key_prefix' => 'penempatan_'));

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
    $this->data['title'] = 'View All Data Direct Ext. Hiring';
    $this->data['subtitle'] = 'View All Data Direct Ext. Hiring';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/Dex/LihatDex_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function verify()
  {
    if(isset($_GET['kode_entry']))
    {
      $entry = $this->Dex_model->getEntry($_GET['kode_entry'])->result();
      if(!empty($entry))
      {
        $entry = $entry[0];
        $documents = $this->Dex_model->getDocument($entry->id);
        foreach ($documents->result() as $document) {
          if($document->type == 1)
            $entry->{strtolower("FILE_SURAT_MOL")} = $document->id;
          if($document->type == 2)
            $entry->{strtolower("FILE_KTP_MAJIKAN")} = $document->id;
          if($document->type == 3)
            $entry->{strtolower("FILE_PASPOR_ARC")} = $document->id;
          if($document->type == 4)
            $entry->{strtolower("FILE_ASURANSI_TAIWAN")} = $document->id;
          if($document->type == 5)
            $entry->{strtolower("FILE_LISENSI_AGENSI")} = $document->id;
          if($document->type == 6)
            $entry->{strtolower("FILE_SURAT_IJIN_KELUARGA")} = $document->id;
          if($document->type == 7)
            $entry->{strtolower("FILE_SURAT_PERNYATAAN_TKI")} = $document->id;
          if($document->type == 8)
            $entry->{strtolower("FILE_LISENSI_PERUSAHAAN")} = $document->id; 
          $pekerjaan = $this->Dex_model->getPekerjaan();
          $kuitansi = $this->Dex_model->getKuitansi($entry->id)->result();
        }
        $this->data['entry'] = $entry;
        if(!empty($kuitansi))$this->data['kuitansi'] = $kuitansi[0];
        $this->data['pekerjaans'] = $pekerjaan->result();
      }
      
    }
    else if(isset($_POST['_method']))
    {
      if($_POST['_method'] == 'PUT')
      {
        $this->session->mark_as_flash('update_success');
      }
      else if($_POST['_method'] == 'POST')
      {
        $status_validasi =$_POST['status_validasi'];
        $kode_entry = $_POST['kode_entry'];
        $entry = $this->Dex_model->getEntry($kode_entry)->result()[0];
        if(!$entry->is_terima && !$entry->is_tolak)
        {
          if($status_validasi==1)$status_terima=$this->Dex_model->terimaEntry($entry->id,1,0);
          if($status_validasi==0)$status_terima=$this->Dex_model->terimaEntry($entry->id,0,1);
        }
        $this->session->mark_as_flash('create_success');
        redirect(base_url().'/dex/verify?kode_entry='.$kode_entry);
      }
    }
    $this->data['title'] = 'Verify & Endorse Direct Ext. Hiring';
    $this->data['subtitle'] = 'Verify & Endorse Direct Ext. Hiring';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/Dex/VerifyDex_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function salary()
  {
    if (isset($_POST['_method']) && $_POST['_method'] == 'PUT') {
      $id = $_POST["id"];
      $batas_atas = $_POST["batas_atas"];
      $batas_bawah = $_POST["batas_bawah"];
      $salary = $this->Dex_model->updateSalary($id,$batas_bawah,$batas_atas);
      $this->session->mark_as_flash('update_success');
      redirect(base_url().'/dex/salary');

    }
    $this->data['title'] = 'Manage Salary Direct Ext. Hiring';
    $this->data['subtitle'] = 'Manage Salary Direct Ext. Hiring';
    $pekerjaan = $this->Dex_model->getPekerjaan();
    $this->data['pekerjaans'] = $pekerjaan->result(); 
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/Dex/SalaryDex_view', $this->data);
    $this->load->view('templates/footerendorsement');
  }

  public function simpan_kuitansi()
  {

    $kuitansi = $this->Dex_model->simpanKuitansi($_POST['kode_entry'],$_POST['entry_id'],$_POST['no_kuitansi'],$_POST['jumlah'],$_POST['pemohon'],$_POST['tgl_masuk'],$_POST['tgl_kuitansi']);
    if($kuitansi)
    {
      $this->session->mark_as_flash('create_kuitansi_success');
      redirect(base_url().'/dex/verify?kode_entry='.$_POST['kode_entry']);
    }
  }

  public function entry_json()
  {
    header('Content-Type: application/json');
    $this->load->library('datatables');
    $this->datatables->select('nama_pekerja,no_paspor,CONCAT(nama_perusahaan_eng,"/",nama_perusahaan) as nama_perusahaan,pekerjaans.nama as pekerjaan,DATE_FORMAT(tgl_mulai, "%D-%M-%Y") tgl_mulai,DATE_FORMAT(tgl_selesai, "%D-%M-%Y") tgl_selesai,CONCAT(nama_majikan_eng,"/",nama_majikan) as nama_majikan,CONCAT(CASE WHEN is_terima=1 AND (is_tolak is NULL OR is_tolak=0) THEN "Terima" WHEN is_tolak=1 AND (is_terima is NULL OR is_terima=0) THEN "Tolak" ELSE "Belum Diverivikasi" END) as status');
    $this->datatables->join('pekerjaans', 'pekerjaans.id = entries.pekerjaan_id');
    $this->datatables->from('entries');
    echo $this->datatables->generate();
  }

}
