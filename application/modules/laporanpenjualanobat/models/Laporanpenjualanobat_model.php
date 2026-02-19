<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporanpenjualanobat_model extends CI_Model
{
    private function build_where($filters, &$params)
    {
        $where = [];

        // rules wajib
        $where[] = "d.id_inv IS NOT NULL";
        $where[] = "d.id_inv <> ''";
        $where[] = "IFNULL(d.status,0) = 0";

        // date
        if (!empty($filters['from'])) {
            $where[] = "h.eresepdate >= ?";
            $params[] = $filters['from'].' 00:00:00';
        }
        if (!empty($filters['to'])) {
            $where[] = "h.eresepdate <= ?";
            $params[] = $filters['to'].' 23:59:59';
        }

        // inv
        if (!empty($filters['inv'])) {
            $where[] = "d.id_inv LIKE ?";
            $params[] = '%'.$filters['inv'].'%';
        }

        // q (obat)
        if (!empty($filters['q'])) {
            $where[] = "(d.id_trx_det LIKE ? OR d.name LIKE ?)";
            $params[] = '%'.$filters['q'].'%';
            $params[] = '%'.$filters['q'].'%';
        }

        return $where ? ('WHERE '.implode(' AND ', $where)) : '';
    }

    private function base_sql($filters)
    {
        $sql = "
            SELECT
                h.id_eresep,
                h.eresepdate,
                h.id_reg,
                h.id_dokter,
                d.id_eresep_det,
                d.id_trx_det,
                d.name,
                d.jenis_obat,
                d.qty,
                CAST(NULLIF(TRIM(d.qty), '') AS DECIMAL(18,2)) AS qty_num,
                d.harga_satuan,
                d.subtotal,
                d.tuslah,
                d.jasa_racik,
                d.is_racikan,
                d.id_inv,
                d.created,
                d.created_by
            FROM soap_eresep_det d
            JOIN soap_eresep h ON h.id_eresep = d.id_eresep
        ";

        $params = [];
        $where = $this->build_where($filters, $params);
        $sql = "$sql $where";
        return [$sql, $params];
    }

    public function count_rows($filters)
    {
        [$sql, $params] = $this->base_sql($filters);
        $sql = "SELECT COUNT(1) AS cnt FROM ($sql) z";
        $q = $this->db->query($sql, $params);
        return (int)($q->row()->cnt ?? 0);
    }

    public function get_rows($filters, $limit = 50, $offset = 0)
    {
        [$sql, $params] = $this->base_sql($filters);
        $sql .= " ORDER BY h.eresepdate DESC, d.id_eresep_det DESC LIMIT ? OFFSET ?";
        $params[] = (int)$limit;
        $params[] = (int)$offset;

        $q = $this->db->query($sql, $params);
        return $q->result();
    }

    public function get_summary($filters)
    {
        $params = [];
        $where = $this->build_where($filters, $params);
        $sql = "
            SELECT
                COUNT(1) AS total_rows,
                COUNT(DISTINCT d.id_inv) AS total_invoice,
                SUM(CAST(NULLIF(TRIM(d.qty), '') AS DECIMAL(18,2))) AS total_qty,
                SUM(IFNULL(d.subtotal,0)) AS total_subtotal,
                SUM(IFNULL(d.tuslah,0)) AS total_tuslah,
                SUM(IFNULL(d.jasa_racik,0)) AS total_jasa_racik,
                SUM(IFNULL(d.subtotal,0) + IFNULL(d.tuslah,0) + IFNULL(d.jasa_racik,0)) AS grand_total
            FROM soap_eresep_det d
            JOIN soap_eresep h ON h.id_eresep = d.id_eresep
            $where
        ";
        $q = $this->db->query($sql, $params);
        return $q->row();
    }
}
