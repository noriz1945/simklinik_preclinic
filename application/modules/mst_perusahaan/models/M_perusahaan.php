<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_perusahaan extends CI_Model
{
    public function list_perusahaan()
    {
        return $this->db->order_by('name', 'ASC')->get('mst_company')->result();
    }

    public function list_jenis_perusahaan()
    {
        return $this->db->order_by('id_type', 'ASC')->get('mst_company_type')->result();
    }

    public function list_kategori_perusahaan()
    {
        return $this->db->order_by('id_jenis', 'ASC')->get('mst_company_cat')->result();
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

