<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_admin_logged_in();
        $this->load->model('Produk_kategori_model', 'kategori_model');
        $this->load->library('form_validation');
    }

    private function render($view, $data = array())
    {
        $data['title'] = isset($data['title']) ? $data['title'] : 'Kategori Produk';
        $data['full_name'] = $this->session->userdata('full_name');
        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar', $data);
        $this->load->view('kategori/' . $view, $data);
        $this->load->view('administrator/templates/footer');
    }

    public function index()
    {
        $data['title'] = 'Data Kategori | PWB';
        $data['kategori'] = $this->kategori_model->get_all();
        $this->render('index', $data);
    }

    public function tambah()
    {
        $this->render('tambah_kategori', array('title' => 'Tambah Kategori | PWB'));
    }

    public function simpan()
    {
        $this->form_validation->set_rules('nama', 'Nama kategori', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|max_length[100]');

        if ($this->form_validation->run() === FALSE) {
            $this->render('tambah_kategori', array('title' => 'Tambah Kategori | PWB'));
            return;
        }

        $data = array(
            'nama' => trim($this->input->post('nama', TRUE)),
            'deskripsi' => trim($this->input->post('deskripsi', TRUE))
        );

        if ($this->kategori_model->insert($data)) {
            $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Kategori gagal ditambahkan.');
        }
        redirect('admin/kategori');
    }

    public function hapus($id)
    {
        if (!$this->kategori_model->get_by_id($id)) {
            show_404();
            return;
        }

        // kategori yang masih dipakai produk tidak boleh dihapus (relasi foreign key)
        if ($this->kategori_model->count_produk($id) > 0) {
            $this->session->set_flashdata('error', 'Kategori gagal dihapus. Kategori masih digunakan oleh produk.');
        } elseif ($this->kategori_model->delete($id)) {
            $this->session->set_flashdata('success', 'Kategori berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Kategori gagal dihapus.');
        }
        redirect('admin/kategori');
    }

    public function ubah($id)
    {
        $kategori = $this->kategori_model->get_by_id($id);
        if (!$kategori) {
            show_404();
            return;
        }

        $this->render('ubah_kategori', array(
            'title' => 'Ubah Kategori | PWB',
            'kategori' => $kategori
        ));
    }

    public function update($id)
    {
        $kategori = $this->kategori_model->get_by_id($id);
        if (!$kategori) {
            show_404();
            return;
        }

        $this->form_validation->set_rules('nama', 'Nama kategori', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|max_length[100]');

        if ($this->form_validation->run() === FALSE) {
            $this->render('ubah_kategori', array(
                'title' => 'Ubah Kategori | PWB',
                'kategori' => $kategori
            ));
            return;
        }

        $data = array(
            'nama' => trim($this->input->post('nama', TRUE)),
            'deskripsi' => trim($this->input->post('deskripsi', TRUE))
        );

        if ($this->kategori_model->update($id, $data)) {
            $this->session->set_flashdata('success', 'Kategori berhasil diubah.');
        } else {
            $this->session->set_flashdata('error', 'Kategori gagal diubah.');
        }
        redirect('admin/kategori');
    }
}