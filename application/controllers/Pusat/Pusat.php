<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pusat extends MY_Controller {

	private $data;

	public function __construct()
    {
			parent::__construct();
	    $this->load_sidebar();
	    $this->load->model('Pusat/Pusat_model');
	    $this->load->model('Endorsement/Paket_model');
	    $this->load->model('Perlindungan/Agency_model');
	    $this->load->model('SAdmin/Input_model');
			$this->load->model('SAdmin/Institution_model');
			$this->load->model('Perlindungan/Formulir_model');
			$this->load->model('Perlindungan/Perlindungan_model');
			$this->load->model('Perlindungan/Infografik_model');
			$this->load->model('Perlindungan/View_model');
			$this->load->model('Perlindungan/Kasus_model');
			$this->load->model('SAdmin/Currency_model');

	    $this->data['listdp'] = $this->listdp;
	    $this->data['usedpg'] = $this->usedpg;
	    $this->data['usedmpg'] = $this->usedmpg;
	    $this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;
	    $this->data['namakantor'] = $this->namakantor->nama;
	    $this->data['sidebar'] = 'SAdmin/Sidebar';
    }

		public function index()
	  {
			$this->data['month'] = date('m');
			$data['month']  = date('m');
			$data['year']   = date('Y');
			$petugas = array();
			$shelter = array();
			$petugasArr = $this->Perlindungan_model->get_officer_username('all');
			foreach ($petugasArr->result_array() as $row):
					array_push($petugas,$row['username']);
			endforeach;
			$shelterArr = $this->Perlindungan_model->get_shelter_id('all');
			foreach ($shelterArr->result_array() as $row):
					array_push($shelter,$row['id']);
			endforeach;

			/// this year
			$this->data['datathisyear']           = $this->Perlindungan_model->get_problem_this_year($data['year']);
			$this->data['datafinishthisyear']     = $this->Perlindungan_model->get_finish_this_year($data['year']);
			$this->data['dataprocessthisyear']    = $this->Perlindungan_model->get_process_this_year($data['year']);
			// var_dump($this->data['datathisyear']);
			/// this month
			$this->data['datathismonth']          = $this->Perlindungan_model->get_problem_this_month($data['month'],$data['year']);
			$this->data['datafinishthismonth']    = $this->Perlindungan_model->get_finish_this_month($data['month'],$data['year']);
			$this->data['dataprocessthismonth']   = $this->Perlindungan_model->get_process_this_month($data['month'],$data['year']);

			/// performance
			list($offname, $offpic, $offperform)           = $this->Perlindungan_model->get_officer_performance($data['year'], $petugas);
			$this->data['officername']            = $offname;
			$this->data['officerpicture']         = $offpic;
			$this->data['performance']            = $offperform;

			$this->data['year_performance']       = $this->Perlindungan_model->get_year_performance($data['year']);

			/// list tahun
			$this->data['tahundb']                = $this->Perlindungan_model->get_all_yeardb();

			/// kasus
			$this->data['kasusproses']            = $this->Perlindungan_model->get_all_problem_process();
			$this->data['kasusselesai']           = $this->Perlindungan_model->get_all_problem_finished();

			if($this->data['year_performance'] <= 50){
					$this->data['panel_color'] = 'panel-danger';
			} else {
					$this->data['panel_color'] = 'panel-success';
			}

			$currency = $this->Currency_model->get_currency_name_institution($this->session->userdata('institution'));
			$this->data['namacurrency'] = strtoupper($currency->currencyname);

			$this->data['institusi'] = $this->Institution_model->list_active_institution();

	    /// list tahun
	    $this->data['tahunpenempatan'] = $this->Pusat_model->get_all_year();

	    $this->data['title'] = 'DASHBOARD';
	    $this->data['subtitle'] = 'KANTOR PUSAT';
	    $this->load->view('templates/headerpusatdashboard', $this->data);
	    $this->load->view('Pusat/Pusat_view', $this->data);
	    $this->load->view('templates/footerpusat');
	   }

	  public function get_info_year_dashboard(){
	    $year = $this->input->post('y');
	    $month = $this->input->post('m');
			$institution = $this->input->post('i');

	    $all = array();

	    $year_jk = $this->Pusat_model->get_jk_this_year($year,$institution);
	    $total_year_jk = 0;
	    foreach ($year_jk as $jk) {
	      $total_year_jk += $jk->total;
	    }

	    $month_jk = $this->Pusat_model->get_jk_this_month($year,$month,$institution);
	    $total_month_jk = 0;
	    foreach ($month_jk as $jk) {
	      $total_month_jk += $jk->total;
	    }

	    $year_sektor = $this->Pusat_model->get_sektor_this_year($year,$institution);
	    $total_year_sektor = 0;
	    foreach ($year_sektor as $sektor) {
	      $total_year_sektor += $sektor->total;
	    }

	    $month_sektor = $this->Pusat_model->get_sektor_this_month($year,$month,$institution);
	    $total_month_sektor = 0;
	    foreach ($month_sektor as $sektor) {
	      $total_month_sektor += $sektor->total;
	    }

	    $iterm = range(1,12);
	    $nm_month = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
	      5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
	      9 => 'Sep', 10 => 'Okt', 11 => 'Nop', 12=> 'Des'
	      );
	    $listjp = [];
	    $listjpdb = $this->Pusat_model->get_list_jp_this_year($year,$institution);
	    foreach ($listjpdb as $jp) {
	      array_push($listjp, $jp->namajenispekerjaan);
	    }

	    $jppermonth = [];
	    for($i=0;$i<count($iterm);$i++){
	      $temp_1 = array('bulan' => $nm_month[$iterm[$i]]);
	      $tot = 0;
	      foreach($listjp as $jp){
	        $temp_1[$jp] = $this->Pusat_model->count_jp_this_month($year,$iterm[$i],$jp,$institution);
	        $tot += $temp_1[$jp];
	      }
	      $temp_1['total'] = $tot;
	      array_push($jppermonth, $temp_1);
	    }

	    array_push($all,$total_year_jk);
	    array_push($all,$year_jk);
	    array_push($all,$total_month_jk);
	    array_push($all,$month_jk);
	    array_push($all,$total_year_sektor);
	    array_push($all,$year_sektor);
	    array_push($all,$total_month_sektor);
	    array_push($all,$month_sektor);
	    array_push($all,$listjp);
	    array_push($all,$jppermonth);

	    echo json_encode($all);
	  }

		public function modal()
    {
        $name_month = array('01' => 'Januari','02' => 'Februari',
                            '03' => 'Maret', '04' => 'April',
                            '05' => 'Mei', '06'=> 'Juni',
                            '07' => 'Juli', '08' => 'Agustus',
                            '09' => 'September', '10' => 'Oktober',
                            '11' => 'Nopember', '12' => 'Desember'
                            );

        $id = $this->input->post('id',TRUE);

        list($problem, $tki,$file) = $this->Perlindungan_model->get_problem_officer_detail($id);
        $problem = $problem->result_array();
        $tki     = $tki->result_array();
        $file    = $file->result_array();

        // versi modern
        $problem[0]['tindaklanjut'] = $this->Formulir_model->formulir_tindaklanjut($id);
        //$problem[0]['tindaklanjutBNP'] = $this->Formulir_model->formulir_tindaklanjut_BNP2TKI($id);
        //$problem[0]['fieldBNP'] = $this->Formulir_model->formulir_field_BNP2TKI($id);


        /**
         *  Kasus
         */
				if(!isset($problem[0]['tanggalmasuktaiwan']))
				{
					$problem[0]['tanggalmasuktaiwan'] = null;
				}
        if($problem[0]['tanggalmasuktaiwan'] == '0000-00-00' || $problem[0]['tanggalmasuktaiwan'] == null) {
            $problem[0]['tanggalmasuktaiwan'] = '';
        } else {
            list($tglmasuktaiwan,$blnmasuktaiwan,$thnmasuktaiwan) = explode('-', $problem[0]['tanggalmasuktaiwan']);
            $problem[0]['tanggalmasuktaiwan'] = $tglmasuktaiwan.' '.$name_month[$blnmasuktaiwan].' '.$thnmasuktaiwan;
        }

        list($tglpengaduan,$blnpengaduan,$thnpengaduan) = explode('-', $problem[0]['tanggalpengaduan']);
        $problem[0]['tanggalpengaduan'] = $tglpengaduan.' '.$name_month[$blnpengaduan].' '.$thnpengaduan;

        $problem[0]['statustki']     = ($problem[0]['statustki'] == 1 ? 'Resmi' : 'Kaburan');
        $problem[0]['sektor']        = ($problem[0]['sektor'] == 1 ? 'Informal' : 'Formal');
        $problem[0]['statusmasalah'] = ($problem[0]['statusmasalah'] == 1 ? 'Masalah Belum Selesai' : 'Masalah Sudah Selesai');

        /**
         *  BMI
         */
        $alltki = array();
        $tki[0]['jk'] = ($tki[0]['jk'] == 'P' ? 'Perempuan' : 'Laki-laki');
        array_push($alltki, $tki);
        $combine = array_merge($problem, $alltki);

        /**
         * File
         */
        array_push($combine, $file);

        /**
         *  Check koneksi dengan SIAP
         */
        // $siap_problem = array();

        // if($problem[0]['agid'] != '0'){
        //     $objCasesiap = $this->Casesiap_model->get_siap_info($problem[0]['agid']);
        //     $casesiap = $objCasesiap->row_array();
        //     array_push($siap_problem, $casesiap);
        // }

        // array_push($combine, $siap_problem);

        //print '<pre>';
        //print_r($combine);
        //print '</pre>';


        echo json_encode($combine);
    }

		public function get_info_year_dashboard_perlindungan(){
				$year = $this->input->post('y');
				$all = array();
				$institution = $this->input->post('i');

				list($year_problem,$month_problem,$year_money,$month_money) = $this->count_info_year_dashboard($year,$institution);
				$year_money = $this->Infografik_model->formatMoney($year_money);

				array_push($all,$year_problem);
				array_push($all,$month_problem);
				array_push($all,$year_money);
				array_push($all,$month_money);

				echo json_encode($all);
		}

		public function count_info_year_dashboard($year,$institution) {

				$month = range(1,12);
				$nm_month = array(1=>'Jan', '2'=> 'Feb', '3' => 'Mar', 4 => 'Apr',
													5=> 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
													9 => 'Sep', 10 => 'Okt', 11 => 'Nop', 12=> 'Des'
													);

				$all_problem = array();
				$fin_problem = array();
				$pro_problem = array();
				$mon_money   = array();

				$month_problem = array();
				$month_money   = array();

				for($i=0;$i<count($month);$i++){

						list($all,$fin,$pro) = $this->Infografik_model->get_total_problem_year($month[$i],$year,$institution);
						$mon_money = $this->Infografik_model->get_total_money($month[$i],$year,$institution);
						$mon_money_sektoral = $this->Infografik_model->get_total_money_sektoral($month[$i],$year,$institution);
						$uang = $mon_money->row_array();
						if ($uang['uang'] == ''){
								$uang['uang'] = '0';
						}

						$temporary = array(
														'bulan' => $nm_month[$month[$i]],
														'total' => $all,
														'fin' => $fin,
														'pro' => $pro
														);

						$temp_money = array(
														'bulan' => $nm_month[$month[$i]],
														'uang'  => $uang['uang'],
														'formal' => $mon_money_sektoral['formal'],
														'informal' => $mon_money_sektoral['informal']
														);


						array_push($month_problem, $temporary);
						array_push($month_money,$temp_money);
				}

				$year_total_problem = $this->Infografik_model->get_total_problem_a_year($year,$institution);
				//$year_total_finish = $this->Infografik_model->get_finish_this_year($year);
				//$year_total_finish_within = $this->Infografik_model->get_finish_within_year($year);
				$year_money = $this->Infografik_model->get_total_money_year($year,$institution);
				$year_total_money   = $year_money->row_array();

				// $ratio = ($year_total_finish / $year_total_problem)*100;
				// $ratio = round($ratio,1);
				// $ratiowithin = ($year_total_finish_within / $year_total_problem)*100;
				// $ratiowithin = round($ratiowithin,1);

				return array($year_total_problem,$month_problem,$year_total_money['uang'],$month_money);
		}

		public function convertToPDF($idproblem)
    {
        $values = $this->Kasus_model->get_kasus($idproblem);
        if($values->idinstitution != $this->session->userdata('institution')){
            show_error("Access is forbidden.",403,"403 Forbidden");
        }

        $this->load->library('Pdf');
        $Objdata = $this->Formulir_model->formulir_pengaduan($idproblem);
        $data = $Objdata->row();

        $tidl = $this->Formulir_model->formulir_tindaklanjut($idproblem);
        if($tidl != null){
            $tindaklanjut = $tidl;
        }
        else{
            $tindaklanjut = '<p></p><p></p></br></br></br>
                            <p></p><p></p><p></p><p></p><p>
                            </p><p></p><p></p><p></p><p></p>';
        }

        if($data->jumlah > 1){
            $jumlah = '('.$data->jumlah.' orang)';
        } else {
            $jumlah = '';
        }

        $sektor = array('1' => 'INFORMAL', '2' => 'FORMAL');
        $month = array(
                '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
                '04' => 'April', '05' => 'Mei', '06' => 'Juni',
                '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
                '10' => 'Oktober', '11' => 'Nopember', '12' => 'Desember'
        );

        $getdate = explode('-', $data->tanggalpengaduan);
        $tglpengaduan = $getdate[2].' '.$month[$getdate[1]].' '.$getdate[0];

        $pdf = new Pdf(PDF_PAGE_ORIENTATION,PDF_UNIT,PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetFont('kozminproregular', '', 11);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $pdf->AddPage();
        $html = '
        <html>
            <head>
                <title></title>
            </head>
            <body>
            <h2 style="text-align: center; margin-top:0px">FORMULIR PENGADUAN PERMASALAHAN TKI</h2>
            <h5 style="text-align: center;">No: '.$data->nomormasalah.'</h5>

            <table border="0" cellpadding="1" cellspacing="1" style="width: 100%;">
                <tbody>
                    <tr>
                        <td>Tanggal Pengaduan</td>
                        <td style="width:15px">:</td>
                        <td>'.$tglpengaduan.'</td>
                    </tr>
                    <tr>
                        <td>Jenis Pengaduan</td>
                        <td>:</td>
                        <td>'.$data->media.'</td>
                    </tr>
                </tbody>
            </table>

            <p><strong>Yang Mengadu:</strong></p>

            <table border="0" cellpadding="1" cellspacing="1" style="width: 100%;">
                <tbody>
                    <tr>
                        <td>1. Nama</td>
                        <td style="width:15px">:</td>
                        <td>'.$data->namapelapor.'</td>
                    </tr>
                    <tr>
                        <td>2. No. Paspor</td>
                        <td>:</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>3. Hubungan dengan TKI</td>
                        <td>:</td>
                        <td>&nbsp;</td>
                    </tr>
                </tbody>
            </table>

            <p><strong>Atas Nama:</strong></p>

            <table border="0" cellpadding="1" cellspacing="1" width="1100">
                <tbody>
                    <tr>
                        <td style="width:250px">1. Nama TKI</td>
                        <td style="width:15px">:</td>
                        <td>'.$data->namatki.' '.$jumlah.'</td>
                    </tr>
                    <tr>
                        <td>2. No. Paspor</td>
                        <td>:</td>
                        <td>'.$data->paspor.'</td>
                    </tr>
                    <tr>
                        <td>3. Alamat Kerja (Kota)</td>
                        <td>:</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>4. Alamat Indonesia</td>
                        <td>:</td>
                        <td>'.$data->alamatindonesia.'</td>
                    </tr>
                    <tr>
                        <td>5. No. HP</td>
                        <td>:</td>
                        <td>'.$data->handphone.'</td>
                    </tr>
                    <tr>
                        <td>6. Agensi</td>
                        <td>:</td>
                        <td>'.$data->agensi.' ('.$data->teleponagensi.')</td>
                    </tr>
                    <tr>
                        <td>7. PPTKIS</td>
                        <td>:</td>
                        <td>'.$data->pptkis.'</td>
                    </tr>
                    <tr>
                        <td>8. Jenis Pekerjaan</td>
                        <td>:</td>
                        <td>'.$data->jenis.'</td>
                    </tr>
                    <tr>
                        <td>9. Sektor Pekerjaan</td>
                        <td>:</td>
                        <td>'.$sektor[$data->sektor].'</td>
                    </tr>
                    <tr>
                        <td>10. Mulai bekerja di luar negeri</td>
                        <td>:</td>
                        <td>'.$data->tanggalmasuktaiwan.'</td>
                    </tr>
                    <tr>
                        <td>11. Kembali ke dalam negeri</td>
                        <td>:</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>12. Nama Majikan</td>
                        <td>:</td>
                        <td>'.$data->majikan.'</td>
                    </tr>
                    <tr>
                        <td>13. Alamat Majikan</td>
                        <td>:</td>
                        <td>&nbsp;</td>
                    </tr>
                </tbody>
            </table>

            <p><strong>Yang diadukan :</strong></p>

            <table border="0" cellpadding="1" cellspacing="1" style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="width:250px">1. Nama Agensi/Majikan/PPTKIS</td>
                        <td style="width:15px">:</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>2. Alamat</td>
                        <td>:</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>3. No. Telpon</td>
                        <td>:</td>
                        <td>&nbsp;</td>
                    </tr>
                </tbody>
            </table>

            <p><strong>Masalah yang dilaporkan :</strong></p>
            <p>'.$data->permasalahan.'</p>
            </br></br>

            <p><strong>Tuntutan :&nbsp;</strong></p>
            <p>'.$data->tuntutan.'</p>
            </br></br>

            <p><strong>Langkah-langkah yang telah ditempuh :&nbsp;</strong></p>
            <p>'.$tindaklanjut.'</p>

            <p>Demikian surat pengaduan ini saya buat dengan sesungguhnya secara sadar, untuk dipergunakan sebagaimana mestinya.</p>

            <table border="0" cellpadding="1" cellspacing="1" style="width: 100%;">
                <tbody>
                    <tr>
                        <td>Petugas Penerima Pengaduan</td>
                        <td>Yang mengadukan</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Petugas Penanganan</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><u>'.$data->name.'</u></td>
                        <td>&nbsp;</td>
                    </tr>
                </tbody>
            </table>

            </body>
            </html>
        ';

        $pdf->writeHTML($html, true, false, true, false, '');
        ob_start();
        $pdf->Output($data->namatki.'_'.$data->paspor.'.pdf', 'I');

        /**
         *  Contoh Code
         *  $this->load->library('Pdf');
            $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
            $pdf->SetTitle('Pdf Example');
            $pdf->SetHeaderMargin(30);
            $pdf->SetTopMargin(20);
            $pdf->setFooterMargin(20);
            $pdf->SetAutoPageBreak(true);
            $pdf->SetAuthor('Author');
            $pdf->SetDisplayMode('real', 'default');
            $pdf->Write(5, 'CodeIgniter TCPDF Integration');
            $pdf->Output('pdfexample.pdf', 'I');
         */
    }
}
