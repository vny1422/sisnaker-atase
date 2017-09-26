<?php
class Agency_model extends CI_Model {
    private $table = 'magensi';
    public function __construct()
    {
        $this->load->database('default');
    }
    public function post_new_agency()
    {
      $active = $this->input->post('active',TRUE);

      if ($active) {
        $active = 1;
      } else {
        $active = 0;
      }

      $data = array(
        'agnama' => $this->input->post('name', TRUE),
        'agnamaoth' => $this->input->post('nameother', TRUE),
        'agnoijincla' => $this->input->post('noijin', TRUE),
        'agalmtkantor' => $this->input->post('address', TRUE),
        'agalmtkantoroth' => $this->input->post('addressother', TRUE),
        'username' => $this->input->post('user',TRUE),
        'idinstitution' => $this->input->post('institution',TRUE),
        'agpngjwb' => $this->input->post('penanggung',TRUE),
        'agpngjwboth' => $this->input->post('penanggungother',TRUE),
        'agtelp' => $this->input->post('notelp',TRUE),
        'agfax' => $this->input->post('nofax',TRUE),
        'agenable' => $active
    );

    return $this->db->insert($this->table, $data);
    }

    public function post_new_cekal($idinstitusi)
    {
      $active = $this->input->post('active',TRUE);

      if ($active) {
        $data = array(
          'agid' => $this->input->post('agensi', TRUE),
          'castart' => $this->input->post('start', TRUE),
          'caend' => $this->input->post('end', TRUE),
          'cacatatan' => $this->input->post('catatan', TRUE),
          'idinstitution' => $idinstitusi,
          'enable' => 1
      );
      } else {
        $date = date('Y-m-d');
        $data = array(
          'agid' => $this->input->post('agensi', TRUE),
          'castart' => $date,
          'cacatatan' => $this->input->post('catatan', TRUE),
          'idinstitution' => $idinstitusi,
          'enable' => 1
      );
      }
    return $this->db->insert('cekalagensi', $data);
    }

    public function delete_agency($id)
    {
        $this->db->where('agid',$id);
        return $this->db->delete($this->table);
    }

    public function cek_cla_agensi($cla)
    {
      $this->db->where('agrnoijincla', $cla);
      $query = $this->db->get('agensiregistrasi');
      $data["cekregis"] = $query->num_rows();
      $this->db->select('m.agnama as agnama');
      $this->db->from('magensi m, cekalagensi c');
      $this->db->where('(m.agnoijincla = "'.$cla.'") AND (c.agid = m.agid AND c.enable=1 AND (c.caend IS NULL OR c.caend >= NOW()))');
      $query = $this->db->get();
      $data["cekcekal"] = $query->num_rows();
      return $data;
    }

    public function cek_agensi_magensi($cla, $agnama)
    {
      $this->db->like('agnoijincla', $cla);
      $this->db->or_like('agnama', $agnama);
      $this->db->where('agenable',1);
      $query = $this->db->get('magensi');
      return $query->result();
    }

    public function cek_username_magensi($cla)
    {
      $this->db->select('username');
      $this->db->where('agnoijincla', $cla);
      $query = $this->db->get('magensi');
      return $query->row();
    }

    public function merge_agensi_kembar($data)
    {
      return $this->db->insert_batch('agensi_merge_map', $data);
    }

    public function add_new_registration($data)
    {
      return $this->db->insert('agensiregistrasi',$data);
    }

    public function get_agency_registration($id=NULL)
    {
      if(isset($id)) {
        $this->db->where('agrid', $id);
        $query = $this->db->get('agensiregistrasi');
        return $query->row();
      } else {
        $query = $this->db->query('SELECT * FROM agensiregistrasi ORDER BY agrstatus IS NULL DESC, agrstatus DESC');
        return $query->result();
      }
    }

    public function insert_new_agency($agensi, $agid, $idinst) {
      $data = array(
        'agid' => $agid,
        'agemail' => $agensi->agremail,
        'agnama' => $agensi->agrnama,
        'agnamaoth' => $agensi->agrnamacn,
        'agnoijincla' => $agensi->agrnoijincla,
        'agalmtkantor' => $agensi->agralmtkantor,
        'agalmtkantoroth' => $agensi->agralmtkantorcn,
        'agpngjwb' => $agensi->agrpngjwb,
        'agpngjwboth' => $agensi->agrpngjwbcn,
        'agtelp' => $agensi->agrtelp,
        'agfax' => $agensi->agrfax,
        'idinstitution' => $idinst,
        'agenable' => 1
      );
      return $this->db->insert('magensi', $data);
    }

