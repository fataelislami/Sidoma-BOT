<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    // $this->load->model(array('Dbs'));
  }

  function index()
  {

  }

  function load($data=NULL){
    $this->load->view('full', $data);

  }

}
