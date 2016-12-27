<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('SAdmin/User_model');
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

		$user = $this->User_model->get_user($username,$password);

		if($user != NULL) {
			$user_data = array(
				'user'	=> $user[0]['username'],
				'name'	=> $user[0]['name'],
				'role'  => $user[0]['idlevel'],
				'institution' => $user[0]['idinstitution'],
				'kantor' => $user[0]['idkantor']
			);
			$this->session->set_userdata($user_data);
			return TRUE;
		} else {
			$this->form_validation->set_message('check_login', 'Username & Password are invalid!');
			return FALSE;
		}
	}

}
