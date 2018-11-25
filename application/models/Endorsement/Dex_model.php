<?php
class Dex_model extends CI_Model {
  private $table = 'dex';
  public function __construct()
  {
    $this->load->database('default');
  }

  public function getEntry($kode_entry)
  {
  	$query = $this->db->get_where('entries',array('kode_entry' => $kode_entry));
  	return $query;
  }
  public function getAllEntry()
  {
    $this->db->select('*,nama_pekerja,no_paspor,CONCAT(nama_perusahaan_eng,"/",nama_perusahaan) as nama_perusahaan,pekerjaans.nama as pekerjaan,DATE_FORMAT(tgl_mulai, "%D-%M-%Y") tgl_mulai,DATE_FORMAT(tgl_selesai, "%D-%M-%Y") tgl_selesai,CONCAT(nama_majikan_eng,"/",nama_majikan) as nama_majikan,CONCAT(CASE WHEN is_terima=1 AND (is_tolak is NULL OR is_tolak=0) THEN "Terima" WHEN is_tolak=1 AND (is_terima is NULL OR is_terima=0) THEN "Tolak" ELSE "Belum Diverivikasi" END) as status');
    $this->db->from('entries');
    $this->db->join('pekerjaans', 'pekerjaans.id = entries.pekerjaan_id');
    $query = $this->db->get();
    return $query;
  }
  public function getAllKuitansi()
  {
    $this->db->select('*');
    $this->db->from('kuitansis');
    $this->db->join('entries', 'entries.id = kuitansis.entry_id');
    $query = $this->db->get();
    return $query;
  }

  public function getDocument($id_entry)
  {
  	$query = $this->db->get_where('files',array('entry_id' => $id_entry));
  	return $query;	
  }

  public function getKuitansi($id_entry)
  {
  	$query = $this->db->get_where('kuitansis',array('entry_id' => $id_entry));
  	return $query;	
  }

  public function getPekerjaan()
  {
  	$query = $this->db->get('pekerjaans');
  	return $query;
  }

  public function terimaEntry($id,$is_terima=false,$is_tolak=false)
  {
  	$this->db->set('is_terima',$is_terima);
  	$this->db->set('is_tolak',$is_tolak);
  	$this->db->where('id',$id);
  	$query = $this->db->update('entries');
  	return $query;
  }

  public function updateSalary($id,$batas_bawah,$batas_atas)
  {
  	$this->db->set('batas_bawah',unaccounting($batas_bawah));
  	$this->db->set('batas_atas',unaccounting($batas_atas));
  	$this->db->where('id',$id);
  	$query = $this->db->update('pekerjaans');
  	return $query;
  }
  public function simpanKuitansi($kode_entry,$entry_id,$no_kuitansi,$jumlah,$pemohon,$tgl_masuk,$tgl_kuitansi)
  {
    $this->db->set('username', $this->session->userdata('user'));
    $this->db->set('kuno', $no_kuitansi);
    $this->db->set('idtipe', 3);
    $this->db->set('idinstitution', 2);
    $this->db->set('kujmlbayar', unaccounting($jumlah));
    $this->db->set('kupemohon', $pemohon);
    $this->db->set('kutglmasuk', date_database($tgl_masuk)->format('Y-m-d'));
    $this->db->set('kukode', $kode_entry);
    $this->db->set('kutglkuitansi', date_database($tgl_kuitansi)->format('Y-m-d'));
    $query = $this->db->insert('kuitansi');
    if($query)
    {
	    $this->db->set('entry_id', $entry_id);
	    $this->db->set('no_kuitansi', $no_kuitansi);
	    $this->db->set('jumlah', unaccounting($jumlah));
	    $this->db->set('pemohon', $pemohon);
	    $this->db->set('tgl_masuk', date_database($tgl_masuk)->format('Y-m-d'));
	    $this->db->set('tgl_kuitansi', date_database($tgl_kuitansi)->format('Y-m-d'));
	    $query = $this->db->insert('kuitansis');
    }
    return $query;
  }

}
