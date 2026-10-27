<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kota2422500008_model extends CI_Model
{
    private $table = 'Kota2422500008';

    public function get_all()
    {
        return $this->db->order_by('id_kota008', 'ASC')->get($this->table)->result_array();
    }

    public function tambah($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, array('id_kota008' => (int) $id))->row_array();
    }

    public function ubah($data, $id)
    {
        return $this->db->where('id_kota008', (int) $id)->update($this->table, $data);
    }

    public function hapus($id)
    {
        return $this->db->delete($this->table, array('id_kota008' => (int) $id));
    }
}
