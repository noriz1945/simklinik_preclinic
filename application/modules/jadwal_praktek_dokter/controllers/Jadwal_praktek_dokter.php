<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_praktek_dokter extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jadwal_praktek_dokter_model');
        $this->load->helper(['url','form']);
        $this->load->library('session');
    }

    public function index()
    {
        $dokters = $this->Jadwal_praktek_dokter_model->get_doctors_with_units();
        $schedules = $this->Jadwal_praktek_dokter_model->get_all_schedules();

        // map schedules: [id_dokter][id_dow] => row
        $map = [];
        foreach ($schedules as $r) {
            $map[$r['id_dokter']][(int)$r['id_dow']] = $r;
        }

        $data = [
            'dokters'   => $dokters,
            'sched_map' => $map,
        ];
        $this->load->view('vJadwal_praktek_dokter', $data);
    }

    public function get_schedule_ajax()
    {
        $id_dokter = $this->input->post('id_dokter', TRUE);
        $id_dow    = $this->input->post('id_dow', TRUE);
        if (!$id_dokter || !$id_dow) return $this->_json(false, 'Param wajib.');
        $row = $this->Jadwal_praktek_dokter_model->get_schedule($id_dokter, $id_dow);
        return $this->_json(true, 'ok', ['data'=>$row]);
    }

    public function save_schedule_ajax()
    {
        $id_dokter = $this->input->post('id_dokter', TRUE);
        $id_dow    = $this->input->post('id_dow', TRUE);
        $time_start= $this->input->post('time_start', TRUE);
        $time_end  = $this->input->post('time_end', TRUE);
        $durasi    = (int)$this->input->post('durasi', TRUE);
        $q_vaksin  = (int)$this->input->post('quota_vaksin', TRUE);
        $q_konsul  = (int)$this->input->post('quota_konsul', TRUE);
        $ks1_raw   = $this->input->post('kunci_slot_1', TRUE);
        $ks2_raw   = $this->input->post('kunci_slot_2', TRUE);
        $ks3_raw   = $this->input->post('kunci_slot_3', TRUE);
        if (!$id_dokter || !$id_dow || !$time_start || !$time_end || $durasi<=0) return $this->_json(false,'Lengkapi data.');

        // Validate quotas (optional but recommended)
        $ts = strtotime('2000-01-01 '.$time_start);
        $te = strtotime('2000-01-01 '.$time_end);
        if ($te <= $ts) return $this->_json(false,'Waktu selesai harus lebih besar dari mulai.');
        $total = (int)floor(($te - $ts) / ($durasi*60));
        if ($q_vaksin < 0 || $q_konsul < 0) return $this->_json(false,'Quota tidak boleh negatif.');
        if (($q_vaksin + $q_konsul) !== $total) return $this->_json(false,'Jumlah quota harus sama dengan Total Slot ('.$total.').');

        // Validate locked slot numbers (optional), must be within [1..total] and unique
        $ks = [];
        foreach ([1=>$ks1_raw,2=>$ks2_raw,3=>$ks3_raw] as $idx=>$val) {
            $v = is_null($val) ? '' : trim((string)$val);
            if ($v === '') { $ks[$idx] = null; continue; }
            $n = (int)$v;
            if ($n < 1 || $n > $total) return $this->_json(false, 'Nomor slot dikunci #'.$idx.' harus antara 1 dan '.$total.'.');
            if (in_array($n, array_filter($ks, function($x){ return !is_null($x); }), true)) return $this->_json(false, 'Nomor slot dikunci tidak boleh duplikat.');
            $ks[$idx] = $n;
        }

        $ok = $this->Jadwal_praktek_dokter_model->upsert_schedule($id_dokter, $id_dow, [
            'time_start'=>$time_start,
            'time_end'  =>$time_end,
            'durasi'    =>$durasi,
            'quota_vaksin' => $q_vaksin,
            'quota_konsul' => $q_konsul,
            'kunci_slot_1' => $ks[1],
            'kunci_slot_2' => $ks[2],
            'kunci_slot_3' => $ks[3],
        ]);
        return $this->_json((bool)$ok, $ok?'Tersimpan.':'Gagal simpan.');
    }

    public function delete_schedule_ajax()
    {
        $id_dokter = $this->input->post('id_dokter', TRUE);
        $id_dow    = $this->input->post('id_dow', TRUE);
        if (!$id_dokter || !$id_dow) return $this->_json(false, 'Param wajib.');
        $ok = $this->Jadwal_praktek_dokter_model->delete_schedule($id_dokter, $id_dow);
        return $this->_json((bool)$ok, $ok?'Terhapus.':'Gagal hapus.');
    }

    private function _json($status, $message, $extra = [])
    {
        return $this->output->set_content_type('application/json')
            ->set_output(json_encode(array_merge(['status'=>$status,'message'=>$message], $extra)));
    }
}
?>
