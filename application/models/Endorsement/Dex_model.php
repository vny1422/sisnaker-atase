<?php
class Dex_model extends CI_Model {
  private $table = 'dex';
  public function __construct()
  {
    $this->load->database('default');
  }
}
