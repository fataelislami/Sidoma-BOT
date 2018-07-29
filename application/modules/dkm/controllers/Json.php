<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Json extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model(array('Dbs'));
  }

  function index()
  {

  }
function terdekat(){
    $lat=$_GET['lat'];
    $lng=$_GET['lng'];
    $cek=$this->Dbs->getdistance(5,$lat,$lng)->num_rows();
    if($cek>0){
      $status="success";
    }else{
      $status="ZERO_RESULTS";
    }
    $data=$this->Dbs->getdistance(5,$lat,$lng)->result();
    $api = array(
      'status' => $status,
      'results'=>$data

     );
    $json=json_encode($api);
    echo $json;
  }

}
