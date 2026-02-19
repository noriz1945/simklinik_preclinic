<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_tindakan extends CI_Model
{
    public function list_tindakan()
    {
        // Adjust table name if necessary, assuming 'mst_action' based on 'id_act'
        return $this->db->select('a.*, b.name as grup, c.name as subgrup')
            ->from('mst_action a')
            ->join('mst_tindakan_grup b', 'a.id_group = b.id_group', 'left') // Assumption
            ->join('mst_tindakan_subgrup c', 'a.id_subgroup = c.id_subgroup', 'left') // Assumption
            ->order_by('a.name', 'ASC')
            ->get()->result();
    }

    public function get_tindakan($id)
    {
        return $this->db->where('id_act', $id)->get('mst_action')->row();
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
        return $this->db->insert('mst_action', $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id_act', $id)->update('mst_action', $data);
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
