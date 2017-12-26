<?php
class PK_model extends CI_Model {
  private $table = 'entryjo';
  public function __construct()
  {
    $this->load->database('default');
  }

  function get_data_pk_by_agensi_and_pptkis ($agid, $ppkode) {
    $this->db->select('p.ejbcsp, p.mjnama, p.jomkthn, p.jomkbln, p.jomkhr, tk.tknama, jp.namajenispekerjaan, ag.agnama, pp.ppnama, p.isverified, p.isuploaded, p.pktimestamp');
    $this->db->from('entryjo p');
    $this->db->order_by("p.pktimestamp", "desc");
    $this->db->join('magensi ag', 'ag.agid = p.agid');
    $this->db->join('mpptkis pp', 'pp.ppkode = p.ppkode');
    $this->db->join('tki tk', 'tk.ejid = p.ejid');
    $this->db->join('jenispekerjaan jp', 'jp.idjenispekerjaan = p.idjenispekerjaan');
    $this->db->where('p.agid', $agid);
    $this->db->where('p.ppkode', $ppkode);
    $this->db->where('p.idinstitution', $this->session->userdata('institution'));
    $this->db->where('p.idkantor', $this->session->userdata('kantor'));

    return $this->db->get()->result();
  }

  function get_pk_from_barcode ($bc) {
    $this->db->select('p.ejbcsp, p.mjnama, p.jomkthn, p.jomkbln, p.jomkhr, tk.tknama, jp.namajenispekerjaan, ag.agnama, ag.agid, pp.ppkode, pp.ppnama, p.isverified, p.isuploaded, p.pktimestamp');
    $this->db->from('entryjo p');
    $this->db->order_by("p.pktimestamp", "desc");
    $this->db->join('magensi ag', 'ag.agid = p.agid');
    $this->db->join('mpptkis pp', 'pp.ppkode = p.ppkode');
    $this->db->join('tki tk', 'tk.ejid = p.ejid');
    $this->db->join('jenispekerjaan jp', 'jp.idjenispekerjaan = p.idjenispekerjaan');
    $this->db->where('p.ejbcsp', $bc);
    $this->db->or_where('p.ejbcform', $bc);
    $this->db->or_where('p.ejbcsk', $bc);
    $this->db->where('p.idinstitution', $this->session->userdata('institution'));
    $this->db->where('p.idkantor', $this->session->userdata('kantor'));

    return $this->db->get()->result();
  }

  function last_pk($agid, $ppkode)
  {
    $this->db->select('mjktp, mjnama, mjnamacn, mjalmt, mjtelp, mjfax, mjpngjwb, mjpngjwbcn');
    $this->db->order_by('pktimestamp', 'desc');
    $this->db->where('agid', $agid);
    $this->db->where('ppkode', $ppkode);
    return $this->db->get($this->table)->row();
  }

  function legalize_barcode($bc){
    $this->db->where('ejbcsp', $bc);
    $this->db->or_where('ejbcform', $bc);
    $this->db->or_where('ejbcsk', $bc);
    $this->db->where('idinstitution', $this->session->userdata('institution'));
    $this->db->where('idkantor', $this->session->userdata('kantor'));
    $this->db->where('isverified', 1);
    if ($this->db->get($this->table)->num_rows() > 0)
    {
      return FALSE;
    }
    else {
      $data = array(
        'isverified' => 1,
        'ejtglendorsement' => date("Y-m-d")
      );

      $this->db->where('ejbcsp', $bc);
      $this->db->or_where('ejbcform', $bc);
      $this->db->or_where('ejbcsk', $bc);
      $this->db->where('idinstitution', $this->session->userdata('institution'));
      $this->db->where('idkantor', $this->session->userdata('kantor'));
      return $this->db->update($this->table, $data);
    }
  }

}