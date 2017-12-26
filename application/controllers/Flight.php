<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flight extends MY_Controller {

	private $data;

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Perlindungan/FlightPerlindungan_model', 'flight_perlindungan');
        $this->load->model('Endorsement/FlightPenempatan_model', 'flight_penempatan');

        $this->load_sidebar();
        $this->data['listdp'] = $this->listdp;
        $this->data['usedpg'] = $this->usedpg;
        $this->data['usedmpg'] = $this->usedmpg;
        $this->data['namainstitusi'] = $this->namainstitusi->nameinstitution;

        if(empty($this->namakantor->nama)){
            $this->data['namakantor'] = "";
        } else{
            $this->data['namakantor'] = $this->namakantor->nama;
        }

        $this->data['sidebar'] = 'SAdmin/Sidebar';
    }

    public function departure() {
        if ($this->session->userdata('role') == 3) {
            $this->data['list'] = $this->flight_perlindungan->list_all_departure($this->session->userdata('institution'), 
                $this->session->userdata('kantor'));

            $this->data['title'] = 'Keberangkatan TKI';
            $this->data['subtitle'] = 'Keberangkatan TKI';
            $this->load->view('templates/headerperlindungan', $this->data);
            $this->load->view('Perlindungan/FlightDeparture_view', $this->data);
            $this->load->view('templates/footerperlindungan');
        } else if ($this->session->userdata('role') == 6 || $this->session->userdata('role') == 7) {
            $this->data['list'] = $this->flight_penempatan->list_all_departure($this->session->userdata('institution'), 
                $this->session->userdata('kantor'));

            $this->data['title'] = 'Keberangkatan TKI';
            $this->data['subtitle'] = 'Keberangkatan TKI';
            $this->load->view('templates/headerendorsement', $this->data);
            $this->load->view('Endorsement/FlightDeparture_view', $this->data);
            $this->load->view('templates/footerendorsement');
        } else {
            show_error("Access is forbidden.",403,"403 Forbidden");
        }
    }

    public function arrival() {
        if ($this->session->userdata('role') == 3) {
            $this->data['list'] = $this->flight_perlindungan->list_all_arrival($this->session->userdata('institution'), 
                $this->session->userdata('kantor'));

            $this->data['title'] = 'Kepulangan TKI';
            $this->data['subtitle'] = 'Kepulangan TKI';
            $this->load->view('templates/headerperlindungan', $this->data);
            $this->load->view('Perlindungan/FlightArrival_view', $this->data);
            $this->load->view('templates/footerperlindungan');
        } else if ($this->session->userdata('role') == 6 || $this->session->userdata('role') == 7) {
            $this->data['list'] = $this->flight_penempatan->list_all_arrival($this->session->userdata('institution'), 
                $this->session->userdata('kantor'));

            $this->data['title'] = 'Kepulangan TKI';
            $this->data['subtitle'] = 'Kepulangan TKI';
            $this->load->view('templates/headerendorsement', $this->data);
            $this->load->view('Endorsement/FlightArrival_view', $this->data);
            $this->load->view('templates/footerendorsement');
        } else {
            show_error("Access is forbidden.",403,"403 Forbidden");
        }
    }

    public function departureEdit($idkeberangkatan) {
        $this->form_validation->set_rules('bandaracode', 'Kode Bandara', 'required|trim');
        $this->form_validation->set_rules('transitport', 'Transit Port', 'required|trim');

        if ($this->session->userdata('role') == 3) {
            $this->data['values'] =  $this->flight_perlindungan->get_departure($idkeberangkatan);

            if ($this->data['values']->idkantor != $this->session->userdata('kantor')) {
                show_error("Access is forbidden.",403,"403 Forbidden");
                return;
            }

            if ($this->form_validation->run() === FALSE) {
                $this->data['title'] = 'Edit Keberangkatan TKI';
                $this->data['subtitle'] = 'Edit Keberangkatan TKI';
                $this->load->view('templates/headerperlindungan', $this->data);
                $this->load->view('Perlindungan/EditFlightDeparture_view', $this->data);
                $this->load->view('templates/footerperlindungan');
            } else {
                $this->flight_perlindungan->update_departure($idkeberangkatan);
                redirect('flight/departure');
            }
        } else if ($this->session->userdata('role') == 6 || $this->session->userdata('role') == 7) {
            $this->data['values'] =  $this->flight_penempatan->get_departure($idkeberangkatan);

            if ($this->data['values']->idkantor != $this->session->userdata('kantor')) {
                show_error("Access is forbidden.",403,"403 Forbidden");
                return;
            }

            if ($this->form_validation->run() === FALSE) {
                $this->data['title'] = 'Edit Keberangkatan TKI';
                $this->data['subtitle'] = 'Edit Keberangkatan TKI';
                $this->load->view('templates/headerendorsement', $this->data);
                $this->load->view('Endorsement/EditFlightDeparture_view', $this->data);
                $this->load->view('templates/footerendorsement');
            } else {
                $this->flight_penempatan->update_departure($idkeberangkatan);
                redirect('flight/departure');
            }
        } else {
            show_error("Access is forbidden.",403,"403 Forbidden");
        }
    }

    public function departureDelete($idkeberangkatan) {
        if ($this->session->userdata('role') == 3) {
            $keberangkatan = $this->flight_perlindungan->get_departure($idkeberangkatan);

            if ($keberangkatan->idkantor != $this->session->userdata('kantor')) {
                show_error("Access is forbidden.",403,"403 Forbidden");
                return;
            }

            $this->flight_perlindungan->delete_departure($idkeberangkatan);
            redirect('flight/departure');
        } else if ($this->session->userdata('role') == 6 || $this->session->userdata('role') == 7) {
            $keberangkatan = $this->flight_penempatan->get_departure($idkeberangkatan);

            if ($keberangkatan->idkantor != $this->session->userdata('kantor')) {
                show_error("Access is forbidden.",403,"403 Forbidden");
                return;
            }

            $this->flight_penempatan->delete_departure($idkeberangkatan);
            redirect('flight/departure');
        } else {
            show_error("Access is forbidden.",403,"403 Forbidden");
        }
    }

    public function arrivalEdit($idkepulangan) {
        $this->form_validation->set_rules('bandaracode', 'Kode Bandara', 'required|trim');
        $this->form_validation->set_rules('transitport', 'Transit Port', 'required|trim');

        if ($this->session->userdata('role') == 3) {
            $this->data['values'] =  $this->flight_perlindungan->get_arrival($idkepulangan);

            if ($this->data['values']->idkantor != $this->session->userdata('kantor')) {
                show_error("Access is forbidden.",403,"403 Forbidden");
                return;
            }

            if ($this->form_validation->run() === FALSE) {
                $this->data['title'] = 'Edit Kepulangan TKI';
                $this->data['subtitle'] = 'Edit Kepulangan TKI';
                $this->load->view('templates/headerperlindungan', $this->data);
                $this->load->view('Perlindungan/EditFlightArrival_view', $this->data);
                $this->load->view('templates/footerperlindungan');
            } else {
                $this->flight_perlindungan->update_arrival($idkepulangan);
                redirect('flight/arrival');
            }
        } else if ($this->session->userdata('role') == 6 || $this->session->userdata('role') == 7) {
            $this->data['values'] =  $this->flight_penempatan->get_arrival($idkepulangan);

            if ($this->data['values']->idkantor != $this->session->userdata('kantor')) {
                show_error("Access is forbidden.",403,"403 Forbidden");
                return;
            }

            if ($this->form_validation->run() === FALSE) {
                $this->data['title'] = 'Edit Kepulangan TKI';
                $this->data['subtitle'] = 'Edit Kepulangan TKI';
                $this->load->view('templates/headerendorsement', $this->data);
                $this->load->view('Endorsement/EditFlightArrival_view', $this->data);
                $this->load->view('templates/footerendorsement');
            } else {
                $this->flight_penempatan->update_arrival($idkepulangan);
                redirect('flight/arrival');
            }
        } else {
            show_error("Access is forbidden.",403,"403 Forbidden");
        }
    }

    public function arrivalDelete($idkepulangan) {
        if ($this->session->userdata('role') == 3) {
            $kepulangan = $this->flight_perlindungan->get_arrival($idkepulangan);

            if ($kepulangan->idkantor != $this->session->userdata('kantor')) {
                show_error("Access is forbidden.",403,"403 Forbidden");
                return;
            }

            $this->flight_perlindungan->delete_arrival($idkepulangan);
            redirect('flight/arrival');
        } else if ($this->session->userdata('role') == 6 || $this->session->userdata('role') == 7) {
            $kepulangan = $this->flight_penempatan->get_arrival($idkepulangan);

            if ($kepulangan->idkantor != $this->session->userdata('kantor')) {
                show_error("Access is forbidden.",403,"403 Forbidden");
                return;
            }

            $this->flight_penempatan->delete_arrival($idkepulangan);
            redirect('flight/arrival');
        } else {
            show_error("Access is forbidden.",403,"403 Forbidden");
        }
    }
}