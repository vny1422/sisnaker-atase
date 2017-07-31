<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    protected $listdp, $usedpg, $usedmpg, $namainstitusi;

	public function __construct()
    {
        parent::__construct();
        $this->load->model('SAdmin/Institution_model');
        $this->load->model('SAdmin/Kantor_model');
        $this->load->model('SAdmin/Privilege_model');
        $this->load->model('SAdmin/Level_model');

        date_default_timezone_set("Asia/Jakarta");

        if ($this->session->userdata('user') === NULL)
        {
            redirect('login');
        }
    }

    public function load_sidebar()
    {
        $this->namainstitusi = $this->Institution_model->get_institution_name($this->session->userdata('institution'));
        $this->namakantor = $this->Kantor_model->get_kantoragensi_name($this->session->userdata('user'));
        $data['listlevelpriv'] = $this->Level_model->sidebar_level_detail($this->session->userdata('role'));
        $data['countdp'] = $this->Level_model->count_level_detail($this->session->userdata('role'));
        $this->listdp = array();
        $listiddp = "";
        $i=1;
        foreach ($data['listlevelpriv'] as $row):
                array_push($this->listdp,$this->Privilege_model->get_dp($row->idprivilege));
                if($i < $data['countdp'] ):
                    $listiddp .= (string)$row->idprivilege;
                    $listiddp .= ",";
                else:
                    $listiddp .= (string)$row->idprivilege;
                endif;
                $i = $i+1;
        endforeach;
        $data['groupdp'] = $this->Privilege_model->group_dp($listiddp);
        $data['countgroupdp'] = $this->Privilege_model->count_group_dp($listiddp);
        $this->usedpg = array();
        $listidpg = "";
        $i = 1;
        foreach ($data['groupdp'] as $row):
                array_push($this->usedpg,$this->Privilege_model->get_pg($row->idprivilegegroup));
                if($i < $data['countgroupdp'] ):
                    $listidpg .= (string)$row->idprivilegegroup;
                    $listidpg .= ",";
                else:
                    $listidpg .= (string)$row->idprivilegegroup;
                endif;
                $i = $i+1;
        endforeach;
        $data['grouppg'] = $this->Privilege_model->group_pg($listidpg);
        $this->usedmpg = array();
        foreach ($data['grouppg'] as $row):
                array_push($this->usedmpg,$this->Privilege_model->get_mpg($row->masterprivilegegroupid));
        endforeach;
    }
}
