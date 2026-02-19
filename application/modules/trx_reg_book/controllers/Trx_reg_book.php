<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trx_reg_book extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('trx_reg_book/M_trx_reg_book', 'mbook');
        // LOAD MODEL WAJIB
        $this->load->model('trx_reg_book/M_trx_reg_book', 'M_trx_reg_book');
        $this->load->library(array('session','form_validation'));
        $this->load->helper(array('url','form','date'));

        if (!isset($this->session->userdata['sp'])) {
            redirect('login');
        }
    }

    /* ============================================================
       LIST BOOKING PASIEN
    ============================================================ */
    public function index()
    {
    $f_dokter  = $this->input->get('dokter');
    $f_tanggal = $this->input->get('tanggal') ?: date('d-m-Y');
    $f_pasien  = $this->input->get('pasien');

    $bulan = date('m', strtotime($f_tanggal));
    $tahun = date('Y', strtotime($f_tanggal));

    $data['dokter']   = $this->mbook->get_dokter();
    $data['f_dokter'] = $f_dokter;
    $data['f_tanggal']= $f_tanggal;

    // Kalender
    $data['bulan']    = $bulan;
    $data['tahun']    = $tahun;
    $data['kalender'] = $this->mbook->build_month_calendar($f_dokter, $bulan, $tahun);

    $this->load->view('trx_reg_book_list', $data);
    }


    /* ============================================================
       FORM BOOKING + GENERATE SLOT
    ============================================================ */
    public function create()
{
    $id_dokter = $this->input->get('dokter');
    $tanggal   = $this->input->get('tanggal') ?: date('d-m-Y');

    $data['dokter'] = $this->mbook->get_dokter();
    $data['id_dokter_selected'] = $id_dokter;
    $data['tanggal_selected']   = $tanggal;
    $data['bulan'] = date('m', strtotime($tanggal));
    $data['tahun'] = date('Y', strtotime($tanggal));

    $data['is_cuti'] = FALSE;
    $data['slots']   = [];

    if ($id_dokter && $tanggal) {
        if ($this->mbook->is_dokter_cuti($id_dokter, $tanggal)) {
            $data['is_cuti'] = TRUE;
        } else {
            $data['slots'] = $this->mbook->generate_slot($id_dokter, $tanggal);
        }
    }

    $this->load->view('trx_reg_book_form', $data);
}

    /* ============================================================
       SIMPAN BOOKING + KIRIM WA OTOMATIS
    ============================================================ */
    public function save()
    {
    $id_dokter   = $this->input->post('id_dokter');
    $tanggal     = $this->input->post('tanggal');
    $jam_slot    = $this->input->post('jam_slot');
    $id_pasien   = $this->input->post('id_pasien');
    $id_asuransi = $this->input->post('id_asuransi'); // ← FIX
    $note        = $this->input->post('note');

    // CEK DOUBLE BOOKING
    if ($this->M_trx_reg_book->is_double_booking($id_pasien, $tanggal)) {
        echo json_encode([
            'status' => 'error',
            'msg' => 'Pasien sudah memiliki booking pada hari yang sama.'
        ]);
        return;
    }

    // DATA INSERT
    $data = [
        'id_dokter'   => $id_dokter,
        'tanggal'     => $tanggal,
        'jam_slot'    => $jam_slot,
        'id_pasien'   => $id_pasien,
        'id_asuransi' => $id_asuransi,  // ← FIX BENAR
        'note'        => $note,
        'created'     => date('Y-m-d H:i:s')
    ];

    $this->M_trx_reg_book->insert($data);

    echo json_encode(['status' => 'ok']);
    }

    /* ============================================================
       WHATSAPP REMINDER MANUAL (via tombol di list)
    ============================================================ */
    public function wa_reminder($id)
    {
        // Hanya redirect ke link WA yang dibuat di model
        $wa_url = $this->mbook->build_wa_link($id);

        if ($wa_url) {
            redirect($wa_url);
        } else {
            $this->session->set_flashdata('msg_error','Nomor HP pasien tidak ditemukan.');
            redirect('trx_reg_book');
        }
    }

    /* ============================================================
       ANTRIAN REALTIME PER DOKTER – VIEW
    ============================================================ */
    public function queue($id_dokter)
    {
        $tanggal = date('d-m-Y');

        $data['dokter']   = $this->mbook->get_dokter_by_id($id_dokter);
        $data['tanggal']  = $tanggal;
        $data['antrian']  = $this->mbook->get_queue($id_dokter, $tanggal);

        $this->load->view('trx_reg_book_queue', $data);
    }

    /* ============================================================
       ANTRIAN REALTIME – JSON UNTUK AJAX
    ============================================================ */
    public function queue_json($id_dokter)
    {
        $tanggal = date('d-m-Y');

        $q = $this->mbook->get_queue($id_dokter, $tanggal);

        header('Content-Type: application/json');
        echo json_encode($q);
    }

    /* ============================================================
       KALENDER SLOT ALA GOOGLE CALENDAR
    ============================================================ */
    public function calendar()
{
    $id_dokter = $this->input->get('dokter');
    $bulan     = $this->input->get('bulan') ? $this->input->get('bulan') : date('m');
    $tahun     = $this->input->get('tahun') ? $this->input->get('tahun') : date('Y');

    // AUTO FIX
    $bulan = (int)$bulan;
    if ($bulan < 1 || $bulan > 12) $bulan = date('m');

    $tahun = (int)$tahun;
    if ($tahun < 2000 || $tahun > 2100) $tahun = date('Y');

    $data['bulan']  = $bulan;
    $data['tahun']  = $tahun;
    $data['tanggal_selected'] = date('d-m-Y');

    $data['dokter'] = $this->mbook->get_dokter();
    $data['id_dokter_selected'] = $id_dokter;

    $data['kalender'] = $id_dokter
        ? $this->mbook->build_month_calendar($id_dokter, $bulan, $tahun)
        : [];

    $this->load->view('trx_reg_book_calendar', $data);
}


    /* ============================================================
       DASHBOARD LOAD DOKTER (SLOT TERISI / KAPASITAS)
    ============================================================ */
    public function dashboard()
    {
        $bulan = $this->input->get('bulan') ? $this->input->get('bulan') : date('m');
        $tahun = $this->input->get('tahun') ? $this->input->get('tahun') : date('Y');

        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['dokter_load'] = $this->mbook->get_doctor_load($bulan, $tahun);

        $this->load->view('trx_reg_book_dashboard', $data);
    }
    
    public function modal_search_pasien()
    {
    $jam      = $this->input->get('jam');
    $tanggal  = $this->input->get('tanggal');
    $dokter   = $this->input->get('dokter');

    $data['jam']     = $jam;
    $data['tanggal'] = $tanggal;
    $data['dokter']  = $dokter;

    // asuransi dropdown
    $data['asuransi'] = $this->db->get('mst_company')->result();  // :contentReference[oaicite:0]{index=0}

    $this->load->view('modal_search_pasien', $data);
    }
    
    public function modal_booking_pasien()
    {
    $jam      = $this->input->get('jam');
    $tanggal  = $this->input->get('tanggal');
    $dokter   = $this->input->get('dokter');

    if (!$jam || !$tanggal || !$dokter) {
        echo "<div class='p-3 text-danger'>Parameter tidak lengkap.</div>";
        return;
    }

    $data['jam']       = $jam;
    $data['tanggal']   = $tanggal;
    $data['id_dokter'] = $dokter;

    // Ambil company (asuransi)
    $data['company'] = $this->db->order_by('name','ASC')->get('mst_company')->result();

    // Pastikan view ditemukan!
    $this->load->view('modal_booking_pasien', $data);
    }

    public function ajax_pasien_select2()
    {
    $term = $this->input->get('q');

    if (!$term) {
        echo json_encode([]);
        return;
    }

    $list = $this->M_trx_reg_book->search_pasien_select2($term);

    $output = [];
    foreach ($list as $p) {
        $output[] = [
            'id'   => $p->id_pasien,
            'text' => $p->id_pasien . ' - ' . $p->name . ' (' . date('d-m-Y', strtotime($p->birthdate)) . ')',
            'nama' => $p->name
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($output);
    }
    
    public function list_ajax()
    {
    $tanggal = $this->input->get('tanggal');
    $dokter  = $this->input->get('dokter');

    $data['slots'] = $this->M_trx_reg_book->get_slots_by_date($dokter, $tanggal);

    $this->load->view('trx_reg_book_list_ajax', $data);
    }
    
    public function delete_booking()
    {
    $id = $this->input->post('id');

    if (!$id) {
        echo json_encode(['status'=>'error','msg'=>'ID booking tidak ditemukan']);
        return;
    }

    // HAPUS BOOKING
    $this->db->where('id', $id)->delete('trx_reg_book');

    echo json_encode(['status'=>'ok']);
    }




}
