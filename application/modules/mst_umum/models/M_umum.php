<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_umum extends CI_Model
{
    public function list_kelas()
    {
        return $this->db->order_by('name', 'ASC')->get('mst_kelas')->result();
    }

    public function list_group()
    {
        return $this->db->get('mst_group')->result();
    }

    public function list_markup()
    {
        return $this->db->where('id', 1)->get('mst_markup_harga')->result();
    }

    public function ins1($data, $table)
    {
        return $this->db->insert($table, $data);
    }

    public function update_data($where, $data, $table)
    {
        return $this->db->where($where)->update($table, $data);
    }
}

