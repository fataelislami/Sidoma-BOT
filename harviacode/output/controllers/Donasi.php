<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Donasi extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Donasi_model');
        $this->load->library('form_validation');
    }

    public function index()
    {

      $datadonasi=$this->Donasi_model->get_all();//panggil ke modell
      $datafield=$this->Donasi_model->get_field();//panggil ke modell

      $data = array(
        'contain_view' => '{namamodule}/donasi/donasi_list',
        'sidebar'=>'{namamodule}/sidebar',
        'css'=>'{namamodule}/crudassets/css',
        'script'=>'{namamodule}/crudassets/script',
        'datadonasi'=>$datadonasi,
        'datafield'=>$datafield,
        'module'=>'{namamodule}'
       );
      $this->template->load($data);
    }


    public function create(){
      $data = array(
        'contain_view' => '{namamodule}/donasi/donasi_form',
        'sidebar'=>'{namamodule}/sidebar',//Ini buat menu yang ditampilkan di module admin {DIKIRIM KE TEMPLATE}
        'css'=>'{namamodule}/crudassets/css',//Ini buat kirim css dari page nya  {DIKIRIM KE TEMPLATE}
        'script'=>'{namamodule}/crudassets/script',//ini buat javascript apa aja yang di load di page {DIKIRIM KE TEMPLATE}
        'action'=>'{namamodule}/donasi/create_action'
       );
      $this->template->load($data);
    }

    public function edit($id){
      $dataedit=$this->Donasi_model->get_by_id($id);
      $data = array(
        'contain_view' => '{namamodule}/donasi/donasi_edit',
        'sidebar'=>'{namamodule}/sidebar',//Ini buat menu yang ditampilkan di module admin {DIKIRIM KE TEMPLATE}
        'css'=>'{namamodule}/crudassets/css',//Ini buat kirim css dari page nya  {DIKIRIM KE TEMPLATE}
        'script'=>'{namamodule}/crudassets/script',//ini buat javascript apa aja yang di load di page {DIKIRIM KE TEMPLATE}
        'action'=>'{namamodule}/donasi/update_action',
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
		'id_dkm' => $this->input->post('id_dkm',TRUE),
		'id_metode_bayar' => $this->input->post('id_metode_bayar',TRUE),
		'id_donatur' => $this->input->post('id_donatur',TRUE),
		'total_bayar' => $this->input->post('total_bayar',TRUE),
		'tanggal_bayar' => $this->input->post('tanggal_bayar',TRUE),
		'pesan' => $this->input->post('pesan',TRUE),
	    );

            $this->Donasi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('{namamodule}/donasi'));
        }
    }



    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id_donasi', TRUE));
        } else {
            $data = array(
		'id_dkm' => $this->input->post('id_dkm',TRUE),
		'id_metode_bayar' => $this->input->post('id_metode_bayar',TRUE),
		'id_donatur' => $this->input->post('id_donatur',TRUE),
		'total_bayar' => $this->input->post('total_bayar',TRUE),
		'tanggal_bayar' => $this->input->post('tanggal_bayar',TRUE),
		'pesan' => $this->input->post('pesan',TRUE),
	    );

            $this->Donasi_model->update($this->input->post('id_donasi', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('{namamodule}/donasi'));
        }
    }

    public function delete($id)
    {
        $row = $this->Donasi_model->get_by_id($id);

        if ($row) {
            $this->Donasi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('{namamodule}/donasi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('{namamodule}/donasi'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('id_dkm', 'id dkm', 'trim|required');
	$this->form_validation->set_rules('id_metode_bayar', 'id metode bayar', 'trim|required');
	$this->form_validation->set_rules('id_donatur', 'id donatur', 'trim|required');
	$this->form_validation->set_rules('total_bayar', 'total bayar', 'trim|required');
	$this->form_validation->set_rules('tanggal_bayar', 'tanggal bayar', 'trim|required');
	$this->form_validation->set_rules('pesan', 'pesan', 'trim|required');

	$this->form_validation->set_rules('id_donasi', 'id_donasi', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}