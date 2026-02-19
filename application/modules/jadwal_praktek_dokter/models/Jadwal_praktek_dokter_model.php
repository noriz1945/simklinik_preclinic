<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_praktek_dokter_model extends CI_Model
{
    public function get_doctors_with_units()
    {
        // Fetch doctors with their specialization (mst_dokter_spec) via d.id_spes
        $sql = "SELECT d.id_dokter,
                       d.name AS nama_dokter,
                       s.id_spes,
                       s.name AS spesialisasi
                FROM mst_dokter d
                LEFT JOIN mst_dokter_spec s ON s.id_spes = d.id_spes
                WHERE d.aktif = 1
                ORDER BY s.name, d.name";
        return $this->db->query($sql)->result_array();
    }

    public function get_all_schedules()
    {
        $sql = "SELECT j.id_dokter, j.id_dow, j.time_start, j.time_end, j.durasi, j.quota_vaksin, j.quota_konsul,
                       j.kunci_slot_1, j.kunci_slot_2, j.kunci_slot_3
                FROM mst_dokter_jadwal_praktek j";
        return $this->db->query($sql)->result_array();
    }

    public function get_schedule($id_dokter, $id_dow)
    {
        return $this->db->query(
            "SELECT id_dokter, id_dow, time_start, time_end, durasi, quota_vaksin, quota_konsul,
                    kunci_slot_1, kunci_slot_2, kunci_slot_3
             FROM mst_dokter_jadwal_praktek
             WHERE id_dokter=? AND id_dow=? LIMIT 1",
            [$id_dokter, $id_dow]
        )->row_array();
    }

    public function upsert_schedule($id_dokter, $id_dow, $data)
    {
        $exists = $this->get_schedule($id_dokter, $id_dow);
        if ($exists) {
            $this->db->where('id_dokter', $id_dokter)->where('id_dow', $id_dow);
            return $this->db->update('mst_dokter_jadwal_praktek', $data);
        }
        $data['id_dokter'] = $id_dokter;
        $data['id_dow']    = $id_dow;
        return $this->db->insert('mst_dokter_jadwal_praktek', $data);
    }

    public function delete_schedule($id_dokter, $id_dow)
    {
        $this->db->where('id_dokter', $id_dokter)->where('id_dow', $id_dow);
        return $this->db->delete('mst_dokter_jadwal_praktek');
    }
}
?>
