<?php
class PKP_model extends CI_Model {
  private $table = 'pkp';
	public function __construct()
    {
        $this->load->database('default');
    }
}
