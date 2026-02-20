<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokter_cuti_model extends CI_Model
{
    public function get_dokters()
    {
        return $this->db->query("SELECT id_dokter, name FROM mst_dokter WHERE aktif=1 ORDER BY name")->result_array();
    }

    public function get_cuti_in_range($start, $end)
    {
        $sql = "SELECT c.id_cuti, c.tanggal_cuti, c.id_dokter, d.name AS nama_dokter, c.keterangan
                FROM mst_dokter_cuti c
                LEFT JOIN mst_dokter d ON d.id_dokter = c.id_dokter
                WHERE c.tanggal_cuti BETWEEN ? AND ?
                ORDER BY c.tanggal_cuti, d.name";
        return $this->db->query($sql, [$start, $end])->result_array();
    }

    public function get_cuti_by_date($tanggal)
    {
        return $this->db->query(
            "SELECT c.id_cuti, c.tanggal_cuti, c.id_dokter, d.name AS nama_dokter, c.keterangan
             FROM mst_dokter_cuti c
             LEFT JOIN mst_dokter d ON d.id_dokter = c.id_dokter
             WHERE c.tanggal_cuti=? ORDER BY d.name",
            [$tanggal]
        )->result_array();
    }

    public function insert_cuti($data)
    {
        return $this->db->insert('mst_dokter_cuti', $data);
    }

    public function delete_cuti($id)
    {
        $this->db->where('id_cuti', $id);
        return $this->db->delete('mst_dokter_cuti');
    }

    public function delete_cuti_pair($tanggal, $id_dokter)
    {
        $this->db->where('tanggal_cuti', $tanggal)->where('id_dokter', $id_dokter);
        return $this->db->delete('mst_dokter_cuti');
    }

    public function insert_cuti_range($start, $end, $id_dokter, $keterangan)
    {
        $rows = [];
        for ($d=strtotime($start); $d<=strtotime($end); $d+=86400) {
            $rows[] = [
                'tanggal_cuti' => date('Y-m-d', $d),
                'id_dokter'    => $id_dokter,
                'keterangan'   => $keterangan,
            ];
        }
        if (!$rows) return false;
        return $this->db->insert_batch('mst_dokter_cuti', $rows) !== false;
    }
}
?>
