<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap extends MY_Controller {

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
		$this->data['sidebar'] = 'SAdmin/Sidebar';
	}

	public function index()
	{

	}

	public function rekapKuitansi()
	{
		$tanggal = $this->input->post('tanggal', TRUE);
		$tanggal = explode('-', $tanggal);
		if (count($tanggal == 2) {
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

		$query = $this->Paket_model->getKuitansi($tahun,$bulan);
    	$i=2;
    	foreach ($query as $row):
    		$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$i, $row['kutglmasuk'])
				->setCellValue('B'.$i, $row['kutglkuitansi'])
				->setCellValueExplicit('C'.$i, $row['kuno'], PHPExcel_Cell_DataType::TYPE_STRING)
				->setCellValue('D'.$i, html_entity_decode($row['kupemohon']))
				->setCellValue('E'.$i, $row['TIPE'])
				->setCellValue('F'.$i, $row['kujmlbayar'])
				->setCellValueExplicit('G'.$i, $row['kukode'], PHPExcel_Cell_DataType::TYPE_STRING);
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
		header('Content-Disposition: attachment;filename="Rekap Penerimaan Endorsement ('.$this->monthDict[$v[1]-1].' '.$v[0].').xls"');
		header('Cache-Control: max-age=0');
					
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	}

	public function rekapJO()
	{

	}

	public function rekapTKI()
	{

	}

}