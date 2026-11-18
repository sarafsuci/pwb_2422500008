<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('produk_model');
        $this->load->model('produk_gambar_model');
    }

    public function detail($id)
    {
        $data['produk'] = $this->produk_model->get_by_id($id);
        $data['list_gambar'] = $this->produk_gambar_model->get_by_produk_id($id);

        $this->load->view('ecom/template/header');
        $this->load->view('ecom/produk_detail', $data);
        $this->load->view('ecom/template/footer');
    }
}
