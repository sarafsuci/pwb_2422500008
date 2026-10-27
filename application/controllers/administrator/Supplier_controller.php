<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_admin_logged_in();
        $this->load->model('Produk_supplier_model', 'supplier_model');
        $this->load->library('form_validation');
    }

    private function render($view, $data = array())
    {
        $data['title'] = isset($data['title']) ? $data['title'] : 'Data Supplier';
        $data['full_name'] = $this->session->userdata('full_name');
        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar', $data);
        $this->load->view('supplier/' . $view, $data);
        $this->load->view('administrator/templates/footer');
    }

    public function index()
    {
        $this->render('index', array(
            'title' => 'Data Supplier | PWB',
            'supplier' => $this->supplier_model->get_all()
        ));
    }

    public function tambah()
    {
        $this->render('tambah_supplier', array('title' => 'Tambah Supplier | PWB'));
    }

    public function simpan()
    {
        $this->set_supplier_rules();
        if ($this->form_validation->run() === FALSE) {
            $this->tambah();
            return;
        }

        if ($this->supplier_model->tambah($this->supplier_data())) {
            $this->session->set_flashdata('success', 'Supplier berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Supplier gagal ditambahkan.');
        }
        redirect('admin/supplier');
    }

    public function ubah($id)
    {
        $supplier = $this->supplier_model->get_by_id($id);
        if (!$supplier) {
            show_404();
            return;
        }
        $this->render('ubah_supplier', array(
            'title' => 'Ubah Supplier | PWB',
            'supplier' => $supplier
        ));
    }

    public function update($id)
    {
        $supplier = $this->supplier_model->get_by_id($id);
        if (!$supplier) {
            show_404();
            return;
        }

        $this->set_supplier_rules();
        if ($this->form_validation->run() === FALSE) {
            $this->render('ubah_supplier', array(
                'title' => 'Ubah Supplier | PWB',
                'supplier' => $supplier
            ));
            return;
        }

        if ($this->supplier_model->ubah($this->supplier_data(), $id)) {
            $this->session->set_flashdata('success', 'Supplier berhasil diubah.');
        } else {
            $this->session->set_flashdata('error', 'Supplier gagal diubah atau tidak ada perubahan.');
        }
        redirect('admin/supplier');
    }

    public function hapus($id)
    {
        if (!$this->supplier_model->get_by_id($id)) {
            show_404();
            return;
        }

        if ($this->supplier_model->hapus($id)) {
            $this->session->set_flashdata('success', 'Supplier berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Supplier gagal dihapus.');
        }
        redirect('admin/supplier');
    }

    private function set_supplier_rules()
    {
        $this->form_validation->set_rules('nama_supplier', 'Nama supplier', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('telepon', 'Telepon', 'required|trim|max_length[20]');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|max_length[100]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim');
    }

    private function supplier_data()
    {
        $email = trim((string) $this->input->post('email', TRUE));
        $alamat = trim((string) $this->input->post('alamat', TRUE));
        return array(
            'nama_supplier' => trim($this->input->post('nama_supplier', TRUE)),
            'telepon' => trim($this->input->post('telepon', TRUE)),
            'email' => $email === '' ? NULL : $email,
            'alamat' => $alamat === '' ? NULL : $alamat
        );
    }
}
