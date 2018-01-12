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

  function get_data_pk_reentry_by_agensi_and_pptkis ($agid, $ppkode) {
    $this->db->select('p.ejbcsp, p.mjnama, p.jomkthn, p.jomkbln, p.jomkhr, tk.tknama, jp.namajenispekerjaan, ag.agnama, pp.ppnama, p.isverified, p.isuploaded, p.pktimestamp, p.bantuanpp, p.backtoid');
    $this->db->from('entryjo p');
    $this->db->order_by("p.pktimestamp", "desc");
    $this->db->join('magensi ag', 'ag.agid = p.agid');
    $this->db->join('mpptkis pp', 'pp.ppkode = p.ppkode');
    $this->db->join('tki tk', 'tk.ejid = p.ejid');
    $this->db->join('jenispekerjaan jp', 'jp.idjenispekerjaan = p.idjenispekerjaan');
    $this->db->where('p.jenispk', 1);
    $this->db->where('p.agid', $agid);
    $this->db->where('p.ppkode', $ppkode);
    $this->db->where('p.idinstitution', $this->session->userdata('institution'));
    $this->db->where('p.idkantor', $this->session->userdata('kantor'));

    return $this->db->get()->result();
  }

  function get_data_pk_transfer_by_agensi_and_pptkis ($agid, $ppkode) {
    $this->db->select('p.ejbcsp, p.mjnama, p.jomkthn, p.jomkbln, p.jomkhr, tk.tknama, jp.namajenispekerjaan, ag.agnama, pp.ppnama, p.isverified, p.isuploaded, p.pktimestamp');
    $this->db->from('entryjo p');
    $this->db->order_by("p.pktimestamp", "desc");
    $this->db->join('magensi ag', 'ag.agid = p.agid');
    $this->db->join('mpptkis pp', 'pp.ppkode = p.ppkode');
    $this->db->join('tki tk', 'tk.ejid = p.ejid');
    $this->db->join('jenispekerjaan jp', 'jp.idjenispekerjaan = p.idjenispekerjaan');
    $this->db->where('p.jenispk', 2);
    $this->db->where('p.agid', $agid);
    $this->db->where('p.ppkode', $ppkode);
    $this->db->where('p.idinstitution', $this->session->userdata('institution'));
    $this->db->where('p.idkantor', $this->session->userdata('kantor'));

    return $this->db->get()->result();
  }

  public function upload_dokumen_final_pk($pkkode)
  {
    $data = array(
      'isuploaded' => '1'
    );
    $this->db->where('ejbcsp',$pkkode);
    return $this->db->update($this->table, $data);
  }


  function get_pk_from_barcode ($bc, $status = 0) {
    $this->db->select('p.bantuanpp, p.backtoid, p.ejbcsp, p.mjnama, p.jomkthn, p.jomkbln, p.jomkhr, tk.tknama, jp.namajenispekerjaan, ag.agnama, ag.agid, pp.ppkode, pp.ppnama, p.isverified, p.isuploaded, p.pktimestamp');
    $this->db->from('entryjo p');
    $this->db->order_by("p.pktimestamp", "desc");
    $this->db->join('magensi ag', 'ag.agid = p.agid');
    $this->db->join('mpptkis pp', 'pp.ppkode = p.ppkode');
    $this->db->join('tki tk', 'tk.ejid = p.ejid');
    $this->db->join('jenispekerjaan jp', 'jp.idjenispekerjaan = p.idjenispekerjaan');
    if($status > 0)
    {
      $this->db->where('p.jenispk', $status);
    }
    $this->db->where('p.idinstitution', $this->session->userdata('institution'));
    $this->db->where('p.idkantor', $this->session->userdata('kantor'));
    $this->db->where('p.ejbcsp', $bc);
    $this->db->or_where('p.ejbcform', $bc);
    $this->db->or_where('p.ejbcsk', $bc);

    return $this->db->get()->result();
  }

  function get_pk_for_report($bc, $status = 0) {
    $this->db->select('*');
    $this->db->from('entryjo p');
    $this->db->order_by("p.pktimestamp", "desc");
    $this->db->join('magensi ag', 'ag.agid = p.agid');
    $this->db->join('mpptkis pp', 'pp.ppkode = p.ppkode');
    $this->db->join('tki tk', 'tk.ejid = p.ejid');
    $this->db->join('jenispekerjaan jp', 'jp.idjenispekerjaan = p.idjenispekerjaan');
    if($status > 0)
    {
      $this->db->where('p.jenispk', $status);
    }
    $this->db->where('p.idinstitution', $this->session->userdata('institution'));
    $this->db->where('p.idkantor', $this->session->userdata('kantor'));
    $this->db->where('p.ejbcsp', $bc);
    $this->db->or_where('p.ejbcform', $bc);
    $this->db->or_where('p.ejbcsk', $bc);

    return $this->db->get()->result_array();
  }  

  function last_pk($agid, $ppkode)
  {
    $this->db->select('mjktp, mjnama, mjnamacn, mjalmt, mhalmtcn, mjtelp, mjfax, mjpngjwb, mjpngjwbcn');
    $this->db->order_by('pktimestamp', 'desc');
    $this->db->where('agid', $agid);
    $this->db->where('ppkode', $ppkode);
    return $this->db->get($this->table)->row();
  }

  function query_paspor($paspor)
  {
    $this->db->select('tk.*, ej.jpgaji, ej.mjktp, ej.mjnama, ej.mjnamacn, ej.mjalmt, ej.mjalmtcn, ej.mjtelp, ej.mjfax, ej.mjpngjwb, ej.mjpngjwbcn, ej.ppkode, ej.agid, ej.idjenispekerjaan');
    $this->db->where('tk.tkpaspor', $paspor);
    $this->db->from('entryjo ej, tki tk');
    return $this->db->get()->row();
  }

  function legalize_barcode($bc){
    $this->db->where('isverified', 1);
    $this->db->where('idinstitution', $this->session->userdata('institution'));
    $this->db->where('idkantor', $this->session->userdata('kantor'));
    $this->db->where('ejbcsp', $bc);
    $this->db->or_where('ejbcform', $bc);
    $this->db->or_where('ejbcsk', $bc);

    if ($this->db->get($this->table)->num_rows() > 0)
    {
      return FALSE;
    }
    else {
      $data = array(
        'isverified' => 1,
        'ejtglendorsement' => date("Y-m-d")
      );

      $this->db->where('idinstitution', $this->session->userdata('institution'));
      $this->db->where('idkantor', $this->session->userdata('kantor'));
      $this->db->where('ejbcsp', $bc);
      $this->db->or_where('ejbcform', $bc);
      $this->db->or_where('ejbcsk', $bc);
      return $this->db->update($this->table, $data);
    }
  }

}
