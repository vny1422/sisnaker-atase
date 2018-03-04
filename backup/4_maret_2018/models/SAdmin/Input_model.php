<?php
class Input_model extends CI_Model {

    public function __construct()
    {
        $this->load->database('default');
    }

    public function post_new_input($param, $data)
    {
        if ($param == 'penempatan'){
            $table = 'inputdetail_penempatan';
              $this->db->select('COLUMN_NAME');
              $this->db->where('table_name','entryjo');
              $this->db->where('table_schema','sisnaker');
              $this->db->where('column_name',$this->input->post('fieldname',TRUE));
              $rows = $this->db->get('INFORMATION_SCHEMA.COLUMNS')->num_rows();
              if($rows == 0)
              {
                $checktype = $this->db->get_where('inputtype', array('idinputtype' => $this->input->post('inputtype',TRUE)))->row();
                if($checktype->nameinputtype != 'date' && $checktype->nameinputtype != 'Date' && $checktype->nameinputtype != 'DATE')
                {
                  $this->db->query('ALTER TABLE masalah ADD COLUMN '.$this->input->post('fieldname',TRUE).' VARCHAR(45)');
                }
                elseif ($checktype->nameinputtype != 'textarea' && $checktype->nameinputtype != 'Textarea' && $checktype->nameinputtype != 'TEXTAREA') {
                  $this->db->query('ALTER TABLE masalah ADD COLUMN '.$this->input->post('fieldname',TRUE).' text');
                }
                else {
                  $this->db->query('ALTER TABLE masalah ADD COLUMN '.$this->input->post('fieldname',TRUE).' date');
                }
              }

        } else {
            $table = 'inputdetail_perlindungan';
            $this->db->select('COLUMN_NAME');
            $this->db->where('table_name','masalah');
            $this->db->where('table_schema','sisnaker');
            $this->db->where('column_name',$this->input->post('fieldname',TRUE));
            $rows = $this->db->get('INFORMATION_SCHEMA.COLUMNS')->num_rows();
            if($rows == 0)
            {
              $checktype = $this->db->get_where('inputtype', array('idinputtype' => $this->input->post('inputtype',TRUE)))->row();
              if($checktype->nameinputtype != 'date' && $checktype->nameinputtype != 'Date' && $checktype->nameinputtype != 'DATE')
              {
                $this->db->query('ALTER TABLE masalah ADD COLUMN '.$this->input->post('fieldname',TRUE).' VARCHAR(45)');
              }
              elseif ($checktype->nameinputtype != 'textarea' && $checktype->nameinputtype != 'Textarea' && $checktype->nameinputtype != 'TEXTAREA') {
                $this->db->query('ALTER TABLE masalah ADD COLUMN '.$this->input->post('fieldname',TRUE).' text');
              }
              else {
                $this->db->query('ALTER TABLE masalah ADD COLUMN '.$this->input->post('fieldname',TRUE).' date');
              }
            }
        }

		$this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function post_new_input_option($param, $data)
    {
        if ($param == 'penempatan'){
            $table = 'inputoption_penempatan';

        } else {
            $table = 'inputoption_perlindungan';
        }

        $this->db->insert_batch($table, $data);
    }

    public function post_new_input_institution($param,$idinstitution)
    {
        if ($param == 'penempatan'){
            $table = 'institution_has_inputdetail_penempatan';
            $idinput = 'idinputdetail_penempatan';
        } else {
            $table = 'institution_has_inputdetail_perlindungan';
            $idinput = 'idinputdetail_perlindungan';
        }

        $data = array(
            'idinstitution' => $idinstitution,
            $idinput => $this->input->post('idinputdetail',TRUE),
            'isactive' => 1
        );

        return $this->db->insert($table, $data);
    }

    public function get_input($param, $id)
    {
        if ($param == 'penempatan'){
            $table = 'inputdetail_penempatan';
            $idinput = 'idinputdetail_penempatan';
        } else {
            $table = 'inputdetail_perlindungan';
            $idinput = 'idinputdetail_perlindungan';
        }

        return $this->db->get_where($table, array($idinput => $id))->row();
    }

    public function get_input_institution($param)
    {
        if ($param == 'penempatan'){
            $table = 'institution_has_inputdetail_penempatan';

        } else {
            $table = 'institution_has_inputdetail_perlindungan';
        }

        $idinstitution = $this->input->post('idinstitution',TRUE);

        return $this->db->get_where($table, array('idinstitution' => $idinstitution))->result();
    }

    public function list_all_input($param)
    {
        if ($param == 'penempatan'){
            $table = 'inputdetail_penempatan';

        } else {
            $table = 'inputdetail_perlindungan';
        }
        return $this->db->get($table)->result();
    }

    public function delete_input_institution($param,$idinstitution)
    {
        if ($param == 'penempatan'){
            $table = 'institution_has_inputdetail_penempatan';
            $idinput = 'idinputdetail_penempatan';
        } else {
            $table = 'institution_has_inputdetail_perlindungan';
            $idinput = 'idinputdetail_perlindungan';
        }

        $idinputdetail = $this->input->post('idinputdetail',TRUE);

        $this->db->where('idinstitution',$idinstitution);
        $this->db->where($idinput,$idinputdetail);
        return $this->db->delete($table);
    }

    public function check_input_institution($param)
    {
        if ($param == 'penempatan'){
            $table = 'institution_has_inputdetail_penempatan';
            $idinput = 'idinputdetail_penempatan';
        } else {
            $table = 'institution_has_inputdetail_perlindungan';
            $idinput = 'idinputdetail_perlindungan';
        }

        $idinstitution = $this->input->post('idinstitution',TRUE);
        $idinputdetail = $this->input->post('idinputdetail',TRUE);

        return $this->db->get_where($table, array($idinput => $idinputdetail, 'idinstitution' => $idinstitution))->row();
    }

    public function get_input_dataworker($idinstitution)
    {
      $this->db->select('ip.nameinputdetail,ip.fieldname');
      $this->db->from('institution_has_inputdetail_penempatan i');
      $this->db->join('inputdetail_penempatan ip', 'ip.idinputdetail_penempatan = i.idinputdetail_penempatan', 'left');
      $this->db->where('i.idinstitution',$idinstitution);
      $this->db->where('i.isactive', 1);
      $this->db->where('ip.idcategory_penempatan', 1);
      return $this->db->get()->result();
    }

    public function get_input_joborder($idinstitution)
    {
      $this->db->select('ip.nameinputdetail,ip.fieldname');
      $this->db->from('institution_has_inputdetail_penempatan i');
      $this->db->join('inputdetail_penempatan ip', 'ip.idinputdetail_penempatan = i.idinputdetail_penempatan', 'left');
      $this->db->where('i.idinstitution',$idinstitution);
      $this->db->where('i.isactive', 1);
      $this->db->where('ip.idcategory_penempatan', 2);
      return $this->db->get()->result();
    }
}
