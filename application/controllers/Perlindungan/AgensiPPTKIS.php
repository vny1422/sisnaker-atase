<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AgensiPPTKIS extends MY_Controller {

	private $data;

	public function __construct()
    {
        parent::__construct();

        $this->load_sidebar();
        $this->data['listdp'] = $this->listdp;
        $this->data['usedpg'] = $this->usedpg;
        $this->data['usedmpg'] = $this->usedmpg;
        $this->data['sidebar'] = 'SAdmin/Sidebar';
        $this->load->model('SAdmin/Institution_model');
        $this->load->model('SAdmin/User_model');
        $this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
        $this->data['namakantor'] = $this->namakantor->nama;
        $this->load->model('Perlindungan/Agency_model');
        $this->load->model('Perlindungan/Pptkis_model');
    }

	public function index()
	{
		$this->data['title'] = 'Agensi';
		$this->data['subtitle'] = 'Agensi & PPTKIS';
		$this->load->view('templates/headerperlindungan', $this->data);
		$this->load->view('Perlindungan/AgensiPPTKIS_view', $this->data);
		$this->load->view('templates/footerperlindungan');
	}

	public function addAgensi()
	{
		if ($this->session->userdata('role') != 1 && $this->session->userdata('role') != 2)
		{
			show_error("Access is forbidden.",403,"403 Forbidden");
		}
		else {
			$this->form_validation->set_rules('name', 'Nama Agensi', 'required|trim');
			$this->form_validation->set_rules('institution', 'Institution', 'required');

			if ($this->form_validation->run() !== FALSE)
			{
				$this->Agency_model->post_new_agency();
				$this->session->set_flashdata('information', 'Data berhasil dimasukkan');
			}

			if($this->session->userdata('role') == '1')
			{
				$this->data['listinstitution'] = $this->Institution_model->list_active_institution();
				//$this->data['listuser'] = $this->User_model->list_all_user();
			}
			else {
				$this->data['listinstitution'] = array();
				array_push($this->data['listinstitution'],$this->Institution_model->get_institution($this->session->userdata('institution')));
				//$this->data['listuser'] = $this->User_model->list_all_user_by_institution($this->session->userdata('institution'));
			}
			$this->data['title'] = 'Tambah Agensi';
			$this->load->view('templates/header', $this->data);
			$this->load->view('SAdmin/AddAgency_view', $this->data);
			$this->load->view('templates/footer');
		}

	}

	public function deleteAgensi($id)
	{
		$this->data['values'] =  $this->Agency_model->get_agency_edit($id);

		if($this->session->userdata('role') == '1' || $this->data['values']->idinstitution == $this->session->userdata('institution'))
        {
			$this->Agency_model->delete_agency($id);
			redirect('AgensiPPTKIS');
		}
		else
        {
        	show_error("Access is forbidden.",403,"403 Forbidden");
        }
	}

	public function editAgensi($id)
	{
		if ($this->session->userdata('role') != 1 && $this->session->userdata('role') != 2)
		{
			show_error("Access is forbidden.",403,"403 Forbidden");
		}
		else {
			$this->form_validation->set_rules('name', 'Nama Agensi', 'required|trim');
			$this->form_validation->set_rules('institution', 'Institution', 'required');

			if ($this->form_validation->run() === FALSE)
			{
				$this->data['values'] =  $this->Agency_model->get_agency_edit($id);
				if($this->session->userdata('role') == '1' || $this->data['values']->idinstitution == $this->session->userdata('institution'))
				{
					if($this->session->userdata('role') == '1')
					{
						$this->data['listinstitution'] = $this->Institution_model->list_active_institution();
						$this->data['listuser'] = $this->User_model->list_all_user();
					}
					else
					{
						$this->data['listinstitution'] = array();
						array_push($this->data['listinstitution'],$this->Institution_model->get_institution($this->session->userdata('institution')));
						$this->data['listuser'] = $this->User_model->list_all_user_by_institution($this->session->userdata('institution'));
					}
					$this->data['title'] = 'Edit Agensi';
					$this->load->view('templates/header', $this->data);
					$this->load->view('SAdmin/EditAgency_view', $this->data);
					$this->load->view('templates/footer');
				}
				else
				{
					show_error("Access is forbidden.",403,"403 Forbidden");
				}
			}
			else
			{
				$this->Agency_model->update_agency($id);
				redirect('AgensiPPTKIS');
			}
		}

	}

	public function addPPTKIS()
	{
		if ($this->session->userdata('role') != 1)
		{
			show_error("Access is forbidden.",403,"403 Forbidden");
		}
		else {
			$this->form_validation->set_rules('kode', 'Kode PPTKIS', 'required|trim');

			if ($this->form_validation->run() !== FALSE)
			{
				$this->Pptkis_model->post_new_pptkis();
				$this->session->set_flashdata('information', 'Data berhasil dimasukkan');
			}
			$this->data['title'] = 'Tambah PPTKIS';
			$this->data['provinsi'] =  $this->Pptkis_model->get_all_propinsi();
			$this->load->view('templates/header', $this->data);
			$this->load->view('SAdmin/AddPPTKIS_view', $this->data);
			$this->load->view('templates/footer');
		}
	}

	public function deletePPTKIS($id)
	{
		if ($this->session->userdata('role') != 1)
		{
			show_error("Access is forbidden.",403,"403 Forbidden");
		} else {
			$this->Pptkis_model->delete_PPTKIS($id);
			redirect('AgensiPPTKIS');
		}
	}

	public function editPPTKIS($id)
	{
		if ($this->session->userdata('role') != 1)
		{
			show_error("Access is forbidden.",403,"403 Forbidden");
		}
		else {
			$this->form_validation->set_rules('kode', 'Kode PPTKIS', 'required|trim');

			if ($this->form_validation->run() === FALSE)
			{
				$this->data['title'] = 'Edit PPTKIS';
				$this->data['values'] =  $this->Pptkis_model->get_pptkis_info($id);
				$this->load->view('templates/header', $this->data);
				$this->load->view('SAdmin/EditPPTKIS_view', $this->data);
				$this->load->view('templates/footer');
			}
			else
			{
				$this->Pptkis_model->update_pptkis($id);
				redirect('AgensiPPTKIS');
			}
		}
	}

	function get_agency_list(){
		if ($this->session->userdata('role') == 1)
		{
			$tmp = $this->Agency_model->get_agency();
		}
		else
		{
			$tmp = $this->Agency_model->get_agency_from_institution($this->session->userdata('institution'));
		}

		for($i=0;$i<count($tmp);$i++){
			$tmp[$i]['index'] = $i+1;
		}

		echo(json_encode($tmp));
	}

	function get_pptkis_list(){
		$tmp = $this->Pptkis_model->get_pptkis();

		for($i=0;$i<count($tmp);$i++){
			$tmp[$i]['index'] = $i+1;
		}

		echo(json_encode($tmp));
	}

	function get_cekalagency_list(){
		if ($this->session->userdata('role') == 1)
		{
			$tmp = $this->Agency_model->get_cekalagency();
		}
		else
		{
			$tmp = $this->Agency_model->get_cekalagency($this->session->userdata('institution'));
		}

		for($i=0;$i<count($tmp);$i++){
			$tmp[$i]['index'] = $i+1;
		}

		echo(json_encode($tmp));
	}

	function get_cekalpptkis_list(){
		$tmp = $this->Pptkis_model->get_cekalpptkis();

		for($i=0;$i<count($tmp);$i++){
			$tmp[$i]['index'] = $i+1;
		}

		echo(json_encode($tmp));
	}

		function get_agency_info($id) {
	$agency_info = $this->Agency_model->get_agency_info($id);
	$pptkis_con = $this->Pptkis_model->get_pptkis_from_agency($id);
	$return = array();
	$return['agen'] = array();
	$return['list'] = array();

	/// rephrasing array
	$return['agen']['Nama agensi'] = $agency_info['agnama']." ".$agency_info['agnamaoth'];
	$return['agen']['Alamat'] = $agency_info['agalmtkantor']." ".$agency_info['agalmtkantoroth'];
	$return['agen']['Penanggung Jawab'] = $agency_info['agpngjwb']." ".$agency_info['agpngjwboth'];
	$return['agen']['Telp. / Fax'] = $agency_info['agtelp']." / ".$agency_info['agfax'];
	$return['agen']['No Ijin CLA'] = $agency_info['agnoijincla'];

	// / rephrasing list
	for($i=0;$i<count($pptkis_con);$i++){
		$tmp = array();
		$tmp['pptkis'] = $pptkis_con[$i]['ppnama'];
		$tmp['pekerjaan'] = $pptkis_con[$i]['namajenispekerjaan'];
		$tmp['awal'] = $pptkis_con[$i]['jobtglawal'];
		$tmp['akhir'] = $pptkis_con[$i]['jobtglakhir'];
		array_push($return['list'],$tmp);
	}

	echo json_encode($return);
	}


	// function get_agency_info($id) {
	// 	$agency_info = $this->Agency_model->get_agency_info($id);
	// 	// $pptkis_con = $this->Agency_model->get_pptkis_from_agency($id);
	// 	$return = array();
	// 	$return['agen'] = array();
	// 	$return['list'] = array();
	//
	// 	/// rephrasing array
	// 	$return['agen']['Nama agensi'] = $agency_info['agnama']." ".$agency_info['agnamaoth'];
	// 	$return['agen']['Alamat'] = $agency_info['agalmtkantor']." ".$agency_info['agalmtkantoroth'];
	// 	$return['agen']['Penanggung Jawab'] = $agency_info['agpngjwb']." ".$agency_info['agpngjwboth'];
	// 	$return['agen']['Telp. / Fax'] = $agency_info['agtelp']." / ".$agency_info['agfax'];
	// 	$return['agen']['No Ijin CLA'] = $agency_info['agnoijincla'];
	//
	// 	/// rephrasing list
	// 	// for($i=0;$i<count($pptkis_con);$i++){
	// 	// 	$tmp = array();
	// 	// 	$tmp['pptkis'] = $pptkis_con[$i]['ppnama'];
	// 	// 	$tmp['pekerjaan'] = $pptkis_con[$i]['jpnama'];
	// 	// 	$tmp['awal'] = $pptkis_con[$i]['jobtglawal'];
	// 	// 	$tmp['akhir'] = $pptkis_con[$i]['jobtglakhir'];
	// 	// 	array_push($return['list'],$tmp);
	// 	// }
	//
	// 	echo json_encode($return);
	// }




	function get_pptkis_info($id) {
		$pptkis 	= $this->Pptkis_model->get_pptkis_info($id);
		$agencylist = $this->Agency_model->get_agency_from_pptkis($id);

		$return = array();
		$return['pt'] = array();
		$return['list'] = array();

		$return['pt']['Nama PPTKIS'] = $pptkis['ppnama'];
		$return['pt']['Penanggung Jawab'] = $pptkis['pppngjwb'];
		$return['pt']['Alamat'] = $pptkis['ppalmtkantor'];
		$return['pt']['Telp. / Fax'] = $pptkis['pptelp']." / ".$pptkis['ppfax'];


	// rephrasing list
	for($i=0;$i<count($agencylist);$i++){
		$tmp = array();
		$tmp['agen'] = $agencylist[$i]['agnama'];
		$tmp['pekerjaan'] = $agencylist[$i]['namajenispekerjaan'];
		$tmp['awal'] = $agencylist[$i]['jobtglawal'];
		$tmp['akhir'] = $agencylist[$i]['jobtglakhir'];
		array_push($return['list'],$tmp);
	}

		echo json_encode($return);
	}

	// AJAX AUTOCOMPLETE
	public function get_user_agensi(){
		$keyword = $this->input->post('term',TRUE);
		$query = $this->User_model->list_all_user_by_institution_autocomplete($keyword, $this->session->userdata('institution'));

		$json_array = array();
		$r = new stdClass;
		$i=0;
		foreach ($query as $row)
			$r->rows[$i++]=$row;
		echo json_encode($r);
	}

	public function get_kota_by_prov()
	{
		$prov_id = $this->input->post('prov_id', TRUE);
		$result = $this->Pptkis_model->get_kota_by_prov($prov_id);

		echo json_encode($result);
	}







}
