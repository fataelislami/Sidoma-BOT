<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Masjid extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Masjid_model');
        $this->load->library('form_validation');
    }

    public function index()
    {

      $datamasjid=$this->Masjid_model->get_all();//panggil ke modell
      $datafield=$this->Masjid_model->get_field();//panggil ke modell

      $data = array(
        'contain_view' => '{namamodule}/masjid/masjid_list',
        'sidebar'=>'{namamodule}/sidebar',
        'css'=>'{namamodule}/crudassets/css',
        'script'=>'{namamodule}/crudassets/script',
        'datamasjid'=>$datamasjid,
        'datafield'=>$datafield,
        'module'=>'{namamodule}'
       );
      $this->template->load($data);
    }


    public function create(){
      $data = array(
        'contain_view' => '{namamodule}/masjid/masjid_form',
        'sidebar'=>'{namamodule}/sidebar',//Ini buat menu yang ditampilkan di module admin {DIKIRIM KE TEMPLATE}
        'css'=>'{namamodule}/crudassets/css',//Ini buat kirim css dari page nya  {DIKIRIM KE TEMPLATE}
        'script'=>'{namamodule}/crudassets/script',//ini buat javascript apa aja yang di load di page {DIKIRIM KE TEMPLATE}
        'action'=>'{namamodule}/masjid/create_action'
       );
      $this->template->load($data);
    }

    public function edit($id){
      $dataedit=$this->Masjid_model->get_by_id($id);
      $data = array(
        'contain_view' => '{namamodule}/masjid/masjid_edit',
        'sidebar'=>'{namamodule}/sidebar',//Ini buat menu yang ditampilkan di module admin {DIKIRIM KE TEMPLATE}
        'css'=>'{namamodule}/crudassets/css',//Ini buat kirim css dari page nya  {DIKIRIM KE TEMPLATE}
        'script'=>'{namamodule}/crudassets/script',//ini buat javascript apa aja yang di load di page {DIKIRIM KE TEMPLATE}
        'action'=>'{namamodule}/masjid/update_action',
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
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'latitude' => $this->input->post('latitude',TRUE),
		'longitude' => $this->input->post('longitude',TRUE),
		'url_foto' => $this->input->post('url_foto',TRUE),
		'id_dkm' => $this->input->post('id_dkm',TRUE),
	    );

            $this->Masjid_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('{namamodule}/masjid'));
        }
    }



    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('id_masjid', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'latitude' => $this->input->post('latitude',TRUE),
		'longitude' => $this->input->post('longitude',TRUE),
		'url_foto' => $this->input->post('url_foto',TRUE),
		'id_dkm' => $this->input->post('id_dkm',TRUE),
	    );

            $this->Masjid_model->update($this->input->post('id_masjid', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('{namamodule}/masjid'));
        }
    }

    public function delete($id)
    {
        $row = $this->Masjid_model->get_by_id($id);

        if ($row) {
            $this->Masjid_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('{namamodule}/masjid'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('{namamodule}/masjid'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('latitude', 'latitude', 'trim|required|numeric');
	$this->form_validation->set_rules('longitude', 'longitude', 'trim|required|numeric');
	$this->form_validation->set_rules('url_foto', 'url foto', 'trim|required');
	$this->form_validation->set_rules('id_dkm', 'id dkm', 'trim|required');

	$this->form_validation->set_rules('id_masjid', 'id_masjid', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}