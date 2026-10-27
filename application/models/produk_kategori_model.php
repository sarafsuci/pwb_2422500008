<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_kategori_model extends CI_Model
{
    private $table = 'kategori';

    public function get_all()
    {
        return $this->db->order_by('id_kategori', 'ASC')->get($this->table)->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, array('id_kategori' => (int) $id))->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id_kategori', (int) $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->where('id_kategori', (int) $id)->delete($this->table);
    }

    // jumlah produk yang memakai kategori ini (kategori tidak boleh dihapus jika masih dipakai)
    public function count_produk($id)
    {
        return (int) $this->db->where('categori_id', (int) $id)->count_all_results('produk');
    }
}