<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model(array('Dbs'));
    if($this->session->userdata('status')!='login'){
      redirect(base_url('login'));
    }
    if($this->session->userdata('role')!=1){
      redirect(redirect($_SERVER['HTTP_REFERER']));
    }
  }

  function index()
  {

    $data = array(
      'contain_view' => 'admin/home_v',
      'sidebar'=>'admin/sidebar',//Ini buat menu yang ditampilkan di module admin {DIKIRIM KE TEMPLATE}
      'css'=>'admin/assets/css',//Ini buat kirim css dari page nya  {DIKIRIM KE TEMPLATE}
      'script'=>'admin/assets/script',//ini buat javascript apa aja yang di load di page {DIKIRIM KE TEMPLATE}
      'nama'=>'ADMIN',//ngirim variable ke view yang ada di module admin {DIKIRIM KE VIEW ADMIN}
     );
    // $this->load->view('home_v', $data);
    $this->template->load($data);//pake sistem template, semua view yang di module berupa body saja
  }

}
