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
      $this->load_sidebar();
      $this->data['listdp'] = $this->listdp;
      $this->data['usedpg'] = $this->usedpg;
      $this->data['usedmpg'] = $this->usedmpg;
      $this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
      $this->data['namakantor'] = $this->namakantor->nama;
      $this->data['sidebar'] = 'SAdmin/Sidebar';
    }

    public function index()
    {
      if ($this->session->userdata('role') == 4 || $this->session->userdata('role') == 6 || $this->session->userdata('role') == 7){

        if($this->session->userdata('role') == 4){
          $this->data['dataagensi'] = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
        }

        $this->data['listagensi'] = $this->Agency_model->get_agency_from_institution($this->session->userdata('institution'), false, true);
        $this->data['listpptkis'] = $this->Pptkis_model->get_all_pptkis();

        $this->data['title'] = 'Lihat Data PKP';
        $this->data['subtitle'] = 'Lihat Data PKP';
        $this->data['subtitle2'] = 'Lihat Data PKP';
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
        //$this->form_validation->set_rules('dokumenpkp', 'DokumenPKP', 'required|trim');

        if ($this->form_validation->run() === FALSE)
        {
          if($this->session->userdata('role') == 4){
            $this->data['dataagensi'] = $this->Agency_model->get_agency_info_by_user($this->session->userdata('user'));
          }

          $this->data['listagensi'] = $this->Agency_model->get_agency_from_institution($this->session->userdata('institution'), false, true);
          $this->data['listpptkis'] = $this->Pptkis_model->get_all_pptkis();
          $this->data['listjenispekerjaan'] = $this->Jobtype_model->list_all_jobtype_by_institution($this->session->userdata('institution'));
          $this->data['title'] = 'Pengajuan PKP';
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
            $config['upload_path'] = './uploads/dokumenpkp/';
            $config['allowed_types'] = 'pdf';
            $config['remove_spaces'] = TRUE;
            $config['file_name'] = "Dokumen_PKP_$returnPKP[1]";

            $this->load->library('upload', $config);

            if ( !$this->upload->do_upload('dokumenpkp'))
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
          redirect('PKP/addPkp');
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

          $this->data['title'] = 'Upload Dokumen Final PKP';
          $this->data['subtitle'] = 'Upload Dokumen Final PKP';
          $this->data['subtitle2'] = 'Upload Dokumen Final PKP';
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
      $this->data['title'] = 'Endorsement';
      $this->data['currency'] = $currencyname->currencyname;
      $this->data['subtitle'] = 'Verifikasi & Legalisasi PKP';
      $this->data['subtitle2'] = 'Verifikasi & Legalisasi PKP';
      $this->load->view('templates/headerendorsement', $this->data);
      $this->load->view('Endorsement/VerifyPKP_view', $this->data);
      $this->load->view('templates/footerendorsement');
    }

    public function getDataFromBarcode()
    {
      $bc = $this->input->post('barcode', TRUE);
      $result = $this->PKP_model->get_pkp_from_barcode($bc);

      echo json_encode($result);
    }

    public function verifyBarcode()
    {
      $bc = $this->input->post('barcode', TRUE);
      $result = $this->PKP_model->verify_barcode($bc);

      echo json_encode($result);
    }

    public function catatKuitansi()
    {
      if ($this->input->post('catatkuitansi', TRUE))
      {
        echo 'masuk';
      }
      else {
        echo 'no';
      }
    }
  }
