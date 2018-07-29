<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// Resource by fataelislami@kostlab.id
class Fungsi extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {

  }

  public function email($subject,$isi,$emailtujuan){

  $config['protocol'] = 'smtp';
  $config['smtp_host'] = 'ssl://smtp.gmail.com';
  $config['smtp_port'] = '465';
  $config['smtp_user'] = 'shopagansta@gmail.com';
  $config['smtp_pass'] = 'faztars123'; //ini pake akun pass google email
  $config['mailtype'] = 'html';
  $config['charset'] = 'iso-8859-1';
  $config['wordwrap'] = 'TRUE';
  $config['newline'] = "\r\n";

  $this->load->library('email', $config);
  $this->email->initialize($config);

  $this->email->from('shopagansta@gmail.com');
  $this->email->to($emailtujuan);
  $this->email->subject($subject);
  $this->email->message($isi);
  $this->email->set_mailtype('html');
  $this->email->send();
}

public function upload_foto(){
$config['upload_path']          = './assets/{destinasi}';
$config['allowed_types']        = 'gif|jpg|png|jpeg';
$config['encrypt_name'] = TRUE;
//$config['max_size']             = 100;
//$config['max_width']            = 1024;
//$config['max_height']           = 768;
$this->load->library('upload', $config);
$this->upload->do_upload($formname);
return $this->upload->data();

//Cara pemakaian
//hidupkan object terlebih dahulu
//misal
//$foto=$this->upload_foto();
}


}
