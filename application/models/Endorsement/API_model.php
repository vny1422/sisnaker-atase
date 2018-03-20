<?php
class API_model extends CI_Model {
  public function __construct()
  {
    $this->load->database('default');
  }

  ############JO#####################
  function getJOByDate ($date) {
    $this->db->select('j.jobid, j.agid, j.ppkode, j.jobno, j.jobtglawal, j.jobtglakhir');
    $this->db->from('jo j');
    $this->db->order_by("j.jobid", "asc");
    $this->db->where("STR_TO_DATE('$date', '%Y-%m-%d') BETWEEN jobtglawal AND jobtglakhir");
    return $this->db->get()->result();
  }

  function getEntryJoByBarcodeSuratPermintaan($barcode) {
    $this->db->select('ej.ejid,
    ej.idjenispekerjaan,
    ag.agnama,
    ag.agnamaoth,
    ag.agnoijincla,
    ag.agalmtkantor,
    ag.agalmtkantoroth,
    ag.agpngjwb,
    ag.agpngjwboth,
    ag.agtelp,
    ag.agfax,
    ej.mjktp,
    ej.mjnama,
    ej.mjnamacn,
    ej.mjalmt,
    ej.mjalmtcn,
    ej.mjtelp,
    ej.mjfax,
    ej.mjpngjwb,
    ej.mjpngjwbcn,
    pp.ppnama,
    pp.ppalmtkantor,
    pp.pptelp,
    pp.ppfax,
    pp.ppijin,
    pp.pppngjwb,
    ej.joclano,
    ej.joclatgl,
    ej.joestduedate,
    ej.jojmltki,
    ej.jomkthn,
    ej.jomkbln,
    ej.jomkhr,
    ej.jocatatan,
    ej.joposisi,
    ej.joposisicn,
    ej.joakomodasi,
    ej.ejtglendorsement,
    ej.ejdatefilled,
    ej.jpgaji,
    ej.jpakomodasi');
    $this->db->from('entryjo ej');
    $this->db->join('magensi ag', 'ag.agid = ej.agid');
    $this->db->join('mpptkis pp', 'pp.ppkode = ej.ppkode');
    $this->db->where('ej.ejbcsp', $barcode);
    return $this->db->get()->result();
  }

  function getEntryJoByBarcodeSuratKuasa($barcode) {
    $this->db->select('ej.ejid,
    ej.idjenispekerjaan,
    ag.agnama,
    ag.agnamaoth,
    ag.agnoijincla,
    ag.agalmtkantor,
    ag.agalmtkantoroth,
    ag.agpngjwb,
    ag.agpngjwboth,
    ag.agtelp,
    ag.agfax,
    ej.mjktp,
    ej.mjnama,
    ej.mjnamacn,
    ej.mjalmt,
    ej.mjalmtcn,
    ej.mjtelp,
    ej.mjfax,
    ej.mjpngjwb,
    ej.mjpngjwbcn,
    pp.ppnama,
    pp.ppalmtkantor,
    pp.pptelp,
    pp.ppfax,
    pp.ppijin,
    pp.pppngjwb,
    ej.joclano,
    ej.joclatgl,
    ej.joestduedate,
    ej.jojmltki,
    ej.jomkthn,
    ej.jomkbln,
    ej.jomkhr,
    ej.jocatatan,
    ej.joposisi,
    ej.joposisicn,
    ej.joakomodasi,
    ej.ejtglendorsement,
    ej.ejdatefilled,
    ej.jpgaji,
    ej.jpakomodasi');
    $this->db->from('entryjo ej');
    $this->db->join('magensi ag', 'ag.agid = ej.agid');
    $this->db->join('mpptkis pp', 'pp.ppkode = ej.ppkode');
    $this->db->where('ej.ejbcsk', $barcode);
    return $this->db->get()->result();
  }

  function getDataTkiByEjid($ejid) {
    $this->db->select('t.tkid,
    t.tknama,
    t.tknamacn,
    t.tkalmtid,
    t.tkpaspor,
    t.tktglkeluar,
    t.tktmptkeluar,
    t.tktgllahir,
    t.tktmptlahir,
    t.tkjk,
    t.tkstatkwn,
    t.tkjmlanaktanggungan,
    t.tkahliwaris,
    t.tknama2,
    t.tknamacn2,
    t.tkalmt2,
    t.tkalmtcn2,
    t.tktelp,
    t.tkhub,
    t.tkstat,
    t.tkrevid,
    t.tktglubah,
    t.tktglendorsement,
    t.tktglendorsement2,
    t.tkiid');
    $this->db->from('tki t');
    $this->db->where('t.ejid', $ejid);
    return $this->db->get()->result();

  }

  function getDataTkiByBarcode($barcode) {
    $this->db->select('t.tkid,
    t.tknama,
    t.tknamacn,
    t.tkalmtid,
    t.tkpaspor,
    t.tktglkeluar,
    t.tktmptkeluar,
    t.tktgllahir,
    t.tktmptlahir,
    t.tkjk,
    t.tkstatkwn,
    t.tkjmlanaktanggungan,
    t.tkahliwaris,
    t.tknama2,
    t.tknamacn2,
    t.tkalmt2,
    t.tkalmtcn2,
    t.tktelp,
    t.tkhub,
    t.tkstat,
    t.tkrevid,
    t.tktglubah,
    t.tktglendorsement,
    t.tktglendorsement2,
    t.tkiid');
    $this->db->from('tki t');
    $this->db->where('t.tkbc', $barcode);
    return $this->db->get()->result();

  }

  function getPerjanjianKerjaByPaspor($paspor) {
    $this->db->select('t.tkid,
    t.tknama,
    t.tknamacn,
    t.tkalmtid,
    t.tkpaspor,
    t.tktglkeluar,
    t.tktmptkeluar,
    t.tktgllahir,
    t.tktmptlahir,
    t.tkjk,
    t.tkstatkwn,
    t.tkjmlanaktanggungan,
    t.tkahliwaris,
    t.tknama2,
    t.tknamacn2,
    t.tkalmt2,
    t.tkalmtcn2,
    t.tktelp,
    t.tkhub,
    t.tkstat,
    t.tkrevid,
    t.tktglubah,
    t.tktglendorsement,
    t.tktglendorsement2,
    t.tkiid,
    t.tkbc,
    ej.ejid as ejid,
    ej.idjenispekerjaan,
    ag.agnama,
    ag.agnamaoth,
    ag.agnoijincla,
    ag.agalmtkantor,
    ag.agalmtkantoroth,
    ag.agpngjwb,
    ag.agpngjwboth,
    ag.agtelp,
    ag.agfax,
    ej.mjktp,
    ej.mjnama,
    ej.mjnamacn,
    ej.mjalmt,
    ej.mjalmtcn,
    ej.mjtelp,
    ej.mjfax,
    ej.mjpngjwb,
    ej.mjpngjwbcn,
    pp.ppnama,
    pp.ppalmtkantor,
    pp.pptelp,
    pp.ppfax,
    pp.ppijin,
    pp.pppngjwb,
    ej.joclano,
    ej.joclatgl,
    ej.joestduedate,
    ej.jojmltki,
    ej.jomkthn,
    ej.jomkbln,
    ej.jomkhr,
    ej.jocatatan,
    ej.joposisi,
    ej.joposisicn,
    ej.joakomodasi,
    ej.ejtglendorsement,
    ej.ejdatefilled,
    ej.jpgaji,
    ej.jpakomodasi,
    ej.ejtoken');
    $this->db->from('tki t');
    $this->db->join('entryjo ej', 'ej.ejid = t.ejid');
    $this->db->join('magensi ag', 'ej.agid = ag.agid');
    $this->db->join('mpptkis pp', 'ej.ppkode = pp.ppkode');
    $this->db->where('t.tkpaspor', $paspor);
    $this->db->where('tktglendorsement IS NOT NULL');
    $this->db->where('tkrevid IS NULL');
    $this->db->order_by("t.tkiid", "desc");
    $this->db->limit(0, 1);
    return $this->db->get()->result();
  }

  function getPerjanjianKerjaByBarcode($barcode) {
    $this->db->select('t.tkid,
    t.tknama,
    t.tknamacn,
    t.tkalmtid,
    t.tkpaspor,
    t.tktglkeluar,
    t.tktmptkeluar,
    t.tktgllahir,
    t.tktmptlahir,
    t.tkjk,
    t.tkstatkwn,
    t.tkjmlanaktanggungan,
    t.tkahliwaris,
    t.tknama2,
    t.tknamacn2,
    t.tkalmt2,
    t.tkalmtcn2,
    t.tktelp,
    t.tkhub,
    t.tkstat,
    t.tkrevid,
    t.tktglubah,
    t.tktglendorsement,
    t.tktglendorsement2,
    t.tkiid,
    t.tkbc,
    ej.ejid as ejid,
    ej.idjenispekerjaan,
    ag.agnama,
    ag.agnamaoth,
    ag.agnoijincla,
    ag.agalmtkantor,
    ag.agalmtkantoroth,
    ag.agpngjwb,
    ag.agpngjwboth,
    ag.agtelp,
    ag.agfax,
    ej.mjktp,
    ej.mjnama,
    ej.mjnamacn,
    ej.mjalmt,
    ej.mjalmtcn,
    ej.mjtelp,
    ej.mjfax,
    ej.mjpngjwb,
    ej.mjpngjwbcn,
    pp.ppnama,
    pp.ppalmtkantor,
    pp.pptelp,
    pp.ppfax,
    pp.ppijin,
    pp.pppngjwb,
    ej.joclano,
    ej.joclatgl,
    ej.joestduedate,
    ej.jojmltki,
    ej.jomkthn,
    ej.jomkbln,
    ej.jomkhr,
    ej.jocatatan,
    ej.joposisi,
    ej.joposisicn,
    ej.joakomodasi,
    ej.ejtglendorsement,
    ej.ejdatefilled,
    ej.jpgaji,
    ej.jpakomodasi,
    ej.ejtoken');
    $this->db->from('tki t');
    $this->db->join('entryjo ej', 'ej.ejid = t.ejid');
    $this->db->join('magensi ag', 'ej.agid = ag.agid');
    $this->db->join('mpptkis pp', 'ej.ppkode = pp.ppkode');
    $this->db->where('t.tkbc', $barcode);
    $this->db->order_by("t.tkiid", "desc");
    $this->db->limit(0, 1);
    return $this->db->get()->result();
  }

  function getIsAgensiCekalByAgid($agid) {
    $this->db->select('ca.castart, ca.caend, ag.agnama');
    $this->db->from('cekalagensi ca');
    $this->db->join('magensi ag', 'ag.agid = ca.agid');
    $this->db->where('ca.agid', $agid);
    return $this->db->get()->result();
  }

  function getIsPptkisCekalByPpkode($ppkode) {
    $this->db->select('cp.cpstart, cp.cpend, pp.ppnama');
    $this->db->from('cekalpptkis cp');
    $this->db->join('mpptkis pp', 'pp.ppkode = cp.ppkode');
    $this->db->where('cp.ppkode', $ppkode);
    return $this->db->get()->result();
  }

  function getJOByAgidPpkode ($agid, $ppkode) {
    $this->db->select('j.jobid, j.agid, j.ppkode, j.jobno, j.jobtglawal, j.jobtglakhir');
    $this->db->from('jo j');
    $this->db->order_by("j.jobtimestamp", "desc");
    $this->db->join('magensi ag', 'ag.agid = j.agid');
    $this->db->join('mpptkis pp', 'pp.ppkode = j.ppkode');
    $this->db->where('j.agid', $agid);
    $this->db->where('j.ppkode', $ppkode);
    return $this->db->get()->result();
  }

  function getJODetail ($jobid) {
    $this->db->select('j.jobdid, j.idjenispekerjaan, j.jobdl, j.jobdp, j.jobdc');
    $this->db->from('jodetail j');
    $this->db->order_by("j.jobdid", "asc");
    $this->db->where('j.jobid', $jobid);
    return $this->db->get()->result();
  }

  ############PK#######################
  function getPKByDate($date) {
    $this->db->where("ejtglendorsement = DATE_FORMAT('$date', '%Y-%m-%d')");
    $this->db->order_by('ejid', 'asc');
    return $this->db->get('entryjo')->result();
  }

  ###########TKI#######################
  function getTKI($ejid) {
    $this->db->where('ejid', $ejid);
    $this->db->order_by('tkid', 'asc');
    return $this->db->get('tki')->result();
  }

  ##########AGENSI CEKAL###############
  function getBlacklistAgenByDate($date)
  {
    $this->db->select('agid');
    $this->db->where("(STR_TO_DATE('$date', '%Y-%m-%d') BETWEEN castart AND caend) OR caend is NULL");
    return $this->db->get('cekalagensi')->result();
  }

  #############KEBERANGKATAN##################
  function pushKeberangkatan($post)
  {
      $db_debug = $this->db->db_debug;
      $data = array();
      foreach($post as $key => $value)
      {
        $data[$key] = $value;
      }
      $this->db->db_debug = false;
      $this->db->insert('keberangkatan', $data);
      $this->db->db_debug = $db_debug;
      return $this->db->insert_id();
  }

  function pushKepulangan($post)
  {
      $db_debug = $this->db->db_debug;
      $data = array();
      foreach($post as $key => $value)
      {
        $data[$key] = $value;
      }
      $this->db->db_debug = false;
      $this->db->insert('kepulangan', $data);
      $this->db->db_debug = $db_debug;
      return $this->db->insert_id();
  }
}
