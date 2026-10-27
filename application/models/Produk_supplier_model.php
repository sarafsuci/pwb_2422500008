<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_supplier_model extends CI_Model
{
    private $table = 'supplier';

    public function get_all()
    {
        return $this->db->order_by('id_supplier', 'ASC')->get($this->table)->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, array('id_supplier' => (int) $id))->row_array();
    }

    public function tambah($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->affected_rows() === 1;
    }

    public function ubah($data, $id)
    {
        $this->db->where('id_supplier', (int) $id)->update($this->table, $data);
        return $this->db->affected_rows() === 1;
    }

    public function hapus($id)
    {
        $this->db->delete($this->table, array('id_supplier' => (int) $id));
        return $this->db->affected_rows() === 1;
    }
}
