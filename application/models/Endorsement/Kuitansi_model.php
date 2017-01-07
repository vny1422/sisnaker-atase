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
    $this->db->where('kuno LIKE \''.$noku.'\'');
    return $this->db->get()->result();
  }

  public function list_dokumen_kuitansi(){
    return $this->db->get('dokumenkuitansi')->result();
  }

  public function catat_kuitansi($username,$idinstitution,$barcode=null)
  {
    if($barcode != null)
    {
      $data = array(
        'username' => $username,
        'idinstitution' => $idinstitution,
        'kutglmasuk' => $this->input->post('start',TRUE),
        'kutglkuitansi' => $this->input->post('tglkuitansi',TRUE),
        'kuno' => $this->input->post('kuno',TRUE),
        'idtipe' => $this->input->post('dokumen',TRUE),
        'kukode' => $barcode,
        'kujmlbayar' => $this->input->post('jmlterbayar',TRUE),
        'kupemohon' => $this->input->post('pemohon',TRUE),
    );
    $this->db->insert($this->table, $data);
    $id = $this->db->insert_id();
    return $id;
    }
    else{
      $data = array(
        'username' => $username,
        'idinstitution' => $idinstitution,
        'kutglmasuk' => $this->input->post('start',TRUE),
        'kutglkuitansi' => $this->input->post('tglkuitansi',TRUE),
        'kuno' => $this->input->post('kuno',TRUE),
        'idtipe' => $this->input->post('dokumen',TRUE),
        'kujmlbayar' => $this->input->post('jmlterbayar',TRUE),
        'kupemohon' => $this->input->post('pemohon',TRUE),
    );
    $this->db->insert($this->table, $data);
    $id = $this->db->insert_id();
    return $id;
    }
  }

  public function check_barcode(){
    $bc = $this->input->post('bc', TRUE);
    $this->db->where('ejbcform', $bc);
    $this->db->or_where('ejbcsk', $bc);
    $this->db->or_where('ejbcsp', $bc);
    return $this->db->get('entryjo')->row();
  }

  public function getCountKuitansi($thnmasuk,$blnmasuk)
  {
    $this->db->select('COUNT(*)+1 as count');
    $this->db->where('kutglmasuk LIKE \''.$thnmasuk.'-'.$blnmasuk.'%\'');
    $this->db->where('idtipe <> 2');
    return $this->db->get($this->table)->row();
  }
}
