<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_trx_reg_book extends CI_Model {

    public function insert($data)
    {
        $this->db->insert('trx_reg_book', $data);
        return $this->db->insert_id();
    }

    public function is_double_booking($id_pasien, $tanggal, $exclude_id = null)
    {
        $this->db->from('trx_reg_book');
        $this->db->where('id_pasien', $id_pasien);
        $this->db->where('tanggal', $tanggal);

        // kalau ada kolom cancel, abaikan booking yang dibatalkan
        if ($this->db->field_exists('is_cancel', 'trx_reg_book')) {
            $this->db->where('is_cancel', 0);
        }

        if (!empty($exclude_id)) {
            $this->db->where('id !=', $exclude_id);
        }

        return ($this->db->count_all_results() > 0);
    }

    public function search_pasien_select2($term)
    {
    $this->db->select('id_pasien, name, birthdate');
    $this->db->from('mst_pasien');

    $this->db->group_start();
        $this->db->like('id_pasien', $term);
        $this->db->or_like('name', $term);
        $this->db->or_like('birthdate', $term);
    $this->db->group_end();

    $this->db->limit(20);

    return $this->db->get()->result();
    }


    /* ============================================================
       MASTER DOKTER & PASIEN
    ============================================================ */
    public function get_dokter()
    {
        return $this->db->where('aktif',1)
                        ->order_by('name','ASC')
                        ->get('mst_dokter')
                        ->result();
    }

    public function get_dokter_by_id($id_dokter)
    {
        return $this->db->where('id_dokter',$id_dokter)
                        ->get('mst_dokter')
                        ->row();
    }

    public function get_pasien_by_id($id_pasien)
    {
        return $this->db->where('id_pasien',$id_pasien)
                        ->get('mst_pasien')
                        ->row();
    }

    /* ============================================================
       CUTI & JADWAL
    ============================================================ */
    public function is_dokter_cuti($id_dokter, $tanggal)
    {
        return $this->db->where('id_dokter', $id_dokter)
                        ->where('tanggal_cuti', $tanggal)
                        ->get('mst_dokter_cuti')
                        ->num_rows() > 0;
    }

    public function get_jadwal_dokter($id_dokter, $tanggal)
    {
        $dayIndex = date('w', strtotime($tanggal)); // 0=Sun .. 6=Sat

        return $this->db->where('id_dokter', $id_dokter)
                        ->where('id_dow', $dayIndex)
                        ->get('mst_dokter_jadwal_praktek')
                        ->row();
    }

    /* ============================================================
       GENERATE SLOT HARIAN
    ============================================================ */
    public function generate_slot($id_dokter, $tanggal)
    {
        $jadwal = $this->get_jadwal_dokter($id_dokter, $tanggal);
        if (!$jadwal) return array();

        $start = strtotime($jadwal->time_start);
        $end   = strtotime($jadwal->time_end);
        $dur   = (int)$jadwal->durasi;

        $slots = array();
        while ($start < $end) {
            $jam = date('H:i', $start);

            $is_filled = $this->db->where('id_dokter', $id_dokter)
                                  ->where('tanggal', $tanggal)
                                  ->where('jam_slot', $jam)
                                  ->get('trx_reg_book')
                                  ->num_rows() > 0;

            $slots[] = array(
                'jam'    => $jam,
                'filled' => $is_filled
            );

            $start = strtotime('+'.$dur.' minutes', $start);
        }

        return $slots;
    }

    /* ============================================================
       LIST BOOKING
    ============================================================ */
    public function get_list($dokter, $tanggal, $pasien)
    {
        $this->db->select('b.*, p.name AS nama_pasien, p.hp AS hp_pasien, d.name AS dokter_name');
        $this->db->from('trx_reg_book b');
        $this->db->join('mst_pasien p','p.id_pasien=b.id_pasien','left');
        $this->db->join('mst_dokter d','d.id_dokter=b.id_dokter','left');

        if ($dokter)  $this->db->where('b.id_dokter', $dokter);
        if ($tanggal) $this->db->where('b.tanggal', $tanggal);
        if ($pasien) {
            $this->db->group_start();
            $this->db->like('p.name', $pasien);
            $this->db->or_like('p.id_pasien', $pasien);
            $this->db->group_end();
        }

        $this->db->order_by('b.jam_slot','ASC');
        return $this->db->get()->result();
    }

    /* ============================================================
       SIMPAN BOOKING
    ============================================================ */
    public function save_booking($post)
    {
        // Cek double slot
        $exist = $this->db->where('id_dokter', $post['id_dokter'])
                          ->where('tanggal', $post['tanggal'])
                          ->where('jam_slot', $post['jam_slot'])
                          ->get('trx_reg_book')
                          ->num_rows();

        if ($exist > 0) {
            return array('status'=>'failed','msg'=>'Slot sudah terisi oleh pasien lain.');
        }

        $data = array(
            'id_pasien'  => $post['id_pasien'],
            'id_dokter'  => $post['id_dokter'],
            'tanggal'    => $post['tanggal'],
            'jam_slot'   => $post['jam_slot'],
            'slot'       => $post['jam_slot'],
            'note'       => isset($post['note']) ? $post['note'] : '',
            'jenis_perawatan' => isset($post['jenis_perawatan']) ? $post['jenis_perawatan'] : '',
            'sudah_checkin'   => 0,
            'created'    => date('Y-m-d H:i:s'),
            'created_by' => isset($this->session->userdata('sp')->username) ? $this->session->userdata('sp')->username : ''
        );

        $this->db->insert('trx_reg_book', $data);
        $id = $this->db->insert_id();

        return array('status'=>'ok','id'=>$id);
    }

    /* ============================================================
       DETAIL BOOKING
    ============================================================ */
    public function get_booking_by_id($id)
    {
        $this->db->select('b.*, p.name AS nama_pasien, p.hp AS hp_pasien, d.name AS dokter_name');
        $this->db->from('trx_reg_book b');
        $this->db->join('mst_pasien p','p.id_pasien=b.id_pasien','left');
        $this->db->join('mst_dokter d','d.id_dokter=b.id_dokter','left');
        $this->db->where('b.id',$id);
        return $this->db->get()->row();
    }

    /* ============================================================
       WHATSAPP REMINDER
       - build_wa_link  : membuat link wa.me
       - send_whatsapp_reminder : bisa dipakai auto (misal via gateway)
    ============================================================ */
    public function build_wa_link($id_book)
    {
        $row = $this->get_booking_by_id($id_book);
        if (!$row) return false;

        $hp = $row->hp_pasien;
        if (!$hp) return false;

        // Normalisasi nomor (buang leading 0 -> 62)
        $hp = preg_replace('/[^0-9]/','',$hp);
        if (substr($hp,0,1) == '0') {
            $hp = '62'.substr($hp,1);
        }

        $tgl = $row->tanggal;
        $jam = $row->jam_slot;

        $msg = "Halo ".$row->nama_pasien.", ini pengingat jadwal kunjungan di LYND Klinik.\n".
               "Dokter: ".$row->dokter_name."\n".
               "Tanggal: ".$tgl."\n".
               "Jam: ".$jam."\n\n".
               "Mohon datang 10-15 menit lebih awal ya 🙂";

        $url = "https://wa.me/".$hp."?text=".urlencode($msg);
        return $url;
    }

    public function send_whatsapp_reminder($id_book)
    {
        // Versi sederhana: cukup build link saja, biar di-handle di UI (button)
        // Jika ingin pakai gateway REST API, logic cURL bisa ditaruh di sini.
        // Placeholder sengaja dibuat simple supaya aman di semua server.
        return true;
    }

    /* ============================================================
       ANTRIAN REALTIME PER DOKTER
       - urut berdasarkan jam_slot
       - status: Menunggu / Selesai (sudah_checkin)
    ============================================================ */
    public function get_queue($id_dokter, $tanggal)
    {
        $this->db->select('b.*, p.name AS nama_pasien');
        $this->db->from('trx_reg_book b');
        $this->db->join('mst_pasien p','p.id_pasien=b.id_pasien','left');
        $this->db->where('b.id_dokter',$id_dokter);
        $this->db->where('b.tanggal',$tanggal);
        $this->db->order_by('b.jam_slot','ASC');

        $rows = $this->db->get()->result();

        $result = array();
        $no = 1;
        foreach ($rows as $r) {
            $result[] = array(
                'no'          => $no,
                'nama_pasien' => $r->nama_pasien,
                'jam_slot'    => $r->jam_slot,
                'status'      => $r->sudah_checkin ? 'Selesai / Diperiksa' : 'Menunggu',
            );
            $no++;
        }

        return $result;
    }

    /* ============================================================
       KALENDER BULANAN – JADWAL & BOOKING
       Output per tanggal:
       - is_cuti
       - total_booking
       - kapasitas (slot maksimal dari jadwal)
    ============================================================ */
    public function build_month_calendar($id_dokter, $bulan, $tahun)
    {
        $kal = array();

        // Cari jumlah hari di bulan tsb
        $total_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

        for ($d = 1; $d <= $total_hari; $d++) {
            $tgl = sprintf('%04d-%02d-%02d', $tahun, $bulan, $d);

            $is_cuti = $this->is_dokter_cuti($id_dokter, $tgl);

            $jadwal  = $this->get_jadwal_dokter($id_dokter, $tgl);
            $kapasitas = 0;
            if ($jadwal) {
                $start = strtotime($jadwal->time_start);
                $end   = strtotime($jadwal->time_end);
                $dur   = (int)$jadwal->durasi;

                while ($start < $end) {
                    $kapasitas++;
                    $start = strtotime('+'.$dur.' minutes', $start);
                }
            }

            $total_booking = $this->db->where('id_dokter',$id_dokter)
                                      ->where('tanggal',$tgl)
                                      ->get('trx_reg_book')
                                      ->num_rows();

            $kal[$tgl] = array(
                'is_cuti'        => $is_cuti,
                'kapasitas'      => $kapasitas,
                'total_booking'  => $total_booking
            );
        }

        return $kal;
    }

    /* ============================================================
       DASHBOARD LOAD DOKTER (PER BULAN)
       - Sum booking
       - Sum kapasitas jadwal
    ============================================================ */
    public function get_doctor_load($bulan, $tahun)
    {
        $dokter = $this->get_dokter();
        $result = array();

        foreach ($dokter as $d) {

            // Hitung booking dalam bulan tsb
            $this->db->from('trx_reg_book');
            $this->db->where('id_dokter',$d->id_dokter);
            $this->db->where('LEFT(tanggal,7)', sprintf('%04d-%02d', $tahun, $bulan));
            $total_booking = $this->db->count_all_results();

            // Hitung kapasitas dengan loop hari (sederhana, tapi cukup)
            $total_kapasitas = 0;
            $total_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
            for ($day = 1; $day <= $total_hari; $day++) {
                $tgl = sprintf('%04d-%02d-%02d', $tahun, $bulan, $day);
                $jadwal = $this->get_jadwal_dokter($d->id_dokter, $tgl);
                if ($jadwal) {
                    $start = strtotime($jadwal->time_start);
                    $end   = strtotime($jadwal->time_end);
                    $dur   = (int)$jadwal->durasi;

                    while ($start < $end) {
                        $total_kapasitas++;
                        $start = strtotime('+'.$dur.' minutes', $start);
                    }
                }
            }

            $result[] = array(
                'id_dokter'       => $d->id_dokter,
                'nama_dokter'     => $d->name,
                'total_booking'   => $total_booking,
                'total_kapasitas' => $total_kapasitas
            );
        }

        return $result;
    }
    
    public function get_slots_by_date($id_dokter, $tanggal)
{
    if (!$id_dokter) return [];

    // Tentukan hari (0 = Minggu)
    $id_dow = date('w', strtotime($tanggal));

    // Ambil jadwal dokter berdasarkan hari
    $jadwal = $this->db->get_where('mst_dokter_jadwal_praktek', [
        'id_dokter' => $id_dokter,
        'id_dow'    => $id_dow
    ])->row();

    // Tidak ada jadwal / dianggap libur
    if (!$jadwal) return [];
    if ($jadwal->time_start == '00:00:00' || $jadwal->time_end == '00:00:00') return [];

    // Durasi slot
    $durasi = (int)$jadwal->durasi;
    if ($durasi <= 0) $durasi = 10;

    // Generate slot times
    $slotTimes = [];
    $start = strtotime($jadwal->time_start);
    $end   = strtotime($jadwal->time_end);

    while ($start < $end) {
        $slotTimes[] = date("H:i", $start);
        $start = strtotime("+{$durasi} minutes", $start);
    }

    // Ambil booking existing pada tanggal tsb + JOIN pasien + company
    $booking = $this->db
        ->select("
            b.*,
            p.name AS nama_pasien,
            p.birthdate,
            c.name AS nama_asuransi
        ")
        ->from("trx_reg_book b")
        ->join("mst_pasien p", "p.id_pasien = b.id_pasien", "left")
        ->join("mst_company c", "c.id_company = b.id_asuransi", "left")
        ->where("b.id_dokter", $id_dokter)
        ->where("b.tanggal", $tanggal)
        ->get()
        ->result();

    // mapping jam_slot → booking object
    $bookMap = [];
    foreach ($booking as $b) {
        $bookMap[$b->jam_slot] = $b;
    }

    // Output final array
    $slots = [];
    foreach ($slotTimes as $jam) {

        if (isset($bookMap[$jam])) {
            // slot terisi
            $b = $bookMap[$jam];

            $slots[] = (object)[
                'jam_slot'     => $jam,
                'id_booking'   => $b->id,           // ⭐ WAJIB
                'id_pasien'    => $b->id_pasien,
                'nama_pasien'  => $b->nama_pasien,
                'asuransi'     => $b->nama_asuransi,
                'birthdate'    => $b->birthdate,
                'status'       => $b->sudah_checkin ? 'Selesai' : 'Booked'
            ];

        } else {
            // slot kosong
            $slots[] = (object)[
                'jam_slot'     => $jam,
                'id_booking'   => null,
                'id_pasien'    => null,
                'nama_pasien'  => null,
                'asuransi'     => null,
                'birthdate'    => null,
                'status'       => 'Kosong'
            ];
        }
    }

    return $slots;
}


    
}
