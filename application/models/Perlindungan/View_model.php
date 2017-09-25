<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function get_officer_name($petugas) {
		$this->db->select('name');
		$this->db->from('user');
		$this->db->where('username',$petugas);
		$query = $this->db->get();

		return $query;
	}

	function get_sheltername($idshelter) {
		$this->db->select('name');
		$this->db->from('shelter');
		$this->db->where('id', $idshelter);
		$query = $this->db->get();

		return $query;
	}

	function data_year_process($year,$institution=NULL) {
		$this->db->select('m.idmasalah, m.tanggalpengaduan, t.namatki, t.paspor, m.statustki');
		$this->db->select('k.name AS klasifikasi, j.namajenispekerjaan AS jenis, u.name AS nama');
		$this->db->select('count(t.idtkimasalah) as jumlah, DATEDIFF(CURDATE(), m.tanggalpengaduan ) as lama');
		$this->db->from('masalah m, tkimasalah t, klasifikasi k, jenispekerjaan j, user u');
		$this->db->where('m.idmasalah = t.idmasalah');
		$this->db->where('m.idklasifikasi = k.id');
		$this->db->where('m.idjenispekerjaan = j.idjenispekerjaan');
		$this->db->where('m.petugaspenanganan = u.username');
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		if($institution)
		{
			$this->db->where('m.idinstitution', $institution);
		}
		$this->db->where('m.statusmasalah',1);
		$this->db->where('m.enable',1);
		$this->db->group_by('m.idmasalah');
		$this->db->order_by('m.tanggalpengaduan','DESC');
		$query = $this->db->get();

		return $query;
	}

	function data_year_finish($year,$institution=NULL) {
		$this->db->select('m.idmasalah, m.tanggalpengaduan, t.namatki, t.paspor, m.statustki');
		$this->db->select('k.name AS klasifikasi, j.namajenispekerjaan AS jenis, u.name AS nama');
		$this->db->select('count(t.idtkimasalah) as jumlah, DATEDIFF(CURDATE(), m.tanggalpengaduan ) as lama');
		$this->db->from('masalah m, tkimasalah t, klasifikasi k, jenispekerjaan j, user u');
		$this->db->where('m.idmasalah = t.idmasalah');
		$this->db->where('m.idklasifikasi = k.id');
		$this->db->where('m.idjenispekerjaan = j.idjenispekerjaan');
		$this->db->where('m.petugaspenanganan = u.username');
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		if($institution)
		{
			$this->db->where('m.idinstitution', $institution);
		}
		$this->db->where('m.statusmasalah',2);
		$this->db->where('m.enable',1);
		$this->db->group_by('m.idmasalah');
		$this->db->order_by('m.tanggalpengaduan','DESC');
		$query = $this->db->get();

		return $query;
	}


	function data_month_process($month,$year,$institution=NULL) {
		$this->db->select('m.idmasalah, m.tanggalpengaduan, t.namatki, t.paspor, m.statustki');
		$this->db->select('k.name AS klasifikasi, j.namajenispekerjaan AS jenis, u.name AS nama');
		$this->db->select('count(t.idtkimasalah) as jumlah, DATEDIFF(CURDATE(), m.tanggalpengaduan ) as lama');
		$this->db->from('masalah m, tkimasalah t, klasifikasi k, jenispekerjaan j, user u');
		$this->db->where('m.idmasalah = t.idmasalah');
		$this->db->where('m.idklasifikasi = k.id');
		$this->db->where('m.idjenispekerjaan = j.idjenispekerjaan');
		$this->db->where('m.petugaspenanganan = u.username');
		$this->db->where('MONTH(m.tanggalpengaduan)', $month);
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		if($institution)
		{
			$this->db->where('m.idinstitution', $institution);
		}
		$this->db->where('m.statusmasalah',1);
		$this->db->where('m.enable',1);
		$this->db->group_by('m.idmasalah');
		$this->db->order_by('m.tanggalpengaduan','DESC');
		$query = $this->db->get();

		return $query;
	}

	function data_month_finish($month,$year,$institution=NULL) {
		$this->db->select('m.idmasalah, m.tanggalpengaduan, t.namatki, t.paspor, m.statustki');
		$this->db->select('k.name AS klasifikasi, j.namajenispekerjaan AS jenis, u.name AS nama');
		$this->db->select('count(t.idtkimasalah) as jumlah, DATEDIFF(CURDATE(), m.tanggalpengaduan ) as lama');
		$this->db->from('masalah m, tkimasalah t, klasifikasi k, jenispekerjaan j, user u');
		$this->db->where('m.idmasalah = t.idmasalah');
		$this->db->where('m.idklasifikasi = k.id');
		$this->db->where('m.idjenispekerjaan = j.idjenispekerjaan');
		$this->db->where('m.petugaspenanganan = u.username');
		$this->db->where('MONTH(m.tanggalpengaduan)', $month);
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		$this->db->where('m.statusmasalah',2);
		if($institution)
		{
			$this->db->where('m.idinstitution', $institution);
		}
		$this->db->where('m.enable',1);
		$this->db->group_by('m.idmasalah');
		$this->db->order_by('m.tanggalpengaduan','DESC');
		$query = $this->db->get();

		return $query;
	}

	function data_officer_process($petugas,$year) {
		$this->db->select('m.idmasalah, m.tanggalpengaduan, t.namatki, t.paspor, m.statustki');
		$this->db->select('k.name AS klasifikasi, j.namajenispekerjaan AS jenis');
		$this->db->select('count(t.idtkimasalah) as jumlah, DATEDIFF(CURDATE(), m.tanggalpengaduan ) as lama');
		$this->db->from('masalah m, tkimasalah t, klasifikasi k, jenispekerjaan j, user u');
		$this->db->where('m.idmasalah = t.idmasalah');
		$this->db->where('m.idklasifikasi = k.id');
		$this->db->where('m.idjenispekerjaan = j.idjenispekerjaan');
		$this->db->where('m.petugaspenanganan = u.username');
		$this->db->where('m.petugaspenanganan',$petugas);
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		$this->db->where('m.statusmasalah',1);
		$this->db->where('m.enable',1);
		$this->db->group_by('m.idmasalah');
		$this->db->order_by('m.tanggalpengaduan','DESC');
		$query = $this->db->get();

		return $query;
	}

	function data_officer_finish($petugas,$year) {
		$this->db->select('m.idmasalah, m.tanggalpengaduan, t.namatki, t.paspor, m.statustki');
		$this->db->select('k.name AS klasifikasi, j.namajenispekerjaan AS jenis');
		$this->db->select('count(t.idtkimasalah) as jumlah, DATEDIFF(CURDATE(), m.tanggalpengaduan ) as lama');
		$this->db->from('masalah m, tkimasalah t, klasifikasi k, jenispekerjaan j, user u');
		$this->db->where('m.idmasalah = t.idmasalah');
		$this->db->where('m.idklasifikasi = k.id');
		$this->db->where('m.idjenispekerjaan = j.idjenispekerjaan');
		$this->db->where('m.petugaspenanganan = u.username');
		$this->db->where('m.petugaspenanganan',$petugas);
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		$this->db->where('m.statusmasalah',2);
		$this->db->where('m.enable',1);
		$this->db->group_by('m.idmasalah');
		$this->db->order_by('m.tanggalpengaduan','DESC');
		$query = $this->db->get();

		return $query;
	}

	function data_shelterprocess($idshelter, $year) {
		$this->db->select('m.idmasalah, m.tanggalpengaduan, t.namatki, t.paspor, m.statustki');
		$this->db->select('k.name AS klasifikasi, j.namajenispekerjaan AS jenis, u.name AS nama');
		$this->db->select('count(t.idtkimasalah) as jumlah, DATEDIFF(CURDATE(), m.tanggalpengaduan ) as lama');
		$this->db->from('masalah m, tkimasalah t, klasifikasi k, jenispekerjaan j, user u');
		$this->db->where('m.idmasalah = t.idmasalah');
		$this->db->where('m.idklasifikasi = k.id');
		$this->db->where('m.idjenispekerjaan = j.idjenispekerjaan');
		$this->db->where('m.petugaspenanganan = u.username');
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		$this->db->where('m.statusmasalah',1);
		$this->db->where('m.enable',1);
		$this->db->where('m.idshelter', $idshelter);
		$this->db->group_by('m.idmasalah');
		$this->db->order_by('m.tanggalpengaduan','DESC');
		$query = $this->db->get();

		return $query;
	}

	function data_shelterfinish($idshelter, $year) {
		$this->db->select('m.idmasalah, m.tanggalpengaduan, t.namatki, t.paspor, m.statustki');
		$this->db->select('k.name AS klasifikasi, j.namajenispekerjaan AS jenis, u.name AS nama');
		$this->db->select('count(t.idtkimasalah) as jumlah, DATEDIFF(CURDATE(), m.tanggalpengaduan ) as lama');
		$this->db->from('masalah m, tkimasalah t, klasifikasi k, jenispekerjaan j, user u');
		$this->db->where('m.idmasalah = t.idmasalah');
		$this->db->where('m.idklasifikasi = k.id');
		$this->db->where('m.idjenispekerjaan = j.idjenispekerjaan');
		$this->db->where('m.petugaspenanganan = u.username');
		$this->db->where('YEAR(m.tanggalpengaduan)',$year);
		$this->db->where('m.statusmasalah',2);
		$this->db->where('m.enable',1);
		$this->db->where('m.idshelter', $idshelter);
		$this->db->group_by('m.idmasalah');
		$this->db->order_by('m.tanggalpengaduan','DESC');
		$query = $this->db->get();

		return $query;
	}
}
