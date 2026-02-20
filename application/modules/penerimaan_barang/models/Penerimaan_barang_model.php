<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Penerimaan_barang_model extends CI_Model
{
    private $tbl = 'trx_penerimaan_barang';

    /** ===== distinct so_date ===== */
    public function get_so_dates($limit = 365)
    {
        $this->db->reset_query();
        $this->db->select('so_date');
        $this->db->from($this->tbl);
        $this->db->where('so_date IS NOT NULL', null, false);
        $this->db->group_by('so_date');
        $this->db->order_by('so_date', 'DESC');
        $this->db->limit((int)$limit);
        $q = $this->db->get()->result_array();

        $out = [];
        foreach ($q as $r) {
            $d = $r['so_date'];
            $out[] = ['id'=>$d, 'text'=>$d];
        }
        return $out;
    }

    /** ===== items by so_date (for modal info) ===== */
    public function get_items_by_so_date($so_date)
    {
        $this->db->reset_query();
        $this->db->select('t.id, t.id_batch, t.id_obat, f.name AS nama_obat, t.harga_dasar, t.harga_jual, t.stok_masuk, t.so_date, t.created_at');
        $this->db->from($this->tbl.' t');
        $this->db->join('mst_farmalkes f', 'f.id_fa = t.id_obat', 'left');
        $this->db->where('t.so_date', $so_date);
        $this->db->order_by('t.id', 'ASC');
        return $this->db->get()->result_array();
    }

    private function batch_prefix($dateYmd)
    {
        $ts = strtotime($dateYmd ?: date('Y-m-d'));
        return 'A'.date('m', $ts).date('y', $ts);
    }

    public function peek_next_batch_no($so_date)
    {
        $prefix = $this->batch_prefix($so_date);

        $this->db->reset_query();
        $row = $this->db->select('MAX(id_batch) AS max_batch')
            ->from($this->tbl)
            ->like('id_batch', $prefix, 'after')
            ->get()->row_array();

        $max = $row['max_batch'] ?? null;
        $last = 0;
        if ($max && strpos($max, $prefix) === 0) {
            $suffix = substr($max, strlen($prefix));
            if (ctype_digit($suffix)) $last = (int)$suffix;
        }
        return $last + 1;
    }

    private function lock_and_get_last_no($prefix)
    {
        $sql = "SELECT MAX(id_batch) AS max_batch
                FROM {$this->tbl}
                WHERE id_batch LIKE ?
                FOR UPDATE";
        $q = $this->db->query($sql, [$prefix.'%']);
        $row = $q->row_array();

        $max = $row['max_batch'] ?? null;
        $last = 0;
        if ($max && strpos($max, $prefix) === 0) {
            $suffix = substr($max, strlen($prefix));
            if (ctype_digit($suffix)) $last = (int)$suffix;
        }
        return $last;
    }

    private function make_batch($prefix, $no)
    {
        return $prefix . str_pad((string)$no, 5, '0', STR_PAD_LEFT);
    }

    public function dt_list($start, $length, $search, array $filters = [])
    {
        $total = $this->db->count_all($this->tbl);

        $this->db->reset_query();
        $this->db->from($this->tbl.' t');
        $this->db->join('mst_farmalkes f', 'f.id_fa = t.id_obat', 'left');

        if ($search !== '') {
            $this->db->group_start()
                ->like('t.id_batch', $search)
                ->or_like('f.name', $search)
                ->or_like('t.id_obat', $search)
            ->group_end();
        }
        if (!empty($filters['id_batch'])) $this->db->like('t.id_batch', $filters['id_batch']);
        if (!empty($filters['obat']))     $this->db->like('f.name', $filters['obat']);
        if (!empty($filters['so_date']))  $this->db->where('t.so_date', $filters['so_date']);

        $filtered = $this->db->count_all_results();

                $this->db->reset_query();
        $this->db->select('t.*, f.name AS nama_obat, COALESCE(ks.saldo, 0) AS sisa_stok', false);
        $this->db->from($this->tbl.' t');
        $this->db->join('mst_farmalkes f', 'f.id_fa = t.id_obat', 'left');

        // ✅ sisa stok: ambil saldo terakhir dari gdf_kartu_stok per id_fa (id_obat)
        // Catatan: id_wrh di kartu stok pada data dump sering kosong/null, jadi dihitung global per id_fa.
        $this->db->join('(SELECT id_fa, MAX(id) AS max_id FROM gdf_kartu_stok GROUP BY id_fa) kmax', 'kmax.id_fa = t.id_obat', 'left', false);
        $this->db->join('gdf_kartu_stok ks', 'ks.id = kmax.max_id', 'left');

if ($search !== '') {
            $this->db->group_start()
                ->like('t.id_batch', $search)
                ->or_like('f.name', $search)
                ->or_like('t.id_obat', $search)
            ->group_end();
        }
        if (!empty($filters['id_batch'])) $this->db->like('t.id_batch', $filters['id_batch']);
        if (!empty($filters['obat']))     $this->db->like('f.name', $filters['obat']);
        if (!empty($filters['so_date']))  $this->db->where('t.so_date', $filters['so_date']);

        $this->db->order_by('t.id', 'DESC');
        $this->db->limit($length, $start);
        $q = $this->db->get();

        $rows = [];
        foreach ($q->result_array() as $r) {
                        $rows[] = [
                $r['id'],
                $r['id_batch'],
                $r['nama_obat'],
                number_format((float)$r['harga_dasar'], 0, ',', '.'),
                number_format((float)$r['harga_jual'], 0, ',', '.'),
                (int)$r['stok_masuk'],
                (int)($r['sisa_stok'] ?? 0), // ✅ sisa stok dari gdf_kartu_stok (saldo terakhir)
                $r['so_date'],
                $r['created_at'],
                $r['id'],
            ];
        }

        return ['total'=>(int)$total,'filtered'=>(int)$filtered,'rows'=>$rows];
    }

    /** =========================
     *  ✅ PATCH SUPPORT: grup obat
     *  ========================= */

    private function _detect_grup_name_field()
    {
        static $cached = null;
        if ($cached !== null) return $cached;

        $cached = 'name';
        try {
            $fields = $this->db->field_data('mst_farmalkes_grup');
            $names = [];
            foreach ($fields as $f) $names[] = $f->name;

            $candidates = ['name','nama','nama_grup','nama_group','group_name','grup'];
            foreach ($candidates as $c) {
                if (in_array($c, $names, true)) { $cached = $c; break; }
            }
        } catch (\Throwable $e) {}
        return $cached;
    }

    private function _get_grup_map()
    {
        static $map = null;
        if ($map !== null) return $map;

        $map = [];
        $nameField = $this->_detect_grup_name_field();

        try {
            $this->db->reset_query();
            $q = $this->db->select("id_group, {$nameField} AS nm", false)
                ->from('mst_farmalkes_grup')
                ->get()->result_array();

            foreach ($q as $r) {
                $idg = $r['id_group'] ?? null;
                if ($idg === null) continue;
                $map[(string)$idg] = (string)($r['nm'] ?? '');
            }
        } catch (\Throwable $e) {}
        return $map;
    }

    public function search_obat($q, $so_date = '')
    {
        $q = trim((string)$q);
        $so_date = trim((string)$so_date);

        $sql = "SELECT f.id_fa, f.name, f.hna1, f.sale_price, f.id_group
                FROM mst_farmalkes f
                WHERE 1=1";
        $params = [];

        if ($q !== '') {
            $sql .= " AND (f.name LIKE ? OR f.id_fa LIKE ?)";
            $params[] = "%{$q}%";
            $params[] = "%{$q}%";
        }

        if ($so_date !== '') {
            $sql .= " AND NOT EXISTS (
                        SELECT 1
                        FROM {$this->tbl} t
                        WHERE t.so_date = ?
                          AND t.id_obat = f.id_fa
                      )";
            $params[] = $so_date;
        }

        $sql .= " ORDER BY f.id_group ASC, f.name ASC LIMIT 200";
        $rows = $this->db->query($sql, $params)->result_array();

        $gmap = $this->_get_grup_map();
        foreach ($rows as &$r) {
            $idg = isset($r['id_group']) ? (string)$r['id_group'] : '';
            $r['group_name'] = ($idg !== '' && isset($gmap[$idg])) ? $gmap[$idg] : 'Lainnya';

            // ✅ pastikan id_fa jadi string (leading zero aman)
            $r['id_fa'] = (string)($r['id_fa'] ?? '');
        }
        unset($r);

        return $rows;
    }

    /** =========================
     *  ✅ PATCH: Sync harga master dari penerimaan TERAKHIR
     *  ========================= */
    private function _sync_master_price_from_last_penerimaan($id_obat)
    {
        $id_obat = trim((string)$id_obat);
        if ($id_obat === '') return false;

        $this->db->reset_query();
        $last = $this->db->select('harga_dasar, harga_jual')
            ->from($this->tbl)
            ->where('id_obat', $id_obat)
            ->order_by('created_at', 'DESC')
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get()->row_array();

        if (!$last) return false;

        $hd = (float)($last['harga_dasar'] ?? 0);
        $hj = (float)($last['harga_jual'] ?? 0);

        $this->db->reset_query();
        $this->db->where('id_fa', $id_obat);
        $this->db->update('mst_farmalkes', [
            'hna1'       => $hd,
            'sale_price' => $hj,
        ]);

        return ($this->db->affected_rows() >= 0);
    }

    public function save_bulk($so_date, array $items, $actor='system')
    {
        if (!$so_date) return ['ok'=>false,'msg'=>'SO Date wajib diisi.'];
        if (count($items) < 1) return ['ok'=>false,'msg'=>'Item kosong.'];

        $clean = [];
        $seen = [];
        $errors = [];

        foreach ($items as $idx => $it) {
            $id_obat = trim((string)($it['id_obat'] ?? ''));
            if ($id_obat === '') continue;

            // ✅ harus numerik tapi boleh leading zero
            if (!preg_match('/^\d+$/', $id_obat)) {
                $errors[] = "Item #".($idx+1)." (ID obat {$id_obat}) format invalid.";
                continue;
            }

            if (isset($seen[$id_obat])) continue;
            $seen[$id_obat] = 1;

            $hd = (float)($it['harga_dasar'] ?? 0);
            $hj = (float)($it['harga_jual'] ?? 0);
            $st = (int)($it['stok_masuk'] ?? 0);

            if ($hd <= 0 || $hj <= 0 || $st <= 0) {
                $errors[] = "Item #".($idx+1)." (ID obat {$id_obat}) wajib > 0.";
                continue;
            }

            $clean[] = ['id_obat'=>$id_obat,'harga_dasar'=>$hd,'harga_jual'=>$hj,'stok_masuk'=>$st];
        }

        if (count($errors) > 0) return ['ok'=>false,'msg'=>"Validasi gagal:\n- ".implode("\n- ", $errors)];
        if (count($clean) < 1) return ['ok'=>false,'msg'=>'Tidak ada item valid.'];

        $this->db->trans_begin();
        try {
            $now = date('Y-m-d H:i:s');
            $prefix = $this->batch_prefix($so_date);

            $lastNo = $this->lock_and_get_last_no($prefix);
            $nextNo = $lastNo + 1;

            $inserted = 0;
            $generated_batches = [];
            $skipped = 0;

            foreach ($clean as $it) {
                $this->db->reset_query();
                $exists = $this->db->select('id')->from($this->tbl)
                    ->where('so_date', $so_date)->where('id_obat', $it['id_obat'])
                    ->limit(1)->get()->row_array();
                if ($exists) { $skipped++; continue; }

                $batch = $this->make_batch($prefix, $nextNo);
                $nextNo++;

                $ins = [
                    'id_batch'    => $batch,
                    'id_obat'     => $it['id_obat'], // ✅ string apa adanya
                    'harga_dasar' => $it['harga_dasar'],
                    'harga_jual'  => $it['harga_jual'],
                    'stok_masuk'  => $it['stok_masuk'],
                    'so_date'     => $so_date,
                    'created_at'  => $now,
                    'created_by'  => $actor,
                ];

                $this->db->reset_query();
                $this->db->insert($this->tbl, $ins);

                if ($this->db->affected_rows() > 0) {
                    $inserted++;
                    $generated_batches[] = $batch;

                    $okSync = $this->_sync_master_price_from_last_penerimaan($it['id_obat']);
                    if (!$okSync) {
                        throw new \Exception('Gagal sync harga master untuk ID obat: '.$it['id_obat']);
                    }
                }
            }

            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                return ['ok'=>false,'msg'=>'Gagal simpan (DB error).'];
            }

            $this->db->trans_commit();

            if ($inserted < 1) {
                return ['ok'=>false,'msg'=>'Tidak ada yang tersimpan (semua sudah ada pada SO Date tsb).'];
            }

            return [
                'ok'=>true,
                'msg'=>"Berhasil simpan {$inserted} item. Skip: {$skipped}. (Harga master auto update mengikuti penerimaan terakhir)",
                'inserted'=>$inserted,
                'skipped'=>$skipped,
                'batches'=>$generated_batches,
            ];

        } catch (\Throwable $e) {
            $this->db->trans_rollback();
            return ['ok'=>false,'msg'=>'Exception: '.$e->getMessage()];
        }
    }

    public function delete_row($id)
    {
        $id = (int)$id;
        $this->db->reset_query();
        $row = $this->db->get_where($this->tbl, ['id'=>$id])->row_array();
        if (!$row) return ['ok'=>false,'msg'=>'Data tidak ditemukan.'];

        $this->db->reset_query();
        $this->db->where('id',$id)->delete($this->tbl);
        return ['ok'=>true,'msg'=>'Terhapus.'];
    }

    /** =========================
     *  SOH (Stok Aktif)
     *  ========================= */

    public function get_soh_list($q = '', $limit = 200)
    {
        $q = trim((string)$q);

        $subIn = "SELECT id_obat, SUM(stok_masuk) AS qty_in
                  FROM {$this->tbl}
                  GROUP BY id_obat";

        $subOut = "SELECT 
                      id_trx_det AS id_obat,
                      SUM(qty) AS qty_out,
                      MAX(created) AS last_sell
                   FROM soap_eresep_det
                   WHERE is_validasi = 1
                     AND id_inv IS NOT NULL
                     AND is_retur = 0
                   GROUP BY id_trx_det";

        $sql = "SELECT
                    f.id_fa AS id_obat,
                    f.name  AS nama_obat,
                    COALESCE(i.qty_in, 0) AS qty_in,
                    COALESCE(o.qty_out, 0) AS qty_out,
                    (COALESCE(i.qty_in, 0) - COALESCE(o.qty_out, 0)) AS stok_aktif,
                    f.tipe_obat
                FROM mst_farmalkes f
                LEFT JOIN ({$subIn}) i ON i.id_obat = f.id_fa
                LEFT JOIN ({$subOut}) o ON o.id_obat = f.id_fa
                WHERE 1=1";

        $params = [];
        if ($q !== '') {
            $sql .= " AND (f.name LIKE ? OR f.id_fa LIKE ?)";
            $params[] = "%{$q}%";
            $params[] = "%{$q}%";
        }

        $sql .= " ORDER BY f.name ASC LIMIT ".((int)$limit);

        $rows = $this->db->query($sql, $params)->result_array();

        foreach ($rows as &$r) {
            $r['tipe_text'] = ((int)$r['tipe_obat'] === 1) ? 'multidose' : 'habis pakai';
            $r['stok_aktif'] = (int)$r['stok_aktif'];
            $r['id_obat'] = (string)($r['id_obat'] ?? '');
        }
        unset($r);

        return $rows;
    }

    public function get_soh_detail($id_obat)
    {
        $id_obat = trim((string)$id_obat);

        $this->db->reset_query();
        $ob = $this->db->select('id_fa, name, tipe_obat')
            ->from('mst_farmalkes')
            ->where('id_fa', $id_obat)
            ->limit(1)->get()->row_array();

        if (!$ob) {
            return ['ok'=>false,'msg'=>'Obat tidak ditemukan'];
        }

        $this->db->reset_query();
        $lastIn = $this->db->select('id_batch, stok_masuk, so_date, created_at')
            ->from($this->tbl)
            ->where('id_obat', $id_obat)
            ->order_by('created_at', 'DESC')
            ->order_by('id', 'DESC')
            ->limit(1)->get()->row_array();

        $this->db->reset_query();
        $sell = $this->db->select('SUM(qty) AS qty_out, MAX(created) AS last_sell')
            ->from('soap_eresep_det')
            ->where('id_trx_det', $id_obat)
            ->where('is_validasi', 1)
            ->where('id_inv IS NOT NULL', null, false)
            ->where('is_retur', 0)
            ->get()->row_array();

        $qtyOut = isset($sell['qty_out']) ? (int)$sell['qty_out'] : 0;
        $lastSell = $sell['last_sell'] ?? null;

        return [
            'ok' => true,
            'obat' => [
                'id_obat' => (string)$ob['id_fa'],
                'nama'    => $ob['name'],
                'tipe'    => ((int)$ob['tipe_obat'] === 1) ? 'multidose' : 'habis pakai',
            ],
            'barang_datang' => [
                'id_batch'   => $lastIn['id_batch'] ?? null,
                'qty'        => isset($lastIn['stok_masuk']) ? (int)$lastIn['stok_masuk'] : 0,
                'so_date'    => $lastIn['so_date'] ?? null,
                'created_at' => $lastIn['created_at'] ?? null,
            ],
            'penjualan' => [
                'qty'        => $qtyOut,
                'last_sell'  => $lastSell,
            ],
        ];
    }
}
