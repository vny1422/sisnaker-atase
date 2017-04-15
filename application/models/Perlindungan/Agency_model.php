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

    public function delete_cekal($id)
    {
        $this->db->where('caid',$id);
        return $this->db->delete('cekalagensi');
    }

    function get_agency($cekal=false) {
      if($cekal==false){
        return $this->db->get($this->table)->result_array();
      }
      else{
        $this->db->select('c.*,m.agnama as agnama');
        $this->db->from('magensi m, cekalagensi c');
        $this->db->where('c.agid = m.agid AND c.enable=1 AND (c.caend IS NULL OR c.caend >= NOW())');
        return $this->db->get()->result();
      }

    }

    function get_cekalagency()
    {
      $this->db->select('c.*,m.agnama as agnama, m.agnamaoth as agnamaoth, m.agpngjwb as agpngjwb, m.agpngjwboth as agpngjwboth');
      $this->db->from('magensi m, cekalagensi c');
      $this->db->where('c.agid = m.agid AND c.enable=1 AND (c.caend IS NULL OR c.caend >= NOW())');
      return $this->db->get()->result_array();
    }

    function get_cekalagid($id)
    {
      $this->db->from('cekalagensi c');
      $this->db->where('c.agid = '.$id.' AND c.enable=1 AND (c.caend IS NULL OR c.caend >= NOW())');
      return $this->db->get()->row();
    }

    function get_all_agency()
    {
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
      $this->db->select('agnama,agnamaoth,agalmtkantor,agalmtkantoroth,agpngjwb,agpngjwboth,agtelp,agfax,agnoijincla');
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
    $this->db->like('agnama', $keyword);
    $this->db->where('agenable', "1");

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

}
