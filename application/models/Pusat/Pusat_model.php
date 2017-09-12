<?php
class Pusat_model extends CI_Model {
  function get_all_year(){
  $this->db->distinct();
  $this->db->select('YEAR(tktglendorsement) as tahun');
  $this->db->from('tki');
  $this->db->order_by('tktglendorsement','desc');
  return $this->db->get()->result();
}

  function get_jk_this_year($tahun,$institution)
  {
    $this->db->select('tki.tkjk, COUNT(*) as total');
    $this->db->from('entryjo');
    $this->db->join('tki','entryjo.ejid = tki.ejid');
    $this->db->where('tki.tkstat',0);
    $this->db->where('tki.tkrevid',NULL);
    $where = "tki.tktglendorsement LIKE '%".$tahun."-%'";
    $this->db->where($where);
    if($institution != 'all')
    {
      $this->db->where('entryjo.idinstitution',$institution);
    }
    $this->db->group_by('tki.tkjk');
    return $this->db->get()->result();
  }

  function get_jk_this_month($tahun,$bulan,$institution)
  {
    $this->db->select('tki.tkjk, COUNT(*) as total');
    $this->db->from('entryjo');
    $this->db->join('tki','entryjo.ejid = tki.ejid');
    $this->db->where('tki.tkstat',0);
    $this->db->where('tki.tkrevid',NULL);
    $where = "tki.tktglendorsement LIKE '%".$tahun."-".$bulan."-%'";
    $this->db->where($where);
    if($institution != 'all')
    {
      $this->db->where('entryjo.idinstitution',$institution);
    }
    $this->db->group_by('tki.tkjk');
    return $this->db->get()->result();
  }

  function get_sektor_this_year($tahun,$institution)
  {
    $this->db->select('jenispekerjaan.sektor, COUNT(*) as total');
    $this->db->from('entryjo');
    $this->db->join('tki','entryjo.ejid = tki.ejid');
    $this->db->join('jenispekerjaan','entryjo.idjenispekerjaan = jenispekerjaan.idjenispekerjaan');
    $this->db->where('tki.tkstat',0);
    $this->db->where('tki.tkrevid',NULL);
    $where = "tki.tktglendorsement LIKE '%".$tahun."-%'";
    $this->db->where($where);
    if($institution != 'all')
    {
      $this->db->where('entryjo.idinstitution',$institution);
    }
    $this->db->group_by('jenispekerjaan.sektor');
    return $this->db->get()->result();
  }

  function get_sektor_this_month($tahun,$bulan,$institution)
  {
    $this->db->select('jenispekerjaan.sektor, COUNT(*) as total');
    $this->db->from('entryjo');
    $this->db->join('tki','entryjo.ejid = tki.ejid');
    $this->db->join('jenispekerjaan','entryjo.idjenispekerjaan = jenispekerjaan.idjenispekerjaan');
    $this->db->where('tki.tkstat',0);
    $this->db->where('tki.tkrevid',NULL);
    $where = "tki.tktglendorsement LIKE '%".$tahun."-".$bulan."-%'";
    $this->db->where($where);
    if($institution != 'all')
    {
      $this->db->where('entryjo.idinstitution',$institution);
    }
    $this->db->group_by('jenispekerjaan.sektor');
    return $this->db->get()->result();
  }

  function get_list_jp_this_year($tahun,$institution)
  {
    $this->db->distinct();
    $this->db->select('jenispekerjaan.namajenispekerjaan');
    $this->db->from('entryjo');
    $this->db->join('tki','entryjo.ejid = tki.ejid');
    $this->db->join('jenispekerjaan','entryjo.idjenispekerjaan = jenispekerjaan.idjenispekerjaan');
    $this->db->where('tki.tkstat',0);
    $this->db->where('tki.tkrevid',NULL);
    $where = "tki.tktglendorsement LIKE '%".$tahun."-%'";
    $this->db->where($where);
    if($institution != 'all')
    {
      $this->db->where('entryjo.idinstitution',$institution);
    }
    return $this->db->get()->result();
  }

  function count_jp_this_month($tahun,$bulan,$namajp,$institution)
  {
    $this->db->select('*');
    $this->db->from('entryjo');
    $this->db->join('tki','entryjo.ejid = tki.ejid');
    $this->db->join('jenispekerjaan','entryjo.idjenispekerjaan = jenispekerjaan.idjenispekerjaan');
    if($institution != 'all')
    {
      $this->db->where('entryjo.idinstitution',$institution);
    }
    $this->db->where('tki.tkstat',0);
    $this->db->where('tki.tkrevid',NULL);
    $this->db->where('MONTH(tki.tktglendorsement)',$bulan);
    $this->db->where('YEAR(tki.tktglendorsement)',$tahun);
    $this->db->where('jenispekerjaan.namajenispekerjaan',$namajp);
    return $this->db->count_all_results();
  }
}
