<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class v_pendapatan_obat extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('v_pendapatan_obat_model');

        // proteksi session
        if (!isset($this->session->userdata('sp')->username)) {
            redirect('auth');
        }
    }

    public function index()
    {
        /* ===============================
           FILTER RANGE TANGGAL
        =============================== */
        $tgl_awal  = $this->input->get('tgl_awal');
        $tgl_akhir = $this->input->get('tgl_akhir');
        
        if (empty($tgl_awal)) {
            $tgl_awal = date('Y-m-d');
        }
        if (empty($tgl_akhir)) {
            $tgl_akhir = date('Y-m-d');
        }
        
        $data['tgl_awal']  = $tgl_awal;
        $data['tgl_akhir'] = $tgl_akhir;


        /* ===============================
           DATA LAPORAN
        =============================== */
        $data['tgl_awal']  = $tgl_awal;
        $data['tgl_akhir'] = $tgl_akhir;
        $data['rows']      = $this->v_pendapatan_obat_model->get_detail($tgl_awal, $tgl_akhir);
        $data['total']     = $this->v_pendapatan_obat_model->get_total($tgl_awal, $tgl_akhir);

        /* ===============================
           VIEW
        =============================== */
        $this->load->view('v_pendapatan_obat', $data);
    }
    
    public function detail_obat()
{
    $tanggal = $this->input->post('tanggal', true);

    if (!$tanggal) {
        echo json_encode([
            'detail' => [],
            'grand_total' => 0
        ]);
        return;
    }

    $tgl_awal  = $tanggal.' 00:00:00';
    $tgl_akhir = $tanggal.' 23:59:59';

    /* ==========================
       DETAIL OBAT + INVOICE + PASIEN
    ========================== */
    $sql_detail = "
        SELECT
            a.id_inv,
            p.name AS nama_pasien,
            a.name AS nama_obat,
            a.qty,
    
            FORMAT(
                CASE
                    WHEN mf.id_group = 3
                         AND a.id_batch IS NOT NULL
                    THEN pb_batch.harga_jual
                    ELSE pb_obat.harga_jual
                END
            ,0) AS harga,
    
            FORMAT(a.subtotal,0) AS subtotal
    
        FROM soap_eresep_det a
        JOIN soap_eresep b 
            ON b.id_eresep = a.id_eresep
    
        /* =========================
           REGISTRASI → PASIEN
        ========================= */
        LEFT JOIN trx_reg r
            ON r.id_reg = b.id_reg
        LEFT JOIN mst_pasien p
            ON p.id_pasien = r.id_pasien
    
        /* =========================
           MASTER OBAT
        ========================= */
        LEFT JOIN mst_farmalkes mf
            ON mf.id_fa = a.id_trx_det
    
        /* =========================
           HARGA BY BATCH
        ========================= */
        LEFT JOIN trx_penerimaan_barang pb_batch
            ON pb_batch.id_batch = a.id_batch
    
        /* =========================
           HARGA BY ID OBAT (TERBARU)
        ========================= */
        LEFT JOIN (
            SELECT t1.id_obat, t1.harga_jual
            FROM trx_penerimaan_barang t1
            JOIN (
                SELECT id_obat, MAX(id) AS max_id
                FROM trx_penerimaan_barang
                GROUP BY id_obat
            ) t2 ON t1.id = t2.max_id
        ) pb_obat
            ON pb_obat.id_obat = a.id_trx_det
    
        WHERE a.id_inv IS NOT NULL
          AND b.eresepdate BETWEEN ? AND ?
          AND a.is_validasi = 1
          AND a.status = 0
          AND a.is_retur_obat = 0
    
        ORDER BY a.name ASC
    ";



    $detail = $this->db->query($sql_detail, [$tgl_awal,$tgl_akhir])->result();

    /* ==========================
       GRAND TOTAL (PASTI SAMA DENGAN LIST)
    ========================== */
    $sql_total = "
        SELECT SUM(a.subtotal) AS grand_total
        FROM soap_eresep_det a
        JOIN soap_eresep b ON b.id_eresep = a.id_eresep
        WHERE a.id_inv IS NOT NULL
          AND b.eresepdate BETWEEN ? AND ?
          AND a.is_validasi = 1
          AND a.status = 0
          AND a.is_retur_obat = 0
    ";

    $gt = $this->db->query($sql_total, [$tgl_awal,$tgl_akhir])->row();

    echo json_encode([
        'detail' => $detail,
        'grand_total' => (int)$gt->grand_total
    ]);
}


}
