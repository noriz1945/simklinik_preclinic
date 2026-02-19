<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokter_cuti extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dokter_cuti_model');
        $this->load->helper(['url','form']);
        $this->load->library('session');
    }

    public function index($year = null, $month = null)
    {
        $year  = $year  ? (int)$year  : (int)date('Y');
        $month = $month ? (int)$month : (int)date('m');
        if ($month < 1 || $month > 12) $month = (int)date('m');

        $firstDay   = strtotime(sprintf('%04d-%02d-01', $year, $month));
        $daysInMon  = (int)date('t', $firstDay);
        $startDow   = (int)date('N', $firstDay); // 1..7 Mon..Sun

        $dates = [];
        for ($d=1; $d<=$daysInMon; $d++) {
            $dates[] = sprintf('%04d-%02d-%02d', $year, $month, $d);
        }

        $cuti = $this->Dokter_cuti_model->get_cuti_in_range($dates[0], end($dates));
        $map = [];
        foreach ($cuti as $r) {
            $map[$r['tanggal_cuti']][] = $r;
        }

        $data = [
            'year'      => $year,
            'month'     => $month,
            'start_dow' => $startDow,
            'days'      => $daysInMon,
            'cuti_map'  => $map,
            'dokters'   => $this->Dokter_cuti_model->get_dokters(),
        ];
        $this->load->view('vDokter_cuti', $data);
    }

    public function get_cuti_by_date_ajax()
    {
        $tgl = $this->input->post('tanggal', TRUE);
        if (!$tgl) return $this->_json(false, 'Tanggal wajib');
        $rows = $this->Dokter_cuti_model->get_cuti_by_date($tgl);
        return $this->_json(true, 'ok', ['items'=>$rows]);
    }

    public function save_cuti_ajax()
    {
        $tgl = $this->input->post('tanggal', TRUE);
        $id_dokter = $this->input->post('id_dokter', TRUE);
        $ket = trim((string)$this->input->post('keterangan', TRUE));
        if (!$tgl || !$id_dokter) return $this->_json(false, 'Lengkapi data.');
        if ($ket==='') $ket = '-';
        $ok = $this->Dokter_cuti_model->insert_cuti([ 'tanggal_cuti'=>$tgl, 'id_dokter'=>$id_dokter, 'keterangan'=>$ket ]);
        return $this->_json((bool)$ok, $ok?'Tersimpan.':'Gagal simpan.');
    }

    public function delete_cuti_ajax()
    {
        // Accept common fallbacks and coerce to integer to be safe
        $id = $this->input->post('id_cuti', TRUE);
        if ($id === null || $id === '') { $id = $this->input->post('id', TRUE); }
        if (($id === null || $id === '') && isset($_POST['id_cuti'])) { $id = $_POST['id_cuti']; }
        $id = is_array($id) ? 0 : (int)$id;

        if ($id > 0) {
            $ok = $this->Dokter_cuti_model->delete_cuti($id);
            return $this->_json((bool)$ok, $ok?'Terhapus.':'Gagal hapus.');
        }

        // Fallback: delete by (tanggal, id_dokter) if id is not provided/valid
        $tanggal   = $this->input->post('tanggal', TRUE);
        $id_dokter = (int)$this->input->post('id_dokter', TRUE);
        if ($tanggal && $id_dokter > 0) {
            $ok = $this->Dokter_cuti_model->delete_cuti_pair($tanggal, $id_dokter);
            return $this->_json((bool)$ok, $ok?'Terhapus.':'Data tidak ditemukan.');
        }

        return $this->_json(false, 'id wajib');
    }

    public function bulk_cuti_ajax()
    {
        $start = $this->input->post('start', TRUE);
        $end   = $this->input->post('end', TRUE);
        $id_dokter = $this->input->post('id_dokter', TRUE);
        $ket = trim((string)$this->input->post('keterangan', TRUE));
        if (!$start || !$end || !$id_dokter) return $this->_json(false, 'Lengkapi data.');
        if ($ket==='') $ket = '-';
        if (strtotime($end) < strtotime($start)) return $this->_json(false, 'Rentang tanggal tidak valid');

        $ok = $this->Dokter_cuti_model->insert_cuti_range($start, $end, $id_dokter, $ket);
        return $this->_json((bool)$ok, $ok?'Tersimpan.':'Gagal simpan.');
    }

    private function _json($status, $message, $extra = [])
    {
        return $this->output->set_content_type('application/json')
            ->set_output(json_encode(array_merge(['status'=>$status,'message'=>$message], $extra)));
    }
}
?>
