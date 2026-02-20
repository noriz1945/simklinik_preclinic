<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_dokter extends CI_Model
{
    public function list_jenis_dokter()
    {
        return $this->db->order_by("name", "ASC")->get("mst_dokter_type")->result();
    }

    public function edit_jenis_dokter($id)
    {
        return $this->db->where("id_jenis", $id)->get("mst_dokter_type")->row();
    }

    public function list_spesialis_dokter()
    {
        return $this->db->order_by("name", "ASC")->get("mst_dokter_spec")->result();
    }

    public function edit_spesialis_dokter($id)
    {
        return $this->db->where("id_spes", $id)->get("mst_dokter_spec")->row();
    }

    public function list_subspesialis_dokter()
    {
        return $this->db->order_by("name", "ASC")->get("mst_dokter_subsp")->result();
    }

    public function edit_subspesialis_dokter($id)
    {
        return $this->db->where("id_subsp", $id)->get("mst_dokter_subsp")->row();
    }

    public function list_dokter()
    {
        return $this->db->order_by("name", "ASC")->get("mst_dokter")->result();
    }

    public function edit_dokter($id)
    {
        return $this->db->where("id_dokter", $id)->get("mst_dokter")->row();
    }

    public function cdk_dokter()
    {
        return $this->db->order_by("created", "DESC")->limit(1)->get("mst_dokter")->row();
    }

    // Helper generic methods from D_Mst
    public function ins1($data, $table)
    {
        return $this->db->insert($table, $data);
    }

    public function update_data($where, $data, $table)
    {
        return $this->db->where($where)->update($table, $data);
    }
}

