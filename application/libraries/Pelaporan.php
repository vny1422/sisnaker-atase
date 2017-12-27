<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Pelaporan{

	public $filedir;

	public function __construct() {
		//parent::__construct();
		$this->CI =& get_instance();

		$this->CI->load->model('Perlindungan/Rekap_model');
		
		// Load PHPExcel
		$this->CI->load->library('Excel');

		$this->filedir = NULL;

	}

	public function generateDetail($time,$status,$idinstitution,$namainstitusi) {
		$m_name = array('01' => 'JANUARI', '02' => 'FEBRUARI',
			'03' => 'MARET','04' => 'APRIL','05' => 'MEI',
			'06' => 'JUNI','07' => 'JULI','08' => 'AGUSTUS',
			'09' => 'SEPTEMBER','10' => 'OKTOBER','11' => 'NOVEMBER',
			'12' => 'DESEMBER');

		// Time 
		$get_time = explode(',',$time);
		$arr_data = array();
		$arr_m 	  = array();
		$arr_y    = array();
		foreach ($get_time as $month_info) {
			$get_date = explode('/',$month_info);
			$m 		  = $get_date[1];
			$d 		  = $get_date[2];
			$y 		  = $get_date[0];

			$data = $this->CI->Rekap_model->get_detailrekap($m, $y, $status, NULL, $idinstitution);

			array_push($arr_data, $data);
			array_push($arr_m, $m);
			array_push($arr_y, $y);
		}

		$this->format_detailrekap($arr_data, $m_name, $arr_m, $arr_y, $status, $namainstitusi);
	}

	private function format_detailrekap($data, $m_name, $month, $year, $status, $namainstitusi) {
		$sjudul = array('1'=>'DalamProses','2'=>'Selesai','all'=>'All');
		$m_statusmasalah = array('1'=>'Dalam Proses','2'=>'Selesai');
		$maxm = 0;
		$maxy = 0;
		$mjudul = "";
		$yjudul = "";

		$objPHPExcel = new PHPExcel();
		$count = count($data);
		for($i=0; $i<$count; $i++) {
			$time_info = $m_name[$month[$i]].' '.$year[$i];
			$tempm = (int)$month[$i];
			$tempy = (int)$year[$i];
			if($tempy > $maxy){
				$maxy = $tempy;
				$maxm = 0;
				$yjudul = $year[$i];
				$mjudul = $m_name[$month[$i]];
			} else if($tempy == $maxy){
				if($tempm > $maxm){
					$maxm = $tempm;
					$mjudul = $m_name[$month[$i]];
				}
			}
			
			$objPHPExcel->setActiveSheetIndex($i)
			->setCellValue('A1', 'DATA KASUS ')
			->setCellValue('A2', 'BULAN '.$time_info)
			->setCellValue('A3','No')
			->setCellValue('B3', 'Nama TKI')
			->setCellValue('C3', 'No. Paspor')
			->setCellValue('D3', 'PJKTI')
			->setCellValue('E3', 'Agency')
			->setCellValue('F3', 'Permasalahan')
			->setCellValue('G3', 'Penyelesaian')
			->setCellValue('H3', 'Petugas')
			->setCellValue('I3', 'Media')
			->setCellValue('J3', 'Status');
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7.5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(11);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(18);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(18);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(24);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(24);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
			
			$objPHPExcel->getActiveSheet()->getStyle('A3:J3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A3:J3')->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
			->getStartColor()->setARGB('D1D1D1');
			$style_big_header = array(
				'font' => array('bold' => true,'name' => 'Tahoma','size' => 14),			
				'alignment' => array ('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
				);
			
			$style_small_header = array(
				'font' => array('name' => 'Tahoma','size' => 11),			
				'alignment' => array ('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
				);
			
			$style_border = array(
				'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))
				);
			
			$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($style_big_header);
			$objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($style_small_header);
			
			$objPHPExcel->getActiveSheet()->mergeCells('A1:J1')
			->mergeCells('A2:J2');
			
			$baserow = 3;
			$number = 0;			
			foreach ($data[$i] as $row) {
				$baserow = $baserow + 1;
				$number  = $number + 1;
				
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$baserow,$number)
				->setCellValue('B'.$baserow,$row['namatki'])
				->setCellValue('C'.$baserow,$row['paspor'])
				->setCellValue('D'.$baserow,$row['pptkis'])
				->setCellValue('E'.$baserow,$row['agensi'])
				->setCellValue('F'.$baserow,$row['permasalahan'])
				->setCellValue('G'.$baserow,$row['tindaklanjut'])
				->setCellValue('H'.$baserow,$row['nama'])
				->setCellValue('I'.$baserow,$row['media'])
				->setCellValue('J'.$baserow,$m_statusmasalah[$row['statusmasalah']]);
				
				$objPHPExcel->getActiveSheet()->getStyle('A'.$baserow.':J'.$baserow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$baserow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('C'.$baserow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('I'.$baserow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$baserow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$baserow)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$baserow)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$baserow)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$baserow)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$baserow)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('G'.$baserow)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('I'.$baserow)->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$baserow)->getAlignment()->setWrapText(true);
				
			}
			
			$objPHPExcel->getActiveSheet()->getStyle('A3:J'.$baserow)->applyFromArray($style_border);
			$objPHPExcel->getSheet($i)->setTitle($time_info);
			$objPHPExcel->createSheet();
			
		}
		
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToPage(true);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);

		$fname = "rekap_Kasus_".$namainstitusi."_".$sjudul[$status]."_".$mjudul."_".$yjudul.".xlsx";
		
		// Redirect output to a client(Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$fname.'"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}

	public function generateBulananv2($time,$infos,$idinstitution,$namainstitusi) {
		$m_name = array('01' => 'JANUARI', '02' => 'FEBRUARI',
			'03' => 'MARET','04' => 'APRIL','05' => 'MEI',
			'06' => 'JUNI','07' => 'JULI','08' => 'AGUSTUS',
			'09' => 'SEPTEMBER','10' => 'OKTOBER','11' => 'NOVEMBER',
			'12' => 'DESEMBER');
		$maxm = 0;
		$maxy = 0;
		$mjudul = "";
		$yjudul = "";

		$objPHPExcel = new PHPExcel();
        $objPHPExcel->removeSheetByIndex(0);

		foreach ($infos as $info) {
			$get_time = explode(',',$time);

			foreach ($get_time as $month_info) {
				$get_date = explode('/',$month_info);
				$m 		  = $get_date[1];
				$d 		  = $get_date[2];
				$y 		  = $get_date[0];

				$tempm = (int)$m;
				$tempy = (int)$y;
				if($tempy > $maxy){
					$maxy = $tempy;
					$maxm = 0;
					$yjudul = $y;
					$mjudul = $m_name[$m];
				} else if($tempy == $maxy){
					if($tempm > $maxm){
						$maxm = $tempm;
						$mjudul = $m_name[$m];
					}
				}

				switch ($info) {
					case 'jenis':							
					list($namaperjenis,$hasilperjenis,$namaperklasifikasi,$hasilperklasifikasi) = $this->get_jenis_basedv2($m, $y,$idinstitution);
					$objPHPExcel = $this->format_jenis_basedv2($objPHPExcel,$namainstitusi,
						$namaperjenis,$hasilperjenis,$namaperklasifikasi,$hasilperklasifikasi,
						$m_name, $m, $y);
					break;

					case 'sektor':
					list($hasilpersektor,$namaperklasifikasi,$hasilperklasifikasi) = $this->get_sektor_basedv2($m,$y,$idinstitution);
					$objPHPExcel = $this->format_sector_basedv2($objPHPExcel,$namainstitusi,
						$hasilpersektor,$namaperklasifikasi,$hasilperklasifikasi,
						$m_name, $m, $y);
					break;

					case 'status':
					list($hasilperstatus,$namaperklasifikasi,$hasilperklasifikasi) = $this->get_status_basedv2($m,$y,$idinstitution);
					$objPHPExcel = $this->format_status_basedv2($objPHPExcel,$namainstitusi,
						$hasilperstatus,$namaperklasifikasi,$hasilperklasifikasi,
						$m_name, $m, $y);
					break;
				}
			}
		}

		$fname = "rekap_Bulan_".$namainstitusi."_".$mjudul."_".$yjudul.".xlsx";
		$this->aggregate_rekap($objPHPExcel,$fname,FALSE);
	}

	private function get_jenis_basedv2($month,$year,$idinstitution) {
		$get_jenis = $this->CI->Rekap_model->get_work_type();
		$namaperjenis = array();
		$hasilperjenis = array();
		$get_classification = $this->CI->Rekap_model->get_classification();
		$namaperklasifikasi = array();
		$hasilperklasifikasi = array();

		// LOOPING BERDASARKAN JENIS 
		foreach($get_jenis->result() as $row_jenis) {
			$jumlah_pool = array();
			foreach($get_classification->result() as $row_class) {
				$jumlah = $this->CI->Rekap_model
				->count_based_typeclass($row_jenis->idjenispekerjaan,
					$row_class->id,
					$month,$year,$idinstitution);
				array_push($jumlah_pool, $jumlah);
			}
			
			// Get all problem (process + finished), finished, processed
			$jumlah_type_based = $this->CI->Rekap_model
			->count_aggregate('m.idjenispekerjaan',$row_jenis->idjenispekerjaan,$month,$year,$idinstitution);
			$result = array_merge($jumlah_pool, $jumlah_type_based);
			array_push($namaperjenis, $row_jenis->namajenispekerjaan);
			array_push($hasilperjenis, $result);
		}

		// LOOPING BERDASARKAN KLASIFIKASI
		foreach ($get_classification->result() as $row_class) {
			$jumlah = $this->CI->Rekap_model
			->count_aggregate('m.idklasifikasi',$row_class->id,$month,$year,$idinstitution);
			array_push($namaperklasifikasi, $row_class->name);
			array_push($hasilperklasifikasi, $jumlah);
		}
		
		return array($namaperjenis,$hasilperjenis,$namaperklasifikasi,$hasilperklasifikasi);
	}

	private function get_sektor_basedv2($month,$year,$idinstitution) {
		/*
		 * 1. Informal
		 * 2. Formal
		 * */
		$arr_sector = array('2','1');
		$get_classification = $this->CI->Rekap_model->get_classification();
		
		$hasilpersektor = array();
		foreach ($arr_sector as $sector) {
			$jumlah_pool = array();
			foreach ($get_classification->result() as $row_class) {
				$jumlah = $this->CI->Rekap_model
				->count_sector_based_class($sector,$row_class->id,
					$month,$year,$idinstitution);
				array_push($jumlah_pool,$jumlah);
			}
			
			// Get all problems (finished+processed), finished, processed
			$jumlah_sektor_aggregate = $this->CI->Rekap_model
			->count_aggregate('sektor',$sector,$month,$year,$idinstitution);
			$result = array_merge($jumlah_pool,$jumlah_sektor_aggregate);
			array_push($hasilpersektor,$result);
		}
		
		$hasilperklasifikasi = array();
		$namaperklasifikasi = array();
		foreach ($get_classification->result() as $row_class) {
			$jumlah = $this->CI->Rekap_model
			->count_aggregate('m.idklasifikasi',$row_class->id,$month,$year,$idinstitution);
			array_push($namaperklasifikasi, $row_class->name);
			array_push($hasilperklasifikasi,$jumlah);
		}
		
		return array($hasilpersektor,$namaperklasifikasi,$hasilperklasifikasi);
	}

	private function get_status_basedv2($month,$year,$idinstitution) {
		/*
		 * 1. Resmi
		 * 2. Kaburan
		 * */
		$arr_status = array('1','2');
		$get_classification = $this->CI->Rekap_model->get_classification();
		
		$hasilperstatus = array();
		foreach ($arr_status as $status) {
			$jumlah_pool = array();
			foreach ($get_classification->result() as $row_class) {
				$jumlah = $this->CI->Rekap_model
				->count_status_based_class($status,$row_class->id,$month,$year,$idinstitution);
				array_push($jumlah_pool,$jumlah);
			}
			
			$jumlah_status_aggregate = $this->CI->Rekap_model
			->count_aggregate('m.statustki',$status,$month,$year,$idinstitution);
			$result = array_merge($jumlah_pool,$jumlah_status_aggregate);
			array_push($hasilperstatus,$result);
		}
		
		$hasilperklasifikasi = array();
		$namaperklasifikasi = array();
		foreach ($get_classification->result() as $row_class) {
			$jumlah = $this->CI->Rekap_model
			->count_aggregate('m.idklasifikasi',$row_class->id,$month,$year,$idinstitution);
			array_push($namaperklasifikasi, $row_class->name);
			array_push($hasilperklasifikasi,$jumlah);
		}
		
		return array($hasilperstatus,$namaperklasifikasi,$hasilperklasifikasi);
	}

	private function format_jenis_basedv2($phpexcelpool,$namainstitusi,$namaperjenis,$hasilperjenis,
		$namaperklasifikasi,$hasilperklasifikasi,
		$m_name,$month,$year) {

		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->setCellValue('A1','LAPORAN BULANAN PENGADUAN KASUS (PERMASALAHAN) TKI INSTITUSI '.strtoupper($namainstitusi));
		$objPHPExcel->getActiveSheet()->setCellValue('A2','JENIS PEKERJAAN TENAGA KERJA INDONESIA');
		$objPHPExcel->getActiveSheet()->setCellValue('A3', $m_name[$month].' '.$year);
		$objPHPExcel->getActiveSheet()->setCellValue('A4', 'Waktu Cetak: '.date('d').' '.ucfirst(strtolower($m_name[date('m')])).' '.date('Y'));

		$objPHPExcel->getActiveSheet()->setCellValue('A5', 'NO');
		$objPHPExcel->getActiveSheet()->setCellValue('B5', 'JENIS PEKERJAAN');
		$objPHPExcel->getActiveSheet()->setCellValue('C5', 'JENIS KASUS (PERMASALAHAN)');

		$jmlklasifikasi = count($namaperklasifikasi);
		$letters = "C";
		$endletterskl = "";
		for($i=0; $i<$jmlklasifikasi; $i++){
			$num = $i + 1;
			$objPHPExcel->getActiveSheet()->setCellValue($letters.'6', $namaperklasifikasi[$i]);
			$objPHPExcel->getActiveSheet()->setCellValue($letters.'7', $num);
			if($i == $jmlklasifikasi - 1) {
				$endletterskl = $letters;
			}
			$letters = ++$letters;
		}

		$start = $letters;
		$end = $letters;
		$objPHPExcel->getActiveSheet()->setCellValue($start.'5', 'JUMLAH KASUS');
		for($i=0; $i<2; $i++){
			$end++;
		}
		$objPHPExcel->getActiveSheet()->mergeCells($start.'5:'.$end.'5');

		$start = ++$end;
		$objPHPExcel->getActiveSheet()->setCellValue($start.'5', 'KASUS DISELESAIKAN');
		for($i=0; $i<2; $i++){
			$end++;
		}
		$objPHPExcel->getActiveSheet()->mergeCells($start.'5:'.$end.'5');

		$start = ++$end;
		$objPHPExcel->getActiveSheet()->setCellValue($start.'5', 'KASUS DALAM PROSES');
		for($i=0; $i<2; $i++){
			$end++;
		}
		$objPHPExcel->getActiveSheet()->mergeCells($start.'5:'.$end.'5');

		$temp = $letters;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus Bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus s/d bulan lalu');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus s/d bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus selesai bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus selesai s/d bln lalu');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus selesai s/d bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus proses bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus proses s/d bln lalu');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus proses s/d bln ini');

		$jmljenis = count($namaperjenis);
		$numbers = 8;
		for($i=0; $i<$jmljenis; $i++){
			$num = $i + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$numbers, $num);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$numbers, strtoupper($namaperjenis[$i]));
			$numbers = ++$numbers;
		}

		$temp = $numbers;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus Bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus s/d bulan lalu');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus s/d bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus selesai bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus selesai s/d bln lalu');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus selesai s/d bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus proses bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus proses s/d bln lalu');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus proses s/d bln ini');

		$rownum1 = count($hasilperjenis);
		$number  = 8;
		
		for($i=0; $i<$rownum1; $i++){
			$rownum2 = count($hasilperjenis[$i]);
			$letter = "C";

			for($j=0;$j<$rownum2;$j++) {
				$value = $hasilperjenis[$i][$j];
				$comb_letter = $letter.$number;
				if($value != '0') {$objPHPExcel->getActiveSheet()->setCellValue($comb_letter, $value);}

				$letter = ++$letter;
			}

			$number = $number + 1;
		}
		
		$rownum1 = count($hasilperklasifikasi);
		$letter = "C";
		
		for($i=0;$i<$rownum1;$i++){
			$rownum2 = count($hasilperklasifikasi[$i]);
			$number  = $numbers;

			for($j=0;$j<$rownum2;$j++){
				$value = $hasilperklasifikasi[$i][$j];
				$comb_letter = $letter.$number;
				if($value != '0') {$objPHPExcel->getActiveSheet()->setCellValue($comb_letter, $value);}

				$number = $number + 1;
			}

			$letter = ++$letter;
		}

		$threshold = $numbers - 1;
		for($i=0;$i<9;$i++){
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$numbers.':B'.$numbers);
			$objPHPExcel->getActiveSheet()->mergeCells($letters.'6:'.$letters.'7');
			$objPHPExcel->getActiveSheet()->setCellValue($letters.$numbers,'=SUM('.$letters.'8:'.$letters.$threshold.')');
			$objPHPExcel->getActiveSheet()->getStyle($letters.$numbers)->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
			->getStartColor()->setARGB('D1D1D1');
			if($i!=8){
				$letters = ++$letters;
				$numbers = ++$numbers;
			}
		}

		$objPHPExcel->getActiveSheet()->mergeCells('A1:'.$letters.'1')
			->mergeCells('A2:'.$letters.'2')
			->mergeCells('A3:'.$letters.'3')
			->mergeCells('A4:'.$letters.'4')
			->mergeCells('A5:A7')
			->mergeCells('B5:B7')
			->mergeCells('C5:'.$endletterskl.'5');

		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getRowDimension(5)->setRowHeight(30);
		$objPHPExcel->getActiveSheet()->getRowDimension(6)->setRowHeight(100);
		for ($col = ord('C'); $col <= ord($letters); $col++){
			$objPHPExcel->getActiveSheet()->getColumnDimension(chr($col))->setWidth(7.5);
		}

		$styleJudul = array('font' => array('name' => 'Calibri','size' => 12,'bold' => true));

		$styleAll = array(
			'font' => array('name' => 'Calibri','size' => 9.5),
			'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,'wrap' => true),
			'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))
			);

		$objPHPExcel->getActiveSheet()->getStyle('A1:'.$letters.$numbers)->applyFromArray($styleAll);
		$objPHPExcel->getActiveSheet()->getStyle('A1:A3')->applyFromArray($styleJudul);
		$objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$objPHPExcel->getActiveSheet()->getStyle('A5:'.$letters.'5')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('B8:B'.$threshold)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

		for($i=0; $i<3; $i++){
			$objPHPExcel->getActiveSheet()->getStyle($endletterskl.'5:'.$endletterskl.$numbers)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$threshold.':'.$letters.$threshold)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
			$threshold = $threshold + 3;
			for($j=0; $j<3; $j++){
				$endletterskl++;
			}
		}

		$objPHPExcel->getActiveSheet()->setTitle('Jenis '.$m_name[$month].' '.$year);
		
		$phpexcelpool->addExternalSheet($objPHPExcel->getSheet(0));
		
		return $phpexcelpool;
	}

	private function format_sector_basedv2($phpexcelpool,$namainstitusi,
		$hasilpersektor,$namaperklasifikasi,$hasilperklasifikasi,
		$m_name,$month,$year) {
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->setCellValue('A1','LAPORAN BULANAN PENGADUAN KASUS (PERMASALAHAN) TKI INSTITUSI '.strtoupper($namainstitusi));
		$objPHPExcel->getActiveSheet()->setCellValue('A2','SEKTOR FORMAL & INFORMAL');
		$objPHPExcel->getActiveSheet()->setCellValue('A3', $m_name[$month].' '.$year);
		$objPHPExcel->getActiveSheet()->setCellValue('A4', 'Waktu Cetak: '.date('d').' '.ucfirst(strtolower($m_name[date('m')])).' '.date('Y'));

		$objPHPExcel->getActiveSheet()->setCellValue('A5', 'NO');
		$objPHPExcel->getActiveSheet()->setCellValue('B5', 'SEKTOR PEKERJAAN');
		$objPHPExcel->getActiveSheet()->setCellValue('C5', 'JENIS KASUS (PERMASALAHAN)');

		$jmlklasifikasi = count($namaperklasifikasi);
		$letters = "C";
		$endletterskl = "";
		for($i=0; $i<$jmlklasifikasi; $i++){
			$num = $i + 1;
			$objPHPExcel->getActiveSheet()->setCellValue($letters.'6', $namaperklasifikasi[$i]);
			$objPHPExcel->getActiveSheet()->setCellValue($letters.'7', $num);
			if($i == $jmlklasifikasi - 1) {
				$endletterskl = $letters;
			}
			$letters = ++$letters;
		}

		$start = $letters;
		$end = $letters;
		$objPHPExcel->getActiveSheet()->setCellValue($start.'5', 'JUMLAH KASUS');
		for($i=0; $i<2; $i++){
			$end++;
		}
		$objPHPExcel->getActiveSheet()->mergeCells($start.'5:'.$end.'5');

		$start = ++$end;
		$objPHPExcel->getActiveSheet()->setCellValue($start.'5', 'KASUS DISELESAIKAN');
		for($i=0; $i<2; $i++){
			$end++;
		}
		$objPHPExcel->getActiveSheet()->mergeCells($start.'5:'.$end.'5');

		$start = ++$end;
		$objPHPExcel->getActiveSheet()->setCellValue($start.'5', 'KASUS DALAM PROSES');
		for($i=0; $i<2; $i++){
			$end++;
		}
		$objPHPExcel->getActiveSheet()->mergeCells($start.'5:'.$end.'5');

		$temp = $letters;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus Bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus s/d bulan lalu');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus s/d bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus selesai bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus selesai s/d bln lalu');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus selesai s/d bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus proses bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus proses s/d bln lalu');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus proses s/d bln ini');

		$numbers = 8;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$numbers, 1);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$numbers, 'FORMAL');
		$numbers = ++$numbers;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$numbers, 2);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$numbers, 'INFORMAL');
		$numbers = ++$numbers;

		$temp = $numbers;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus Bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus s/d bulan lalu');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus s/d bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus selesai bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus selesai s/d bln lalu');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus selesai s/d bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus proses bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus proses s/d bln lalu');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus proses s/d bln ini');

		$rownum1 = count($hasilpersektor);
		$number  = 8;
		
		for($i=0; $i<$rownum1; $i++){
			$rownum2 = count($hasilpersektor[$i]);
			$letter = "C";

			for($j=0;$j<$rownum2;$j++) {
				$value = $hasilpersektor[$i][$j];
				$comb_letter = $letter.$number;
				if($value != '0') {$objPHPExcel->getActiveSheet()->setCellValue($comb_letter, $value);}

				$letter = ++$letter;
			}

			$number = $number + 1;
		}
		
		$rownum1 = count($hasilperklasifikasi);
		$letter = "C";
		
		for($i=0;$i<$rownum1;$i++){
			$rownum2 = count($hasilperklasifikasi[$i]);
			$number  = $numbers;

			for($j=0;$j<$rownum2;$j++){
				$value = $hasilperklasifikasi[$i][$j];
				$comb_letter = $letter.$number;
				if($value != '0') {$objPHPExcel->getActiveSheet()->setCellValue($comb_letter, $value);}

				$number = $number + 1;
			}

			$letter = ++$letter;
		}

		$threshold = $numbers - 1;
		for($i=0;$i<9;$i++){
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$numbers.':B'.$numbers);
			$objPHPExcel->getActiveSheet()->mergeCells($letters.'6:'.$letters.'7');
			$objPHPExcel->getActiveSheet()->setCellValue($letters.$numbers,'=SUM('.$letters.'8:'.$letters.$threshold.')');
			$objPHPExcel->getActiveSheet()->getStyle($letters.$numbers)->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
			->getStartColor()->setARGB('D1D1D1');
			if($i!=8){
				$letters = ++$letters;
				$numbers = ++$numbers;
			}
		}

		$objPHPExcel->getActiveSheet()->mergeCells('A1:'.$letters.'1')
			->mergeCells('A2:'.$letters.'2')
			->mergeCells('A3:'.$letters.'3')
			->mergeCells('A4:'.$letters.'4')
			->mergeCells('A5:A7')
			->mergeCells('B5:B7')
			->mergeCells('C5:'.$endletterskl.'5');

		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getRowDimension(5)->setRowHeight(30);
		$objPHPExcel->getActiveSheet()->getRowDimension(6)->setRowHeight(100);
		for ($col = ord('C'); $col <= ord($letters); $col++){
			$objPHPExcel->getActiveSheet()->getColumnDimension(chr($col))->setWidth(7.5);
		}

		$styleJudul = array('font' => array('name' => 'Calibri','size' => 12,'bold' => true));

		$styleAll = array(
			'font' => array('name' => 'Calibri','size' => 9.5),
			'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,'wrap' => true),
			'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))
			);

		$objPHPExcel->getActiveSheet()->getStyle('A1:'.$letters.$numbers)->applyFromArray($styleAll);
		$objPHPExcel->getActiveSheet()->getStyle('A1:A3')->applyFromArray($styleJudul);
		$objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$objPHPExcel->getActiveSheet()->getStyle('A5:'.$letters.'5')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('B8:B'.$threshold)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

		for($i=0; $i<3; $i++){
			$objPHPExcel->getActiveSheet()->getStyle($endletterskl.'5:'.$endletterskl.$numbers)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$threshold.':'.$letters.$threshold)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
			$threshold = $threshold + 3;
			for($j=0; $j<3; $j++){
				$endletterskl++;
			}
		}
		
		$objPHPExcel->getActiveSheet()->setTitle('Sektor '.$m_name[$month].' '.$year);
		
		$phpexcelpool->addExternalSheet($objPHPExcel->getSheet(0));
		
		return $phpexcelpool;
	}

	private function format_status_basedv2($phpexcelpool,$namainstitusi,
		$hasilperstatus,$namaperklasifikasi,$hasilperklasifikasi,
		$m_name,$month,$year) {
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->setCellValue('A1','LAPORAN BULANAN PENGADUAN KASUS (PERMASALAHAN) TKI INSTITUSI '.strtoupper($namainstitusi));
		$objPHPExcel->getActiveSheet()->setCellValue('A2','STATUS TENAGA KERJA INDONESIA');
		$objPHPExcel->getActiveSheet()->setCellValue('A3', $m_name[$month].' '.$year);
		$objPHPExcel->getActiveSheet()->setCellValue('A4', 'Waktu Cetak: '.date('d').' '.ucfirst(strtolower($m_name[date('m')])).' '.date('Y'));

		$objPHPExcel->getActiveSheet()->setCellValue('A5', 'NO');
		$objPHPExcel->getActiveSheet()->setCellValue('B5', 'STATUS PEKERJA');
		$objPHPExcel->getActiveSheet()->setCellValue('C5', 'JENIS KASUS (PERMASALAHAN)');

		$jmlklasifikasi = count($namaperklasifikasi);
		$letters = "C";
		$endletterskl = "";
		for($i=0; $i<$jmlklasifikasi; $i++){
			$num = $i + 1;
			$objPHPExcel->getActiveSheet()->setCellValue($letters.'6', $namaperklasifikasi[$i]);
			$objPHPExcel->getActiveSheet()->setCellValue($letters.'7', $num);
			if($i == $jmlklasifikasi - 1) {
				$endletterskl = $letters;
			}
			$letters = ++$letters;
		}

		$start = $letters;
		$end = $letters;
		$objPHPExcel->getActiveSheet()->setCellValue($start.'5', 'JUMLAH KASUS');
		for($i=0; $i<2; $i++){
			$end++;
		}
		$objPHPExcel->getActiveSheet()->mergeCells($start.'5:'.$end.'5');

		$start = ++$end;
		$objPHPExcel->getActiveSheet()->setCellValue($start.'5', 'KASUS DISELESAIKAN');
		for($i=0; $i<2; $i++){
			$end++;
		}
		$objPHPExcel->getActiveSheet()->mergeCells($start.'5:'.$end.'5');

		$start = ++$end;
		$objPHPExcel->getActiveSheet()->setCellValue($start.'5', 'KASUS DALAM PROSES');
		for($i=0; $i<2; $i++){
			$end++;
		}
		$objPHPExcel->getActiveSheet()->mergeCells($start.'5:'.$end.'5');

		$temp = $letters;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus Bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus s/d bulan lalu');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus s/d bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus selesai bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus selesai s/d bln lalu');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus selesai s/d bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus proses bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus proses s/d bln lalu');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'6', 'Jml kasus proses s/d bln ini');

		$numbers = 8;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$numbers, 1);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$numbers, 'RESMI');
		$numbers = ++$numbers;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$numbers, 2);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$numbers, 'KABURAN');
		$numbers = ++$numbers;

		$temp = $numbers;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus Bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus s/d bulan lalu');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus s/d bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus selesai bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus selesai s/d bln lalu');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus selesai s/d bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus proses bln ini');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus proses s/d bln lalu');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'Jml kasus proses s/d bln ini');

		$rownum1 = count($hasilperstatus);
		$number  = 8;
		
		for($i=0; $i<$rownum1; $i++){
			$rownum2 = count($hasilperstatus[$i]);
			$letter = "C";

			for($j=0;$j<$rownum2;$j++) {
				$value = $hasilperstatus[$i][$j];
				$comb_letter = $letter.$number;
				if($value != '0') {$objPHPExcel->getActiveSheet()->setCellValue($comb_letter, $value);}

				$letter = ++$letter;
			}

			$number = $number + 1;
		}
		
		$rownum1 = count($hasilperklasifikasi);
		$letter = "C";
		
		for($i=0;$i<$rownum1;$i++){
			$rownum2 = count($hasilperklasifikasi[$i]);
			$number  = $numbers;

			for($j=0;$j<$rownum2;$j++){
				$value = $hasilperklasifikasi[$i][$j];
				$comb_letter = $letter.$number;
				if($value != '0') {$objPHPExcel->getActiveSheet()->setCellValue($comb_letter, $value);}

				$number = $number + 1;
			}

			$letter = ++$letter;
		}

		$threshold = $numbers - 1;
		for($i=0;$i<9;$i++){
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$numbers.':B'.$numbers);
			$objPHPExcel->getActiveSheet()->mergeCells($letters.'6:'.$letters.'7');
			$objPHPExcel->getActiveSheet()->setCellValue($letters.$numbers,'=SUM('.$letters.'8:'.$letters.$threshold.')');
			$objPHPExcel->getActiveSheet()->getStyle($letters.$numbers)->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
			->getStartColor()->setARGB('D1D1D1');
			if($i!=8){
				$letters = ++$letters;
				$numbers = ++$numbers;
			}
		}

		$objPHPExcel->getActiveSheet()->mergeCells('A1:'.$letters.'1')
			->mergeCells('A2:'.$letters.'2')
			->mergeCells('A3:'.$letters.'3')
			->mergeCells('A4:'.$letters.'4')
			->mergeCells('A5:A7')
			->mergeCells('B5:B7')
			->mergeCells('C5:'.$endletterskl.'5');

		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getRowDimension(5)->setRowHeight(30);
		$objPHPExcel->getActiveSheet()->getRowDimension(6)->setRowHeight(100);
		for ($col = ord('C'); $col <= ord($letters); $col++){
			$objPHPExcel->getActiveSheet()->getColumnDimension(chr($col))->setWidth(7.5);
		}

		$styleJudul = array('font' => array('name' => 'Calibri','size' => 12,'bold' => true));

		$styleAll = array(
			'font' => array('name' => 'Calibri','size' => 9.5),
			'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,'wrap' => true),
			'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))
			);

		$objPHPExcel->getActiveSheet()->getStyle('A1:'.$letters.$numbers)->applyFromArray($styleAll);
		$objPHPExcel->getActiveSheet()->getStyle('A1:A3')->applyFromArray($styleJudul);
		$objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$objPHPExcel->getActiveSheet()->getStyle('A5:'.$letters.'5')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('B8:B'.$threshold)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

		for($i=0; $i<3; $i++){
			$objPHPExcel->getActiveSheet()->getStyle($endletterskl.'5:'.$endletterskl.$numbers)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$threshold.':'.$letters.$threshold)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
			$threshold = $threshold + 3;
			for($j=0; $j<3; $j++){
				$endletterskl++;
			}
		}
		
		$objPHPExcel->getActiveSheet()->setTitle('Status '.$m_name[$month].' '.$year);
		
		$phpexcelpool->addExternalSheet($objPHPExcel->getSheet(0));
		
		return $phpexcelpool;
	}

	// public function generateBulanan($time,$infos) {
	// 	$m_name = array('01' => 'JANUARI', '02' => 'FEBRUARI',
	// 		'03' => 'MARET','04' => 'APRIL','05' => 'MEI',
	// 		'06' => 'JUNI','07' => 'JULI','08' => 'AGUSTUS',
	// 		'09' => 'SEPTEMBER','10' => 'OKTOBER','11' => 'NOVEMBER',
	// 		'12' => 'DESEMBER');

	// 	$objPHPExcel = new PHPExcel();
 //        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
 //        $objPHPExcel->removeSheetByIndex(0);

	// 	foreach ($infos as $info) {
	// 		$get_time = explode(',',$time);

	// 		foreach ($get_time as $month_info) {
	// 			$get_date = explode('/',$month_info);
	// 			$m 		  = $get_date[1];
	// 			$d 		  = $get_date[2];
	// 			$y 		  = $get_date[0];

	// 			switch ($info) {
	// 				case 'jenis':							
	// 				$objPHPtemplate = $objReader->load($this->CI->input->server('DOCUMENT_ROOT').'/sisnaker-atase/assets/template/RekapJenis.xlsx');
	// 				list($hasilperjenis,$hasilperklasifikasi) = $this->get_jenis_based($m, $y);
	// 				$objPHPExcel = $this->format_jenis_based($objPHPExcel,$objPHPtemplate,$hasilperjenis,$hasilperklasifikasi,$m_name, $m, $y);
	// 				break;

	// 				case 'sektor':
	// 				$objPHPtemplate = $objReader->load($this->CI->input->server('DOCUMENT_ROOT').'/sisnaker-atase/assets/template/RekapSektor.xlsx');
	// 				list($hasilpersektor,$hasilperklasifikasi) = $this->get_sektor_based($m,$y);
	// 				$objPHPExcel = $this->format_sector_based($objPHPExcel,$objPHPtemplate,
	// 					$hasilpersektor,$hasilperklasifikasi,
	// 					$m_name, $m, $y);
	// 				break;

	// 				case 'status':
	// 				$objPHPtemplate = $objReader->load($this->CI->input->server('DOCUMENT_ROOT').'/sisnaker-atase/assets/template/RekapStatusTKI.xlsx');
	// 				list($hasilperstatus,$hasilperklasifikasi) = $this->get_status_based($m,$y);
	// 				$objPHPExcel = $this->format_status_based($objPHPExcel,$objPHPtemplate,
	// 					$hasilperstatus,$hasilperklasifikasi,
	// 					$m_name, $m, $y);
	// 				break;
	// 			}
	// 		}
	// 	}

	// 	$this->aggregate_rekap($objPHPExcel,'Bulan', FALSE);
	// }

	public function generateTahunanv2($time,$lingkup,$list_shelter,$idinstitution,$namainstitusi) {
		$m_name = array('01' => 'JANUARI', '02' => 'FEBRUARI',
			'03' => 'MARET','04' => 'APRIL','05' => 'MEI',
			'06' => 'JUNI','07' => 'JULI','08' => 'AGUSTUS',
			'09' => 'SEPTEMBER','10' => 'OKTOBER','11' => 'NOVEMBER',
			'12' => 'DESEMBER');
		$maxy = 0;
		$yjudul = "";

		$task = array('tahunan','jenis','sektor','status');
		$namalingkup = "SEMUA SHELTER";

		if ($lingkup != NULL) {
			foreach($list_shelter as $row) {
				if ($row->id == $lingkup) {
					$namalingkup = strtoupper($row->name);
					break;
				}
			}
		}

		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
		$objPHPExcel->removeSheetByIndex(0);

        /// get multiple time
		foreach ($task as $info) {
			$get_time = explode(',',$time);

            ///get
			foreach ($get_time as $month_info) {
				$get_date = explode('/',$month_info);
				$y 		  = $get_date[0];

				$tempy = (int)$y;
				if($tempy > $maxy){
					$maxy = $tempy;
					$yjudul = $y;
				}

				switch ($info) {
					case 'jenis':
						list($namapersubject,$hasilpersubject,$namaperklasifikasi,$hasilperklasifikasi) = $this->get_yeardata_bySubjectv2('jenis',$y,$lingkup,$idinstitution);
						$objPHPExcel = $this->format_yearrekap_dynamicv2('jenis',$objPHPExcel,$namainstitusi,
							$hasilpersubject,$namapersubject,$hasilperklasifikasi,$namaperklasifikasi,
							$m_name,$y, $namalingkup);						
					break;

					case 'sektor':
						list($namapersubject,$hasilpersubject,$namaperklasifikasi,$hasilperklasifikasi) = $this->get_yeardata_bySubjectv2('sektor',$y,$lingkup,$idinstitution);

						$objPHPExcel = $this->format_yearrekap_dynamicv2('sektor',$objPHPExcel,$namainstitusi,
							$hasilpersubject,$namapersubject,$hasilperklasifikasi,$namaperklasifikasi,
							$m_name,$y, $namalingkup);
					break;

					case 'status':
						list($namapersubject,$hasilpersubject,$namaperklasifikasi,$hasilperklasifikasi) = $this->get_yeardata_bySubjectv2('status',$y,$lingkup,$idinstitution);

						$objPHPExcel = $this->format_yearrekap_dynamicv2('status',$objPHPExcel,$namainstitusi,
							$hasilpersubject,$namapersubject,$hasilperklasifikasi,$namaperklasifikasi,
							$m_name,$y, $namalingkup);							
					break;

                    case 'tahunan':	//subject bulan
	                    list($hasilpersubject,$namaperklasifikasi,$hasilperklasifikasi) = $this->get_yeardatav2($y, $lingkup, $idinstitution);

	                    $objPHPExcel = $this->format_yearrekapv2($objPHPExcel,$namainstitusi,
	                    	$hasilpersubject,$hasilperklasifikasi,$namaperklasifikasi,
	                    	$m_name,$y,$namalingkup);					
                    break;					
                }								
            }	
        }

        $fname = "rekap_Tahun_".$namainstitusi."_".$namalingkup."_".$yjudul.".xlsx";
        $this->aggregate_rekap($objPHPExcel,$fname,FALSE);	
    }

    private function get_yeardata_bySubjectv2($subject,$year,$lingkup=null,$idinstitution){		
		// Get per classification
    	$get_class = $this->CI->Rekap_model->get_classification()->result_array();
    	$size_class = count($get_class);
		// Get per subject
    	if($subject=='jenis') {
    		$get_subject = $this->CI->Rekap_model->get_work_type()->result_array();
    	}
    	if($subject=='sektor') {
			$get_subject = array(2,1);// FORMAL, INFORMAL
		}
		if($subject=='status') {
			$get_subject = array(1,2);// RESMI, KABURAN
		}
		$size_subject = count($get_subject);
				
		$hasilpersubject = array();
		$namapersubject = array();
		for($i=0;$i<$size_subject;$i++){
			$rowarray = array();
			// data per baris
			for($j=0;$j<$size_class;$j++){
				if($subject=='jenis') {
					$cnt = $this->CI->Rekap_model->get_year_dynamic_array($idinstitution,array(
						"work"=>$get_subject[$i]['idjenispekerjaan'],
						"class"=>$get_class[$j]['id'],
						"lingkup"=>$lingkup
						), NULL, $year);
				}
				if($subject=='sektor') {
					$cnt = $this->CI->Rekap_model->get_year_dynamic_array($idinstitution,array(
						"sector"=>$get_subject[$i],
						"class"=>$get_class[$j]['id'],
						"lingkup"=>$lingkup
						), NULL, $year);
				}
				if($subject=='status') {
					$cnt = $this->CI->Rekap_model->get_year_dynamic_array($idinstitution,array(
						"statustki"=>$get_subject[$i],
						"class"=>$get_class[$j]['id'],
						"lingkup"=>$lingkup
						), NULL, $year);
				}
				
				array_push($rowarray,$cnt);
			}
			// statistik
			if($subject=='jenis') {
				$tmparray = $this->CI->Rekap_model->get_year_dynamic_array($idinstitution,array(
					"work"=>$get_subject[$i]['idjenispekerjaan'],
					"lingkup"=>$lingkup
					), NULL, $year, TRUE);
			}
			if($subject=='sektor') {
				$tmparray = $this->CI->Rekap_model->get_year_dynamic_array($idinstitution,array(
					"sector"=>$get_subject[$i],
					"lingkup"=>$lingkup
					), NULL, $year, TRUE);
			}
			if($subject=='status') {
				$tmparray = $this->CI->Rekap_model->get_year_dynamic_array($idinstitution,array(
					"statustki"=>$get_subject[$i],
					"lingkup"=>$lingkup
					), NULL, $year, TRUE);
			}
			
			// merge all, pro, fin
			$result = array_merge($rowarray,$tmparray);
			array_push($hasilpersubject,$result);
			if($subject=='jenis') {
				array_push($namapersubject, $get_subject[$i]['namajenispekerjaan']);
			}
		}
		
		$hasilperklasifikasi = array();
		$namaperklasifikasi = array();
		for($j=0;$j<$size_class;$j++){
			$cnt = $this->CI->Rekap_model->get_year_dynamic_array($idinstitution,array( "class"=> $get_class[$j]['id'], "lingkup"=>$lingkup), NULL, $year, TRUE);
			array_push($hasilperklasifikasi,$cnt);
			array_push($namaperklasifikasi,$get_class[$j]['name']);
		}
		
		return array($namapersubject,$hasilpersubject,$namaperklasifikasi,$hasilperklasifikasi);
	}

	private function get_yeardatav2($year,$lingkup=null,$idinstitution){
    	$month = range(1,12);

		// Get per classification
    	$get_classification = $this->CI->Rekap_model->get_classification();
    	$hasilpermonth = array();
    	for($i=0;$i<count($month);$i++) {
    		$jumlah_pool = array();
    		foreach ($get_classification->result() as $row_class) {
    			$jumlah = $this->CI->Rekap_model->get_yearrekap($row_class->id,$month[$i],$year,$lingkup,$idinstitution);
    			array_push($jumlah_pool,$jumlah);
    		}

			// Get per month
    		$jumlah_month = $this->CI->Rekap_model->get_yearrekap_permonth($month[$i], $year,$lingkup,$idinstitution);
    		$result = array_merge($jumlah_pool,$jumlah_month);
    		array_push($hasilpermonth,$result);
    	}

    	$hasilperklasifikasi = array();
    	$namaperklasifikasi = array();
    	foreach ($get_classification->result() as $row_class) {
    		$jumlah = $this->CI->Rekap_model->get_yearrekap_based_class($row_class->id,$year,$lingkup,$idinstitution);
    		array_push($hasilperklasifikasi,$jumlah);
    		array_push($namaperklasifikasi,$row_class->name);
    	}

    	return array($hasilpermonth,$namaperklasifikasi,$hasilperklasifikasi);
    }

    private function format_yearrekap_dynamicv2($tipe,$phpexcelpool,$namainstitusi,
		$hasilpersubject,$namapersubject=NULL,$hasilperklasifikasi,$namaperklasifikasi,
		$m_name,$year,$namalingkup){
    	$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->setCellValue('A1','LAPORAN TAHUNAN PENGADUAN KASUS (PERMASALAHAN) TKI INSTITUSI '.strtoupper($namainstitusi));
		if($tipe=='jenis'){
			$objPHPExcel->getActiveSheet()->setCellValue('A2','BERDASARKAN JENIS PEKERJAAN');
		}
		if($tipe=='sektor'){
			$objPHPExcel->getActiveSheet()->setCellValue('A2','BERDASARKAN SEKTOR PEKERJAAN');
		}
		if($tipe=='status'){
			$objPHPExcel->getActiveSheet()->setCellValue('A2','BERDASARKAN STATUS TENAGA KERJA INDONESIA');
		}
		$objPHPExcel->getActiveSheet()->setCellValue('A3', $namalingkup.' TAHUN '.$year);
		$objPHPExcel->getActiveSheet()->setCellValue('A4', 'Waktu Cetak: '.date('d').' '.ucfirst(strtolower($m_name[date('m')])).' '.date('Y'));

		$objPHPExcel->getActiveSheet()->setCellValue('A5', 'NO');
		if($tipe=='jenis'){
			$objPHPExcel->getActiveSheet()->setCellValue('B5', 'JENIS PEKERJAAN');
		}
		if($tipe=='sektor'){
			$objPHPExcel->getActiveSheet()->setCellValue('B5', 'SEKTOR PEKERJAAN');
		}
		if($tipe=='status'){
			$objPHPExcel->getActiveSheet()->setCellValue('B5', 'STATUS PEKERJA');
		}
		$objPHPExcel->getActiveSheet()->setCellValue('C5', 'JENIS KASUS (PERMASALAHAN)');

		$jmlklasifikasi = count($namaperklasifikasi);
		$letters = "C";
		$endletterskl = "";
		for($i=0; $i<$jmlklasifikasi; $i++){
			$num = $i + 1;
			$objPHPExcel->getActiveSheet()->setCellValue($letters.'6', $namaperklasifikasi[$i]);
			$objPHPExcel->getActiveSheet()->setCellValue($letters.'7', $num);
			if($i == $jmlklasifikasi - 1) {
				$endletterskl = $letters;
			}
			$letters = ++$letters;
		}

		$temp = $letters;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'5', 'JUMLAH KASUS');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'5', 'KASUS DISELESAIKAN');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'5', 'KASUS DALAM PROSES');

		if($tipe=='jenis'){
			$jmljenis = count($namapersubject);
			$numbers = 8;
			for($i=0; $i<$jmljenis; $i++){
				$num = $i + 1;
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$numbers, $num);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$numbers, strtoupper($namapersubject[$i]));
				$numbers = ++$numbers;
			}
		}
		if($tipe=='sektor'){
			$numbers = 8;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$numbers, 1);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$numbers, 'FORMAL');
			$numbers = ++$numbers;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$numbers, 2);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$numbers, 'INFORMAL');
			$numbers = ++$numbers;
		}
		if($tipe=='status'){
			$numbers = 8;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$numbers, 1);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$numbers, 'RESMI');
			$numbers = ++$numbers;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$numbers, 2);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$numbers, 'KABURAN');
			$numbers = ++$numbers;
		}

		$temp = $numbers;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'JUMLAH KASUS');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'KASUS DISELESAIKAN');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'KASUS DALAM PROSES');

		$rownum1 = count($hasilpersubject);
		$number  = 8;
		
		for($i=0; $i<$rownum1; $i++){
			$rownum2 = count($hasilpersubject[$i]);
			$letter = "C";

			for($j=0;$j<$rownum2;$j++) {
				$value = $hasilpersubject[$i][$j];
				$comb_letter = $letter.$number;
				if($value != '0') {$objPHPExcel->getActiveSheet()->setCellValue($comb_letter, $value);}

				$letter = ++$letter;
			}

			$number = $number + 1;
		}
		
		$rownum1 = count($hasilperklasifikasi);
		$letter = "C";
		
		for($i=0;$i<$rownum1;$i++){
			$rownum2 = count($hasilperklasifikasi[$i]);
			$number  = $numbers;

			for($j=0;$j<$rownum2;$j++){
				$value = $hasilperklasifikasi[$i][$j];
				$comb_letter = $letter.$number;
				if($value != '0') {$objPHPExcel->getActiveSheet()->setCellValue($comb_letter, $value);}

				$number = $number + 1;
			}

			$letter = ++$letter;
		}

		$threshold = $numbers - 1;
		for($i=0;$i<3;$i++){
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$numbers.':B'.$numbers);
			$objPHPExcel->getActiveSheet()->mergeCells($letters.'5:'.$letters.'7');
			$objPHPExcel->getActiveSheet()->setCellValue($letters.$numbers,'=SUM('.$letters.'8:'.$letters.$threshold.')');
			$objPHPExcel->getActiveSheet()->getStyle($letters.$numbers)->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
			->getStartColor()->setARGB('D1D1D1');
			$objPHPExcel->getActiveSheet()->getStyle('A'.$numbers.':B'.$numbers)->getFont()->setBold(true);;
			if($i!=2){
				$letters = ++$letters;
				$numbers = ++$numbers;
			}
		}

		$objPHPExcel->getActiveSheet()->mergeCells('A1:'.$letters.'1')
			->mergeCells('A2:'.$letters.'2')
			->mergeCells('A3:'.$letters.'3')
			->mergeCells('A4:'.$letters.'4')
			->mergeCells('A5:A7')
			->mergeCells('B5:B7')
			->mergeCells('C5:'.$endletterskl.'5');

		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getRowDimension(5)->setRowHeight(30);
		$objPHPExcel->getActiveSheet()->getRowDimension(6)->setRowHeight(100);
		for ($col = ord('C'); $col <= ord($letters); $col++){
			$objPHPExcel->getActiveSheet()->getColumnDimension(chr($col))->setWidth(7.5);
		}

		$styleJudul = array('font' => array('name' => 'Calibri','size' => 12,'bold' => true));

		$styleAll = array(
			'font' => array('name' => 'Calibri','size' => 9.5),
			'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,'wrap' => true),
			'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))
			);

		$objPHPExcel->getActiveSheet()->getStyle('A1:'.$letters.$numbers)->applyFromArray($styleAll);
		$objPHPExcel->getActiveSheet()->getStyle('A1:A3')->applyFromArray($styleJudul);
		$objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$objPHPExcel->getActiveSheet()->getStyle('A5:'.$letters.'5')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('B8:B'.$threshold)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

		$objPHPExcel->getActiveSheet()->getStyle($endletterskl.'5:'.$endletterskl.$numbers)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$threshold.':'.$letters.$threshold)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);

		$objPHPExcel->getActiveSheet()->setTitle(strtoupper($tipe).' '.$year);
		$phpexcelpool->addExternalSheet($objPHPExcel->getSheet(0));
		
		return $phpexcelpool;
	}

	private function format_yearrekapv2($phpexcelpool,$namainstitusi,
		$hasilpermonth,$hasilperklasifikasi,$namaperklasifikasi,$m_name,$year,$namalingkup){
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->setCellValue('A1','LAPORAN TAHUNAN PENGADUAN KASUS (PERMASALAHAN) TKI INSTITUSI '.strtoupper($namainstitusi));
		$objPHPExcel->getActiveSheet()->setCellValue('A2', ''.$namalingkup);
		$objPHPExcel->getActiveSheet()->setCellValue('A3', 'TAHUN '.$year);
		$objPHPExcel->getActiveSheet()->setCellValue('A4', 'Waktu Cetak: '.date('d').' '.ucfirst(strtolower($m_name[date('m')])).' '.date('Y'));

		$objPHPExcel->getActiveSheet()->setCellValue('A5', 'NO');
		$objPHPExcel->getActiveSheet()->setCellValue('B5', 'BULAN');
		$objPHPExcel->getActiveSheet()->setCellValue('C5', 'JENIS KASUS (PERMASALAHAN)');

		$jmlklasifikasi = count($namaperklasifikasi);
		$letters = "C";
		$endletterskl = "";
		for($i=0; $i<$jmlklasifikasi; $i++){
			$num = $i + 1;
			$objPHPExcel->getActiveSheet()->setCellValue($letters.'6', $namaperklasifikasi[$i]);
			$objPHPExcel->getActiveSheet()->setCellValue($letters.'7', $num);
			if($i == $jmlklasifikasi - 1) {
				$endletterskl = $letters;
			}
			$letters = ++$letters;
		}

		$temp = $letters;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'5', 'JUMLAH KASUS');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'5', 'KASUS DISELESAIKAN');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'5', 'KASUS DALAM PROSES');

		$jmlmonth = 12;
		$numbers = 8;
		for($i=0; $i<$jmlmonth; $i++){
			$num = $i + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$numbers, $num);
			if($num < 10){
				$temp = '0'.$num;
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$numbers, $m_name[$temp]);
			}
			else {
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$numbers, $m_name[$num]);
			}
			$numbers = ++$numbers;
		}

		$temp = $numbers;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'JUMLAH KASUS');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'KASUS DISELESAIKAN');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'KASUS DALAM PROSES');

		$rownum1 = count($hasilpermonth);
		$number  = 8;
		
		for($i=0; $i<$rownum1; $i++){
			$rownum2 = count($hasilpermonth[$i]);
			$letter = "C";

			for($j=0;$j<$rownum2;$j++) {
				$value = $hasilpermonth[$i][$j];
				$comb_letter = $letter.$number;
				if($value != '0') {$objPHPExcel->getActiveSheet()->setCellValue($comb_letter, $value);}

				$letter = ++$letter;
			}

			$number = $number + 1;
		}
		
		$rownum1 = count($hasilperklasifikasi);
		$letter = "C";
		
		for($i=0;$i<$rownum1;$i++){
			$rownum2 = count($hasilperklasifikasi[$i]);
			$number  = $numbers;

			for($j=0;$j<$rownum2;$j++){
				$value = $hasilperklasifikasi[$i][$j];
				$comb_letter = $letter.$number;
				if($value != '0') {$objPHPExcel->getActiveSheet()->setCellValue($comb_letter, $value);}

				$number = $number + 1;
			}

			$letter = ++$letter;
		}

		$threshold = $numbers - 1;
		for($i=0;$i<3;$i++){
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$numbers.':B'.$numbers);
			$objPHPExcel->getActiveSheet()->mergeCells($letters.'5:'.$letters.'7');
			$objPHPExcel->getActiveSheet()->setCellValue($letters.$numbers,'=SUM('.$letters.'8:'.$letters.$threshold.')');
			$objPHPExcel->getActiveSheet()->getStyle($letters.$numbers)->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
			->getStartColor()->setARGB('D1D1D1');
			$objPHPExcel->getActiveSheet()->getStyle('A'.$numbers.':B'.$numbers)->getFont()->setBold(true);;
			if($i!=2){
				$letters = ++$letters;
				$numbers = ++$numbers;
			}
		}

		$objPHPExcel->getActiveSheet()->mergeCells('A1:'.$letters.'1')
			->mergeCells('A2:'.$letters.'2')
			->mergeCells('A3:'.$letters.'3')
			->mergeCells('A4:'.$letters.'4')
			->mergeCells('A5:A7')
			->mergeCells('B5:B7')
			->mergeCells('C5:'.$endletterskl.'5');

		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getRowDimension(5)->setRowHeight(30);
		$objPHPExcel->getActiveSheet()->getRowDimension(6)->setRowHeight(100);
		for ($col = ord('C'); $col <= ord($letters); $col++){
			$objPHPExcel->getActiveSheet()->getColumnDimension(chr($col))->setWidth(7.5);
		}

		$styleJudul = array('font' => array('name' => 'Calibri','size' => 12,'bold' => true));

		$styleAll = array(
			'font' => array('name' => 'Calibri','size' => 9.5),
			'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,'wrap' => true),
			'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))
			);

		$objPHPExcel->getActiveSheet()->getStyle('A1:'.$letters.$numbers)->applyFromArray($styleAll);
		$objPHPExcel->getActiveSheet()->getStyle('A1:A3')->applyFromArray($styleJudul);
		$objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$objPHPExcel->getActiveSheet()->getStyle('A5:'.$letters.'5')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('B8:B'.$threshold)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

		$objPHPExcel->getActiveSheet()->getStyle($endletterskl.'5:'.$endletterskl.$numbers)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$threshold.':'.$letters.$threshold)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);

		$objPHPExcel->getActiveSheet()->setTitle('Tahun '.$year);
		$phpexcelpool->addExternalSheet($objPHPExcel->getSheet(0));
		
		return $phpexcelpool;
	}

	// public function generateTahunan($time,$lingkup,$list_shelter) {
	// 	$m_name = array('01' => 'JANUARI', '02' => 'FEBRUARI',
	// 		'03' => 'MARET','04' => 'APRIL','05' => 'MEI',
	// 		'06' => 'JUNI','07' => 'JULI','08' => 'AGUSTUS',
	// 		'09' => 'SEPTEMBER','10' => 'OKTOBER','11' => 'NOVEMBER',
	// 		'12' => 'DESEMBER');

	// 	$task = array('tahunan','jenis','sektor','status');
	// 	$namalingkup = "KDEI";

	// 	if ($lingkup != null) {
	// 		foreach($list_shelter as $row) {
	// 			if ($row->id == $lingkup) {
	// 				$namalingkup = $row->name;
	// 				break;
	// 			}
	// 		}
	// 	}

	// 	$objPHPExcel = new PHPExcel();
	// 	$objReader = PHPExcel_IOFactory::createReader('Excel2007');
	// 	$objPHPExcel->removeSheetByIndex(0);

 //        /// get multiple time
	// 	foreach ($task as $info) {
	// 		$get_time = explode(',',$time);

 //            ///get
	// 		foreach ($get_time as $month_info) {
	// 			$get_date = explode('/',$month_info);
	// 			$y 		  = $get_date[0];

	// 			switch ($info) {
	// 				case 'jenis':
	// 				$objPHPtemplate = $objReader->load($this->CI->input->server('DOCUMENT_ROOT').'/sisnaker-atase/assets/template/RekapJenisTahun.xlsx');
	// 				list($hasilpersubject,$hasilperklasifikasi) = $this->get_yeardata_bySubject('jenis',$y,$lingkup);
	// 				$param = array(
	// 					'datesign' => 'Z21',
	// 					'total' => 'AA17',
	// 					'done' => 'AB18',
	// 					'pro' => 'AC19',
	// 					'totalEq' => '=SUM(AA9:AA16)',
	// 					'doneEq' => '=SUM(AB9:AB16)',
	// 					'proEq' => '=SUM(AC9:AC16)',
	// 					'formatRange' => 'C9:AC19',
	// 					'title' => 'Jenis',
	// 					'lingkup' => $namalingkup
	// 					);
	// 				$objPHPExcel = $this->format_yearrekap_dynamic($objPHPExcel,$objPHPtemplate,
	// 					$hasilpersubject,$hasilperklasifikasi,
	// 					$m_name,$y, $param);							
	// 				break;

	// 				case 'sektor':
	// 				$objPHPtemplate = $objReader->load($this->CI->input->server('DOCUMENT_ROOT').'/sisnaker-atase/assets/template/RekapSektorTahun.xlsx');
	// 				list($hasilpersubject,$hasilperklasifikasi) = $this->get_yeardata_bySubject('sektor',$y,$lingkup);
	// 				$param = array(
	// 					'datesign' => 'X15',
	// 					'total' => 'AA11',
	// 					'done' => 'AB12',
	// 					'pro' => 'AC13',
	// 					'totalEq' => '=SUM(AA9:AA10)',
	// 					'doneEq' => '=SUM(AB9:AB10)',
	// 					'proEq' => '=SUM(AC9:AC10)',
	// 					'formatRange' => 'C9:AC14',
	// 					'title' => 'Sektor',
	// 					'lingkup' => $namalingkup
	// 					);
	// 				$objPHPExcel = $this->format_yearrekap_dynamic($objPHPExcel,$objPHPtemplate,
	// 					$hasilpersubject,$hasilperklasifikasi,
	// 					$m_name,$y, $param);	
	// 				break;

	// 				case 'status':
	// 				$objPHPtemplate = $objReader->load($this->CI->input->server('DOCUMENT_ROOT').'/sisnaker-atase/assets/template/RekapStatusTKITahun.xlsx');
	// 				list($hasilpersubject,$hasilperklasifikasi) = $this->get_yeardata_bySubject('status',$y,$lingkup);
	// 				$param = array(
	// 					'datesign' => 'X16',
	// 					'total' => 'AA11',
	// 					'done' => 'AB12',
	// 					'pro' => 'AC13',
	// 					'totalEq' => '=SUM(AA9:AA10)',
	// 					'doneEq' => '=SUM(AB9:AB10)',
	// 					'proEq' => '=SUM(AC9:AC10)',
	// 					'formatRange' => 'C9:AC14',
	// 					'title' => 'Status',
	// 					'lingkup' => $namalingkup
	// 					);
	// 				$objPHPExcel = $this->format_yearrekap_dynamic($objPHPExcel,$objPHPtemplate,
	// 					$hasilpersubject,$hasilperklasifikasi,
	// 					$m_name,$y, $param);							
	// 				break;

 //                    case 'tahunan':	//subject bulan
 //                    $objPHPtemplate = $objReader->load($this->CI->input->server('DOCUMENT_ROOT').'/sisnaker-atase/assets/template/RekapTahun.xlsx');
 //                    list($hasilpersubject,$hasilperklasifikasi) = $this->get_yeardata($y, $lingkup);

 //                    $objPHPExcel = $this->format_yearrekap($objPHPExcel,$objPHPtemplate,
 //                    	$hasilpersubject,$hasilperklasifikasi,
 //                    	$m_name,$y,$namalingkup);						
 //                    break;					
 //                }								
 //            }	
 //        }
 //        $this->aggregate_rekap($objPHPExcel,'Tahun', FALSE);	
 //    }
    
    
    public function generateUang($time,$idinstitution,$namainstitusi,$currency) {
    	$m_name = array('01' => 'JANUARI', '02' => 'FEBRUARI',
			'03' => 'MARET','04' => 'APRIL','05' => 'MEI',
			'06' => 'JUNI','07' => 'JULI','08' => 'AGUSTUS',
			'09' => 'SEPTEMBER','10' => 'OKTOBER','11' => 'NOVEMBER',
			'12' => 'DESEMBER');
    	$maxy = 0;
    	$yjudul = "";

    	$objPHPExcel = new PHPExcel();
    	$objPHPExcel->removeSheetByIndex(0);
    	$objReader = PHPExcel_IOFactory::createReader('Excel2007');
    	$objReader->setIncludeCharts(TRUE);			

    	$get_time = explode(',',$time);
    	foreach ($get_time as $month_info) {
    		$get_date = explode('/',$month_info);
    		$y 		  = $get_date[0];

    		$tempy = (int)$y;
    		if($tempy > $maxy){
    			$maxy = $tempy;
    			$yjudul = $y;
    		}

    		$objPHPtemplate = $objReader->load($this->CI->input->server('DOCUMENT_ROOT').'/sisnaker-atase/assets/template/RekapUang.xlsx');
    		list($totaluang,$uangbulanan) = $this->get_money($y,$idinstitution);

    		$objPHPExcel = $this->format_money($namainstitusi,$objPHPExcel,$objPHPtemplate,$m_name,$totaluang,$uangbulanan,$y,$currency);	
    	}

    	$fname = "rekap_Uang_".$namainstitusi."_".$yjudul.".xlsx";
    	$this->aggregate_rekap($objPHPExcel,$fname,TRUE);
    }

    private function get_money($year,$idinstitution){
    	$this->CI->load->model('Perlindungan/Perlindungan_model');
    	$month = range(1,12);
    	$nm_month = array(1=>'Jan', '2'=> 'Feb', '3' => 'Mar', 4 => 'Apr',
    		5=> 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
    		9 => 'Sep', 10 => 'Okt', 11 => 'Nop', 12=> 'Des'
    		);
    	$mon_money   = array();
    	$month_money   = array();

    	for($i=0;$i<count($month);$i++){
    		$mon_money = $this->CI->Perlindungan_model->get_total_money($month[$i],$year,$idinstitution);
    		$uang = $mon_money->row_array();
    		if ($uang['uang'] == ''){
    			$uang['uang'] = '0';
    		}

    		$temp_money = array(
    			'bulan' => $nm_month[$month[$i]],
    			'uang'	=> $uang['uang']
    			);
    		array_push($month_money,$temp_money);
    	}
    	$year_money = $this->CI->Perlindungan_model->get_total_money_year($year,$idinstitution);
    	$year_total_money   = $year_money->row_array();

    	return array($year_total_money['uang'],$month_money);		
    }

    private function format_money($namainstitusi,$phpexcelpool,$phpexceltemplate,$m_name,
		$total,$bulanan,$year,$currency){
		
		$number  = 7;
		$numrow1 = count($bulanan);
		
		$arrMonth = array();
		$arrMoney = array();
		
		for($i=0;$i<$numrow1;$i++) {
			$letter  = 'D';
			$val = $bulanan[$i]['uang'];
			
			array_push($arrMoney,$val);
			array_push($arrMonth,$bulanan[$i]['bulan']);
			
			if($val != 0) {$phpexceltemplate->getActiveSheet()->setCellValue($letter.$number, $val);}			
			$number = $number + 1;
		}
		if($total != 0) {$phpexceltemplate->getActiveSheet()->setCellValue($letter.$number, $total);}

		$phpexceltemplate->getActiveSheet()->getStyle('D7:D19')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		
		/// time param + sheetname
		$day 		= date("d");
		$cur_month  = date("m");
		$curyear    = date("Y");
		$today      = $day." ".$m_name[$cur_month]." ".$curyear;
		$sheetname  = 'Uang_'.$year;
		
		/// charting
		$values = new PHPExcel_Chart_DataSeriesValues('Number', $sheetname.'!$D$7:$D$18');
		$categories = new PHPExcel_Chart_DataSeriesValues('String', $sheetname.'!$C$7:$C$18');
		$series = new PHPExcel_Chart_DataSeries(
					PHPExcel_Chart_DataSeries::TYPE_BARCHART,      // plotType
					PHPExcel_Chart_DataSeries::GROUPING_CLUSTERED,  // plotGrouping
					array(0),                                       // plotOrder
					array(),                                        // plotLabel
					array($categories),                             // plotCategory
					array($values)                                  // plotValues
					);
		$series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_VERTICAL);
		$layout = new PHPExcel_Chart_Layout();
		$plotarea = new PHPExcel_Chart_PlotArea($layout, array($series));
		$chart = new PHPExcel_Chart('Uang yang Diselamatkan', null,null, $plotarea, true,0,null,null);

		$chart->setTopLeftPosition('B21');
		$chart->setBottomRightPosition('F37');

		$phpexceltemplate->getActiveSheet()->addChart($chart);	

		/// labeling sheet param + date		
		
		$phpexceltemplate->getActiveSheet()->setCellValue('B4', 'OLEH PERWAKILAN R.I DI '.strtoupper($namainstitusi).' TAHUN '.$year);
		$phpexceltemplate->getActiveSheet()->setCellValue('D39', '');
		$phpexceltemplate->getActiveSheet()->setCellValue('D40', '');
		$phpexceltemplate->getActiveSheet()->unmergeCells('D39:E39');
		$phpexceltemplate->getActiveSheet()->unmergeCells('D40:E46');

		$phpexceltemplate->getActiveSheet()->setCellValue('B5', 'MENGGUNAKAN MATA UANG '.strtoupper($currency));
		$phpexceltemplate->getActiveSheet()->mergeCells('B5:E5');

		$styleContent = array(
			'font' => array('name' => 'Calibri','size' => 9),		
			'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT)
			);

		$styleJudul = array(
			'font' => array('name' => 'Calibri','size' => 14,'bold' => true),		
			'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
			);
		
		$phpexceltemplate->getActiveSheet()->getStyle('D7:D19')->applyFromArray($styleContent);
		$phpexceltemplate->getActiveSheet()->getStyle('B5')->applyFromArray($styleJudul);
		$phpexceltemplate->getActiveSheet()->setTitle($sheetname);
		$phpexcelpool->addExternalSheet($phpexceltemplate->getSheet(0));
		
		return $phpexcelpool;
	}

    public function generateKelasv2($time,$katg,$idinstitution,$namainstitusi) {
    	$m_name = array('01' => 'JANUARI', '02' => 'FEBRUARI',
			'03' => 'MARET','04' => 'APRIL','05' => 'MEI',
			'06' => 'JUNI','07' => 'JULI','08' => 'AGUSTUS',
			'09' => 'SEPTEMBER','10' => 'OKTOBER','11' => 'NOVEMBER',
			'12' => 'DESEMBER');
    	$maxy = 0;
    	$yjudul = "";

    	$objPHPExcel = new PHPExcel();
    	$objPHPExcel->removeSheetByIndex(0);
    	$objReader = PHPExcel_IOFactory::createReader('Excel2007');

    	$get_time = explode(',',$time);
    	foreach ($get_time as $time_info) {
    		$get_date = explode('/',$time_info);
    		$y 		  = $get_date[0];

    		$tempy = (int)$y;
    		if($tempy > $maxy){
    			$maxy = $tempy;
    			$yjudul = $y;
    		}

    		//formal=2, informal=1
    		$klasquery = $this->CI->Rekap_model->get_classification($katg)->result_array();		
    		$klasKategori = array();
    		foreach($klasquery as $oneresult){
    			array_push($klasKategori,$oneresult['id']);
    		}

			//// STATISTIK	
    		$katDetail = $this->get_yeardata_Categoryv2($klasKategori,$y,$idinstitution);				
    		$katStatistik = $this->get_yearstatistik_Categoryv2($klasKategori,$y,$idinstitution);				
    		$data = array($katDetail,$katStatistik);					
    		$objPHPExcel = $this->format_emptyv2($objPHPExcel,$m_name,$namainstitusi,$data,$y,$katg);

			//// Detail
			$objPHPtemplate = $objReader->load($this->CI->input->server('DOCUMENT_ROOT').'/sisnaker-atase/assets/template/DetailKategori.xlsx');
    		$katDetail = $this->get_detail_Categoryv2($klasKategori,$y,$idinstitution);
    		$objPHPExcel = $this->format_emptyDetail($objPHPExcel,$objPHPtemplate,$katDetail,$y,$katg);
    	}

    	$fname = "rekap_".$katg."_".$namainstitusi."_".$yjudul.".xlsx";
    	$this->aggregate_rekap($objPHPExcel,$fname,FALSE);
    }

    private function get_yeardata_Categoryv2($klasKategori,$year,$idinstitution){
		$month = range(1,12);
		$formal = array();
		$informal = array();
		
		for($i=1;$i<=count($month);$i++){
			/// formal
			$data = $this->CI->Rekap_model->count_split_class(2,$klasKategori,$i,$year,$idinstitution);
			array_push($formal,$data);
			/// informal
			$data = $this->CI->Rekap_model->count_split_class(1,$klasKategori,$i,$year,$idinstitution);
			array_push($informal,$data);
		}
		
		return array($formal,$informal);		
	}
	
	private function get_yearstatistik_Categoryv2($klasKategori,$year,$idinstitution){
		$month = range(1,12);
		$monthly = array();
		$sectorclass = array();
		$sumcallback = function ($a,$b){return $a+$b;};
		
		/// monthly stat
		for($i=0;$i<count($month);$i++){
			$data = array(0,0,0);
			foreach($klasKategori as $jenisKat){
				$tmp = $this->CI->Rekap_model->get_year_dynamic(NULL,$jenisKat,NULL,NULL,$month[$i],$year,TRUE,$idinstitution);
				$data = array_map($sumcallback,$data,$tmp);
			}
			array_push($monthly,$data);
		}
		
		//sector
		for($i=2;$i>0;$i--){
			//class
			foreach($klasKategori as $jenisKat){
				$data = $this->CI->Rekap_model->get_year_dynamic(NULL,$jenisKat,$i,NULL,NULL,$year,TRUE,$idinstitution);
				array_push($sectorclass,$data);
			}
		}
		
		return array($monthly,$sectorclass);		
	}

	private function get_detail_Categoryv2($klasKategori,$year,$idinstitution){
		$data = $this->CI->Rekap_model->getCategoryDetail($klasKategori,$year,$idinstitution);
		return $data;
	}

	private function format_emptyv2($phpexcelpool,$m_name,$namainstitusi,$data,$year,$katname){
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->setCellValue('A1','LAPORAN TAHUNAN PENGADUAN KASUS (PERMASALAHAN) TKI INSTITUSI '.strtoupper($namainstitusi));
		$objPHPExcel->getActiveSheet()->setCellValue('A2', 'KASUS '.strtoupper($katname));
		$objPHPExcel->getActiveSheet()->setCellValue('A3', 'TAHUN '.$year);
		$objPHPExcel->getActiveSheet()->setCellValue('A4', 'Waktu Cetak: '.date('d').' '.ucfirst(strtolower($m_name[date('m')])).' '.date('Y'));

		$objPHPExcel->getActiveSheet()->setCellValue('A5', 'NO');
		$objPHPExcel->getActiveSheet()->setCellValue('B5', 'BULAN');
		$objPHPExcel->getActiveSheet()->setCellValue('C5', 'SEKTOR');

		$letters = "C";
		$objPHPExcel->getActiveSheet()->setCellValue($letters.'6', 'FORMAL');
		$objPHPExcel->getActiveSheet()->setCellValue($letters.'7', 1);
		$letters = ++$letters;
		$endletterskl = $letters;
		$objPHPExcel->getActiveSheet()->setCellValue($letters.'6', 'INFORMAL');
		$objPHPExcel->getActiveSheet()->setCellValue($letters.'7', 2);
		$letters = ++$letters;

		$temp = $letters;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'5', 'JUMLAH KASUS');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'5', 'KASUS DISELESAIKAN');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue($temp.'5', 'KASUS DALAM PROSES');

		$jmlmonth = 12;
		$numbers = 8;
		for($i=0; $i<$jmlmonth; $i++){
			$num = $i + 1;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$numbers, $num);
			if($num < 10){
				$temp = '0'.$num;
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$numbers, $m_name[$temp]);
			}
			else {
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$numbers, $m_name[$num]);
			}
			$numbers = ++$numbers;
		}

		$temp = $numbers;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'JUMLAH KASUS');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'KASUS DISELESAIKAN');
		$temp = ++$temp;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$temp, 'KASUS DALAM PROSES');

		$rowData 	= $data[0];
		$bottomStat = $data[1];

		$formal   = $rowData[0];
		$informal = $rowData[1];

		$rownum1 = count($rowData[0]);
		$number  = 8;
		
		for($i=0; $i<$rownum1; $i++){
			$rownum2 = count($formal[$i]);
			$letter1 = "C";
			$letter2 = 'D';

			for($j=0;$j<$rownum2;$j++) {
				$val1 = $formal[$i][$j];
				$val2 = $informal[$i][$j];
				if($val1 != '0') {$objPHPExcel->getActiveSheet()->setCellValue($letter1.$number, $val1);}
				if($val2 != '0') {$objPHPExcel->getActiveSheet()->setCellValue($letter2.$number, $val2);}
				$letter1 = ++$letter1;
				$letter2 = ++$letter2;
			}

			$number = $number + 1;
		}

		$numrow1 = count($bottomStat[0]);
		$number  = 8;
		
		for($i=0;$i<$numrow1;$i++){
			$numrow2 = count($bottomStat[0][$i]);
			$letter = 'E';
			
			for($j=0;$j<$numrow2;$j++){
				$val = $bottomStat[0][$i][$j];
				if($val != 0) {$objPHPExcel->getActiveSheet()->setCellValue($letter.$number, $val);}
				$letter = ++$letter;
			}

			$number = $number + 1;
		}
		
		$rownum1 = count($bottomStat[1]);
		$letter = "C";
		
		for($i=0;$i<$rownum1;$i++){
			$rownum2 = count($bottomStat[1][$i]);
			$number  = $numbers;

			for($j=0;$j<$rownum2;$j++){
				$value = $bottomStat[1][$i][$j];
				$comb_letter = $letter.$number;
				if($value != '0') {$objPHPExcel->getActiveSheet()->setCellValue($comb_letter, $value);}

				$number = $number + 1;
			}

			$letter = ++$letter;
		}

		$threshold = $numbers - 1;
		for($i=0;$i<3;$i++){
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$numbers.':B'.$numbers);
			$objPHPExcel->getActiveSheet()->mergeCells($letters.'5:'.$letters.'7');
			$objPHPExcel->getActiveSheet()->setCellValue($letters.$numbers,'=SUM('.$letters.'8:'.$letters.$threshold.')');
			$objPHPExcel->getActiveSheet()->getStyle($letters.$numbers)->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
			->getStartColor()->setARGB('D1D1D1');
			$objPHPExcel->getActiveSheet()->getStyle('A'.$numbers.':B'.$numbers)->getFont()->setBold(true);;
			if($i!=2){
				$letters = ++$letters;
				$numbers = ++$numbers;
			}
		}

		$objPHPExcel->getActiveSheet()->mergeCells('A1:'.$letters.'1')
			->mergeCells('A2:'.$letters.'2')
			->mergeCells('A3:'.$letters.'3')
			->mergeCells('A4:'.$letters.'4')
			->mergeCells('A5:A7')
			->mergeCells('B5:B7')
			->mergeCells('C5:'.$endletterskl.'5');

		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getRowDimension(5)->setRowHeight(30);
		$objPHPExcel->getActiveSheet()->getRowDimension(6)->setRowHeight(100);
		for ($col = ord('C'); $col <= ord($letters); $col++){
			$objPHPExcel->getActiveSheet()->getColumnDimension(chr($col))->setWidth(7.5);
		}

		$styleJudul = array('font' => array('name' => 'Calibri','size' => 12,'bold' => true));

		$styleAll = array(
			'font' => array('name' => 'Calibri','size' => 9.5),
			'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,'wrap' => true),
			'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))
			);

		$objPHPExcel->getActiveSheet()->getStyle('A1:'.$letters.$numbers)->applyFromArray($styleAll);
		$objPHPExcel->getActiveSheet()->getStyle('A1:A3')->applyFromArray($styleJudul);
		$objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$objPHPExcel->getActiveSheet()->getStyle('A5:'.$letters.'5')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('B8:B'.$threshold)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

		$objPHPExcel->getActiveSheet()->getStyle($endletterskl.'5:'.$endletterskl.$numbers)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$threshold.':'.$letters.$threshold)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);

		$objPHPExcel->getActiveSheet()->setTitle(strtoupper($katname)."_".$year);
		$phpexcelpool->addExternalSheet($objPHPExcel->getSheet(0));
		
		return $phpexcelpool;
	}

	private function format_emptyDetail($phpexcelpool,$phpexceltemplate,$data,$year,$katname){
		
		$sheet =  $phpexceltemplate->getActiveSheet();
		///
		$number = 4;
		for($i=0;$i<count($data);$i++){
			
			$letter = 'A';
			$cnum = $number + $i;
			$cdata = $data[$i];

			///// filtering
			$infoTKI = "";
			$stattki = $cdata['statustki']==1 ? "Resmi" : "Kaburan";
			if($cdata['paspor']==""){
				$infoTKI = $cdata['namatki'];
				if($stattki=="Kaburan"){
					$infoTKI = $infoTKI."\n".$stattki;
				}
			}
			else{
				$infoTKI = $cdata['namatki']."\n".$cdata['paspor']."\n".$stattki;
			}
			
			$statmasalah = $cdata['statusmasalah']==2 ? "Selesai\n".$cdata['tanggalpenyelesaian'] : "Proses";
			
			if($cdata['agensi'] == '') $cdata['agensi']="-";
			if($cdata['pptkis'] == '') $cdata['pptkis']="-";
			
			$cdata['permasalahan'] = preg_replace('"(\r?\n){2,}"', "\n\n", $cdata['permasalahan']);
			$cdata['tindaklanjut'] = preg_replace('"(\r?\n){2,}"', "\n\n", $cdata['tindaklanjut']);
			
			//// entry to excel			
			$sheet->setCellValue($letter.$cnum,$i+1);
			$letter++;
			$sheet->setCellValue($letter.$cnum,$infoTKI);
			$letter++;
			$sheet->setCellValue($letter.$cnum,$cdata['jenis']);
			$letter++;
			$sheet->setCellValue($letter.$cnum,$cdata['agensi']."\n".$cdata['pptkis']);
			$letter++;
			$sheet->setCellValue($letter.$cnum,$cdata['permasalahan']);
			$letter++;
			$sheet->setCellValue($letter.$cnum,$cdata['tindaklanjut']);
			$letter++;
			$sheet->setCellValue($letter.$cnum,$cdata['nama']);
			$letter++;
			$sheet->setCellValue($letter.$cnum,$statmasalah);
		}
		
		/// time param + sheetname
		$sheetname  = "DETAIL_".($katname)."_".$year;

		/// labeling sheet param + date	+ SUM
		$sheet->setCellValue("A1","DATA KASUS TKI ".strtoupper($katname));
		$sheet->setCellValue('A2', 'TAHUN '.$year);
		
		$styleContent = array(
			'font' 		=> array('name' => 'Arial','size' => 9),
			'borders' 	=> array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN))
			);
		
		$numdim = $number + count($data) - 1;
		
		$sheet->getStyle('A4:H'.$numdim)->applyFromArray($styleContent);
		$sheet->getStyle('A4:H'.$numdim)->getAlignment()->setWrapText(true);
		$sheet->getStyle('A4:H'.$numdim)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		$sheet->getStyle('A4:A'.$numdim)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$sheet->setTitle($sheetname);
		$phpexcelpool->addExternalSheet($sheet);
		
		return $phpexcelpool;
	}

    // public function generateKelas($time,$katg) {
    // 	$objPHPExcel = new PHPExcel();
    // 	$objPHPExcel->removeSheetByIndex(0);

    // 	$objReader = PHPExcel_IOFactory::createReader('Excel2007');
    // 	$objReader->setIncludeCharts(TRUE);

    // 	$get_time = explode(',',$time);
    // 	foreach ($get_time as $time_info) {
    // 		$get_date = explode('/',$time_info);
    // 		$y 		  = $get_date[0];

				// //// STATISTIK
    // 		$objPHPtemplate = $objReader->load($this->CI->input->server('DOCUMENT_ROOT').'/sisnaker-atase/assets/template/RekapEmpty3.xlsx');		
    // 		$katDetail = $this->get_yeardata_Category($y,$katg);				
    // 		$katStatistik = $this->get_yearstatistik_Category($y,$katg);				
    // 		$data = array($katDetail[0],array($katDetail[1],$katDetail[2]),$katStatistik);					
    // 		$objPHPExcel = $this->format_empty($objPHPExcel,$objPHPtemplate,$data,$y,$katg);

				// //// Detail
    // 		$objPHPtemplate = $objReader->load($this->CI->input->server('DOCUMENT_ROOT').'/sisnaker-atase/assets/template/DetailKategori.xlsx');
    // 		$katDetail = $this->get_detail_Category($y,$katg);

    // 		$objPHPExcel = $this->format_emptyDetail($objPHPExcel,$objPHPtemplate,$katDetail,$y,$katg);
    // 	}
    // 	$this->aggregate_rekap($objPHPExcel,$katg,FALSE);
    // }
    
    public function generateShelter($time,$org) {
    	$m_name = array('01' => 'JANUARI', '02' => 'FEBRUARI',
			'03' => 'MARET','04' => 'APRIL','05' => 'MEI',
			'06' => 'JUNI','07' => 'JULI','08' => 'AGUSTUS',
			'09' => 'SEPTEMBER','10' => 'OKTOBER','11' => 'NOVEMBER',
			'12' => 'DESEMBER');
    	$maxm = 0;
		$maxy = 0;
		$mjudul = "";
		$yjudul = "";

    	$objPHPExcel = new PHPExcel();
    	$objPHPExcel->removeSheetByIndex(0);

    	$objReader = PHPExcel_IOFactory::createReader('Excel2007');
    	$objReader->setIncludeCharts(TRUE);

    	$get_time = explode(',',$time);
    	foreach ($get_time as $time_info) {
    		$get_date = explode('/',$time_info);				
    		$m 		  = $get_date[1];
    		$d 		  = $get_date[2];
    		$y 		  = $get_date[0];

    		$tempm = (int)$m;
    		$tempy = (int)$y;
    		if($tempy > $maxy){
    			$maxy = $tempy;
    			$maxm = 0;
    			$yjudul = $y;
    			$mjudul = $m_name[$m];
    		} else if($tempy == $maxy){
    			if($tempm > $maxm){
    				$maxm = $tempm;
    				$mjudul = $m_name[$m];
    			}
    		}

    		$objPHPtemplate = $objReader->load($this->CI->input->server('DOCUMENT_ROOT').'/sisnaker-atase/assets/template/RekapShelter.xlsx');

    		$shelterdetail = $this->get_data_shelter($org,$m,$y);

    		$objPHPExcel = $this->format_shelter($objPHPExcel,$objPHPtemplate,$m_name,$shelterdetail,$m,$y,$org);
    	}

    	$fname = "rekap_Shelter_".$shelterdetail[0]['name']."_".$mjudul."_".$yjudul.".xlsx";
    	$this->aggregate_rekap($objPHPExcel,$fname,FALSE);
    }
    
    private function get_data_shelter($shelter,$month,$year){
    	$this->CI->load->model('Perlindungan/Shelter_model');
    	$result = $this->CI->Shelter_model->recap_shelter($shelter,$month,$year);
    	return $result;
    }

    private function format_shelter($phpexcelpool,$phpexceltemplate,$m_name,$shelterdetail,$m,$y,$org){
		$org_name = $shelterdetail[0]['name'];
		$sheetname = $m_name[$m].'_'.$y;
		
		// cross check data availability
		if($shelterdetail==0){
			$phpexcelpool->addExternalSheet($phpexceltemplate->getSheet(0));	
			return $phpexcelpool;
		}
		
		/// format cell
		$numrow1 = count($shelterdetail);
		for($i=0;$i<$numrow1;$i++){
			///each row
			$letter = 'A';
			$k = $i+5;
			$phpexceltemplate->getActiveSheet()->setCellValue($letter.$k,$i+1);
			$letter++;
			$phpexceltemplate->getActiveSheet()->setCellValue($letter.$k,$shelterdetail[$i]['pptkis']."\n".$shelterdetail[$i]['tanggalmasuktaiwan']);
			$letter++;
			$phpexceltemplate->getActiveSheet()->setCellValue($letter.$k,$shelterdetail[$i]['namatki']."\n".$shelterdetail[$i]['paspor']);
			$letter++;
			$phpexceltemplate->getActiveSheet()->setCellValue($letter.$k,$shelterdetail[$i]['agensi']."\n".$shelterdetail[$i]['teleponagensi']);
			$letter++;
			$phpexceltemplate->getActiveSheet()->setCellValue($letter.$k,$shelterdetail[$i]['majikan']);
			$letter++;
			$km = $shelterdetail[$i]['namapelapor']."\n Masuk: ".$shelterdetail[$i]['tanggalmasukshelter']."\n Keluar: ";
			if($shelterdetail[$i]['tanggalkeluarshelter']!='0000-00-00'){
				$km = $km.$shelterdetail[$i]['tanggalkeluarshelter'];
			}
			$phpexceltemplate->getActiveSheet()->setCellValue($letter.$k,$km);
			$letter++;
			$phpexceltemplate->getActiveSheet()->setCellValue($letter.$k,"Masalah: \n".$shelterdetail[$i]['permasalahan'].
				"\nTindakLanjut: \n".$shelterdetail[$i]['tindaklanjut']);
		}
		
		$numMax = $numrow1+5;
		$phpexceltemplate->getActiveSheet()->setCellValue('A2', $org_name.' - '.$m_name[$m].' '.$y);
		$phpexceltemplate->getActiveSheet()->setCellValue('A3', 'tanggal cetak: '.date('d').' '.ucfirst(strtolower($m_name[date('m')])).' '.date('Y'));
		$styleContent = array(
			'font' => array('name' => 'Calibri','size' => 11),
			'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP ),
			'style' => PHPExcel_Style_Border::BORDER_THIN
			);
		$phpexceltemplate->getActiveSheet()->getStyle('A5:G'.$numMax)->applyFromArray($styleContent);
		$phpexceltemplate->getActiveSheet()->getStyle('A5:G'.$numMax)->getAlignment()->setWrapText(true);
		$phpexceltemplate->getActiveSheet()->getStyle('G5:G'.$numMax)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
		$phpexceltemplate->getActiveSheet()->setTitle($sheetname);
		$phpexcelpool->addExternalSheet($phpexceltemplate->getSheet(0));		
		return $phpexcelpool;
	}

	private function aggregate_rekap($objPHPExcel,$fname,$potrait=FALSE) {
		
		$sheetcount = $objPHPExcel->getSheetCount();
		for ($i=0;$i<$sheetcount;$i++) {
			$objPHPExcel->setActiveSheetIndex($i);
			$objWorkSheet = $objPHPExcel->getActiveSheet()->getPageSetup();
			
			if($potrait==FALSE){
				$objWorkSheet->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objWorkSheet->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
				$objWorkSheet->setFitToPage(true);
				$objWorkSheet->setFitToWidth(1);
				$objWorkSheet->setFitToHeight(0);
			}
			else {
				$objWorkSheet->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
				$objWorkSheet->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
				$objWorkSheet->setFitToPage(true);
				$objWorkSheet->setFitToWidth(0);
				$objWorkSheet->setFitToHeight(0);
			}
		}
		
		$objPHPExcel->setActiveSheetIndex(0);
		
		//// Redirect output to a client(Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$fname.'"');
		header('Cache-Control: max-age=0');
		//// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		//
		//// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		//
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->setIncludeCharts(TRUE);

		if($this->filedir == NULL){
			$objWriter->save('php://output');
			exit;
		}
		else {
			$objWriter->save($this->filedir.$fname);
			return $fname;
		}
		
	}
    
  //   private function get_yeardata($year,$lingkup=null){
  //   	$month = range(1,12);

		// // Get per classification
  //   	$get_classification = $this->CI->Rekap_model->get_classification();
  //   	$hasilpermonth = array();
  //   	for($i=0;$i<count($month);$i++) {
  //   		$jumlah_pool = array();
  //   		foreach ($get_classification->result() as $row_class) {
  //   			$jumlah = $this->CI->Rekap_model->get_yearrekap($row_class->id,$month[$i],$year,$lingkup);
  //   			array_push($jumlah_pool,$jumlah);
  //   		}

		// 	// Get per month
  //   		$jumlah_month = $this->CI->Rekap_model->get_yearrekap_permonth($month[$i], $year,$lingkup);
  //   		$result = array_merge($jumlah_pool,$jumlah_month);
  //   		array_push($hasilpermonth,$result);
  //   	}

  //   	$hasilperklasifikasi = array();
  //   	foreach ($get_classification->result() as $row_class) {
  //   		$jumlah = $this->CI->Rekap_model->get_yearrekap_based_class($row_class->id,$year,$lingkup);
  //   		array_push($hasilperklasifikasi,$jumlah);
  //   	}

  //   	return array($hasilpermonth,$hasilperklasifikasi);
  //   }

 //    private function get_yeardata_bySubject($subject,$year,$lingkup=null){		
	// 	// Get per classification
 //    	$get_class = $this->CI->Rekap_model->get_classification()->result_array();
 //    	$size_class = count($get_class);
	// 	// Get per subject
 //    	if($subject=='jenis') {
 //    		$get_subject = $this->CI->Rekap_model->get_work_type()->result_array();
 //    	}
 //    	if($subject=='sektor') {
	// 		$get_subject = array(2,1);// FORMAL, INFORMAL
	// 	}
	// 	if($subject=='status') {
	// 		$get_subject = array(1,2);// RESMI, KABURAN
	// 	}
	// 	$size_subject = count($get_subject);
				
	// 	$hasilpersubject = array();
		
	// 	for($i=0;$i<$size_subject;$i++){
	// 		$rowarray = array();
	// 		// data per baris
	// 		for($j=0;$j<$size_class;$j++){
	// 			if($subject=='jenis') {
	// 				$cnt = $this->CI->Rekap_model->get_year_dynamic_array(array(
	// 					"work"=>$get_subject[$i]['idjenispekerjaan'],
	// 					"class"=>$get_class[$j]['id'],
	// 					"lingkup"=>$lingkup
	// 					), NULL, $year);
	// 			}
	// 			if($subject=='sektor') {
	// 				$cnt = $this->CI->Rekap_model->get_year_dynamic_array(array(
	// 					"sector"=>$get_subject[$i],
	// 					"class"=>$get_class[$j]['id'],
	// 					"lingkup"=>$lingkup
	// 					), NULL, $year);
	// 			}
	// 			if($subject=='status') {
	// 				$cnt = $this->CI->Rekap_model->get_year_dynamic_array(array(
	// 					"statustki"=>$get_subject[$i],
	// 					"class"=>$get_class[$j]['id'],
	// 					"lingkup"=>$lingkup
	// 					), NULL, $year);
	// 			}
				
	// 			array_push($rowarray,$cnt);
	// 		}
	// 		// statistik
	// 		if($subject=='jenis') {
	// 			$tmparray = $this->CI->Rekap_model->get_year_dynamic_array(array(
	// 				"work"=>$get_subject[$i]['idjenispekerjaan'],
	// 				"lingkup"=>$lingkup
	// 				), NULL, $year, TRUE);
	// 		}
	// 		if($subject=='sektor') {
	// 			$tmparray = $this->CI->Rekap_model->get_year_dynamic_array(array(
	// 				"sector"=>$get_subject[$i],
	// 				"lingkup"=>$lingkup
	// 				), NULL, $year, TRUE);
	// 		}
	// 		if($subject=='status') {
	// 			$tmparray = $this->CI->Rekap_model->get_year_dynamic_array(array(
	// 				"statustki"=>$get_subject[$i],
	// 				"lingkup"=>$lingkup
	// 				), NULL, $year, TRUE);
	// 		}
			
	// 		// merge all, pro, fin
	// 		$result = array_merge($rowarray,$tmparray);
	// 		array_push($hasilpersubject,$result);
	// 	}
		
	// 	$hasilperklasifikasi = array();
	// 	for($j=0;$j<$size_class;$j++){
	// 		$cnt = $this->CI->Rekap_model->get_year_dynamic_array(array( "class"=> $get_class[$j]['id'], "lingkup"=>$lingkup), NULL, $year, TRUE);
	// 		array_push($hasilperklasifikasi,$cnt);
	// 	}
		
	// 	return array($hasilpersubject, $hasilperklasifikasi);
	// }

	// private function get_yeardata_Category($year,$category){
	// 	//formal=2, informal=1
	// 	$klasquery = $this->CI->Rekap_model->get_classification($category)->result_array();
	// 	$klasKategori = array();
	// 	foreach($klasquery as $oneresult){
	// 		array_push($klasKategori,$oneresult['id']);
	// 	}
		
	// 	$month = range(1,12);
	// 	$formal = array();
	// 	$informal = array();
		
	// 	for($i=1;$i<=count($month);$i++){
	// 		/// formal
	// 		$data = $this->CI->Rekap_model->count_split_class(2,$klasKategori,$i,$year);
	// 		array_push($formal,$data);
	// 		/// informal
	// 		$data = $this->CI->Rekap_model->count_split_class(1,$klasKategori,$i,$year);
	// 		array_push($informal,$data);
	// 	}
		
	// 	return array($klasquery,$formal,$informal);		
	// }
	
	// private function get_yearstatistik_Category($year,$category){
	// 	//formal=2, informal=1
	// 	$klasquery = $this->CI->Rekap_model->get_classification($category)->result_array();		
	// 	$klasKategori = array();
	// 	foreach($klasquery as $oneresult){
	// 		array_push($klasKategori,$oneresult['id']);
	// 	}
		
	// 	$month = range(1,12);
	// 	$monthly = array();
	// 	$sectorclass = array();
	// 	$sumcallback = function ($a,$b){return $a+$b;};
		
	// 	/// monthly stat
	// 	for($i=0;$i<count($month);$i++){
	// 		$data = array(0,0,0);
	// 		foreach($klasKategori as $jenisKat){
	// 			$tmp = $this->CI->Rekap_model->get_year_dynamic(NULL,$jenisKat,NULL,NULL,$month[$i],$year,TRUE);
	// 			$data = array_map($sumcallback,$data,$tmp);
	// 		}
	// 		array_push($monthly,$data);
	// 	}
		
	// 	//sector
	// 	for($i=2;$i>0;$i--){
	// 		//class
	// 		foreach($klasKategori as $jenisKat){
	// 			$data = $this->CI->Rekap_model->get_year_dynamic(NULL,$jenisKat,$i,NULL,NULL,$year,TRUE);
	// 			array_push($sectorclass,$data);
	// 		}
	// 	}
		
	// 	return array($monthly,$sectorclass);		
	// }

	// private function get_detail_Category($year,$category){
	// 	$klasquery = $this->CI->Rekap_model->get_classification($category)->result_array();
	// 	$klasKategori = array();
	// 	foreach($klasquery as $oneresult){
	// 		array_push($klasKategori,$oneresult['id']);
	// 	}
		
	// 	$data = $this->CI->Rekap_model->getCategoryDetail($klasKategori,$year);
	// 	return $data;
	// }

	// private function get_jenis_based($month,$year) {
	// 	$get_jenis = $this->CI->Rekap_model->get_work_type();
	// 	$hasilperjenis = array();
	// 	$get_classification = $this->CI->Rekap_model->get_classification();
	// 	$hasilperklasifikasi = array();

	// 	// LOOPING BERDASARKAN JENIS 
	// 	foreach($get_jenis->result() as $row_jenis) {
	// 		$jumlah_pool = array();
	// 		foreach($get_classification->result() as $row_class) {
	// 			$jumlah = $this->CI->Rekap_model
	// 			->count_based_typeclass($row_jenis->idjenispekerjaan,
	// 				$row_class->id,
	// 				$month,$year);
	// 			array_push($jumlah_pool, $jumlah);
	// 		}
			
	// 		// Get all problem (process + finished), finished, processed
	// 		$jumlah_type_based = $this->CI->Rekap_model
	// 		->count_aggregate('m.idjenispekerjaan',$row_jenis->idjenispekerjaan,$month,$year);
	// 		$result = array_merge($jumlah_pool, $jumlah_type_based);
	// 		array_push($hasilperjenis, $result);
	// 	}

	// 	// LOOPING BERDASARKAN KLASIFIKASI
	// 	foreach ($get_classification->result() as $row_class) {
	// 		$jumlah = $this->CI->Rekap_model
	// 		->count_aggregate('m.idklasifikasi',$row_class->id,$month,$year);
	// 		array_push($hasilperklasifikasi, $jumlah);
	// 	}
		
	// 	return array($hasilperjenis,$hasilperklasifikasi);
	// }
	
	// private function get_sektor_based($month,$year) {
	// 	/*
	// 	 * 1. Informal
	// 	 * 2. Formal
	// 	 * */
	// 	$arr_sector = array('2','1');
	// 	$get_classification = $this->CI->Rekap_model->get_classification();
		
	// 	$hasilpersektor = array();
	// 	foreach ($arr_sector as $sector) {
	// 		$jumlah_pool = array();
	// 		foreach ($get_classification->result() as $row_class) {
	// 			$jumlah = $this->CI->Rekap_model
	// 			->count_sector_based_class($sector,$row_class->id,
	// 				$month,$year);
	// 			array_push($jumlah_pool,$jumlah);
	// 		}
			
	// 		// Get all problems (finished+processed), finished, processed
	// 		$jumlah_sektor_aggregate = $this->CI->Rekap_model
	// 		->count_aggregate('sektor',$sector,$month,$year);
	// 		$result = array_merge($jumlah_pool,$jumlah_sektor_aggregate);
	// 		array_push($hasilpersektor,$result);
	// 	}
		
	// 	$hasilperklasifikasi = array();
	// 	foreach ($get_classification->result() as $row_class) {
	// 		$jumlah = $this->CI->Rekap_model
	// 		->count_aggregate('m.idklasifikasi',$row_class->id,$month,$year);
	// 		array_push($hasilperklasifikasi,$jumlah);
	// 	}
		
	// 	return array($hasilpersektor,$hasilperklasifikasi);
	// }
	
	// private function get_status_based($month,$year) {
	// 	/*
	// 	 * 1. Resmi
	// 	 * 2. Kaburan
	// 	 * */
	// 	$arr_status = array('1','2');
	// 	$get_classification = $this->CI->Rekap_model->get_classification();
		
	// 	$hasilperstatus = array();
	// 	foreach ($arr_status as $status) {
	// 		$jumlah_pool = array();
	// 		foreach ($get_classification->result() as $row_class) {
	// 			$jumlah = $this->CI->Rekap_model
	// 			->count_status_based_class($status,$row_class->id,$month,$year);
	// 			array_push($jumlah_pool,$jumlah);
	// 		}
			
	// 		$jumlah_status_aggregate = $this->CI->Rekap_model
	// 		->count_aggregate('m.statustki',$status,$month,$year);
	// 		$result = array_merge($jumlah_pool,$jumlah_status_aggregate);
	// 		array_push($hasilperstatus,$result);
	// 	}
		
	// 	$hasilperklasifikasi = array();
	// 	foreach ($get_classification->result() as $row_class) {
	// 		$jumlah = $this->CI->Rekap_model
	// 		->count_aggregate('m.idklasifikasi',$row_class->id,$month,$year);
	// 		array_push($hasilperklasifikasi,$jumlah);
	// 	}
		
	// 	return array($hasilperstatus,$hasilperklasifikasi);
	// }

	// private function format_jenis_based($phpexcelpool,$phpexceltemplate,$hasilperjenis,$hasilperklasifikasi,
	// 	$m_name,$month,$year) {
	// 	$rownum1 = count($hasilperjenis);
	// 	$number  = 9;
		
	// 	for($i=0; $i<$rownum1; $i++){
	// 		$rownum2 = count($hasilperjenis[$i]);
	// 		$letter = "C";

	// 		for($j=0;$j<$rownum2;$j++) {
	// 			$value = $hasilperjenis[$i][$j];

	// 			if ($rownum2 - $j == 9) {
	// 				$letter = "AA";
	// 			}	
				
	// 			$comb_letter = $letter.$number;
	// 			if($value != '0') {$phpexceltemplate->getActiveSheet()->setCellValue($comb_letter, $value);}

	// 			$letter = ++$letter;
	// 		}

	// 		$number = $number + 1;
	// 	}
		
	// 	$rownum1 = count($hasilperklasifikasi);
	// 	$letter = "C";
		
	// 	for($i=0;$i<$rownum1;$i++){
	// 		$rownum2 = count($hasilperklasifikasi[$i]);
	// 		$number  = 17;

	// 		for($j=0;$j<$rownum2;$j++){
	// 			$value = $hasilperklasifikasi[$i][$j];
	// 			$comb_letter = $letter.$number;
	// 			if($value != '0') {$phpexceltemplate->getActiveSheet()->setCellValue($comb_letter, $value);}

	// 			$number = $number + 1;
	// 		}

	// 		$letter = ++$letter;
	// 	}
		
	// 	$styleContent = array(
	// 		'font' => array('name' => 'Calibri','size' => 9),
	// 		'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
	// 		);
		
	// 	$styleHeader = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));		
	// 	$styleList = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT));
		
		
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AA17','=SUM(C17:Z17)');
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AB18','=SUM(C18:Z18)');
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AC19','=SUM(C19:Z19)');
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AD20','=SUM(C20:Z20)');
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AE21','=SUM(C21:Z21)');
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AF22','=SUM(C22:Z22)');
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AG23','=SUM(C23:Z23)');
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AH24','=SUM(C24:Z24)');
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AI25','=SUM(C25:Z25)');
		
	// 	$phpexceltemplate->getActiveSheet()->getStyle('Z6:AH6')->applyFromArray($styleHeader);
	// 	$phpexceltemplate->getActiveSheet()->getStyle('B9:B15')->applyFromArray($styleList);
	// 	$phpexceltemplate->getActiveSheet()->getStyle('C9:AI25')->applyFromArray($styleContent);
		
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('A4', $m_name[$month].' '.$year);
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AA27', 'Taipei, '.date('d').' '.ucfirst(strtolower($m_name[date('m')])).' '.date('Y'));

	// 	$phpexceltemplate->getActiveSheet()->setTitle('Jenis '.$m_name[$month].' '.$year);
		
	// 	$phpexcelpool->addExternalSheet($phpexceltemplate->getSheet(0));
		
	// 	return $phpexcelpool;
	// }
	
	// private function format_sector_based($phpexcelpool,$phpexceltemplate,
	// 	$hasilpersektor,$hasilperklasifikasi,
	// 	$m_name,$month,$year) {
	// 	$number = 9;
	// 	$numrow = count($hasilpersektor);
	// 	for($i=0;$i<$numrow;$i++) {
	// 		$numrow2 = count($hasilpersektor[$i]);
	// 		$letter = 'C';

	// 		for($j=0;$j<$numrow2;$j++) {

	// 			$val = $hasilpersektor[$i][$j];

	// 			if ($numrow2 - $j == 9) {
	// 				$letter = "AA";
	// 			}

	// 			$comb_letter = $letter.$number;
	// 			if($val != '0') {$phpexceltemplate->getActiveSheet()->setCellValue($comb_letter, $val);}
	// 			$letter = ++$letter;

	// 		}

	// 		$number = $number + 1;
	// 	}
		
	// 	$letter = 'C';
	// 	$numrow1 = count($hasilperklasifikasi);
	// 	for($i=0;$i<$numrow1;$i++) {
	// 		$numrow2 = count($hasilperklasifikasi[$i]);
	// 		$number = 11;

	// 		for($j=0;$j<$numrow2;$j++) {
	// 			$val = $hasilperklasifikasi[$i][$j];
	// 			$comb_letter = $letter.$number;
	// 			if($val != 0) {$phpexceltemplate->getActiveSheet()->setCellValue($comb_letter, $val);}

	// 			$number = $number + 1;
	// 		}

	// 		$letter = ++$letter;
	// 	}
		
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('A4', $m_name[$month].' '.$year);
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AA21', 'Taipei, '.date('d').' '.ucfirst(strtolower($m_name[date('m')])).' '.date('Y'));
		
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AA11','=SUM(C11:Z11)');
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AB12','=SUM(C12:Z12)');
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AC13','=SUM(C13:Z13)');
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AD14','=SUM(C14:Z14)');
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AE15','=SUM(C15:Z15)');
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AF16','=SUM(C16:Z16)');
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AG17','=SUM(C17:Z17)');
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AH18','=SUM(C18:Z18)');
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AI19','=SUM(C19:Z19)');
		
	// 	$styleContent = array(
	// 		'font' => array('name' => 'Calibri','size' => 9),
	// 		'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
	// 		);
		
	// 	$phpexceltemplate->getActiveSheet()->getStyle('C9:AI19')->applyFromArray($styleContent);
		
	// 	$phpexceltemplate->getActiveSheet()->setTitle('Sektor '.$m_name[$month].' '.$year);
		
		
	// 	$phpexcelpool->addExternalSheet($phpexceltemplate->getSheet(0));
		
	// 	return $phpexcelpool;
	// }
	
	// private function format_status_based($phpexcelpool,$phpexceltemplate,
	// 	$hasilperstatus,$hasilperklasifikasi,
	// 	$m_name,$month,$year) {
	// 	$number = 9;
	// 	$numrow = count($hasilperstatus);
	// 	for($i=0;$i<$numrow;$i++) {
	// 		$numrow2 = count($hasilperstatus[$i]);
	// 		$letter = 'C';

	// 		for($j=0;$j<$numrow2;$j++) {

	// 			$val = $hasilperstatus[$i][$j];

	// 			if ($numrow2 - $j == 9) {
	// 				$letter = "AA";
	// 			}

	// 			$comb_letter = $letter.$number;
	// 			if($val != '0') {$phpexceltemplate->getActiveSheet()->setCellValue($comb_letter, $val);}
	// 			$letter = ++$letter;

	// 		}

	// 		$number = $number + 1;
	// 	}
		
	// 	$letter = 'C';
	// 	$numrow1 = count($hasilperklasifikasi);
	// 	for($i=0;$i<$numrow1;$i++) {
	// 		$numrow2 = count($hasilperklasifikasi[$i]);
	// 		$number = 11;

	// 		for($j=0;$j<$numrow2;$j++) {
	// 			$val = $hasilperklasifikasi[$i][$j];
	// 			$comb_letter = $letter.$number;
	// 			if($val != 0) {$phpexceltemplate->getActiveSheet()->setCellValue($comb_letter, $val);}

	// 			$number = $number + 1;
	// 		}

	// 		$letter = ++$letter;
	// 	}
		
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('A4', $m_name[$month].' '.$year);
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AA21', 'Taipei, '.date('d').' '.ucfirst(strtolower($m_name[date('m')])).' '.date('Y'));
		
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AA11','=SUM(C11:Z11)');
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AB12','=SUM(C12:Z12)');
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AC13','=SUM(C13:Z13)');
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AD14','=SUM(C14:Z14)');
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AE15','=SUM(C15:Z15)');
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AF16','=SUM(C16:Z16)');
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AG17','=SUM(C17:Z17)');
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AH18','=SUM(C18:Z18)');
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AI19','=SUM(C19:Z19)');
		
	// 	$styleContent = array(
	// 		'font' => array('name' => 'Calibri','size' => 9),
	// 		'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
	// 		);
		
	// 	$phpexceltemplate->getActiveSheet()->getStyle('C9:AI19')->applyFromArray($styleContent);
		
	// 	$phpexceltemplate->getActiveSheet()->setTitle('Status '.$m_name[$month].' '.$year);
		
	// 	$phpexcelpool->addExternalSheet($phpexceltemplate->getSheet(0));
		
	// 	return $phpexcelpool;
	// }


	// private function format_yearrekap($phpexcelpool,$phpexceltemplate,
	// 	$hasilpermonth,$hasilperklasifikasi,$m_name,$year, $lingkup=null){
	// 	$number  = 8;
	// 	$numrow1 = count($hasilpermonth);
		
	// 	for($i=0;$i<$numrow1;$i++) {
	// 		$numrow2 = count($hasilpermonth[$i]);
	// 		$letter  = 'C';
			
	// 		for($j=0;$j<$numrow2;$j++) {
	// 			$val = $hasilpermonth[$i][$j];

	// 			if ($numrow2 - $j == 3) {
	// 				$letter = "AA";
	// 			}
				
	// 			if($val != 0) {$phpexceltemplate->getActiveSheet()->setCellValue($letter.$number, $val);}
	// 			$letter = ++$letter;
	// 		}
			
	// 		$number = $number + 1;
	// 	}
		
	// 	$numrow1 = count($hasilperklasifikasi);
	// 	$letter  = 'C';
		
	// 	for($i=0;$i<$numrow1;$i++) {
	// 		$numrow2 = count($hasilperklasifikasi[$i]);
	// 		$number  = 20;
			
	// 		for($j=0;$j<$numrow2;$j++) {
	// 			$val = $hasilperklasifikasi[$i][$j];
				
	// 			if($val != 0) {$phpexceltemplate->getActiveSheet()->setCellValue($letter.$number, $val);}
	// 			$number = $number + 1;
	// 		}
	// 		$letter = ++$letter;
	// 	}
		
	// 	$day 		= date("d");
	// 	$cur_month  = date("m");
	// 	$curyear    = date("Y");
	// 	$today      = $day." ".$m_name[$cur_month]." ".$curyear;
		
	// 	if(!is_null($lingkup)) $phpexceltemplate->getActiveSheet()->setCellValue('A2', $lingkup);
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('A3', 'TAHUN '.$year);
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('X24', 'Taipei, '.$today);
		
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AA20', '=SUM(AA8:AA19)');
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AB21', '=SUM(AB8:AB19)');
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('AC22', '=SUM(AC8:AC19)');
		
	// 	$styleContent = array(
	// 		'font' => array('name' => 'Calibri','size' => 9),		
	// 		'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
	// 		);
		
	// 	$phpexceltemplate->getActiveSheet()->getStyle('C8:AD22')->applyFromArray($styleContent);
	// 	$phpexceltemplate->getActiveSheet()->setTitle('Tahun '.$year);
	// 	$phpexcelpool->addExternalSheet($phpexceltemplate->getSheet(0));
		
	// 	return $phpexcelpool;
	// }
	
	// private function format_yearrekap_dynamic($phpexcelpool,$phpexceltemplate,
	// 	$hasilpersubject,$hasilperklasifikasi,$m_name,$year, $arrayparam){
	// 	$initNumber = 9;
	// 	$number  = $initNumber;
	// 	$cnt1 = count($hasilpersubject);
		
	// 	for($i=0;$i<$cnt1;$i++) {
	// 		$cnt2 = count($hasilpersubject[$i]);
	// 		$letter  = 'C';
			
	// 		for($j=0;$j<$cnt2;$j++) {
	// 			$val = $hasilpersubject[$i][$j];

	// 			if ($cnt2 - $j == 3) {
	// 				$letter = "AA";
	// 			}
				
	// 			if($val != 0) {$phpexceltemplate->getActiveSheet()->setCellValue($letter.$number, $val);}
	// 			$letter = ++$letter;
	// 		}
			
	// 		$number = $number + 1;
	// 	}
		
	// 	$letter  = 'C';
	// 	if($cnt1 != 2) {
	// 		$initNumber = 17;
	// 	}
	// 	else {
	// 		$initNumber  = $initNumber + $cnt1;
	// 	}
		
	// 	$cnt1 = count($hasilperklasifikasi);
				
	// 	for($i=0;$i<$cnt1;$i++) {
			
	// 		$cnt2 = count($hasilperklasifikasi[$i]);
	// 		$number = $initNumber;
			
	// 		for($j=0;$j<$cnt2;$j++) {
	// 			$val = $hasilperklasifikasi[$i][$j];
				
	// 			if($val != 0) {$phpexceltemplate->getActiveSheet()->setCellValue($letter.$number, $val);}
	// 			$number = $number + 1;
	// 		}
	// 		$letter = ++$letter;
	// 	}
		
	// 	$day 		= date("d");
	// 	$cur_month  = date("m");
	// 	$curyear    = date("Y");
	// 	$today      = $day." ".$m_name[$cur_month]." ".$curyear;
		
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('A3', $arrayparam['lingkup']);
	// 	$phpexceltemplate->getActiveSheet()->setCellValue('A4', 'TAHUN '.$year);
	// 	$phpexceltemplate->getActiveSheet()->setCellValue($arrayparam['datesign'], 'Taipei, '.$today);
		
	// 	$phpexceltemplate->getActiveSheet()->setCellValue($arrayparam['total'], $arrayparam['totalEq']);
	// 	$phpexceltemplate->getActiveSheet()->setCellValue($arrayparam['done'], $arrayparam['doneEq']);
	// 	$phpexceltemplate->getActiveSheet()->setCellValue($arrayparam['pro'], $arrayparam['proEq']);
		
	// 	$styleContent = array(
	// 		'font' => array('name' => 'Calibri','size' => 9),		
	// 		'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
	// 		);
		
	// 	$phpexceltemplate->getActiveSheet()->getStyle($arrayparam['formatRange'])->applyFromArray($styleContent);
	// 	$phpexceltemplate->getActiveSheet()->setTitle($arrayparam['title'].' '.$year);
	// 	$phpexcelpool->addExternalSheet($phpexceltemplate->getSheet(0));
		
	// 	return $phpexcelpool;
	// }


	// private function format_empty($phpexcelpool,$phpexceltemplate,$data,$year,$katname){
	// 	$m_name = array('01' => 'JANUARI', '02' => 'FEBRUARI',
	// 		'03' => 'MARET','04' => 'APRIL','05' => 'MEI',
	// 		'06' => 'JUNI','07' => 'JULI','08' => 'AGUSTUS',
	// 		'09' => 'SEPTEMBER','10' => 'OKTOBER','11' => 'NOVEMBER',
	// 		'12' => 'DESEMBER');
		
	// 	$sheet =  $phpexceltemplate->getActiveSheet();
		
	// 	///
	// 	$katdetail 	= $data[0];
	// 	$matrix 	= $data[1];
	// 	$bottomStat = $data[2];

	// 	//// table head
	// 	$letter = 'C';
	// 	for($i = 0; $i < count($katdetail); $i++) {
	// 		$sheet->setCellValue($letter."8",$katdetail[$i]['name']); 
	// 		$letter++;
	// 	}
	// 	for($i = 0; $i < count($katdetail); $i++) {
	// 		$sheet->setCellValue($letter."8",$katdetail[$i]['name']); 
	// 		$letter++;
	// 	}
		
	// 	/// detail		
	// 	$number  = 10;
	// 	$numrow1 = count($matrix[0]);
		
	// 	$arrMonth = array();
	// 	$arrMoney = array();
	// 	$formal   = $matrix[0];
	// 	$informal = $matrix[1];
		
	// 	for($i=0;$i<$numrow1;$i++) {
	// 		$numrow2 = count($formal[$i]);
	// 		$letter1  = 'C';
	// 		$letter2  = 'F';
			
	// 		for($j=0;$j<$numrow2;$j++){
	// 			$val1 = $formal[$i][$j];
	// 			$val2 = $informal[$i][$j];
	// 			if($val1 != 0) {$sheet->setCellValue($letter1.$number, $val1);}
	// 			if($val2 != 0) {$sheet->setCellValue($letter2.$number, $val2);}
	// 			$letter1 = ++$letter1;
	// 			$letter2 = ++$letter2;
	// 		}
	// 		$number = $number + 1;	
	// 	}
		
	// 	///// statistik
	// 	$number  = 10;		
	// 	$numrow1 = count($bottomStat[0]);
		
	// 	for($i=0;$i<$numrow1;$i++){
	// 		$numrow2 = count($bottomStat[0][$i]);
	// 		$letter1 = 'I';
			
	// 		for($j=0;$j<$numrow2;$j++){
	// 			$val1 = $bottomStat[0][$i][$j];
	// 			if($val1 != 0) {$sheet->setCellValue($letter1.$number, $val1);}
	// 			$letter1++;
	// 		}
	// 		$number++;
	// 	}
		
	// 	$number  = 22;
	// 	$letter1 = 'C';
	// 	$numrow1 = count($bottomStat[1]);
		
	// 	for($i=0;$i<$numrow1;$i++){
	// 		$numrow2 = count($bottomStat[1][$i]);
	// 		$number  = 22;		
	// 		for($j=0;$j<$numrow2;$j++){
	// 			$val1 = $bottomStat[1][$i][$j];
	// 			if($val1 != 0) {$sheet->setCellValue($letter1.$number, $val1);}
	// 			$number++;
	// 		}
	// 		$letter1++;
	// 	}
		
		
	// 	/// time param + sheetname
	// 	$day 		= date("d");
	// 	$cur_month  = date("m");
	// 	$curyear    = date("Y");
	// 	$today      = $day." ".$m_name[$cur_month]." ".$curyear;
	// 	$sheetname  = strtoupper($katname)."_".$year;

	// 	/// labeling sheet param + date	+ SUM
	// 	$sheet->setCellValue("A1","LAPORAN TAHUNAN PENGADUAN KASUS TKI ".strtoupper($katname)." NEGARA TAIWAN");
	// 	$sheet->setCellValue("A2","KDEI TAIPEI");
	// 	$sheet->setCellValue('A3', 'TAHUN '.$year);
	// 	$sheet->setCellValue('H26', 'Taipei, '.$today);
	// 	$sheet->setCellValue('I22', '=SUM(I10:I21)');
	// 	$sheet->setCellValue('J23', '=SUM(J10:J21)');
	// 	$sheet->setCellValue('K24', '=SUM(K10:K21)');
		
	// 	$styleContent = array(
	// 		'font' => array('name' => 'Arial','size' => 9),		
	// 		'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
	// 		);
		
	// 	$sheet->getStyle('D10:K24')->applyFromArray($styleContent);
	// 	$sheet->setTitle($sheetname);
	// 	$phpexcelpool->addExternalSheet($sheet);
		
	// 	return $phpexcelpool;
	// }

}