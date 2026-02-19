<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class v_pendapatan_obat_model extends CI_Model {

    /* =====================================================
       DETAIL PENDAPATAN OBAT PER HARI
    ===================================================== */
    public function get_detail($tgl_awal, $tgl_akhir)
{
    $sql = "
        SELECT
            DATE(b.eresepdate) AS tanggal,

            /* ===============================
               TOTAL PENDAPATAN
            =============================== */
            SUM(a.subtotal) AS total_harian,

            /* ===============================
               TOTAL INVOICE
            =============================== */
            COUNT(DISTINCT a.id_inv) AS total_invoice,

            /* ===============================
               JUMLAH JENIS OBAT KELUAR
               (GROUP BY id_obat)
            =============================== */
            COUNT(DISTINCT a.id_trx_det) AS total_item

        FROM soap_eresep_det a
        JOIN soap_eresep b ON b.id_eresep = a.id_eresep

        WHERE a.id_inv IS NOT NULL
          AND b.eresepdate BETWEEN ? AND ?
          AND a.is_validasi = 1
          AND a.status = 0
          AND a.is_retur_obat = 0

        GROUP BY DATE(b.eresepdate)
        ORDER BY tanggal ASC
    ";

    return $this->db->query($sql, array(
        $tgl_awal.' 00:00:00',
        $tgl_akhir.' 23:59:59'
    ))->result();
}


    /* =====================================================
       TOTAL PENDAPATAN OBAT
    ===================================================== */
    public function get_total($tgl_awal, $tgl_akhir)
{
    $sql = "
        SELECT SUM(a.subtotal) AS total
        FROM soap_eresep_det a
        JOIN soap_eresep b ON b.id_eresep = a.id_eresep
        WHERE a.id_inv IS NOT NULL
          AND b.eresepdate BETWEEN ? AND ?
          AND a.is_validasi = 1
          AND a.status = 0
          AND a.is_retur_obat = 0
    ";

    $row = $this->db->query($sql, array(
        $tgl_awal.' 00:00:00',
        $tgl_akhir.' 23:59:59'
    ))->row();

    return $row ? (int)$row->total : 0;
}

}
