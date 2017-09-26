<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pk extends MY_Controller {

  private $data;

  public function __construct()
  {
    parent::__construct();
    $this->load_sidebar();
    $this->load->model('Endorsement/Endorsement_model');
    $this->load->model('SAdmin/Institution_model');
    $this->load->library('Barcode');
    $this->load->library('encrypt');

    $this->data['listdp'] = $this->listdp;
    $this->data['usedpg'] = $this->usedpg;
    $this->data['usedmpg'] = $this->usedmpg;
    $this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
    $this->data['namakantor'] = $this->namakantor->nama;
    $this->data['sidebar'] = 'SAdmin/Sidebar';
  }

  public function index()
  {

  }

  public function revisi()
  {
    if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2|| $this->session->userdata('role') == 6 || $this->session->userdata('role') == 7)
    {
      $this->data['title'] = 'Perjanjian Kerja';
      $this->data['subtitle'] = 'Revisi Perjanjian Kerja';
      $this->data['subtitle2'] = 'Pencatatan Kuitansi';
      $this->load->view('templates/headerendorsement', $this->data);
      $this->load->view('Endorsement/RevisiPK_view', $this->data);
      $this->load->view('templates/footerendorsement');
    }
    else
    {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }
  }

  public function uploadStamp()
  {
    if ($this->session->userdata('role') != 1)
    {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }

    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = 'jpg';
    $config['max_size']     = '100';
    $config['max_width'] = '185';
    $config['max_height'] = '78';
    $config['overwrite'] = TRUE;
    $config['remove_spaces'] = TRUE;
    $config['file_name'] = 'stamp_dev.jpg';

    $this->load->library('upload', $config);

    if ( !$this->upload->do_upload('stamp'))
    {
      $this->data['error'] = $this->upload->display_errors('','');
    } else {
      $this->data['error'] = "";
      $this->session->set_flashdata('information', 'Upload berhasil dilakukan');
    }

    $this->data['title'] = 'Upload Stamp';
    $this->load->view('templates/header', $this->data);
    $this->load->view('SAdmin/UploadStamp_view', $this->data);
    $this->load->view('templates/footer');
  }

  function getDataRevisiPK()
  {
    $code = $this->input->post('barcode', TRUE);
    $maks_penggantian_pk = 2;

    $tmp['success'] = false;
    $tmp['message'] = "Barcode atau Token tidak valid!!!";

    $query = $this->Endorsement_model->checkEntryJO_ForRevisiPK($code);

    if(!empty($query)) {
      $count = $query[0]['count'];
      $ejid = $query[0]['ejid'];

      if ($count > 0) {
        // data entry jo
        $query = $this->Endorsement_model->getEntryJO($ejid);
        $tmp = $query[0];
        $tmp['jocatatan'] = str_replace("\n", "<br/>", $query[0]['jocatatan']);
        $tmp['success'] = true;
        $tmp['message'] = "Barcode valid.";

        // data kuitansi
        $query = $this->Endorsement_model->getKuitansi($ejid);
        $i = 0;
        foreach ($query as $row):
          $tmp['kuitansi'][$i++] = $row;
        endforeach;


        // data tki pengganti
        $tkid = 0; // id tki pengganti; digunakan utk referensi loop di hitung banyak perubahan
        $tmp["tkpengganti"] = array();
        $query = $this->Endorsement_model->getTKI_FromBarcode($code);
        if(!empty($query)) {
          $tmp["tkpengganti"] = $query[0];
          $tkid = $query[0]['tkid'];
        }

          // hitung banyak perubahan revisi
        $query = $this->Endorsement_model->countRevisiTKI($ejid);
        $tks = array();
        $i = 0;
        foreach ($query as $row):
          $tks[$i] = $row;
          $tks[$i]['visited'] = 0;
          $i++;
        endforeach;

        $found = 0;
        $loop = 1;
        while ($loop) {
          $loop = 0;
          for ($i = 0; $i < count($tks); $i++) {
            if ($tks[$i]['tkrevid'] == $tkid && !$tks[$i]['visited']) {
              if (isset($tks[$i]['tktglendorsement'])) {
                $found++;
              }

              $loop = 1;
              $tks[$i]['visited'] = 1;
              $tkid = $tks[$i]['tkid'];
              break;
            }
          }
        }


        // data tki
        $tmp["tklama"] = array();
        $query = $this->Endorsement_model->getTKILama($tmp["tkpengganti"]["tkid"]);
        if(!empty($query)) {
          $tmp["tklama"] = $query[0];
        }


        if ($found > $maks_penggantian_pk) {
          $tmp = array();
          $tmp['success'] = false;
          $tmp['message'] = "Anda melebihi batas maksimal penggantian perjanjian kerja!!!";
        } else if (!isset($tmp["tklama"]["tkid"])) {
          $tmp = array();
          $tmp['success'] = false;
          $tmp['message'] = "Barcode tidak valid!!!";
        } else if (isset($tmp["tkpengganti"]["tktglendorsement"])) {
          $tmp = array();
          $tmp['success'] = false;
          $tmp['message'] = "Data TKI telah diendorse!";
        }
      }
    }
    echo json_encode($tmp);
  }

  function endorseTKI()
  {
    $code = $this->input->post('barcode', TRUE);
    $maks_penggantian_pk = 2;

    $tmp['success'] = false;
    $tmp['message'] = "Barcode tidak valid!!!";

    $query = $this->Endorsement_model->getTKI_FromBarcode($code);

    if(!empty($query)) {
      $ejid = $query[0]['ejid'];
      $tkid = $query[0]['tkid'];

      $pass = $this->Endorsement_model->getEntryJO($ejid);

      if(!empty($pass)){
        // hitung banyak perubahan revisi
        $query = $this->Endorsement_model->countRevisiTKI($ejid);
        $tks = array();
        $i = 0;
        foreach ($query as $row):
          $tks[$i] = $row;
        $tks[$i]['visited'] = 0;
        $i++;
        endforeach;

        $found = 0;
        $loop = 1;
        while ($loop) {
          $loop = 0;
          for ($i = 0; $i < count($tks); $i++) {
            if ($tks[$i]['tkrevid'] == $tkid && !$tks[$i]['visited']) {
              if (isset($tks[$i]['tktglendorsement'])) {
                $found++;
              }

              $loop = 1;
              $tks[$i]['visited'] = 1;
              $tkid = $tks[$i]['tkid'];
              break;
            }
          }
        }

        if ($found > $maks_penggantian_pk) {
          $tmp['success'] = false;
          $tmp['message'] = "Anda melebihi batas maksimal penggantian perjanjian kerja!!!";
        } else {
          $query = $this->Endorsement_model->updateEndorseTKI($code);

          $tmp['success'] = true;
          $tmp['message'] = "Updated!";
        }
      }
    }

    echo json_encode($tmp);
  }

  function printLabel()
  {
    $token = $this->input->post('token', TRUE);
    $bc = $this->input->post('barcode', TRUE);

    $count = 0;
    $query = $this->Endorsement_model->checkEJOForPrint($token,$bc);
    $count = $query[0]['count'];
    if ($count <= 0) {
      die();
    }

    $data['bc'] = $this->encrypt->encode($bc);
    $data['namainstitusi'] = $this->namainstitusi->nameinstitution;

    $this->load->view('Endorsement/print_label',$data);
  }

  function printStamp()
  {
    $imagepath=base_url('uploads/stamp_dev.jpg');
    $image=imagecreatefromjpeg($imagepath);
    header('Content-Type: image/jpeg');
    imagejpeg($image);
    imagedestroy($image);
  }

  function printBarcode($bc)
  {
    $code = $this->encrypt->decode($bc);

    $fontSize = 10;   // GD1 in px ; GD2 in point
    $marge    = 10;   // between barcode and hri in pixel
    $x        = 70;  // barcode center
    $y        = 20;  // barcode center
    $height   = 20;   // barcode height in 1D ; module size in 2D
    $width    = 1;    // barcode height in 1D ; not use in 2D
    $angle    = 0;   // rotation in degrees : nb : non horizontable barcode might not be usable because of pixelisation
    $type     = 'code128';

    $im     = imagecreatetruecolor(200, 50); // set size here
    $black  = ImageColorAllocate($im,0x00,0x00,0x00);
    $white  = ImageColorAllocate($im,0xff,0xff,0xff);
    $red    = ImageColorAllocate($im,0xff,0x00,0x00);
    $blue   = ImageColorAllocate($im,0x00,0x00,0xff);
    imagefilledrectangle($im, 0, 0, 200, 50, $white); // set size here

    $data = Barcode::gd($im, $black, $x, $y, $angle, $type, array('code'=>$code), $width, $height);

    header('Content-type: image/gif');
    imagegif($im);
    imagedestroy($im);
  }

}
