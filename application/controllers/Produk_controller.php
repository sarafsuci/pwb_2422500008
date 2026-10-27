<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_admin_logged_in();
        // Load model
        $this->load->model('produk_model');
        $this->load->model('produk_kategori_model');
        $this->load->model('produk_gambar_model');
    }

    public function index()
    {
        $data['title'] = 'Daftar Produk';
        $data['list_produk'] = $this->produk_model->get_all();
        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar');
        $this->load->view('administrator/produk/index');
        $this->load->view('administrator/templates/footer');
    }

    public function tambah_produk()
    {
        $data['title'] = 'Tambah Produk';
        $this->form_validation->set_rules('nama_produk', 'Nama produk', 'required');
        $this->form_validation->set_rules('kategori_produk', 'Kategori', 'required');

        if ($this->form_validation->run() !== FALSE) {
            $this->__simpan_produk();
        } else {
            $data['list_kategori'] = $this->produk_kategori_model->get_all();
            $this->load->view('administrator/templates/header', $data);
            $this->load->view('administrator/templates/sidebar');
            $this->load->view('administrator/produk/tambah_produk', $data);
            $this->load->view('administrator/templates/footer');
        }
    }

    private function __simpan_produk()
    {
        $data = [
            'nama' => ucwords($this->input->post('nama_produk')),
            'categori_id' => $this->input->post('kategori_produk'),
            'harga' => $this->input->post('harga_produk'),
            'stok' => $this->input->post('stok_produk'),
            'deskripsi' => ucfirst($this->input->post('deskripsi_produk'))
        ];

        $id_produk = $this->produk_model->tambah($data);

        $count = count($_FILES['gambar_produk']['name']);
        if ($count > 0) {
            $this->__produk_gambar_upload($count, $id_produk);
        }

        $this->session->set_flashdata('message', '
        <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill" />
            </svg>
            <div>Berhasil menambahkan produk!!</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ');
        redirect('administrator/produk');
    }

    public function ubah_produk($id)
    {
        $produk = $this->produk_model->get_by_id($id);
        if ($produk) {
            $this->form_validation->set_rules('nama_produk', 'Nama produk', 'required');
            $this->form_validation->set_rules('kategori_produk', 'Kategori', 'required');

            if ($this->form_validation->run() !== FALSE) {
                $this->__ubah_produk($id);
            } else {
                $data['title'] = 'Ubah produk';
                $data['produk'] = $produk;
                $data['list_kategori'] = $this->produk_kategori_model->get_all();
                $data['gambar_model'] = $this->produk_gambar_model;
                $this->load->view('administrator/templates/header', $data);
                $this->load->view('administrator/templates/sidebar');
                $this->load->view('administrator/produk/ubah_produk', $data);
                $this->load->view('administrator/templates/footer');
            }
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>Produk tidak ditemukan!!</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
            redirect('administrator/produk');
        }
    }

    private function __ubah_produk($id)
    {
        $data = [
            'nama' => ucwords($this->input->post('nama_produk')),
            'categori_id' => $this->input->post('kategori_produk'),
            'harga' => $this->input->post('harga_produk'),
            'stok' => $this->input->post('stok_produk'),
            'deskripsi' => ucfirst($this->input->post('deskripsi_produk'))
        ];

        // Update data produk
        $this->produk_model->ubah($data, $id);

        // ✅ TAMBAHAN: Upload gambar baru jika user memilih gambar
        $count = count($_FILES['gambar_produk']['name']);
        if ($count > 0 && !empty($_FILES['gambar_produk']['name'][0])) {
            $this->__produk_gambar_upload($count, $id);
        }

        $this->session->set_flashdata('message', '
        <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill" />
            </svg>
            <div>Berhasil mengubah produk!!</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ');
        redirect('administrator/produk');
    }

    public function hapus_produk($id)
    {
        $produk = $this->produk_model->get_by_id($id);
        if ($produk) {
            $list_gambar = $this->produk_gambar_model->get_by_produk_id($id);
            foreach ($list_gambar as $gambar) {
                $this->produk_gambar_model->hapus($gambar['id_gambar']);
                $path = './uploads/produk/' . $gambar['nama_gambar'];
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $this->produk_model->hapus($id);
            $this->session->set_flashdata('message', '
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>Berhasil menghapus produk!!</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
            redirect('administrator/produk');
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>Produk tidak ditemukan!!</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
            redirect('administrator/produk');
        }
    }

    // ✅ TAMBAHAN: Method hapus gambar produk satu per satu
    public function hapus_gambar_produk($id_gambar, $id_produk)
    {
        $gambar = $this->produk_gambar_model->get_by_id($id_gambar);
        if ($gambar) {
            $path = './uploads/produk/' . $gambar['nama_gambar'];
            if (file_exists($path)) {
                unlink($path);
            }
            $this->produk_gambar_model->hapus($id_gambar);

            $this->session->set_flashdata('message', '
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>Berhasil menghapus gambar produk!!</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>Gambar tidak ditemukan!!</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
        }
        redirect('administrator/produk/ubah_produk/' . $id_produk);
    }

    private function __produk_gambar_upload($count, $id_produk)
    {
        for ($i = 0; $i < $count; $i++) {
            if (!empty($_FILES['gambar_produk']['name'][$i])) {
                $_FILES['file']['name'] = $_FILES['gambar_produk']['name'][$i];
                $_FILES['file']['type'] = $_FILES['gambar_produk']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['gambar_produk']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['gambar_produk']['error'][$i];
                $_FILES['file']['size'] = $_FILES['gambar_produk']['size'][$i];

                $config['upload_path'] = 'uploads/produk/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '5000';
                $config['file_name'] = "produk-" . $id_produk . '-' . time() . '-' . $i;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $data = [
                        'nama_gambar' => $uploadData['file_name'],
                        'produk_id' => $id_produk
                    ];
                    $this->produk_gambar_model->tambah($data);
                }
            }
        }
    }
}