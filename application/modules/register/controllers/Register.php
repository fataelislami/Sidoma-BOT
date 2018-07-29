<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model(array('User_model','Dbs'));
  }

  function index()
  {
    $this->load->view('vRegister');
  }

  function test(){
    echo $this->session->flashdata('errorMessage');
  }
  function action(){
    $data = array(
      'username' => $this->input->post('username',TRUE),
      'password' => md5($this->input->post('password',TRUE)),
      'nama' => $this->input->post('nama',TRUE),
      'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
      'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
      'email' => $this->input->post('email',TRUE),
      'kota' => $this->input->post('kota',TRUE),
      'id_level' => 2,
      );

      $where = array('username' => $this->input->post('username',TRUE) );
      $sql = $this->Dbs->check("user",$where);
      $check=$sql->num_rows();
  		if($check > 0){
        $this->session->set_flashdata('errorMessage', 'Username sudah pernah dipakai,silahkan gunakan username lain');
        redirect(base_url('register'));
  		}else{
        $this->User_model->insert($data);
        $this->session->set_flashdata('flashMessage', 'Pendaftaran Berhasil, Silahkan Login');
      redirect(site_url('login'));
  		}

  }



}
