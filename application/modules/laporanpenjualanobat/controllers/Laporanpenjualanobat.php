<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporanpenjualanobat extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url','form']);
        $this->load->library(['session','pagination']);
        $this->load->model('laporanpenjualanobat/Laporanpenjualanobat_model', 'mdl');
        date_default_timezone_set('Asia/Jakarta');
    }

    /**
     * Laporan Penjualan Obat (dari eResep)
     * Rules: soap_eresep_det.id_inv IS NOT NULL AND soap_eresep_det.status = 0
     * URL: /laporanpenjualanobat?from=YYYY-MM-DD&to=YYYY-MM-DD&q=&inv=&start=0
     */
    public function index()
    {
        $q    = trim($this->input->get('q', true) ?? '');
        $inv  = trim($this->input->get('inv', true) ?? '');
        $from = trim($this->input->get('from', true) ?? date('Y-m-01'));
        $to   = trim($this->input->get('to', true) ?? date('Y-m-d'));

        $start = (int)($this->input->get('start') ?? 0);
        $limit = (int)($this->input->get('limit') ?? 50);
        if ($limit <= 0) $limit = 50;
        if ($limit > 500) $limit = 500;

        $filters = [
            'q' => $q,
            'inv' => $inv,
            'from' => $from,
            'to' => $to,
        ];

        $total = $this->mdl->count_rows($filters);
        $rows  = $this->mdl->get_rows($filters, $limit, $start);
        $sum   = $this->mdl->get_summary($filters);

        $config['base_url'] = base_url('laporanpenjualanobat');
        $config['page_query_string'] = true;
        $config['query_string_segment'] = 'start';
        $config['reuse_query_string'] = true;
        $config['total_rows'] = $total;
        $config['per_page'] = $limit;
        $this->pagination->initialize($config);

        $data = [
            'title' => 'Laporan Penjualan Obat',
            'filters' => $filters,
            'rows' => $rows,
            'total' => $total,
            'sum' => $sum,
            'pagination' => $this->pagination->create_links(),
        ];

        $this->load->view('laporanpenjualanobat/index', $data);
    }

    public function export_csv()
    {
        $q    = trim($this->input->get('q', true) ?? '');
        $inv  = trim($this->input->get('inv', true) ?? '');
        $from = trim($this->input->get('from', true) ?? date('Y-m-01'));
        $to   = trim($this->input->get('to', true) ?? date('Y-m-d'));

        $filters = [
            'q' => $q,
            'inv' => $inv,
            'from' => $from,
            'to' => $to,
        ];

        $rows = $this->mdl->get_rows($filters, 50000, 0);

        $fname = 'laporanpenjualanobat_' . date('Ymd_His') . '.csv';
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename='.$fname);
        $out = fopen('php://output', 'w');

        fputcsv($out, ['Tanggal','ID eResep','ID Reg','Invoice','ID Obat','Nama Obat','Qty','Harga','Subtotal','Jenis','Racikan']);
        foreach($rows as $r){
            fputcsv($out, [
                $r->eresepdate,
                $r->id_eresep,
                $r->id_reg,
                $r->id_inv,
                $r->id_trx_det,
                $r->name,
                (float)$r->qty_num,
                (int)$r->harga_satuan,
                (int)$r->subtotal,
                $r->jenis_obat,
                (int)$r->is_racikan,
            ]);
        }
        fclose($out);
        exit;
    }
}
