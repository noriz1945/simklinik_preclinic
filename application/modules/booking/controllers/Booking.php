<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('booking/Booking_model', 'mdl');
        // Reuse portal pasien logic for slots/quota/checks
        $this->load->model('portal_pasien/Portal_pasien_model', 'pmdl');
        $this->load->helper(['url','form','security']);
        $this->load->library(['session','form_validation']);
    }

    // Home Booking: calendar with doctor dropdown
    public function index($year = null, $month = null)
    {
        $year  = $year  ? (int)$year  : (int)date('Y');
        $month = $month ? (int)$month : (int)date('m');
        if ($month < 1 || $month > 12) $month = (int)date('m');

        $firstDay   = strtotime(sprintf('%04d-%02d-01', $year, $month));
        $daysInMon  = (int)date('t', $firstDay);
        $startDow   = (int)date('N', $firstDay); // 1..7 (Mon..Sun)
        $startDate  = sprintf('%04d-%02d-01', $year, $month);
        $endDate    = sprintf('%04d-%02d-%02d', $year, $month, $daysInMon);

        $id_dokter  = $this->input->get('id_dokter', TRUE);
        $cuti_map    = [];
        $counts_map  = [];
        if ($id_dokter) {
            $cuti = $this->mdl->get_cuti_in_range_by_doctor($id_dokter, $startDate, $endDate);
            foreach ($cuti as $r) { $cuti_map[$r['tanggal_cuti']] = $r['keterangan'] ?: '-'; }
            $counts_map = $this->mdl->get_booking_counts_in_range_by_doctor($id_dokter, $startDate, $endDate);
        }

        $data = [
            'year'       => $year,
            'month'      => $month,
            'start_dow'  => $startDow,
            'days'       => $daysInMon,
            'dokters'    => $this->mdl->get_dokters(),
            'id_dokter'  => $id_dokter,
            'cuti_map'   => $cuti_map,
            'counts_map' => $counts_map,
        ];
        $this->load->view('vBooking_home', $data);
    }

    // List of canceled bookings
    public function cancel_list()
    {
        $rows = $this->mdl->get_cancelled_bookings();
        $this->load->view('vBooking_cancel_list', ['rows'=>$rows]);
    }


    // Free Text WA page
    public function free_text_wa()
    {
        $this->load->view('vBooking_free_text_wa');
    }

    // Read-only view of doctor schedules (matrix)
    public function schedules()
    {
        $this->load->model('jadwal_praktek_dokter/Jadwal_praktek_dokter_model','jmdl');
        $dokters = $this->jmdl->get_doctors_with_units();
        $schedules = $this->jmdl->get_all_schedules();
        $map = [];
        foreach ($schedules as $r) { $map[$r['id_dokter']][(int)$r['id_dow']] = $r; }
        $data = [ 'dokters'=>$dokters, 'sched_map'=>$map ];
        $this->load->view('vBooking_schedules', $data);
    }

    /* ===== AJAX Endpoints ===== */

    // Get bookings by date and doctor
    public function get_bookings_by_date_ajax()
    {
        $tgl = $this->input->post('tanggal', TRUE);
        $id_dokter = $this->input->post('id_dokter', TRUE);
        if (!$tgl || !$id_dokter) return $this->_json(false, 'Param wajib.');
        $rows = $this->mdl->get_bookings_by_date_doctor($tgl, $id_dokter);
        // Build WA reminder link per row
        foreach ($rows as &$r) {
            $hpRaw = (string)($r['hp'] ?? '');
            $hpClean = preg_replace('/[^0-9\+]/', '', $hpRaw);
            if (strpos($hpClean, '+62') === 0) {
                $hpE164 = $hpClean; // already +62
            } elseif (strpos($hpClean, '0') === 0) {
                $hpE164 = '+62'.substr($hpClean, 1); // 0xxxx -> +62xxxx
            } elseif (strpos($hpClean, '62') === 0) {
                $hpE164 = '+'.$hpClean; // 62xxxx -> +62xxxx
            } else {
                $hpE164 = '+62'.$hpClean; // e.g. 859xxxx -> +62859xxxx
            }
            $lines = [
                'Halo '.$r['nama_pasien'].',',
                'Ini pengingat booking di Klinik LYND.',
                'Tanggal: '.$r['tanggal'],
                'Jam: '.$r['slot_time'],
                'Dokter: '.$r['nama_dokter'],
                'Terima kasih.'
            ];
            $r['wa_link'] = 'https://web.whatsapp.com/send?phone='.rawurlencode($hpE164).'&text='.rawurlencode(implode("\n", $lines));
        }
        return $this->_json(true, 'ok', ['items'=>$rows]);
    }

    // Update booking date + slot (reschedule)
    public function update_booking_date_ajax()
    {
        $id_book      = (int)$this->input->post('id_book', TRUE);
        $tanggal_baru = $this->input->post('tanggal_baru', TRUE);
        $slot_time    = $this->input->post('slot_time', TRUE);
        if (!$id_book || !$tanggal_baru || !$slot_time) return $this->_json(false, 'Lengkapi data.');

        // Date rule: today .. +7 days
        $today = date('Y-m-d');
        $max   = date('Y-m-d', strtotime('+7 days'));
        if ($tanggal_baru < $today || $tanggal_baru > $max) {
            return $this->_json(false, 'Tanggal hanya boleh hari ini sampai 7 hari ke depan.');
        }

        // Load current booking
        $bk = $this->pmdl->get_booking_by_id($id_book);
        if (!$bk) return $this->_json(false, 'Data booking tidak ditemukan.');

        $id_pasien = $bk['id_pasien'];
        $id_dokter = $bk['id_dokter'];

        // Prevent locked slot
        $locked = $this->pmdl->get_locked_slots_times($tanggal_baru, $id_dokter);
        if (in_array($slot_time, $locked, true)) return $this->_json(false, 'Slot ini dikunci. Pilih slot lain.');

        // Duplicate checks (exclude this booking id)
        $chk = $this->pmdl->check_double_booking_update($id_book, $id_pasien, $tanggal_baru, $id_dokter, $slot_time);
        if (!$chk['ok']) return $this->_json(false, $chk['message']);

        $ok = $this->pmdl->update_booking_date($id_book, $tanggal_baru, $slot_time);
        return $this->_json((bool)$ok, $ok ? 'Booking berhasil diubah.' : 'Gagal mengubah booking.');
    }

    // Cancel booking (admin)
    public function cancel_booking_ajax()
    {
        $id_book = (int)$this->input->post('id_book', TRUE);
        $ket     = trim((string)$this->input->post('ket_batal', TRUE));
        if ($id_book <= 0 || $ket === '') return $this->_json(false, 'Lengkapi alasan pembatalan.');

        $bk = $this->pmdl->get_booking_by_id($id_book);
        if (!$bk) return $this->_json(false, 'Data booking tidak ditemukan.');

        $ok = $this->pmdl->cancel_booking($id_book, $ket);
        return $this->_json((bool)$ok, $ok ? 'Booking dibatalkan.' : 'Gagal membatalkan booking.');
    }

    // Search pasien (by RM / name / HP)
    public function search_pasien_ajax()
    {
        $q = trim((string)$this->input->post('q', TRUE));
        $rows = $this->mdl->search_patients($q, 20);
        return $this->_json(true, 'ok', ['items'=>$rows]);
    }

    // Get slots + meta (reusing portal logic)
    public function get_slots_ajax()
    {
        $tanggal   = $this->input->post('tanggal', TRUE);
        $id_dokter = $this->input->post('id_dokter', TRUE);
        if (!$tanggal || !$id_dokter) return $this->_json(false, 'Param wajib.');
        // Enforce date rule: today .. +7 days
        $today = date('Y-m-d');
        $max   = date('Y-m-d', strtotime('+7 days'));
        if ($tanggal < $today || $tanggal > $max) {
            return $this->_json(false, 'Tanggal hanya boleh hari ini sampai 7 hari ke depan.');
        }
        $slots = $this->pmdl->get_slots($tanggal, null, $id_dokter);
        $full  = $this->pmdl->get_slots_all_and_booked($tanggal, $id_dokter);
        $quota = $this->pmdl->get_quota_info($tanggal, $id_dokter);
        $cuti  = $this->pmdl->get_cuti_info($tanggal, $id_dokter);
        return $this->_json(true, 'ok', [
            'slots'       => $slots,
            'all_slots'   => $full['all'] ?? [],
            'booked_slots'=> $full['booked'] ?? [],
            'locked_slots'=> $full['locked'] ?? [],
            'quota'       => $quota,
            'cuti'        => $cuti
        ]);
    }

    // Save booking (admin created)
    public function save_booking_ajax()
    {
        $id_pasien   = $this->input->post('id_pasien', TRUE);
        $id_dokter   = $this->input->post('id_dokter', TRUE);
        $tanggal     = $this->input->post('tanggal', TRUE);
        $slot_time   = $this->input->post('slot_time', TRUE);
        $jenis       = $this->input->post('jenis_perawatan', TRUE);
        if (!($id_pasien && $id_dokter && $tanggal && $slot_time && $jenis))
            return $this->_json(false, 'Lengkapi data.');

        // Enforce date rule: today .. +7 days
        $today = date('Y-m-d');
        $max   = date('Y-m-d', strtotime('+7 days'));
        if ($tanggal < $today || $tanggal > $max) {
            return $this->_json(false, 'Tanggal hanya boleh hari ini sampai 7 hari ke depan.');
        }

        // prevent locked slot
        $locked = $this->pmdl->get_locked_slots_times($tanggal, $id_dokter);
        if (in_array($slot_time, $locked, true)) return $this->_json(false, 'Slot ini dikunci. Pilih slot lain.');

        // double booking & slot conflict
        $chk = $this->pmdl->check_double_booking($id_pasien, $tanggal, $id_dokter, $slot_time);
        if (!$chk['ok']) return $this->_json(false, $chk['message']);

        // quota perawatan
        $cq = $this->pmdl->check_quota_perawatan($tanggal, $id_dokter, $jenis);
        if (!$cq['ok']) return $this->_json(false, $cq['message']);

        // insert
        $ok = $this->pmdl->insert_booking($id_pasien, $tanggal, null, $id_dokter, $slot_time, ucfirst(strtolower($jenis)));
        if (!$ok) return $this->_json(false, 'Gagal menyimpan booking.');

        // build WA link
        $uinfo = $this->mdl->get_patient_min($id_pasien);
        $hpRaw = (string)($uinfo['hp'] ?? '');
        $hpClean = preg_replace('/[^0-9\+]/', '', $hpRaw);
        if (strpos($hpClean, '+62') === 0) {
            $hpE164 = $hpClean;
        } elseif (strpos($hpClean, '0') === 0) {
            $hpE164 = '+62'.substr($hpClean, 1);
        } elseif (strpos($hpClean, '62') === 0) {
            $hpE164 = '+'.$hpClean;
        } else {
            $hpE164 = '+62'.$hpClean;
        }
        $dokter = $this->mdl->get_dokter_name($id_dokter);
        $lines = [
          'Halo '.$uinfo['nama'].',',
          'Booking berhasil di Klinik LYND.',
          'Tanggal: '.$tanggal,
          'Jam: '.$slot_time,
          'Dokter: '.$dokter,
          'Terima kasih.'
        ];
        $wa_link = 'https://web.whatsapp.com/send?phone='.rawurlencode($hpE164).'&text='.rawurlencode(implode("\n", $lines));
        return $this->_json(true, 'Booking dibuat.', ['wa_link'=>$wa_link]);
    }

    private function _json($status, $message, $extra = [])
    {
        return $this->output->set_content_type('application/json')
            ->set_output(json_encode(array_merge(['status'=>$status,'message'=>$message], $extra)));
    }
}
?>
