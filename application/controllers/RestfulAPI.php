<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require_once APPPATH . '/libraries/REST_Controller.php';

class RestfulAPI extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url_helper');
	}

	public function newHistoryDaily_post()
	{
		if($this->post())
		{
			$this->load->model('Target_model');
			$this->load->model('User_model');
			$inp = file_get_contents(base_url().'json/history.json');
			$tempArray = json_decode($inp);
			$data = [];
			$field = '';
			$save = 0;
			foreach($this->post() as $key => $value) {
				$data[$key] = $value;
				if($key != 'username' && $key != 'id_target' && $key != 'date')
				{
					$field = $key;
				}
			}
			$flag = 0;
			foreach($tempArray as $temp)
			{
				if ($temp->username == $this->post('username') && $temp->id_target == $this->post('id_target') && $temp->date == $this->post('date'))
				{
					$flag = 1;
					if($field != '')
					{
						$temp->$field = $data[$field];
						$temp->save = $temp->save - $data[$field];
						if($temp->save < 0)
						{
							$temp->save = 0;
						}
						$temp->expense = $temp->expense + $data[$field];
						$offset = $this->Target_model->detail_target($this->post('id_target'))->offset;
						$offset = $offset - $data[$field];
						$this->Target_model->update_offset_target($this->post('id_target'),$offset);
						$jsonData = json_encode($tempArray);
						file_put_contents('././json/history.json', $jsonData);
						$this->response([[
							'status' => TRUE,
							'message' => 'Pengeluaran Daily added'
							]], REST_Controller::HTTP_CREATED); // OK (200) being the HTTP response code
						}
					}
				}
				if(!$flag)
				{
					$normalExpense = $this->Target_model->detail_target($this->post('id_target'))->normal_expense;
					$offset = $this->Target_model->detail_target($this->post('id_target'))->offset;
					$targetData = $this->User_model->detail_user($this->post('username'));
					$save = floor($targetData->penghasilan/30) - $data[$field];
					if($save < 0)
					{
						$save = 0;
					}
					$data['save'] = $save;
					$data['expense'] = $data[$field];
					$offset = $offset+($normalExpense - $data[$field]);
					$this->Target_model->update_offset_target($this->post('id_target'),$offset);
					array_push($tempArray, $data);
					$jsonData = json_encode($tempArray);
					file_put_contents('././json/history.json', $jsonData);
					$this->response([[
						'status' => TRUE,
						'message' => 'Pengeluaran Daily added'
						]], REST_Controller::HTTP_CREATED); // OK (200) being the HTTP response code
					}
				}
				else {
					$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
				}
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
