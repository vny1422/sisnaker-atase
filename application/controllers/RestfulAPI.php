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


			public function readSuratPermintaanBC_get()
			{
				$this->load->model('Endorsement/EntryJO_model');
				$barcode = $this->get('barcode');
				if($barcode != NULL)
				{
					$entryjo = $this->EntryJO_model->api_get_entry_jo_by_barcode($barcode);

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
