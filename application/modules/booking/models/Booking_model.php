<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model
{
    public function get_dokters()
    {
        return $this->db->query("SELECT id_dokter, name AS nama_dokter FROM mst_dokter WHERE aktif=1 ORDER BY name")->result_array();
    }

    public function get_dokter_name($id_dokter)
    {
        $r = $this->db->query("SELECT name FROM mst_dokter WHERE id_dokter=?", [$id_dokter])->row_array();
        return $r ? $r['name'] : '';
    }

    public function get_cuti_in_range_by_doctor($id_dokter, $start, $end)
    {
        return $this->db->query(
            "SELECT tanggal_cuti, keterangan FROM mst_dokter_cuti WHERE id_dokter=? AND tanggal_cuti BETWEEN ? AND ? ORDER BY tanggal_cuti",
            [$id_dokter, $start, $end]
        )->result_array();
    }

    public function get_bookings_by_date_doctor($tanggal, $id_dokter)
    {
        return $this->db->query(
            "SELECT b.id, b.id_pasien, p.name AS nama_pasien, p.hp,
                    d.name AS nama_dokter,
                    COALESCE(b.jam_slot, b.slot) AS slot_time,
                    b.slot AS slot_idx,
                    COALESCE(b.jenis_perawatan,'') AS jenis_perawatan,
                    COALESCE(b.sudah_checkin,0) AS sudah_checkin,
                    b.tanggal,
                    b.id_dokter
             FROM trx_reg_book b
             LEFT JOIN mst_pasien p ON p.id_pasien = b.id_pasien
             LEFT JOIN mst_dokter d ON d.id_dokter = b.id_dokter
             WHERE b.id_dokter=? AND b.tanggal=?
             ORDER BY COALESCE(b.jam_slot, b.slot)",
            [$id_dokter, $tanggal]
        )->result_array();
    }

    public function search_patients($q, $limit=20)
    {
        $q = trim((string)$q);
        if ($q==='') return [];
        $like = '%'.$q.'%';
        $sql = "SELECT id_pasien, id_pasien AS no_rm, name, hp,
                       DATE_FORMAT(birthdate, '%d%m%Y') AS portal_id
                FROM mst_pasien
                WHERE id_pasien LIKE ? OR name LIKE ? OR hp LIKE ?
                ORDER BY id_pasien DESC
                LIMIT ".intval($limit);
        return $this->db->query($sql, [$like,$like,$like])->result_array();
    }

    public function get_patient_min($id_pasien)
    {
        $r = $this->db->query("SELECT id_pasien, name AS nama, hp FROM mst_pasien WHERE id_pasien=? LIMIT 1", [$id_pasien])->row_array();
        return $r ?: ['id_pasien'=>$id_pasien, 'nama'=>'', 'hp'=>''];
    }

    public function get_cancelled_bookings()
    {
        return $this->db->query(
            "SELECT c.*, p.name AS nama_pasien, d.name AS nama_dokter
             FROM trx_reg_book_cancel c
             LEFT JOIN mst_pasien p ON p.id_pasien = c.id_pasien
             LEFT JOIN mst_dokter d ON d.id_dokter = c.id_dokter
             ORDER BY c.cancel_date DESC"
        )->result_array();
    }

    // (removed) get_all_cuti_upcoming: no longer used within booking module

    public function get_booking_counts_in_range_by_doctor($id_dokter, $startDate, $endDate)
    {
        if (!$id_dokter || !$startDate || !$endDate) return [];
        $rows = $this->db->query(
            "SELECT tanggal, COUNT(*) AS c
             FROM trx_reg_book
             WHERE id_dokter=? AND tanggal BETWEEN ? AND ?
             GROUP BY tanggal",
            [$id_dokter, $startDate, $endDate]
        )->result_array();
        $map = [];
        foreach($rows as $r){ $map[$r['tanggal']] = (int)$r['c']; }
        return $map;
    }
}
?>
