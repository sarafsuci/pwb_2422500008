<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kota2422500008_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_admin_logged_in();
        $this->load->model('Kota2422500008_model', 'kota_model');
        $this->load->library('form_validation');
    }

    private function render($view, $data = array())
    {
        $data['title'] = isset($data['title']) ? $data['title'] : 'Data Kota';
        $data['full_name'] = $this->session->userdata('full_name');
        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar', $data);
        $this->load->view('kota/' . $view, $data);
        $this->load->view('administrator/templates/footer');
    }

    public function index()
    {
        $this->render('index', array(
            'title' => 'Data Kota | PWB',
            'kota' => $this->kota_model->get_all()
        ));
    }

    public function tambah()
    {
        $this->render('tambah_kota', array('title' => 'Tambah Kota | PWB'));
    }

    public function simpan()
    {
        $this->set_rules();
        if ($this->form_validation->run() === FALSE) {
            $this->tambah();
            return;
        }

        if ($this->kota_model->tambah($this->kota_data())) {
            $this->session->set_flashdata('success', 'Kota berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Kota gagal ditambahkan.');
        }
        redirect('admin/kota');
    }

    public function ubah($id)
    {
        $kota = $this->kota_model->get_by_id($id);
        if (!$kota) {
            show_404();
            return;
        }
        $this->render('ubah_kota', array('title' => 'Ubah Kota | PWB', 'kota' => $kota));
    }

    public function update($id)
    {
        $kota = $this->kota_model->get_by_id($id);
        if (!$kota) {
            show_404();
            return;
        }

        $this->set_rules();
        if ($this->form_validation->run() === FALSE) {
            $this->render('ubah_kota', array('title' => 'Ubah Kota | PWB', 'kota' => $kota));
            return;
        }

        if ($this->kota_model->ubah($this->kota_data(), $id)) {
            $this->session->set_flashdata('success', 'Kota berhasil diubah.');
        } else {
            $this->session->set_flashdata('error', 'Kota gagal diubah.');
        }
        redirect('admin/kota');
    }

    public function hapus($id)
    {
        if (!$this->kota_model->get_by_id($id)) {
            show_404();
            return;
        }

        if ($this->kota_model->hapus($id)) {
            $this->session->set_flashdata('success', 'Kota berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Kota gagal dihapus.');
        }
        redirect('admin/kota');
    }

    private function set_rules()
    {
        $this->form_validation->set_rules('nama_kota008', 'Nama kota', 'required|trim|max_length[50]');
        $this->form_validation->set_rules('jenis_kota008', 'Jenis kota', 'required|in_list[Kota,Kabupaten]');
        $this->form_validation->set_rules('provinsi008', 'Provinsi', 'required|trim|max_length[10]');
        $this->form_validation->set_rules('status008', 'Status', 'required|in_list[Aktif,Tidak Aktif]');
    }

    private function kota_data()
    {
        return array(
            'nama_kota008' => trim($this->input->post('nama_kota008', TRUE)),
            'jenis_kota008' => $this->input->post('jenis_kota008', TRUE),
            'provinsi008' => trim($this->input->post('provinsi008', TRUE)),
            'status008' => $this->input->post('status008', TRUE)
        );
    }
}
