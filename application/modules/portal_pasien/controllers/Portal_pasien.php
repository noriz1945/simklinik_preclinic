<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portal_pasien extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Portal_pasien_model');
        $this->load->library(['session','form_validation']);
        $this->load->helper(['url','form','security']);
    }

    public function index($portal_id=null, $pin=null)
    {
        // Wajib ada portal_id di URL
        if (!$portal_id) { redirect('portal_pasien/login'); return; }

        $sess = $this->session->userdata('portal_pasien_user');
        // Jika sudah login, pastikan session cocok dengan portal_id & pin pada URL
        if ($sess && isset($sess['portal_id']) && isset($sess['pin'])) {
            if ($sess['portal_id'] === $portal_id && ($pin !== null && $pin !== '' ? $sess['pin'] === $pin : true)) {
                redirect('portal_pasien/home');
                return;
            }
            // Jika session aktif namun mismatch, tampilkan form login untuk portal_id ini
        }

        // Tampilkan form login dengan prefill portal_id dari URL
        $data['prefill_hp']  = $portal_id; // prefill Portal Id di view
        $data['prefill_pin'] = $pin;       // prefill PIN jika ada di URL
        $this->load->view('vPortal_pasien_login', $data);
    }

    public function login()
    {
        $data['prefill_hp'] = '';
        $this->load->view('vPortal_pasien_login', $data);
    }

    // Halaman form pendaftaran pasien baru (public)
    public function daftar_pasien_baru()
    {
        // muat master wilayah untuk inisialisasi
        $data = [
            'propinsis'  => $this->Portal_pasien_model->get_propinsis(),
        ];
        $this->load->view('vPortal_pasien_daftar_baru', $data);
    }

    public function do_login()
    {
        $portal_id  = $this->input->post('portal_id', TRUE);
        $pin        = $this->input->post('pin', TRUE);
        if (!$portal_id || !$pin) return $this->_json(false, 'Portal Id dan PIN wajib.');

        $user = $this->Portal_pasien_model->auth_by_portal_id_pin($portal_id, $pin);
        if (!$user) return $this->_json(false, 'Portal Id atau PIN salah.');

        // id_pasien dari DB sudah 8 digit dengan leading zero
        $this->session->set_userdata('portal_pasien_user', [
            'id_pasien' => $user['no_rm'],      // simpan 8 digit apa adanya
            'no_rm'     => $user['no_rm'],
            'nama'      => $user['nama_pasien'],
            'hp'        => $user['hp'],         // simpan HP untuk notifikasi
            'portal_id' => $portal_id,          // simpan portal_id untuk validasi URL langsung
            'pin'       => $pin                 // simpan PIN di session untuk validasi sesi
        ]);

        return $this->_json(true, 'Login berhasil.');
    }

    public function logout()
    {
        $this->session->unset_userdata('portal_pasien_user');
        redirect('portal_pasien/login');
    }

    public function home()
    {
        $u = $this->_userOrRedirect();
        $this->load->view('vPortal_pasien_home', ['user'=>$u]);
    }

    public function booking()
    {
        $u = $this->_userOrRedirect();
        $data = [
            'user'     => $u,
            'bookings' => $this->Portal_pasien_model->get_bookings_by_pasien($u['id_pasien']),
            // gunakan list spesialisasi namun tetap kirim dengan key 'units' agar kompatibel dengan view
            'units'    => $this->Portal_pasien_model->get_spes(),
            'dokters'  => $this->Portal_pasien_model->get_dokters(),
        ];
        $this->load->view('vPortal_pasien_booking', $data);
    }

    public function get_slots_ajax()
    {
        $u         = $this->_userOrRedirect(true);
        $tanggal   = $this->input->post('tanggal', TRUE);
        $id_unit   = $this->input->post('id_unit', TRUE);
        $id_dokter = $this->input->post('id_dokter', TRUE);

        // Batasi tanggal: hari ini s.d. 7 hari ke depan
        $today = date('Y-m-d');
        $max   = date('Y-m-d', strtotime('+7 days'));
        if (!$tanggal || $tanggal < $today || $tanggal > $max) {
            return $this->_json(false, 'Tanggal hanya boleh hari ini sampai 7 hari ke depan.');
        }

        $slots = $this->Portal_pasien_model->get_slots($tanggal, $id_unit, $id_dokter);
        $full  = $this->Portal_pasien_model->get_slots_all_and_booked($tanggal, $id_dokter);
        $quota = $this->Portal_pasien_model->get_quota_info($tanggal, $id_dokter);
        $cuti  = $this->Portal_pasien_model->get_cuti_info($tanggal, $id_dokter);
        return $this->_json(true, 'ok', [
            'slots'       => $slots,              // tetap: slot tersedia (untuk kompatibilitas)
            'all_slots'   => $full['all'] ?? [],  // semua slot hasil generate jadwal
            'booked_slots'=> $full['booked'] ?? [], // slot yang sudah diambil
            'locked_slots'=> $full['locked'] ?? [], // slot yang dikunci dari jadwal
            'quota'       => $quota,
            'cuti'        => $cuti
        ]);
    }

    public function get_dokters_by_unit_ajax()
    {
        $this->_userOrRedirect(true);
        $id_unit = $this->input->post('id_unit', TRUE);
        if (!$id_unit) return $this->_json(false, 'id_spes wajib');
        // interpretasikan id_unit sebagai id_spes (spesialisasi)
        $rows = $this->Portal_pasien_model->get_dokters_by_spes($id_unit);
        return $this->_json(true, 'ok', ['dokters'=>$rows]);
    }

    public function update_booking_date_ajax()
    {
        $u         = $this->_userOrRedirect(true);
        $id_book   = (int)$this->input->post('id_book', TRUE);
        $tanggal   = $this->input->post('tanggal', TRUE);
        $slot_time = $this->input->post('slot_time', TRUE);
        if ($id_book<=0 || !$tanggal || !$slot_time) return $this->_json(false, 'Lengkapi data.');

        // Validasi tanggal range
        $today = date('Y-m-d'); $max = date('Y-m-d', strtotime('+7 days'));
        if ($tanggal < $today || $tanggal > $max) return $this->_json(false, 'Tanggal di luar rentang.');

        $bk = $this->Portal_pasien_model->get_booking_by_id($id_book);
        if (!$bk || $bk['id_pasien'] !== $u['id_pasien']) return $this->_json(false, 'Data booking tidak ditemukan.');

        // Cek cuti: tidak bisa dipindah ke tanggal cuti
        $cuti = $this->Portal_pasien_model->get_cuti_info($tanggal, $bk['id_dokter']);
        if ($cuti['on']) return $this->_json(false, 'Dokter tidak praktek: '.$cuti['keterangan']);

        // Cek bentrok
        $chk = $this->Portal_pasien_model->check_double_booking_update($id_book, $u['id_pasien'], $tanggal, $bk['id_dokter'], $slot_time);
        if (!$chk['ok']) return $this->_json(false, $chk['message']);

        // Cegah pilih slot yang dikunci
        $locked = $this->Portal_pasien_model->get_locked_slots_times($tanggal, $bk['id_dokter']);
        if (in_array($slot_time, $locked, true)) return $this->_json(false, 'Slot ini dikunci. Silakan pilih slot lainnya.');

        $ok = $this->Portal_pasien_model->update_booking_date($id_book, $tanggal, $slot_time);
        return $this->_json((bool)$ok, $ok ? 'Booking diperbarui.' : 'Gagal memperbarui booking.');
    }

    public function cancel_booking_ajax()
    {
        $u         = $this->_userOrRedirect(true);
        $id_book   = (int)$this->input->post('id_book', TRUE);
        $ket       = trim((string)$this->input->post('ket_batal', TRUE));
        if ($id_book<=0 || $ket==='') return $this->_json(false, 'Lengkapi alasan pembatalan.');

        $bk = $this->Portal_pasien_model->get_booking_by_id($id_book);
        if (!$bk || $bk['id_pasien'] !== $u['id_pasien']) return $this->_json(false, 'Data booking tidak ditemukan.');

        $ok = $this->Portal_pasien_model->cancel_booking($id_book, $ket);
        return $this->_json((bool)$ok, $ok ? 'Booking dibatalkan.' : 'Gagal membatalkan booking.');
    }

    // ===== AJAX master wilayah untuk form daftar baru ===== //
    public function get_kota_by_propinsi_ajax()
    {
        $id_propinsi = $this->input->post('id_propinsi', TRUE);
        if (!$id_propinsi) return $this->_json(false, 'id_propinsi wajib');
        $rows = $this->Portal_pasien_model->get_kota_by_propinsi($id_propinsi);
        return $this->_json(true, 'ok', ['items'=>$rows]);
    }

    public function get_kecamatan_by_kota_ajax()
    {
        $id_kota = $this->input->post('id_kota', TRUE);
        if (!$id_kota) return $this->_json(false, 'id_kota wajib');
        $rows = $this->Portal_pasien_model->get_kecamatan_by_kota($id_kota);
        return $this->_json(true, 'ok', ['items'=>$rows]);
    }

    public function get_kelurahan_by_kecamatan_ajax()
    {
        $id_kecamatan = $this->input->post('id_kecamatan', TRUE);
        if (!$id_kecamatan) return $this->_json(false, 'id_kecamatan wajib');
        $rows = $this->Portal_pasien_model->get_kelurahan_by_kecamatan($id_kecamatan);
        return $this->_json(true, 'ok', ['items'=>$rows]);
    }

    // Verifikasi apakah pasien sudah terdaftar berdasarkan Nama + Tanggal Lahir
    public function verify_pasien_ajax()
    {
        $nama = $this->input->post('nama', TRUE);
        $tgl  = $this->input->post('tgl_lahir', TRUE);
        if(!$nama || !$tgl) return $this->_json(false, 'Nama dan Tanggal Lahir wajib.');
        $row = $this->Portal_pasien_model->find_patient_by_name_birthdate($nama, $tgl);
        if(!$row) return $this->_json(false, 'Pasien belum terdaftar.');
        $row['portal_id'] = date('dmY', strtotime($row['birthdate']));
        return $this->_json(true, 'Data pasien ditemukan.', ['data'=>$row]);
    }

    // Simpan pasien baru (minimal field)
    public function create_pasien_ajax()
    {
        $nama  = $this->input->post('nama', TRUE);
        $tgl   = $this->input->post('tgl_lahir', TRUE);
        $tmp   = $this->input->post('tmp_lahir', TRUE);
        $jk    = $this->input->post('jk', TRUE);
        $ayah  = $this->input->post('nama_ayah', TRUE);
        $ibu   = $this->input->post('nama_ibu', TRUE);
        $hp    = $this->input->post('hp', TRUE);
        $alamat= $this->input->post('alamat', TRUE);
        $id_propinsi  = $this->input->post('id_propinsi', TRUE);
        $id_kota      = $this->input->post('id_kota', TRUE);
        $id_kecamatan = $this->input->post('id_kecamatan', TRUE);
        $id_kelurahan = $this->input->post('id_kelurahan', TRUE);

        if(!$nama || !$tgl || !$tmp || !$jk || !$hp){
            return $this->_json(false, 'Lengkapi data wajib.');
        }
        if(!preg_match('/^\d+$/',$hp)) return $this->_json(false,'HP/WA hanya angka.');

        // pastikan belum ada
        $exist = $this->Portal_pasien_model->find_patient_by_name_birthdate($nama, $tgl);
        if($exist) return $this->_json(false, 'Nama + Tgl Lahir sudah terdaftar.');

        // generate id_pasien via module Mst_pasien
        $this->load->module('mst_pasien');
        $new_id = Modules::run('mst_pasien/get_new_id_pasien');
        if(!$new_id) return $this->_json(false,'Gagal membuat No. RM.');

        // generate PIN 6 digit
        $pin = str_pad((string)mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

        $data = [
            'id_pasien'   => $new_id,
            'name'        => $nama,
            'birthdate'   => $tgl,
            'birthplace'  => $tmp,
            'gender'      => $jk,
            'father_name' => $ayah,
            'mother_name' => $ibu,
            'address'     => $alamat,
            'id_propinsi' => $id_propinsi,
            'id_kota'     => $id_kota,
            'id_kecamatan'=> $id_kecamatan,
            'id_kelurahan'=> $id_kelurahan,
            'hp'          => $hp,
            'pin'         => $pin,
            'aktif'       => 1,
            'is_rm_aps'   => 0,
            'created'     => date('Y-m-d H:i:s'),
            'creator'     => 'portal',
        ];
        $ok = $this->Portal_pasien_model->insert_pasien($data);
        if(!$ok) return $this->_json(false, 'Gagal menyimpan pasien baru.');

        $data['portal_id'] = date('dmY', strtotime($tgl));
        return $this->_json(true, 'Pasien baru tersimpan.', ['data'=>$data]);
    }

    public function create_booking_ajax()
    {
        $u         = $this->_userOrRedirect(true);
        $tanggal   = $this->input->post('tanggal', TRUE);
        $id_unit   = $this->input->post('id_unit', TRUE);
        $id_dokter = $this->input->post('id_dokter', TRUE);
        $slot_time = $this->input->post('slot_time', TRUE);
        $jenis     = $this->input->post('jenis_perawatan', TRUE);

        // Validasi tanggal: hari ini s.d. 7 hari ke depan
        $today = date('Y-m-d');
        $max   = date('Y-m-d', strtotime('+7 days'));
        if (!$tanggal || $tanggal < $today || $tanggal > $max) {
            return $this->_json(false, 'Tanggal hanya boleh hari ini sampai 7 hari ke depan.');
        }
        $jenis_norm = in_array(strtolower((string)$jenis), ['vaksin','konsultasi'], true) ? $jenis : '';
        if (!$jenis_norm) return $this->_json(false, 'Pilih jenis perawatan.');

        // Cek slot dikunci
        $locked = $this->Portal_pasien_model->get_locked_slots_times($tanggal, $id_dokter);
        if (in_array($slot_time, $locked, true)) return $this->_json(false, 'Slot ini dikunci. Silakan pilih slot lainnya.');

        $chk = $this->Portal_pasien_model->check_double_booking($u['id_pasien'], $tanggal, $id_dokter, $slot_time);
        if (!$chk['ok']) return $this->_json(false, $chk['message']);

        // Cek kuota perawatan (Vaksin/Konsultasi)
        $q = $this->Portal_pasien_model->check_quota_perawatan($tanggal, $id_dokter, $jenis_norm);
        if (!$q['ok']) return $this->_json(false, $q['message']);

        $ok = $this->Portal_pasien_model->insert_booking($u['id_pasien'], $tanggal, $id_unit, $id_dokter, $slot_time, ucfirst(strtolower($jenis_norm)));
        if (!$ok) return $this->_json(false, 'Gagal membuat booking.');

        // Notifikasi WA
        $hpIntl = (strpos($u['hp'], '0')===0) ? ('62'.substr($u['hp'],1)) : $u['hp'];
        $unit   = $this->Portal_pasien_model->get_spes_name($id_unit);
        $dokter = $this->Portal_pasien_model->get_dokter_name($id_dokter);
        // Hitung nomor antrian berdasarkan urutan slot pada jadwal hari itu
        $allSlots = $this->Portal_pasien_model->get_slots_all_and_booked($tanggal, $id_dokter);
        $slotNo = '-';
        if (!empty($allSlots['all']) && is_array($allSlots['all'])) {
            $idx = array_search($slot_time, $allSlots['all'], true);
            if ($idx !== false) $slotNo = $idx + 1;
        }
        $lines = [
          "Halo {$u['nama']},",
          "Booking berhasil di Klinik LYND.",
          "Tanggal: {$tanggal}",
          "Nomor antrian: {$slotNo}",
          "Jam: {$slot_time}",
          "Poliklinik: {$unit}",
          "Dokter: {$dokter}",
          "",
          "Mohon konfirmasi kedatangan dengan balas chat ini karena ada daftar pasien waiting list.",
          "",
          "Note :",
          "- Jika antrian terlewat maka akan di lewatkan 1-2 pasien terlebih dahulu tergantung kondisi saat registrasi ulang",
          "- Estimasi jam kedatangan berdasarkan rata2 waktu konsul per pasein, ketidaksesuaian jam mungkin saja terjadi, kami sarankan untuk chat WA admin untuk info antrian yang sedang berjalan",
          "Terima kasih."
        ];
        $wa_text = rawurlencode(implode("\n", $lines));
        // Use wa.me so it opens WhatsApp app on Android or desktop on Windows
        $wa_link = "https://wa.me/".rawurlencode($hpIntl)."?text=".$wa_text;

        return $this->_json(true, 'Booking dibuat.', ['wa_link'=>$wa_link]);
    }

    public function resend_pin_ajax()
    {
        // If called from logged-in pages, use session. If called from public registration result, allow id_pasien parameter.
        $id_pasien = $this->input->post('id_pasien', TRUE);
        if ($id_pasien) {
            $info = $this->Portal_pasien_model->get_portal_info_by_id($id_pasien);
        } else {
            $u   = $this->_userOrRedirect(true);
            $info = $this->Portal_pasien_model->get_portal_info_by_id($u['id_pasien']);
        }
        if (!$info) return $this->_json(false, 'Gagal ambil data portal.');

        $hpRaw = $info['hp'] ?? '';
        $hpIntl = (strpos($hpRaw, '0')===0) ? ('62'.substr($hpRaw,1)) : $hpRaw;
        $portalId = $info['portal_id'] ?? '';
        $portalUrl = base_url('portal_pasien/index/'.$portalId);
        $lines = [
          "Salam dari Klinik LYND,",
          "berikut kami sampaikan PORTAL_ID anda adalah {$portalId} (Sama dengan tgl. Lahir DDMMYYYY) dan PIN anda adalah {$info['pin']},",
          "Untuk booking bisa dilakukan di alamat {$portalUrl}",
          "Sehat selalu",
          "'- Klinik LYND -"
        ];
        $wa_text = rawurlencode(implode("\n", $lines));
        // Use wa.me so it opens WhatsApp app on mobile or desktop
        $wa_link = "https://wa.me/".rawurlencode($hpIntl)."?text=".$wa_text;

        return $this->_json(true, 'Link WA siap.', ['wa_link'=>$wa_link]);
    }

    public function ganti_pin_ajax()
    {
        $u   = $this->_userOrRedirect(true);
        $pin = $this->input->post('pin', TRUE);
        if (!preg_match('/^\d{6}$/', (string)$pin)) {
            return $this->_json(false, 'PIN harus 6 digit angka.');
        }
        $ok = $this->Portal_pasien_model->update_pin($u['id_pasien'], $pin);
        return $this->_json((bool)$ok, $ok ? 'PIN berhasil diperbarui.' : 'Gagal memperbarui PIN.');
    }

    private function _userOrRedirect($ajax=false)
    {
        $u = $this->session->userdata('portal_pasien_user');
        if (!$u) {
            if ($ajax) { $this->_json(false, 'Sesi berakhir. Silakan login ulang.'); exit; }
            redirect('portal_pasien/login'); exit;
        }
        return $u;
    }

    private function _json($status, $message, $extra = [])
    {
        return $this->output->set_content_type('application/json')
            ->set_output(json_encode(array_merge(['status'=>$status,'message'=>$message], $extra)));
    }
		
		public function riwayat()
		{
				$u = $this->_userOrRedirect();               // cek session portal pasien
				$data['user']    = $u;
				$data['riwayat'] = $this->Portal_pasien_model->get_riwayat($u['id_pasien']); // kirim id_pasien 8 digit (dengan nol depan)

				$this->load->view('vPortal_pasien_riwayat', $data);
		}

        
}
?>
