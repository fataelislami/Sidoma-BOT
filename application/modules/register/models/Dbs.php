<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dbs extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function check($table,$where){
		return $this->db->get_where($table,$where);
	}
}