    public function update_user_agency($agid, $user, $dataAgensi=NULL) {
      $this->db->where('agid',$agid);
      if(isset($dataAgensi)) {
        $data = array(
          'username' => $user,
          'agemail' => $dataAgensi["agemail"],
          'agnama' => $dataAgensi["agnama"],
          'agnamaoth' => $dataAgensi["agnamaoth"],
          'agnoijincla' => $dataAgensi["agnoijincla"],
          'agalmtkantor' => $dataAgensi["agalmtkantor"],
          'agalmtkantoroth' => $dataAgensi["agalmtkantoroth"],
          'agpngjwb' => $dataAgensi["agpngjwb"],
          'agpngjwboth' => $dataAgensi["agpngjwboth"],
          'agtelp' => $dataAgensi["agtelp"],
          'agfax' => $dataAgensi["agfax"],
          'idinstitution' => $dataAgensi["idinstitution"]
        );
      } else {
        $data = array(
          'username' => $user
        );
      }
      return $this->db->update('magensi', $data);
    }

    public function update_agency_registrasi_agid($agrid, $now, $status, $agid=NULL) {
      $this->db->where('agrid', $agrid);
      if(isset($agid)) {
        return $this->db->update('agensiregistrasi', array("agid" => $agid, "responsed" => $now, "agrstatus" => $status));
      } else {
        return $this->db->update('agensiregistrasi', array("responsed" => $now, "agrstatus" => $status));
      }
    }

    public function delete_cekal($id)
    {
        $this->db->where('caid',$id);
        return $this->db->delete('cekalagensi');
    }

    function get_agency($cekal=false) {
      if($cekal==false){
        $this->db->join('institution i', 'i.idinstitution = magensi.idinstitution');
        return $this->db->get($this->table)->result_array();
      }
      else{
        $this->db->select('c.*,m.agnama as agnama,i.nameinstitution');
        $this->db->from('institution i, magensi m, cekalagensi c');
        $this->db->where('m.idinstitution = i.idinstitution AND c.agid = m.agid AND c.enable=1 AND (c.caend IS NULL OR c.caend >= NOW())');
        return $this->db->get()->result();
      }
    }

    function get_agency_from_institution($id,$cekal=false,$array=false) {
      if($cekal==false){
        if($array)
        {
          return $this->db->get_where($this->table, array('idinstitution' => $id))->result();
        }
        else {
          return $this->db->get_where($this->table, array('idinstitution' => $id))->result_array();
        }
      }
      else{
        $this->db->select('c.*,m.agnama as agnama');
        $this->db->from('magensi m, cekalagensi c');
        $this->db->where('m.idinstitution',$id);
        $this->db->where('c.agid = m.agid AND c.enable=1 AND (c.caend IS NULL OR c.caend >= NOW())');
        return $this->db->get()->result();
      }
    }

    function get_cekalagency($idinstitution=null)
    {
      $this->db->select('c.*,m.agnama as agnama, m.agnamaoth as agnamaoth, m.agpngjwb as agpngjwb, m.agpngjwboth as agpngjwboth');
      $this->db->from('magensi m, cekalagensi c');
      if($idinstitution != null){
        $this->db->where('m.idinstitution',$idinstitution);
      }
      $this->db->where('c.agid = m.agid AND c.enable=1 AND (c.caend IS NULL OR c.caend >= NOW())');
      return $this->db->get()->result_array();
    }

    function get_cekalagid($id)
    {
      $this->db->from('cekalagensi c');
      $this->db->where('c.agid = '.$id.' AND c.enable=1 AND (c.caend IS NULL OR c.caend >= NOW())');
      return $this->db->get()->row();
    }

    function get_all_agency($institution = 'all')
    {
      if($institution != 'all')
      {
        $this->db->where('idinstitution',$institution);
      }
      return $this->db->get($this->table)->result();
    }

