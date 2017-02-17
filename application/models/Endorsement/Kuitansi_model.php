<?php
class Kuitansi_model extends CI_Model {
  private $table = 'kuitansi';
	public function __construct()
    {
        $this->load->database('default');
    }

  public function check_kuitansi($noku)
  {
    $this->db->select('k.*,d.tipe as namadokumen');
    $this->db->from('kuitansi k');
    $this->db->join('tipe d', 'k.idtipe = d.idtipe', 'left');
    $this->db->where('kuno LIKE \''.$noku.'\'');
    return $this->db->get()->result();
  }

  public function getKuitansiByDate($tglfix)
  {
    $this->db->where('kutglmasuk', $tglfix);
    $this->db->join('tipe t', 'kuitansi.idtipe = t.idtipe', 'left');
    return $this->db->get($this->table)->result();
  }

  public function list_dokumen_kuitansi(){
    return $this->db->get('tipe')->result();
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
        'kukode' => $barcode
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
    $this->db->where('idtipe <> 1');
    return $this->db->get($this->table)->row();
  }

  public function update_kuitansi($id)
  {
    $this->data['values'] = $this->Kuitansi_model->get_kuitansi($id);
      $tgl = explode("-", $this->data['values']->kutglmasuk);
      $tglkuisplit = explode("-", $this->data['values']->kutglkuitansi);
      $tglkui = $tglkuisplit[0]."/".$tglkuisplit[1]."/".$tglkuisplit[2];
      $tglkuisplittime = explode(" ", $tglkui);
      $this->data['values']->kutglmasuk = $tgl[0]."/".$tgl[1]."/".$tgl[2];
      $this->data['values']->kutglkuitansi = $tglkuisplittime[0];
      //var_dump($this->data['values']->kutglmasuk);
      $this->data['listtipe'] = $this->Kuitansi_model->list_all_tipe();
      //var_dump($this->data['values']);
      //var_dump($this->data['listtipe']);

      $tglmasuk = $this->input->post('kutglmasuk', TRUE);
      $splittglmasuk = explode("/", $tglmasuk);
      $tglmasukfix = $splittglmasuk[0]."-".$splittglmasuk[1]."-".$splittglmasuk[2];
      $tglkuitansinya = $this->input->post('kutglkuitansi', TRUE);
      $splittglkuitansinya = explode("/", $tglkuitansinya);
      $tglkuitansinyafix = $splittglkuitansinya[0]."-".$splittglkuitansinya[1]."-".$splittglkuitansinya[2];

    $data = array(
      'kutglmasuk' => $this->input->post('$tglmasukfix', TRUE),
      'kutglkuitansi' => $this->input->post('$tglkuitansinyafix', TRUE),
      'idtipe'=> $this->input->post('idtipe', TRUE),
      'noku' => $this->input->post('noku', TRUE),
      'kujmlbayar' => $this->input->post('kujmlbayar', TRUE),
      'kupemohon' => $this->input->post('kupemohon', TRUE)
      );
    $this->db->where('kuid', $id);
    return $this->db->update('kuitansi', $data);
  }

  public function updatekui($id){
     $tglmasuk = $this->input->post('kutglmasuk', TRUE);
      $splittglmasuk = explode("/", $tglmasuk);
      $tglmasukfix = $splittglmasuk[0]."-".$splittglmasuk[1]."-".$splittglmasuk[2];
      $tglkuitansinya = $this->input->post('kutglkuitansi', TRUE);
      $splittglkuitansinya = explode("/", $tglkuitansinya);
      //$tglkuitansinyafix = date('Y-m-d H:i:s');
      $tglkuitansinyafix = $splittglkuitansinya[0]."-".$splittglkuitansinya[1]."-".$splittglkuitansinya[2]." 00:00:00";
    $data = array(
      'kutglmasuk' => $tglmasukfix,
      'kutglkuitansi' => $tglkuitansinyafix,
      'idtipe'=> $this->input->post('idtipe', TRUE),
      'kuno' => $this->input->post('noku', TRUE),
      'kujmlbayar' => $this->input->post('kujmlbayar', TRUE),
      'kupemohon' => $this->input->post('kupemohon', TRUE)
      );
    $this->db->where('kuid', $id);
    return $this->db->update('kuitansi', $data);
  }

  public function get_kuitansi($id)
  {
    return $this->db->get_where('kuitansi', array('kuid' => $id))->row();
  }

  public function list_all_tipe()
  {
    $query = $this->db->get('tipe');
    return $query->result();
  }
}
