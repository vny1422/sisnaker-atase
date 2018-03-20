<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require_once APPPATH . '/libraries/REST_Controller.php';

class Restfulapi extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Endorsement/API_model');
		//$this->load->helper('url');
	}


	public function getjo_get()
	{
		$agid = $this->get('agid');
		$ppkode = $this->get('ppkode');
		if($agid != NULL && $ppkode != NULL)
		{
			$jo = $this->API_model->getJOByAgidPpkode($agid, $ppkode);

			foreach ($jo as $key) {
				$jodetail = $this->API_model->getJODetail($key->jobid);
				$key->detail = $jodetail;
			}
			if($jo)
			{
				$this->response($jo, REST_Controller::HTTP_OK);
			}
			else {
				$this->response([[
					'status' => FALSE,
					'message' => 'JO not found.'
					]], REST_Controller::HTTP_BAD_REQUEST);
				}
			}
			else {
				$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
			}
		}

		public function readSuratPermintaanBC_get()
		{
			$this->load->model('Endorsement/API_model');
			$barcode = $this->get('barcode');
			if($barcode != NULL)
			{
				$entryjo = $this->API_model->getEntryJoByBarcodeSuratPermintaan($barcode);

				foreach ($entryjo as $key) {
					$data_tki = $this->API_model->getDataTkiByEjid($key->ejid);
					$key->data_tki = $data_tki;
				}

				if($entryjo)
				{
					$this->response($entryjo, REST_Controller::HTTP_OK);
				}
				else {
					$this->response([[
						'status' => FALSE,
						'message' => 'Surat Permintaan not found.'
						]], REST_Controller::HTTP_BAD_REQUEST);
					}
				}
				else {
					$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
				}
			}

			public function readSuratKuasaBC_get()
			{
				$this->load->model('Endorsement/API_model');
				$barcode = $this->get('barcode');
				if($barcode != NULL)
				{
					$entryjo = $this->API_model->getEntryJoByBarcodeSuratKuasa($barcode);

					foreach ($entryjo as $key) {
						$data_tki = $this->API_model->getDataTkiByEjid($key->ejid);
						$key->data_tki = $data_tki;
					}

					if($entryjo)
					{
						$this->response($entryjo, REST_Controller::HTTP_OK);
					}
					else {
						$this->response([[
							'status' => FALSE,
							'message' => 'Surat Kuasa not found.'
							]], REST_Controller::HTTP_BAD_REQUEST);
						}
					}
					else {
						$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
					}
				}

				public function readPerjanjianKerjaBC_get()
				{
					$this->load->model('Endorsement/API_model');
					$barcode = $this->get('barcode');
					if($barcode != NULL)
					{
						$data_tki = $this->API_model->getDataTkiByBarcode($barcode);

						if($data_tki)
						{
							$this->response($data_tki, REST_Controller::HTTP_OK);
						}
						else {
							$this->response([[
								'status' => FALSE,
								'message' => 'Perjanjian Kerja not found.'
								]], REST_Controller::HTTP_BAD_REQUEST);
							}
						}
						else {
							$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
						}
					}

					public function readPerjanjianKerjaByNoPaspor_get()
					{
						$this->load->model('Endorsement/API_model');
						$paspor = $this->get('paspor');
						//var_dump($paspor);
						if($paspor != NULL)
						{

							// var_dump($paspor);
							$data_perjanjian_kerja = $this->API_model->getPerjanjianKerjaByPaspor($paspor);
							// var_dump($data_perjanjian_kerja);

							foreach ($data_perjanjian_kerja as $key) {
								//deteksi kotatempatbekerja. Request by Mas Randy 20 Nov 2014. -bagus
								$kota = '';
								$arg1 = $key->mjalmtcn;
								$arg2 = mb_substr($key->mjalmtcn, 0, 30, 'UTF-8');

								if ((substr_count ($arg1, 'Changhua County') > 0) || (substr_count ($arg1, utf8_decode('彰化縣')) > 0) || (substr_count ($arg2, 'Changhua County') > 0) || (substr_count ($arg2, utf8_decode('彰化縣')) > 0))  {$kota = 'Changhua County';}
								else if ((substr_count ($arg1, 'Chiayi City') > 0) || (substr_count ($arg1, utf8_decode('嘉義市')) > 0) || (substr_count ($arg2, 'Chiayi City') > 0) || (substr_count ($arg2, utf8_decode('嘉義市')) > 0))  {$kota = 'Chiayi City';}
								else if ((substr_count ($arg1, 'Chiayi County') > 0) || (substr_count ($arg1, utf8_decode('嘉義縣')) > 0) || (substr_count ($arg2, 'Chiayi County') > 0) || (substr_count ($arg2, utf8_decode('嘉義縣')) > 0))  {$kota = 'Chiayi County';}
								else if ((substr_count ($arg1, 'Hsinchu City') > 0) || (substr_count ($arg1, utf8_decode('新竹市')) > 0) || (substr_count ($arg2, 'Hsinchu City') > 0) || (substr_count ($arg2, utf8_decode('新竹市')) > 0))  {$kota = 'Hsinchu City';}
								else if ((substr_count ($arg1, 'Hsinchu County') > 0) || (substr_count ($arg1, utf8_decode('新竹縣')) > 0) || (substr_count ($arg2, 'Hsinchu County') > 0) || (substr_count ($arg2, utf8_decode('新竹縣')) > 0))  {$kota = 'Hsinchu County';}
								else if ((substr_count ($arg1, 'Hualien County') > 0) || (substr_count ($arg1, utf8_decode('花蓮縣')) > 0) || (substr_count ($arg2, 'Hualien County') > 0) || (substr_count ($arg2, utf8_decode('花蓮縣')) > 0))  {$kota = 'Hualien County';}
								else if ((substr_count ($arg1, 'Kaohsiung City') > 0) || (substr_count ($arg1, utf8_decode('高雄市')) > 0) || (substr_count ($arg2, 'Kaohsiung City') > 0) || (substr_count ($arg2, utf8_decode('高雄市')) > 0))  {$kota = 'Kaohsiung City';}
								else if ((substr_count ($arg1, 'Keelung City') > 0) || (substr_count ($arg1, utf8_decode('基隆市')) > 0) || (substr_count ($arg2, 'Keelung City') > 0) || (substr_count ($arg2, utf8_decode('基隆市')) > 0))  {$kota = 'Keelung City';}
								else if ((substr_count ($arg1, 'Kinmen County') > 0) || (substr_count ($arg1, utf8_decode('金門縣')) > 0) || (substr_count ($arg2, 'Kinmen County') > 0) || (substr_count ($arg2, utf8_decode('金門縣')) > 0))  {$kota = 'Kinmen County';}
								else if ((substr_count ($arg1, 'Lienchiang County') > 0) || (substr_count ($arg1, utf8_decode('連江縣')) > 0) || (substr_count ($arg2, 'Lienchiang County') > 0) || (substr_count ($arg2, utf8_decode('連江縣')) > 0))  {$kota = 'Lienchiang County';}
								else if ((substr_count ($arg1, 'Miaoli County') > 0) || (substr_count ($arg1, utf8_decode('苗栗縣')) > 0) || (substr_count ($arg2, 'Miaoli County') > 0) || (substr_count ($arg2, utf8_decode('苗栗縣')) > 0))  {$kota = 'Miaoli County';}
								else if ((substr_count ($arg1, 'Nantou County') > 0) || (substr_count ($arg1, utf8_decode('南投縣')) > 0) || (substr_count ($arg2, 'Nantou County') > 0) || (substr_count ($arg2, utf8_decode('南投縣')) > 0))  {$kota = 'Nantou County';}
								else if ((substr_count ($arg1, 'New Taipei City') > 0) || (substr_count ($arg1, utf8_decode('新北市')) > 0) || (substr_count ($arg2, 'New Taipei City') > 0) || (substr_count ($arg2, utf8_decode('新北市')) > 0))  {$kota = 'New Taipei City';}
								else if ((substr_count ($arg1, 'Penghu County') > 0) || (substr_count ($arg1, utf8_decode('澎湖縣')) > 0) || (substr_count ($arg2, 'Penghu County') > 0) || (substr_count ($arg2, utf8_decode('澎湖縣')) > 0))  {$kota = 'Penghu County';}
								else if ((substr_count ($arg1, 'Pingtung County') > 0) || (substr_count ($arg1, utf8_decode('屏東縣')) > 0) || (substr_count ($arg2, 'Pingtung County') > 0) || (substr_count ($arg2, utf8_decode('屏東縣')) > 0))  {$kota = 'Pingtung County';}
								else if ((substr_count ($arg1, 'Tainan City') > 0) || (substr_count ($arg1, utf8_decode('臺南市')) > 0) || (substr_count ($arg2, 'Tainan City') > 0) || (substr_count ($arg2, utf8_decode('臺南市')) > 0))  {$kota = 'Tainan City';}
								else if ((substr_count ($arg1, 'Tainan City') > 0) || (substr_count ($arg1, utf8_decode('台南市')) > 0) || (substr_count ($arg2, 'Tainan City') > 0) || (substr_count ($arg2, utf8_decode('台南市')) > 0))  {$kota = 'Tainan City';}
								else if ((substr_count ($arg1, 'Taichung City') > 0) || (substr_count ($arg1, utf8_decode('臺中市')) > 0) || (substr_count ($arg2, 'Taichung City') > 0) || (substr_count ($arg2, utf8_decode('臺中市')) > 0))  {$kota = 'Taichung City';}
								else if ((substr_count ($arg1, 'Taichung City') > 0) || (substr_count ($arg1, utf8_decode('台中市')) > 0) || (substr_count ($arg2, 'Taichung City') > 0) || (substr_count ($arg2, utf8_decode('台中市')) > 0))  {$kota = 'Taichung City';}
								else if ((substr_count ($arg1, 'Taipei City') > 0) || (substr_count ($arg1, utf8_decode('臺北市')) > 0) || (substr_count ($arg2, 'Taipei City') > 0) || (substr_count ($arg2, utf8_decode('臺北市')) > 0))  {$kota = 'Taipei City';}
								else if ((substr_count ($arg1, 'Taipei City') > 0) || (substr_count ($arg1, utf8_decode('台北市')) > 0) || (substr_count ($arg2, 'Taipei City') > 0) || (substr_count ($arg2, utf8_decode('台北市')) > 0))  {$kota = 'Taipei City';}
								else if ((substr_count ($arg1, 'Taitung County') > 0) || (substr_count ($arg1, utf8_decode('臺東縣')) > 0) || (substr_count ($arg2, 'Taitung County') > 0) || (substr_count ($arg2, utf8_decode('臺東縣')) > 0))  {$kota = 'Taitung County';}
								else if ((substr_count ($arg1, 'Taitung County') > 0) || (substr_count ($arg1, utf8_decode('台東縣')) > 0) || (substr_count ($arg2, 'Taitung County') > 0) || (substr_count ($arg2, utf8_decode('台東縣')) > 0))  {$kota = 'Taitung County';}
								else if ((substr_count ($arg1, 'Taoyuan County') > 0) || (substr_count ($arg1, utf8_decode('桃園縣')) > 0) || (substr_count ($arg2, 'Taoyuan County') > 0) || (substr_count ($arg2, utf8_decode('桃園縣')) > 0))  {$kota = 'Taoyuan County';}
								else if ((substr_count ($arg1, 'Yilan County') > 0) || (substr_count ($arg1, utf8_decode('宜蘭縣')) > 0) || (substr_count ($arg2, 'Yilan County') > 0) || (substr_count ($arg2, utf8_decode('宜蘭縣')) > 0))  {$kota = 'Yilan County';}
								else if ((substr_count ($arg1, 'Yunlin County') > 0) || (substr_count ($arg1, utf8_decode('雲林縣')) > 0) || (substr_count ($arg2, 'Yunlin County') > 0) || (substr_count ($arg2, utf8_decode('雲林縣')) > 0))  {$kota = 'Yunlin County';}
								else {$kota = 'Kapal Laut atau Tidak Terdeteksi';}

								$key->kotatempatbekerja = $kota;

								if ($key->ejtglendorsement !== NULL) {
									$key->url_pdf_tki = "http://".base_url()."PkNew/downloadPK/$key->md5ej";
								} else {
									$key->url_pdf_tki = "NOTFOUND";
								}

							}

							if($data_perjanjian_kerja)
							{
								$this->response($data_perjanjian_kerja, REST_Controller::HTTP_OK);
							}
							else {
								$this->response([[
									'status' => FALSE,
									'message' => 'Perjanjian Kerja not found.'
									]], REST_Controller::HTTP_BAD_REQUEST);
								}
							}
							else {
								$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
							}
						}

						public function readPerjanjianKerjaByBarcode_get()
						{
							$this->load->model('Endorsement/API_model');
							$barcode = $this->get('barcode');
							if($barcode != NULL)
							{
								// var_dump($paspor);
								$data_perjanjian_kerja = $this->API_model->getPerjanjianKerjaByBarcode($barcode);
								// var_dump($data_perjanjian_kerja);

								foreach ($data_perjanjian_kerja as $key) {
									//deteksi kotatempatbekerja. Request by Mas Randy 20 Nov 2014. -bagus
									$kota = '';
									$arg1 = $key->mjalmtcn;
									$arg2 = mb_substr($key->mjalmtcn, 0, 30, 'UTF-8');

									if ((substr_count ($arg1, 'Changhua County') > 0) || (substr_count ($arg1, utf8_decode('彰化縣')) > 0) || (substr_count ($arg2, 'Changhua County') > 0) || (substr_count ($arg2, utf8_decode('彰化縣')) > 0))  {$kota = 'Changhua County';}
									else if ((substr_count ($arg1, 'Chiayi City') > 0) || (substr_count ($arg1, utf8_decode('嘉義市')) > 0) || (substr_count ($arg2, 'Chiayi City') > 0) || (substr_count ($arg2, utf8_decode('嘉義市')) > 0))  {$kota = 'Chiayi City';}
									else if ((substr_count ($arg1, 'Chiayi County') > 0) || (substr_count ($arg1, utf8_decode('嘉義縣')) > 0) || (substr_count ($arg2, 'Chiayi County') > 0) || (substr_count ($arg2, utf8_decode('嘉義縣')) > 0))  {$kota = 'Chiayi County';}
									else if ((substr_count ($arg1, 'Hsinchu City') > 0) || (substr_count ($arg1, utf8_decode('新竹市')) > 0) || (substr_count ($arg2, 'Hsinchu City') > 0) || (substr_count ($arg2, utf8_decode('新竹市')) > 0))  {$kota = 'Hsinchu City';}
									else if ((substr_count ($arg1, 'Hsinchu County') > 0) || (substr_count ($arg1, utf8_decode('新竹縣')) > 0) || (substr_count ($arg2, 'Hsinchu County') > 0) || (substr_count ($arg2, utf8_decode('新竹縣')) > 0))  {$kota = 'Hsinchu County';}
									else if ((substr_count ($arg1, 'Hualien County') > 0) || (substr_count ($arg1, utf8_decode('花蓮縣')) > 0) || (substr_count ($arg2, 'Hualien County') > 0) || (substr_count ($arg2, utf8_decode('花蓮縣')) > 0))  {$kota = 'Hualien County';}
									else if ((substr_count ($arg1, 'Kaohsiung City') > 0) || (substr_count ($arg1, utf8_decode('高雄市')) > 0) || (substr_count ($arg2, 'Kaohsiung City') > 0) || (substr_count ($arg2, utf8_decode('高雄市')) > 0))  {$kota = 'Kaohsiung City';}
									else if ((substr_count ($arg1, 'Keelung City') > 0) || (substr_count ($arg1, utf8_decode('基隆市')) > 0) || (substr_count ($arg2, 'Keelung City') > 0) || (substr_count ($arg2, utf8_decode('基隆市')) > 0))  {$kota = 'Keelung City';}
									else if ((substr_count ($arg1, 'Kinmen County') > 0) || (substr_count ($arg1, utf8_decode('金門縣')) > 0) || (substr_count ($arg2, 'Kinmen County') > 0) || (substr_count ($arg2, utf8_decode('金門縣')) > 0))  {$kota = 'Kinmen County';}
									else if ((substr_count ($arg1, 'Lienchiang County') > 0) || (substr_count ($arg1, utf8_decode('連江縣')) > 0) || (substr_count ($arg2, 'Lienchiang County') > 0) || (substr_count ($arg2, utf8_decode('連江縣')) > 0))  {$kota = 'Lienchiang County';}
									else if ((substr_count ($arg1, 'Miaoli County') > 0) || (substr_count ($arg1, utf8_decode('苗栗縣')) > 0) || (substr_count ($arg2, 'Miaoli County') > 0) || (substr_count ($arg2, utf8_decode('苗栗縣')) > 0))  {$kota = 'Miaoli County';}
									else if ((substr_count ($arg1, 'Nantou County') > 0) || (substr_count ($arg1, utf8_decode('南投縣')) > 0) || (substr_count ($arg2, 'Nantou County') > 0) || (substr_count ($arg2, utf8_decode('南投縣')) > 0))  {$kota = 'Nantou County';}
									else if ((substr_count ($arg1, 'New Taipei City') > 0) || (substr_count ($arg1, utf8_decode('新北市')) > 0) || (substr_count ($arg2, 'New Taipei City') > 0) || (substr_count ($arg2, utf8_decode('新北市')) > 0))  {$kota = 'New Taipei City';}
									else if ((substr_count ($arg1, 'Penghu County') > 0) || (substr_count ($arg1, utf8_decode('澎湖縣')) > 0) || (substr_count ($arg2, 'Penghu County') > 0) || (substr_count ($arg2, utf8_decode('澎湖縣')) > 0))  {$kota = 'Penghu County';}
									else if ((substr_count ($arg1, 'Pingtung County') > 0) || (substr_count ($arg1, utf8_decode('屏東縣')) > 0) || (substr_count ($arg2, 'Pingtung County') > 0) || (substr_count ($arg2, utf8_decode('屏東縣')) > 0))  {$kota = 'Pingtung County';}
									else if ((substr_count ($arg1, 'Tainan City') > 0) || (substr_count ($arg1, utf8_decode('臺南市')) > 0) || (substr_count ($arg2, 'Tainan City') > 0) || (substr_count ($arg2, utf8_decode('臺南市')) > 0))  {$kota = 'Tainan City';}
									else if ((substr_count ($arg1, 'Tainan City') > 0) || (substr_count ($arg1, utf8_decode('台南市')) > 0) || (substr_count ($arg2, 'Tainan City') > 0) || (substr_count ($arg2, utf8_decode('台南市')) > 0))  {$kota = 'Tainan City';}
									else if ((substr_count ($arg1, 'Taichung City') > 0) || (substr_count ($arg1, utf8_decode('臺中市')) > 0) || (substr_count ($arg2, 'Taichung City') > 0) || (substr_count ($arg2, utf8_decode('臺中市')) > 0))  {$kota = 'Taichung City';}
									else if ((substr_count ($arg1, 'Taichung City') > 0) || (substr_count ($arg1, utf8_decode('台中市')) > 0) || (substr_count ($arg2, 'Taichung City') > 0) || (substr_count ($arg2, utf8_decode('台中市')) > 0))  {$kota = 'Taichung City';}
									else if ((substr_count ($arg1, 'Taipei City') > 0) || (substr_count ($arg1, utf8_decode('臺北市')) > 0) || (substr_count ($arg2, 'Taipei City') > 0) || (substr_count ($arg2, utf8_decode('臺北市')) > 0))  {$kota = 'Taipei City';}
									else if ((substr_count ($arg1, 'Taipei City') > 0) || (substr_count ($arg1, utf8_decode('台北市')) > 0) || (substr_count ($arg2, 'Taipei City') > 0) || (substr_count ($arg2, utf8_decode('台北市')) > 0))  {$kota = 'Taipei City';}
									else if ((substr_count ($arg1, 'Taitung County') > 0) || (substr_count ($arg1, utf8_decode('臺東縣')) > 0) || (substr_count ($arg2, 'Taitung County') > 0) || (substr_count ($arg2, utf8_decode('臺東縣')) > 0))  {$kota = 'Taitung County';}
									else if ((substr_count ($arg1, 'Taitung County') > 0) || (substr_count ($arg1, utf8_decode('台東縣')) > 0) || (substr_count ($arg2, 'Taitung County') > 0) || (substr_count ($arg2, utf8_decode('台東縣')) > 0))  {$kota = 'Taitung County';}
									else if ((substr_count ($arg1, 'Taoyuan County') > 0) || (substr_count ($arg1, utf8_decode('桃園縣')) > 0) || (substr_count ($arg2, 'Taoyuan County') > 0) || (substr_count ($arg2, utf8_decode('桃園縣')) > 0))  {$kota = 'Taoyuan County';}
									else if ((substr_count ($arg1, 'Yilan County') > 0) || (substr_count ($arg1, utf8_decode('宜蘭縣')) > 0) || (substr_count ($arg2, 'Yilan County') > 0) || (substr_count ($arg2, utf8_decode('宜蘭縣')) > 0))  {$kota = 'Yilan County';}
									else if ((substr_count ($arg1, 'Yunlin County') > 0) || (substr_count ($arg1, utf8_decode('雲林縣')) > 0) || (substr_count ($arg2, 'Yunlin County') > 0) || (substr_count ($arg2, utf8_decode('雲林縣')) > 0))  {$kota = 'Yunlin County';}
									else {$kota = 'Kapal Laut atau Tidak Terdeteksi';}

									$key->kotatempatbekerja = $kota;

									if ($key->ejtglendorsement !== NULL) {
										$key->url_pdf_tki = "http://".base_url()."PkNew/downloadPK/$key->md5ej";
									} else {
										$key->url_pdf_tki = "NOTFOUND";
									}

								}

								if($data_perjanjian_kerja)
								{
									$this->response($data_perjanjian_kerja, REST_Controller::HTTP_OK);
								}
								else {
									$this->response([[
										'status' => FALSE,
										'message' => 'Perjanjian Kerja not found.'
										]], REST_Controller::HTTP_BAD_REQUEST);
									}
								}
								else {
									$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
								}
							}

							public function isAgensiCekal_get()
							{
								$this->load->model('Endorsement/API_model');
								$agid = $this->get('agid');
								if($agid != NULL)
								{
									$data_agensi = $this->API_model->getIsAgensiCekalByAgid($agid);

									$date_now = date('Y-m-d');

									if (($data_agensi[0]->castart <= $date_now && $data_agensi[0]->caend >= $date_now) || $data_agensi[0]->caend === NULL) {
										$data_agensi[0]->status = "INACTIVE";
										$data_agensi[0]->comment = "Dicekal";
									}
									else {
										$data_agensi[0]->status = "ACTIVE";
										$data_agensi[0]->comment = "Tidak Dicekal";
									}

									if($data_agensi)
									{
										$this->response($data_agensi, REST_Controller::HTTP_OK);
									}
									else {
										$this->response([[
											'status' => FALSE,
											'message' => 'Agensi not found.'
											]], REST_Controller::HTTP_BAD_REQUEST);
										}
									}
									else {
										$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
									}
								}

								public function isPPTKISCekal_get()
								{
									$this->load->model('Endorsement/API_model');
									$idpptkis = $this->get('idpptkis');
									if($idpptkis != NULL)
									{
										$data_pptkis = $this->API_model->getIsPptkisCekalByPpkode($idpptkis);

										$date_now = date('Y-m-d');

										if (($data_pptkis[0]->cpstart <= $date_now && $data_pptkis[0]->cpend >= $date_now) || $data_pptkis[0]->cpend === NULL) {
											$data_pptkis[0]->status = "INACTIVE";
											$data_pptkis[0]->comment = "Dicekal";
										}
										else {
											$data_pptkis[0]->status = "ACTIVE";
											$data_pptkis[0]->comment = "Tidak Dicekal";
										}

										if($data_pptkis)
										{
											$this->response($data_pptkis, REST_Controller::HTTP_OK);
										}
										else {
											$this->response([[
												'status' => FALSE,
												'message' => 'Agensi not found.'
												]], REST_Controller::HTTP_BAD_REQUEST);
											}
										}
										else {
											$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
										}
									}

									public function getJOByDate_get()
									{
										$date = $this->get('date');
										if($date != NULL)
										{
											$jo = $this->API_model->getJOByDate($date);
											foreach ($jo as $key) {
												$jodetail = $this->API_model->getJODetail($key->jobid);
												$key->detail = $jodetail;
											}
											if($jo)
											{
												$this->response($jo, REST_Controller::HTTP_OK);
											}
											else {
												$this->response([[
													'status' => FALSE,
													'message' => 'JO not found.'
													]], REST_Controller::HTTP_BAD_REQUEST);
												}
											}
											else {
												$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
											}
										}

										public function getPKByDate_get($date)
										{
											ini_set('max_execution_time', 600);

											$date = $this->get('date');
											if($date != NULL)
											{
												$entryjo = $this->API_model->getPKByDate($date);
												foreach ($entryjo as $key) {
													$tkilist = $this->API_model->getTKI($key->ejid);
													$key->tki = $tkilist;
												}

												if($entryjo)
												{
													$this->response($entryjo, REST_Controller::HTTP_OK);
												}
												else {
													$this->response([[
														'status' => FALSE,
														'message' => 'Entry JO not found.'
														]], REST_Controller::HTTP_BAD_REQUEST);
													}
												}
												else {
													$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
												}
											}

											public function getBlacklistAgenByDate_get($date)
											{
												$date = $this->get('date');
												if($date != NULL)
												{
													$blacklists = $this->API_model->getBlacklistAgenByDate($date);
													$list = array();
													foreach($blacklists as $key)
													{
														array_push($list, $key->agid);
													}

													$object = (object) [
														'list_agid' => $list
													];

													if($object)
													{
														$this->response($object, REST_Controller::HTTP_OK);
													}
													else {
														$this->response([[
															'status' => FALSE,
															'message' => 'Agency not found.'
															]], REST_Controller::HTTP_BAD_REQUEST);
														}
													}
													else {
														$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
													}
												}

												public function pushKeberangkatan_post()
												{
													if($this->post())
													{
														$response = $this->API_model->pushKeberangkatan($this->post());

														if($response != 0) {
															$this->response($response, REST_Controller::HTTP_CREATED); // OK (200) being the HTTP response code
														}
														else {
															$this->response([[
																'status' => FALSE,
																'message' => 'Post Data invalid.'
																]], REST_Controller::HTTP_BAD_REQUEST);
															}
														}
														else {
															$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
														}
													}

													public function pushKepulangan_post()
													{
														if($this->post())
														{
															$response = $this->API_model->pushKepulangan($this->post());

															if($response != 0) {
																$this->response($response, REST_Controller::HTTP_CREATED); // OK (200) being the HTTP response code
															}
															else {
																$this->response([[
																	'status' => FALSE,
																	'message' => 'Post Data invalid.'
																	]], REST_Controller::HTTP_BAD_REQUEST);
																}
															}
															else {
																$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
															}
														}

													}
