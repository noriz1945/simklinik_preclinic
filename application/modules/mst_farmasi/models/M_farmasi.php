<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_farmasi extends CI_Model
{
    public function list_farmasi()
    {
        return $this->db->select('a.*, b.name as kategori, c.name as subkategori, d.name as golongan, e.name as unit')
            ->from('mst_farmalkes a')
            ->join('mst_farmalkes_cat b', 'a.id_kat = b.id_cat', 'left')
            ->join('mst_farmalkes_subcat c', 'a.id_subcat = c.id_subcat', 'left')
            ->join('mst_farmalkes_gol d', 'a.id_gol = d.id_gol', 'left')
            ->join('mst_item_unit e', 'a.id_satuan = e.id_satuan', 'left')
            ->order_by('a.name', 'ASC')
            ->get()->result();
    }

    public function edit_farmasi($id)
    {
        return $this->db->where('id_fa', $id)->get('mst_farmalkes')->row();
    }

    public function list_kategori()
    {
        return $this->db->order_by('name', 'ASC')->get('mst_farmalkes_cat')->result();
    }

    public function list_subkategori()
    {
        return $this->db->order_by('name', 'ASC')->get('mst_farmalkes_subcat')->result();
    }

    public function list_golongan()
    {
        return $this->db->order_by('name', 'ASC')->get('mst_farmalkes_gol')->result();
    }

    public function list_jenis()
    {
        return $this->db->order_by('name', 'ASC')->get('mst_farmalkes_type')->result();
    }

    public function list_satuan()
    {
        return $this->db->order_by('name', 'ASC')->get('mst_item_unit')->result();
    }

    public function list_group()
    {
        // Try mst_farmalkes_group first, fallback to mst_tindakan_grup if needed in controller
        if ($this->db->table_exists('mst_farmalkes_group')) {
            return $this->db->order_by('name', 'ASC')->get('mst_farmalkes_group')->result();
        } else if ($this->db->table_exists('mst_tindakan_grup')) {
            return $this->db->order_by('name', 'ASC')->get('mst_tindakan_grup')->result();
        }
        return [];
    }

    public function list_pabrik()
    {
        return $this->db->order_by('name', 'ASC')->get('mst_pabrik')->result();
    }

    public function list_supplier()
    {
        return $this->db->order_by('name', 'ASC')->get('mst_supplier')->result();
    }

    public function list_gudang()
    {
        return $this->db->order_by('name', 'ASC')->get('mst_warehouse')->result();
    }

    public function list_rak()
    {
        return $this->db->select('a.*, b.name as nama_gudang')
            ->from('mst_rak a')
            ->join('mst_warehouse b', 'a.id_wrh = b.id_wrh', 'left')
            ->order_by('a.name', 'ASC')
            ->get()->result();
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
