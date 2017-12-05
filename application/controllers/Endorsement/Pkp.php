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
      $this->data['month'] = date('m');

      /// list tahun
      $this->data['tahunpenempatan'] = $this->Endorsement_model->get_all_year();

      $this->data['title'] = 'DASHBOARD';
      $this->data['subtitle'] = 'ENDORSEMENT';
      $this->load->view('templates/headerendorsement', $this->data);
      $this->load->view('Endorsement/CreatePKP_view', $this->data);
      $this->load->view('templates/footerendorsement');
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
            $config['allowed_types'] = '*';
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

    public function verify()
    {
      $this->data['title'] = 'Endorsement';
      $this->data['subtitle'] = 'Verifikasi & Legalisasi PKP';
      $this->data['subtitle2'] = 'Verifikasi & Legalisasi PKP';
      $this->load->view('templates/headerendorsement', $this->data);
      $this->load->view('Endorsement/VerifyPKP_view', $this->data);
      $this->load->view('templates/footerendorsement');
    }
  }
