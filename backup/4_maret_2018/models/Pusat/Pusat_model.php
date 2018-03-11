<?php
class Pusat_model extends CI_Model {
  function get_all_year()
  {
    $this->db->distinct();
    $this->db->select('YEAR(tktglendorsement) as tahun');
    $this->db->from('tki');
    $this->db->order_by('tktglendorsement','desc');
    return $this->db->get()->result();
  }

  function get_all_year_perlindungan()
  {
    $this->db->distinct();
    $this->db->select('YEAR(tanggalpengaduan) as tahun');
    $this->db->from('masalah');
    $this->db->order_by('tanggalpengaduan','desc');
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
    $this->db->select('jenispekerjaan.namajenispekerjaan, MONTHNAME(tki.tktglendorsement) month, count(*) count');
    $this->db->from('entryjo');
    $this->db->join('tki','entryjo.ejid = tki.ejid');
    $this->db->join('jenispekerjaan','entryjo.idjenispekerjaan = jenispekerjaan.idjenispekerjaan');
    $this->db->where('YEAR(tki.tktglendorsement)',$tahun);
    $this->db->where('tki.tkstat',0);
    $this->db->where('tki.tkrevid',NULL);
    if($institution != 'all')
    {
      $this->db->where('entryjo.idinstitution',$institution);
    }
    $this->db->group_by('jenispekerjaan.idjenispekerjaan, MONTH(tki.tktglendorsement)');

    return $this->db->get()->result();
  }

  function get_list_institutions_cases($tahun)
  {
    $this->db->select('i.nameinstitution, MONTHNAME(m.tanggalpengaduan) month, count(*) count');
    $this->db->from('institution i, masalah m');
    $this->db->where('i.idinstitution = m.idinstitution');
    $this->db->where('YEAR(m.tanggalpengaduan)',$tahun);
    $this->db->where('i.nameinstitution !=', 'Pusat');
    $this->db->where('i.isactive', 1);
    $this->db->group_by('i.idinstitution, MONTH(m.tanggalpengaduan)');

    return $this->db->get()->result();
  }

  function get_list_institutions_placements($tahun)
  {
    $this->db->select('i.nameinstitution, MONTHNAME(tk.tktglendorsement) month, count(*) count');
    $this->db->from('institution i, entryjo ej, tki tk');
    $this->db->where('i.idinstitution = ej.idinstitution');
    $this->db->where('ej.ejid = tk.ejid');
    $this->db->where('YEAR(tk.tktglendorsement)',$tahun);
    $this->db->where('i.nameinstitution !=', 'Pusat');
    $this->db->where('i.isactive', 1);
    $this->db->where('tk.tkstat',0);
    $this->db->where('tk.tkrevid',NULL);
    $this->db->group_by('i.idinstitution, MONTH(tk.tktglendorsement)');

    return $this->db->get()->result();
  }
}
