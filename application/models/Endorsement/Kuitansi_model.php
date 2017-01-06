<?php
class Kuitansi_model extends CI_Model {
  private $table = 'kuitansi';
	public function __construct()
    {
        $this->load->database('default');
    }

  public function check_kuitansi($noku)
  {
    $this->db->select('k.*,d.name as namadokumen');
    $this->db->from('kuitansi k');
    $this->db->join('dokumenkuitansi d', 'k.idtipe = d.id', 'left');
    $this->db->like('kuno', $noku);
    return $this->db->get()->result();
  }

  public function list_dokumen_kuitansi(){
    return $this->db->get('dokumenkuitansi')->result();
  }

  public function catat_kuitansi($username,$idinstitution)
  {
    $data = array(
      'username' => $username,
      'idinstitution' => $idinstitution,
      'kutglmasuk' => $this->input->post('start',TRUE),
      'kutglkuitansi' => $this->input->post('tglkuitansi',TRUE),
      'kuno' => $this->input->post('name',TRUE),
      'idtipe' => $this->input->post('dokumen',TRUE),
      'kujmlbayar' => $this->input->post('jmlterbayar',TRUE),
      'kupemohon' => $this->input->post('pemohon',TRUE),
  );
  return $this->db->insert($this->table, $data);
  }
}
