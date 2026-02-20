<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporanstokobat extends MX_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->helper(['url','form']);
        $this->load->library(['session','pagination']);
        $this->load->model('Laporanstokobat_model', 'mdl');
        // sesuaikan bila project Anda memakai auth module
        if (method_exists($this, 'auth')) {
            // noop
        }
        date_default_timezone_set('Asia/Jakarta');
    }

    /**
     * Laporan Stok Obat
     * URL: /laporanstokobat?wrh=&q=&min=&max=&from=YYYY-MM-DD&to=YYYY-MM-DD&start=0
     */
    public function index()
    {
        $q     = trim($this->input->get('q', true) ?? '');
        $wrh   = trim($this->input->get('wrh', true) ?? '');
        $min   = $this->input->get('min', true);
        $max   = $this->input->get('max', true);
        $from  = trim($this->input->get('from', true) ?? '');
        $to    = trim($this->input->get('to', true) ?? '');

        $start = (int)($this->input->get('start') ?? 0);
        $limit = (int)($this->input->get('limit') ?? 50);
        if ($limit <= 0) $limit = 50;
        if ($limit > 500) $limit = 500;

        $filters = [
            'q' => $q,
            'wrh' => $wrh,
            'min' => ($min === '' || $min === null) ? null : (int)$min,
            'max' => ($max === '' || $max === null) ? null : (int)$max,
            'from' => $from,
            'to' => $to,
        ];

        $total = $this->mdl->count_rows($filters);
        $rows  = $this->mdl->get_rows($filters, $limit, $start);

        // pagination
        $config['base_url'] = base_url('laporanstokobat');
        $config['page_query_string'] = true;
        $config['query_string_segment'] = 'start';
        $config['reuse_query_string'] = true;
        $config['total_rows'] = $total;
        $config['per_page'] = $limit;
        $this->pagination->initialize($config);

        $data = [
            'title' => 'Laporan Stok Obat',
            'filters' => $filters,
            'rows' => $rows,
            'total' => $total,
            'pagination' => $this->pagination->create_links(),
            'wrh_list' => $this->mdl->get_warehouse_list(),
        ];
 
        // pakai wrapper theme project Anda bila ada
        $this->load->view('laporanstokobat/index', $data);
    }

    /** Export CSV (biar ringan & universal) */
    public function export_csv()
    {
        $q     = trim($this->input->get('q', true) ?? '');
        $wrh   = trim($this->input->get('wrh', true) ?? '');
        $min   = $this->input->get('min', true);
        $max   = $this->input->get('max', true);
        $from  = trim($this->input->get('from', true) ?? '');
        $to    = trim($this->input->get('to', true) ?? '');

        $filters = [
            'q' => $q,
            'wrh' => $wrh,
            'min' => ($min === '' || $min === null) ? null : (int)$min,
            'max' => ($max === '' || $max === null) ? null : (int)$max,
            'from' => $from,
            'to' => $to,
        ];

        $rows = $this->mdl->get_rows($filters, 50000, 0);

        $fname = 'laporanstokobat_' . date('Ymd_His') . '.csv';
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename='.$fname);
        $out = fopen('php://output', 'w');

        fputcsv($out, ['ID Obat','Nama','Gudang','Stok','Terakhir Update','Harga Jual']);
        foreach($rows as $r){
            fputcsv($out, [
                $r->id_fa,
                $r->name,
                $r->id_wrh,
                (int)$r->stok,
                $r->last_datetime,
                $r->sale_price,
            ]);
        }
        fclose($out);
        exit;
    }
}
