<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require_once APPPATH . '/libraries/REST_Controller.php';

class RestfulAPI extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Endorsement/API_model');
	}


	public function getJO_get()
	{
		$this->load->model('Endorsement/JO_model');
		$agid = $this->get('agid');
		$ppkode = $this->get('ppkode');
		if($agid != NULL && $ppkode != NULL)
		{
			$jo = $this->JO_model->api_get_data_jo_by_agensi_and_pptkis($agid, $ppkode);
			var_dump($jo);

			$c = 0;

			foreach ($jo as $key) {
				$jodetail = $this->JO_model->api_get_data_jo_detail_by_jobid($key->jobid);
				// var_dump($jodetail);
				$jo[$c]->namajenispekerjaan = $jodetail[$c]->namajenispekerjaan;
				$jo[$c]->jobdl = $jodetail[$c]->jobdl;
				$jo[$c]->jobdp = $jodetail[$c]->jobdp;
				$jo[$c]->jobdc = $jodetail[$c]->jobdc;
				$c = $c+1;
				var_dump($jo);
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

		public function getJOByDate_get()
		{
			$date = $this->get('date');
			if($date != NULL)
			{
				$jo = $this->API_model->getJOByDate($date);
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
				$this->load->model('Endorsement/EntryJO_model');
				$barcode = $this->get('barcode');
				if($barcode != NULL)
				{
					$entryjo = $this->EntryJO_model->api_get_entry_jo_by_barcode($barcode);
					//var_dump($entryjo);

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
					$this->load->model('Endorsement/EntryJO_model');
					$barcode = $this->get('barcode');
					if($barcode != NULL)
					{
						$entryjo = $this->EntryJO_model->api_get_entry_jo_by_barcode($barcode);
						//var_dump($entryjo);

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


				}
