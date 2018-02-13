<?php
class PPTKIS_model extends CI_Model {
  private $table = 'mpptkis';
  public function __construct()
  {
    $this->load->database('default');
  }

  public function post_new_pptkis()
  {
    $active = $this->input->post('active',TRUE);

    if ($active) {
      $active = true;
    } else {
      $active = false;
    }

    $data = array(
      'ppkode' => $this->input->post('kode',TRUE),
      'ppnama' => $this->input->post('name',TRUE),
      'ppalmtkantor' => $this->input->post('address',TRUE),
      'pptelp' => $this->input->post('notelp',TRUE),
      'ppfax' => $this->input->post('nofax',TRUE),
      'ppijin' => $this->input->post('ijin',TRUE),
      'pppngjwb' => $this->input->post('penanggung',TRUE),
      'ppstatus' => $this->input->post('status',TRUE),
      'ppkota' => $this->input->post('kota',TRUE),
      'pppropinsi' => $this->input->post('propinsi',TRUE),
      'ppenable' => $active
    );

    return $this->db->insert($this->table, $data);

  }

  public function post_new_cekal()
  {
    $active = $this->input->post('active',TRUE);
    if ($active) {
      $data = array(
        'ppkode' => $this->input->post('pptkis', TRUE),
        'cpstart' => $this->input->post('start', TRUE),
        'cpend' => $this->input->post('end', TRUE),
        'enable' => 1
      );
    } else {
      $date = date('Y-m-d');
      $data = array(
        'ppkode' => $this->input->post('pptkis', TRUE),
        'cpstart' => $date,
        'enable' => 1
      );
    }
    return $this->db->insert('cekalpptkis', $data);
  }

  public function delete_PPTKIS($id)
  {
    $this->db->where('ppkode',$id);
    return $this->db->delete($this->table);
  }

  public function delete_cekal($id)
  {
    $this->db->where('cpid',$id);
    return $this->db->delete('cekalpptkis');
  }

  function get_pptkis($cekal=false) {

    if($cekal==false){
      return $this->db->get($this->table)->result_array();
    }
    else{
      $this->db->select('c.*,m.ppnama as ppnama');
      $this->db->from('mpptkis m, cekalpptkis c');
      $this->db->where('c.ppkode = m.ppkode AND c.enable=1 AND (c.cpend IS NULL OR c.cpend >= NOW())');
      return $this->db->get()->result();
    }

  }

  function get_pptkis_non_cekal()
  {
    $query = 'select * from mpptkis where ppkode NOT IN (select ppkode from cekalpptkis where enable=1 AND (cpend IS NULL OR cpend >= NOW()))';
    return $this->db->query($query)->result();
  }

  function get_cekalppkode($id)
  {
    $this->db->from('cekalpptkis c');
    $this->db->where("c.ppkode = '".$id."' AND c.enable=1 AND (c.cpend IS NULL OR c.cpend >= NOW())");
    return $this->db->get()->row();
  }

  function get_cekalpptkis(){
    $this->db->select('c.*,m.ppnama as ppnama, m.pppngjwb as pppngjwb');
    $this->db->from('mpptkis m, cekalpptkis c');
    $this->db->where('c.ppkode = m.ppkode AND c.enable=1 AND (c.cpend IS NULL OR c.cpend >= NOW())');
    return $this->db->get()->result_array();
  }

  function get_all_pptkis(){
    $this->db->order_by('ppnama', 'asc');
    return $this->db->get($this->table)->result();
  }

  function get_pptkis_by_agensi_in_pkp($agid, $cekal=false){
    $this->db->distinct();
    $this->db->select('m.*, p.agid');
    $this->db->from('mpptkis m');
    $this->db->join('pkp p', 'p.ppkode = m.ppkode');
    $this->db->where('p.agid', $agid);
    if($cekal)
    {
      $this->db->where('m.ppkode IN (select ppkode from cekalpptkis where enable=1 AND (cpend IS NULL OR cpend >= NOW()))');
    }
    else {
      $this->db->where('m.ppkode NOT IN (select ppkode from cekalpptkis where enable=1 AND (cpend IS NULL OR cpend >= NOW()))');
    }
    $this->db->order_by('m.ppnama', 'asc');
    return $this->db->get()->result();
  }


