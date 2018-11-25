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
    $this->load->library('excel');

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
        }
        $pekerjaan = $this->Dex_model->getPekerjaan();
        $kuitansi = $this->Dex_model->getKuitansi($entry->id)->result();
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
  public function report_view()
  {
    $this->data['title'] = 'Report Direct Ext. Hiring';
    $this->data['subtitle'] = 'Report Direct Ext. Hiring';
    $this->load->view('templates/headerendorsement', $this->data);
    $this->load->view('Endorsement/Dex/ReportDex_view', $this->data);
    $this->load->view('templates/footerendorsement'); 
  }
  public function report_entry()
  {
    $filename = "Daftar Entry";
    $title = "Daftar Entry";
    $file = $filename . '.xls'; //save our workbook as this file name
   
    
    header('Content-Type: application/vnd.ms-excel'); //mime type
    header('Content-Disposition: attachment;filename="'.$file.'"'); //tell browser what's the file name
    header('Cache-Control: max-age=0'); //no cache

    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle($filename);
    $this->excel->getActiveSheet()->setCellValue('A1', $title);
    $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
    $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
    //$this->excel->getActiveSheet()->mergeCells('A1:' . $cell . '1');
    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Kode Entry');
    $this->excel->getActiveSheet()->setCellValue('B2', 'Nama Majikan');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Nama Majikan English');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Nama Perusahaan');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Nama Perusahaan English');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Nama Agensi');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Nama Agensi English');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Alamat Bekerja English');
    $this->excel->getActiveSheet()->setCellValue('I2', 'Alamat Bekerja English');
    $this->excel->getActiveSheet()->setCellValue('J2', 'No Telpon Majikan');
    $this->excel->getActiveSheet()->setCellValue('K2', 'Nama Pekerja');
    $this->excel->getActiveSheet()->setCellValue('L2', 'Alamat Indonesia');
    $this->excel->getActiveSheet()->setCellValue('M2', 'No Paspor');
    $this->excel->getActiveSheet()->setCellValue('N2', 'Tanggal diterbitkan Paspor');
    $this->excel->getActiveSheet()->setCellValue('O2', 'Tempat diterbitkan Paspor');
    $this->excel->getActiveSheet()->setCellValue('P2', 'No Telpon Indonesia');
    $this->excel->getActiveSheet()->setCellValue('Q2', 'No Telpon Taiwan');
    $this->excel->getActiveSheet()->setCellValue('R2', 'Tanggal Lahir');
    $this->excel->getActiveSheet()->setCellValue('S2', 'Tempat Lahir');
    $this->excel->getActiveSheet()->setCellValue('T2', 'Jenis Kelamin');
    $this->excel->getActiveSheet()->setCellValue('U2', 'Status Perkawinan');
    $this->excel->getActiveSheet()->setCellValue('V2', 'Jumlah Tanggungan Anak');
    $this->excel->getActiveSheet()->setCellValue('W2', 'Nama Ahli Waris');
    $this->excel->getActiveSheet()->setCellValue('X2', 'Alamat Ahli Waris');
    $this->excel->getActiveSheet()->setCellValue('Y2', 'Telepon AHli Waris');
    $this->excel->getActiveSheet()->setCellValue('Z2', 'Hubungan');
    $this->excel->getActiveSheet()->setCellValue('AA2', 'Gaji');
    $i = 3;
    $entry = $this->Dex_model->getAllEntry()->result();
    foreach ($entry as $key => $value) {
      if($value->status=="Terima"){
        $this->excel->getActiveSheet()
            ->getStyle('A'.$i.':AA'.$i)
            ->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB("FF00FF00");
      }
      else if($value->status=="Tolak"){
        $this->excel->getActiveSheet()
            ->getStyle('A'.$i.':AA'.$i)
            ->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB("FFFF0000");
      }
      $this->excel->getActiveSheet()->setCellValue('A'.$i, $value->kode_entry);
      $this->excel->getActiveSheet()->setCellValue('B'.$i, $value->nama_majikan);
      $this->excel->getActiveSheet()->setCellValue('C'.$i, $value->nama_majikan_eng);
      $this->excel->getActiveSheet()->setCellValue('D'.$i, $value->nama_perusahaan);
      $this->excel->getActiveSheet()->setCellValue('E'.$i, $value->nama_perusahaan_eng);
      $this->excel->getActiveSheet()->setCellValue('F'.$i, $value->nama_agensi);
      $this->excel->getActiveSheet()->setCellValue('G'.$i, $value->nama_agensi_eng);
      $this->excel->getActiveSheet()->setCellValue('H'.$i, $value->alamat_bekerja_eng);
      $this->excel->getActiveSheet()->setCellValue('I'.$i, $value->alamat_bekerja_eng);
      $this->excel->getActiveSheet()->setCellValue('J'.$i, $value->telp_majikan);
      $this->excel->getActiveSheet()->setCellValue('K'.$i, $value->nama_pekerja);
      $this->excel->getActiveSheet()->setCellValue('L'.$i, $value->alamat_indonesia);
      $this->excel->getActiveSheet()->setCellValue('M'.$i, $value->no_paspor);
      $this->excel->getActiveSheet()->setCellValue('N'.$i, date_view($value->tgl_paspor));
      $this->excel->getActiveSheet()->setCellValue('O'.$i, $value->tempat_paspor);
      $this->excel->getActiveSheet()->setCellValue('P'.$i, $value->telp_indonesia);
      $this->excel->getActiveSheet()->setCellValue('Q'.$i, $value->telp_taiwan);
      $this->excel->getActiveSheet()->setCellValue('R'.$i, date_view($value->tgl_lahir));
      $this->excel->getActiveSheet()->setCellValue('S'.$i, $value->tempat_lahir);
      $this->excel->getActiveSheet()->setCellValue('T'.$i, $value->jenis_kelamin);
      $this->excel->getActiveSheet()->setCellValue('U'.$i, $value->status_perkawinan);
      $this->excel->getActiveSheet()->setCellValue('V'.$i, $value->jumlah_tanggungan_anak);
      $this->excel->getActiveSheet()->setCellValue('W'.$i, $value->nama_ahli_waris);
      $this->excel->getActiveSheet()->setCellValue('X'.$i, $value->alamat_ahli_waris);
      $this->excel->getActiveSheet()->setCellValue('Y'.$i, $value->telp_ahli_waris);
      $this->excel->getActiveSheet()->setCellValue('Z'.$i, $value->hubungan);
      $this->excel->getActiveSheet()->setCellValue('AA'.$i, $value->gaji);
      $i++;
    }
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
    $objWriter->save('php://output');
  }
  public function report_kuitansi()
  {
    $filename = "Daftar Kuitansi";
    $title = "Daftar Kuitansi";
    $file = $filename . '.xls'; //save our workbook as this file name
    
    
    header('Content-Type: application/vnd.ms-excel'); //mime type
    header('Content-Disposition: attachment;filename="'.$file.'"'); //tell browser what's the file name
    header('Cache-Control: max-age=0'); //no cache

    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle($filename);
    $this->excel->getActiveSheet()->setCellValue('A1', $title);
    $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
    $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
    //$this->excel->getActiveSheet()->mergeCells('A1:' . $cell . '1');
    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $this->excel->getActiveSheet()->setCellValue('A2', 'Kode Entry');
    $this->excel->getActiveSheet()->setCellValue('B2', 'No Kuitansi');
    $this->excel->getActiveSheet()->setCellValue('C2', 'Jumlah');
    $this->excel->getActiveSheet()->setCellValue('D2', 'Pemohon');
    $this->excel->getActiveSheet()->setCellValue('E2', 'Tanggal Masuk');
    $this->excel->getActiveSheet()->setCellValue('F2', 'Tanggal Kuitansi');
    $this->excel->getActiveSheet()->setCellValue('G2', 'Tipe Kuitansi');
    $this->excel->getActiveSheet()->setCellValue('H2', 'Tanggal Endorsement');
    $i = 3;
    $entry = $this->Dex_model->getAllKuitansi()->result();
    foreach ($entry as $key => $value) {

      $this->excel->getActiveSheet()->setCellValue('A'.$i, $value->kode_entry);
      $this->excel->getActiveSheet()->setCellValue('B'.$i, $value->no_kuitansi);
      $this->excel->getActiveSheet()->setCellValue('C'.$i, $value->jumlah);
      $this->excel->getActiveSheet()->setCellValue('D'.$i, $value->pemohon);
      $this->excel->getActiveSheet()->setCellValue('E'.$i, date_view($value->tgl_masuk));
      $this->excel->getActiveSheet()->setCellValue('F'.$i, date_view($value->tgl_kuitansi));
      $this->excel->getActiveSheet()->setCellValue('G'.$i, $value->tipe_kuitansi);
      $this->excel->getActiveSheet()->setCellValue('H'.$i, date_view($value->tgl_endorsement));

      $i++;
    }
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
    $objWriter->save('php://output');
  }
}
