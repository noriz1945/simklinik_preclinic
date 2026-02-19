<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_vaksinasi extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('laporan_vaksinasi/M_laporan_vaksinasi', 'm');
        $this->load->helper(['url','form']);
        $this->load->library(['session']);
    }

    public function index()
    {
        $data = [
            'title' => 'Laporan Vaksinasi',
        ];
        $this->load->view('laporan_vaksinasi/v_index', $data);
    }

    /** Dropdown vaksin (id_group=3) */
    public function api_vaksin()
    {
        $rows = $this->m->get_vaksin_options();
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['status' => true, 'data' => $rows]));
    }

    /** Mode LIST: 1 baris per pasien */
    public function api_list()
    {
        $filters = $this->_filters();
        $rows = $this->m->get_list($filters);

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['status' => true, 'data' => $rows]));
    }

    /** Mode MATRIX: 1 baris per vaksin+batch+tanggal, pasien digabung koma */
    public function api_matrix()
    {
        $filters = $this->_filters();
        $rows = $this->m->get_matrix($filters);

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['status' => true, 'data' => $rows]));
    }

    private function _filters()
    {
        // aman: hanya trim string
        $vaksin_id   = trim((string)$this->input->get('vaksin_id', true)); // id_fa
        $vaksin_name = trim((string)$this->input->get('vaksin_name', true));
        $nama_pasien = trim((string)$this->input->get('nama_pasien', true));
        $id_batch    = trim((string)$this->input->get('id_batch', true));
        $date_from   = trim((string)$this->input->get('date_from', true)); // YYYY-MM-DD
        $date_to     = trim((string)$this->input->get('date_to', true));   // YYYY-MM-DD

        return [
            'vaksin_id'   => $vaksin_id,
            'vaksin_name' => $vaksin_name,
            'nama_pasien' => $nama_pasien,
            'id_batch'    => $id_batch,
            'date_from'   => $date_from,
            'date_to'     => $date_to,
        ];
    }
}
