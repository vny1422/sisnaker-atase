<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RekapEndorsement extends MY_Controller {

	private $data;

	private $monthDict = array(
		'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'Nopember',
		'Desember'
	);

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Endorsement/Rekap_model');
		$this->load->library('Excel');

		$this->load_sidebar();
		$this->data['listdp'] = $this->listdp;
		$this->data['usedpg'] = $this->usedpg;
		$this->data['usedmpg'] = $this->usedmpg;
		$this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
		$this->data['namakantor'] = $this->namakantor->nama;
		$this->data['sidebar'] = 'SAdmin/Sidebar';

		if ($this->session->userdata('role') != 1 && $this->session->userdata('role') != 2 && $this->session->userdata('role') != 6 && $this->session->userdata('role') != 7)
		{
			show_error("Access is forbidden.",403,"403 Forbidden");
		}
	}

	public function index()
	{
		$this->data['startMonth'] = 12; // bulan mulai laporan
		$this->data['startYear'] = 2015; // tahun mulai laporan

		$minShowReport = 4; // tanggal minimum menampilkan laporan

		// today
		$this->data['day'] = date('j');
		$this->data['month'] = date('n');
		$this->data['year'] = date('Y');

		if ($this->data['day'] < $minShowReport)
			$this->data['month'] -= 1;

		$this->data['title'] = 'Rekap';
		$this->data['subtitle'] = 'Download Laporan Rekap';
		$this->load->view('templates/headerendorsement', $this->data);
		$this->load->view('Endorsement/RekapLaporan_view', $this->data);
		$this->load->view('templates/footerendorsement');
	}

	public function rekapKuitansi($tanggal = NULL)
	{
		if($tanggal) {
			$tanggal = explode('-', $tanggal);
			if (count($tanggal == 2)) {
				$tahun = $tanggal[0];
				$bulan = date("m", mktime(0, 0, 0, $tanggal[1], 1, $tanggal[0]));
			}

			$objPHPExcel = new PHPExcel();
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'Tanggal Masuk')
						->setCellValue('B1', 'Tanggal Kuitansi')
						->setCellValue('C1', 'Nomor Kuitansi')
						->setCellValue('D1', 'Nama Pemohon')
						->setCellValue('E1', 'Jenis Endorsement')
						->setCellValue('F1', 'Jumlah Setoran')
						->setCellValue('G1', 'Barcode');

			// set column width & basic style
			$widths = array(
				"A" => 14,
				"B"	=> 17,
				"C" => 16.29,
				"D" => 17.71,
				"E" => 31.86,
				"F" => 13.14,
				"G" => 27.71
			);

			foreach ($widths as $key => $value) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($key)->setWidth(($value+0.71));
			}

			// apply style
			$style_header = array(
				'font'    => array(
					'bold'      => true
				),
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
				),
				'borders' => array(
					'allborders'     => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			);

			$style_cell = array(
				'borders' => array(
					'allborders'     => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				),
				'alignment' => array(
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
					'wrap' => true
				)
			);

			$query = $this->Rekap_model->getRekapKuitansi($tahun,$bulan);
	    	$i=2;
	    	foreach ($query as $row):
	    		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$i, $row->kutglmasuk)
					->setCellValue('B'.$i, $row->kutglkuitansi)
					->setCellValueExplicit('C'.$i, $row->kuno, PHPExcel_Cell_DataType::TYPE_STRING)
					->setCellValue('D'.$i, html_entity_decode($row->kupemohon))
					->setCellValue('E'.$i, $row->TIPE)
					->setCellValue('F'.$i, $row->kujmlbayar)
					->setCellValueExplicit('G'.$i, $row->kukode, PHPExcel_Cell_DataType::TYPE_STRING);
				$i++;
	    	endforeach;

	    	$i++;
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('E'.($i-1), 'JUMLAH')
				->setCellValue('F'.($i-1), "=SUM(F2:F".($i-2).")");

			$objPHPExcel->getActiveSheet()->getStyle("A1:G1")->applyFromArray($style_header);
			$objPHPExcel->getActiveSheet()->getStyle("A2:G".($i-2))->applyFromArray($style_cell);
			$objPHPExcel->getActiveSheet()->getStyle("E".($i-1).":F".($i-1))->applyFromArray($style_cell);

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Rekap Penerimaan Endorsement ('.$this->monthDict[$tanggal[1]-1].' '.$tahun.').xls"');
			header('Cache-Control: max-age=0');

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
		}
	}

	public function rekapJO($tanggal = NULL)
	{
		if($tanggal) {
			$tanggal = explode('-', $tanggal);
			if (count($tanggal == 2)) {
				$tahun = $tanggal[0];
				$bulan = date("m", mktime(0, 0, 0, $tanggal[1], 1, $tanggal[0]));
			}

			$objPHPExcel = new PHPExcel();
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A1', 'Tanggal Endorsement')
				->setCellValue('B1', 'Jenis Job Order')
				->setCellValue('C1', 'Nama Agensi')
				->setCellValue('D1', 'Nama PPTKIS')
				->setCellValue('E1', 'Nama Majikan')
				->setCellValue('F1', 'Jumlah TKI')
				->setCellValue('G1', 'Barcode');

			// set column width & basic style
			$widths = array(
				"A" => 12.71,
				"B"	=> 23.43,
				"C" => 21.86,
				"D" => 21,
				"E" => 24.43,
				"F" => 10.57,
				"G" => 10.57
			);

			foreach ($widths as $key => $value) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($key)->setWidth(($value+0.71));
			}

			// apply style
			$style_header = array(
				'font'    => array(
					'bold'      => true
					),
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'wrap' => true
					),
				'borders' => array(
					'allborders'     => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
			);

			$style_cell = array(
				'borders' => array(
					'allborders'     => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					),
				'alignment' => array(
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
					'wrap' => true
					)
			);

			$query = $this->Rekap_model->getRekapJO($tahun,$bulan);
	    	$i=2;
	    	foreach ($query as $row):
	    		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$i, $row->ejtglendorsement)
					->setCellValue('B'.$i, $row->namajenispekerjaan)
					->setCellValue('C'.$i, $row->agnama)
					->setCellValue('D'.$i, $row->ppnama)
					->setCellValue('E'.$i, $row->mjnama)
					->setCellValue('F'.$i, $row->jojmltki)
					->setCellValueExplicit('G'.$i, $row->ejbcsp, PHPExcel_Cell_DataType::TYPE_STRING);
				$i++;
	    	endforeach;

	    	$objPHPExcel->getActiveSheet()->getStyle("A1:G1")->applyFromArray($style_header);
			$objPHPExcel->getActiveSheet()->getStyle("A2:G".($i-1))->applyFromArray($style_cell);

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Rekap Job Order ('.$this->monthDict[$tanggal[1]-1].' '.$tahun.').xls"');
			header('Cache-Control: max-age=0');

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
		}
	}

	public function rekapTKI($tanggal = NULL)
	{
		if($tanggal) {
			$tanggal = explode('-', $tanggal);
			if (count($tanggal == 2)) {
				$tahun = $tanggal[0];
				$bulan = date("m", mktime(0, 0, 0, $tanggal[1], 1, $tanggal[0]));
			}

			$objPHPExcel = new PHPExcel();
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A1', 'Nama TKI')
				->setCellValue('B1', 'Barcode')
				->setCellValue('C1', 'No. Paspor')
				->setCellValue('D1', 'Jenis Pekerjaan')
				->setCellValue('E1', 'JK')
				->setCellValue('F1', 'Tempat Lahir')
				->setCellValue('G1', 'Tanggal Lahir')
				->setCellValue('H1', 'Alamat Indonesia')
				->setCellValue('I1', 'Ahli Waris')
				->setCellValue('J1', 'Telepon')
				->setCellValue('K1', 'Nama Agensi')
				->setCellValue('L1', 'Alamat Agensi')
				->setCellValue('M1', 'PJ Agensi')
				->setCellValue('N1', 'Telepon Agensi')
				->setCellValue('O1', 'Nama PPTKIS')
				->setCellValue('P1', 'PJ PPTKIS')
				->setCellValue('Q1', 'Alamat PPTKIS')
				->setCellValue('R1', 'Telepon PPTKIS')
				->setCellValue('S1', 'Nama Majikan')
				->setCellValue('T1', 'Alamat Majikan')
				->setCellValue('U1', 'Telepon Majikan');

			// set column width & basic style
			$widths = array(
				"A"	=> 27.43,
				"B" => 9.14,
				"C" => 22.43,
				"D" => 20.71,
				"E" => 2.14,
				"F" => 20.89,
				"G" => 11.71,
				"H" => 29,
				"I" => 27.43,
				"J" => 26,
				"K" => 27.43,
				"L" => 29,
				"M" => 28.14,
				"N" => 26,
				"O" => 27.43,
				"P" => 27.43,
				"Q" => 29,
				"R" => 28.14,
				"S" => 27.43,
				"T" => 29,
				"U" => 26
			);

			foreach ($widths as $key => $value) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($key)->setWidth(($value+0.71));
			}

			// apply style
			$style_header = array(
				'font'    => array(
					'bold' => true
					),
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
					'wrap' => true
					),
				'borders' => array(
					'allborders'     => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
			);

			$style_cell = array(
				'borders' => array(
					'allborders'     => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					),
				'alignment' => array(
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
					'wrap' => true
					)
			);

			$query = $this->Rekap_model->getRekapTKI($tahun,$bulan);
	    	$i=2;
	    	foreach ($query as $row):
	    		$objPHPExcel->setActiveSheetIndex(0)
	    			->setCellValue('A'.$i, $row->tknama)
	    			->setCellValue('B'.$i, $row->tkbc)
	    			->setCellValueExplicit('C'.$i, $row->tkpaspor, PHPExcel_Cell_DataType::TYPE_STRING)
	    			->setCellValue('D'.$i, $row->namajenispekerjaan)
	    			->setCellValue('E'.$i, $row->tkjk)
	    			->setCellValue('F'.$i, $row->tktmptlahir)
	    			->setCellValue('G'.$i, $row->tktgllahir)
	    			->setCellValue('H'.$i, $row->tkalmtid)
	    			->setCellValue('I'.$i, $row->tkahliwaris)
	    			->setCellValueExplicit('J'.$i, $row->tktelp, PHPExcel_Cell_DataType::TYPE_STRING)
	    			->setCellValue('K'.$i, $row->agnama)
	    			->setCellValue('L'.$i, $row->agalmtkantor)
	    			->setCellValue('M'.$i, $row->agpngjwb)
	    			->setCellValueExplicit('N'.$i, $row->agtelp, PHPExcel_Cell_DataType::TYPE_STRING)
	    			->setCellValue('O'.$i, $row->ppnama)
	    			->setCellValue('P'.$i, $row->pppngjwb)
	    			->setCellValue('Q'.$i, $row->ppalmtkantor)
	    			->setCellValueExplicit('R'.$i, $row->pptelp, PHPExcel_Cell_DataType::TYPE_STRING)
	    			->setCellValue('S'.$i, $row->mjnama)
	    			->setCellValue('T'.$i, $row->mjalmt)
	    			->setCellValueExplicit('U'.$i, $row->mjtelp, PHPExcel_Cell_DataType::TYPE_STRING);
	    		$i++;
	    	endforeach;

	    	$objPHPExcel->getActiveSheet()->getStyle("A1:U1")->applyFromArray($style_header);
			$objPHPExcel->getActiveSheet()->getStyle("A2:U".($i-1))->applyFromArray($style_cell);

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Rekap Data TKI Masuk di Endorsement ('.$this->monthDict[$tanggal[1]-1].' '.$tahun.').xls"');
			header('Cache-Control: max-age=0');

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
		}
	}

}
