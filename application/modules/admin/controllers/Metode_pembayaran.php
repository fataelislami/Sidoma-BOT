<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Metode_pembayaran extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Metode_pembayaran_model');
        $this->load->library('form_validation');
    }

    public function index()
    {

      $datametode_pembayaran=$this->Metode_pembayaran_model->get_all();//panggil ke modell
      $datafield=$this->Metode_pembayaran_model->get_field();//panggil ke modell

      $data = array(
        'contain_view' => 'admin/metode_pembayaran/metode_pembayaran_list',
        'sidebar'=>'admin/sidebar',
        'css'=>'admin/crudassets/css',
        'script'=>'admin/crudassets/script',
        'datametode_pembayaran'=>$datametode_pembayaran,
        'datafield'=>$datafield,
        'module'=>'admin'
       );
      $this->template->load($data);
    }


    public function create(){
      $data = array(
        'contain_view' => 'admin/metode_pembayaran/metode_pembayaran_form',
        'sidebar'=>'admin/sidebar',//Ini buat menu yang ditampilkan di module admin {DIKIRIM KE TEMPLATE}
        'css'=>'admin/crudassets/css',//Ini buat kirim css dari page nya  {DIKIRIM KE TEMPLATE}
        'script'=>'admin/crudassets/script',//ini buat javascript apa aja yang di load di page {DIKIRIM KE TEMPLATE}
        'action'=>'admin/metode_pembayaran/create_action'
       );
      $this->template->load($data);
    }

    public function edit($id){
      $dataedit=$this->Metode_pembayaran_model->get_by_id($id);
      $data = array(
        'contain_view' => 'admin/metode_pembayaran/metode_pembayaran_edit',
        'sidebar'=>'admin/sidebar',//Ini buat menu yang ditampilkan di module admin {DIKIRIM KE TEMPLATE}
        'css'=>'admin/crudassets/css',//Ini buat kirim css dari page nya  {DIKIRIM KE TEMPLATE}
        'script'=>'admin/crudassets/script',//ini buat javascript apa aja yang di load di page {DIKIRIM KE TEMPLATE}
        'action'=>'admin/metode_pembayaran/update_action',
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
		'nama_bank' => $this->input->post('nama_bank',TRUE),
		'no_rekening' => $this->input->post('no_rekening',TRUE),
		'id_admin' => $this->session->userdata('id_admin'),
	    );

            $this->Metode_pembayaran_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/metode_pembayaran'));
        }
    }



    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id_metode_bayar', TRUE));
        } else {
            $data = array(
		'nama_bank' => $this->input->post('nama_bank',TRUE),
		'no_rekening' => $this->input->post('no_rekening',TRUE),
		'id_admin' => $this->session->userdata('id_admin'),
	    );

            $this->Metode_pembayaran_model->update($this->input->post('id_metode_bayar', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/metode_pembayaran'));
        }
    }

    public function delete($id)
    {
        $row = $this->Metode_pembayaran_model->get_by_id($id);

        if ($row) {
            $this->Metode_pembayaran_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/metode_pembayaran'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/metode_pembayaran'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('nama_bank', 'nama bank', 'trim|required');
	$this->form_validation->set_rules('no_rekening', 'no rekening', 'trim|required');

	$this->form_validation->set_rules('id_metode_bayar', 'id_metode_bayar', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
