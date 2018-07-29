<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dbs extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function getdata($table){
    $sql=$this->db->get($table);
    return $sql;
  }

  function getwhere($where,$value,$table){
    $this->db->where($where, $value);
    $db=$this->db->get($table);
    return $db;
  }


  function insert($data,$table){
   $insert = $this->db->insert($table, $data);
   if ($this->db->affected_rows()>0) {
     return true;
     }else{
     return false;
     }
 }

 function update($data,$table,$where,$value){
    $this->db->where($where,$value);
    $db=$this->db->update($table,$data);
    if ($this->db->affected_rows()>0) {
      return true;
      }else{
      return false;
      }
  }

}
