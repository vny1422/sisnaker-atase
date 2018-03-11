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

  public function getKuitansiByBC($bc)
  {
    $this->db->select('k.kukode');
    $this->db->from('entryjo e');
    $this->db->where('e.ejtglendorsement is NOT NULL');
    $this->db->where('e.ejbcform', $bc);
    $this->db->or_where('e.ejbcsk', $bc);
    $this->db->or_where('e.ejbcsp', $bc);
    $this->db->join('pencatatanej p', 'e.ejid = p.ejid');
    $this->db->join('kuitansi k', 'k.kuid = p.kuid');
    return $this->db->get()->result();
  }

  public function list_dokumen_kuitansi(){
    $this->db->select('t.*');
    $this->db->from('tipe t');
    $this->db->where('t.idtipe < 5');
    return $this->db->get()->result();
  }

  public function list_dokumen_kuitansi_non_ketenagakerjaan(){
    $this->db->select('t.*');
    $this->db->from('tipe t');
    $this->db->where('t.idtipe > 4');
    return $this->db->get()->result();
  }

  public function catat_kuitansi($username, $idinstitution, $barcode=null, $v2=0)
  {
    if($v2 == 0)
    {
      $data = array(
        'username' => $username,
        'idinstitution' => $idinstitution,
        'kutglmasuk' => $this->input->post('start',TRUE),
        'kutglkuitansi' => $this->input->post('tglkuitansi',TRUE),
        'kuno' => $this->input->post('kuno',TRUE),
        'idtipe' => $this->input->post('dokumen',TRUE),
        'kujmlbayar' => $this->input->post('jmlterbayar',TRUE),
        'kupemohon' => $this->input->post('pemohon',TRUE),
        'kukode' => $barcode
    );
    $this->db->insert($this->table, $data);
    $id = $this->db->insert_id();
    return $id;
    }
    else {
      $data = array(
        'username' => $username,
        'idinstitution' => $idinstitution,
        'kutglmasuk' => $this->input->post('start',TRUE),
        'kutglkuitansi' => $this->input->post('tglkuitansi',TRUE),
        'kuno' => $this->input->post('kuno',TRUE),
        'idtipe' => 1,
        'kujmlbayar' => $this->input->post('jmlterbayar',TRUE),
        'kupemohon' => $this->input->post('pemohon',TRUE),
        'kukode' => $barcode
    );
    $this->db->insert($this->table, $data);
    $id = $this->db->insert_id();
    return $id;
    }
    // if($barcode != null)
    // {
    //   $data = array(
    //     'username' => $username,
    //     'idinstitution' => $idinstitution,
    //     'kutglmasuk' => $this->input->post('start',TRUE),
    //     'kutglkuitansi' => $this->input->post('tglkuitansi',TRUE),
    //     'kuno' => $this->input->post('kuno',TRUE),
    //     'idtipe' => $this->input->post('dokumen',TRUE),
    //     'kukode' => $barcode,
    //     'kujmlbayar' => $this->input->post('jmlterbayar',TRUE),
    //     'kupemohon' => $this->input->post('pemohon',TRUE),
    //     'kukode' => $barcode
    // );
    // $this->db->insert($this->table, $data);
    // $id = $this->db->insert_id();
    // return $id;
    // }
    // else{
    //   $data = array(
    //     'username' => $username,
    //     'idinstitution' => $idinstitution,
    //     'kutglmasuk' => $this->input->post('start',TRUE),
    //     'kutglkuitansi' => $this->input->post('tglkuitansi',TRUE),
    //     'kuno' => $this->input->post('kuno',TRUE),
    //     'idtipe' => $this->input->post('dokumen',TRUE),
    //     'kujmlbayar' => $this->input->post('jmlterbayar',TRUE),
    //     'kupemohon' => $this->input->post('pemohon',TRUE),
    // );
    // $this->db->insert($this->table, $data);
    // $id = $this->db->insert_id();
    // return $id;
    // }
  }

  public function mass_catat_kuitansi($username, $idinstitution)
  {
      $i = 0;
      $amountpaid = $this->input->post('jmlterbayar',TRUE);
      $arrayids = array();
      foreach($this->input->post('kuno', TRUE) as $kuno)
      {
        $barcode = $this->generate_barcode();
        $data = array(
          'username' => $username,
          'idinstitution' => $idinstitution,
          'kutglmasuk' => $this->input->post('start',TRUE),
          'kutglkuitansi' => $this->input->post('tglkuitansi',TRUE),
          'kuno' => $kuno,
          'idtipe' => $this->input->post('dokumen',TRUE),
          'kujmlbayar' => $amountpaid[$i],
          'kupemohon' => $this->input->post('pemohon',TRUE),
          'kukode' => $barcode
        );
        $i += 1;
        $this->db->insert($this->table, $data);
        array_push($arrayids, $this->db->insert_id());
      }
    return $arrayids;
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
    // $this->db->where('idtipe <> 1');
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

  public function generate_barcode()
  {
    $abnormalize[1] = '01';
    $abnormalize[2] = '02';
    $abnormalize[3] = '03';
    $abnormalize[4] = '04';
    $abnormalize[5] = '05';
    $abnormalize[6] = '06';
    $abnormalize[7] = '07';
    $abnormalize[8] = '08';
    $abnormalize[9] = '09';
    $abnormalize[10] = '10';
    $abnormalize[11] = '11';
    $abnormalize[12] = '12';
    $abnormalize[13] = '13';
    $abnormalize[14] = '14';
    $abnormalize[15] = '15';
    $abnormalize[16] = '16';
    $abnormalize[17] = '17';
    $abnormalize[18] = '18';
    $abnormalize[19] = '19';
    $abnormalize[20] = '20';
    $abnormalize[21] = '21';
    $abnormalize[22] = '22';
    $abnormalize[23] = '23';
    $abnormalize[24] = '24';
    $abnormalize[25] = '25';
    $abnormalize[26] = '26';
    $abnormalize[27] = '27';
    $abnormalize[28] = '28';
    $abnormalize[29] = '29';
    $abnormalize[30] = '30';
    $abnormalize[31] = '31';
    $kode[1] = 'A';$kode[2] = 'B';$kode[3] = 'C';$kode[4] = 'D';$kode[5] = 'E';
    $kode[6] = 'F';$kode[7] = 'G';$kode[8] = 'H';$kode[9] = 'I';$kode[10] = 'J';
    $kode[11] = 'K';$kode[12] = 'L';$kode[13] = 'M';$kode[14] = 'N';$kode[5] = 'O';
    $kode[16] = 'P';$kode[17] = 'Q';$kode[18] = 'R';$kode[19] = 'S';$kode[20] = 'T';
    $kode[21] = 'U';$kode[22] = 'V';$kode[23] = 'W';$kode[24] = 'X';$kode[25] = 'Y';
    $kode[26] = 'Z';
    $tglmasuk = $this->input->post('start',TRUE);
    $p = explode("/", $tglmasuk);
    $tglmasuk = intval($p[2]);
    $blnmasuk = intval($p[1]);
    $thnmasuk = $p[0];
    $extra = 0;

    if($blnmasuk == '12' && $thnmasuk == '2011')
    {
      $extra = 627;
    }
    $kodetahun = $kode[$thnmasuk-2010];
    $kodebulan = $kode[$blnmasuk];
    $kodetipe = $kode[$this->input->post('dokumen', TRUE)];
    $tglmasuk = $abnormalize[$tglmasuk];
    $blnmasuk = $abnormalize[$blnmasuk];
    $count = $this->Kuitansi_model->getCountKuitansi($thnmasuk,$blnmasuk);
    $order = $extra+$count->count;
    $barcodeku = '';
    if($order < 10){$barcodeku = '0000' . $order . $kodebulan . $kodetahun. $kodetipe;}
    else if($order < 100){$barcodeku = '000' . $order . $kodebulan . $kodetahun. $kodetipe;}
    else if($order < 1000){$barcodeku = '00' . $order . $kodebulan . $kodetahun. $kodetipe;}
    else if($order < 10000){$barcodeku = '0' . $order . $kodebulan . $kodetahun. $kodetipe;}
    return $barcodeku;
  }
}
