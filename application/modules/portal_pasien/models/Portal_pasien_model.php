<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portal_pasien_model extends CI_Model
{
    private $phone_field = 'hp';

    /* ===== AUTH / PIN ===== */

    public function auth_by_hp_pin($hp, $pin)
    {
        $sql = "SELECT
                    id_pasien,                   -- sudah 8 digit dengan zero di depan
                    id_pasien AS no_rm,
                    name AS nama_pasien,
                    {$this->phone_field} AS hp
                FROM mst_pasien
                WHERE {$this->phone_field} = ? AND pin = ?
                LIMIT 1";
        return $this->db->query($sql, [$hp, $pin])->row_array();
    }

    public function auth_by_portal_id_pin($portal_id, $pin)
    {
        // portal_id = DATE_FORMAT(birthdate, '%d%m%Y')
        $sql = "SELECT
                    id_pasien,
                    id_pasien AS no_rm,
                    name AS nama_pasien,
                    {$this->phone_field} AS hp
                FROM mst_pasien
                WHERE DATE_FORMAT(birthdate, '%d%m%Y') = ? AND pin = ?
                LIMIT 1";
        return $this->db->query($sql, [$portal_id, $pin])->row_array();
    }

    public function update_pin($id_pasien_with_zeros, $pin)
    {
        $this->db->where('id_pasien', $id_pasien_with_zeros);
        return $this->db->update('mst_pasien', ['pin'=>$pin]);
    }

    public function get_pin_by_id($id_pasien_with_zeros)
    {
        return $this->db->query(
            "SELECT pin FROM mst_pasien WHERE id_pasien=? LIMIT 1",
            [$id_pasien_with_zeros]
        )->row_array();
    }

    public function get_portal_info_by_id($id_pasien_with_zeros)
    {
        return $this->db->query(
            "SELECT pin, {$this->phone_field} AS hp, DATE_FORMAT(birthdate, '%d%m%Y') AS portal_id
             FROM mst_pasien WHERE id_pasien=? LIMIT 1",
            [$id_pasien_with_zeros]
        )->row_array();
    }

    /* ===== MASTER ===== */

    // Spesialisasi dokter (menggantikan 'unit' untuk portal pasien booking)
    public function get_spes()
    {
        return $this->db->query("SELECT id_spes, name FROM mst_dokter_spec WHERE aktif=1 ORDER BY name")->result_array();
    }

    public function get_dokters()
    {
        return $this->db->query("SELECT id_dokter, name AS nama_dokter FROM mst_dokter WHERE aktif=1 ORDER BY name")->result_array();
    }

    public function get_dokters_by_spes($id_spes)
    {
        if (!$id_spes) return [];
        return $this->db->query(
            "SELECT id_dokter, name AS nama_dokter FROM mst_dokter WHERE aktif=1 AND id_spes=? ORDER BY name",
            [$id_spes]
        )->result_array();
    }

    /* ===== MASTER WILAYAH (untuk pendaftaran pasien baru) ===== */
    public function get_propinsis()
    {
        return $this->db->query("SELECT id_propinsi, name FROM mst_propinsi ORDER BY name")->result_array();
    }

    public function get_kota_by_propinsi($id_propinsi)
    {
        return $this->db->query("SELECT id_kota, name FROM mst_kota WHERE id_propinsi=? ORDER BY name", [$id_propinsi])->result_array();
    }

    public function get_kecamatan_by_kota($id_kota)
    {
        return $this->db->query("SELECT id_kecamatan, name FROM mst_kecamatan WHERE id_kota=? ORDER BY name", [$id_kota])->result_array();
    }

    public function get_kelurahan_by_kecamatan($id_kecamatan)
    {
        return $this->db->query("SELECT id_kelurahan, name FROM mst_kelurahan WHERE id_kecamatan=? ORDER BY name", [$id_kecamatan])->result_array();
    }

    /* ===== Pendaftaran Pasien Baru ===== */
    public function find_patient_by_name_birthdate($nama, $birthdate)
    {
        if(!$nama || !$birthdate) return null;
        $sql = "SELECT 
                    id_pasien,
                    name,
                    birthdate,
                    birthplace,
                    gender,
                    {$this->phone_field} AS hp,
                    pin,
                    address,
                    id_propinsi,id_kota,id_kecamatan,id_kelurahan
                FROM mst_pasien
                WHERE UPPER(TRIM(name)) = UPPER(TRIM(?)) 
                  AND birthdate = ? 
                  AND is_rm_aps = 0
                LIMIT 1";
        return $this->db->query($sql, [$nama, $birthdate])->row_array();
    }

    public function insert_pasien($data)
    {
        return $this->db->insert('mst_pasien', $data);
    }

    public function get_unit_name($id_unit)
    {
        $r = $this->db->query("SELECT name FROM mst_unit WHERE id_unit=?", [$id_unit])->row_array();
        return $r ? $r['name'] : '';
    }

    public function get_dokter_name($id_dokter)
    {
        $r = $this->db->query("SELECT name FROM mst_dokter WHERE id_dokter=?", [$id_dokter])->row_array();
        return $r ? $r['name'] : '';
    }

    public function get_spes_name($id_spes)
    {
        $r = $this->db->query("SELECT name FROM mst_dokter_spec WHERE id_spes=?", [$id_spes])->row_array();
        return $r ? $r['name'] : '';
    }

    /* ===== SLOT & KUOTA (time_start/time_end/durasi) ===== */

    public function get_slots($tanggal, $id_unit, $id_dokter)
    {
        if (!$tanggal || !$id_dokter) return [];
        $dow = (int)date('N', strtotime($tanggal)); // 1..7

        $jadwal = $this->db->query("
            SELECT time_start, time_end, durasi, kunci_slot_1, kunci_slot_2, kunci_slot_3
            FROM mst_dokter_jadwal_praktek
            WHERE id_dokter=? AND id_dow=?
            LIMIT 1
        ", [$id_dokter, $dow])->row_array();
        if (!$jadwal) return [];

        $ts = $jadwal['time_start']; $te = $jadwal['time_end']; $dur = (int)$jadwal['durasi'];
        if (!$ts || !$te || $dur<=0 || $ts==='00:00:00' || $te==='00:00:00') return [];

        $start = strtotime($tanggal.' '.$ts);
        $end   = strtotime($tanggal.' '.$te);
        if ($end <= $start) return [];

        // cuti per tanggal
        $cuti = $this->db->query("
            SELECT 1 FROM mst_dokter_cuti
            WHERE id_dokter=? AND tanggal_cuti=? LIMIT 1
        ", [$id_dokter, $tanggal])->row_array();
        if ($cuti) return [];

        // generate slot
        $all = [];
        for ($t=$start; $t + $dur*60 <= $end; $t += $dur*60) {
            $all[] = date('H:i',$t);
        }
        if (!$all) return [];

        // slot terpakai
        $booked = $this->db->query("
            SELECT COALESCE(jam_slot, slot) AS s
            FROM trx_reg_book
            WHERE id_dokter=? AND tanggal=?
        ", [$id_dokter, $tanggal])->result_array();
        $taken = array_filter(array_map(fn($r)=>trim((string)$r['s']), $booked));
        $takenSet = array_fill_keys($taken, true);

        // locked slots -> convert locked slot numbers to time HH:ii
        $locks = [];
        foreach (['kunci_slot_1','kunci_slot_2','kunci_slot_3'] as $k) {
            $n = (int)($jadwal[$k] ?? 0);
            if ($n > 0) {
                $t = $start + ($n-1) * $dur * 60;
                if ($t + $dur*60 <= $end) $locks[] = date('H:i', $t);
            }
        }
        $lockSet = array_fill_keys($locks, true);

        $available = [];
        foreach ($all as $s) if (!isset($takenSet[$s]) && !isset($lockSet[$s])) $available[] = $s;
        return $available;
    }

    // Kembalikan semua slot (all) dan slot yang sudah dibooking (booked)
    public function get_slots_all_and_booked($tanggal, $id_dokter)
    {
        if (!$tanggal || !$id_dokter) return ['all'=>[], 'booked'=>[]];
        $dow = (int)date('N', strtotime($tanggal));
        $jadwal = $this->db->query(
            "SELECT time_start, time_end, durasi, kunci_slot_1, kunci_slot_2, kunci_slot_3
             FROM mst_dokter_jadwal_praktek
             WHERE id_dokter=? AND id_dow=?
             LIMIT 1",
            [$id_dokter, $dow]
        )->row_array();
        if (!$jadwal) return ['all'=>[], 'booked'=>[]];

        $ts = $jadwal['time_start']; $te = $jadwal['time_end']; $dur = (int)$jadwal['durasi'];
        if (!$ts || !$te || $dur<=0 || $ts==='00:00:00' || $te==='00:00:00') return ['all'=>[], 'booked'=>[]];

        $start = strtotime($tanggal.' '.$ts);
        $end   = strtotime($tanggal.' '.$te);
        if ($end <= $start) return ['all'=>[], 'booked'=>[]];

        // cuti dokter: jika cuti, all kosong
        $cuti = $this->db->query(
            "SELECT 1 FROM mst_dokter_cuti WHERE id_dokter=? AND tanggal_cuti=? LIMIT 1",
            [$id_dokter, $tanggal]
        )->row_array();
        if ($cuti) return ['all'=>[], 'booked'=>[]];

        $all = [];
        for ($t=$start; $t + $dur*60 <= $end; $t += $dur*60) {
            $all[] = date('H:i',$t);
        }

        $booked = $this->db->query(
            "SELECT COALESCE(jam_slot, slot) AS s
             FROM trx_reg_book
             WHERE id_dokter=? AND tanggal=?",
            [$id_dokter, $tanggal]
        )->result_array();
        $taken = array_values(array_filter(array_map(fn($r)=>trim((string)$r['s']), $booked)));

        // locked slots times
        $locks = [];
        foreach (['kunci_slot_1','kunci_slot_2','kunci_slot_3'] as $k) {
            $n = (int)($jadwal[$k] ?? 0);
            if ($n > 0) {
                $t = $start + ($n-1) * $dur * 60;
                if ($t + $dur*60 <= $end) $locks[] = date('H:i', $t);
            }
        }

        return ['all'=>$all, 'booked'=>$taken, 'locked'=>$locks];
    }

    // Ambil daftar slot terkunci (format HH:ii) untuk tanggal & dokter
    public function get_locked_slots_times($tanggal, $id_dokter)
    {
        if (!$tanggal || !$id_dokter) return [];
        $dow = (int)date('N', strtotime($tanggal));
        $row = $this->db->query(
            "SELECT time_start, time_end, durasi, kunci_slot_1, kunci_slot_2, kunci_slot_3
             FROM mst_dokter_jadwal_praktek
             WHERE id_dokter=? AND id_dow=?
             LIMIT 1",
            [$id_dokter, $dow]
        )->row_array();
        if (!$row) return [];
        $ts = $row['time_start']; $te = $row['time_end']; $dur = (int)$row['durasi'];
        if (!$ts || !$te || $dur<=0) return [];
        $start = strtotime($tanggal.' '.$ts); $end = strtotime($tanggal.' '.$te);
        if ($end <= $start) return [];
        $locks = [];
        foreach (['kunci_slot_1','kunci_slot_2','kunci_slot_3'] as $k) {
            $n = (int)($row[$k] ?? 0);
            if ($n > 0) {
                $t = $start + ($n-1) * $dur * 60;
                if ($t + $dur*60 <= $end) $locks[] = date('H:i', $t);
            }
        }
        return $locks;
    }

    // Info cuti dokter untuk tanggal tertentu (on: boolean, keterangan: string)
    public function get_cuti_info($tanggal, $id_dokter)
    {
        if (!$tanggal || !$id_dokter) return ['on'=>false, 'keterangan'=>''];
        $row = $this->db->query(
            "SELECT keterangan FROM mst_dokter_cuti WHERE id_dokter=? AND tanggal_cuti=? LIMIT 1",
            [$id_dokter, $tanggal]
        )->row_array();
        return [ 'on' => (bool)$row, 'keterangan' => $row['keterangan'] ?? '' ];
    }

    public function get_quota_info($tanggal, $id_dokter)
    {
        $dow = (int)date('N', strtotime($tanggal));
        $jadwal = $this->db->query("
            SELECT time_start, time_end, durasi
            FROM mst_dokter_jadwal_praktek
            WHERE id_dokter=? AND id_dow=? LIMIT 1
        ", [$id_dokter, $dow])->row_array();
        if (!$jadwal) return ['total'=>0,'available'=>0];

        $ts=$jadwal['time_start']; $te=$jadwal['time_end']; $dur=(int)$jadwal['durasi'];
        if (!$ts || !$te || $dur<=0) return ['total'=>0,'available'=>0];

        $start = strtotime($tanggal.' '.$ts);
        $end   = strtotime($tanggal.' '.$te);
        if ($end <= $start) return ['total'=>0,'available'=>0];

        $total = (int)floor(($end - $start) / ($dur*60));
        $available = count($this->get_slots($tanggal, null, $id_dokter));
        return ['total'=>$total, 'available'=>$available];
    }

    // Kuota split per jenis (vaksin/konsul) dari jadwal dokter per hari (id_dow)
    public function get_quota_split($tanggal, $id_dokter)
    {
        $dow = (int)date('N', strtotime($tanggal));
        $row = $this->db->query(
            "SELECT quota_vaksin, quota_konsul FROM mst_dokter_jadwal_praktek WHERE id_dokter=? AND id_dow=? LIMIT 1",
            [$id_dokter, $dow]
        )->row_array();
        return [
            'vaksin'  => (int)($row['quota_vaksin'] ?? 0),
            'konsul'  => (int)($row['quota_konsul'] ?? 0),
        ];
    }

    // Pemakaian kuota yang sudah dibooking pada tanggal tsb per jenis
    public function get_used_quota_split($tanggal, $id_dokter)
    {
        $rows = $this->db->query(
            "SELECT LOWER(COALESCE(jenis_perawatan,'')) AS jp, COUNT(*) AS jml
             FROM trx_reg_book
             WHERE id_dokter=? AND tanggal=?
             GROUP BY LOWER(COALESCE(jenis_perawatan,''))",
            [$id_dokter, $tanggal]
        )->result_array();
        $out = ['vaksin'=>0,'konsul'=>0];
        foreach($rows as $r){
            if ($r['jp']==='vaksin') $out['vaksin'] = (int)$r['jml'];
            elseif ($r['jp']==='konsultasi') $out['konsul'] = (int)$r['jml'];
        }
        return $out;
    }

    public function check_quota_perawatan($tanggal, $id_dokter, $jenis)
    {
        $jenis_norm = strtolower(trim((string)$jenis));
        if(!in_array($jenis_norm, ['vaksin','konsultasi'], true)){
            return ['ok'=>false,'message'=>'Jenis perawatan tidak dikenal.'];
        }
        $quota = $this->get_quota_split($tanggal, $id_dokter);
        $used  = $this->get_used_quota_split($tanggal, $id_dokter);
        $limit = ($jenis_norm==='vaksin') ? $quota['vaksin'] : $quota['konsul'];
        $taken = ($jenis_norm==='vaksin') ? $used['vaksin'] : $used['konsul'];
        $jenis_label = ucfirst($jenis_norm);
        $full_msg = 'Kuota '.$jenis_label.' sudah penuh di tanggal ini. Silahkan pilih tanggal lain. Terimakasih';
        if ($limit <= 0) return ['ok'=>false,'message'=>$full_msg];
        if ($taken >= $limit) return ['ok'=>false,'message'=>$full_msg];
        return ['ok'=>true,'message'=>'OK','remaining'=>($limit-$taken)];
    }

    /* ===== BOOKING (trx_reg_book: id_pasien VARCHAR(8) DENGAN ZERO) ===== */

    public function check_double_booking($id_pasien_with_zeros, $tanggal, $id_dokter, $slot_time)
    {
        // 1) pasien + dokter + tanggal
        $row = $this->db->query("
            SELECT 1
            FROM trx_reg_book
            WHERE id_pasien=? AND id_dokter=? AND tanggal=?
            LIMIT 1
        ", [$id_pasien_with_zeros, $id_dokter, $tanggal])->row_array();
        if ($row) return ['ok'=>false,'message'=>'Anda sudah memiliki booking pada tanggal ini dengan dokter tersebut.'];

        // 2) slot bentrok
        $dupe = $this->db->query("
            SELECT 1
            FROM trx_reg_book
            WHERE id_dokter=? AND tanggal=? AND (jam_slot=? OR slot=?)
            LIMIT 1
        ", [$id_dokter, $tanggal, $slot_time, $slot_time])->row_array();
        if ($dupe) return ['ok'=>false,'message'=>'Slot tersebut sudah terisi. Pilih slot lain.'];

        return ['ok'=>true,'message'=>'OK'];
    }

    /** Hitung urutan slot (1-based) dari jadwal dokter */
    private function _compute_slot_index($tanggal, $id_dokter, $slot_time)
    {
        if (!$tanggal || !$id_dokter || !$slot_time) return null;

        // map hari: PHP 1=Mon..7=Sun -> id_dow di tabel
        $dow = (int)date('N', strtotime($tanggal)); // 1..7
        $j = $this->db->query("
            SELECT time_start, time_end, durasi
            FROM mst_dokter_jadwal_praktek
            WHERE id_dokter=? AND id_dow=?
            LIMIT 1
        ", [$id_dokter, $dow])->row_array();
        if (!$j) return null;

        $ts = $j['time_start']; $te = $j['time_end']; $dur = (int)$j['durasi'];
        if (!$ts || !$te || $dur<=0) return null;

        $start = strtotime($tanggal.' '.$ts);
        $end   = strtotime($tanggal.' '.$te);
        $sel   = strtotime($tanggal.' '.$slot_time.':00'); // slot_time 'HH:MM'

        if ($sel < $start || $sel > $end) return null;
        $minutes = (int)floor(($sel - $start) / 60);
        $idx     = 1 + (int)floor($minutes / $dur);
        return (string)$idx; // simpan sebagai string (kolom TEXT)
    }

    /* ===== BOOKING (trx_reg_book: id_pasien VARCHAR(8) dengan zero) ===== */

    public function insert_booking($id_pasien_with_zeros, $tanggal, $id_spes, $id_dokter, $slot_time, $jenis_perawatan)
    {
        // hitung slot order
        $slot_index = $this->_compute_slot_index($tanggal, $id_dokter, $slot_time);

        $data = [
            'id_pasien'     => $id_pasien_with_zeros, // simpan 8 digit apa adanya
            'id_dokter'     => $id_dokter,
            'tanggal'       => $tanggal,
            'jam_slot'      => $slot_time,
            'slot'          => $slot_index,           // <=== ISI slot
            'jenis_perawatan'=> $jenis_perawatan,
            'sudah_checkin' => 0,
            'created'       => date('Y-m-d H:i:s')
        ];
        return $this->db->insert('trx_reg_book', $data);
    }

    public function get_bookings_by_pasien($id_pasien_with_zeros)
    {
        $sql = "SELECT
                    b.id AS id_book,
                    b.tanggal,
                    COALESCE(b.jam_slot, b.slot) AS slot_time,
                    b.jenis_perawatan,
                    b.id_dokter,
                    CASE WHEN COALESCE(b.sudah_checkin,0)=1 THEN 'CHECKIN' ELSE 'BARU' END AS status,
                    s.name AS unit,
                    d.name AS nama_dokter,
                    dc.keterangan AS cuti_ket
                FROM trx_reg_book b
                LEFT JOIN mst_dokter d  ON d.id_dokter = b.id_dokter
                LEFT JOIN mst_dokter_spec s ON s.id_spes = d.id_spes
                LEFT JOIN mst_dokter_cuti dc ON (dc.id_dokter=b.id_dokter AND dc.tanggal_cuti=b.tanggal)
                WHERE b.id_pasien=?
                ORDER BY b.tanggal DESC, COALESCE(b.jam_slot, b.slot) DESC";
        return $this->db->query($sql, [$id_pasien_with_zeros])->result_array();
    }

    public function get_booking_by_id($id_book)
    {
        return $this->db->query(
            "SELECT b.*, d.id_spes, d.name AS nama_dokter
             FROM trx_reg_book b
             LEFT JOIN mst_dokter d ON d.id_dokter=b.id_dokter
             WHERE b.id=? LIMIT 1",
            [$id_book]
        )->row_array();
    }

    public function check_double_booking_update($id_book, $id_pasien_with_zeros, $tanggal, $id_dokter, $slot_time)
    {
        // exclude same row id when checking duplicates
        $row = $this->db->query(
            "SELECT 1 FROM trx_reg_book
             WHERE id<>? AND id_pasien=? AND id_dokter=? AND tanggal=? LIMIT 1",
            [$id_book, $id_pasien_with_zeros, $id_dokter, $tanggal]
        )->row_array();
        if ($row) return ['ok'=>false,'message'=>'Anda sudah memiliki booking pada tanggal ini dengan dokter tersebut.'];

        $dupe = $this->db->query(
            "SELECT 1 FROM trx_reg_book
             WHERE id<>? AND id_dokter=? AND tanggal=? AND (jam_slot=? OR slot=?) LIMIT 1",
            [$id_book, $id_dokter, $tanggal, $slot_time, $slot_time]
        )->row_array();
        if ($dupe) return ['ok'=>false,'message'=>'Slot tersebut sudah terisi. Pilih slot lain.'];

        return ['ok'=>true,'message'=>'OK'];
    }

    public function update_booking_date($id_book, $tanggal_baru, $slot_time)
    {
        $bk = $this->get_booking_by_id($id_book);
        if (!$bk) return false;
        $slot_index = $this->_compute_slot_index($tanggal_baru, $bk['id_dokter'], $slot_time);
        if ($slot_index === null) return false;
        $this->db->where('id', $id_book);
        return $this->db->update('trx_reg_book', [
            'tanggal'  => $tanggal_baru,
            'jam_slot' => $slot_time,
            'slot'     => $slot_index,
        ]);
    }

    public function cancel_booking($id_book, $ket_batal)
    {
        $bk = $this->get_booking_by_id($id_book);
        if (!$bk) return false;
        $ins = [
            'id_book'       => $bk['id'] ?? null,
            'id_pasien'     => $bk['id_pasien'] ?? null,
            'id_dokter'     => $bk['id_dokter'] ?? null,
            'tanggal'       => $bk['tanggal'] ?? null,
            'jam_slot'      => $bk['jam_slot'] ?? null,
            'slot'          => $bk['slot'] ?? null,
            'jenis_perawatan'=> $bk['jenis_perawatan'] ?? null,
            'sudah_checkin' => $bk['sudah_checkin'] ?? 0,
            'created'       => $bk['created'] ?? null,
            'ket_batal'     => $ket_batal,
            'cancel_date'   => date('Y-m-d H:i:s'),
        ];
        $ok = $this->db->insert('trx_reg_book_cancel', $ins);
        if (!$ok) return false;
        $this->db->where('id', $id_book);
        return $this->db->delete('trx_reg_book');
    }

    /* ===== RIWAYAT ===== */

    public function get_riwayat($id_pasien_with_zeros)
		{
				$sql = "SELECT
										r.id_reg,
										r.regdate,
										ru.id_unit,
										u.name AS unit,
										ru.id_dokter,
										d.name AS nama_dokter
								FROM trx_reg r
								LEFT JOIN trx_reg_unit ru ON ru.id_reg = r.id_reg
								LEFT JOIN mst_unit   u    ON u.id_unit   = ru.id_unit
								LEFT JOIN mst_dokter d    ON d.id_dokter = ru.id_dokter
								WHERE r.id_pasien = ?
								ORDER BY r.regdate DESC";
				return $this->db->query($sql, [$id_pasien_with_zeros])->result_array();
		}

}
?>
