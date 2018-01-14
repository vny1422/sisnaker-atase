  <?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class PKP extends MY_Controller {

    private $data;

  public function __construct()
    {

      parent::__construct();
      $this->load->model('Perlindungan/Agency_model');
      $this->load->model('Perlindungan/Pptkis_model');
      $this->load->model('SAdmin/Jobtype_model');
      $this->load->model('SAdmin/Institution_model');
      $this->load->model('SAdmin/Currency_model');
      $this->load->model('Endorsement/PKP_model');
      $this->load->model('Endorsement/Kuitansi_model');
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
          $this->data['datapptkis'] = $this->Pptkis_model->get_pptkis_by_agensi_in_pkp($this->data['dataagensi']->agid);
        }

        if ($this->session->flashdata('data') != '')
        {
          $this->data = $this->session->flashdata('data');
        }

        $this->data['listagensi'] = $this->Agency_model->get_agency_from_institution($this->session->userdata('institution'), false, true);
        $this->data['listpptkis'] = $this->Pptkis_model->get_all_pptkis();
        $this->data['title'] = 'View PKP (Rec. Agreement) ';
        $this->data['subtitle'] = 'View Data PKP (Rec. Agreement)';
        $this->data['subtitle2'] = 'View Data PKP (Rec. Agreement)';
        $this->load->view('templates/headerendorsement', $this->data);
        $this->load->view('Endorsement/LihatPKP_view', $this->data);
        $this->load->view('templates/footerendorsement');
      }
      else {
        show_error("Access is forbidden.",403,"403 Forbidden");
      }
    }

    public function addPkp()
    {
      if ($this->session->userdata('role') == 4 || $this->session->userdata('role') == 6 || $this->session->userdata('role') == 7)
      {
        $this->form_validation->set_rules('agensi', 'Agensi', 'required|trim');
        $this->form_validation->set_rules('pptkis', 'PPTKIS', 'required|trim');
        $this->form_validation->set_rules('start', 'Tanggal Mulai', 'required|trim');
        $this->form_validation->set_rules('end', 'Tanggal Selesai', 'required|trim');
        $this->form_validation->set_rules('jenispekerjaan[]', 'Jenis Pekerjaan', 'required|trim');
        $this->form_validation->set_rules('laki[]', 'Jumlah Kuota Laki-laki', 'required|trim');
        $this->form_validation->set_rules('perempuan[]', 'Jumlah Kuota Perempuan', 'required|trim');
        $this->form_validation->set_rules('campuran[]', 'Jumlah Kuota Campuran', 'required|trim');

        if ($this->form_validation->run() === FALSE)
        {
          if($this->session->userdata('role') == 4){
            $this->data['dataagensi'] = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
          }

          $this->data['listagensi'] = $this->Agency_model->get_agency_from_institution($this->session->userdata('institution'), false, true);
          $this->data['listpptkis'] = $this->Pptkis_model->get_all_pptkis();
          $this->data['listjenispekerjaan'] = $this->Jobtype_model->list_all_jobtype_by_institution($this->session->userdata('institution'));
          $this->data['title'] = 'Create PKP (Rec. Agreement)';
         // $this->load->view('templates/header', $this->data);
          $this->load->view('templates/headerendorsement', $this->data);
          $this->load->view('Endorsement/CreatePKP_view', $this->data);
          //$this->load->view('templates/footer');
          $this->load->view('templates/footerendorsement');
        }
        else
        {
          $returnPKP = $this->PKP_model->post_new_pkp();
          if ($returnPKP[0]) {
            $this->session->set_flashdata('information', 'Data berhasil dimasukkan');
          }
          else {
            $this->session->set_flashdata('information', 'Data gagal dimasukkan');
          }
          redirect('PKP/addPkp');
        }
      }
      else {
        show_error("Access is forbidden.",403,"403 Forbidden");
      }

    }

    public function pkpnew()
    {
      if ($this->session->userdata('role') == 6 || $this->session->userdata('role') == 7)
      {
        $this->form_validation->set_rules('agensi', 'Agensi', 'required|trim');
        $this->form_validation->set_rules('pptkis', 'PPTKIS', 'required|trim');
        $this->form_validation->set_rules('start', 'Tanggal Mulai', 'required|trim');
        $this->form_validation->set_rules('end', 'Tanggal Selesai', 'required|trim');
        $this->form_validation->set_rules('jenispekerjaan[]', 'Jenis Pekerjaan', 'required|trim');
        $this->form_validation->set_rules('laki[]', 'Jumlah Kuota Laki-laki', 'required|trim');
        $this->form_validation->set_rules('perempuan[]', 'Jumlah Kuota Perempuan', 'required|trim');
        $this->form_validation->set_rules('campuran[]', 'Jumlah Kuota Campuran', 'required|trim');

        if ($this->form_validation->run() === FALSE)
        {
          $this->data['listagensi'] = $this->Agency_model->get_agency_from_institution($this->session->userdata('institution'), false, true);
          $this->data['listpptkis'] = $this->Pptkis_model->get_all_pptkis();
          $this->data['listjenispekerjaan'] = $this->Jobtype_model->list_all_jobtype_by_institution($this->session->userdata('institution'));
          $this->data['title'] = 'Create PKP (Rec. Agreement)';
         // $this->load->view('templates/header', $this->data);
          $this->load->view('templates/headerendorsement', $this->data);
          $this->load->view('Endorsement/CreatePKPalt_view', $this->data);
          //$this->load->view('templates/footer');
          $this->load->view('templates/footerendorsement');
        }
        else
        {
          $returnPKP = $this->PKP_model->post_new_pkp_alt();
          if ($returnPKP[0]) {
            $this->session->set_flashdata('information', 'Data berhasil dimasukkan');
          }
          else {
            $this->session->set_flashdata('information', 'Data gagal dimasukkan');
          }
          redirect('PKP/pkpnew');
        }
      }
      else {
        show_error("Access is forbidden.",403,"403 Forbidden");
      }

    }

    public function uploadDokFin($pkpkode)
    {
      if ($this->session->userdata('role') == 6 || $this->session->userdata('role') == 7)
      {
        //$this->form_validation->set_rules('dokumenfinalpkp', 'Dokumen Final PKP', 'required');
         // if (empty($_FILES['dokumenfinalpkp']['name']))
         // {
         //     $this->form_validation->set_rules('dokumenfinalpkp', 'Document', 'required');
         // }

        if (empty($_FILES['dokumenfinalpkp']['name']))
        {
          $this->form_validation->set_rules('dokumenfinalpkp', 'Document', 'required');
          $this->form_validation->run();

          echo "masukkk awal";
          $this->data['values'] = $pkpkode;

          $this->data['title'] = 'Upload Dokumen Final PKP (Rec. Agreement)';
          $this->data['subtitle'] = 'Upload Dokumen Final PKP (Rec. Agreement)';
          $this->data['subtitle2'] = 'Upload Dokumen Final PKP (Rec. Agreement)';
          $this->load->view('templates/headerendorsement', $this->data);
          $this->load->view('Endorsement/UploadDokumenPKP_view', $this->data);
          $this->load->view('templates/footerendorsement');
        }
        else
        {
          echo "Masuk upload";
          $returnUploadPKP = $this->PKP_model->upload_dokumen_final_pkp($pkpkode);
          if ($returnUploadPKP) {
            //echo "masuk if";
            $config['upload_path'] = './uploads/dokumenfinalpkp/';
            $config['allowed_types'] = '*';
            $config['remove_spaces'] = TRUE;
            $config['file_name'] = "Dokumen_Final_PKP_$pkpkode";

            $this->load->library('upload', $config);

            if ( !$this->upload->do_upload('dokumenfinalpkp'))
            {
              $this->data['error'] = $this->upload->display_errors('','');
            } else {
              $this->data['error'] = "";
              //$this->session->set_flashdata('information', 'Upload berhasil dilakukan');
            }
            $this->session->set_flashdata('information', 'Data berhasil dimasukkan');
          }
          else {
            $this->session->set_flashdata('information', 'Data gagal dimasukkan');
          }
          redirect('PKP/');
        }

      }
      else {
        show_error("Access is forbidden.",403,"403 Forbidden");
      }
    }

    public function downloadDokFin($param)
    {
      //if ($this->session->userdata('role') == 6 || $this->session->userdata('role') == 7)
      //{
          $data['pkp'] = $this->PKP_model->get_pkp_for_report($param);
          ini_set('memory_limit', '64M');
          $nama_dokumen = "PKP_Report";
          $html = $this->load->view('Endorsement/DownloadPKP_view', $data, true); //render the view into HTML
          $this->load->library('Pdfm');
          $pdf=$this->Pdfm->load();
          $pdf->WriteHTML($html); //write the HTML into PDF
          $pdf->Output($nama_dokumen.".pdf" ,'I');
      //}
      //else {
        //show_error("Access is forbidden.",403,"403 Forbidden");
      //}
    }

    public function getDataPKP()
    {
      $agid = $this->input->post('agid', TRUE);
      $ppkode = $this->input->post('ppkode', TRUE);

      $res = $this->PKP_model->get_data_pkp_by_agensi_and_pptkis($agid, $ppkode);
      //$res = $this->PKP_model->get_data_pkp_by_agensi_and_pptkis(26926, 'ABD022');
    //var_dump($res);
      echo json_encode($res);
    }

    public function verify()
    {
      $currencyid = $this->Institution_model->get_institution($this->session->userdata('institution'))->idcurrency;
      $currencyname = $this->Currency_model->get_currency_name($currencyid);
      $this->data['listpkp'] = $this->PKP_model->get_pkp_verify_list();
      $this->data['title'] = 'Verification PKP (Rec. Agreement)';
      $this->data['currency'] = $currencyname->currencyname;
      $this->data['subtitle'] = 'Verification PKP (Rec. Agreement)';
      $this->data['subtitle2'] = 'Verification PKP (Rec. Agreement)';
      $this->load->view('templates/headerendorsement', $this->data);
      $this->load->view('Endorsement/VerifyPKP_view', $this->data);
      $this->load->view('templates/footerendorsement');
    }

    public function rejectPkp()
    {
      $idpkp = $this->input->post('hiddenidpkp', true);
      if ($this->PKP_model->toggle_pkp($idpkp, TRUE))
      {
          $this->session->set_flashdata('information', 'PKP berhasil ditolak!');
          redirect('Pkp/verify');
      }
      else {
          $this->session->set_flashdata('information', 'PKP gagal ditolak!');
          redirect('Pkp/verify');
      }
    }

    public function verifyPkp($idpkp)
    {
      if ($this->PKP_model->toggle_pkp($idpkp))
      {
          $this->session->set_flashdata('information', 'PKP berhasil diverifikasi!');
          redirect('Pkp/verify');
      }
      else {
          $this->session->set_flashdata('information', 'PKP gagal diverifikasi!');
          redirect('Pkp/verify');
      }
    }

    public function legalize()
    {
      $currencyid = $this->Institution_model->get_institution($this->session->userdata('institution'))->idcurrency;
      $currencyname = $this->Currency_model->get_currency_name($currencyid);
      $this->data['title'] = 'Endorse PKP (Rec. Agreement)';
      $this->data['currency'] = $currencyname->currencyname;
      $this->data['subtitle'] = 'Endorse PKP (Rec. Agreement)';
      $this->data['subtitle2'] = 'Endorse PKP (Rec. Agreement)';
      $this->load->view('templates/headerendorsement', $this->data);
      $this->load->view('Endorsement/LegalizePKP_view', $this->data);
      $this->load->view('templates/footerendorsement');
    }

    public function getDataFromBarcode()
    {
      $bc = $this->input->post('barcode', TRUE);
      $result = $this->PKP_model->get_pkp_from_barcode($bc);

      echo json_encode($result);
    }

    public function getPPTKISByAgensi()
    {
      $agid = $this->input->post('agid', TRUE);
      $result = $this->Pptkis_model->get_pptkis_by_agensi_in_pkp($agid);

      echo json_encode($result);
    }




    public function legalizeBarcode()
    {
      $bc = $this->input->post('barcode', TRUE);
      $result = $this->PKP_model->legalize_barcode($bc);

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
          redirect('PKP/legalize');
        }
        else {
          if (!($this->input->post('kuitansiag', true)))
          {
            redirect('Pkp');
          }
          $barcodeku = $this->generateBarcode();
          $username = $this->session->userdata('user');
          $institusi = $this->session->userdata('institution');
          $this->Kuitansi_model->catat_kuitansi($username, $institusi, $barcodeku, 1);
          $this->session->set_flashdata('print', 'Segera Upload Dokumen Final PKP');
          $this->data['bc'] = $barcodeku;
          $this->data['kuitansiag'] = $this->input->post('kuitansiag', true);
          $this->data['kuitansipp'] = $this->input->post('kuitansipp', true);
          $this->session->set_flashdata('data', $this->data);
          redirect('Pkp');
        }
      }
      else {
        if (!($this->input->post('kuitansiag', true)))
        {
          redirect('Pkp');
        }
        $barcodeku = $this->generateBarcode();
        $this->session->set_flashdata('print', 'Segera Upload Dokumen Final PKP ');
        $this->data['bc'] = $barcodeku;
        $this->data['kuitansiag'] = $this->input->post('kuitansiag', true);
        $this->data['kuitansipp'] = $this->input->post('kuitansipp', true);
        $this->session->set_flashdata('data', $this->data);
        redirect('Pkp');
      }
    }

    // AJAX AUTOCOMPLETE
    public function ambilpkp(){
      $keyword = $this->input->post('term',TRUE);
      $idagency = $this->input->post('agency',TRUE);
      $kodepptkis = $this->input->post('pptkis',TRUE);
      $query = $this->PKP_model->ambilpkp($keyword, $idagency, $kodepptkis);
      $json_array = array();
      $r = new stdClass;
      $i=0;
      foreach ($query as $row)
        $r->rows[$i++]=$row;
      echo json_encode($r);
    }

    //ajax

    public function editPKP(){
      echo json_encode($this->PKP_model->editDate_from_bc($this->input->post('pkpbc', true)));
    }

    public function editPKPd(){
      echo json_encode($this->PKP_model->editPKPd($this->input->post('id', true)));
    }

  }