    public function update_agency($id,$agen = false)
    {
      if($agen == false)
      {
        $active = $this->input->post('active',TRUE);

        if ($active) {
          $active = 1;
        } else {
          $active = 0;
        }

        $data = array(
          'agnama' => $this->input->post('name', TRUE),
          'agnamaoth' => $this->input->post('nameother', TRUE),
          'agnoijincla' => $this->input->post('noijin', TRUE),
          'agalmtkantor' => $this->input->post('address', TRUE),
          'agalmtkantoroth' => $this->input->post('addressother', TRUE),
          'username' => $this->input->post('user',TRUE),
          'idinstitution' => $this->input->post('institution',TRUE),
          'agpngjwb' => $this->input->post('penanggung',TRUE),
          'agpngjwboth' => $this->input->post('penanggungother',TRUE),
          'agtelp' => $this->input->post('notelp',TRUE),
          'agfax' => $this->input->post('nofax',TRUE),
          'agenable' => $active
      );
      $this->db->where('agid',$id);
      return $this->db->update($this->table, $data);
      }
      else {
        $date = date('Y');
        $this->db->select('COUNT(*) as count');
        $this->db->where('agid', $id);
        $this->db->where('timestamp like \''.$date.'%\'');
        $cek = $this->db->get('logagensi')->row();
        if($cek->count < 3)
        {
          $data = array(
            'agnama' => $this->input->post('name', TRUE),
            'agnamaoth' => $this->input->post('nameother', TRUE),
            'agnoijincla' => $this->input->post('noijin', TRUE),
            'agalmtkantor' => $this->input->post('address', TRUE),
            'agalmtkantoroth' => $this->input->post('addressother', TRUE),
            'agpngjwb' => $this->input->post('penanggung',TRUE),
            'agpngjwboth' => $this->input->post('penanggungother',TRUE),
            'agtelp' => $this->input->post('notelp',TRUE),
            'agfax' => $this->input->post('nofax',TRUE),
            'agemail' => $this->input->post('email', TRUE)
          );
          $this->db->where('agid',$id);
          return $this->db->update($this->table, $data);
        }
        else {
          return false;
        }

      }

    }

    function get_agency_info($id) {
      $this->db->select('agnama,agnamaoth,agalmtkantor,agalmtkantoroth,agpngjwb,agpngjwboth,agtelp,agfax,agnoijincla,idinstitution');
      $this->db->from('magensi');
      $this->db->where('agid', $id);
      $query = $this->db->get();

      return $query->row_array();
    }

    function get_agency_edit($id) {
      $this->db->select('*');
      $this->db->from('magensi');
      $this->db->where('agid', $id);
      $query = $this->db->get();

      return $query->row();
    }


function get_agency_from_pptkis($id){
  $qtext = "SELECT magensi.agnama, jobtglawal, jobtglakhir,namajenispekerjaan
        FROM jo, jodetail, magensi, mpptkis, jenispekerjaan
        WHERE jodetail.idjenispekerjaan = jenispekerjaan.idjenispekerjaan AND jo.jobid = jodetail.jobid
          AND jo.agid = magensi.agid AND jo.ppkode = mpptkis.ppkode AND jo.jobenable = 1 AND mpptkis.ppkode='".$id."'
          AND (jobtglakhir IS NULL OR jobtglakhir >= NOW())
        ORDER BY agnama asc";
  $query = $this->db->query($qtext);
  return $query->result_array();
}


    function get_agency_cekal($id) {
      $this->db->select('*');
      $this->db->from('cekalagensi');
      $this->db->where('caid', $id);
      $query = $this->db->get();

      return $query->row();
    }

    function ambilnamaagensi($keyword, $num=0, $rand=false) {
    $this->db->select('agid_kembar');
    $this->db->from('agensi_merge_map');
    $this->db->distinct();
    $where_clause = $this->db->get_compiled_select();

    $this->db->like('agnama', $keyword);
    $this->db->where('agenable', "1");
    $this->db->where("`agid` NOT IN ($where_clause)", NULL, FALSE);

    $query = $this->db->get('magensi');
    return $query->result();
  }

  public function update_cekal($id, $idinstitusi)
  {
    $active = $this->input->post('active',TRUE);
    $enable = $this->input->post('enable',TRUE);
    if($enable)
    {
      $enable = true;
    }
    else {
      $enable = false;
    }
    if ($active) {
      $data = array(
        'agid' => $this->input->post('agensi', TRUE),
        'castart' => $this->input->post('start', TRUE),
        'caend' => $this->input->post('end', TRUE),
        'cacatatan' => $this->input->post('catatan', TRUE),
        'idinstitution' => $idinstitusi,
        'enable' => $enable
    );
    } else {
      $data = array(
        'agid' => $this->input->post('agensi', TRUE),
        'cacatatan' => $this->input->post('catatan', TRUE),
        'caend' => null,
        'idinstitution' => $idinstitusi,
        'enable' => $enable
    );
    }
    $this->db->where('caid', $id);
    return $this->db->update('cekalagensi', $data);
  }

  public function get_agency_info_by_user($username){
    $this->db->where('username',$username);
    return $this->db->get($this->table)->row();
  }

  public function check_agency_isactive($agid){
    $this->db->where('agid',$agid);
    $this->db->where('agenable',1);
    return $this->db->get($this->table)->row();
  }

  public function deactivate_agensi($inactive){
    return $this->db->update_batch($this->table, $inactive, 'agid');
  }

}