  function get_pptkis_by_agensi_in_jo($agid){
    $this->db->distinct();
    $this->db->select('m.*, j.agid');
    $this->db->from('mpptkis m');
    $this->db->join('jo j', 'j.ppkode = m.ppkode');
    $this->db->where('j.agid', $agid);
    $this->db->order_by('m.ppnama', 'asc');
    return $this->db->get()->result();
  }

  function get_pptkis_by_agensi_in_pk($agid){
    $this->db->distinct();
    $this->db->select('m.*, j.agid');
    $this->db->from('mpptkis m');
    $this->db->join('entryjo j', 'j.ppkode = m.ppkode');
    $this->db->where('j.agid', $agid);
    $this->db->order_by('m.ppnama', 'asc');
    return $this->db->get()->result();
  }

  function get_pptkis_from_agency($id){
    $qtext = "SELECT mpptkis.ppnama, jobtglawal, jobtglakhir,namajenispekerjaan
    FROM jo, jodetail, magensi, mpptkis, jenispekerjaan
    WHERE jodetail.idjenispekerjaan = jenispekerjaan.idjenispekerjaan AND jo.jobid = jodetail.jobid
    AND jo.agid = magensi.agid AND jo.ppkode = mpptkis.ppkode AND jo.jobenable = 1 AND magensi.agid=".$id."
    AND (jobtglakhir IS NULL OR jobtglakhir >= NOW())
    ORDER BY ppnama asc";
    $query = $this->db->query($qtext);
    return $query->result_array();
  }

  public function update_pptkis($id)
  {
    $active = $this->input->post('active',TRUE);

    if ($active) {
      $active = true;
    } else {
      $active = false;
    }

    $data = array(
      'ppkode' => $this->input->post('kode',TRUE),
      'ppnama' => $this->input->post('name',TRUE),
      'ppalmtkantor' => $this->input->post('address',TRUE),
      'pptelp' => $this->input->post('notelp',TRUE),
      'ppfax' => $this->input->post('nofax',TRUE),
      'ppijin' => $this->input->post('ijin',TRUE),
      'pppngjwb' => $this->input->post('penanggung',TRUE),
      'ppstatus' => $this->input->post('status',TRUE),
      'ppkota' => $this->input->post('kota',TRUE),
      'pppropinsi' => $this->input->post('propinsi',TRUE),
      'ppenable' => $active
    );
    $this->db->where('ppkode',$id);
    return $this->db->update($this->table, $data);
  }

  function get_pptkis_info($id) {
    $this->db->select('*');
    $this->db->from('mpptkis');
    $this->db->where('ppkode', $id);
    $query = $this->db->get();

    return $query->row_array();
  }

  function get_pptkis_cekal($id) {
    $this->db->select('*');
    $this->db->from('cekalpptkis');
    $this->db->where('cpid', $id);
    $query = $this->db->get();

    return $query->row();
  }

  function ambilnamapptkis($keyword, $num=0, $rand=false) {
    $this->db->like('ppnama', $keyword);
    $this->db->not_like('ppkode', 'X');
    $this->db->where('ppenable', "1");

    $query = $this->db->get('mpptkis');
    return $query->result();
  }

  public function update_cekal($id)
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
        'ppkode' => $this->input->post('pptkis', TRUE),
        'cpstart' => $this->input->post('start', TRUE),
        'cpend' => $this->input->post('end', TRUE),
        'enable' => $enable
      );
    } else {
      $data = array(
        'ppkode' => $this->input->post('pptkis', TRUE),
        'cpend' => null,
        'enable' => $enable
      );
    }
    $this->db->where('cpid', $id);
    return $this->db->update('cekalpptkis', $data);
  }

  function get_all_propinsi()
  {
    $this->db->select('p.*');
    $this->db->from('provinsi p');
    $this->db->order_by('p.nama', 'asc');
    return $this->db->get()->result();
  }

  function get_kota_by_prov($prov_id){
    $this->db->select('k.*');
    $this->db->from('kabupaten k');
    $this->db->where('k.id_prov', $prov_id);
    $this->db->order_by('k.nama', 'asc');
    return $this->db->get()->result();
  }



}
