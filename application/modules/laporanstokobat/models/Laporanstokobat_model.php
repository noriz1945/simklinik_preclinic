<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporanstokobat_model extends CI_Model
{
    /** list gudang dari kartu stok */
    public function get_warehouse_list()
    {
        $sql = "SELECT DISTINCT IFNULL(NULLIF(TRIM(id_wrh),''),'') AS id_wrh
                FROM gdf_kartu_stok
                ORDER BY id_wrh";
        $q = $this->db->query($sql);
        return $q->result();
    }

    private function build_where($filters, &$params)
    {
        $where = [];
 
        // q match (id_fa atau nama)
        if (!empty($filters['q'])) {
            $where[] = "(fa.id_fa LIKE ? OR fa.name LIKE ?)";
            $params[] = '%'.$filters['q'].'%';
            $params[] = '%'.$filters['q'].'%';
        }

        // wrh
        if (isset($filters['wrh']) && $filters['wrh'] !== '') {
            $where[] = "IFNULL(NULLIF(TRIM(x.id_wrh),''),'') = ?";
            $params[] = $filters['wrh'];
        }

        // min / max stok
        if ($filters['min'] !== null) {
            $where[] = "IFNULL(x.saldo,0) >= ?";
            $params[] = (int)$filters['min'];
        }
        if ($filters['max'] !== null) {
            $where[] = "IFNULL(x.saldo,0) <= ?";
            $params[] = (int)$filters['max'];
        }

        return $where ? ('WHERE '.implode(' AND ', $where)) : '';
    }

    private function build_dt_filter($filters, &$params)
    {
        $w = [];
        if (!empty($filters['from'])) {
            $w[] = "ks.datetime >= ?";
            $params[] = $filters['from'].' 00:00:00';
        }
        if (!empty($filters['to'])) {
            $w[] = "ks.datetime <= ?";
            $params[] = $filters['to'].' 23:59:59';
        }
        return $w ? ('WHERE '.implode(' AND ', $w)) : '';
    }

    /**
     * Ambil stok terakhir (saldo terakhir) per item per gudang.
     * Jika gudang kosong, dianggap '' (empty string).
     */
    private function base_sql($filters, $for_count = false)
    {
        $params_dt = [];
        $dtWhere = $this->build_dt_filter($filters, $params_dt);

        // subquery ambil max datetime per id_fa + wrh
        $sub = "
            SELECT
                IFNULL(NULLIF(TRIM(ks.id_wrh),''),'') AS id_wrh,
                ks.id_fa,
                MAX(ks.datetime) AS maxdt
            FROM gdf_kartu_stok ks
            $dtWhere
            GROUP BY IFNULL(NULLIF(TRIM(ks.id_wrh),''),''), ks.id_fa
        ";

        $sql = "
            SELECT
                fa.id_fa,
                fa.name,
                fa.sale_price,
                x.id_wrh,
                x.saldo AS stok,
                x.datetime AS last_datetime
            FROM mst_farmalkes fa
            LEFT JOIN (
                SELECT
                    s.id_wrh,
                    ks1.id_fa,
                    ks1.saldo,
                    ks1.datetime
                FROM ($sub) s
                JOIN gdf_kartu_stok ks1
                  ON IFNULL(NULLIF(TRIM(ks1.id_wrh),''),'') = s.id_wrh
                 AND ks1.id_fa = s.id_fa
                 AND ks1.datetime = s.maxdt
            ) x ON x.id_fa = fa.id_fa
        ";

        $params = $params_dt; // params buat subquery dtWhere

        $where = $this->build_where($filters, $params);

        // kalau for_count: bungkus
        if ($for_count) {
            $sql = "SELECT COUNT(1) AS cnt FROM ($sql $where) z";
        } else {
            $sql = "$sql $where";
        }

        return [$sql, $params];
    }

    public function count_rows($filters)
    {
        [$sql, $params] = $this->base_sql($filters, true);
        $q = $this->db->query($sql, $params);
        return (int)($q->row()->cnt ?? 0);
    }

    public function get_rows($filters, $limit = 50, $offset = 0)
    {
        [$sql, $params] = $this->base_sql($filters, false);

        $sql .= " ORDER BY fa.name ASC LIMIT ? OFFSET ?";
        $params[] = (int)$limit;
        $params[] = (int)$offset;

        $q = $this->db->query($sql, $params);
        return $q->result();
    }
}
