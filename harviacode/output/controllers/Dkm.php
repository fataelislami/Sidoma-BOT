<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dkm extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Dkm_model');
        $this->load->library('form_validation');
    }

    public function index()
    {

      $datadkm=$this->Dkm_model->get_all();//panggil ke modell
      $datafield=$this->Dkm_model->get_field();//panggil ke modell

      $data = array(
        'contain_view' => '{namamodule}/dkm/dkm_list',
        'sidebar'=>'{namamodule}/sidebar',
        'css'=>'{namamodule}/crudassets/css',
        'script'=>'{namamodule}/crudassets/script',
        'datadkm'=>$datadkm,
        'datafield'=>$datafield,
        'module'=>'{namamodule}'
       );
      $this->template->load($data);
    }


    public function create(){
      $data = array(
        'contain_view' => '{namamodule}/dkm/dkm_form',
        'sidebar'=>'{namamodule}/sidebar',//Ini buat menu yang ditampilkan di module admin {DIKIRIM KE TEMPLATE}
        'css'=>'{namamodule}/crudassets/css',//Ini buat kirim css dari page nya  {DIKIRIM KE TEMPLATE}
        'script'=>'{namamodule}/crudassets/script',//ini buat javascript apa aja yang di load di page {DIKIRIM KE TEMPLATE}
        'action'=>'{namamodule}/dkm/create_action'
       );
      $this->template->load($data);
    }

    public function edit($id){
      $dataedit=$this->Dkm_model->get_by_id($id);
      $data = array(
        'contain_view' => '{namamodule}/dkm/dkm_edit',
        'sidebar'=>'{namamodule}/sidebar',//Ini buat menu yang ditampilkan di module admin {DIKIRIM KE TEMPLATE}
        'css'=>'{namamodule}/crudassets/css',//Ini buat kirim css dari page nya  {DIKIRIM KE TEMPLATE}
        'script'=>'{namamodule}/crudassets/script',//ini buat javascript apa aja yang di load di page {DIKIRIM KE TEMPLATE}
        'action'=>'{namamodule}/dkm/update_action',
        'dataedit'=>$dataedit
       );
      $this->template->load($data);
    }


    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'username' => $this->input->post('username',TRUE),
		'password' => $this->input->post('password',TRUE),
		'no_ktp' => $this->input->post('no_ktp',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
		'kontak' => $this->input->post('kontak',TRUE),
		'email' => $this->input->post('email',TRUE),
		'url_foto' => $this->input->post('url_foto',TRUE),
		'bank' => $this->input->post('bank',TRUE),
		'no_rekening' => $this->input->post('no_rekening',TRUE),
	    );

            $this->Dkm_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('{namamodule}/dkm'));
        }
    }



    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id_dkm', TRUE));
        } else {
            $data = array(
		'username' => $this->input->post('username',TRUE),
		'password' => $this->input->post('password',TRUE),
		'no_ktp' => $this->input->post('no_ktp',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
		'kontak' => $this->input->post('kontak',TRUE),
		'email' => $this->input->post('email',TRUE),
		'url_foto' => $this->input->post('url_foto',TRUE),
		'bank' => $this->input->post('bank',TRUE),
		'no_rekening' => $this->input->post('no_rekening',TRUE),
	    );

            $this->Dkm_model->update($this->input->post('id_dkm', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('{namamodule}/dkm'));
        }
    }

    public function delete($id)
    {
        $row = $this->Dkm_model->get_by_id($id);

        if ($row) {
            $this->Dkm_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('{namamodule}/dkm'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('{namamodule}/dkm'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('no_ktp', 'no ktp', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
	$this->form_validation->set_rules('kontak', 'kontak', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('url_foto', 'url foto', 'trim|required');
	$this->form_validation->set_rules('bank', 'bank', 'trim|required');
	$this->form_validation->set_rules('no_rekening', 'no rekening', 'trim|required');

	$this->form_validation->set_rules('id_dkm', 'id_dkm', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}