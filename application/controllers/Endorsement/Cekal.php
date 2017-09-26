<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cekal extends MY_Controller {

  private $data;

  public function __construct()
  {

    parent::__construct();
    $this->load->model('Perlindungan/Agency_model');
    $this->load->model('Perlindungan/Pptkis_model');
    $this->load_sidebar();
    $this->data['listdp'] = $this->listdp;
    $this->data['usedpg'] = $this->usedpg;
    $this->data['usedmpg'] = $this->usedmpg;
    $this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
    $this->data['namakantor'] = $this->namakantor->nama;
    $this->data['sidebar'] = 'SAdmin/Sidebar';

    if ($this->session->userdata('role') != 1 && $this->session->userdata('role') != 2 && $this->session->userdata('role') != 6 && $this->session->userdata('role') != 7)
    {
      show_error("Access is forbidden.",403,"403 Forbidden");
    }
  }

  public function index()
  {

  }

  public function agensi()
  {
    $this->form_validation->set_rules('agensi', 'Agensi', 'required|trim');
    if ($this->form_validation->run() === FALSE)
    {
      $this->data['list'] = $this->Agency_model->get_all_agency();
      $this->data['listcekal'] = $this->Agency_model->get_agency(true);
      $this->data['title'] = 'Cekal Agensi';
      $this->data['subtitle'] = 'Cekal Agensi';
      $this->data['subtitle2'] = 'Tabel Cekal Agensi';
      $this->load->view('templates/headerendorsement', $this->data);
      $this->load->view('Endorsement/CekalAgensi_view', $this->data);
      $this->load->view('templates/footerendorsement');
    }
    else {
      if($this->input->post('active',TRUE))
      {
        if ($this->getTime($this->input->post('start',TRUE)) < $this->getTime($this->input->post('end',TRUE))) {
          $idinstitusi = $this->Agency_model->get_agency_edit($this->input->post('agensi',TRUE))->idinstitution;
          $this->Agency_model->post_new_cekal($idinstitusi);
          $this->session->set_flashdata('information', 'Data berhasil dimasukkan');
          $this->data['list'] = $this->Agency_model->get_all_agency();
          $this->data['listcekal'] = $this->Agency_model->get_agency(true);
          $this->data['title'] = 'Cekal Agensi';
          $this->data['subtitle'] = 'Cekal Agensi';
          $this->data['subtitle2'] = 'Tabel Cekal Agensi';
          $this->load->view('templates/headerendorsement', $this->data);
          $this->load->view('Endorsement/CekalAgensi_view', $this->data);
          $this->load->view('templates/footerendorsement');
        }
        else {
          $this->session->set_flashdata('information', 'Pastikan tanggal berakhir sesudah tanggal mulai!');
          $this->data['list'] = $this->Agency_model->get_all_agency();
          $this->data['listcekal'] = $this->Agency_model->get_agency(true);
          $this->data['title'] = 'Cekal Agensi';
          $this->data['subtitle'] = 'Cekal Agensi';
          $this->data['subtitle2'] = 'Tabel Cekal Agensi';
          $this->load->view('templates/headerendorsement', $this->data);
          $this->load->view('Endorsement/CekalAgensi_view', $this->data);
          $this->load->view('templates/footerendorsement');
        }
      }
      else {
        $idinstitusi = $this->Agency_model->get_agency_edit($this->input->post('agensi',TRUE))->idinstitution;
        $this->Agency_model->post_new_cekal($idinstitusi);
        $this->session->set_flashdata('information', 'Data berhasil dimasukkan');
        $this->data['list'] = $this->Agency_model->get_all_agency();
        $this->data['listcekal'] = $this->Agency_model->get_agency(true);
        $this->data['title'] = 'Cekal Agensi';
        $this->data['subtitle'] = 'Cekal Agensi';
        $this->data['subtitle2'] = 'Tabel Cekal Agensi';
        $this->load->view('templates/headerendorsement', $this->data);
        $this->load->view('Endorsement/CekalAgensi_view', $this->data);
        $this->load->view('templates/footerendorsement');
      }
    }
  }

  public function deleteAgensi($id)
  {
      $this->Agency_model->delete_cekal($id);
      redirect('Cekal/agensi');
  }

  public function pptkis()
  {
    $this->form_validation->set_rules('pptkis', 'PPTKIS', 'required|trim');
    if ($this->form_validation->run() === FALSE)
    {
      $this->data['list'] = $this->Pptkis_model->get_all_pptkis();
      $this->data['listcekal'] = $this->Pptkis_model->get_pptkis(true);
      $this->data['title'] = 'Cekal PPTKIS';
      $this->data['subtitle'] = 'Cekal PPTKIS';
      $this->data['subtitle2'] = 'Tabel Cekal PPTKIS';
      $this->load->view('templates/headerendorsement', $this->data);
      $this->load->view('Endorsement/CekalPPTKIS_view', $this->data);
      $this->load->view('templates/footerendorsement');
    }
    else {
      if($this->input->post('active',TRUE))
      {
        if ($this->getTime($this->input->post('start',TRUE)) < $this->getTime($this->input->post('end',TRUE))) {
          $this->Pptkis_model->post_new_cekal();
          $this->session->set_flashdata('information', 'Data berhasil dimasukkan');
          $this->data['list'] = $this->Pptkis_model->get_all_pptkis();
          $this->data['listcekal'] = $this->Pptkis_model->get_pptkis(true);
          $this->data['title'] = 'Cekal PPTKIS';
          $this->data['subtitle'] = 'Cekal PPTKIS';
          $this->data['subtitle2'] = 'Tabel Cekal PPTKIS';
          $this->load->view('templates/headerendorsement', $this->data);
          $this->load->view('Endorsement/CekalPPTKIS_view', $this->data);
          $this->load->view('templates/footerendorsement');
        }
        else {
          $this->session->set_flashdata('information', 'Pastikan tanggal berakhir sesudah tanggal mulai!');
          $this->data['list'] = $this->Pptkis_model->get_all_pptkis();
          $this->data['listcekal'] = $this->Pptkis_model->get_pptkis(true);
          $this->data['title'] = 'Cekal PPTKIS';
          $this->data['subtitle'] = 'Cekal PPTKIS';
          $this->data['subtitle2'] = 'Tabel Cekal PPTKIS';
          $this->load->view('templates/headerendorsement', $this->data);
          $this->load->view('Endorsement/CekalPPTKIS_view', $this->data);
          $this->load->view('templates/footerendorsement');
        }
     }
     else {
       $this->Pptkis_model->post_new_cekal();
       $this->session->set_flashdata('information', 'Data berhasil dimasukkan');
       $this->data['list'] = $this->Pptkis_model->get_all_pptkis();
       $this->data['listcekal'] = $this->Pptkis_model->get_pptkis(true);
       $this->data['title'] = 'Cekal PPTKIS';
       $this->data['subtitle'] = 'Cekal PPTKIS';
       $this->data['subtitle2'] = 'Tabel Cekal PPTKIS';
       $this->load->view('templates/headerendorsement', $this->data);
       $this->load->view('Endorsement/CekalPPTKIS_view', $this->data);
       $this->load->view('templates/footerendorsement');
     }
   }
 }

  public function deletePPTKIS($id)
  {
           $this->Pptkis_model->delete_cekal($id);
           redirect('Cekal/pptkis');
  }



  public function editcklag($id)
  {
    $this->form_validation->set_rules('agensi', 'Agensi', 'required|trim');
    if ($this->form_validation->run() === FALSE)
    {
      $this->data['values'] =  $this->Agency_model->get_agency_cekal($id);
      $this->data['agency'] = $this->Agency_model->get_all_agency();
      $this->data['title'] = 'Cekal Agensi';
      $this->data['subtitle'] = 'Edit Cekal Agensi';
      $this->load->view('templates/headerendorsement', $this->data);
      $this->load->view('Endorsement/EditCekalAgensi_view', $this->data);
      $this->load->view('templates/footerendorsement');
    }
    else {
      $idinstitusi = $this->Agency_model->get_agency_edit($this->input->post('agensi',TRUE))->idinstitution;
      $this->Agency_model->update_cekal($id,$idinstitusi);
      redirect('Cekal/agensi');
    }

  }

    public function editcklpptkis($id)
  {
    $this->form_validation->set_rules('pptkis', 'PPTKIS', 'required|trim');
    if ($this->form_validation->run() === FALSE)
    {
      $this->data['values'] =  $this->Pptkis_model->get_pptkis_cekal($id);
      $this->data['pptkis'] = $this->Pptkis_model->get_all_pptkis();
      $this->data['title'] = 'Cekal PPTKIS';
      $this->data['subtitle'] = 'Edit Cekal PPTKIS';
      $this->load->view('templates/headerendorsement', $this->data);
      $this->load->view('Endorsement/EditCekalPPTKIS_view', $this->data);
      $this->load->view('templates/footerendorsement');
    }
    else {
      $this->Pptkis_model->update_cekal($id);
      redirect('Cekal/pptkis');    }
  }

  function getTime ($ymd) {
    return strtotime($ymd);
  }




}
