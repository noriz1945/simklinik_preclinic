<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_tindakan extends CI_Model
{
    public function list_tindakan()
    {
        // FIX: Menggunakan tabel mst_tindakan (bukan mst_action)
        return $this->db->select('a.*, b.name as grup, c.name as subgrup')
            ->from('mst_tindakan a')
            ->join('mst_tindakan_grup b', 'a.id_group = b.id_group', 'left')
            ->join('mst_tindakan_subgrup c', 'a.id_subgroup = c.id_subgroup', 'left')
            ->order_by('a.name', 'ASC')
            ->get()->result();
    }

    public function get_tindakan($id)
    {
        return $this->db->where('id_act', $id)->get('mst_tindakan')->row();
    }

    public function list_group()
    {
        return $this->db->order_by('name', 'ASC')->get('mst_tindakan_grup')->result();
    }

    public function list_subgroup()
    {
        return $this->db->order_by('name', 'ASC')->get('mst_tindakan_subgrup')->result();
    }

    public function insert($data)
    {
        return $this->db->insert('mst_tindakan', $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id_act', $id)->update('mst_tindakan', $data);
    }

    // Group Methods
    public function get_group($id)
    {
        return $this->db->where('id_group', $id)->get('mst_tindakan_grup')->row();
    }

    public function insert_group($data)
    {
        return $this->db->insert('mst_tindakan_grup', $data);
    }

    public function update_group($id, $data)
    {
        return $this->db->where('id_group', $id)->update('mst_tindakan_grup', $data);
    }
}