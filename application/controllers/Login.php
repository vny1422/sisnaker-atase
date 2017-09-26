<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('SAdmin/User_model');
		$this->load->model('Perlindungan/Agency_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		if ($this->session->userdata('user'))
		{
			if ($this->session->userdata('role') == 1)
			{
				redirect('sadmin');
			}
			else if($this->session->userdata('role') == 2)
			{
				redirect('sadmin/local');
			}
			else if($this->session->userdata('role') == 3)
			{
				redirect('perlindungan');
			}
			else if($this->session->userdata('role') == 4)
			{
				redirect('endorsement/dashboard');
			}
			else if($this->session->userdata('role') == 5)
			{
				redirect('pusat');
			}
			else if($this->session->userdata('role') == 6 || $this->session->userdata('role') == 7 )
			{
				redirect('endorsement');
			}
		}

		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|callback_check_login');

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('Login_view');
		}
		else
		{
			if ($this->session->userdata('role') == 1)
			{
				redirect('sadmin');
			}
			else if($this->session->userdata('role') == 2)
			{
				redirect('sadmin/local');
			}
			else if($this->session->userdata('role') == 3)
			{
				redirect('perlindungan');
			}
			else if($this->session->userdata('role') == 4)
			{
				redirect('endorsement/dashboard');
			}
			else if($this->session->userdata('role') == 5)
			{
				redirect('pusat');
			}
			else if($this->session->userdata('role') == 6 || $this->session->userdata('role') == 7 )
			{
				redirect('endorsement');
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}

	function check_login() {
		$username = $this->input->post('username',TRUE);
		$password = $this->input->post('password',TRUE);
		$verified = FALSE;

		$user = $this->User_model->get_user($username,$password);

		if($user != NULL) {
			$verified = TRUE;
			$isagensi = $this->Agency_model->get_agency_info_by_user($username);

			if($isagensi != NULL) {
				$enabled = $this->Agency_model->check_agency_isactive($isagensi->agid);
				if($enabled == NULL) {
					$verified = FALSE;
				}
			}
		}

		if($verified) {
			$user_data = array(
				'user'	=> $user[0]['username'],
				'name'	=> $user[0]['name'],
				'role'  => $user[0]['idlevel'],
				'institution' => $user[0]['idinstitution'],
				'kantor' => $user[0]['idkantor'],
				'picture' =>$user[0]['picture']
			);
			$this->session->set_userdata($user_data);
		} else {
			$this->form_validation->set_message('check_login', 'Username & Password are invalid!');
		}
		return $verified;
	}

	public function daftar()
	{
		$this->load->model('SAdmin/Institution_model');
		$this->load->model('Perlindungan/Agency_model');
		$this->form_validation->set_rules('agemail', 'Agency Email', 'required|trim');
		$this->form_validation->set_rules('agnama', 'Agency Name', 'required|trim');
		$this->form_validation->set_rules('nocla', 'C.L.A Agency License No', 'required|trim');
		$this->form_validation->set_rules('officealamat', 'Agency Address', 'required|trim');
		$this->form_validation->set_rules('institution', 'Institution', 'required|trim');

		if ($this->form_validation->run() === FALSE)
		{
			$data['institution'] = $this->Institution_model->list_active_institution();
			$this->load->view('Endorsement/DaftarAgensi_view',$data);

		}
		else
		{
			$cek = $this->Agency_model->cek_cla_agensi($this->input->post('nocla',TRUE));
			if($cek['cekregis'] > 0 )
			{
				$this->session->set_flashdata('information', 'Registration could not be made, Agency Data already registered.');
				// $this->load->view('Endorsement/DaftarAgensi_view');
				var_dump($cek);
			}
			else if($cek['cekcekal'] > 0)
			{
				$this->session->set_flashdata('information', 'Registration could not be made, Agency is BANNED.');
				$this->load->view('Endorsement/DaftarAgensi_view');
			}
			else {
				$namafile = $_FILES['filecla']['name'];
				$ext = pathinfo($namafile, PATHINFO_EXTENSION);
				$config['upload_path'] = './uploadsregister/';
				$config['allowed_types'] = 'pdf|jpg|png';
				$config['overwrite'] = TRUE;
				$config['remove_spaces'] = TRUE;
				$config['file_name'] =  $this->input->post('nocla',TRUE).".".$ext;

				$this->load->library('upload', $config);

				if ( !$this->upload->do_upload('filecla'))
				{
					$this->data['error'] = $this->upload->display_errors('','');
				} else {
					$this->data['error'] = "";
					$datas = array('upload_data' => $this->upload->data());
				}
				$data = array(
					'agremail' => $this->input->post('agemail',TRUE),
					'agrnama' => $this->input->post('agnama',TRUE),
					'agrnamacn' => $this->input->post('agnamaoth',TRUE),
					'agrnoijincla' => $this->input->post('nocla',TRUE),
					'agralmtkantor' => $this->input->post('officealamat',TRUE),
					'agralmtkantorcn' => $this->input->post('ot_officealamat',TRUE),
					'agrpngjwb' => $this->input->post('authperson',TRUE),
					'agrpngjwbcn' => $this->input->post('ot_authperson',TRUE),
					'agrtelp' => $this->input->post('phone',TRUE),
					'agrfax' => $this->input->post('fax',TRUE),
					'idinstitution' => $this->input->post('institution',TRUE),
					'filename' => $this->input->post('nocla',TRUE).".".$ext
				);
				$this->Agency_model->add_new_registration($data);
				$this->session->set_flashdata('information', 'Registration done, Username and Password will be sent by EMAIL after Verification.');
				$data['institution'] = $this->Institution_model->list_active_institution();
				$this->load->view('Endorsement/DaftarAgensi_view',$data);
			}

		}
	}

}
